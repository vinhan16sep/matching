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
                'table' => $this->input->post('table'),
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
                'table' => $this->input->post('table'),
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
}