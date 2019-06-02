<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Member_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('information_model');
        $this->load->model('team_model');
        $this->load->model('new_rating_model');
        $this->load->model('status_model');
        $this->load->model('users_model');
    }

    public function index(){
        $this->data['page_title'] = 'Tổng quan';
        $this->render('member/dashboard_view');
    }

    public function users(){
        if ($this->ion_auth->user()->row()->member_role != 'leader') {
            redirect('member','refresh');
        }
        $user = $this->ion_auth->user()->row();
        if ($user->member_role == 'leader') {
            $this->data['team'] = $this->get_personal_members_by_leader($user->id);

            $this->data['user_id'] = $user->id;

            $this->render('member/dashboard_leader_view');
        }
    }

    public function get_personal_products($user_id){
        $list_team = $this->team_model->get_current_user_team($user_id);
        if ( !empty($list_team) ) {
            foreach($list_team as $key => $value){
                $product_ids = explode(',', $value['product_id']);
                if ( is_array($product_ids) && !empty($product_ids) ) {
                    foreach($product_ids as $k => $val){
                        if(empty($val)){
                            unset($product_ids[$k]);
                        }
                    }
                    if($product_ids){
                        $products = $this->information_model->get_personal_products($product_ids);
                        if ($products) {
                            foreach ($products as $it => $item) {
                                $check_product_is_rating = $this->new_rating_model->check_rating_exist_by_product_id('new_rating', $item['id'], $user_id);
                                if ( $check_product_is_rating ) {
                                    $products[$it]['is_rating'] = 1;
                                }else{
                                    $products[$it]['is_rating'] = 0;
                                }
                            }
                        }
                        $list_team[$key]['product_list'] = $products;
                    }

                }
            }
        }
        return $list_team;
    }

    public function get_personal_products_by_leader($user_id){
        $list_team = $this->team_model->get_current_leader($user_id);
        if ( !empty($list_team) ) {
            foreach($list_team as $key => $value){
                $product_ids = explode(',', $value['product_id']);
                if ( is_array($product_ids) && !empty($product_ids) ) {
                    foreach($product_ids as $k => $val){
                        if(empty($val)){
                            unset($product_ids[$k]);
                        }
                    }
                    if($product_ids){
                        $products = array();
                        foreach ($product_ids as $k => $val) {
                            $product_by_id = $this->information_model->fetch_by_id('product', $val);
                            $products[$k] = $product_by_id;
                        }
                        
                        // $products = $this->information_model->get_personal_products($product_ids);
                        if ($products) {
                            foreach ($products as $it => $item) {
                                $check_product_is_rating = $this->new_rating_model->check_rating_exist_by_product_id('new_rating', $item['id'], $user_id);
                                if ( $check_product_is_rating ) {
                                    $products[$it]['is_rating'] = 1;
                                }else{
                                    $products[$it]['is_rating'] = 0;
                                }
                            }
                        }
                        $list_team[$key]['product_list'] = $products;
                    }

                }
            }
        }
        return $list_team;
    }

    public function get_personal_members_by_leader($user_id){
        $list_team = $this->team_model->get_current_leader($user_id);
        if ( !empty($list_team) ) {
            foreach($list_team as $key => $value){
                $member_ids = explode(',', $value['member_id']);
                if ( is_array($member_ids) && !empty($member_ids) ) {
                    foreach($member_ids as $k => $val){
                        if(empty($val)){
                            unset($member_ids[$k]);
                        }
                    }
                    if($member_ids){
                        $members = $this->information_model->get_personal_members($member_ids);
                        $list_team[$key]['member_list'] = $members;
                    }

                }
            }
        }
        return $list_team;
    }
}