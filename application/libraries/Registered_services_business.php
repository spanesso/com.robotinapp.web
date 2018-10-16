 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registered_services_business {

    protected $CI;

    public function __construct() {

        $this->CI = & get_instance();
        $this->CI->load->model('registered_services_model');
        $this->CI->load->library('mail_manager');
        $this->CI->load->library('cleaning_users_business');
        $this->CI->load->library('service_business');
    }

    public function get_registered_services() {
        $registered_services = $this->CI->registered_services_model->get_registered_services();
        return $registered_services;
    }

    public function assing_service($service, $cleaning) {
        
        $message_return = "";
        $assing_service_status = $this->CI->registered_services_model->assing_service($service, $cleaning);

        switch ($assing_service_status) {
            case -1:
                $message_return = array(
                    "status" => "400",
                    "data" => null,
                    "message" => "The service has already been assigned"
                );
            
                break;
            case 0:
                $message_return = array(
                    "status" => "400",
                    "data" => null,
                    "message" => "Error to assigned service"
                );

               
                break;
            case 1:
              $message_return =  $this->notify_service_assignedment($service, $cleaning);
                break;
        }



        return $message_return;
    }

    
    
    public function confirm_approve_payment_service(  $id_service) {
            
        $is_payment_approve_register = $this->CI->registered_services_model->confirm_approve_payment_service($id_service);

        $message_return = null;

        if ($is_payment_register) {

            $service_data = $this->CI->service_model->m_get_service_by_id($id_service);
              //$this->CI->mail_manager->send_confirm_pay_service($service_data);
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
    
    
    public function notify_service_assignedment($service, $cleaning) {
        $cleaning_user_data_fectch = $this->CI->cleaning_users_business->get_user_data_by_id($cleaning);
         $cleaning_user_data = $cleaning_user_data_fectch->fetch_assoc();
        $service_data = $this->CI->registered_services_model->get_register_service_by_id($service);
        
     //$is_service_assigned_notify = $this->CI->mail_manager->notify_service_assigned($service_data,$cleaning_user_data);
     $is_service_assigned_notify = true;
        
        
            
        if($is_service_assigned_notify){
            
            

            //TODO: SUPER IMPORTANTE ENVIAR PUSH NOTIFICATION !!!!
           
             $message_return = array(
                "status" => "200",
                "data" => null,
                "message" => "service assigned successful, and the users were notified. "
            );

            return $message_return;
        }else{
             $message_return = array(
                "status" => "200",
                "data" => null,
                "message" => "service assigned successful, but the users don`t be notify."
            );

            return $message_return;
        }
    }

    public function get_service_info($id_service) {
        $service_info = $this->CI->registered_services_model->get_register_service_by_id($id_service);
        if ($service_info != null) {


            $message_return = array(
                "status" => "200",
                "data" => $service_info,
                "message" => "Service info"
            );

            return $message_return;
        } else {

            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Error to get service info."
            );
            return $message_return;
        }
    }
            
    
    public function get_service_info_detail($id_service,$status_service) {
        $service_info = $this->CI->registered_services_model->get_service_info_detail($id_service,$status_service);
        if ($service_info != null) {


            $message_return = array(
                "status" => "200",
                "data" => $service_info,
                "message" => "Service info"
            );

            return $message_return;
        } else {

            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Error to get service info."
            );
            return $message_return;
        }
    }
    
}
