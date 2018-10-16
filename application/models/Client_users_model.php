<?php

class Client_users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    

    public function update_data_user($user) {
        $query = "";
        if ($user["photo"] != "") {
       
            
            
            $query = "UPDATE user_client SET " .
                    " name = '" . $user["name"] . "', " .
                    " photo = '" . $user["photo"] . "', " .
                    " email = '" . $user["email"] . "', " .
                    " phone = '" . $user["phone"] . "', " .
                    " other_phone = '" . $user["otherPhone"] . "', " .
                    " password = '" . $user["password"] . "'" .
                    " WHERE id_client = " . $user["id"];
        } else {

 $query = "UPDATE user_client SET " .
                    " name = '" . $user["name"] . "', " .
                    " email = '" . $user["email"] . "', " .
                    " phone = '" . $user["phone"] . "', " .
                    " other_phone = '" . $user["otherPhone"] . "', " .
                    " password = '" . $user["password"] . "'" .
                    " WHERE id_client = " . $user["id"];
        }




        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => "200",
                "message" => "Update user successfull"
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => "400",
                "message" => "Error to update user"
            );
            return $message_return;
        }
    }
 

}
