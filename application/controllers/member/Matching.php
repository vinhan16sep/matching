<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Matching extends Member_Controller {

    const APPROVE = 1;
    const REJECT = 2;
    const REJECT_BY_ANOTHER_APPROVE = 3;
    const EMAIL_ADMIN = 'minhmc@vinasa.org.vn';
    const EMAIL_ADMIN_LOCAL = 'minhtruong93gtvt@gmail.com';

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
        $params = $this->input->get();
        if(!$params['event_id']){
            redirect('member/dashboard/index', 'refresh');
        }
        $this->data['event_id'] = $event_id = $params['event_id'];
        $user = $this->ion_auth->user()->row();

        $this->data['setting'] = $setting = $this->event_model->verify_charge_status($event_id, $user->id);
        if(!isset($setting)){
            redirect('member/dashboard/index', 'refresh');
        }
        if($setting['status'] == 0){
            $this->render('member/matching/verify_matching_view');
        }else if($setting['status'] == 2){
            $this->render('member/matching/verify_matching_view');
        }else{
            $this->data['page_title'] = $this->lang->line('Matching Management');
            $event_info = $this->event_model->fetch_by_id($event_id);
            $this->data['event'] = $event_info;
            $time_range = build_time_range($event_info['start'], $event_info['duration'], $event_info['step']);
            $this->data['time_range'] = array_values($time_range);

            /**
             * Temp register of current user
             */
            $temp_register = $this->temp_register_model->get_by_user_id_with_active_event($user->id);

            /**
             * Get all received matching from others
             */
            $receive = $this->matching_model->get_receive_request_by_temp_register_id_and_event($temp_register['id'], $event_id);
            foreach($receive as $key => $value){
                /**
                 * Get data of target of matching
                 */
                $register_info = $this->temp_register_model->get_by_temp_register_id_and_event_id($value['finder_id']);
                $receive[$key]['register_info'] = $register_info;
            }

            /**
             * Get all matching sent by current user
             */
            $send = $this->matching_model->get_send_request_by_temp_register_id_and_event($temp_register['id'], $event_id);
            foreach($send as $key => $value){
                /**
                 * Get data of target of matching
                 */
                $register_info = $this->temp_register_model->get_by_temp_register_id_and_event_id($value['target_id']);
                $send[$key]['register_info'] = $register_info;
            }

            $this->data['receive'] = $receive;
            $this->data['send'] = $send;
            $this->render('member/matching/list_matching_view');
        }
    }

    public function find() {
        $params = $this->input->get();
        if(!$params['event_id']){
            redirect('member/dashboard/index', 'refresh');
        }
        $this->data['event_id'] = $event_id = $params['event_id'];

        if($this->input->get() && $this->input->get('submit')){
            $get = $this->input->get();
            if(!isset($get['category_id'])){
                redirect('member/matching/find?event_id=' . $event_id, 'refresh');
            }
            $match_categories = $this->setting_model->get_matched_setting_data($event_id, $get['category_id'], $this->data['user']->id);
            foreach($match_categories as $key => $value){
                $target_user = $this->users_model->fetch_by_id($value['user_id']);
                $target_user_id = $value['user_id'];
                $register_info = $this->temp_register_model->get_by_user_id($target_user_id);
                $match_categories[$key]['register_info'] = $register_info;
            }
            $this->data['matched_setting'] = $match_categories;
        }
        $this->data['page_title'] = $this->lang->line('Find partner');
        $category_root = $this->category_model->fetch_all_root_by_event($event_id);
        $events = array();
        if ($category_root) {
            foreach ($category_root as $key => $value) {
                $events[$value['id']]['name'] = $value['name'];
                $category_sub = $this->category_model->fetch_all_sub_by_event_and_parent($event_id, $value['id']);
                if ($category_sub) {
                    foreach ($category_sub as $k => $val) {
                        $childs = $this->category_model->fetch_all_sub_by_event_and_parent($event_id, $val['id']);
                        if ($childs) {
                            foreach ($childs as $item => $child) {
                                $events[$value['id']][$val['id']]['name'] = $val['name'];
                                $events[$value['id']][$val['id']][$child['id']] = $child['name'];
                            }
                        }else{
                            $events[$value['id']][$val['id']] = $val['name'];
                        }
                    }
                }
            }
        }
        $this->data['events'] = $events;
        $this->render('member/matching/find_matching_view');
    }

    public function create(){
        $this->data['page_title'] = $this->lang->line('Matching page');
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
            $logged_in_result = $this->temp_register_model->get_by_user_id($current_user_id);

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
        $user = $this->ion_auth->user()->row();
        $current = $this->temp_register_model->get_by_user_id_with_active_event($user->id);

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
                'place' => $this->input->post('place'),
                'status' => 0, // In create new case, this matching have status = 0
                'created_at' => $this->author_info['created_at'],
            );
            $insert = $this->matching_model->insert($data);
            if($insert){
                $user = $this->ion_auth->user()->row();
                $event_data = $this->event_model->fetch_by_id($event);
                $user_target = $this->temp_register_model->get_by_id($target);
                $data_send_mail = array(
                    'finder_name' => $user->company,
                    'target_name' => $user_target['company'],
                    'date' => $this->input->post('date'),
                    'event_id' => $event,
                    'data_event' => $event_data,
                );

                send_mail_matching(self::EMAIL_ADMIN, $data_send_mail, 'create', 'admin');
                send_mail_matching($result['email'], $data_send_mail, 'create', 'member');

                redirect('member/matching/index?event_id=' . $event,'refresh');
            }
            redirect('member/matching/create?target=' . $target . '&event=' . $event,'refresh');
        }
    }

    public function workflow(){
        $status = $this->input->get('status');
        $reason = $this->input->get('reason');
        $data = array(
            'status' => $status,
            'log' => ($status == 1) ? self::APPROVE : self::REJECT
        );
        if ($status) {
            $data['note'] = $reason;
        }
        $matching = $this->matching_model->get_by_id($this->input->get('id'));
        if(!empty($matching['event_id'])){
            $event_data = $this->event_model->fetch_by_id($matching['event_id']);
        }else{
            $event_data = array();
        }
        
        
        $result = $this->matching_model->update($this->input->get('id'), $data);
        if($status == 1 && $result){
            $reject_rest_of_same_time = $this->matching_model->reject_same_time_matching($matching, self::REJECT_BY_ANOTHER_APPROVE);
        }
        if($result){
            $temp_register = $this->temp_register_model->get_by_id($matching['finder_id']);

            if ($temp_register) {
                $user = $this->ion_auth->user()->row();
                $user_finder = $this->temp_register_model->get_by_id($matching['finder_id']);
                $data_send_mail = array(
                    'finder_name' => $user_finder['company'],
                    'target_name' => $user->company,
                    'date' => date('H:i d/m/Y', $matching['date']),
                    'reason' => $reason,
                    'website' => $user_finder['website'],
                    'data_event' => $event_data,
                );
                
                if ($this->input->get('status') == 1) {
                    send_mail_matching(self::EMAIL_ADMIN, $data_send_mail, 'approve', 'admin');
                    send_mail_matching($temp_register['email'], $data_send_mail, 'approve', 'member');
                }else{
                    send_mail_matching($temp_register['email'], $data_send_mail, 'reject', 'member');
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
        $temp_register = $this->temp_register_model->get_by_id_with_select($id);
        if ($temp_register) {
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('status' => true, 'info' => $temp_register)));
        }
        return $this->output->set_status_header(200)
                ->set_output(json_encode(array('status' => false)));
    }

    public function active(){
        $params = $this->input->get();
        if(!$params['event_id']){
            redirect('member/dashboard/index', 'refresh');
        }
        $code = $this->uniqidReal();
        $this->data['event_id'] = $event_id = $params['event_id'];
        $user = $this->ion_auth->user()->row();
        $temp_register = $this->temp_register_model->get_by_user_id($user->id);
        $request = $this->event_model->request_active($event_id, $user->id, $code);
        
        if($request){
            $data = array(
                'email' => $user->email
            );
            if ($temp_register['is_state'] == 0) {
                $data['code'] = $code;
            }else{
                $data['code'] = 'free';
            }
            $email_admin = base_url() == 'http://localhost/matching/' ? self::EMAIL_ADMIN_LOCAL : self::EMAIL_ADMIN ;
            $sent_email_admin = send_mail($email_admin, $data, 'admin');

            if ($temp_register['is_state'] == 0) {
                $sent_email_member = send_mail($user->email, $data, 'user_temp_register',$this->lang->line('detector'));
                if (!$sent_email_member) {
                    return $this->output->set_status_header(200)
                    ->set_output(json_encode(array(
                        'message' => 'Có lỗi trong quá trình gửi email xác nhận',
                        'code' => '',
                        'email' => ''
                    )));
                }
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array(
                        'message' => 1,
                        'code' => $code,
                        'email' => $user->email
                    )));
            }else{
                $sent_email_member = send_mail($user->email, $data, 'free');
                if (!$sent_email_member) {
                    return $this->output->set_status_header(200)
                    ->set_output(json_encode(array(
                        'message' => 'Có lỗi trong quá trình gửi email xác nhận',
                        'code' => '',
                        'email' => ''
                    )));
                }
                return $this->output->set_status_header(200)
                    ->set_output(json_encode(array(
                        'message' => 1,
                        'code' => 'free',
                        'email' => $user->email
                    )));
            }
            
        }else{
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array(
                    'message' => 0,
                    'code' => '',
                    'email' => ''
                )));
        }
    }

    public function uniqidReal($length = 5) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $length);
    }
}
