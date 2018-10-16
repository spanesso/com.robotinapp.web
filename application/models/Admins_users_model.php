<?php

class Admins_users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_admin_users() {
        $query = " SELECT *  "
                . " FROM user_admin   ";

        $user_admin_list = $this->db->simple_query($query);
        if (mysqli_num_rows($user_admin_list) > 0) {
            return $user_admin_list;
        } else {
            return null;
        }
    }

    public function get_user_data_by_id($user_id) {

        $query = " SELECT * "
                . " FROM user_admin "
                . " WHERE id_admin = " . $user_id;

        $user = $this->db->simple_query($query);

        if (mysqli_num_rows($user) > 0) {
            return $user;
        } else {
            return null;
        }
    }

    public function update_data_user($user) {

        $query = "UPDATE user_admin SET " .
                " name = '" . $user["name"] . "', " .
                " last_name = '" . $user["last_name"] . "', " .
                " email = '" . $user["email"] . "', " .
                " password = '" . $user["password"] . "', " .
                " status = " . $user["status"] . "" .
                " WHERE id_admin = " . $user["id"];



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

    public function create_admin($user) {

        $query = "INSERT INTO user_admin " .
                "(id_rol,name,last_name,email, "
                . "  password, status ) " .
                "VALUES (" .
                "1, " .
                "'" . $user["name"] . "', " .
                "'" . $user["last_name"] . "', " .
                "'" . $user["email"] . "', " .
                "'" . $user["pass"] . "', " .
                "1" .
                ")";


        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => 200,
                "message" => "Create admin successful."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => 400,
                "message" => "Error to create admin."
            );
            return $message_return;
        }
    }

}
