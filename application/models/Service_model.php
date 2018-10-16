<?php

class Service_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function m_apply_promotion($id_promotion, $id_user, $id_service, $today) {
        $query = "INSERT INTO users_promotions " .
                "(id_promotion,id_service,id_client,adquire_date ) " .
                "VALUES (" .
                "" . $id_promotion . ", " .
                "" . $id_service . ", " .
                "" . $id_user . ", " .
                "'" . $today . "'" .
                ")";


        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => "200",
                "message" => "Apply promotion successful."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => "400",
                "message" => "Error to apply promotion."
            );
            return $message_return;
        }
    }

    public function m_check_is_valid_code($code, $id_user) {

        $query_ready_redim = " SELECT * "
                . " FROM users_promotions up, promotions p"
                . " WHERE p.code  = '" . strtoupper($code) . "'"
                . " AND up.id_client = " . $id_user
                . " AND up.id_promotion = p.id_promotion";

        $query_ready_redim_result = $this->db->simple_query($query_ready_redim);
        if (mysqli_num_rows($query_ready_redim_result) == 0) {

            $query = " SELECT * "
                    . " FROM promotions"
                    . " WHERE code  = '" . strtoupper($code) . "'"
                    . " AND active = 1";


            $query_result = $this->db->simple_query($query);
            if (mysqli_num_rows($query_result) > 0) {

                $promotion = null;
                while ($promo = mysqli_fetch_assoc($query_result)) {
                    $promotion = $promo;
                }


                return $promotion;
            } else {

                return 1;
            }
        } else {

            return 2;
        }
    }

    public function m_register_confirm_payment_service($id_user, $id_service, $total_payment, $promotion, $today) {
        $query = "INSERT INTO shcedule_pay_services " .
                "(id_service,pay_service_date,promotion,total_payment) " .
                "VALUES (" .
                "" . $id_service . ", " .
                "'" . $today . "', " .
                "" . $promotion . ", " .
                "'" . $total_payment . "'" .
                ")";


        if ($this->db->simple_query($query)) {
            if ($this->change_registered_service_status($id_service, 2)) {

                $notification = array(
                    "id_user" => $id_user,
                    "id_service" => $id_service,
                    "status" => 2,
                    "date" => $today,
                    "title" => "Payment service is successful register.",
                    "message" => "The payment of the service was registered successfully, very soon a housewife will be assigned.",
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
        } else {
            return false;
        }
    }

    public function m_register_confirm_recurring_payment_service($id_user, $id_service, $total_payment, $promotion, $today) {



        $query = "INSERT INTO shcedule_pay_services " .
                "(id_service,pay_service_date,promotion,total_payment) " .
                "VALUES (" .
                "" . $id_service . ", " .
                "'" . $today . "', " .
                "" . $promotion . ", " .
                "'" . $total_payment . "'" .
                ")";


        if ($this->db->simple_query($query)) {
            if ($this->change_registered_service_status($id_service, 11)) {

                $notification = array(
                    "id_user" => $id_user,
                    "id_service" => $id_service,
                    "status" => 11,
                    "date" => $today,
                    "title" => "Payment register, pending for approve.",
                    "message" => "the payment was registered successfully and is awaiting approval by CleannApp.",
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
            $is_first_query_execute = true;
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

    public function m_get_asigned_service_detail($id_service) {

        $query = " SELECT s.id_service, p.id_plan, s.date, s.label_address, s.apto, p.name as name_plan, "
                . " s.label_address, s.place_address, s.schedule_service, s.service_status as status, p.price, "
                . " s.description as service_desc, p.description as plan_desc, st.status as status_desc "
                . " FROM service s, plans p, service_status st"
                . " WHERE s.id_plan = p.id_plan"
                . " AND st.id_service_status = s.service_status"
                . " AND s.id_service = " . $id_service;




        $service_data_result = $this->db->simple_query($query);
        if (mysqli_num_rows($service_data_result) > 0) {

            $service = null;


            while ($service_data = mysqli_fetch_assoc($service_data_result)) {
                $service = $service_data;
            }


            $query_promotion = " SELECT * "
                    . " FROM users_promotions up, promotions p"
                    . " WHERE up.id_promotion = p.id_promotion"
                    . " AND up.id_service = " . $id_service;

            $query_promotion_result = $this->db->simple_query($query_promotion);
            $promotion = null;
            if (mysqli_num_rows($query_promotion_result) > 0) {



                while ($promotion_data = mysqli_fetch_assoc($query_promotion_result)) {
                    $promotion = $promotion_data;
                }
            }

            $service["promotion"] = $promotion;


            $housekeeping = null;
            if (intval($service["status"]) > 3) {
                $query_housekeeping = " SELECT * "
                        . " FROM housekeeping_services hs, user_housekeeping uh"
                        . " WHERE hs.id_housekeeping = uh.id_housekeeping"
                        . " AND hs.id_service = " . $id_service;




                $query_housekeeping_result = $this->db->simple_query($query_housekeeping);

                if (mysqli_num_rows($query_housekeeping_result) > 0) {

                    while ($housekeeping_data = mysqli_fetch_assoc($query_housekeeping_result)) {
                        $housekeeping = $housekeeping_data;
                    }
                }
            }

            $service["housekeeping"] = $housekeeping;


            $message_return = array(
                "status" => "200",
                "data" => $service,
                "message" => "Service data success."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Service data error."
            );
            return $message_return;
        }
    }

    public function m_get_service_by_id($id_service) {



        $query = " SELECT uc.name as user_name, uc.email, "
                . " s.date, s.place_address, s.place_name, s.schedule_service, s.apto, "
                . " p.name as plan_name, p.description as plan_description, p.price as plan_price, "
                . " st.status as service_status, cp.name as category_plan_name "
                . " FROM user_client uc, service s, plans p, service_status st, category_plan cp "
                . " WHERE s.id_plan = p.id_plan "
                . " AND uc.id_client = s.id_client "
                . " AND p.id_category = cp.id_category "
                . " AND s.service_status = st.id_service_status "
                . " AND s.id_service =  " . $id_service;





        $service_data_result = $this->db->simple_query($query);
        if (mysqli_num_rows($service_data_result) > 0) {

            $service = null;
            $promotion = null;

            while ($service_data = mysqli_fetch_assoc($service_data_result)) {
                $service = $service_data;
            }


            $query_promotions = " SELECT *"
                    . " FROM users_promotions up, promotions p "
                    . " WHERE up.id_promotion = p.id_promotion "
                    . " AND up.id_service =  " . $id_service;



            $promotion_data_result = $this->db->simple_query($query_promotions);
            if (mysqli_num_rows($promotion_data_result) > 0) {
                while ($data_promotion = mysqli_fetch_assoc($promotion_data_result)) {
                    $promotion = $data_promotion;
                }
            }

            $service["promotion_data"] = $promotion;

            $message_return = array(
                "status" => "200",
                "data" => $service,
                "message" => "Service data success."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Service data error."
            );
            return $message_return;
        }
    }

    public function m_get_user_service($user) {

        $query = " SELECT s.id_service, p.id_plan, s.date, s.label_address, p.name as name_plan, "
                . " s.label_address, s.place_address, s.schedule_service, s.service_status as status, p.price, p.id_category, p.url_payment, "
                . " s.description as service_desc, p.description as plan_desc, st.status as status_desc "
                . " FROM service s, plans p, service_status st"
                . " WHERE s.id_plan = p.id_plan"
                . " AND st.id_service_status = s.service_status"
                . " AND s.service_status <> 99"
                . " AND s.id_client = " . $user;



        $service_list_result = $this->db->simple_query($query);
        if (mysqli_num_rows($service_list_result) > 0) {

            $array_service_list = array();
            while ($service = mysqli_fetch_assoc($service_list_result)) {
                array_push($array_service_list, $service);
            }


            $message_return = array(
                "status" => "200",
                "data" => $array_service_list,
                "message" => "Service list successful."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Service list error."
            );
            return $message_return;
        }
    }

    public function m_register_service($service) {

        $id_user = $service["id_client"];
        $date = $service["date"];

        $query = "INSERT INTO service " .
                "(id_client,id_plan,date,place_address,label_address, "
                . "place_name,description,service_status,zip_code,apto, schedule_service) " .
                "VALUES (" .
                "" . $id_user . ", " .
                "" . $service["id_plan"] . ", " .
                "'" . $date . "', " .
                "'" . $service["place_address"] . "', " .
                "'" . $service["label_address"] . "', " .
                "'" . $service["place_name"] . "', " .
                "'" . $service["description"] . "', " .
                "1, " .
                "'" . $service["zip_code"] . "', " .
                "'" . $service["apto"] . "', " .
                "" . $service["schedule_service"] . "" .
                ")";




        if ($this->db->simple_query($query)) {

            $query_last = " SELECT *"
                    . " FROM service "
                    . " ORDER BY id_service DESC LIMIT 1";

            $last_service = $this->db->simple_query($query_last);
            if (mysqli_num_rows($last_service) > 0) {



                $id_service = "";
                while ($service = mysqli_fetch_assoc($last_service)) {
                    $id_service = $service["id_service"];
                }





                $notification = array(
                    "id_user" => $id_user,
                    "id_service" => $id_service,
                    "date" => $date,
                    "status" => 1,
                    "title" => "Register service, pending for pay",
                    "message" => "The service has been registered successfully, is pending payment to be able to assign a cleaning employee.",
                    "image" => ""
                );

                $is_create_user_notification = $this->create_user_notification($notification);


                if ($is_create_user_notification) {
                    $message_return = array(
                        "status" => "200",
                        "message" => "Service register successful."
                    );
                    return $message_return;
                } else {
                    $message_return = array(
                        "status" => "400",
                        "message" => "Error to register service.2"
                    );
                    return $message_return;
                }
            }
        } else {
            $message_return = array(
                "status" => "400",
                "message" => "Error to register service1."
            );
            return $message_return;
        }
    }

    public function m_register_pay_service($id_service, $date) {

        $query = "INSERT INTO shcedule_pay_services " .
                "(id_service, pay_service_date) " .
                "VALUES (" .
                "" . $id_service . ", " .
                "'" . $date . "'" .
                ")";



        if ($this->db->simple_query($query)) {

            if ($this->change_registered_service_status($id_service, 2)) {
                $message_return = array(
                    "status" => "200",
                    "message" => "Service register successful."
                );
                return $message_return;
            } else {
                $message_return = array(
                    "status" => "400",
                    "message" => "Error to register service."
                );
                return $message_return;
            }
        } else {
            $message_return = array(
                "status" => "400",
                "message" => "Error to register service."
            );
            return $message_return;
        }
    }

    public function confirm_approve_payment_service($id_service) {

        $query = "UPDATE service SET " .
                " service_status = 2," .
                " pay_service = 1 " .
                " WHERE id_service = " . $id_service;


        if ($this->db->simple_query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function change_registered_service_status($id_service, $status) {

        $query = "";

        if ($status == 2) {

            $query = "UPDATE service SET " .
                    " service_status = " . $status . "," .
                    " pay_service = 1 " .
                    " WHERE id_service = " . $id_service;
        } else {

            $query = "UPDATE service SET " .
                    " service_status = " . $status .
                    " WHERE id_service = " . $id_service;
        }

        if ($this->db->simple_query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function m_cancel_register_service($id_service, $today) {


        $query_delete_user_notifications = "DELETE FROM user_notifications " .
                "WHERE id_service = " . $id_service;

        $query_delete_housekeeping_services = "DELETE FROM housekeeping_services " .
                "WHERE id_service = " . $id_service;


        $query = "UPDATE service SET " .
                " service_status = 99," .
                " finish_date = '" . $today . "'" .
                " WHERE id_service = " . $id_service;


        if ($this->db->simple_query($query)) {



            $this->db->simple_query($query_delete_housekeeping_services);
            $this->db->simple_query($query_delete_user_notifications);
            $message_return = array(
                "status" => "200",
                "message" => "Service canceled successful."
            );

            return $message_return;
        } else {
            $message_return = array(
                "status" => "400",
                "message" => "Error to cancel service."
            );

            return $message_return;
        }
    }

}
