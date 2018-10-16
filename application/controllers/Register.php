<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('register_business');
        $this->load->library('category_business');
    }

    function index() {
        $this->_simple_render('template/simple_skeleton', 'pages/login/register', "register", "register");
    }

     public function test() {
         echo "hola";
     }
     public function m_register_user() {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        
        $is_user_register = $this->register_business->m_register_user($name,$email,$phone,$password);
        echo json_encode($is_user_register);
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
