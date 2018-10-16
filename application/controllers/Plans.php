<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('plans_business');
    }

    function index() {

        $is_logged_in = $this->session->userdata('is_logged_in');


        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {
            $plans_list = $this->plans_business->get_plans();
            $category_plans = $this->plans_business->get_category_plans();
            $this->data["category_plans"] = $category_plans;
            $this->data["plans_list"] = $plans_list;
            $this->_render('template/skeleton', 'pages/plans/plans_list', "plans_list", "plans_list");
        }
    }

    public function create_plan() {
        $plan = $this->input->post('plan');
        $is_plan_created = $this->plans_business->create_plan($plan);
        echo json_encode($is_plan_created);
    }

    public function create() {

        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in !== true) {
            $this->_simple_render('template/simple_skeleton', 'pages/login/login', "login", "login");
        } else {
            $category_plans = $this->plans_business->get_category_plans();
            $this->data["category_plans"] = $category_plans;
            $this->_render('template/skeleton', 'pages/plans/create_plan', "create_plan", "create_plan");
        }
    }

    public function get_plan_data_by_id() {

        $id_plan = $this->input->post('id');
        $plan_data = $this->plans_business->get_plan_data_by_id($id_plan);

        if ($plan_data != null) {
            echo $this->return_message(200, "Plan data.", $plan_data->fetch_assoc());
        } else {
            echo $this->return_message(400, "Error to get plan.", null);
        }
    }

    public function update_data_plan() {

        $plan = $this->input->post('plan');

        $is_plan_updated = $this->plans_business->update_data_plan($plan);

        echo json_encode($is_plan_updated);
    }
    public function m_get_plans() {
        $is_plan_updated = $this->plans_business->m_get_plans();
        echo json_encode($is_plan_updated);
    }

}
