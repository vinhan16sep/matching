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
        $this->load->library('session');

        $this->data['user'] = $this->ion_auth->user()->row();
    }

    public function index() {
        $this->render('member/matching/');
    }

    public function find() {
        $this->data['page_title'] = 'Tìm kiếm';
        $this->load->helper('form');
        $this->render('member/matching/find_matching_view');
    }


}
