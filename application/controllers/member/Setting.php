<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Member_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('setting_model');
		$this->load->model('category_model');
		$this->load->model('temp_register_model');
		$this->load->helper('common_helper');
	}

	// List all your items
	public function index()
	{
		$user = $this->ion_auth->user()->row();

		$this->load->library('pagination');
        $total_rows  = $this->setting_model->count();
        $config = array();
        $base_url = base_url('member/setting/index');
        $per_page = 20;
        $uri_segment = 4;

        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
        $result = $this->setting_model->fetch_all_pagination_by_user_id($user->id, $per_page, $per_page * $this->data['page']);

        if ($result) {
        	foreach ($result as $key => $value) {
        		$category_id = explode(',', $value['category_id']);
        		$category = $this->category_model->fetch_by_ids($category_id);
        		$result[$key]['category'] = $category;
        	}
        }

        $this->data['result'] = $result;
        // echo '<pre>';
        // print_r($this->data['result']);die;


		$this->render('member/setting/index');
	}

	// Add a new item
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$user = $this->ion_auth->user()->row();
		$event_id = $user->event_id;
		$temp_register = $this->temp_register_model->get_by_email_and_event_id($user->email, $event_id);
		$catrgory_root = $this->category_model->fetch_all_root_by_event($event_id);
		$events = array();
		if ($catrgory_root) {
			foreach ($catrgory_root as $key => $value) {
				$events[$value['id']]['name'] = $value['name'];
				$category_sub = $this->category_model->fetch_all_sub_by_event_and_parent($event_id, $value['id']);
				if ($category_sub) {
					foreach ($category_sub as $k => $val) {
						$events[$value['id']][$val['id']] = $val['name'];
					}
				}
				
			}
		}
		
		$this->data['events'] = $events;

		$this->form_validation->set_rules('category_id[]','Tiêu chí','trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->render('member/setting/create');
		} else {
			if ($this->input->post()) {
				$category_id = ',' . implode(',', $this->input->post('category_id')) . ',';
				$data = array(
					'user_id' => $user->id,
					'event_id' => $event_id,
					'category_id' => $category_id,
					'temp_register_id' => $temp_register['id'],
				);

				$insert = $this->setting_model->save($data);
				if ($insert) {
					$this->session->set_flashdata('success', 'Đăng ký thành công');
                    redirect('member/setting/index', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Đăng ký thành công');
                    redirect('member/setting/create', 'refresh');
				}
			}
		}
	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Setting.php */
/* Location: ./application/controllers/member/Setting.php */
