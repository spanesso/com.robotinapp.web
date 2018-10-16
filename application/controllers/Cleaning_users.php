<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cleaning_users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cleaning_users_business');
    }

    function index() {

        $is_logged_in = $this->session->userdata('is_logged_in');


        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {
            $cleaning_user_list = $this->cleaning_users_business->get_cleaning_users();
            $this->data["cleaning_user_list"] = $cleaning_user_list;
            $this->_render('template/skeleton', 'pages/cleaning_users/cleaning_users_list', "cleaning_users", "cleaning_users");
        }
    }

       public function update_data_user() {

        $user = $this->input->post('user');

        $is_user_updated = $this->cleaning_users_business->update_data_user($user);

        echo json_encode($is_user_updated);
    }
    
    public function get_user_data_by_id() {

        $user_id = $this->input->post('id');
        $user_data = $this->cleaning_users_business->get_user_data_by_id($user_id);

        if ($user_data != null) {
            echo $this->return_message(200, "User profile.", $user_data->fetch_assoc());
        } else {
            echo $this->return_message(400, "Error to get user profile.", null);
        }
    }

    public function create() {

        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {
            $this->_render('template/skeleton', 'pages/cleaning_users/create_cleaning_user', "create_cleaning_user", "create_cleaning_user");
        }
    }

    public function create_user() {

        $user = $this->input->post('user');

        $is_user_created = $this->cleaning_users_business->create_user($user);

        echo json_encode($is_user_created);
    }

}
