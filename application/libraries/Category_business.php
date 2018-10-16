 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('category_model');
    }

    public function get_category_list() {
        $category_list = $this->CI->category_model->get_category_list();
        return $category_list;
    }

    public function get_sub_catgories($category) {
        $sub_catgory_list = $this->CI->category_model->get_sub_catgories($category);
        return $sub_catgory_list;
    }
}
