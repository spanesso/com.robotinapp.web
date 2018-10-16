<?php

class Cleaning_users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_count() {
        $query = "SELECT COUNT(*) AS users FROM user_housekeeping;";
        $users_count = $this->db->simple_query($query);
        $count = 0;

        while ($count_query = $users_count->fetch_array(MYSQLI_ASSOC)) {
            $count = $count_query["users"];
        }
        return $count;
    }

    public function get_enabled_cleaning_users() {
        $query = " SELECT *  "
                . " FROM user_housekeeping "
                . " WHERE status = 1  ";

        $user_housekeeping_list = $this->db->simple_query($query);
        if (mysqli_num_rows($user_housekeeping_list) > 0) {
            return $user_housekeeping_list;
        } else {
            return null;
        }
    }

    public function is_code_assigned($code) {
        $query = " SELECT *  "
                . " FROM user_housekeeping "
                . " WHERE code = '".$code."'";

        $user_code_generated = $this->db->simple_query($query);
        if (mysqli_num_rows($user_code_generated) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_cleaning_users() {
        $query = " SELECT *  "
                . " FROM user_housekeeping   ";

        $user_housekeeping_list = $this->db->simple_query($query);
        if (mysqli_num_rows($user_housekeeping_list) > 0) {
            return $user_housekeeping_list;
        } else {
            return null;
        }
    }

    public function get_user_data_by_id($user_id) {

        $query = " SELECT * "
                . " FROM user_housekeeping "
                . " WHERE id_housekeeping = " . $user_id;

        $user = $this->db->simple_query($query);

        if (mysqli_num_rows($user) > 0) {
            return $user;
        } else {
            return null;
        }
    }

    public function update_data_user($user) {
        $query = "";
        if ($user["img"] != "") {
            $query = "UPDATE user_housekeeping SET " .
                    " medicare = '" . $user["medicare"] . "', " .
                    " name = '" . $user["name"] . "', " .
                    " last_name = '" . $user["last_name"] . "', " .
                    " home_address = '" . $user["address"] . "', " .
                    " photo = '" . $user["img"] . "', " .
                    " birthdate = '" . $user["birthdate"] . "', " .
                    " email = '" . $user["email"] . "', " .
                    " phone = '" . $user["phone"] . "', " .
                    " other_phone = '" . $user["other_phone"] . "', " .
                    " status = " . $user["status"] . "" .
                    " WHERE id_housekeeping = " . $user["id"];
        } else {


            $query = "UPDATE user_housekeeping SET " .
                    " medicare = '" . $user["medicare"] . "', " .
                    " name = '" . $user["name"] . "', " .
                    " last_name = '" . $user["last_name"] . "', " .
                    " home_address = '" . $user["address"] . "', " .
                    " email = '" . $user["email"] . "', " .
                     " birthdate = '" . $user["birthdate"] . "', " .
                    " phone = '" . $user["phone"] . "', " .
                    " other_phone = '" . $user["other_phone"] . "', " .
                    " status = " . $user["status"] . "" .
                    " WHERE id_housekeeping = " . $user["id"];
        }




        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => 200,
                "message" => "Update user successfull"
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => 400,
                "message" => "Error to update user"
            );
            return $message_return;
        }
    }

    public function save_data_new_user($user) {

        $query = "INSERT INTO user_housekeeping " .
                "(id_rol,name,last_name,medicare,home_address, photo,email, "
                . "  password, phone, other_phone, code,birthdate, folder ) " .
                "VALUES (" .
                "3, " .
                "'" . $user["name"] . "', " .
                "'" . $user["last_name"] . "', " .
                "'" . $user["medicare"] . "', " .
                "'" . $user["address"] . "', " .
                "'" . $user["img"] . "', " .
                "'" . $user["email"] . "', " .
                "'" . $user["password"] . "', " .
                "'" . $user["phone"] . "', " .
                "'" . $user["other_phone"] . "', " .
                "'" . $user["code"] . "', " .
                "'" . $user["birthdate"] . "', " .
                "'" . $user["folder"] . "'" .
                ")";


        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => 200,
                "message" => "Create user successful."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => 400,
                "message" => "Error to create user."
            );
            return $message_return;
        }
    }

}
