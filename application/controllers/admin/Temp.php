<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp extends Admin_Controller
{

    function __construct(){
        parent::__construct();
        if(!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('message','You are not allowed to visit the Event setting page');
            redirect('admin','refresh');
        }
        $this->load->model('temp_register_model');
    }

    public function index(){
        $this->load->helper('form');
        $this->data['page_title'] = 'Danh sách đăng ký';

        $this->load->library('pagination');
        $total_rows  = $this->temp_register_model->count();
        $config = array();
        $base_url = base_url('admin/temp/index');
        $per_page = 100;
        $uri_segment = 4;

        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
        $this->data['result'] = $this->temp_register_model->fetch_all_pagination($per_page, $per_page * $this->data['page']);

        $this->render('admin/temp/list_temp_view');
    }
}