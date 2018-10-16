<?php

class Registered_services_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_user_by_service_id($id_service) {

        $query = " SELECT  id_client"
                . " FROM   service    "
                . " WHERE  id_service =  " . $id_service;





        $service_data_result = $this->db->simple_query($query);
        if (mysqli_num_rows($service_data_result) > 0) {

            $service = null;


            while ($service_data = mysqli_fetch_assoc($service_data_result)) {
                $service = $service_data;
            }




            return $service["id_client"];
        } else {

            return null;
        }
    }
    
  

    public function assing_service($service, $cleaning) {

        $query_update_service = "UPDATE service SET " .
                " service_status = 4" .
                " WHERE id_service = " . $service;


        if ($this->db->simple_query($query_update_service)) {

            $query_exist_assignment_register = " SELECT *  "
                    . " FROM housekeeping_services "
                    . " WHERE id_service =  " . $service;


            $result_query = $this->db->simple_query($query_exist_assignment_register);
            if (mysqli_num_rows($result_query) == 0) {

                $assing_service_query = "INSERT INTO housekeeping_services " .
                        "(id_service,id_housekeeping,id_service_status ) " .
                        "VALUES (" .
                        $service . "," .
                        $cleaning . "," .
                        "4 " .
                        ")";

                if ($this->db->simple_query($assing_service_query)) {


                    $id_user = $this->get_user_by_service_id($service);

                    date_default_timezone_set('America/New_York');
                    $today = date("Y-m-d");

                    $notification = array(
                        "id_user" => $id_user,
                        "id_service" => $service,
                        "date" => $today,
                        "status" => 4,
                        "title" => "The service has already been assigned.",
                        "message" => "The registered service has already been assigned to an housekeeping employee, on the set date the cleaning work will begin.",
                        "image" => ""
                    );
                    if ($this->create_user_notification($notification)) {
                        return 1;
                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            } else {
                return -1;
            }
        } else {
            return 0;
        }
    }

    public function create_user_notification($notification) {

        $status = $notification["status"];
        $is_first_query_execute = false;

        $previous_status = 0;
        if ($status > 1) {
            if ($status == 2) {
                $previous_status = 1;
            } else if ($status == 4) {
                $previous_status = 2;
            } else if ($status == 7) {
                $previous_status = 4;
            }

            $query_delete = "DELETE FROM user_notifications " .
                    "WHERE id_client = " . $notification["id_user"] .
                    " AND id_service = " . $notification["id_service"] .
                    " AND status = " . $previous_status;


            if ($this->db->simple_query($query_delete)) {
                $is_first_query_execute = true;
            } else {
                $is_first_query_execute = false;
            }
        } else {
            $is_first_query_execute = false;
        }

        if ($is_first_query_execute) {
            $query = "INSERT INTO user_notifications " .
                    "(id_client,id_service,status,title,message,image,date) " .
                    "VALUES (" .
                    "" . $notification["id_user"] . ", " .
                    "" . $notification["id_service"] . ", " .
                    "" . $notification["status"] . ", " .
                    "'" . $notification["title"] . "', " .
                    "'" . $notification["message"] . "', " .
                    "'" . $notification["image"] . "', " .
                    "'" . $notification["date"] . "'" .
                    ")";

            if ($this->db->simple_query($query)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_service_info_detail($id_service, $status_service) {

        if ($status_service < 4) {

            $query = " SELECT s.id_service,uc.id_client, uc.name as client_name, uc.email, "
                    . " uc.phone, uc.other_phone, "
                    . " s.date, s.place_address, p.name as plan_name, s.service_status,p.url_payment, ss.status  "
                    . " FROM service s, user_client uc, plans p, service_status ss "
                    . " WHERE s.id_client = uc.id_client "
                    . " AND s.id_plan = p.id_plan "
                    . " AND s.service_status = ss.id_service_status "
                    . " AND s.id_service = " . $id_service
                    . " ORDER BY s.date DESC ";
        } else {
            $query = " SELECT uh.name as uh_name, uh.last_name as uh_last_name, uh.email as uh_email, "
                    . " uh.phone as uh_phone, uh.other_phone as uh_other_phone, uh.photo as uh_photo,"
                    . "uc.name as uc_name, uc.email as uc_email, uc.phone as uc_phone, uc.other_phone as uc_other_phone, "
                    . "s.id_service,s.date, s.place_address, p.name as plan_name, s.service_status, ss.status  "
                    . " FROM service s,user_client uc,  plans p,housekeeping_services hs, user_housekeeping uh, service_status ss "
                    . " WHERE s.id_service = " . $id_service
                    . " AND s.id_client = uc.id_client "
                    . " AND s.id_service = hs.id_service "
                    . " AND s.id_plan = p.id_plan "
                    . " AND s.service_status = ss.id_service_status "
                    . " AND hs.id_housekeeping = uh.id_housekeeping ";
        }



        $service_transaction = $this->db->simple_query($query);

        if (mysqli_num_rows($service_transaction) > 0) {

            $service = null;
            while ($registered_service = mysqli_fetch_assoc($service_transaction)) {
                $service = $registered_service;
            }
            return $service;
        } else {
            return null;
        }
    }

    public function get_registered_services() {

        $query = " SELECT s.id_service,uc.id_client, uc.name as client_name,"
                . " s.date, s.place_address, p.name as plan_name, s.service_status, ss.status  "
                . " FROM service s, user_client uc, plans p, service_status ss "
                . " WHERE s.id_client = uc.id_client "
                . " AND s.id_plan = p.id_plan "
                . " AND s.service_status = ss.id_service_status "
                . " ORDER BY s.date DESC ";

        $registered_services_result = $this->db->simple_query($query);
        if (mysqli_num_rows($registered_services_result) > 0) {

            $registered_services_list = array();
            while ($registered_service = mysqli_fetch_assoc($registered_services_result)) {
                array_push($registered_services_list, $registered_service);
            }
            return $registered_services_list;
        } else {
            return null;
        }
    }

    public function get_register_service_by_id($id_service) {

        $query = " SELECT "
                . "s.id_service, s.date, s.place_address,s.service_status,"
                . "uc.id_client, uc.name as client_name, uc.email, "
                . " uc.phone, uc.other_phone, "
                . "cp.name as category_name,"
                . " sps.total_payment, sps.pay_service_date, "
                . " p.description, p.name as plan_name, ss.status  "
                . " FROM service s, user_client uc, plans p,category_plan cp, service_status ss , shcedule_pay_services sps"
                . " WHERE s.id_client = uc.id_client "
                . " AND s.id_plan = p.id_plan "
                . " AND cp.id_category = p.id_category "
                . " AND s.service_status = ss.id_service_status "
                . " AND sps.id_service = s.id_service "
                . " AND s.id_service = " . $id_service
                . " ORDER BY s.date DESC ";



        $service_transaction = $this->db->simple_query($query);

        if (mysqli_num_rows($service_transaction) > 0) {

            $service = null;
            while ($registered_service = mysqli_fetch_assoc($service_transaction)) {
                $service = $registered_service;
            }
            return $service;
        } else {
            return null;
        }
    }

}
