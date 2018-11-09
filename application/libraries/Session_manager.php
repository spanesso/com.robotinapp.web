 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Session_manager {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function save_data_user($user) {


        $data_ses = array(
            'id_admin' => $user->idUser,
            'id_rol' => $user->idRol,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password,
            'is_logged_in' => true
        );

        if ($this->CI->session->set_userdata($data_ses)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function destroy_data_user() {
        $this->CI->session->set_userdata(null);
        if ($this->CI->session->sess_destroy()) {
            echo true;
        } else {
            echo false;
        }
    }

}
