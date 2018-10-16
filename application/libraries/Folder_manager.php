 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Folder_manager {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function create_enterprise_folder($enterprise_folder_token) {

        $path = USERS_FOLDERS . $enterprise_folder_token;



        if (!is_dir(USERS_FOLDERS)) {
            mkdir(USERS_FOLDERS, 0777, TRUE);
        }
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
            mkdir($path . "/company", 0777, TRUE);
            mkdir($path . "/users", 0777, TRUE);
            mkdir($path . "/tips", 0777, TRUE);
            mkdir($path . "/logs", 0777, TRUE);
        }
    }

    public function create_cleaning_user_folder($folder_token) {
        $path = USERS_FOLDERS . "cleaning/" . $folder_token;
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }
    }

    public function create_client_user_folder($folder_token) {
        $path = USERS_FOLDERS . "client/" . $folder_token;
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }
    }
}
