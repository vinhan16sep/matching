<?php

class Category_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function fetch_all_root_by_event($event_id) {
        $getByLang = ($this->session->userdata('langAbbreviation') == 'vi') ? 'name' : 'name_en';
        $query = $this->db->select("*, $getByLang AS name")
            ->from('category')
            ->where('is_deleted', 0)
            ->where('event_id', $event_id)
            ->where('level', 0)
            ->where('parent_id', 0)
            ->order_by("id", "asc");

        return $result = $query->get()->result_array();
    }

    public function fetch_all_sub_by_event_and_parent($event_id, $parent) {
        $getByLang = ($this->session->userdata('langAbbreviation') == 'vi') ? 'name' : 'name_en';
        $query = $this->db->select("*, $getByLang AS name")
            ->from('category')
            ->where('is_deleted', 0)
            ->where('event_id', $event_id)
            ->where('level', 1)
            ->where('parent_id', $parent)
            ->order_by("id", "asc");

        return $result = $query->get()->result_array();
    }

    public function insert($data){
        $this->db->set($data)->insert('category');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }
        return false;
    }

    public function update($id, $data){
        $this->db->set($data)
            ->where('id', $id)
            ->update('category');

        if($this->db->affected_rows() == 1){
            return true;
        }
        return false;
    }

    public function update_multiple($ids = array(), $data){
        $this->db->set($data)
            ->where_in('id', $ids)
            ->update('category');
        return true;
    }

    public function fetch_by_ids($ids) {
        $query = $this->db->select('*')
            ->from('category')
            ->where('is_deleted', 0)
            ->where_in('id', $ids)
            ->order_by("id", "asc");

        return $result = $query->get()->result_array();
    }

    public function fetch_by_parent_ids($parent_ids) {
        $query = $this->db->select('*')
            ->from('category')
            ->where('is_deleted', 0)
            ->where_in('parent_id', $parent_ids)
            ->order_by("id", "asc");

        return $result = $query->get()->result_array();
    }

    public function where_row_array($where = array()){
        $query = $this->db->select('*')
            ->from('category')
            ->where($where);

        return $result = $query->get()->row_array();
    }

    public function where_result_array($where = array()){
        $query = $this->db->select('*')
            ->from('category')
            ->where($where);

        return $result = $query->get()->result_array();
    }
}