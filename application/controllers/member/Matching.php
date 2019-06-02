<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Matching extends Member_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('members')) {
            //redirect them to the login page
            redirect('member/user/login', 'refresh');
        }

        $this->load->helper('url');
        $this->load->model('matching_model');
        $this->load->model('event_model');
        $this->load->model('setting_model');
        $this->load->model('temp_register_model');
        $this->load->model('users_model');
        $this->load->model('category_model');
        $this->load->library('session');
        $this->load->helper('form');

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


}
