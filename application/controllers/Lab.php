<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lab extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('mail_manager');
        $this->load->library('dashboard_business');
    }

    function index() {
        
    }

    public function services() {
            $pay_services = $this->dashboard_business->get_pay_services();
            echo $pay_services;
    }
    public function servicessss() {
        date_default_timezone_set('America/New_York');
        $today = date("Y-m-d");
        $pay_services = $this->dashboard_business->get_pay_services();


        foreach ($pay_services as $service) {
            $months = 0;
            $service_date = $service["date"];
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
            echo "<br>service_date_add_months: " . $difference_days;
            echo "<br>difference_days_format: " . $difference_days_format;


            if ($difference_days == 0) {
                echo "<br>SE CANCELA EL SERVICIO";
            } else {
                if ($difference_days_format == "+") {

                    if ($difference_days == 15) {
                        echo "<br>ENVIAR CORREO";
                    } else if ($difference_days == 5) {
                        echo "<br>ENVIAR CORREO";
                    } else {
                        echo "<br>OK ";
                    }
                } else if ($difference_days_format == "-") {
                    echo "<br>SE CANCELA EL SERVICIO";
                }
            }
        }
    }

    public function random() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '1234567890';

        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 3; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        $string .= "-";
        $max_num = strlen($numbers) - 1;
        for ($i = 0; $i < 3; $i++) {
            $string .= $numbers[mt_rand(0, $max_num)];
        }


        echo $string;
    }

    public function test() {

        date_default_timezone_set('America/New_York');

        $finish_date = "20/04/2018";
        $finish_date_array = explode("/", $finish_date);
        $format_finish_date = $finish_date_array[2] . "-" . $finish_date_array[1] . "-" . $finish_date_array[0];
        $format_date_time = new DateTime($format_finish_date);

        $today = date("m-d-Y");
        $today_date_time = DateTime::createFromFormat('m-d-Y', $today);

        $interval = $today_date_time->diff($format_date_time);
        $_days_diff = intval($interval->format('d'));

        if ($_days_diff >= 0) {
            echo "valido";
        } else {
            echo "invalido";
        }
    }

    public function testtt() {

        date_default_timezone_set('America/New_York');


        $date = "19/05/2018";

        $today = date("d/m/Y");


        echo "<br>time: " . time();
        echo "<br>today: " . $today;
        echo "<br>date: " . $date;


        if (strtotime($date) < $today) {
            echo "<br>date < today";
        } else if (strtotime($date) > $today) {
            echo "<br>date > today";
        } else {
            echo "<br>date = today";
        }
    }

    public function prueba($aaaaa) {



        echo "respuesta--->" . $aaaaa;
    }

    public function mail() {
        echo "--->" . $this->mail_manager->lab();
    }

    public function accentsss() {
        $string = "programa's";

        $committe_return = array(
            "committe" => "programa's",
            "users" => "programa's"
        );
        $strarra = array_map('addslashes', $committe_return);
        $strarrass = array_map('stripslashes', $strarra);

        $str = addslashes($string);
        $strs = stripslashes($str);

        echo $strarra["committe"];
    }

    public function accents() {
        $string = "1'";

        $strarrass = addslashes($string);


        echo $strarrass;
    }

}
