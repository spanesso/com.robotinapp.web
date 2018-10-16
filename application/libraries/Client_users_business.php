 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client_users_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('client_users_model'); 
          $this->CI->load->library('folder_manager');
        $this->CI->load->library('file_manager');
    }

    public function update_data_user($user) {

        $img_user = $user["photo"];
        $url_folder = $user["folder"];


        if ($img_user != "") {
            $id_image_name = uniqid();
            $url_folder_img_user = USERS_FOLDERS_WEB . "client/" . $url_folder . "/user_" . $id_image_name . ".jpg";
            $url_fisic_folder_img = USERS_FOLDERS . "client/" . $url_folder . "/user_" . $id_image_name . ".jpg";
            $this->CI->file_manager->upload_img($img_user, $url_fisic_folder_img);
            $user["photo"] = $url_folder_img_user;
        }

        $user_scape = array_map('addslashes', $user);
        $is_user_udpate_format = $this->CI->client_users_model->update_data_user($user_scape);
        $is_user_udpate = array_map('stripslashes', $is_user_udpate_format);

        if($is_user_udpate["status"] == "200"){
            $is_user_udpate["data"] =  $url_folder_img_user;
        }
        
        return $is_user_udpate;
    }
}
