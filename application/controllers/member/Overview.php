<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends Member_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('temp_register_model');

	}

	// List all your items
	public function index(){
	    $this->data['page_title'] = 'Danh sách thông tin đã đăng ký cho từng sự kiện';
		$user = $this->ion_auth->user()->row();
        $this->data['temp_register'] = $temp_register = $this->temp_register_model->get_by_user_id($user->id);
		$this->render('member/overview/list_overview_view');
	}

	// Add a new item
	public function manage()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$user = $this->ion_auth->user()->row();

        $params = $this->input->get();
        if(!$params['event_id']){
            redirect('member/dashboard/index', 'refresh');
        }
        $this->data['event_id'] = $event_id = $params['event_id'];

		$temp_register = $this->temp_register_model->get_by_user_id_and_event($user->id, $event_id);
		if (!$temp_register) {
			redirect('member/overview');
		}
        $this->data['page_title'] = 'Thông tin doanh nghiệp cho sự kiện ' . $temp_register['eventName'];
		$extension = $temp_register['id'] . '-' . $event_id;

		$this->form_validation->set_rules('overview', 'Giới thiệu ngắn về Doanh nghiệp ', 'required');
		$this->form_validation->set_rules('profile', 'Lĩnh vực hoạt động', 'required');
		$this->form_validation->set_rules('product', 'Sản phẩm/Giải pháp', 'required');
		$this->form_validation->set_rules('market', 'Thị trường chính hiện nay', 'required');
		$this->form_validation->set_rules('partner', 'Đối tác chiến lược', 'required');
		$this->form_validation->set_rules('customer', 'Khách hàng tiêu biểu', 'required');
		$this->form_validation->set_rules('certificate', 'Các chứng chỉ, bằng cấp đạt được (ISO, CMMI...)', 'required');
		$this->form_validation->set_rules('desire', 'Mong muốn hợp tác', 'required');
		if ($temp_register['is_overview'] == 0) {
//			$this->form_validation->set_rules('file', 'File PDF', 'callback_validate_file');
		}
		

		if ($this->form_validation->run() == FALSE) {
			if ($temp_register['is_overview'] == 0) {
				$this->render('member/overview/create_overview_view');
			}else{
				$this->data['temp_register'] = $temp_register;
				$this->render('member/overview/edit_overview_view');
			}
			
		} else {
			if ($this->input->post()) {
				if(!empty($_FILES['file']['name'])){
                    $this->check_file($_FILES['file']['name'], $_FILES['file']['size']);
                }
                if(!file_exists('assets/upload/profile')){
                    mkdir('assets/upload/profile', 0777);
                }
                if ( !empty($_FILES['file']['name']) ) {
                    chmod('assets/upload/profile', 0777);
                    $file = $this->upload_file_pdf('file', 'assets/upload/profile', $_FILES['file']['name'], $extension);
                }

                $data = array(
                    'overview' => $this->input->post('overview'),
                    'profile' => $this->input->post('profile'),
                    'product' => $this->input->post('product'),
                    'market' => $this->input->post('market'),
                    'partner' => $this->input->post('partner'),
                    'customer' => $this->input->post('customer'),
                    'certificate' => $this->input->post('certificate'),
                    'desire' => $this->input->post('desire'),
                    'website' => $this->input->post('website'),
                    'is_overview' => 1,
                );
                if ( !empty($_FILES['file']['name']) ) {
                    $data['file'] = $file;
                }
                $update = $this->temp_register_model->update($temp_register['id'], $data);
                if ($update) {
                    $this->session->set_flashdata('message_success', 'Lưu thông tin thành công');
                    redirect('member/overview', 'refresh');
                }else{
                    $this->session->set_flashdata('message_error', 'Có lỗi trong quá trình lưu thông tin');
                    redirect('member/overview/manage?event_id=' . $event_id);
                }
			}
		}
	}

	protected function check_file($filename, $filesize){
        $reponse = array(
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        if($fileextension != 'pdf' || $filesize > 20971520){
            $this->session->set_flashdata('message_error', sprintf(MESSAGE_PHOTOS_ERROR, 20));
            redirect('member/overview/create');
        }
    }

	public function validate_file(){
        $this->form_validation->set_message(__FUNCTION__, 'Vui lòng chọn file PDF.');
        if (!empty($_FILES['file']['name'][0])) {
            return true;
        }
        return false;
    }
}

/* End of file Overview.php */
/* Location: ./application/controllers/member/Overview.php */
