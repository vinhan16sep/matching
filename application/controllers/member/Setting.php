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
	public function index(){
        $this->data['page_title'] = 'Quản lý tiêu chí cho sự kiện';
        $params = $this->input->get();
        if(!$params['event_id']){
            redirect('member/dashboard/index', 'refresh');
        }
        $this->data['event_id'] = $event_id = $params['event_id'];
		$user = $this->ion_auth->user()->row();

        $count_setting_by_user_and_event = $this->setting_model->count_by_user_id_and_event_id($user->id, $params['event_id']);
        $this->data['count_setting_by_user_and_event'] = $count_setting_by_user_and_event;

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
        $result = $this->setting_model->fetch_all_pagination_by_user_id($user->id, $per_page, $per_page * $this->data['page'], $event_id);

        if ($result) {
        	foreach ($result as $key => $value) {
        		$category_id = explode(',', $value['category_id']);
        		$category = $this->get_category($category_id);
        		$result[$key]['category'] = $category;
        		
        	}
        }
        $this->data['result'] = $result;


		$this->render('member/setting/index');
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

	// Add a new item
	public function create(){
        $this->data['page_title'] = 'Quản lý tiêu chí cho sự kiện';
	    $params = $this->input->get();
	    if(!$params['event_id']){
            redirect('member/dashboard/index', 'refresh');
        }
        $this->data['event_id'] = $event_id = $params['event_id'];
		$this->load->helper('form');
		$this->load->library('form_validation');

		$user = $this->ion_auth->user()->row();

		$count_setting_by_user_and_event = $this->setting_model->count_by_user_id_and_event_id($user->id, $event_id);
		$this->data['count_setting_by_user_and_event'] = $count_setting_by_user_and_event;
		if ($count_setting_by_user_and_event > 0) {
			$this->session->set_flashdata('error', 'Bạn đã đăng ký tiêu chí cho sự kiện lần này. Không thể đăng ký thêm');
            redirect('member/setting/index?event_id=' . $event_id, 'refresh');
		}
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
                    redirect('member/setting/index?event_id=' . $event_id, 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Đăng ký không thành công');
                    redirect('member/setting/create?event_id=' . $event_id, 'refresh');
				}
			}
		}
	}

	//Update one item
	public function update( $id = NULL ){
        $this->data['page_title'] = 'Quản lý tiêu chí cho sự kiện';
		$this->load->helper('form');
		$this->load->library('form_validation');

        $params = $this->input->get();
        if(!$params['event_id']){
            redirect('member/dashboard/index', 'refresh');
        }
        $this->data['event_id'] = $event_id = $params['event_id'];

		$where = array(
			'id' => $id,
		);
		$setting = $this->setting_model->find($where);
		$setting['category_id'] = explode(',', $setting['category_id']);
		$this->data['detail'] = $setting;

		$user = $this->ion_auth->user()->row();
		$temp_register = $this->temp_register_model->get_by_email_and_event_id($user->email, $event_id);
		$category_root = $this->category_model->fetch_all_root_by_event($event_id);
		$events = array();
		if ($category_root) {
			foreach ($category_root as $key => $value) {
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
		$this->data['setting_id'] = $id;

		$this->form_validation->set_rules('category_id[]','Tiêu chí','trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->render('member/setting/update');
		}else{
			if ($this->input->post()) {
                $category_id = ',' . implode(',', $this->input->post('category_id')) . ',';
				$data = array(
					'user_id' => $user->id,
					'event_id' => $event_id,
					'category_id' => $category_id,
					'temp_register_id' => $temp_register['id'],
				);
				$update = $this->setting_model->update($id, $data);
				if ($update) {
					$this->session->set_flashdata('success', 'Cập nhật thành công');
                    redirect('member/setting/index?event_id=' . $event_id, 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Cập nhật không thành công');
                    redirect('member/setting/update/' . $id . '?event_id=' . $event_id, 'refresh');
				}
			}
		}
		
	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Setting.php */
/* Location: ./application/controllers/member/Setting.php */
