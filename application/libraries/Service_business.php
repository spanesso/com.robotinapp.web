 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('service_model');
        $this->CI->load->library('mail_manager');
    }

    public function confirm_approve_payment_service($id_service) {

        $is_payment_approve_register = $this->CI->service_model->confirm_approve_payment_service($id_service);

        $message_return = null;

        if ($is_payment_approve_register) {

            $service_data = $this->CI->service_model->m_get_service_by_id($id_service);
            //$this->CI->mail_manager->send_confirm_pay_service($service_data["data"]);
            //PUSH NOTIFICATIONS

            $message_return = array(
                "status" => "200",
                "data" => null,
                "message" => "Payment register successful"
            );
        } else {
            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Erro to register payment, contact to CleannApp Admin."
            );
        }



        return $message_return;
    }

    public function m_register_confirm_payment_service($id_user, $id_service, $total_payment, $promotion) {
        date_default_timezone_set('America/New_York');
        $today = date("d-m-Y G:i:s");
        $is_payment_register = $this->CI->service_model->m_register_confirm_payment_service($id_user, $id_service, $total_payment, $promotion, $today);

        $message_return = null;

        if ($is_payment_register) {

            $service_data = $this->CI->service_model->m_get_service_by_id($id_service);
            //$this->CI->mail_manager->send_confirm_pay_service($service_data["data"]);
            //PUSH NOTIFICATIONS

            $message_return = array(
                "status" => "200",
                "data" => null,
                "message" => "Payment register successful"
            );
        } else {
            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Erro to register payment, contact to CleannApp Admin."
            );
        }



        return $message_return;
    }

    public function aaa() {
        $service_data = $this->CI->service_model->m_get_service_by_id(6);
        echo json_encode($service_data);
    }

    public function m_register_confirm_recurring_payment_service($id_user, $id_service, $total_payment, $promotion) {
        date_default_timezone_set('America/New_York');
        $today = date("d-m-Y G:i:s");
        $is_payment_register = $this->CI->service_model->m_register_confirm_recurring_payment_service($id_user, $id_service, $total_payment, $promotion, $today);

        $message_return = null;

        if ($is_payment_register) {

            $service_data = $this->CI->service_model->m_get_service_by_id($id_service);
            //$this->CI->mail_manager->send_confirm_recurring_pay_service($service_data["data"]);
            //PUSH NOTIFICATIONS

            $message_return = array(
                "status" => "200",
                "data" => null,
                "message" => "Payment register, pending for approve."
            );
        } else {
            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Erro to register payment, contact to CleannApp Admin."
            );
        }



        return $message_return;
    }

    public function m_apply_promotion($id_promotion, $id_user, $id_service) {
        date_default_timezone_set('America/New_York');
        $today = date("d-m-Y G:i:s");
        $is_promotion_apply = $this->CI->service_model->m_apply_promotion($id_promotion, $id_user, $id_service, $today);
        return $is_promotion_apply;
    }

    public function m_check_is_valid_code($code, $id_user) {
        $promotion = $this->CI->service_model->m_check_is_valid_code($code, $id_user);

        $message_return = null;

        if ($promotion != 1 && $promotion != 2) {

            if ($this->is_current_promotion($promotion)) {
                $message_return = array(
                    "status" => "200",
                    "data" => $promotion,
                    "message" => "Valid code."
                );
            } else {
                $message_return = array(
                    "status" => "400",
                    "data" => null,
                    "message" => "The promotion has expired."
                );
            }
        } else {

            $message = "";

            if ($promotion == 1) {
                $message = "Invalid code.";
            } else {
                $message = "You have already redeemed this code.";
            }

            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => $message
            );
        }

        return $message_return;
    }

    private function is_current_promotion($promotion) {
        date_default_timezone_set('America/New_York');
        $today = date("Y-m-d");

        $finish_date = $promotion["finish_date"];
        $finish_date_array = explode("/", $finish_date);
        $format_finish_date = $finish_date_array[2] . "-" . $finish_date_array[1] . "-" . $finish_date_array[0];


        $finish_date_strtotime = strtotime(date("Y-m-d", strtotime($format_finish_date)) . " +" . 0 . " month");
        $finish_date_format = date("Y-m-d", $finish_date_strtotime);

        $dFinish = new DateTime($finish_date_format);
        $dEnd = new DateTime($today);
        $dDiff = $dFinish->diff($dEnd);
        $difference_days = intval($dDiff->days);
        $difference_days_format = $dDiff->format('%R');


        if ($difference_days == 0) {
            return false;
        } else {

            if ($difference_days_format == "+") {
                return false;
            } else {
                return true;
            }
        }
    }

    public function m_register_service($service) {
        date_default_timezone_set('America/New_York');
        $today = date("d-m-Y G:i:s");
        $service["date"] = $today;

        $register_service = $this->CI->service_model->m_register_service($service);
        if ($register_service["status"] == "200") {
            // PUSH NOTIFICATIONS
            //$this->CI->mail_manager->send_register_service_message($service);
        }
        return $register_service;
    }

    public function m_register_pay_service($id_service) {
        date_default_timezone_set('America/New_York');
        $today = date("d-m-Y G:i:s");


        $register_service = $this->CI->service_model->m_register_pay_service($id_service, $today);
        if ($register_service["status"] == "200") {
            //$this->CI->mail_manager->send_register_pay_service_message();
        }
        return $register_service;
    }

    public function m_cancel_register_service($id_service) {
        date_default_timezone_set('America/New_York');
        $today = date("d-m-Y G:i:s");


        $cancel_service = $this->CI->service_model->m_cancel_register_service($id_service, $today);
        if ($cancel_service["status"] == "200") {

            $service_data = $this->CI->service_model->m_get_service_by_id($id_service);
            //$this->CI->mail_manager->send_confirm_cancel_service($service_data["data"]);
        }
        return $cancel_service;
    }

    public function m_get_user_service($user) {
        $register_service = $this->CI->service_model->m_get_user_service($user);
        return $register_service;
    }

    public function m_get_detail_service($service) {
        $service_detail = $this->CI->service_model->m_get_detail_service($service);
        return $service_detail;
    }

    public function m_get_asigned_service_detail($service) {
        $service_detail = $this->CI->service_model->m_get_asigned_service_detail($service);
        return $service_detail;
    }

}
