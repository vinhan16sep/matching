<?php

class Event_model extends CI_Model {

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

    public function count_active() {
        $query = $this->db->select('*')
            ->from('event')
            ->where('is_deleted', 0)
            ->where('is_active', 1)
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

    public function fetch_all_group_concat_by_active() {
        $query = $this->db->select('GROUP_CONCAT(id) as ids')
            ->from('event')
            ->where('is_deleted', 0)
            ->where('is_active', 1)
            ->order_by("id", "desc");

        return $result = $query->get()->row_array();
    }

    public function register($event, $user){
        $this->db->set(array(
            'user_id' => $user,
            'event_id' => $event
        ))->insert('users_events');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }
        return false;
    }

    public function verify_charge_status($event_id, $user_id){
        $query = $this->db->select('*')
            ->from('setting')
            ->where('event_id', $event_id)
            ->where('user_id', $user_id)
            ->get();

        return $query->row_array();
    }

    public function request_active($event_id, $user_id, $code){
        $this->db->set(array('status' => 2, 'code' => $code))
            ->where('event_id', $event_id)
            ->where('user_id', $user_id)
            ->update('setting');

        if($this->db->affected_rows() == 1){
            return true;
        }
        return false;
    }

}