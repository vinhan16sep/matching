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
        $this->data['page_title'] = $this->lang->line('Company | Organization Information');
        $user = $this->ion_auth->user()->row();
        $this->data['company'] = $user->company;
        $temp_register_save = $this->temp_register_model->get_by_user_id_not_join_saved($user->id);

        /*================================
        =            Validate            =
        ================================*/
        
        
        $this->form_validation->set_rules('company', $this->lang->line("Company name"), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('address', $this->lang->line("Address (Vietnamese)"), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('address_en', $this->lang->line("Address (English)"), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('website', 'Website', 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('manpower', $this->lang->line("sonhanluc"), 'required|numeric', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!',
            'numeric' => '%s '.$this->lang->line("phailaso")
        ));
        $this->form_validation->set_rules('revenue', $this->lang->line("doanhthunam").' ' . (date("Y") - 1) , 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!',
        ));
        $this->form_validation->set_rules('product', $this->lang->line('Product/Solution (Vietnamese name)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('product_en', $this->lang->line('Product/Solution (English name)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('profile', $this->lang->line('Field of operation (Vietnamese)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('profile_en', $this->lang->line('Field of operation (English)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('market', $this->lang->line('Targeted markets (Vietnamese)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('market_en', $this->lang->line('Targeted markets (English)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('connector', $this->lang->line('Legal Representative'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('email', 'E-Mail', 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('phone', $this->lang->line('Mobile'), 'required|numeric', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!',
            'numeric' => '%s '.$this->lang->line("phailaso")
        ));
        
        /*=====  End of Validate  ======*/


        if (empty($temp_register_save) || $this->input->get('edit') == 1) {
            $this->data['temp'] = $check_temp_register = $this->temp_register_model->get_by_user_id_not_join($user->id);
//            if (!isset($check_temp_register) || empty($check_temp_register['logo'])) {
//                $this->form_validation->set_rules('logo', 'Logo', 'callback_validate_file');
//            }
            if ($this->input->post()) {
                $data = array(
                    'company' => $user->company,
                    'address' => $this->input->post('address'),
                    'address_en' => $this->input->post('address_en'),
                    'website' => $this->input->post('website'),
                    'manpower' => $this->input->post('manpower'),
                    'revenue' => $this->input->post('revenue'),
                    'product' => $this->input->post('product'),
                    'product_en' => $this->input->post('product_en'),
                    'profile' => $this->input->post('profile'),
                    'profile_en' => $this->input->post('profile_en'),
                    'market' => $this->input->post('market'),
                    'market_en' => $this->input->post('market_en'),
                    'connector' => $this->input->post('connector'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'is_state' => $this->input->post('is_state') ? $this->input->post('is_state') : 0,
                    'user_id' => $user->id,
                );
                if ($this->input->post('submit') == $this->lang->line('luuthongtin')) {
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
                            $this->session->set_flashdata('message_success', $this->lang->line('luuthongtinthanhcong'));
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
                        $this->session->set_flashdata('message_success', $this->lang->line("thongtintamthoiduocluu"));
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
        $this->data['page_title'] = $this->lang->line('Update Company | Organization Information');
        $user = $this->ion_auth->user()->row();
        $this->data['company'] = $user->company;
        $this->data['temp'] = $check_temp_register = $this->temp_register_model->get_by_user_id_not_join($user->id);

        /*================================
        =            Validate            =
        ================================*/
        
        
        $this->form_validation->set_rules('company', $this->lang->line("Company name"), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('address', $this->lang->line("Address (Vietnamese)"), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('address_en', $this->lang->line("Address (English)"), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('website', 'Website', 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('manpower', $this->lang->line("sonhanluc"), 'required|numeric', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!',
            'numeric' => '%s '.$this->lang->line("phailaso")
        ));
        $this->form_validation->set_rules('revenue', $this->lang->line("doanhthunam").' ' . (date("Y") - 1) , 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!',
        ));
        $this->form_validation->set_rules('product', $this->lang->line('Product/Solution (Vietnamese name)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('product_en', $this->lang->line('Product/Solution (English name)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('profile', $this->lang->line('Field of operation (Vietnamese)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('profile_en', $this->lang->line('Field of operation (English)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('market', $this->lang->line('Targeted markets (Vietnamese)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('market_en', $this->lang->line('Targeted markets (English)'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('connector', $this->lang->line('Legal Representative'), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('email', 'E-Mail', 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));
        $this->form_validation->set_rules('phone', $this->lang->line('Mobile'), 'required|numeric', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!',
            'numeric' => '%s '.$this->lang->line("phailaso")
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
                    'address_en' => $this->input->post('address_en'),
                    'website' => $this->input->post('website'),
                    'manpower' => $this->input->post('manpower'),
                    'revenue' => $this->input->post('revenue'),
                    'product' => $this->input->post('product'),
                    'product_en' => $this->input->post('product_en'),
                    'profile' => $this->input->post('profile'),
                    'profile_en' => $this->input->post('profile_en'),
                    'market' => $this->input->post('market'),
                    'market_en' => $this->input->post('market_en'),
                    'connector' => $this->input->post('connector'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'user_id' => $user->id,
                    'is_state' => $this->input->post('is_state') ? $this->input->post('is_state') : 0,
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
                    $this->session->set_flashdata('message_success', $this->lang->line("capnhatthongtinthanhcong"));
                    redirect('member/information', 'refresh');
                }else{
                    $this->session->set_flashdata('message_success', $this->lang->line("coloitrongquatrinh"));
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
            $this->session->set_flashdata('message_error', $this->lang->line("dinhdangsai"));
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
            $this->session->set_flashdata('message_error', $this->lang->line("khongphaidinhdanganh"));
            redirect('member');
        }
    }

    public function validate_file(){
        $this->form_validation->set_message(__FUNCTION__, $this->lang->line("vuilongchonlogo"));
        if (!empty($_FILES['logo']['name'][0])) {
            return true;
        }
        return false;
    }
}