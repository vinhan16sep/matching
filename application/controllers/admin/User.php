<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('ion_auth_model');
        $this->load->model('users_model');
        $this->load->model('temp_register_model');
    }

    public function index() {
        
    }

    public function login() {
        if ($this->ion_auth->logged_in()){
            if($this->ion_auth->in_group('admin')){
                redirect('admin/dashboard', 'refresh');
            }else{
                $this->ion_auth->logout();
                redirect('admin/user/login', 'refresh');
            }
        }
        $this->data['page_title'] = 'Login';
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            if ($this->form_validation->run() === TRUE) {
                $remember = (bool) $this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    redirect('admin', 'refresh');
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('admin/user/login', 'refresh');
                }
            }
        }
        $this->load->helper('form');

        $this->render('admin/login_view', 'admin_master');
    }

    public function logout() {
        $this->ion_auth->logout();
        redirect('admin/user/login', 'refresh');
    }

   public function register(){
       if($this->input->post()){
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $event_id = $this->input->post('event_id');

            if ($this->ion_auth->email_check($email)) {
                $user = $this->users_model->get_by_email($email);
                $data = array(
                    'active' => 1,
                    'event_id' => $this->input->post('event_id')
                );
                $result = $this->ion_auth->update($user['id'], $data);
                if($result){
                    $this->temp_register_model->approve($email, $event_id);
                }
            }else{
                $username = null;
                
                $group_ids = array(2);
                $additional_data = array(
                    'active' => 1,
                    'event_id' => $this->input->post('event_id')
                );
                $result = $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
                if($result){
                    $this->temp_register_model->approve($email, $event_id);
                }
            }
            
       }
       $this->session->set_flashdata('success', 'Tạo tài khoản thành công');
       redirect('admin/temp', 'admin_master');
   }
//    public function check_email(){
//        $email = $this->input->post('email');
//        $where = array('email' => $email);
//        $result = $this->ion_auth_model->check_where($where);
//        if($result >=1){
//            $this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại');
//            return FALSE;
//        }
//        return true;
//    }
//
//    public function check_user(){
//        $username = $this->input->post('username');
//        $where = array('username' => $username);
//        $result = $this->ion_auth_model->check_where($where);
//        if($result >=1 ){
//            $this->form_validation->set_message(__FUNCTION__, 'Username đã tồn tại');
//            return FALSE;
//        }
//        return true;
//    }
}
