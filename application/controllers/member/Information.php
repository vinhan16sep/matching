<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends Member_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('temp_register_model');
        $this->load->model('matching_model');
    }

    public function index(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['page_title'] = 'Thông tin doanh nghiệp';
        $user = $this->ion_auth->user()->row();
        $this->data['company'] = $user->company;
        $temp_register_save = $this->temp_register_model->get_by_user_id_not_join_saved($user->id);

        /*================================
        =            Validate            =
        ================================*/
        
        
        $this->form_validation->set_rules('company', 'Tên Doanh Nghiệp', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('address', 'Địa Chỉ', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('website', 'Website', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('manpower', 'Số Nhân lực', 'required|numeric', array(
            'required' => '%s không được trống!',
            'numeric' => '%s phải là số'
        ));
        $this->form_validation->set_rules('revenue', 'Doanh Thu Năm ' . (date("Y") - 1) , 'required|numeric', array(
            'required' => '%s không được trống!',
            'numeric' => '%s phải là số'
        ));
        $this->form_validation->set_rules('product', 'Sản Phẩm/Giải Pháp', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('profile', 'Lĩnh Vực/Dịch Vụ Hoạt Động', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('market', 'Thị Trường Chính Hiện Nay', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('connector', 'Tên Người Đại Diện Pháp Luật', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('email', 'E-Mail', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('phone', 'Điện Thoại', 'required|numeric', array(
            'required' => '%s không được trống!',
            'numeric' => '%s phải là số'
        ));
        
        /*=====  End of Validate  ======*/


        if (empty($temp_register_save) || $this->input->get('edit') == 1) {
            $this->data['temp'] = $check_temp_register = $this->temp_register_model->get_by_user_id_not_join($user->id);
            if (!isset($check_temp_register) || empty($check_temp_register['logo'])) {
                $this->form_validation->set_rules('logo', 'Logo', 'callback_validate_file');
            }
            if ($this->input->post()) {
                $data = array(
                    'company' => $user->company,
                    'address' => $this->input->post('address'),
                    'website' => $this->input->post('website'),
                    'manpower' => $this->input->post('manpower'),
                    'revenue' => $this->input->post('revenue'),
                    'product' => $this->input->post('product'),
                    'profile' => $this->input->post('profile'),
                    'market' => $this->input->post('market'),
                    'connector' => $this->input->post('connector'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'is_state' => $this->input->post('is_state'),
                    'user_id' => $user->id,
                );
                if ($this->input->post('submit') == 'Lưu Thông Tin') {
                    if ($this->form_validation->run() == FALSE) {
                        $this->render('member/information/information_detail_view');
                    }else{
                        if(!empty($_FILES['logo']['name'])){
                            $this->check_image($_FILES['logo']['name'], $_FILES['logo']['size']);
                        }
                        if(!empty($_FILES['file']['name'])){
                            $this->check_file($_FILES['file']['name'], $_FILES['file']['size']);
                        }
                        if(!file_exists('assets/upload/profile')){
                            mkdir('assets/upload/profile', 0777);
                        }
                        if ( !empty($_FILES['logo']['name']) ) {
                            chmod('assets/upload/profile', 0777);
                            $logo = $this->upload_avatar('logo', 'assets/upload/profile', $_FILES['logo']['name']);
                        }
                        if ( !empty($_FILES['file']['name']) ) {
                            chmod('assets/upload/profile', 0777);
                            $file = $this->upload_file_pdf('file', 'assets/upload/profile', $_FILES['file']['name']);
                        }
                        if ( isset($logo) && !empty($logo) ) {
                            $data['logo'] = $logo;
                        }
                        if ( !empty($_FILES['file']['name']) ) {
                            $data['file'] = $file;
                        }
                        $data['is_saved'] = 1;
                        
                        if (empty($check_temp_register)) {
                            $save = $this->temp_register_model->save($data);
                        }else{
                            $save = $this->temp_register_model->update($check_temp_register['id'], $data);
                        }
                        if ($save) {
                            $this->session->set_flashdata('message_success', 'Lưu thông tin thành công');
                            redirect('member/information', 'refresh');
                        }
                    }
                }else{
                    if(!empty($_FILES['logo']['name'])){
                        $this->check_image($_FILES['logo']['name'], $_FILES['logo']['size']);
                    }
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name'], $_FILES['file']['size']);
                    }
                    if(!file_exists('assets/upload/profile')){
                        mkdir('assets/upload/profile', 0777);
                    }
                    if ( !empty($_FILES['logo']['name']) ) {
                        chmod('assets/upload/profile', 0777);
                        $logo = $this->upload_avatar('logo', 'assets/upload/profile', $_FILES['logo']['name']);
                    }
                    if ( !empty($_FILES['file']['name']) ) {
                        chmod('assets/upload/profile', 0777);
                        $file = $this->upload_file_pdf('file', 'assets/upload/profile', $_FILES['file']['name']);
                    }
                    if ( isset($logo) && !empty($logo) ) {
                        $data['logo'] = $logo;
                    }
                    if ( !empty($_FILES['file']['name']) ) {
                        $data['file'] = $file;
                    }
                    $data['is_saved'] = 0;
                    
                    if (empty($check_temp_register)) {
                        $save = $this->temp_register_model->save($data);
                    }else{
                        $save = $this->temp_register_model->update($check_temp_register['id'], $data);
                    }
                    if ($save) {
                        $this->session->set_flashdata('message_success', 'Thông tin tạm thời được lưu');
                        redirect('member/information', 'refresh');
                    }
                }
            }else{
                $this->render('member/information/information_detail_view');
            }
        }else{
            $this->data['temp_register'] = $temp_register_save;
            $this->render('member/information/information_view_saved');
        }
        
    }

    public function edit($id=''){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['page_title'] = 'Cập nhật thông tin doanh nghiệp';
        $user = $this->ion_auth->user()->row();
        $this->data['company'] = $user->company;
        $this->data['temp'] = $check_temp_register = $this->temp_register_model->get_by_user_id_not_join($user->id);

        /*================================
        =            Validate            =
        ================================*/
        
        
        $this->form_validation->set_rules('company', 'Tên Doanh Nghiệp', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('address', 'Địa Chỉ', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('website', 'Website', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('manpower', 'Số Nhân lực', 'required|numeric', array(
            'required' => '%s không được trống!',
            'numeric' => '%s phải là số'
        ));
        $this->form_validation->set_rules('revenue', 'Doanh Thu Năm ' . (date("Y") - 1) , 'required|numeric', array(
            'required' => '%s không được trống!',
            'numeric' => '%s phải là số'
        ));
        $this->form_validation->set_rules('product', 'Sản Phẩm/Giải Pháp', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('profile', 'Lĩnh Vực/Dịch Vụ Hoạt Động', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('market', 'Thị Trường Chính Hiện Nay', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('connector', 'Tên Người Đại Diện Pháp Luật', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('email', 'E-Mail', 'required', array(
            'required' => '%s không được trống!'
        ));
        $this->form_validation->set_rules('phone', 'Điện Thoại', 'required|numeric', array(
            'required' => '%s không được trống!',
            'numeric' => '%s phải là số'
        ));
        
        /*=====  End of Validate  ======*/

        if ($this->form_validation->run() == FALSE) {
            $this->render('member/information/information_edit_view');
        } else {
            if ($this->input->post()) {
                if(!empty($_FILES['logo']['name'])){
                    $this->check_image($_FILES['logo']['name'], $_FILES['logo']['size']);
                }
                if(!empty($_FILES['file']['name'])){
                    $this->check_file($_FILES['file']['name'], $_FILES['file']['size']);
                }
                if(!file_exists('assets/upload/profile')){
                    mkdir('assets/upload/profile', 0777);
                }
                if ( !empty($_FILES['logo']['name']) ) {
                    chmod('assets/upload/profile', 0777);
                    $logo = $this->upload_avatar('logo', 'assets/upload/profile', $_FILES['logo']['name']);
                }
                if ( !empty($_FILES['file']['name']) ) {
                    chmod('assets/upload/profile', 0777);
                    $file = $this->upload_file_pdf('file', 'assets/upload/profile', $_FILES['file']['name']);
                }
                if ( isset($logo) && !empty($logo) ) {
                    $data['logo'] = $logo;
                }
                if ( !empty($_FILES['file']['name']) ) {
                    $data['file'] = $file;
                }

                $data = array(
                    'company' => $user->company,
                    'address' => $this->input->post('address'),
                    'website' => $this->input->post('website'),
                    'manpower' => $this->input->post('manpower'),
                    'revenue' => $this->input->post('revenue'),
                    'product' => $this->input->post('product'),
                    'profile' => $this->input->post('profile'),
                    'market' => $this->input->post('market'),
                    'connector' => $this->input->post('connector'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'user_id' => $user->id,
                    'is_state' => $this->input->post('is_state'),
                    'is_saved' => 1
                );
                if ( isset($logo) && !empty($logo) ) {
                    $data['logo'] = $logo;
                }
                if ( !empty($_FILES['file']['name']) ) {
                    $data['file'] = $file;
                }
                $save = $this->temp_register_model->update($id, $data);
                if ($save) {
                    $this->session->set_flashdata('message_success', 'Cập nhật thông tin thành công');
                    redirect('member/information', 'refresh');
                }else{
                    $this->session->set_flashdata('message_success', 'Có lỗi trong quá trình cập nhật thông tin');
                    redirect('member/information', 'refresh');
                }
            }
            
        }
    }

    protected function check_file($filename, $filesize){
        $reponse = array(
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        $map = strripos($filename, '.')+1;
        $fileextension = strtolower(substr($filename, $map,(strlen($filename)-$map)));
        if($fileextension != 'pdf' || $filesize > 20971520){
            $this->session->set_flashdata('message_error', 'Định dạng không phải là "PDF" hoặc dung lượng vựt quá 20Mb');
            redirect('member');
        }
    }
    protected function check_image($filename, $filesize){
        $reponse = array(
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        $map = strripos($filename, '.')+1;
        $fileextension = strtolower(substr($filename, $map,(strlen($filename)-$map)));
        if(!($fileextension == 'png' || $fileextension == 'jpg' || $fileextension == 'jpeg' || $fileextension == 'gif') || $filesize > 20971520){
            $this->session->set_flashdata('message_error', 'Không phải định dạng ảnh hoặc dung lượng vựt quá 20Mb');
            redirect('member');
        }
    }

    public function validate_file(){
        $this->form_validation->set_message(__FUNCTION__, 'Vui lòng chọn Logo.');
        if (!empty($_FILES['logo']['name'][0])) {
            return true;
        }
        return false;
    }
}