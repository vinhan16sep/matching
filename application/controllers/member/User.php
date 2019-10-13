<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    const EMAIL_ADMIN = 'minhmc@vinasa.org.vn';

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('ion_auth_model');
        $this->load->model('temp_register_model');
        $this->load->model('event_model');
        $this->load->helper('email_helper');
    }


    public function login($lang = false) {
        // if ($this->ion_auth->logged_in()){
        //     redirect('member/dashboard', 'refresh');
        //     if($this->ion_auth->in_group('members')){
        //         redirect('member/dashboard', 'refresh');
        //     }else{
        //         $this->ion_auth->logout();
        //         redirect('member/user/login', 'refresh');
        //     }
        // }
        if($lang == 'en'){
            $langName = 'english';
            $this->config->set_item('language', $langName);
            $this->session->set_userdata("langAbbreviation",'en');
            $this->lang->load('english_lang', 'english');
        }

        if($lang == 'vi'){
            $langName = 'vietnamese';
            $this->config->set_item('language', $langName);
            $this->session->set_userdata("langAbbreviation",'vi');
            $this->lang->load('vietnamese_lang', 'vietnamese');
        }
        $this->data['page_title'] = 'Login';
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('identity', 'Tài khoản', 'required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            if ($this->form_validation->run() === TRUE) {
                $remember = (bool) $this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    redirect('member', 'refresh');
                } else {
                    $this->session->set_flashdata('login_message_error', $this->ion_auth->errors());
                    redirect('member/user/login', 'refresh');
                }
            }
        }
        $this->load->helper('form');

        // $this->render('member/login_view', 'member_master');
        $this->load->view('member/login_view');
    }

    public function logout($messages = null) {
        $this->ion_auth->logout();
        if (!is_null($messages)) {
            $this->session->set_flashdata('auth_message', $messages);
        }
        redirect('member/user/login', 'refresh');
    }

    public function register(){
        $this->data['page_title'] = 'Register';
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_rules('company', 'Company Name', 'required');
        $this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cf_password', 'Confirm Password', 'required|matches[password]');

        if($this->form_validation->run()===FALSE) {
            $this->load->helper('form');
            $this->load->view('member/register_view');
        } else {
            if ( $this->input->post() ) {
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $group_ids = array(2);

                $additional_data = array(
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone')
                );
                $result = $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
                if($result){
                    redirect('member/user/welcome','refresh');
                }else{
                    $this->session->set_flashdata('error', REGISTER_COMPANY_ERROR);
                    redirect('member/user/register');
                }
            }
        }
    }


    public function register1(){
        $this->load->library('form_validation');

        $events = $this->get_events();

        $this->form_validation->set_rules('company','Tên Công Ty','trim');
        $this->form_validation->set_rules('company','Tên Công Ty','trim|required', array(
                'required' => '%s không được trống.',
            ));
        // $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[temp_register.email]', array(
        //         'required' => '%s không được trống.',
        //     ));
        $this->form_validation->set_rules('email','Email','trim|required|valid_email', array(
                'required' => '%s không được trống.',
                'valid_email' => 'Định dạng email không đúng.',
            ));
        $this->form_validation->set_rules('phone', $this->lang->line('Mobile'),'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
        $this->form_validation->set_rules('position','Chức Danh','required', array(
                'required' => '%s không được trống.',
            ));
        $this->form_validation->set_rules('address','Địa Chỉ','required', array(
                'required' => '%s không được trống.',
            ));
        $this->form_validation->set_rules('connector','Người Đại Diện','required', array(
                'required' => '%s không được trống.',
            ));
        $this->form_validation->set_rules('event_id','Sự Kiện','required', array(
                'required' => '%s không được trống.',
            ));

        if($this->form_validation->run()===FALSE) {
            $this->load->helper('form');
            $this->load->view('member/register_view', array('events' => $events));
            // $this->render('member/login_view', 'member_master');
        } else {
            if ( $this->input->post() ) {
                $params = $this->input->post();
                $check_account = $this->temp_register_model->get_by_email_and_event_id($params['email'], $params['event_id']);
                if ($check_account) {
                    $this->session->set_flashdata('error', 'E-Mail sử dụng đã đăng ký với một sự kiện đang diễn ra. Vui lòng sử dụng E-Mail khác!');
                    redirect('member/user/register');
                }
                $code = $this->check_code( substr(uniqid(),0,8) );
                $data = array(
                    'company' => $params['company'],
                    'connector' => $params['connector'],
                    'position' => $params['position'],
                    'phone' => $params['phone'],
                    'address' => $params['address'],
                    'email' => $params['email'],
                    'code' => $code,
                    'event_id' => $params['event_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                );
                $this->db->trans_begin();
                $insert = $this->temp_register_model->save($data);
                if ($insert) {
                    $email_data = array(
                        'company' => $params['company'],
                        'connector' => $params['connector'],
                        'position' => $params['position'],
                        'phone' => $params['phone'],
                        'email' => $params['email'],
                        'address' => $params['address'],
                        'code' => $code,
                    );
                    $email = send_mail($params['email'], $email_data, 'user_temp_register');

                    if (!$email) {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('error', SEND_CODE_ERROR);
                    }else{
                        $this->db->trans_commit();
                        $email_admin = send_mail(self::EMAIL_ADMIN, $email_data, 'admin');
                        $this->session->set_flashdata('success', SEND_CODE_SUCCESS);
                    }
                    redirect('member/user/welcome','refresh');
                }else{
                    $this->session->set_flashdata('error', REGISTER_COMPANY_ERROR);
                    redirect('member/user/register');
                }

            }
        }
    }

    private function get_events(){
        $events = $this->event_model->fetch_all_by_active();
        $result = array(
            '' => 'Chọn sự kiện'
        );
        if ($events) {
            foreach ($events as $key => $value) {
                $result[$value['id']] = $value['name'];
            }
        }
        return $result;
    }

    private function check_code($code){
        $where = array(
            'code' => $code
        );
        $check_code = $this->temp_register_model->find_row_array($where);

        if ( $check_code > 0 ) {
            $new_code = substr(uniqid(),0,8);
            return $this->check_code($new_code);
        }
        return $code;
    }

    public function welcome(){
        $this->load->view('member/welcome_view');
    }


    // change password
    public function change_password(){$this->load->model('temp_register_model');
        $user = $this->ion_auth->user()->row();
        $this->data['user_email'] = $user->email;
        $this->data['current_user_temp_register'] = $this->temp_register_model->get_by_user_id($user->id);

        $this->data['page_title'] = 'Đổi mật khẩu';
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()){
            redirect('member/user/login', 'refresh');
        }
        if (!$this->ion_auth->in_group('members')) {
            $this->ion_auth->logout();
            $this->session->set_flashdata('login_message_error', 'Tài khoản không có quyền truy cập');
            redirect('member/user/login');
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
            $this->data['the_view_content'] = $this->load->view('member/change_password_view', $this->data, TRUE);
            $this->load->view('templates/member_master_view.php', $this->data);
            // $this->render('member/change_password_view');
        } else {
            if ($this->input->post()) {
                $identity = $this->session->userdata('identity');
                $change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));
                if ($change){
                //if the password was successfully changed
                    $this->logout('Đổi mật khẩu thành công. Vui lòng đăng nhập lại!');
                    
                    // redirect('member/user/login');
                    
                }else{
                    $this->session->set_flashdata('auth_message_error', 'Mật khẩu không đúng vui lòng kiểm tra lại');
                    redirect('member/user/change_password', 'refresh');
                }
            }
        }  
    }

    public function forgot_password(){
        if ($this->ion_auth->logged_in()) {
            redirect('member/dashboard', 'refresh');
        }
        $this->load->library('ion_auth');
        $this->load->library('email');
        $user = $this->ion_auth->user()->row();
        // print_r($user);die;
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email','Email','trim|valid_email|required',
            array(
                'required' => '%s không được trống.',
                'valid_email' => 'Định dạng %s không đúng'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('member/forgot_password_view');
        } else {
            if($this->input->post()){
                $email = $this->input->post('email');
                if (!$this->ion_auth->email_check($email)){
                    $this->session->set_flashdata('auth_message','Email không đúng. Vui lòng kiểm tra lại');
                    return redirect('member/user/forgot_password');
                }
                $forgotten = $this->ion_auth->forgotten_password($email, 'member');

                // $config = [
                //     'protocol' => 'smtp',
                //     'smtp_host' => 'ssl://smtp.googlemail.com',
                //     'smtp_port' => 465,
                //     'smtp_user' => 'nghemalao@gmail.com',
                //     'smtp_pass' => 'Huongdan1',
                //     'smtp_port' => '465',
                //     'mailtype' => 'html'
                // ];
                // $data = array(
                //     'identity'=>$forgotten['identity'],
                //     'forgotten_password_code' => $forgotten['forgotten_password_code'],
                // );
                // $this->load->library('email');
                // $this->email->initialize($config);
                // $this->load->helpers('url');
                // $this->email->set_newline("\r\n");

                // // $this->email->from('nghemalao@gmail.com');
                // // $this->email->to($email);
                // // $this->email->subject("forgot password");
                // $body = $this->load->view('auth/email/forgot_password.tpl.php',$data,TRUE);
                // $this->email->message($body);

                if ($forgotten) {
                    $this->session->set_flashdata('auth_message','Đã gửi Email thành công. Vui lòng kiểm tra Email!');
                    return redirect('member/user/login');
                }
            }
        }
        
    }
    public function reset_password($code){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->library('email');

        $this->form_validation->set_rules('password','Mật Khẩu','trim|min_length[8]|max_length[20]|required',
            array(
                'required' => '%s không được trống.',
                'min_length' => '%s phải nhiều hơn %s ký tự',
                'max_length' => '%s phải ít hơn %s ký tự',
            )
        );
        $this->form_validation->set_rules('confirm_password','Xác Nhận Mật Khẩu','trim|matches[password]|required',
            array(
                'required' => '%s không được trống.',
                'matches' => '%s không giống với %s',
            )
        );

        $user = $this->ion_auth->forgotten_password_check($code);
        if(!$user){
            $this->load->view('404');
        }
        else{
            if ($this->form_validation->run() == FALSE) {
                $this->data['csrf'] = $this->security->get_csrf_hash();
                $this->data['code'] = $code;
                $this->load->view("member/reset_password_view", $this->data);
            } else {
                if($this->input->post()){
                    if ($user){
                        $reset = $this->ion_auth->forgotten_password_complete($code);
                        if ($reset) {  //if the reset worked then send them to the login page
                            $data = array('password' => $this->input->post('password'));
                            if($this->ion_auth->update($user->id, $data)){
                                $this->ion_auth->clear_forgotten_password_code($code);
                                $this->session->set_flashdata('auth_message', $this->ion_auth->messages());
                                redirect("member/user/login", 'refresh');
                            }else{
                                redirect('member/user/reset_password/' . $code, 'refresh');
                            }
                            
                        }
                        else { //if the reset didnt work then send them back to the forgot password page
                            $this->session->set_flashdata('auth_message', $this->ion_auth->errors());
                            redirect("member/user/forgot_password", 'refresh');
                        }
                    }
                }
            }
        }
    }

    public function check_email(){
        $email = $this->input->post('email');
        $result = $this->ion_auth_model->email_check($email);
        if($result >=1){
            $this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại');
            return FALSE;
        }
        return true;
    }

    public function check_user(){
        $username = $this->input->post('username');
        $where = array('username' => $username);
        $result = $this->ion_auth_model->check_where($where);
        if($result >=1 ){
            $this->form_validation->set_message(__FUNCTION__, 'Username đã tồn tại');
            return FALSE;
        }
        return true;
    }

    public function activate($id, $code = FALSE, $lang = 'vi')
    {
        if ($code !== FALSE)
        {
            $activation = $this->ion_auth->activate($id, $code);
        }
        else if ($this->ion_auth->is_admin())
        {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation)
        {
            // redirect them to the auth page
            $this->session->set_flashdata('register_success', $this->ion_auth->messages());
            redirect("member/user/login/" . $lang, 'refresh');
        }
        else
        {
            // redirect them to the forgot password page
            $this->session->set_flashdata('auth_message', $this->ion_auth->errors());
            redirect("member/user/forgot_password", 'refresh');
        }
    }
}
