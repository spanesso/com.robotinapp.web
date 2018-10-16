<?php

class Promotions_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function is_code_exists($code) {

        $is_code_exists = true;

        $query = " SELECT *  "
                . " FROM promotions "
                . " WHERE code = '" . strtoupper($code) . "'";


        $query_request = $this->db->simple_query($query);

        if (mysqli_num_rows($query_request) > 0) {
            $is_code_exists = true;
        } else {
            $is_code_exists = false;
        }

        return $is_code_exists;
    }

    public function get_promotions_list() {
        $query = " SELECT * "
                . " FROM promotions";

        $query_result = $this->db->simple_query($query);
        if (mysqli_num_rows($query_result) > 0) {

            $promotions_list = array();
            while ($promotion = mysqli_fetch_assoc($query_result)) {

                $query_counts = " SELECT COUNT(*) as users "
                        . " FROM users_promotions "
                        . " WHERE id_promotion = " . $promotion["id_promotion"];

                $promotion_count = $this->db->simple_query($query_counts);
                while ($count = $promotion_count->fetch_array(MYSQLI_ASSOC)) {
                    $promotion["users"] = $count["users"];
                }
                array_push($promotions_list, $promotion);
            }
            return $promotions_list;
        } else {
            return null;
        }
    }

    public function create_promotion($promotion) {



        $query = "INSERT INTO promotions " .
                "(title,code,init_date,finish_date,discount, active ) " .
                "VALUES (" .
                "'" . $promotion["title"] . "', " .
                "'" . strtoupper($promotion["code"]) . "', " .
                "'" . $promotion["init_date"] . "', " .
                "'" . $promotion["finish_date"] . "', " .
                "'" . $promotion["discount"] . "', " .
                "1" .
                ")";


        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => 200,
                "message" => "Create promotion successful."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => 400,
                "message" => "Error to create promotion."
            );
            return $message_return;
        }
    }

    public function get_promotion_data_by_id($promotion_id) {

        $query = " SELECT * "
                . " FROM promotions "
                . " WHERE id_promotion = " . $promotion_id;




        $promotion = $this->db->simple_query($query);

        if (mysqli_num_rows($promotion) > 0) {
            return $promotion;
        } else {
            return null;
        }
    }

    public function update_promotion($promotion) {


        $query = "UPDATE promotions SET " .
                " title = '" . $promotion["title"] . "', " .
                " code = '" . $promotion["code"] . "', " .
                " init_date = '" . $promotion["init_date"] . "', " .
                " finish_date = '" . $promotion["finish_date"] . "', " .
                " discount = '" . $promotion["discount"] . "'" .
                " WHERE id_promotion = " . $promotion["id"];



        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => 200,
                "message" => "Promotion user successfull."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => 400,
                "message" => "Error to update promotion."
            );
            return $message_return;
        }
    }

    public function enable_or_disabled_promotion($promotion) {

        $status = intval($promotion["status"]);
        $new_status = 1;

        if ($status == 1) {
            $new_status = 0;
        }

        $query = "UPDATE promotions SET " .
                " active = " . $new_status . "" .
                " WHERE id_promotion = " . $promotion["id"];



        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => 200,
                "message" => "Promotion user successfull."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => 400,
                "message" => "Error to update promotion."
            );
            return $message_return;
        }
    }

}
