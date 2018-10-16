<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cleaning_users_business');
        $this->load->library('plans_business');
        $this->load->library('dashboard_business');
    }

    public function verify_active_services() {
        $is_services_activation_verified = $this->dashboard_business->verify_active_services();

        echo $is_services_activation_verified;
    }

    function index() {


        //JOB TO VERIFY ACTIVATE SERVICES



        $is_logged_in = $this->session->userdata('is_logged_in');


        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {

    
            $total_plans = $this->plans_business->get_count();
            $total_cleaning_user = $this->cleaning_users_business->get_count();

             $this->data["total_plans"] = $total_plans;
            $this->data["total_cleaning_user"] = $total_cleaning_user;

            $this->_render('template/skeleton', 'pages/dashboard/dashboard', "dashboard", "dashboard");
        }
    }
    
    public function get_charts_data(){
             $charts_data = $this->dashboard_business->get_charts_data();
             echo json_encode($charts_data);
    }

}
