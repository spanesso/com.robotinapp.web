 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promotions_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('promotions_model');
    }

    public function is_code_exists($code) {
        $is_code_exists = $this->CI->promotions_model->is_code_exists($code);


        return $is_code_exists;
    }

    public function get_promotions_list() {
        $promotions_list = $this->CI->promotions_model->get_promotions_list();
        return $promotions_list;
    }

    public function create_promotion($promotion) {
        $is_promotion_created = $this->CI->promotions_model->create_promotion($promotion);
        return $is_promotion_created;
    }

    public function get_promotion_data_by_id($promotion_id) {
        $promotion_data = $this->CI->promotions_model->get_promotion_data_by_id($promotion_id);
        return $promotion_data;
    }

    public function update_promotion($promotion) {
        $is_promotion_updated = $this->CI->promotions_model->update_promotion($promotion);
        return $is_promotion_updated;
    }

    public function enable_or_disabled_promotion($promotion) {
        $is_promotion_updated = $this->CI->promotions_model->enable_or_disabled_promotion($promotion);
        return $is_promotion_updated;
    }

}
