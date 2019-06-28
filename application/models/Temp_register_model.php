<?php

/**
 * 
 */
class Temp_register_model extends MY_Model
{
	/**
	 * [$table description]
	 * @variables string
	 */
	public $table = 'temp_register';

	function __construct()
	{
		parent::__construct();
	}

	public function get_list_temp_register_by_event_id($event_id){
        $query = $this->db->select('*')
            ->from('temp_register')
            ->where('is_deleted', 0)
            ->where('event_id', $event_id)
            ->order_by("id", "desc");

        return $this->db->get()->result_array();
    }

    public function get_list_active_temp_register_by_event_id($event_id){
        $query = $this->db->select('*')
            ->from('temp_register')
            ->where('is_deleted', 0)
            ->where('event_id', $event_id)
            ->where('user_id is NOT NULL', NULL, FALSE)
            ->where('user_id !=', '')
            ->order_by("id", "desc");

        return $this->db->get()->result_array();
    }
	//////////////////

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
        $query = $this->db->select('temp_register.*, event.name as event_name')
            ->join('event', 'temp_register.event_id = event.id')
            ->from('temp_register')
            ->where('temp_register.is_deleted', 0)
            ->where('status', $status)
            ->limit($limit, $start)
            ->order_by("temp_register.id", "desc");

        if($keywords != ''){
            $this->db->where('code', $keywords);
        }

        return $this->db->get()->result_array();
    }

    public function approve($email, $event_id){
        $this->db->set(array('status' => 1))
            ->where('email', $email)
            ->where('event_id', $event_id)
            ->update('temp_register');

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function approve_and_set_user_id($email, $event_id, $user_id){
        $this->db->set(
            array(
                'status' => 1,
                'user_id' => $user_id,
                /** Maybe column is_charge will not be used */
                'is_charge' => 1
            )
        );
        $this->db->where('email', $email);
        $this->db->where('event_id', $event_id);
        $this->db->update('temp_register');

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function get_by_email_and_event_id($email, $user_id){
        $this->db->from($this->table);
        $this->db->where('email', $email);
        $this->db->where('user_id', $user_id);
        return $this->db->get()->row_array();
    }

    /**
     * Get temp register information for all of events they have joined
     * Use event for listing
     */
    public function get_by_user_id($user_id){
        $this->db->select('temp_register.*, event.id AS eventId, event.name AS eventName')
            ->from('temp_register')
            ->join('event', 'event.id = temp_register.event_id')
            ->where('user_id', $user_id)
            ->where('is_charge', 1);
        return $this->db->get()->result_array();
    }

    public function get_by_user_id_not_join($user_id){
        $this->db->select('*')
            ->from('temp_register')
            ->where('user_id', $user_id);
        return $this->db->get()->row_array();
    }
    public function get_by_user_id_not_join_saved($user_id){
        $this->db->select('*')
            ->from('temp_register')
            ->where('user_id', $user_id)
            ->where('is_saved', 1);
        return $this->db->get()->row_array();
    }

    public function check_user_exist_in_event($email, $event_id, $user_id){
	    $this->db->from('temp_register')
            ->where('email', $email)
            ->where('event_id', $event_id)
            ->where('user_id', $user_id);
        return $this->db->get()->row_array();
    }

    public function get_by_id($id){
        $this->db->from('temp_register');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function get_by_user_id_with_active_event($user_id){
	    $this->db->select(
	        'temp_register.*, 
	        event.name AS eventName, event.id AS eventId,
	        event.date AS eventDate, event.start AS eventStart,'

        )
            ->from('temp_register')
            ->join('setting', 'setting.user_id = temp_register.user_id')
            ->join('event', 'event.id = setting.event_id')
            ->where('temp_register.user_id', $user_id)
            ->where('event.is_active', 1);
        return $this->db->get()->row_array();
    }

    public function get_by_id_and_event($id, $event){
        $this->db->from('temp_register');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function get_by_id_with_select($id, $select){
        $this->db->from('temp_register');
        $this->db->select($select);
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function get_by_user_id_and_event($id, $event){
        $this->db->select('temp_register.*, event.name AS eventName')
            ->from('temp_register')
            ->join('event', 'event.id = temp_register.event_id')
            ->where('user_id', $id)
            ->where('event_id', $event);
        return $this->db->get()->row_array();
    }

    public function get_by_temp_register_id_and_event_id($temp_register_id){
        $this->db->select(
            'temp_register.*, 
	        event.name AS eventName, event.id AS eventId,
	        event.date AS eventDate, event.start AS eventStart,'

        )
            ->from('temp_register')
            ->join('setting', 'setting.user_id = temp_register.user_id')
            ->join('event', 'event.id = setting.event_id')
            ->where('temp_register.id', $temp_register_id)
            ->where('event.is_active', 1);
        return $this->db->get()->row_array();
    }
}