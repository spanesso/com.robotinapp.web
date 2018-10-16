 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_business {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('dashboard_model');
        $this->CI->load->model('service_model');
        $this->CI->load->library('mail_manager');
    }

    public function verify_active_services() {
         $this->CI->dashboard_model->remove_closed_services_notifications();
        $pay_services = $this->CI->dashboard_model->get_pay_services();
        $is_services_activation_verified = $this->verify_activation_services($pay_services);

        return $is_services_activation_verified;
    }

    public function get_charts_data() {
        $charts_data = $this->CI->dashboard_model->get_charts_data();
        return $charts_data;
    }

    public function verify_activation_services($pay_services) {
        date_default_timezone_set('America/New_York');
        $today = date("Y-m-d");
        $today_complete = date("d-m-Y G:i:s");

        $is_services_activation_verified = false;

        foreach ($pay_services as $service) {
            $months = 0;
            $service_date = $service["date"];
            $id_service = $service["id_service"];
            $service_category = intval($service["id_category"]);

            switch ($service_category) {
                case 1:
                    //mensual
                    $months = 1;
                    break;
                case 2:
                    //trimestral
                    $months = 3;
                    break;
                case 3:
                    //semestral
                    $months = 6;
                    break;
            }

            $service_date_add_months_format = strtotime(date("Y-m-d", strtotime($service_date)) . " +" . $months . " month");
            $service_date_add_months = date("Y-m-d", $service_date_add_months_format);


            $dStart = new DateTime($service_date_add_months);
            $dEnd = new DateTime($today);
            $dDiff = $dStart->diff($dEnd);
            $difference_days = intval($dDiff->days);
            $difference_days_format = $dDiff->format('%R');

            if ($difference_days == 0) {
                $this->close_service($id_service, $today_complete);
                $is_services_activation_verified = true;
            } else {
                $is_services_activation_verified = true;
                if ($difference_days_format == "+") {

                    if ($difference_days == 15) {
                        $service_data_fif = $this->CI->service_model->m_get_service_by_id($id_service);

                        $id_service = $service_data_fif["id_service"];
                        $id_user = $service_data_fif["id_client"];
                        $place_name = $service_data_fif["place_name"];
                        $notification = array(
                            "id_user" => $id_user,
                            "id_service" => $id_service,
                            "date" => $today,
                            "status" => 0,
                            "title" => "Close service",
                            "message" => "The service " . $place_name . ", will expire in 15 days.",
                            "image" => ""
                        );
                        $this->CI->service_model->create_user_notification($notification);
                          //$this->CI->mail_manager->send_warning_close_service($service_data_fif, 15);
                    } else if ($difference_days == 5) {
                        $service_data_five = $this->CI->service_model->m_get_service_by_id($id_service);
                        $id_service = $service_data_five["id_service"];
                        $id_user = $service_data_five["id_client"];
                        $place_name = $service_data_five["place_name"];
                        $notification = array(
                            "id_user" => $id_user,
                            "id_service" => $id_service,
                            "date" => $today,
                                 "status" => 0,
                            "title" => "Close service",
                            "message" => "The service " . $place_name . ", will expire in 5 days.",
                            "image" => ""
                        );
                        $this->CI->service_model->create_user_notification($notification);
                         //$this->CI->mail_manager->send_warning_close_service($service_data_five, 5);
                    }
                } else if ($difference_days_format == "-") {
                    $this->close_service($id_service, $today_complete);
                }
            }
        }

        return $is_services_activation_verified;
    }

    public function close_service($id_service, $date) {

        $service_data = $this->CI->service_model->m_get_service_by_id($id_service);

        $is_service_canceled_housekeeping = $this->CI->dashboard_model->close_service_housekeeping($service_data, $date);

        if ($is_service_canceled_housekeeping) {
            $is_service_canceled_client = $this->CI->dashboard_model->close_service_client($id_service);
            if ($is_service_canceled_client) {
                  //$this->CI->mail_manager->send_finish_close_service($service_data, $date);
            }
        }
    }

}
