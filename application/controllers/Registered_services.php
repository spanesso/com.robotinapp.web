<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registered_services extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('registered_services_business');
        $this->load->library('cleaning_users_business');
            $this->load->library('service_business');
    }

    function index() {

        $is_logged_in = $this->session->userdata('is_logged_in');


        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {
            $registered_services_list = $this->registered_services_business->get_registered_services();
            $cleaning_user_list = $this->cleaning_users_business->get_enabled_cleaning_users();
            $this->data["cleaning_user_list"] = $cleaning_user_list;
            $this->data["registered_services_list"] = $registered_services_list;
            $this->_render('template/skeleton', 'pages/register_services/register_services_list', "register_services", "register_services");
        }
    }

    public function m_register_user() {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');

        $is_user_register = $this->register_business->m_register_user($name, $email, $phone, $password);
        echo json_encode($is_user_register);
    }

    public function assing_service() {
        $service = $this->input->post('service');
        $cleaning = $this->input->post('cleaning');
        $is_service_assigned = $this->registered_services_business->assing_service($service, $cleaning);
        echo json_encode($is_service_assigned);
    }

    public function confirm_approve_payment_service() {
        $service = $this->input->post('service'); 
        $is_service_assigned = $this->service_business->confirm_approve_payment_service($service);
        echo json_encode($is_service_assigned);
    }

    public function complete_company_register() {
        $company = $this->input->post('company');
        $is_enterprise_update = $this->register_business->complete_company_register($company);
        echo json_encode($is_enterprise_update);
    }

    public function register_user_company() {
        $data_user = $this->input->post('data_user');
        $is_register_user_company = $this->register_business->register_user_company($data_user);
        echo json_encode($is_register_user_company);
    }

    
     public function get_service_info_detail() {
        $id_service = $this->input->post('service');
           $status_service = $this->input->post('status');
        $service_info = $this->registered_services_business->get_service_info_detail($id_service,$status_service);

        echo json_encode($service_info);
    }
   
    public function get_service_info() {
        $id_service = $this->input->post('service');
        $service_info = $this->registered_services_business->get_service_info($id_service);

        echo json_encode($service_info);
    }

    public function get_sub_catgories() {
        $category = $this->input->post('category');
        $sub_catgory_list = $this->category_business->get_sub_catgories($category);

        echo json_encode($sub_catgory_list);
    }

    public function confirm_enterprise_register($enterprise_token) {

        $enterprise_register = $this->register_business->get_enterprise_data_by_token($enterprise_token);

        if ($enterprise_register != null) {
            $this->data["enterprise"] = $enterprise_register->fetch_assoc();
            $this->data["category_list"] = $this->category_business->get_category_list();
            $this->_simple_render('template/simple_skeleton', 'pages/login/complete_register', "complete_register", "complete_register");
        } else {
            $this->_simple_render('template/simple_skeleton', 'pages/error/error_token', "error_token", "error_token");
        }
    }

}
