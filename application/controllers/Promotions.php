<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Promotions extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('promotions_business');
    }

    function index() {

        $is_logged_in = $this->session->userdata('is_logged_in');


        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {
            //get promotions list
            $promotions_list = $this->promotions_business->get_promotions_list();
            $this->data["promotions_list"] = $promotions_list;

            $this->_render('template/skeleton', 'pages/promotions/promotions_list', "promotions", "promotions");
        }
    }

    public function create() {

        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {
            $this->_render('template/skeleton', 'pages/promotions/create_promotion', "create_promotion", "create_promotion");
        }
    }

    public function is_code_exists() {
        $code = $this->input->post('code');
        $is_code_exists = $this->promotions_business->is_code_exists($code);
        echo json_encode($is_code_exists);
    }

    public function create_promotion() {
        $promotion = $this->input->post('promotion');
        $is_promotion_created = $this->promotions_business->create_promotion($promotion);
        echo json_encode($is_promotion_created);
    }

    public function update_promotion() {
        $promotion = $this->input->post('promotion');


        $is_promotion_updated = $this->promotions_business->update_promotion($promotion);
        echo json_encode($is_promotion_updated);
    }

    public function get_promotion_data_by_id() {

        $promotion_id = $this->input->post('id');
        $promotion_data = $this->promotions_business->get_promotion_data_by_id($promotion_id);

        if ($promotion_data != null) {
            echo $this->return_message(200, "Promotion data.", $promotion_data->fetch_assoc());
        } else {
            echo $this->return_message(400, "Error to get promotion data.", null);
        }
    }

    public function enable_or_disabled_promotion() {
        $promotion = $this->input->post('promotion');
        $is_promotion_updated = $this->promotions_business->enable_or_disabled_promotion($promotion);
        echo json_encode($is_promotion_updated);
    }

}
