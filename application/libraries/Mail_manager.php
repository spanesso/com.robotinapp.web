 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail_manager {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('email');
    }

    public function notify_service_assigned($service_data, $cleaning_user_data) {
        $is_notify_assing_service_to_cleanning_user = $this->notify_assing_service_to_cleanning_user($service_data, $cleaning_user_data);
        $is_notify_assing_service_to_client_user = $this->notify_assing_service_to_client_user($service_data, $cleaning_user_data);
        $is_notify_assing_service_to_admin = $this->notify_assing_service_to_admin($service_data, $cleaning_user_data);

        if ($is_notify_assing_service_to_cleanning_user && $is_notify_assing_service_to_client_user && $is_notify_assing_service_to_admin) {

            return true;
        } else {
            return false;
        }
    }

    public function lab() {
        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>CLEANN APP TEST</h1>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to("spanesso@gmail.com");
        $this->CI->email->subject('CLEANN APP TEST');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');


        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function notify_assing_service_to_admin($service_data, $cleaning_user_data) {
        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>NEW SERVICE ASSIGNED!!</h1>" .
                "<h3 class='title'>CLIENT</h3>" .
                "<p>Client name : " . $service_data["client_name"] . "</p>" .
                "<p>Init date : " . $service_data["date"] . "</p>" .
                "<br>" .
                "<p>email : " . $service_data["email"] . "</p>" .
                "<p>phone : " . $service_data["phone"] . "</p>" .
                "<p>other phone : " . $service_data["other_phone"] . "</p>" .
                "<h3 class='title'>HOUSEKEEPING</h3>" .
                "<img src='" . $cleaning_user_data["photo"] . "'  height='100' width='100'>" .
                "<p>housekeeping : " . $cleaning_user_data["name"] . " " . $cleaning_user_data["last_name"] . "</p>" .
                "<p>phone : " . $cleaning_user_data["phone"] . "</p>" .
                "<p>other phone : " . $cleaning_user_data["other_phone"] . "</p>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to(EMAIL_USER);
        $this->CI->email->subject('HOUSEKEEPING ASSIGNED TO SERVICE!!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function notify_assing_service_to_client_user($service_data, $cleaning_user_data) {
        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>HOUSEKEEPING ASSIGNED TO SERVICE!!</h1>" .
                "<img src='" . $cleaning_user_data["photo"] . "'  height='100' width='100'>" .
                "<p>housekeeping : " . $cleaning_user_data["name"] . " " . $cleaning_user_data["last_name"] . "</p>" .
                "<p>phone : " . $cleaning_user_data["phone"] . "</p>" .
                "<p>other phone : " . $cleaning_user_data["other_phone"] . "</p>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to($service_data["email"]);
        $this->CI->email->subject('HOUSEKEEPING ASSIGNED TO SERVICE!!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function notify_assing_service_to_cleanning_user($service_data, $cleaning_user_data) {

        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>NEW SERVICE ASSIGNED!!</h1>" .
                "<p>Client name : " . $service_data["client_name"] . "</p>" .
                "<p>Init date : " . $service_data["date"] . "</p>" .
                "<br>" .
                "<p>email : " . $service_data["email"] . "</p>" .
                "<p>phone : " . $service_data["phone"] . "</p>" .
                "<p>other phone : " . $service_data["other_phone"] . "</p>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to($cleaning_user_data["email"]);
        $this->CI->email->subject('NEW SERVICE ASSIGNED!!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function send_confirm_pay_service($service_data) {
        $this->send_confirm_pay_service_admin($service_data);
        $this->send_confirm_pay_service_client($service_data);
    }

   

    public function send_confirm_recurring_pay_service($service_data) {
        $this->send_confirm_recurring_pay_service_admin($service_data);
        $this->send_confirm_recurring_pay_service_client($service_data);
    }

    public function send_finish_close_service($service_data, $date) {
        $this->send_finish_close_service_admin($service_data, $date);
        $this->send_finish_close_service_client($service_data, $date);
    }

    public function send_warning_close_service($service_data, $days) {
        $message = $this->generate_warning_close_service_message($service_data, $days);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to($service_data["email"]);
        $this->CI->email->subject('Close cliet service');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function send_finish_close_service_admin($service_data, $date) {


        $message = $this->generate_finish_close_service_message($service_data, $date);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to(EMAIL_USER);
        $this->CI->email->subject('Close cliet service');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    protected function generate_finish_close_service_message($service_data, $date) {
        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>Close service</h1>" .
                "<p>date : " . $date . "</p>" .
                "<p>client : " . $service_data["user_name"] . "</p>" .
                "<p>email : " . $service_data["email"] . "</p>" .
                "<p>service name : " . $service_data["place_name"] . "</p>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        return $message;
    }

    protected function generate_warning_close_service_message($service_data, $days) {
        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>Warning, the service is about to expire</h1>" .
                "<p>The service (" . $service_data["place_name"] . ") expires in " . $days . " days</p>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        return $message;
    }

    public function send_finish_close_service_client($id_service, $date) {


        $message = $this->generate_finish_close_service_message($service_data, $date);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to($service_data["email"]);
        $this->CI->email->subject('Close cliet service');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function send_confirm_pay_service_client($service_data) {


        $message = $this->generate_confirm_payment_message($service_data);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to($service_data["email"]);
        $this->CI->email->subject('Confirm service payment!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    
     public function send_confirm_cancel_service($service_data) {
        $this->send_confirm_cancel_service_admin($service_data);
        $this->send_confirm_cancel_service_client($service_data);
    }
    
    public function send_confirm_cancel_service_client($service_data) {
   $message = $this->generate_confirm_cancel_message($service_data);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to($service_data["email"]);
        $this->CI->email->subject('Confirm service canceled!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }
    public function send_confirm_cancel_service_admin($service_data) {


        $message = $this->generate_confirm_cancel_message($service_data);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to(EMAIL_USER);
        $this->CI->email->subject('Confirm service canceled!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function send_confirm_recurring_pay_service_client($service_data) {


        $message = $this->generate_confirm_recurring_payment_message($service_data);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to($service_data["email"]);
        $this->CI->email->subject('Confirm service payment!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function send_confirm_pay_service_admin($service_data) {


        $message = $this->generate_confirm_payment_message($service_data);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to(EMAIL_USER);
        $this->CI->email->subject('Confirm service payment!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function send_confirm_recurring_pay_service_admin($service_data) {


        $message = $this->generate_confirm_recurring_payment_message($service_data);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to(EMAIL_USER);
        $this->CI->email->subject('Confirm register payment!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function generate_confirm_cancel_message($service_data) {
 

        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>Confirm service canceled by user</h1>" .
                "<p>client name : " . $service_data["user_name"] . "</p>" .
                "<p>client email : " . $service_data["email"] . "</p>" .
                "<p>service request date: " . $service_data["date"] . "</p>" .
                "<p>service address: " . $service_data["place_address"] . "</p>" . 
                "<p>service schedule : " . $service_data["plan_name"] . "</p>" . 
                "<p>service schedule : " . $service_data["plan_price"] . "</p>" . 
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        return $message;
    }

    public function generate_confirm_payment_message($service_data) {

        $schedule_service = "Morning 9am 12pm";

        if ($service_data["schedule_service"] == 0) {
            $schedule_service = "Morning 9am - 12pm";
        } else if ($service_data["schedule_service"] == 1) {
            $schedule_service = "Afternoon 12pm - 3pm";
        } else if ($service_data["schedule_service"] == 2) {
            $schedule_service = "Afternoon 3pm - 6pm";
        }

        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>Confirm service payment</h1>" .
                "<p>client name : " . $service_data["user_name"] . "</p>" .
                "<p>client email : " . $service_data["email"] . "</p>" .
                "<p>service request date: " . $service_data["date"] . "</p>" .
                "<p>service address: " . $service_data["place_address"] . "</p>" .
                "<p>service apto: " . $service_data["apto"] . "</p>" .
                "<p>service schedule : " . $schedule_service . "</p>" .
                "<p>service schedule : " . $service_data["plan_name"] . "</p>" .
                "<p>service schedule : " . $service_data["plan_description"] . "</p>" .
                "<p>service schedule : " . $service_data["plan_price"] . "</p>" .
                "<p>service schedule : " . $service_data["service_status"] . "</p>" .
                "<p>service schedule : " . $service_data["category_plan_name"] . "</p>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        return $message;
    }

    public function generate_confirm_recurring_payment_message($service_data) {

        $schedule_service = "Morning 9am 12pm";

        if ($service_data["schedule_service"] == 0) {
            $schedule_service = "Morning 9am - 12pm";
        } else if ($service_data["schedule_service"] == 1) {
            $schedule_service = "Afternoon 12pm - 3pm";
        } else if ($service_data["schedule_service"] == 2) {
            $schedule_service = "Afternoon 3pm - 6pm";
        }

        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>Confirm register payment, pending for approve</h1>" .
                "<p>client name : " . $service_data["user_name"] . "</p>" .
                "<p>client email : " . $service_data["email"] . "</p>" .
                "<p>service request date: " . $service_data["date"] . "</p>" .
                "<p>service address: " . $service_data["place_address"] . "</p>" .
                "<p>service apto: " . $service_data["apto"] . "</p>" .
                "<p>service schedule : " . $schedule_service . "</p>" .
                "<p>service schedule : " . $service_data["plan_name"] . "</p>" .
                "<p>service schedule : " . $service_data["plan_description"] . "</p>" .
                "<p>service schedule : " . $service_data["plan_price"] . "</p>" .
                "<p>service schedule : " . $service_data["service_status"] . "</p>" .
                "<p>service schedule : " . $service_data["category_plan_name"] . "</p>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";
        return $message;
    }

    public function send_register_pay_service_message() {
        $message = $this->get_register_pay_service_message();
    }

    public function send_register_client_email($name, $email, $phone, $password) {

        $message = $this->get_register_client_email($name, $email, $phone, $password);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to(EMAIL_USER);
        $this->CI->email->subject('CleannApp success register');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    protected function get_register_pay_service_message() {
        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>USER REGISTER</h1>" .
                "<p>name : " . $name . "</p>" .
                "<p>email : " . $email . "</p>" .
                "<p>phone : " . $phone . "</p>" .
                "<p>pass : " . $password . "</p>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        return $message;
    }

    protected function get_register_client_email($name, $email, $phone, $password) {

        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<div >" .
                "<h1 class='title'>CleannApp success register</h1>" .
                "<p>Email: <b>" . $email . "</b></p>" .
                "<p>Password: <b>" . $password . "</b></p>" .
                "</div>" .
                "</body>" .
                "</html>" .
                "";

        return $message;
    }

    public function send_register_service_message($service) {

        $message = $this->get_register_service_mesage($service);

        $this->CI->email->from(EMAIL_USER, EMAIL_USER_NAME);
        $this->CI->email->to(EMAIL_USER);
        $this->CI->email->subject('New service register!');
        $this->CI->email->message($message);
        $this->CI->email->set_mailtype('html');

        if ($this->CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    protected function get_register_service_mesage($service) {



        $message = "<!doctype html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "</head>" .
                "<body>" .
                "<h1>Register New Service</h1>" .
                "<p> The service has been registered successfully, is pending payment to be able to assign a cleaning employee.</p>" .
                "<p>Nickname: <b>" . $service["label_address"] . "</b></p>" .
                "<p>Address: <b>" . $service["place_address"] . "</b></p>" .
                "<p>Apto: <b>" . $service["apto"] . "</b></p>" .
                "</body>" .
                "</html>" .
                "";

        return $message;
    }

}
