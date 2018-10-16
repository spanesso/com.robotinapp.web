 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cleaning_users_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('cleaning_users_model');
        $this->CI->load->library('folder_manager');
        $this->CI->load->library('file_manager');
    }

    public function get_user_data_by_id($user_id) {
        $user_data = $this->CI->cleaning_users_model->get_user_data_by_id($user_id);
        return $user_data;
    }

    public function get_enabled_cleaning_users() {
        $user_housekeeping_list = $this->CI->cleaning_users_model->get_enabled_cleaning_users();
        return $user_housekeeping_list;
    }

    public function get_cleaning_users() {
        $user_housekeeping_list = $this->CI->cleaning_users_model->get_cleaning_users();
        return $user_housekeeping_list;
    }

    public function get_count() {
        $count = $this->CI->cleaning_users_model->get_count();
        return $count;
    }

    public function update_data_user($user) {

        $img_user = $user["img"];

        $url_folder = $user["folder"];


        if ($img_user != "") {

            $id_image_name = uniqid();

            $url_folder_img_user = USERS_FOLDERS_WEB . "cleaning/" . $url_folder . "/user_" . $id_image_name . ".jpg";
            $url_fisic_folder_img = USERS_FOLDERS . "cleaning/" . $url_folder . "/user_" . $id_image_name . ".jpg";

            $this->CI->file_manager->upload_img($img_user, $url_fisic_folder_img);

            $user["img"] = $url_folder_img_user;
        }



        $user_scape = array_map('addslashes', $user);
        $is_user_udpate_format = $this->CI->cleaning_users_model->update_data_user($user_scape);
        $is_user_udpate = array_map('stripslashes', $is_user_udpate_format);


        return $is_user_udpate;
    }

    public function create_user($user) {

        $img_user = $user["img"];

        $url_folder_img_user = "";

        $token_folder = uniqid() . uniqid();
        $id_image_name = uniqid();
        $password = "cleaning_" . uniqid();

        $this->CI->folder_manager->create_cleaning_user_folder($token_folder);
        $employee_code = $this->generate_employee_code();


        if ($img_user != "null") {


            $url_folder_img_user = USERS_FOLDERS_WEB . "cleaning/" . $token_folder . "/user_" . $id_image_name . ".jpg";
            $url_fisic_folder_img = USERS_FOLDERS . "cleaning/" . $token_folder . "/user_" . $id_image_name . ".jpg";
            $this->CI->file_manager->upload_img($img_user, $url_fisic_folder_img);
        }

        $user["code"] = $employee_code;
        $user["img"] = $url_folder_img_user;
        $user["folder"] = $token_folder;
        $user["password"] = $password;


        $user_scape = array_map('addslashes', $user);
        $user_return_data_format = $this->CI->cleaning_users_model->save_data_new_user($user_scape);
        $user_return_data = array_map('stripslashes', $user_return_data_format);

        return $user_return_data;
    }

    public function generate_employee_code() {
        $code = "";
        do {
            $code = $this->generate_random_code();
        } while ($this->CI->cleaning_users_model->is_code_assigned($code));

        return $code;
    }

    public function generate_random_code() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '1234567890';

        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 3; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        $string .= "-";
        $max_num = strlen($numbers) - 1;
        for ($i = 0; $i < 3; $i++) {
            $string .= $numbers[mt_rand(0, $max_num)];
        }

        return $string;
    }

}
