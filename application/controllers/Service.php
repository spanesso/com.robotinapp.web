<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('plans_business');
        $this->load->library('service_business');
    }

    public function aaa() {
        $this->service_business->aaa();
    }

    public function m_register_confirm_payment_service() {

        $id_user = $this->input->post('id_user');
        $id_service = $this->input->post('id_service');
        $total_payment = $this->input->post('total_payment');
        $promotion = $this->input->post('promotion');

        $register_payment = $this->service_business->m_register_confirm_payment_service($id_user, $id_service, $total_payment, $promotion);
        echo json_encode($register_payment);
    }

    public function m_register_confirm_recurring_payment_service() {

        $id_user = $this->input->post('id_user');
        $id_service = $this->input->post('id_service');
        $total_payment = $this->input->post('total_payment');
        $promotion = $this->input->post('promotion');

        $register_payment = $this->service_business->m_register_confirm_recurring_payment_service($id_user, $id_service, $total_payment, $promotion);
        echo json_encode($register_payment);
    }

    public function m_get_user_service() {

        $user = $this->input->post('id_user');
        $service_list = $this->service_business->m_get_user_service($user);
        echo json_encode($service_list);
    }

    public function m_get_asigned_service_detail() {

        $service = $this->input->post('id_service');
        $service_detail = $this->service_business->m_get_asigned_service_detail($service);
        echo json_encode($service_detail);
    }

    public function m_register_service() {

        $service = array(
            "id_client" => $this->input->post('id_client'),
            "id_plan" => $this->input->post('id_plan'),
            "id_category" => $this->input->post('id_category'),
            "place_address" => $this->input->post('place_address'),
            "label_address" => $this->input->post('label_address'),
            "place_name" => $this->input->post('place_name'),
            "description" => $this->input->post('description'),
            "zip_code" => $this->input->post('zip_code'),
            "apto" => $this->input->post('apto'),
            "schedule_service" => $this->input->post('schedule_service')
        );

        $is_service_register = $this->service_business->m_register_service($service);
        echo json_encode($is_service_register);
    }

    public function m_apply_promotion() {
        $id_promotion = $this->input->post('promotion');
        $id_user = $this->input->post('user');
        $id_service = $this->input->post('service');
        $is_promotion_apply = $this->service_business->m_apply_promotion($id_promotion, $id_user, $id_service);
        echo json_encode($is_promotion_apply);
    }

    public function m_check_is_valid_code() {
        $code = $this->input->post('code');
        $id_user = $this->input->post('user');
        $is_valid_code = $this->service_business->m_check_is_valid_code($code, $id_user);
        echo json_encode($is_valid_code);
    }

    public function m_register_pay_service() {
        $id_service = $this->input->post('id_service');

        $is_service_register = $this->service_business->m_register_pay_service($id_service);
        echo json_encode($is_service_register);
    }

    public function m_cancel_register_service() {
        $id_service = $this->input->post('id_service');

        $is_service_canceled = $this->service_business->m_cancel_register_service($id_service);
        echo json_encode($is_service_canceled);
    }

    public function m_get_plans() {
        $plan = $this->input->post('plan');
        $is_plan_created = $this->plans_business->create_plan($plan);
        echo json_encode($is_plan_created);
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

}
