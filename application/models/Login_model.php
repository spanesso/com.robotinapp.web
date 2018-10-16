<?php

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function m_login_user($email, $pass) {
        $query = " SELECT *  "
                . " FROM user_client u , rol r "
                . " WHERE u.email =  '" . $email . "'"
                . " AND u.password = '" . $pass . "'" 
                . " AND u.id_rol = r.id_rol "
              //  . " AND u.status = 1 "
                . " AND u.id_rol = 2 ";
      

        $user_validate = $this->db->simple_query($query);

        if (mysqli_num_rows($user_validate) > 0) {
            return $user_validate;
        } else {
            return null;
        }
    }

    public function authorize_user_entry($email, $pass) {
        $query = " SELECT *  "
                . " FROM user_admin u , rol r "
                . " WHERE u.email =  '" . $email . "'"
                . " AND u.password = '" . $pass . "'" 
                . " AND u.id_rol = r.id_rol "
                . " AND u.status = 1 "
                . " AND u.id_rol = 1 ";
      

        $user_validate = $this->db->simple_query($query);

        if (mysqli_num_rows($user_validate) > 0) {
            return $user_validate;
        } else {
            return null;
        }
    }

}
