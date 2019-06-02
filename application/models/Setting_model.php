<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends MY_Model {

	public $table = 'setting';
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function fetch_all_pagination_by_user_id($user_id, $limit = NULL, $start = NULL, $keywords = '') {
        $query = $this->db->select('setting.*, event.*, setting.id as setting_id')
        	->from('setting')
            ->join('event', 'setting.event_id = event.id')
            ->where('setting.is_deleted', 0)
            ->limit($limit, $start)
            ->order_by("setting.id", "desc");

        return $this->db->get()->result_array();
    }

    public function count_by_user_id_and_event_id($user_id, $event_id)
    {
    	$this->db->from($this->table);
    	$this->db->where('user_id', $user_id);
    	$this->db->where('event_id', $event_id);
    	return $this->db->get()->num_rows();
    }

}

/* End of file Setting_model.php */
/* Location: ./application/models/Setting_model.php */