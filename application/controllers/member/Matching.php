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
                $register_info = $this->temp_register_model->get_by_email_and_event_id($this->data['user']->email, $event);
                $match_categories[$key]['register_info'] = $register_info;
            }
            $this->data['matched_setting'] = $match_categories;
        }
        $this->data['page_title'] = 'Tìm kiếm';
        $this->render('member/matching/find_matching_view');
    }


}
