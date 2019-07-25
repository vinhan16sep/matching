<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller
{

    function __construct(){
        parent::__construct();
        if(!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('message','You are not allowed to visit the Event setting page');
            redirect('admin','refresh');
        }
        $this->load->model('category_model');
        $this->load->model('event_model');
        $this->load->helper('common_helper');
    }

    public function index(){
        $event_id = $this->input->get('event');
        if(!$event_id){
            redirect('admin/event','refresh');
        }
        $this->data['page_title'] = 'Category';

        $categories = array();
        $root = $this->category_model->fetch_all_root_by_event($event_id);
        if($root){
            foreach($root as $key => $item){
                $categories[$key] = $item;
                $sub = $this->category_model->fetch_all_sub_by_event_and_parent($event_id, $item['id']);
                foreach ($sub as $k => $val) {
                    $child = $this->category_model->fetch_all_sub_by_event_and_parent($event_id, $val['id']);
                    $sub[$k]['sub'] = $child;
                }
                $categories[$key]['sub'] = $sub;
            }
        }
        $this->data['categories'] = $categories;
        $this->data['event_id'] = $event_id;
        $this->data['event'] = $this->event_model->fetch_by_id($event_id);
        $this->render('admin/category/list_category_view');
    }

    public function create(){
        $params = $this->input->get();
        $this->data['page_title'] = 'Create event';

        $data = array(
            'name' => $params['name'],
            'parent_id' => $params['parent'],
            'event_id' => $params['event'],
            'level' => $params['level'],
        );

        $result = $this->category_model->insert($data);
        if($result){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 1)));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 0)));
    }

    public function edit($id = NULL){
        $params = $this->input->get();
        $this->data['page_title'] = 'Update event';

        $data = array(
            'name' => $params['name'],
        );

        $result = $this->category_model->update($params['id'], $data);
        if($result){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 1)));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 0)));
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

    public function delete_category(){
        $id = $this->input->get('id');
        $ids = array();
        $child_ids = array();
        $grand_children_ids = array();
        $ids[] = $id;
        $where = array(
            'id' => $id,
            'is_deleted' => 0
        );
        $category = $this->category_model->where_row_array($where);
        if ($category) {

            $where_parent = array(
                'parent_id' => $id,
                'is_deleted' => 0
            );
            $category_by_parent = $this->category_model->where_result_array($where_parent);
            if ($category_by_parent) {
                $child_ids = array_helper_get_column('id', $category_by_parent);
                $grand_children = $this->category_model->fetch_by_parent_ids($child_ids);
                if ($grand_children) {
                    $grand_children_ids = array_helper_get_column('id', $grand_children);
                }
            }
            $ids = array_merge($ids, $child_ids, $grand_children_ids);
            $update = $this->category_model->update_multiple($ids, ['is_deleted' => 1]);
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('status' => true)));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('status' => false)));
    }

}