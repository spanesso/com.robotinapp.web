<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('login_business');
    }

    function index() {

        $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
    }

     public function m_login_user() {
        $email = $this->input->post('email');
        $pass = $this->input->post('password'); 
        
        $is_user_register = $this->login_business->m_login_user($email,$pass);
        echo json_encode($is_user_register);
    }
    public function authorize_user_entry() {

        $email = $this->input->post('email');
        $pass = $this->input->post('pass'); 

        $is_log_in = $this->login_business->authorize_user_entry($email, $pass);

        if ($is_log_in) {
            echo $this->return_message(200, "Welcome to Clean App", null);
        } else {
            echo $this->return_message(400, "Error: invalid user", null);
        }
    }

}
