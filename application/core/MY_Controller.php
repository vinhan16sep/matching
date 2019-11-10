<?php

class MY_Controller extends CI_Controller {


    protected $data = array();
    protected $author_info = array();
    protected $langAbbreviation = 'vi';

    const EMAIL_ADMIN = 'http.mt.html@gmail.com';

    function __construct() {
        parent::__construct();

        $this->load->library('ion_auth');

        $this->data['page_title'] = 'Business Matching Online';
        $this->data['before_head'] = '';
        $this->data['before_body'] = '';

        $this->data['active'] = $this->uri->segment(2);
        $this->data['sub_active'] = $this->uri->segment(3);
        $this->data['icon_active'] = $this->uri->segment(4);

        $this->load->library('session');
        // $this->langAbbreviation == 'en' || $this->langAbbreviation == 'vi' || 
        if($this->langAbbreviation == ''){
            $this->session->set_userdata('langAbbreviation', $this->langAbbreviation);
        }

        if($this->session->userdata('langAbbreviation') == 'en'){
            $langName = 'english';
            $this->config->set_item('language', $langName);
            $this->session->set_userdata("langAbbreviation",'en');
            $this->lang->load('english_lang', 'english');
        }

        if($this->session->userdata('langAbbreviation') == 'vi' || $this->session->userdata('langAbbreviation') == ''){
            $langName = 'vietnamese';
            $this->config->set_item('language', $langName);
            $this->session->set_userdata("langAbbreviation",'vi');
            $this->lang->load('vietnamese_lang', 'vietnamese');
        }
    }

    protected function render($the_view = NULL, $template = 'master') {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->data['lang'] = $this->langAbbreviation;
            $this->load->view('templates/' . $template . '_view', $this->data);
        }
    }

    protected function pagination_config($base_url, $total_rows, $per_page, $uri_segment) {
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;

        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = true;
        $config['last_link'] = true;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        return $config;
    }

    protected function pagination_con($base_url, $total_rows, $per_page, $uri_segment){
        $config['base_url']    = $base_url;
        $config['per_page']    = $per_page;
        $config['uri_segment'] = $uri_segment;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="paginate_button page-item">';
        $config['num_tag_close'] = '</li>';
        $config['total_rows']  = $total_rows;
        $config['reuse_query_string'] = true;
        $config['use_page_numbers'] = TRUE;
        return $config;
    }

    protected function upload_avatar($image_input_id ,$upload_path = '', $image_name = '' ) {
        $image = '';
        if (!empty($image_name)) {
            $config = $this->config_file_avatar($upload_path);
            $config['file_name'] = $image_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload($image_input_id)) {
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];

                // $config_thumb['source_image'] = $upload_path . '/' . $image;
                // $config_thumb['create_thumb'] = FALSE;
                // $config_thumb['maintain_ratio'] = TRUE;
                // $config_thumb['new_image'] = $upload_path;
                // $config_thumb['width'] = 200;

                // $this->load->library('image_lib', $config_thumb);

                // $this->image_lib->resize();
            }
        }

        return $image;
    }

    function config_file_avatar($upload_path = '') {
        $config = array();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '1200';
        $config['encrypt_name'] = TRUE;
        // $config['max_width']     = '1028';
        // $config['max_height']    = '1028';
        return $config;
    }

    protected function upload_file_word($file_input ,$upload_path = '', $file_name = '' ) {
        $file = '';
        if (!empty($file_name)) {
            $config = $this->config_file_word($upload_path);
            $config['file_name'] = $file_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload($file_input)) {
                $upload_data = $this->upload->data();
                $file = $upload_data['file_name'];
            }
        }

        return $file;
    }

    function config_file_word($upload_path = '') {
        $config = array();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'docx|doc|xlsx|xlsm|xlsb|xltx|xltm|xls|pdf';
        return $config;
    }

    protected function upload_file_pdf($file_input ,$upload_path = '', $file_name = '', $extension = '' ) {
        $file = '';
        if (!empty($file_name)) {
            $config = $this->config_file_pdf($upload_path);
            $config['file_name'] = $this->to_slug($file_name) . '-' . $extension;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload($file_input)) {
                $upload_data = $this->upload->data();
                $file = $upload_data['file_name'];
            }
        }

        return $file;
    }

    function config_file_pdf($upload_path = '') {
        $config = array();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'pdf';
        return $config;
    }

    function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    function return_api($status, $message='', $data = null,$isExisted= true){
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status)
            ->set_output(json_encode(array('status' => $status,'message' => $message , 'reponse' => $data, 'isExisted' => $isExisted)));
    }

}

class Admin_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')) {
            //redirect them to the login page
            redirect('admin/user/login', 'refresh');
        }
        $this->data['user_email'] = $this->ion_auth->user()->row()->email;
        $this->data['user_company'] = $this->ion_auth->user()->row()->company;
        $this->data['page_title'] = 'Administrator area';

        $this->load->model('event_model');

        // Get current class
        //$class = $this->router->fetch_class();
        // Set timezone
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Insert author informations to database when insert, update or delete
        $this->author_info = array(
            'created_at' => date('Y-m-d H:i:s', now()),
            'created_by' => $this->ion_auth->user()->row()->email,
            'modified_at' => date('Y-m-d H:i:s', now()),
            'modified_by' => $this->ion_auth->user()->row()->email
        );

        $this->data['active_event'] = $this->event_model->fetch_all_by_active();

        $class = $this->router->fetch_class();
        $method = $this->router->fetch_method();

        $allowed = false;
        if($this->data['user_email'] == PIKOM){
            if($class == 'event' && $method == 'detail'){
                $allowed = true;
            }else if($class == 'dashboard'){
                $allowed = true;
            }else if($class == 'request' && ($method == 'index' || $method == 'approved')){
                $allowed = true;
            }else{
                redirect('admin/event/detail/12','refresh');
            }
        }

//        if($allowed == false){
//            redirect('admin/event/detail/12','refresh');
//        }
    }

    protected function render($the_view = NULL, $template = 'admin_master') {
        parent::render($the_view, $template);
    }

    protected function upload_image($image_input_id, $image_name, $upload_path, $upload_thumb_path = '', $thumbs_with = 75, $thumbs_height = 50) {
        $image = '';
        if (!empty($image_name)) {
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $image_name;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload($image_input_id)) {
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];

                $config_thumb['source_image'] = $upload_path . '/' . $image;
                $config_thumb['create_thumb'] = TRUE;
                $config_thumb['maintain_ratio'] = TRUE;
                $config_thumb['new_image'] = $upload_thumb_path;
                $config_thumb['width'] = $thumbs_with;
                $config_thumb['height'] = $thumbs_height;

                $this->load->library('image_lib', $config_thumb);

                $this->image_lib->resize();
            }
        }

        return $image;
    }

    function upload_file($upload_path = '', $file_name = '')
    {
        //lay thong tin cau hinh upload
        $config = $this->config($upload_path);

        //lưu biến môi trường khi thực hiện upload
        $file  = $_FILES[$file_name];
        $count = count($file['name']);//lấy tổng số file được upload

        $image_list = array(); //luu ten cac file anh upload thanh cong
        for($i=0; $i<=$count-1; $i++) {

            $_FILES['userfile']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
            $_FILES['userfile']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
            $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
            $_FILES['userfile']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
            $_FILES['userfile']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
            //load thư viện upload và cấu hình
            $this->load->library('upload', $config);
            //thực hiện upload từng file
            if($this->upload->do_upload())
            {
                //nếu upload thành công thì lưu toàn bộ dữ liệu
                $data = $this->upload->data();
                //in cấu trúc dữ liệu của các file
                $image_list[] = $data['file_name'];
            }
        }
        return $image_list;
    }

    function config($upload_path = '')
    {
        //Khai bao bien cau hinh
        $config = array();
        //thuc mục chứa file
        $config['upload_path']   = $upload_path;
        //Định dạng file được phép tải
        $config['allowed_types'] = 'jpg|png|gif';
        //Dung lượng tối đa
        $config['max_size']      = '1024';
//        //Chiều rộng tối đa
//        $config['max_width']     = '1028';
//        //Chiều cao tối đa
//        $config['max_height']    = '1028';

        return $config;
    }
}

class Member_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in() ) {
            //redirect them to the login page
            $this->ion_auth->logout();
            $this->session->set_flashdata('login_message_error', $this->ion_auth->errors());
            redirect('member/user/login', 'refresh');
        }
        if (!$this->ion_auth->in_group('members')) {
            $this->ion_auth->logout();
            $this->session->set_flashdata('login_message_error', 'Tài khoản không có quyền truy cập');
            redirect('member/user/login');
        }

        $this->load->library('session');

        $this->langAbbreviation = $this->uri->segment(1) ? $this->uri->segment(1) : 'vi';
        if($this->langAbbreviation == ''){
            $this->session->set_userdata('langAbbreviation', $this->langAbbreviation);
        }

        if($this->session->userdata('langAbbreviation') == 'en'){
            $langName = 'english';
            $this->config->set_item('language', $langName);
            $this->session->set_userdata("langAbbreviation",'en');
            $this->lang->load('english_lang', 'english');
        }

        if($this->session->userdata('langAbbreviation') == 'vi' || $this->session->userdata('langAbbreviation') == ''){
            $langName = 'vietnamese';
            $this->config->set_item('language', $langName);
            $this->session->set_userdata("langAbbreviation",'vi');
            $this->lang->load('vietnamese_lang', 'vietnamese');
        }

        $this->load->model('temp_register_model');
        $user = $this->ion_auth->user()->row();
        $this->data['user_email'] = $user->email;
        $this->data['current_user_temp_register'] = $this->temp_register_model->get_by_user_id($user->id);
        $current_user_temp_register = $this->data['current_user_temp_register'];
        if(!empty($current_user_temp_register) && $current_user_temp_register['is_saved'] == 1){
            $this->data['is_temp_register'] = true;
        }else{
            $this->data['is_temp_register'] = false;
        }
        $this->data['page_title'] = $this->lang->line('Pages for businesses');

        // Get current class
        //$class = $this->router->fetch_class();
        // Set timezone
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Insert author informations to database when insert, update or delete
        $this->author_info = array(
            'created_at' => date('Y-m-d H:i:s', now()),
            'created_by' => $this->ion_auth->user()->row()->email,
            'modified_at' => date('Y-m-d H:i:s', now()),
            'modified_by' => $this->ion_auth->user()->row()->email
        );

        $this->load->model('setting_model');
        /** Because multiple event, this way will not be used anymore */
//        $this->data['self_temp_register'] = $this->temp_register_model->get_by_user_id_and_event($this->ion_auth->user()->row()->id, $this->ion_auth->user()->row()->event_id);
        $this->data['list_event_of_current_user'] = $this->setting_model->get_by_user_id_with_active_event($this->ion_auth->user()->row()->id);
    }



    protected function render($the_view = NULL, $template = 'member_master') {
        parent::render($the_view, $template);
    }

    protected function upload_image($image_input_id, $image_name, $upload_path, $upload_thumb_path = '', $thumbs_with = 75, $thumbs_height = 50) {
        $image = '';
        if (!empty($image_name)) {
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $image_name;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload($image_input_id)) {
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];

                $config_thumb['source_image'] = $upload_path . '/' . $image;
                $config_thumb['create_thumb'] = TRUE;
                $config_thumb['maintain_ratio'] = TRUE;
                $config_thumb['new_image'] = $upload_thumb_path;
                $config_thumb['width'] = $thumbs_with;
                $config_thumb['height'] = $thumbs_height;

                $this->load->library('image_lib', $config_thumb);

                $this->image_lib->resize();
            }
        }

        return $image;
    }

    function upload_file($upload_path = '', $file_name = '')
    {
        //lay thong tin cau hinh upload
        $config = $this->config($upload_path);

        //lưu biến môi trường khi thực hiện upload
        $file  = $_FILES[$file_name];
        $count = count($file['name']);//lấy tổng số file được upload

        $image_list = array(); //luu ten cac file anh upload thanh cong
        for($i=0; $i<=$count-1; $i++) {

            $_FILES['userfile']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
            $_FILES['userfile']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
            $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
            $_FILES['userfile']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
            $_FILES['userfile']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
            //load thư viện upload và cấu hình
            $this->load->library('upload', $config);
            //thực hiện upload từng file
            if($this->upload->do_upload())
            {
                //nếu upload thành công thì lưu toàn bộ dữ liệu
                $data = $this->upload->data();
                //in cấu trúc dữ liệu của các file
                $image_list[] = $data['file_name'];
            }
        }
        return $image_list;
    }

    function config($upload_path = '')
    {
        //Khai bao bien cau hinh
        $config = array();
        //thuc mục chứa file
        $config['upload_path']   = $upload_path;
        //Định dạng file được phép tải
        $config['allowed_types'] = 'jpg|png|gif';
        //Dung lượng tối đa
        $config['max_size']      = '1024';
//        //Chiều rộng tối đa
//        $config['max_width']     = '1028';
//        //Chiều cao tối đa
//        $config['max_height']    = '1028';

        return $config;
    }
}

class Public_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');

        if (empty($this->session->userdata('langAbbreviation'))) {
            $this->langAbbreviation = $this->uri->segment(1) ? $this->uri->segment(1) : 'vi';
        }
        if($this->langAbbreviation == ''){
            $this->session->set_userdata('langAbbreviation', $this->langAbbreviation);
        }

        if($this->session->userdata('langAbbreviation') == 'en'){
            $langName = 'english';
            $this->config->set_item('language', $langName);
            $this->session->set_userdata("langAbbreviation",'en');
            $this->lang->load('english_lang', 'english');
        }

        if($this->session->userdata('langAbbreviation') == 'vi' || $this->session->userdata('langAbbreviation') == ''){
            $langName = 'vietnamese';
            $this->config->set_item('language', $langName);
            $this->session->set_userdata("langAbbreviation",'vi');
            $this->lang->load('vietnamese_lang', 'vietnamese');
        }

        $this->data['show_intro_popup'] = false;

    }

    protected function render($the_view = NULL, $template = 'master') {
        parent::render($the_view, $template);
    }

}
