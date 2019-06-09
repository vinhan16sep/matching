<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Matching extends Member_Controller {

    const PARTNER_APPROVE = 1;
    const PARTNER_REJECT = 2;
    const REJECT_BY_ANOTHER_APPROVE = 3;

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('members')) {
            //redirect them to the login page
            redirect('member/user/login', 'refresh');
        }

        $this->load->helper('url');
        $this->load->helper('datetime_helper');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('email_helper');

        $this->load->model('matching_model');
        $this->load->model('event_model');
        $this->load->model('setting_model');
        $this->load->model('temp_register_model');
        $this->load->model('users_model');
        $this->load->model('category_model');

        $this->data['user'] = $this->ion_auth->user()->row();
    }

    public function index() {
        $this->render('member/matching/');
    }

    public function find() {
        $event = $this->ion_auth->user()->row()->event_id;
        if($this->input->get() && $this->input->get('submit') === 'OK'){
            $get = $this->input->get();
            if(!isset($get['category_id'])){
                redirect('member/matching/find', 'refresh');
            }
            $match_categories = $this->setting_model->get_matched_setting_data($event, $get['category_id'], $this->data['user']->id);
            foreach($match_categories as $key => $value){
                $target_user = $this->users_model->fetch_by_id($value['user_id']);
                $register_info = $this->temp_register_model->get_by_email_and_event_id($target_user['email'], $event);
                $match_categories[$key]['register_info'] = $register_info;
            }
            $this->data['matched_setting'] = $match_categories;
        }
        $this->data['page_title'] = 'Tìm kiếm';
        $category_root = $this->category_model->fetch_all_root_by_event($event);
        $events = array();
        if ($category_root) {
            foreach ($category_root as $key => $value) {
                $events[$value['id']]['name'] = $value['name'];
                $category_sub = $this->category_model->fetch_all_sub_by_event_and_parent($event, $value['id']);
                if ($category_sub) {
                    foreach ($category_sub as $k => $val) {
                        $events[$value['id']][$val['id']] = $val['name'];
                    }

                }
            }
        }
        $this->data['events'] = $events;
        $this->render('member/matching/find_matching_view');
    }

    public function create(){
        /**
         * int $target (id of table temp_register)
         * int $event (id of table event)
         * int $current_user_id (id of table users)
         */
        $target = $this->input->get('target');
        $event = $this->input->get('event');
        $current_user_id = $this->ion_auth->user()->row()->id;

        $this->data['target_id'] = $target;
        $this->data['event_id'] = $event;

        if($target && $event){
            /**
             * Temp register data of target
             * Get by target id and event id
             */
            $result = $this->temp_register_model->get_by_id_and_event($target, $event);
            $this->data['result'] = $result;
            /**
             * Temp register data of current user
             * Get by current user id and event id
             */
            $logged_in_result = $this->temp_register_model->get_by_user_id_and_event($current_user_id, $event);

            /**
             * Get current event data
             * In this case, date of current event will be used
             */
            $event_info = $this->event_model->fetch_by_id($event);
            $this->data['event'] = $event_info;

            /**
             * Get all allowed time, which set by admin, by default
             */
            $time_range = build_time_range($event_info['start'], $event_info['duration'], $event_info['step']);

            /**
             * Get matched date time of current user, target user and current event, with Approved | status = 1
             * This result will be remove from above array $time_range to get available time of current user, target user and current event
             */
            $raw_booked_time = $this->matching_model->get_booked_time($current_user_id, $target, $event);
            foreach($raw_booked_time as $key => $datetime){
                $temp_datetime = date('H:i', $datetime['date']);
                if (($key = array_search($temp_datetime, $time_range)) !== false) {
                    unset($time_range[$key]);
                }
            }
            $this->data['time_range'] = array_values($time_range);
        }else{
            redirect('member/matching/find','refresh');
        }

        /**
         * Temp register data of current user, who find matching
         * Get by current user id and event id
         */
        $current = $this->temp_register_model->get_by_user_id_and_event($this->ion_auth->user()->row()->id, $event);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('date','Date','trim|required');

        if($this->form_validation->run() === FALSE) {
            $this->load->helper('form');
            $this->render('member/matching/create_matching_view');
        } else {
            $data = array(
                'finder_id' => $current['id'],
                'target_id' => $target,
                'event_id' => $event,
                'date' => strtotime($this->input->post('date')),
                'note' => $this->input->post('note'),
                'status' => 0, // In create new case, this matching have status = 0
                'created_at' => $this->author_info['created_at'],
            );
            $insert = $this->matching_model->insert($data);
            if($insert){
                $user = $this->ion_auth->user()->row();

                send_mail_matching(self::EMAIL_ADMIN, $data, 'create', 'admin');
                send_mail_matching($result['email'], $data, 'create', 'member');

                redirect('member/dashboard/index','refresh');
            }
            redirect('member/matching/create?target=' . $target . '&event=' . $event,'refresh');
        }
    }

    public function workflow(){
        $status = $this->input->get('status');
        $data = array(
            'status' => $status,
            'log' => ($status == 1) ? self::PARTNER_APPROVE : self::PARTNER_REJECT
        );
        $matching = $this->matching_model->get_by_id($this->input->get('id'));
        $result = $this->matching_model->update($this->input->get('id'), $data);
        if($status == 1 && $result){
            $reject_rest_of_same_time = $this->matching_model->reject_same_time_matching($matching, self::REJECT_BY_ANOTHER_APPROVE);
        }
        if($result){
            $temp_register = $this->temp_register_model->get_by_id($matching['finder_id']);

            if ($temp_register) {
                if ($this->input->get('status') == 1) {
                    send_mail_matching(self::EMAIL_ADMIN, $data, 'approve', 'admin');
                    send_mail_matching($temp_register['email'], $data, 'approve', 'member');
                }else{
                    send_mail_matching($temp_register['email'], $data, 'reject', 'member');
                }
            }

            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 1)));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 0)));
    }

    public function get_info(){
        $id = $this->input->get('id');
        $select = 'address, company, connector, file, overview, position, profile';
        $temp_register = $this->temp_register_model->get_by_id_with_select($id, $select);
        if ($temp_register) {
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('status' => true, 'info' => $temp_register)));
        }
        return $this->output->set_status_header(200)
                ->set_output(json_encode(array('status' => false)));
    }


}
