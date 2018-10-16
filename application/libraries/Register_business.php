 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register_business {

    protected $CI;

    public function __construct() {

        $this->CI = & get_instance();
        $this->CI->load->model('register_model');
        $this->CI->load->library('folder_manager');
        $this->CI->load->library('file_manager');
        $this->CI->load->library('mail_manager');
    }

    public function complete_company_register($company) {

        $company_img = $company["company_img"];
        $company_banner_img = $company["company_banner_img"];
        $company_img_url = "";
        $company_banner_img_url = "";

        $company_folder = $this->CI->register_model->get_company_folder($company["company_id"]);

        if ($company_folder != null) {

            $unique_id_company = uniqid();

            if ($company_img != "null") {
                $company_img_url = ENTERPRISE_FOLDERS_WEB . $company_folder . "/company/company_" . $unique_id_company . ".jpg";
                $url_fisic_folder_img_enterprise = ENTERPRISE_FOLDERS . $company_folder . "/company/company_" . $unique_id_company . ".jpg";

                $company["company_img"] = $company_img_url;
                $this->CI->file_manager->upload_img($company_img, $url_fisic_folder_img_enterprise);
            }

            if ($company_banner_img != "null") {
                $company_banner_img_url = ENTERPRISE_FOLDERS_WEB . $company_folder . "/company/company_banner_" . $unique_id_company . ".jpg";
                $url_fisic_folder_img_enterprise_banner = ENTERPRISE_FOLDERS . $company_folder . "/company/company_banner_" . $unique_id_company . ".jpg";

                $company["company_banner_img"] = $company_banner_img_url;
                $this->CI->file_manager->upload_img($company_banner_img, $url_fisic_folder_img_enterprise_banner);
            }
        }

        $is_company_update = $this->CI->register_model->update_company_data($company);
        $is_enterprise_update_format = array_map('stripslashes', $is_company_update);

        return $is_enterprise_update_format;
    }

    public function register_user_company($data_user) {

        $enterprise_folder_token = uniqid();
        $enterprise_key = $enterprise_folder_token . $this->randomPassword();
        $enterprise_admin_password = "AFI-" . $this->randomPassword();


        $data_user["enterprise_folder_token"] = $enterprise_folder_token;
        $data_user["enterprise_token"] = $enterprise_key;
        $data_user["admin_password"] = $enterprise_admin_password;


        $enterprise_data_scape = array_map('addslashes', $data_user);

        $is_enterprise_save_format = $this->CI->register_model->register_enterprise($enterprise_data_scape);

        $is_enterprise_save = array_map('stripslashes', $is_enterprise_save_format);

        if ($is_enterprise_save["status"] == 200) {
            $this->CI->folder_manager->create_enterprise_folder($enterprise_folder_token);

             //$this->CI->mail_manager->send_enterprise_email($data_user);
             //$this->CI->mail_manager->send_enterprise_admin_email($data_user["enterprise_token"], $data_user["name"], $data_user["email"], $data_user["admin_password"]);

            return $is_enterprise_save;
        } else {
            return $is_enterprise_save;
        }
    }

    protected function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function get_enterprise_data_by_token($enterprise_token) {
        $enterprise_data = $this->CI->register_model->get_enterprise_data_by_token($enterprise_token);
        return $enterprise_data;
    }

    public function m_register_user($name, $email, $phone, $password) {


        $token_folder = uniqid() . uniqid();
        $this->CI->folder_manager->create_client_user_folder($token_folder);

        $register_data = $this->CI->register_model->m_register_user($name, $email, $phone, $password, $token_folder);
        if ($register_data["status"] == "200") {
             //$this->CI->mail_manager->send_register_client_email($name, $email, $phone, $password);
        }

        return $register_data;
    }

}
