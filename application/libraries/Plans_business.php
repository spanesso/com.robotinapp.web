 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Plans_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('plans_model');
    }

    public function get_plan_data_by_id($id_plan) {
        $plan_data = $this->CI->plans_model->get_plan_data_by_id($id_plan);
        return $plan_data;
    }

    public function get_plans() {
        $plans_list = $this->CI->plans_model->get_plans();
        return $plans_list;
    }

    public function get_category_plans() {
        $category_plans = $this->CI->plans_model->get_category_plans();
        return $category_plans;
    }

    public function update_data_plan($plan) {


        $plan_scape = array_map('addslashes', $plan);
        $plan_scape_format = $this->CI->plans_model->update_data_plan($plan_scape);
        $is_plan_updated = array_map('stripslashes', $plan_scape_format);


        return $is_plan_updated;
    }

    public function create_plan($plan) {

        $plan_scape = array_map('addslashes', $plan);
        $plan_return_data_format = $this->CI->plans_model->create_plan($plan_scape);
        $plan_return_data = array_map('stripslashes', $plan_return_data_format);

        return $plan_return_data;
    }

    public function get_count() {
        $count = $this->CI->plans_model->get_count();
        return $count;
    }

    public function m_get_plans() {
        $plans = $this->CI->plans_model->m_get_plans();
        
         if ($plans != null) {
             
            
            $message_return = array(
                "status" => "200",
                "data" => $plans,
                "message" => "Plan list."
            );
       
            return $message_return;
        } else {
            
            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Empty list"
            );
            return $message_return;
        }
     
    }

}
