<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends Admin_Controller
{

    function __construct(){
        parent::__construct();
        if(!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('message','You are not allowed to visit the Event setting page');
            redirect('admin','refresh');
        }
        $this->load->model('event_model');
        $this->load->model('temp_register_model');
        $this->load->model('matching_model');
        $this->load->model('setting_model');
        $this->load->model('category_model');
    }

    public function index(){
        $this->data['page_title'] = 'Danh sách sự kiện';

        $this->load->library('pagination');
        $total_rows  = $this->event_model->count();
        $config = array();
        $base_url = base_url('admin/event/index');
        $per_page = 20;
        $uri_segment = 4;

        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
        $this->data['result'] = $this->event_model->fetch_all_pagination($per_page, $per_page * $this->data['page']);

        $this->render('admin/event/list_event_view');
    }

    public function detail($event_id){
        $this->load->helper('form');
        $event = $this->event_model->fetch_by_id($event_id);
        /**
         * List all of setting of 1 event
         */
        $pending_setting = $this->setting_model->get_list_pending_setting_by_event_id($event_id);
        /**
         * List of temp register have user id of 1 event
         */
        $active_setting = $this->setting_model->get_list_active_setting_by_event_id($event_id);
        /**
         * List of matching in 1 event
         */
        $pending_matching = $this->matching_model->get_list_matching_by_event_and_status($event_id, 0);
        $approved_matching = $this->matching_model->get_list_matching_by_event_and_status($event_id, 1);
        $rejected_matching = $this->matching_model->get_list_matching_by_event_and_status($event_id, 2);

        $this->data['page_title'] = 'Thông tin chung sự kiện ' . '<span style="color:red;">' . $event['name'] . '</span>';


        $keywords = '';
        if($this->input->get('keywords')){
            $keywords = $this->input->get('keywords');
        }
        $this->data['keywords'] = $keywords;

        $status = '';
        if($this->input->get('status')){
            $status = $this->input->get('status');
        }
        $this->data['status'] = $status;

        $total_rows  = $this->matching_model->count_search('', $keywords, $status);
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url('admin/event/detail/' . $event_id);
        $per_page = 10;
        $uri_segment = 5;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $this->pagination->initialize($config);
        $this->data['page_links'] = $this->pagination->create_links();
        $matching = $this->matching_model->get_all_by_event_id_with_pagination_search($event_id, $per_page, $this->data['page'], $keywords, $status);

        /**
         * Count data for render view
         */
        $this->data['count_pending_setting'] = count($pending_setting);
        $this->data['count_active_setting'] = count($active_setting);
        $this->data['pending_matching'] = count($pending_matching);
        $this->data['approved_matching'] = count($approved_matching);
        $this->data['rejected_matching'] = count($rejected_matching);
        $this->data['matching'] = $matching;
        $this->data['event_id'] = $event_id;
        $this->data['event_date'] = $event['date'];

        $this->render('admin/event/detail_event_view');
    }

    public function create(){
        $this->data['page_title'] = 'Tạo mới sự kiện';
        $this->data['time_range'] = $this->buildTimeRange();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Name','trim|required');

        if($this->form_validation->run() === FALSE) {
            $this->load->helper('form');
            $this->render('admin/event/create_event_view');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'date' => strtotime(str_replace('/', '-', $this->input->post('date'))),
//                'table' => $this->input->post('table'),
                'start' => $this->input->post('start'),
                'duration' => $this->input->post('duration'),
                'step' => $this->input->post('step'),
            );
            $result = $this->event_model->insert($data);
            if($result){
                redirect('admin/event','refresh');
            }
            $this->render('admin/event/create_event_view');
        }
    }

    public function edit($id = NULL){
        $id = $this->input->post('id') ? $this->input->post('id') : $id;
        $this->data['detail'] = $this->event_model->fetch_by_id($id);

        $this->data['page_title'] = 'Cập nhật sự kiện';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Name','trim|required');

        if($this->form_validation->run() === FALSE) {
            $this->render('admin/event/edit_event_view');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'date' => strtotime(str_replace('/', '-', $this->input->post('date'))),
//                'table' => $this->input->post('table'),
                'start' => $this->input->post('start'),
                'duration' => $this->input->post('duration'),
                'step' => $this->input->post('step'),
            );
            $result = $this->event_model->update($id, $data);
            redirect('admin/event','refresh');
        }
    }

    public function activate(){
        $params = $this->input->get();
        $data = array(
            'is_active' => ($params['activate'] == 0) ? 1 : 0
        );
        $result = $this->event_model->update($params['id'], $data);
        if($result){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 1)));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 0)));
    }

    public function delete(){
        $id = $this->input->get('id');
        if(is_null($id)){
            $this->session->set_flashdata('message','There\'s no group to delete');
        } else {
            $result = $this->ion_auth->delete_group($id);
            $this->session->set_flashdata('message',$this->ion_auth->messages());

            if($result == false){
                $this->output->set_status_header(404)
                    ->set_output(json_encode(array('message' => 'Fail', 'data' => $id)));
            }else{
                $this->output->set_status_header(200)
                    ->set_output(json_encode(array('message' => 'Success', 'data' => $id)));
            }
        }
    }

    public function buildTimeRange(){
        $start = '09:00';
        $duration = 10;
        $step = 30;
        $expression = (string) 'PT' . $step . 'M';

        if($duration <= 0){
            return false;
        }

        $pre_setup = new \DateTime($start);
        $outputStart = $pre_setup->sub(new DateInterval($expression));
        $times = ($duration * (60 / $step)); // 24 hours * 30 mins in an hour
        for ($i = 0; $i < $times; $i++) {
            $result[] = $outputStart->add(new \DateInterval($expression))->format('H:i');
        }
        return $result;
    }

    public function get_matching_info(){
        $finder_id = $this->input->get('finder_id');
        $target_id = $this->input->get('target_id');
        $select = 'company, address, connector, position, overview, profile, email, phone, file';
        $finder = $this->temp_register_model->get_by_id_with_select($finder_id, $select);
        $setting_finder = $this->setting_model->find(array('temp_register_id' => $finder_id));
        if ($setting_finder) {
            $category_id_finder = explode(',', $setting_finder['category_id']);
            $category_finder = $this->get_category($category_id_finder);
            $finder['category'] = $category_finder;
        }else{
            $finder['category'] = [];
        }

        $target = $this->temp_register_model->get_by_id_with_select($target_id, $select);
        $setting_target = $this->setting_model->find(array('temp_register_id' => $target_id));
        if ($setting_target) {
            $category_id_target = explode(',', $setting_target['category_id']);
            $category_target = $this->get_category($category_id_target);
            $target['category'] = $category_target;
        }else{
            $target['category'] = [];
        }
        if ($finder && $target) {
            return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('status' => 200, 'message' => 'Success', 'data' => ['finder' => $finder, 'target' => $target])));
        }
        return $this->output->set_status_header(200)
                    ->set_output(json_encode(array('status' => 404, 'message' => 'Fail', 'data' => [$finder_id, $target_id])));
    }

    private function get_category($category_id){
        $category = $this->category_model->fetch_by_ids($category_id);
        $category_root = array();
        if ($category) {
            foreach ($category as $key => $value) {
                if ($value['parent_id'] == 0) {
                    $category_root[] = $value;
                }
            }
        }
        if ($category_root) {
            foreach ($category_root as $key => $value) {
                if ($category) {
                    foreach ($category as $k => $val) {
                        if ($val['parent_id'] == $value['id']) {
                            $category_root[$key]['sub'][] = $val;
                        }
                    }
                }
                
            }
        }
        return $category_root;

    }
}