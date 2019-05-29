<?php

class Category_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function fetch_all_root_by_event($event_id) {
        $query = $this->db->select('*')
            ->from('category')
            ->where('is_deleted', 0)
            ->where('event_id', $event_id)
            ->where('level', 0)
            ->where('parent_id', 0)
            ->order_by("id", "asc");

        return $result = $query->get()->result_array();
    }

    public function fetch_all_sub_by_event_and_parent($event_id, $parent) {
        $query = $this->db->select('*')
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
}