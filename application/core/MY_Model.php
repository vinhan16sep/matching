<?php

class MY_Model extends CI_Model
{

	function __construct(){
        parent::__construct();
    }


    /**
     * [build_unique_slug description]
     * @param  [type] $slug [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function build_unique_slug($slug, $id = null){
        $count = 0;
        $temp_slug = $slug;
        while(true) {
            $this->db->select('id');
            $this->db->where('slug', $temp_slug);
            if($id != null){
                $this->db->where('id !=', $id);
            }
            $query = $this->db->get($this->table);
            if ($query->num_rows() == 0) break;
            $temp_slug = $slug . '-' . (++$count);
        }
        return $temp_slug;
    }


    /**
     * [insert description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    function save($data) {
        $this->db->set($data)->insert($this->table);

        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * [update description]
     * @param  [type] $id   [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function update($id, $data){
         $this->db->where('id', $id);

        return $this->db->update($this->table, $data);
    }

    /**
     * [find_row_array description]
     * @return [type] [description]
     */
    public function find_row_array($where = array()){
        $this->db->where($where);
        return $this->db->count_all_results($this->table);
    }

    /**
     * [find_row_array description]
     * @param  array  $where [description]
     * @return [type]        [description]
     */
    public function find($where = array()){
        $this->db->from($this->table);
        $this->db->where($where);
        return $this->db->get()->row_array();
    }

    /**
     * [count description]
     * @return [type] [description]
     */
    public function count() {
        $query = $this->db->select('*')
            ->from($this->table)
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }
}