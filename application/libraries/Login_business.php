 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('login_model');
        $this->CI->load->library('session_manager');
    }

    public function authorize_user_entry($email, $pass) {
        $user_autorize = $this->CI->login_model->authorize_user_entry($email, $pass);
        if ($user_autorize != null) {
            $user = $user_autorize->fetch_object();
            $this->CI->session_manager->save_data_user($user);
            return true;
        } else {
            return false;
        }
    }

    public function update_enterprise_data($enterprise_id, $enterprise_data) {

        $img_enterprise = $enterprise_data["enterprise_img"];
        $img_admin = $enterprise_data["admin_img"];

        $url_folder_img_enterprise = "";
        $url_folder_img_admin = "";

        $enterprise_token_folder = $this->CI->register_model->get_enterprise_token_folder($enterprise_id);

        if ($enterprise_token_folder != null) {
            if ($img_enterprise != "null") {
                $url_folder_img_enterprise = ENTERPRISE_FOLDERS_WEB . $enterprise_token_folder . "/enterprise_" . uniqid() . ".jpg";
                $url_fisic_folder_img_enterprise = ENTERPRISE_FOLDERS . $enterprise_token_folder . "/enterprise_" . uniqid() . ".jpg";
                $this->CI->file_manager->upload_img($img_enterprise, $url_fisic_folder_img_enterprise);
            }

            if ($img_admin != "null") {
                $url_folder_img_admin = ENTERPRISE_FOLDERS_WEB . $enterprise_token_folder . "/img/admin_enterprise_" . uniqid() . ".jpg";
                $url_fisic_folder_img_admin = ENTERPRISE_FOLDERS . $enterprise_token_folder . "/img/admin_enterprise_" . uniqid() . ".jpg";
                $this->CI->file_manager->upload_img($img_admin, $url_fisic_folder_img_admin);
            }
        }

        $enterprise_data["enterprise_img"] = $url_folder_img_enterprise;
        $enterprise_data["admin_img"] = $url_folder_img_admin;

        $is_enterprise_update = $this->CI->register_model->update_enterprise_data($enterprise_id, $enterprise_data);

        return $is_enterprise_update;
    }

    public function m_login_user($email,$pass) {
        $user_autorize = $this->CI->login_model->m_login_user($email,$pass);
       if ($user_autorize != null) {
            $user = $user_autorize->fetch_object();
            
            $message_return = array(
                "status" => "200",
                "data" => $user,
                "message" => "Login successful."
            );
       
            return $message_return;
        } else {
            
            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Login error."
            );
            return $message_return;
        }
    }

    public function get_enterprise_data_by_token($enterprise_token) {
        $enterprise_data = $this->CI->register_model->get_enterprise_data_by_token($enterprise_token);
        return $enterprise_data;
    }

    public function register_enterprise_bussines($enterprise_data) {

        $enterprise_folder_token = uniqid();
        $enterprise_key = $enterprise_folder_token . $this->randomPassword();

        $enterprise_admin_password = "DEF-COM-" . $this->randomPassword();

        $enterprise_data["enterprise_folder_token"] = $enterprise_folder_token;
        $enterprise_data["enterprise_token"] = $enterprise_key;
        $enterprise_data["enterprise_admin_password"] = $enterprise_admin_password;


        $enterprise_data_scape = array_map('addslashes', $enterprise_data);

        $is_enterprise_save = $this->CI->register_model->register_enterprise($enterprise_data_scape);

        if ($is_enterprise_save) {
            $this->CI->folder_manager->create_enterprise_folder($enterprise_folder_token);
            //TODO:
             //$this->CI->mail_manager->send_enterprise_email($enterprise_data);
        }


        return $is_enterprise_save;
    }

    protected function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}
