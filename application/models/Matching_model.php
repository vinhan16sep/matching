<?php

class Matching_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function get_list_matching_by_event_and_status($event_id, $status){
        $query = $this->db->select('*')
            ->from('matching')
            ->where('event_id', $event_id)
            ->where('status', $status)
            ->order_by("id", "desc");

        return $this->db->get()->result_array();
    }
    //////////////////

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

    public function reject_same_time_matching($matching, $log){
        $this->db->set(array('status' => 2, 'log' => $log))
            ->group_start()
                ->where_in('finder_id', array($matching['finder_id'], $matching['target_id']))
                ->or_where_in('target_id', array($matching['finder_id'], $matching['target_id']))
            ->group_end()
            ->where('event_id', $matching['event_id'])
            ->where('date', $matching['date'])
            ->where('status', 0)
            ->update('matching');

        if($this->db->affected_rows() == 1){
            return true;
        }
        return false;
    }

    public function get_all_by_event_id_with_pagination_search($event_id, $limit = NULL, $start = NULL, $keyword='') {
        $this->db->select('matching.*, temp_register_finder.company as company_finder, temp_register_target.company as company_target');
        $this->db->from('matching');
        $this->db->join('temp_register as temp_register_finder', 'matching.finder_id = temp_register_finder.id', 'left');
        $this->db->join('temp_register as temp_register_target', 'matching.target_id = temp_register_target.id', 'left');
        $this->db->where('matching.event_id', $event_id);
        $this->db->where('matching.status', 1);
        $this->db->like('temp_register_finder.company', $keyword);
        $this->db->or_like('temp_register_target.company', $keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by("matching.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_search($event_id = '', $keyword = ''){
        $this->db->select('matching.*, temp_register_finder.company as company_finder, temp_register_target.company as company_target');
        $this->db->from('matching');
        $this->db->join('temp_register as temp_register_finder', 'matching.finder_id = temp_register_finder.id', 'left');
        $this->db->join('temp_register as temp_register_target', 'matching.target_id = temp_register_target.id', 'left');
        $this->db->like('temp_register_finder.company', $keyword);
        $this->db->or_like('temp_register_target.company', $keyword);
        $this->db->where('matching.event_id', $event_id);
        $this->db->where('matching.status', 1);

        return $result = $this->db->get()->num_rows();
    }
}