 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_manager {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function upload_img($data64_img, $folder) {
        $img_file = base64_decode($data64_img);
        if (file_put_contents($folder, $img_file)) {
            return true;
        } else {
            return false;
        }
    }

    public function upload_img_from_mobile($data64_img, $folder) {
     
        if (file_put_contents($folder, $data64_img)) {
            return true;
        } else {
            return false;
        }
    }

}
