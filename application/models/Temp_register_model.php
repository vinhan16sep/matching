<?php

/**
 * 
 */
class Temp_register_model extends MY_Model
{
	/**
	 * [$table description]
	 * @var string
	 */
	public $table = 'temp_register';

	function __construct()
	{
		parent::__construct();
	}

    public function count($keywords = '') {
        $query = $this->db->select('*')
            ->from('temp_register')
            ->where('is_deleted', 0);
        if($keywords != ''){
            $this->db->where('code', $keywords);
        }
        return $this->db->get()->num_rows();
    }

    public function fetch_all_pagination($limit = NULL, $start = NULL, $status, $keywords = '') {
        $query = $this->db->select('*')
            ->from('temp_register')
            ->where('is_deleted', 0)
            ->where('status', $status)
            ->limit($limit, $start)
            ->order_by("id", "desc");

        if($keywords != ''){
            $this->db->where('code', $keywords);
        }

        return $this->db->get()->result_array();
    }

    public function approve($email){
        $this->db->set(array('status' => 1))
            ->where('email', $email)
            ->update('temp_register');

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }
}