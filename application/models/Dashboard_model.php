<?php

class Dashboard_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function close_service_housekeeping($service_data, $date) {

        $id_service = $service_data["id_service"];
        $id_user = $service_data["id_client"];
        $place_name = $service_data["place_name"];

        $query = "UPDATE housekeeping_services SET " .
                " id_service_status = 7,  " .
                " finish_service = '" . $date . "'" .
                " WHERE id_service = " . $service_data["id_service"];



        if ($this->db->simple_query($query)) {

            $notification = array(
                "id_user" => $id_user,
                "id_service" => $id_service,
                "date" => $date,
                "status" => 7,
                "title" => "The service was closed",
                "message" => "The service " . $place_name . ", was closed due to expiration of the plan.",
                "image" => ""
            );
            if ($this->create_user_notification($notification)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
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

    public function close_service_client($id_service) {
        $query = "UPDATE service SET " .
                " service_status = 7" .
                " WHERE id_service = " . $id_service;



        if ($this->db->simple_query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_charts_data() {

        $pay_services = $this->get_service_by_status(2);
        $pending_pay_services = $this->get_service_by_status(1);
        $assing_services = $this->get_service_by_status(4);
        $finished_services = $this->get_service_by_status(6);
        $expire_services = $this->get_service_by_status(7);
        $closed_services = $this->get_service_by_status(99);
        $active_empoyees = $this->get_housekeeping_by_status(1);
        $unactive_empoyees = $this->get_housekeeping_by_status(0);



        $charts_data = array(
            "pay_services" => $pay_services,
            "pending_pay_services" => $pending_pay_services,
            "assing_services" => $assing_services,
            "finished_services" => $finished_services,
            "expire_services" => $expire_services,
            "closed_services" => $closed_services,
            "active_empoyees" => $active_empoyees,
            "unactive_empoyees" => $unactive_empoyees
        );

        return $charts_data;
    }

    public function get_pay_services() {

        $query = " SELECT  s.id_service, s.service_status, s.id_plan,"
                . " s.id_client, s.date, p.id_category  "
                . " FROM service s, plans p "
                . " WHERE s.service_status >= 4 "
                . " AND s.service_status <> 99 "
                . " AND s.id_plan = p.id_plan";



        $services_list_result = $this->db->simple_query($query);
        if (mysqli_num_rows($services_list_result) > 0) {

            $array_services_list = array();
            while ($service = mysqli_fetch_assoc($services_list_result)) {
                array_push($array_services_list, $service);
            }
            return $array_services_list;
        } else {
            return null;
        }
    }

    public function remove_closed_services_notifications() {

        $query = " SELECT  s.id_service  "
                . " FROM service s  "
                . " WHERE s.service_status = 99 ";



        $services_list_result = $this->db->simple_query($query);
        if (mysqli_num_rows($services_list_result) > 0) {
 
            while ($service = mysqli_fetch_assoc($services_list_result)) {
                $query_delete_user_notifications = "DELETE FROM user_notifications " .
                        "WHERE id_service = " . $service["id_service"];

                $this->db->simple_query($query_delete_user_notifications);
            }
        }
    }

    public function get_service_by_status($status) {
        $query = "SELECT COUNT(*) AS services "
                . " FROM service"
                . " WHERE service_status = " . $status;
        $services_count = $this->db->simple_query($query);
        $count = 0;

        while ($count_query = $services_count->fetch_array(MYSQLI_ASSOC)) {
            $count = $count_query["services"];
        }
        return $count;
    }

    public function get_housekeeping_by_status($status) {
        $query = "SELECT COUNT(*) AS eployees "
                . " FROM user_housekeeping"
                . " WHERE status = " . $status;
        $eployees_count = $this->db->simple_query($query);
        $count = 0;

        while ($count_query = $eployees_count->fetch_array(MYSQLI_ASSOC)) {
            $count = $count_query["eployees"];
        }
        return $count;
    }

}
