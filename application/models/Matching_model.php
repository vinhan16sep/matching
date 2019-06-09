<?php

class Matching_model extends CI_Model {

    function __construct(){
        parent::__construct();
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
        $this->db->set($data)->insert('matching');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }
        return false;
    }

    public function update($id, $data){
        $this->db->set($data)
            ->where('id', $id)
            ->update('matching');

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

    public function get_send_request_by_temp_register_id_and_event($temp_register_id, $event_id){
        $query = $this->db->select('*')
            ->from('matching')
            ->where('finder_id', $temp_register_id)
            ->where('event_id', $event_id)
            ->order_by("date", "desc");

        return $result = $query->get()->result_array();
    }

    public function get_receive_request_by_temp_register_id_and_event($temp_register_id, $event_id){
        $query = $this->db->select('*')
            ->from('matching')
            ->where('target_id', $temp_register_id)
            ->where('event_id', $event_id)
            ->order_by("date", "desc");

        return $result = $query->get()->result_array();
    }

    public function get_by_id($id)
    {
        $query = $this->db->select('*')
            ->from('matching')
            ->where('id', $id)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }
        return false;
    }

    public function get_booked_time($current_user_id, $target, $event){
        $query = $this->db->select('date')
            ->from('matching')
            ->group_start()
                ->where_in('finder_id', array($current_user_id, $target))
                ->or_where_in('target_id', array($current_user_id, $target))
            ->group_end()
            ->where('event_id', $event)
            ->where('status', 1)
            ->order_by("date", "desc");

        return $result = $query->get()->result_array();
    }

}