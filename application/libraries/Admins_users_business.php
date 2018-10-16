 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admins_users_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('admins_users_model');
    }

    
      public function get_admin_users() {
        $user_admin_list = $this->CI->admins_users_model->get_admin_users();
        return $user_admin_list;
    }
    
    
    public function get_user_data_by_id($user_id) {
        $user_data = $this->CI->admins_users_model->get_user_data_by_id($user_id);
        return $user_data;
    }

  

    public function update_data_user($user) {
 
        $user_scape = array_map('addslashes', $user);
        $is_user_udpate_format = $this->CI->admins_users_model->update_data_user($user_scape);
        $is_user_udpate = array_map('stripslashes', $is_user_udpate_format);


        return $is_user_udpate;
    }

    public function create_admin($user) {

      
        $user_scape = array_map('addslashes', $user);
        $user_return_data_format = $this->CI->admins_users_model->create_admin($user_scape);
        $user_return_data = array_map('stripslashes', $user_return_data_format);

        return $user_return_data;
    }

}
