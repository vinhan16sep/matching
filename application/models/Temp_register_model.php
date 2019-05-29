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

    public function count() {
        $query = $this->db->select('*')
            ->from('temp_register')
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }

    public function fetch_all_pagination($limit = NULL, $start = NULL) {
        $query = $this->db->select('*')
            ->from('temp_register')
            ->where('is_deleted', 0)
            ->limit($limit, $start)
            ->order_by("id", "desc");

        return $result = $query->get()->result_array();
    }
}