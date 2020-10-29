<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('information_model');
        $this->load->model('users_model');
    }

    public function index(){
        if($this->data['user_email'] != PIKOM){
            $this->data['total_event'] = $this->event_model->count();
            $this->data['total_active_event'] = $this->event_model->count_active();
            $this->data['users'] = $this->users_model->get_all_user_except_admin();

            $this->render('admin/dashboard_view');
        }else{
            $this->render('admin/dashboard_special_view1');
        }
    }
}