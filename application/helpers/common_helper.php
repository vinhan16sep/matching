<?php

if (!function_exists('handle_common_author_data')) {
    /**
     * @return array
     */
    function handle_author_common_data() {
        $CI =& get_instance();
        $CI->load->library('ion_auth');

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        return array(
            // 'created_at' => date('Y-m-d H:i:s', now()),
            'created_at' => now(),
            'created_by' => $CI->ion_auth->user()->row()->username,
            // 'updated_at' => date('Y-m-d H:i:s', now()),
            'updated_at' => now(),
            'updated_by' => $CI->ion_auth->user()->row()->username
        );
    }
}

function array_helper_map($data, $key = 'id', $value = 'name'){
    $return = array();
    if ($data) {
        foreach ($data as $key => $value) {
            $return[$value['id']] = $value['name'];
        }
    }
    return $return;
}

function array_helper_get_column($column, $data){
    $return = array();
    if ($data && $column != '') {
        foreach ($data as $key => $value) {
            if ($value[$column]) {
                $return[] = $value[$column];
            }
        }
    }
    return $return;
}
