<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends Client_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('clients')) {
            //redirect them to the login page
            redirect('client/user/login', 'refresh');
        }

        $this->load->helper('url');
        $this->load->model('information_model');
        $this->load->model('status_model');
        $this->load->model('users_model');
        $this->load->library('session');

        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['reg_status'] = $this->status_model->fetch_by_client_id($this->data['user']->id);

    }

    public function index() {
        $this->data['submitted'] = $this->information_model->fetch_by_user_id('information', $this->data['user']->id);
        $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($this->data['user']->username, $this->data['eventYear']);

        $this->render('client/information/detail_extra_view');
    }

    public function extra() {
        $this->data['submitted'] = $this->information_model->fetch_extra_by_identity('information', $this->data['user']->username);
        $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($this->data['user']->username, $this->data['eventYear']);
        $this->render('client/information/detail_extra_view');
    }

    public function create_extra() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('legal_representative', $this->lang->line('Legal Representative'), 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_position', 'Chức danh', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('connector', 'Tên người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('c_position', 'Chức danh người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_email', 'Email', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('lp_phone', 'Di động', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));

        $this->form_validation->set_rules('c_email', 'Email người liên hệ với BTC', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('c_phone', 'Di động người liên hệ với BTC', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));
//        $this->form_validation->set_rules('link', 'Link download PĐK của DN', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            if($this->data['reg_status'] == 1){
                redirect('client/information', 'refresh');
            }
            $this->data['identity'] = $this->input->get('identity');
            $exist = $this->information_model->check_exist_information($this->input->get('identity'));
            if(!empty($exist)){
                $this->data['exist'] = $exist;
            }
            $this->render('client/information/create_extra_view');
        } else {
            if ($this->input->post()) {
                if(!empty($_FILES['avatar']['name'])){
                    $this->check_img($_FILES['avatar']['name'], $_FILES['avatar']['size']);
                    $avatar = $this->upload_avatar('avatar', 'assets/upload/avatar', $_FILES['avatar']['name']);
                }
                $data = array(
                    'client_id' => $this->data['user']->id,
                    'legal_representative' => $this->input->post('legal_representative'),
                    'lp_position' => $this->input->post('lp_position'),
                    'lp_email' => $this->input->post('lp_email'),
                    'lp_phone' => $this->input->post('lp_phone'),
                    'connector' => $this->input->post('connector'),
                    'c_position' => $this->input->post('c_position'),
                    'c_email' => $this->input->post('c_email'),
                    'c_phone' => $this->input->post('c_phone'),
                    'website' => $this->input->post('website'),
//                    'link' => $this->input->post('link'),
                    'identity' => $this->data['user']->username,
//                    'is_submit' => 1,
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );
                if ($avatar) {
                    $data['avatar'] = $avatar;
                }
                $exist = $this->information_model->check_exist_information($this->data['user']->username);
                if(!empty($exist)){
                    unset($data['created_at']);
                    unset($data['created_by']);
                    $update = $this->information_model->update_by_identity('information', $this->data['user']->username, $data);
                    $this->status_model->update('status', $this->data['user']->id, array('is_information' => 1, 'year' => $this->data['eventYear']));
                    $this->users_model->update('users', $this->data['user']->id, array('information_id' => $exist['id']));
                }else{
                    $insert = $this->information_model->insert('information', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_information' => 1));
                    $this->users_model->update('users', $this->data['user']->id, array('information_id' => $insert));
                    $this->session->set_flashdata('message', 'Item added successfully');
                }

                redirect('client/information/extra', 'refresh');
            }
        }
    }

    public function edit_extra($request_id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('legal_representative', $this->lang->line('Legal Representative'), 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_position', 'Chức danh', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('connector', 'Tên người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('c_position', 'Chức danh người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_email', 'Email', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('lp_phone', 'Di động', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));

        $this->form_validation->set_rules('c_email', 'Email người liên hệ với BTC', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('c_phone', 'Di động người liên hệ với BTC', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));
//        $this->form_validation->set_rules('link', 'Link download PĐK của DN', 'trim|required');

        $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
        $this->data['extra'] = $this->information_model->fetch_by_user_identity('information', $this->data['user']->username);
        if ($this->form_validation->run() == FALSE) {

            if (!$this->data['extra']) {
                redirect('client/information', 'refresh');
            }

            if($this->data['reg_status'] == 1){
                redirect('client/information', 'refresh');
            }

            $this->render('client/information/edit_extra_view');
        } else {
            if ($this->input->post()) {
                $avatar = '';
                if(!empty($_FILES['avatar']['name'])){
                    $this->check_img($_FILES['avatar']['name'], $_FILES['avatar']['size']);
                    $avatar = $this->upload_avatar('avatar', 'assets/upload/avatar', $_FILES['avatar']['name']);
                }

                $data = array(
                    'legal_representative' => $this->input->post('legal_representative'),
                    'lp_position' => $this->input->post('lp_position'),
                    'lp_email' => $this->input->post('lp_email'),
                    'lp_phone' => $this->input->post('lp_phone'),
                    'connector' => $this->input->post('connector'),
                    'c_position' => $this->input->post('c_position'),
                    'c_email' => $this->input->post('c_email'),
                    'c_phone' => $this->input->post('c_phone'),
                    'website' => $this->input->post('website'),
//                    'link' => $this->input->post('link'),
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($avatar) {
                    $data = array('avatar' => $avatar);
                }

                try {
                    $this->information_model->update_by_identity('information', $this->data['user']->username, $data);
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_information' => 1));
                    if ( file_exists('assets/upload/avatar/' . $this->data['extra']['avatar']) && $avatar !='' ) {
                        unlink('assets/upload/avatar/' . $this->data['extra']['avatar']);
                    }
                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('client/information/extra', 'refresh');
            }
        }
    }

    public function company(){
        if($this->input->get('year')){
            $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $this->data['user']->username, $this->input->get('year'));
            $this->render('client/information/detail_company_view');
        }else{
            $this->load->library('pagination');
            $config = array();
            $base_url = base_url() . 'client/information/company';
            $total_rows = $this->information_model->count_companies($this->data['user']->username);
            $per_page = 10;
            $uri_segment = 4;
            foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
                $config[$key] = $value;
            }
            $this->pagination->initialize($config);

            $this->data['page_links'] = $this->pagination->create_links();
            $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $this->data['companies'] =  $this->information_model->fetch_list_company_by_identity($this->data['user']->username);
            $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($this->data['user']->username, $this->data['eventYear']);
            $this->render('client/information/list_company_view');
        }
    }

    public function create_company() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        if($this->input->post('submit') == 'Hoàn thành') {
            $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_3', 'Vốn điều lệ ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_1', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_2', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_3', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu DN ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu DN ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_3', 'Tổng doanh thu DN ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_1', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_3', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_3', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_1', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_2', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_3', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_labor_1', 'Tổng số lao động của DN ' . $this->data['rule3Year'][0], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_labor_2', 'Tổng số lao động của DN ' . $this->data['rule3Year'][1], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_labor_3', 'Tổng số lao động của DN ' . $this->data['rule3Year'][2], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_1', 'Tổng số LTV ' . $this->data['rule3Year'][0], 'trim|required|integer', array(
                'required' => '%s không được trống.',
                'integer' => '%s phải là số nguyên.',
            ));
            $this->form_validation->set_rules('total_ltv_2', 'Tổng số LTV ' . $this->data['rule3Year'][1], 'trim|required|integer', array(
                'required' => '%s không được trống.',
                'integer' => '%s phải là số nguyên.',
            ));
            $this->form_validation->set_rules('total_ltv_3', 'Tổng số LTV ' . $this->data['rule3Year'][2], 'trim|required|integer', array(
                'required' => '%s không được trống.',
                'integer' => '%s phải là số nguyên.',
            ));
            $this->form_validation->set_rules('main_service[]', 'Sản phẩm dịch vụ chính của doanh nghiệp', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            $this->form_validation->set_rules('main_market[]', 'Thị trường chính', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            if ($this->form_validation->run() === FALSE) {
                if($this->data['reg_status']['is_information'] == 0){
                    $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                    redirect('client/information/create_extra', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/information/company', 'refresh');
                }
                $this->data['year'] = $this->input->get('year');
                $this->render('client/information/create_company_view');
            } else {
                if ($this->input->post()) {
                    $main_service = json_encode($this->input->post('main_service'));
                    $main_market = json_encode($this->input->post('main_market'));
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'equity_1' => $this->input->post('equity_1'),
                        'equity_2' => $this->input->post('equity_2'),
                        'equity_3' => $this->input->post('equity_3'),
                        'owner_equity_1' => $this->input->post('owner_equity_1'),
                        'owner_equity_2' => $this->input->post('owner_equity_2'),
                        'owner_equity_3' => $this->input->post('owner_equity_3'),
                        'total_income_1' => $this->input->post('total_income_1'),
                        'total_income_2' => $this->input->post('total_income_2'),
                        'total_income_3' => $this->input->post('total_income_3'),
                        'software_income_1' => $this->input->post('software_income_1'),
                        'software_income_2' => $this->input->post('software_income_2'),
                        'software_income_3' => $this->input->post('software_income_3'),
                        'it_income_1' => $this->input->post('it_income_1'),
                        'it_income_2' => $this->input->post('it_income_2'),
                        'it_income_3' => $this->input->post('it_income_3'),
                        'export_income_1' => $this->input->post('export_income_1'),
                        'export_income_2' => $this->input->post('export_income_2'),
                        'export_income_3' => $this->input->post('export_income_3'),
                        'total_labor_1' => $this->input->post('total_labor_1'),
                        'total_labor_2' => $this->input->post('total_labor_2'),
                        'total_labor_3' => $this->input->post('total_labor_3'),
                        'total_ltv_1' => $this->input->post('total_ltv_1'),
                        'total_ltv_2' => $this->input->post('total_ltv_2'),
                        'total_ltv_3' => $this->input->post('total_ltv_3'),
                        'description' => $this->input->post('description'),
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'main_service' => $main_service,
                        'main_market' => $main_market,
//                    'is_submit' => 1,
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );

                    $insert = $this->information_model->insert_company('company', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_company' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/information/company?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }else{
            $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_3', 'Vốn điều lệ ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_1', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_2', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_3', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu DN ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu DN ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_3', 'Tổng doanh thu DN ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_1', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_3', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_3', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_1', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_2', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_3', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_labor_1', 'Tổng số lao động của DN ' . $this->data['rule3Year'][0], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_labor_2', 'Tổng số lao động của DN ' . $this->data['rule3Year'][1], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_labor_3', 'Tổng số lao động của DN ' . $this->data['rule3Year'][2], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_1', 'Tổng số LTV ' . $this->data['rule3Year'][0], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_2', 'Tổng số LTV ' . $this->data['rule3Year'][1], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_3', 'Tổng số LTV ' . $this->data['rule3Year'][2], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));

            if ($this->form_validation->run() === FALSE) {
                if($this->data['reg_status']['is_information'] == 0){
                    $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                    redirect('client/information/create_extra', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/information/company', 'refresh');
                }
                $this->data['year'] = $this->input->get('year');
                $this->render('client/information/create_company_view');
            }else{
                if ($this->input->post()) {
                    $main_service = json_encode($this->input->post('main_service'));
                    $main_market = json_encode($this->input->post('main_market'));
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'equity_1' => $this->input->post('equity_1'),
                        'equity_2' => $this->input->post('equity_2'),
                        'equity_3' => $this->input->post('equity_3'),
                        'owner_equity_1' => $this->input->post('owner_equity_1'),
                        'owner_equity_2' => $this->input->post('owner_equity_2'),
                        'owner_equity_3' => $this->input->post('owner_equity_3'),
                        'total_income_1' => $this->input->post('total_income_1'),
                        'total_income_2' => $this->input->post('total_income_2'),
                        'total_income_3' => $this->input->post('total_income_3'),
                        'software_income_1' => $this->input->post('software_income_1'),
                        'software_income_2' => $this->input->post('software_income_2'),
                        'software_income_3' => $this->input->post('software_income_3'),
                        'it_income_1' => $this->input->post('it_income_1'),
                        'it_income_2' => $this->input->post('it_income_2'),
                        'it_income_3' => $this->input->post('it_income_3'),
                        'export_income_1' => $this->input->post('export_income_1'),
                        'export_income_2' => $this->input->post('export_income_2'),
                        'export_income_3' => $this->input->post('export_income_3'),
                        'total_labor_1' => $this->input->post('total_labor_1'),
                        'total_labor_2' => $this->input->post('total_labor_2'),
                        'total_labor_3' => $this->input->post('total_labor_3'),
                        'total_ltv_1' => $this->input->post('total_ltv_1'),
                        'total_ltv_2' => $this->input->post('total_ltv_2'),
                        'total_ltv_3' => $this->input->post('total_ltv_3'),
                        'description' => $this->input->post('description'),
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'main_service' => $main_service,
                        'main_market' => $main_market,
//                    'is_submit' => 1,
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );

                    $insert = $this->information_model->insert_company('company', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
//                $this->status_model->update('status', $this->data['user']->id, array('is_company' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/information/company?year=' . $this->data['eventYear'], 'refresh');
                }
            }
//            if($this->data['reg_status']['is_information'] == 0){
//                $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
//                redirect('client/information/create_extra', 'refresh');
//            }
//            if($this->data['eventYear'] != $this->input->get('year')){
//                redirect('client/information/company', 'refresh');
//            }
//            $this->data['year'] = $this->input->get('year');
//            $this->render('client/information/create_company_view');
//
//
        }


    }

    public function edit_company($request_id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->input->post('submit') == 'Hoàn thành') {
            $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_3', 'Vốn điều lệ ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_1', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_2', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_3', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu DN ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu DN ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_3', 'Tổng doanh thu DN ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_1', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_3', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_3', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_1', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_2', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_3', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_labor_1', 'Tổng số lao động của DN ' . $this->data['rule3Year'][0], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_labor_2', 'Tổng số lao động của DN ' . $this->data['rule3Year'][1], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_labor_3', 'Tổng số lao động của DN ' . $this->data['rule3Year'][2], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_1', 'Tổng số LTV ' . $this->data['rule3Year'][0], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_2', 'Tổng số LTV ' . $this->data['rule3Year'][1], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_3', 'Tổng số LTV ' . $this->data['rule3Year'][2], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('main_service[]', 'Sản phẩm dịch vụ chính của doanh nghiệp', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            $this->form_validation->set_rules('main_market[]', 'Thị trường chính', 'trim|required', array(
                'required' => '%s không được trống.'
            ));

            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $this->data['user']->username, $this->input->get('year'));
                if (!$this->data['company']) {
                    redirect('client/information/company', 'refresh');
                }
                if($this->data['reg_status'] == 1){
                    redirect('client/information', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/information/company', 'refresh');
                }
                $this->render('client/information/edit_company_view');
            } else {
                if ($this->input->post()) {
                    $main_service = json_encode($this->input->post('main_service'));
                    $main_market = json_encode($this->input->post('main_market'));

                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'equity_1' => $this->input->post('equity_1'),
                        'equity_2' => $this->input->post('equity_2'),
                        'equity_3' => $this->input->post('equity_3'),
                        'owner_equity_1' => $this->input->post('owner_equity_1'),
                        'owner_equity_2' => $this->input->post('owner_equity_2'),
                        'owner_equity_3' => $this->input->post('owner_equity_3'),
                        'total_income_1' => $this->input->post('total_income_1'),
                        'total_income_2' => $this->input->post('total_income_2'),
                        'total_income_3' => $this->input->post('total_income_3'),
                        'software_income_1' => $this->input->post('software_income_1'),
                        'software_income_2' => $this->input->post('software_income_2'),
                        'software_income_3' => $this->input->post('software_income_3'),
                        'it_income_1' => $this->input->post('it_income_1'),
                        'it_income_2' => $this->input->post('it_income_2'),
                        'it_income_3' => $this->input->post('it_income_3'),
                        'export_income_1' => $this->input->post('export_income_1'),
                        'export_income_2' => $this->input->post('export_income_2'),
                        'export_income_3' => $this->input->post('export_income_3'),
                        'total_labor_1' => $this->input->post('total_labor_1'),
                        'total_labor_2' => $this->input->post('total_labor_2'),
                        'total_labor_3' => $this->input->post('total_labor_3'),
                        'total_ltv_1' => $this->input->post('total_ltv_1'),
                        'total_ltv_2' => $this->input->post('total_ltv_2'),
                        'total_ltv_3' => $this->input->post('total_ltv_3'),
                        'description' => $this->input->post('description'),
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'main_service' => $main_service,
                        'main_market' => $main_market,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );

                    try {
                        $this->information_model->update_by_information_and_year('company', $this->data['user']->username, $this->data['eventYear'], $data);
                        $this->load->model('status_model');
                        $this->status_model->update('status', $this->data['user']->id, array('is_company' => 1));
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }

                    redirect('client/information/company?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }else{
            $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('equity_3', 'Vốn điều lệ ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_1', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_2', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_3', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu DN ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu DN ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_income_3', 'Tổng doanh thu DN ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_1', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_3', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_3', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_1', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_2', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_3', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_labor_1', 'Tổng số lao động của DN ' . $this->data['rule3Year'][0], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_labor_2', 'Tổng số lao động của DN ' . $this->data['rule3Year'][1], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_labor_3', 'Tổng số lao động của DN ' . $this->data['rule3Year'][2], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_1', 'Tổng số LTV ' . $this->data['rule3Year'][0], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_2', 'Tổng số LTV ' . $this->data['rule3Year'][1], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_3', 'Tổng số LTV ' . $this->data['rule3Year'][2], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            if ($this->form_validation->run() == FALSE) {
                $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $this->data['user']->username, $this->input->get('year'));
                if (!$this->data['company']) {
                    redirect('client/information/company', 'refresh');
                }
                if($this->data['reg_status'] == 1){
                    redirect('client/information', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/information/company', 'refresh');
                }
                $this->render('client/information/edit_company_view');
            } else {
                if ($this->input->post()) {
                    $main_service = json_encode($this->input->post('main_service'));
                    $main_market = json_encode($this->input->post('main_market'));

                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'equity_1' => $this->input->post('equity_1'),
                        'equity_2' => $this->input->post('equity_2'),
                        'equity_3' => $this->input->post('equity_3'),
                        'owner_equity_1' => $this->input->post('owner_equity_1'),
                        'owner_equity_2' => $this->input->post('owner_equity_2'),
                        'owner_equity_3' => $this->input->post('owner_equity_3'),
                        'total_income_1' => $this->input->post('total_income_1'),
                        'total_income_2' => $this->input->post('total_income_2'),
                        'total_income_3' => $this->input->post('total_income_3'),
                        'software_income_1' => $this->input->post('software_income_1'),
                        'software_income_2' => $this->input->post('software_income_2'),
                        'software_income_3' => $this->input->post('software_income_3'),
                        'it_income_1' => $this->input->post('it_income_1'),
                        'it_income_2' => $this->input->post('it_income_2'),
                        'it_income_3' => $this->input->post('it_income_3'),
                        'export_income_1' => $this->input->post('export_income_1'),
                        'export_income_2' => $this->input->post('export_income_2'),
                        'export_income_3' => $this->input->post('export_income_3'),
                        'total_labor_1' => $this->input->post('total_labor_1'),
                        'total_labor_2' => $this->input->post('total_labor_2'),
                        'total_labor_3' => $this->input->post('total_labor_3'),
                        'total_ltv_1' => $this->input->post('total_ltv_1'),
                        'total_ltv_2' => $this->input->post('total_ltv_2'),
                        'total_ltv_3' => $this->input->post('total_ltv_3'),
                        'description' => $this->input->post('description'),
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'main_service' => $main_service,
                        'main_market' => $main_market,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );

                    try {
                        $this->information_model->update_by_information_and_year('company', $this->data['user']->username, $this->data['eventYear'], $data);
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }

                    redirect('client/information/company?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }

    }

    public function products(){
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'client/information/products';
        $total_rows = $this->information_model->count_product($this->data['user']->id);
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['products'] = $this->information_model->get_all_product($this->data['user']->id, $per_page, $this->data['page']);

        $this->render('client/information/list_product_view');
    }

    public function detail_product($id = NULL){
        $this->data['product'] = $this->information_model->fetch_product_by_user_and_id('product', $this->data['user']->id, $id);

        $this->render('client/information/detail_product_view');
    }

    public function remove_product($id = null){
        $deleted = $this->information_model->delete('product', $id);
        if ($deleted) {
            $this->session->set_flashdata('message', 'Xóa sản phẩm thành công');
            redirect('client/information/products', 'refresh');
        }else{
            $this->session->set_flashdata('message_error', 'Có lỗi trong quá trình xóa sản phẩm');
            redirect('client/information/products', 'refresh');
        }
    }

    public function create_product(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        if($this->input->post('submit') == 'Hoàn thành') {
            $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            // $this->form_validation->set_rules('service', 'Data', 'trim|required');
            $this->form_validation->set_rules('copyright_certificate', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('functional', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('process', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('security', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('positive', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('compare', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('income_2016', 'Data', 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('income_2017', 'Data', 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('area', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('open_date', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('price', 'Data', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            $this->form_validation->set_rules('customer', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('after_sale', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('team', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('award', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('service[]', 'Lĩnh vực', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            // $this->form_validation->set_rules('file', 'Data', 'callback_check_file_selected');

            if ($this->form_validation->run() == FALSE) {
                // if($this->data['reg_status']['is_information'] == 0){
                //     $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                //     redirect('client/information/create_extra', 'refresh');
                // }
                $this->render('client/information/create_product_view');
            } else {
                if ($this->input->post()) {
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }

                    $service = json_encode($this->input->post('service'));
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        'compare' => $this->input->post('compare'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        // 'certificate' => $image,
                        // 'is_submit' => 1,
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    $insert = $this->information_model->insert_product('product', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/information/products', 'refresh');
                }
            }
        }else{
            $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('income_2016', 'Data', 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('income_2017', 'Data', 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));

            if ($this->form_validation->run() == FALSE) {
                // if($this->data['reg_status']['is_information'] == 0){
                //     $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                //     redirect('client/information/create_extra', 'refresh');
                // }
                $this->render('client/information/create_product_view');
            } else {
                if ($this->input->post()) {
                    $service = json_encode($this->input->post('service'));
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }
                    // $image = $this->upload_image('certificate', $_FILES['certificate']['name'], 'assets/upload/product', 'assets/upload/product/thumbs');
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        'compare' => $this->input->post('compare'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        // 'certificate' => $image,
                        // 'is_submit' => 1,
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    $insert = $this->information_model->insert_product('product', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
//                    $this->load->model('status_model');
//                    $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/information/products', 'refresh');
                }
            }
        }

    }

    public function edit_product($request_id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->input->post('submit') == 'Hoàn thành') {
            $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            // $this->form_validation->set_rules('service', 'Data', 'trim|required');
            $this->form_validation->set_rules('copyright_certificate', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('functional', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('process', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('security', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('positive', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('compare', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('income_2016', 'Data', 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('income_2017', 'Data', 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('area', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('open_date', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('price', 'Data', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            $this->form_validation->set_rules('customer', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('after_sale', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('team', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('award', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('service[]', 'Lĩnh vực', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            // $this->form_validation->set_rules('file', 'Data', 'callback_check_file_selected');

            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                $this->data['product'] = $this->information_model->fetch_product_by_user_id('product', $this->data['user']->id, $id);
                if (!$this->data['product']) {
                    redirect('client/information/product', 'refresh');
                }
                $this->render('client/information/edit_product_view');
            } else {
                if ($this->input->post()) {
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }
                    $service = json_encode($this->input->post('service'));
                    $data = array(
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        'compare' => $this->input->post('compare'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by'],
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    try {
                        $this->information_model->update_product('product', $this->data['user']->id, $id, $data);
                        $this->load->model('status_model');
                        $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }
                    redirect('client/information/products', 'refresh');
                }
            }
        }else{
            $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
                'required' => '%s không được trống.',
            ));
            $this->form_validation->set_rules('income_2016', 'Data', 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('income_2017', 'Data', 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                $this->data['product'] = $this->information_model->fetch_product_by_user_id('product', $this->data['user']->id, $id);
                if (!$this->data['product']) {
                    redirect('client/information/product', 'refresh');
                }
                $this->render('client/information/edit_product_view');
            } else {
                if ($this->input->post()) {
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }
                    $service = json_encode($this->input->post('service'));
                    $data = array(
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        'compare' => $this->input->post('compare'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    try {
                        $this->information_model->update_product('product', $this->data['user']->id, $id, $data);
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }
                    redirect('client/information/products', 'refresh');
                }
            }
        }

    }

    function check_file_selected(){

        
        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_message(__FUNCTION__, 'Data không được trống');
            return false;
        }else{
            return true;
        }
    }

    public function set_final(){
        $this->status_model->update('status', $this->data['user']->id, array('is_final' => 1));
        redirect('client/dashboard', 'refresh');
    }

    protected function check_img($filename, $filesize){
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        $array_image = array('jpg', 'jpeg', 'png', 'gif');
        if( !in_array($fileextension, $array_image) || $filesize > 1228800){
            $this->session->set_flashdata('message_error', 'Định dạng file không đúng hoặc dung lượng ảnh vượt quá 1200Kb');
            redirect('client/information/extra');
        }
    }
    protected function check_file($filename){
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        $array_image = array('docx', 'doc', 'xlsx', 'xlsm', 'xlsb', 'xltx', 'xltm', 'xls', 'pdf');
        if( !in_array($fileextension, $array_image)){
            $this->session->set_flashdata('message_error', 'Định dạng file không đúng');
            redirect('client/information/products');
        }
    }

    function vn_to_str ($str){

        $unicode = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd'=>'đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i'=>'í|ì|ỉ|ĩ|ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D'=>'Đ',

            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach($unicode as $nonUnicode=>$uni){

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);

        }
        $str = str_replace(' ','_',$str);

        return $str;

    }
}
