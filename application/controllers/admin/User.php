<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('ion_auth_model');
        $this->load->model('users_model');
        $this->load->model('temp_register_model');
        $this->load->model('event_model');
        $this->load->helper('common_helper');
        $this->load->helper('email_helper');
    }

    public function index() {

    }

    public function login() {
        if ($this->ion_auth->logged_in()){
            if($this->ion_auth->in_group('admin')){
                redirect('admin/dashboard', 'refresh');
            }else{
                $this->ion_auth->logout();
                $this->session->set_flashdata('message', 'Tài khoản không có quyền đăng nhập');
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

    public function logout($messages = null) {
        $this->ion_auth->logout();
        if (!is_null($messages)) {
            $this->session->set_flashdata('message', $messages);
            
        }
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
                    $this->temp_register_model->approve_and_set_user_id($email, $event_id, $result);
                }
            }

        }
        $this->session->set_flashdata('success', 'Tạo tài khoản thành công');
        redirect('admin/temp', 'admin_master');
    }

    public function lock_account(){
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        
        if ($status == 'false') {
            $data = array(
                'is_active' => 0
            );
            $result = $this->event_model->update($id, $data);
            if ($result) {
                $users = $this->users_model->get_by_event_id($id);
                // $user_ids = array_helper_get_column('id', $users);
                if ($users) {
                    foreach ($users as $key => $value) {
                        $data = array(
                            'active' => 0,
                        );
                        $update = $this->ion_auth->update($value['id'], $data);
                        if ($update) {
                            send_mail($value['email'], ['event_name' => $value['event_name']], 'look');
                        }
                    }
                }
            }
        }else{
            $data = array(
                'is_active' => 1
            );
            $result = $this->event_model->update($id, $data);
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('status' => true)));
    }

    // change password
    public function change_password(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()){
            redirect('admin/user/login', 'refresh');
        }
        if (!$this->ion_auth->in_group('admin')) {
            $this->ion_auth->logout();
            $this->session->set_flashdata('login_message_error', 'Tài khoản không có quyền truy cập');
            redirect('admin/user/login');
        }
        $user = $this->ion_auth->user()->row();
        $this->data['user_id'] = $user->id;

        $this->form_validation->set_rules('old_password','Mật khẩu cũ','trim|required',
            array(
                'required' => '%s không được trống.'
            )
        );

        $this->form_validation->set_rules('new_password','Mật khẩu mới','trim|min_length[8]|max_length[20]|required',
            array(
                'required' => '%s không được trống.',
                'min_length' => '%s phải nhiều hơn %s ký tự',
                'max_length' => '%s phải ít hơn %s ký tự',
            )
        );
        $this->form_validation->set_rules('new_confirm','Xác nhận mật khẩu mới','trim|matches[new_password]|required',
            array(
                'required' => '%s không được trống.',
                'matches' => '%s không giống với %s',
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->data['the_view_content'] = $this->load->view('admin/change_password_view', $this->data, TRUE);
            $this->load->view('templates/admin_master_view.php', $this->data);
            // $this->render('admin/change_password_view');
        } else {
            if ($this->input->post()) {
                $identity = $this->session->userdata('identity');
                $change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));
                if ($change){
                //if the password was successfully changed
                    $this->logout('Đổi mật khẩu thành công. Vui lòng đăng nhập lại!');
                    
                    // redirect('admin/user/login');
                    
                }else{
                    $this->session->set_flashdata('auth_message_error', 'Mật khẩu không đúng vui lòng kiểm tra lại');
                    redirect('admin/user/change_password', 'refresh');
                }
            }
        }  
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
