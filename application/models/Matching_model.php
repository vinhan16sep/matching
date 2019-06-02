<?php

class Matching_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function count() {
        $query = $this->db->select('*')
            ->from('event')
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }

    public function fetch_all_pagination($limit = NULL, $start = NULL) {
        $query = $this->db->select('*')
            ->from('event')
            ->where('is_deleted', 0)
            ->limit($limit, $start)
            ->order_by("id", "desc");

        return $result = $query->get()->result_array();
    }

    public function fetch_by_id($id){
        $query = $this->db->select('*')
            ->from('event')
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }
        return false;
    }

    public function insert($data){
        $this->db->set($data)->insert('event');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }
        return false;
    }

    public function update($id, $data){
        $this->db->set($data)
            ->where('id', $id)
            ->update('event');

        if($this->db->affected_rows() == 1){
            return true;
        }
        return false;
    }

    public function fetch_all_by_active() {
        $query = $this->db->select('*')
            ->from('event')
            ->where('is_deleted', 0)
            ->where('is_active', 1)
            ->order_by("id", "desc");

        return $result = $query->get()->result_array();
    }

}