<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends MY_Model {

	public $table = 'setting';
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function fetch_all_pagination_by_user_id($user_id, $limit = NULL, $start = NULL, $event_id) {
        $query = $this->db->select('setting.*, event.*, setting.id as setting_id')
        	->from('setting')
            ->join('event', 'setting.event_id = event.id')
            ->where('setting.user_id', $user_id)
            ->where('setting.is_deleted', 0)
            ->where('event.id', $event_id)
            ->limit($limit, $start)
            ->order_by("setting.id", "desc");

        return $this->db->get()->result_array();
    }

    public function fetch_all_pagination_by_user_id_not_event_id($user_id, $limit = NULL, $start = NULL) {
        $query = $this->db->select('setting.*, event.*, setting.id as setting_id')
            ->from('setting')
            ->join('event', 'setting.event_id = event.id')
            ->where('setting.user_id', $user_id)
            ->where('setting.is_deleted', 0)
            ->limit($limit, $start)
            ->order_by("setting.id", "desc");

        return $this->db->get()->result_array();
    }

    /**
     * For pending request list
     * @param string $keywords
     * @return mixed
     */
    public function count_request($status, $keywords = '') {
        $this->db->select('*')
            ->from('setting')
            ->where('is_deleted', 0)
            ->where('status', $status);
        if($keywords != ''){
            $this->db->where('code', $keywords);
        }
        return $this->db->get()->num_rows();
    }

    public function fetch_all_request_pagination($limit = NULL, $start = NULL, $status, $keywords) {
        $this->db->select('setting.*, event.name as eventName, temp_register.*, setting.id as settingId')
            ->join('event', 'setting.event_id = event.id')
            ->join('temp_register', 'temp_register.user_id = setting.user_id')
            ->from('setting')
            ->where('setting.is_deleted', 0)
            ->where('setting.status', $status)
            ->limit($limit, $start)
            ->order_by("setting.id", "desc");

        if($keywords != ''){
            $this->db->where('setting.code', $keywords);
        }

        return $this->db->get()->result_array();
    }




    public function count_by_user_id_and_event_id($user_id, $event_id)
    {
    	$this->db->from($this->table);
    	$this->db->where('user_id', $user_id);
    	$this->db->where('event_id', $event_id);
    	return $this->db->get()->num_rows();
    }
    public function count_by_user_id($user_id)
    {
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);
        $this->db->where('is_deleted', 0);
        return $this->db->get()->num_rows();
    }

    public function get_matched_setting_data($event, $setting, $user_id){
        $this->db->from('setting');
        $this->db->where('is_deleted', 0);
        $this->db->where('event_id', $event);
        $this->db->where('user_id !=', $user_id);
        $this->db->where('status', 1);
        $this->db->group_start();
        foreach($setting as $value){
            $this->db->or_like('category_id', ',' . $value . ',');
        }
        $this->db->group_end();
        return $this->db->get()->result_array();
    }

    public function get_by_user_id($user_id){
        $this->db->from('setting');
        $this->db->where('is_deleted', 0);
        $this->db->where('user_id', $user_id);

        return $this->db->get()->result_array();
    }

    public function get_by_user_id_with_active_event($user_id){
        $this->db->select(
            'setting.*, 
	        event.name AS eventName, event.id AS eventId,
	        event.date AS eventDate, event.start AS eventStart,'

        )
            ->from('setting')
            ->join('event', 'event.id = setting.event_id')
            ->where('setting.user_id', $user_id)
            ->where('event.is_active', 1);
        return $this->db->get()->result_array();
    }

    public function update($id, $data){
        $this->db->set($data)
            ->where('id', $id)
            ->update('setting');

        if($this->db->affected_rows() == 1){
            return true;
        }
        return false;
    }
}

/* End of file Setting_model.php */
/* Location: ./application/models/Setting_model.php */