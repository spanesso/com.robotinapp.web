<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('admins_users_business');
    }

    function index() {

        $is_logged_in = $this->session->userdata('is_logged_in');


        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {
            $user_admin_list = $this->admins_users_business->get_admin_users();
            $this->data["user_admin_list"] = $user_admin_list;
            $this->_render('template/skeleton', 'pages/admins_users/admins_users_list', "admins_users", "admins_users");
        }
    }

    public function create() {

        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {

            $this->_render('template/skeleton', 'pages/admins_users/create_admin', "create_admin", "create_admin");
        }
    }

    public function create_admin() {
        $user = $this->input->post('user');
        $is_admin_created = $this->admins_users_business->create_admin($user);
        echo json_encode($is_admin_created);
    }

    public function get_user_data_by_id() {

        $user_id = $this->input->post('id');
        $user_data = $this->admins_users_business->get_user_data_by_id($user_id);

        if ($user_data != null) {
            echo $this->return_message(200, "User profile.", $user_data->fetch_assoc());
        } else {
            echo $this->return_message(400, "Error to get user profile.", null);
        }
    }

    public function update_data_user() {

        $user = $this->input->post('user');

        $is_user_updated = $this->admins_users_business->update_data_user($user);

        echo json_encode($is_user_updated);
    }

}
