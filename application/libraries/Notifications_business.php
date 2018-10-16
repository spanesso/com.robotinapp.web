 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('notifications_model'); 
    }

  
    public function m_get_user_notifications($user) {
        $register_service = $this->CI->notifications_model->m_get_user_notifications($user);
        return $register_service;
    }

    

}
