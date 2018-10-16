<?php

class Notifications_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function m_get_user_notifications($user) {

        $query = " SELECT * "
                . " FROM user_notifications"
                . " WHERE id_client = " . $user;



        $notifications_list_result = $this->db->simple_query($query);
        if (mysqli_num_rows($notifications_list_result) > 0) {

            $array_notifications_list = array();
            while ($notification = mysqli_fetch_assoc($notifications_list_result)) {
                array_push($array_notifications_list, $notification);
            }


            $message_return = array(
                "status" => "200",
                "data" => $array_notifications_list,
                "message" => "Notifications list successful."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => "400",
                "data" => null,
                "message" => "Notifications list error."
            );
            return $message_return;
        }
    }

}
