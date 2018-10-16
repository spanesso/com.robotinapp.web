<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends MY_Controller {

    public function __construct() {
        parent::__construct();
   
        $this->load->library('notifications_business');
    }

   

    public function m_get_user_notifications() {

        $user = $this->input->post('id_user');
        $service_list = $this->notifications_business->m_get_user_notifications($user);
        echo json_encode($service_list);
    }

     
}
