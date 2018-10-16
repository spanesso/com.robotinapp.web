<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client_users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('client_users_business');
    }

    function index() {
        
    }

    public function update_profile() {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $otherPhone = $this->input->post('otherPhone');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $photo = $this->input->post('photo');
        $folder = $this->input->post('folder');
        
        
        $user = array(
                "id" => $id,
                "folder" => $folder,
                "name" => $name,
                "otherPhone" => $otherPhone,
                "phone" => $phone,
                "email" => $email,
                "password" => $password,
                "photo" => $photo 
                
            );
        
         

        $is_user_updated = $this->client_users_business->update_data_user($user);

        echo json_encode($is_user_updated);
    }

    

}
