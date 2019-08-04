<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Request
 * Work base on table setting
 * If user request active their setting, these requests will be shown here
 * Admin can active (if they receive event fee), or not
 */
class Request extends Admin_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('message','You are not allowed to visit the Event setting page');
            redirect('admin','refresh');
        }
        $this->load->model('setting_model');
        $this->load->model('temp_register_model');
        $this->load->helper('email_helper');
    }

    public function index(){
        $this->load->helper('form');
        $this->data['page_title'] = 'Danh sách yêu cầu kích hoạt sự kiện';

        $this->load->library('pagination');
        $this->load->helper('form');

        $keywords = '';
        if($this->input->get('submit')){
            $keywords = trim($this->input->get('code'));
        }
        $this->data['keywords'] = $keywords;
        $total_rows  = $this->setting_model->count_request(2, $keywords);
        $config = array();
        $base_url = base_url('admin/request/index');
        $per_page = 100;
        $uri_segment = 4;

        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
        $this->data['result'] = $this->setting_model->fetch_all_request_pagination($per_page, $per_page * $this->data['page'], 2, $keywords);

        $this->render('admin/request/list_pending_request_view');
    }

    public function approved(){
        $this->load->helper('form');
        $this->data['page_title'] = 'Danh sách đăng ký';

        $this->load->library('pagination');
        $this->load->helper('form');

        $keywords = '';
        if($this->input->get('submit')){
            $keywords = trim($this->input->get('code'));
        }
        $this->data['keywords'] = $keywords;
        $total_rows  = $this->setting_model->count_request(1, $keywords);

        $config = array();
        $base_url = base_url('admin/request/approved');
        $per_page = 100;
        $uri_segment = 4;

        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
        $this->data['result'] = $this->setting_model->fetch_all_request_pagination($per_page, $per_page * $this->data['page'], 1, $keywords);

        $this->render('admin/request/list_approved_request_view');
    }

    public function activate(){
        $params = $this->input->get();
        if(!$params['setting_id']){
            redirect('admin/dashboard/index', 'refresh');
        }
        $email = $params['email'];
        $data = array(
            'status' => 1
        );
        $result = $this->setting_model->update($params['setting_id'], $data);
        if($result){
            $sent_email_member = send_mail($email, array('email' => $email), 'active');
            if (!$sent_email_member) {
                return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Có lỗi trong quá trình gửi E-Mail. Vui lòng thử lại!!!')));
            }
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 1)));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 0)));
    }

    public function show_company($id){
        $temp_register_save = $this->temp_register_model->get_by_user_id_not_join_saved($id);
        $this->data['temp_register'] = $temp_register_save;
        $this->render('member/information/information_view_saved');
    }
}