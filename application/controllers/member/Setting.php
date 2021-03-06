<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Member_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('setting_model');
		$this->load->model('event_model');
		$this->load->model('category_model');
		$this->load->model('temp_register_model');
		$this->load->helper('common_helper');
		
		if(empty($this->data['current_user_temp_register']) || $this->data['current_user_temp_register']['is_saved'] != 1){
		    redirect('member/information', 'refresh');
        }
	}

	// List all your items
	public function index(){
        $this->data['page_title'] = $this->lang->line("Competencies");
		$user = $this->ion_auth->user()->row();

		$this->load->library('pagination');
        $total_rows  = $this->setting_model->count_by_user_id($user->id);
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
        $result = $this->setting_model->fetch_all_pagination_by_user_id_not_event_id($user->id, $per_page, $per_page * $this->data['page']);
        
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
	
	public function all(){
        $this->load->helper('form');
		$this->load->library('form_validation');

		$user = $this->ion_auth->user()->row();
		$events = $this->event_model->fetch_all_by_active();
		
		$setting = $this->setting_model->get_by_user_id($user->id);
		$event_ids = array_helper_get_column('event_id', $setting);
		if ($events) {
			foreach ($events as $key => $value) {
				if (in_array($value['id'], $event_ids)) {
					$events[$key]['reg_stt'] = 1;
				} else {
					$events[$key]['reg_stt'] = 0;
				}

				if (!empty($setting)) {
					foreach ($setting as $sKey => $sVal) {
						if ($sVal['event_id'] == $value['id']) {
							$events[$key]['_setting_id'] = $sVal['id'];
						} else {
							$events[$key]['_setting_id'] = 0;
						}
					}
				}
			}
		}
		$this->data['events'] = $events;
		$this->data['page_title'] = $this->lang->line("quanlysukien");

		$this->render('member/setting/all');
	}

	public function event(){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', $this->lang->line("Event"), 'required', array(
            'required' => '%s '.$this->lang->line("khongduoctrong").'!'
        ));

		$user = $this->ion_auth->user()->row();
		$events = $this->event_model->fetch_all_by_active();
		
		$setting = $this->setting_model->get_by_user_id($user->id);
		$event_ids = array_helper_get_column('event_id', $setting);
		$event_ids_remove = array();
		if ($events) {
			foreach ($events as $key => $value) {
				if (in_array($value['id'], $event_ids)) {
					unset($events[$key]);
				}
			}
		}
		$this->data['events'] = $events;
		$this->data['page_title'] = $this->lang->line("quanlysukien");
		if ($this->form_validation->run() == FALSE) {
			$this->render('member/setting/create_event');
		} else {
			$event_ids = $this->input->post('event_id');
			$ids = explode(',', $event_ids);
			if ($ids) {
				foreach ($ids as $key => $value) {
					$data['user_id'] = $user->id;
					$data['event_id'] = $value;
					$save = $this->setting_model->save($data);
				}
			}
			$this->session->set_flashdata('success', $this->lang->line("themsukienthanhcong"));
            redirect('member/setting', 'refresh');
		}
		
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
		if ($category_root) {
			foreach ($category_root as $key => $value) {
				if ($value['sub']) {
					foreach ($value['sub'] as $item => $child) {
						if ($category) {
							foreach ($category as $i => $v) {
								if ($v['parent_id'] == $child['id']) {
									$category_root[$key]['sub'][$item]['sub'][] = $v;
								}
							}
						}
					}
				}
			}
		}
		return $category_root;

	}

	// Add a new item
	public function create(){
        $this->data['page_title'] = $this->lang->line("Competencies");
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
			$this->session->set_flashdata('error', $this->lang->line("bandadangkytieuchi"));
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

		$this->form_validation->set_rules('category_id[]',$this->lang->line("nangluc"),'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->render('member/setting/create');
		} else {
			if ($this->input->post()) {
				$category_id = ',' . implode(',', $this->input->post('category_id')) . ',';
				$data = array(
					'user_id' => $user->id,
					'event_id' => $event_id,
					'category_id' => $category_id,
				);

				$insert = $this->setting_model->save($data);
				if ($insert) {
					$this->session->set_flashdata('success', $this->lang->line("dangkythanhcong"));
                    redirect('member/setting/index?event_id=' . $event_id, 'refresh');
				}else{
					$this->session->set_flashdata('error', $this->lang->line("dangkykhongthanhcong"));
                    redirect('member/setting/create?event_id=' . $event_id, 'refresh');
				}
			}
		}
	}

	//Update one item
	public function update( $id = NULL ){
        
		$this->load->helper('form');
		$this->load->library('form_validation');

        $params = $this->input->get();
        if(!$params['event_id']){
            redirect('member/dashboard/index', 'refresh');
        }
        $this->data['event_id'] = $event_id = $params['event_id'];
        $event = $this->event_model->fetch_by_id($event_id);
        $this->data['page_title'] = $this->lang->line("Competencies").' <strong>' . $event['name'] . '</strong>';

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
		$check_require_update = 0;
		if ($category_root) {
			foreach ($category_root as $key => $value) {
				$events[$value['id']]['name'] = $value['name'];
				$events[$value['id']]['require'] = $value['require'];
				if ($value['require'] == 1) {
					$check_require_update++;
				}
				$category_sub = $this->category_model->fetch_all_sub_by_event_and_parent($event_id, $value['id']);
				if ($category_sub) {
					foreach ($category_sub as $k => $val) {
						$childs = $this->category_model->fetch_all_sub_by_event_and_parent($event_id, $val['id']);
						
						if ($childs) {
							foreach ($childs as $item => $child) {
								$events[$value['id']][$val['id']]['name'] = $val['name'];
								$events[$value['id']][$val['id']][$child['id']] = $child['name'];
							}
						}else{
							$events[$value['id']][$val['id']] = $val['name'];
						}
					}
				}
			}
		}
		$this->data['events'] = $events;
		$this->data['setting_id'] = $id;

		if ($check_require_update > 0) {
			$this->form_validation->set_rules('category_id[]',$this->lang->line("nangluc"),'trim|required');
		}else{
			$this->form_validation->set_rules('category_id[]',$this->lang->line("nangluc"),'trim');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->render('member/setting/update');
		}else{
			if ($this->input->post()) {
                $category_id = ',' . (!empty($this->input->post('category_id')) ? implode(',', $this->input->post('category_id')) : '') . ',';
				$data = array(
					'user_id' => $user->id,
					'event_id' => $event_id,
					'category_id' => $category_id,
				);
				$update = $this->setting_model->update($id, $data);
				if ($update) {
					$this->session->set_flashdata('success', $this->lang->line("capnhatthanhcong"));
                    redirect('member/setting/all', 'refresh');
				}else{
					$this->session->set_flashdata('error', $this->lang->line("capnhatkhongthanhcong"));
                    redirect('member/setting/update/' . $id . '?event_id=' . $event_id, 'refresh');
				}
			}
		}
		
	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
	
	public function register() {
        $id = $this->input->get('id');
		$name = $this->input->get('name');
		$user = $this->ion_auth->user()->row();

		$data['user_id'] = $user->id;
		$data['event_id'] = $id;
		$save = $this->setting_model->save($data);
		if ($save) {
			return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 1)));
		}
		return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 0)));
	}
}

/* End of file Setting.php */
/* Location: ./application/controllers/member/Setting.php */
