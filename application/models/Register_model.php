<?php

class Register_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function m_register_user($name, $email, $phone, $password, $folder) {

        if (!$this->is_register_email($email)) {
            $query = "INSERT INTO user_client " .
                    "(id_rol, name,email,phone,password,folder) " .
                    "VALUES (" .
                    "2, " .
                    "'" . $name . "', " .
                    "'" . $email . "', " .
                    "'" . $phone . "', " .
                    "'" . $password . "'," .
                    "'" . $folder . "'" .
                    ")";


            if ($this->db->simple_query($query)) {
                $message_return = array(
                    "status" => "200",
                    "message" => "Create user successful."
                );
                return $message_return;
            } else {
                $message_return = array(
                    "status" => "400",
                    "message" => "Error to create user."
                );
                return $message_return;
            }
        } else {
            $message_return = array(
                "status" => "400",
                "message" => "Email is already registered."
            );
            return $message_return;
        }
    }

    public function is_register_email($email) {
        $query = " SELECT *  "
                . " FROM user_client   "
                . " WHERE email =  '" . $email . "'";

        $is_register_email_response = $this->db->simple_query($query);

        if (mysqli_num_rows($is_register_email_response) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_enterprise_token_folder($enterprise_id) {
        $query = " SELECT company_folder  "
                . " FROM company   "
                . " WHERE company_id =  " . $enterprise_id;

        $enterprise_token_query = $this->db->simple_query($query);

        if (mysqli_num_rows($enterprise_token_query) > 0) {
            $enterprise_token = $enterprise_token_query->fetch_object();
            return $enterprise_token->company_folder;
        } else {
            return null;
        }
    }

    public function get_company_folder($company_id) {
        $query = " SELECT company_folder_token  "
                . " FROM company   "
                . " WHERE company_id =  " . $company_id;

        $company_token_query = $this->db->simple_query($query);

        if (mysqli_num_rows($company_token_query) > 0) {
            $company_token = $company_token_query->fetch_object();
            return $company_token->company_folder_token;
        } else {
            return null;
        }
    }

    public function register_enterprise($enterprise_data) {

        $message_return = array(
            "status" => 0,
            "data" => null,
            "message" => null
        );

        $register_query = $this->generate_enterprise_register_query($enterprise_data);

        if ($this->db->simple_query($register_query)) {
            $enterprise_id = $this->db->insert_id();

            $employee_register_query = $this->generate_enterprise_admin_query($enterprise_id, $enterprise_data);




            $this->db->simple_query($employee_register_query);

            if ($enterprise_id != 0) {

                $message_return["status"] = 200;
                $message_return["message"] = "Empresa registrada satisfactoriamente, muy pronto recibirás un correo para confirmar tu registro.";

                return $message_return;
            } else {
                $message_return["status"] = 400;
                $message_return["message"] = "Hubo un error al registrar los datos de la empresa";

                return $message_return;
            }
        } else {
            $message_return["status"] = 400;
            $message_return["message"] = "Hubo un error al registrar los datos de la empresa";

            return $message_return;
        }
    }

    public function is_user_mail_exist($user_email) {

        $query_is_user_mail_exist = " SELECT user_email  "
                . " FROM users   "
                . " WHERE user_email = '" . $user_email . "'";

        $user_mail = $this->db->simple_query($query_is_user_mail_exist);

        if (mysqli_num_rows($user_mail) > 1) {
            return true;
        } else {
            return false;
        }
    }

    public function is_user_admin_mail_exist($id, $user_email) {

        $query_is_user_mail_exist = " SELECT user_email  "
                . " FROM user "
                . " WHERE user_email = '" . $user_email . "'"
                . " AND company_id != " . $id;



        $user_mail = $this->db->simple_query($query_is_user_mail_exist);

        if (mysqli_num_rows($user_mail) > 1) {
            return true;
        } else {
            return false;
        }
    }

    public function is_company_mail_exist($enterprise_id, $company_email) {
        $query_is_company_mail_exist = " SELECT company_email  "
                . " FROM company   "
                . " WHERE company_email = '" . $company_email . "'"
                . " AND company_id = " . $enterprise_id;

        $company_mail = $this->db->simple_query($query_is_company_mail_exist);

        if (mysqli_num_rows($company_mail) > 1) {
            return true;
        } else {
            return false;
        }
    }

    public function create_is_company_mail_exist($company_email) {
        $query_is_company_mail_exist = " SELECT company_email  "
                . " FROM company   "
                . " WHERE company_email = '" . $company_email . "'";

        $company_mail = $this->db->simple_query($query_is_company_mail_exist);

        if (mysqli_num_rows($company_mail) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function create_is_company_nit_exist($company_nit) {
        $query_is_company_nit_exist = " SELECT company_nit  "
                . " FROM company   "
                . " WHERE company_nit = '" . $company_nit . "'";

        $company_nit_check = $this->db->simple_query($query_is_company_nit_exist);

        if (mysqli_num_rows($company_nit_check) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_is_company_nit_exist($company_id, $company_nit) {
        $query_is_company_nit_exist = " SELECT company_nit  "
                . " FROM company   "
                . " WHERE company_nit = '" . $company_nit . "'"
                . " AND company_id != " . $company_id;

        $company_nit_check = $this->db->simple_query($query_is_company_nit_exist);

        if (mysqli_num_rows($company_nit_check) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_enterprise_data_by_token($enterprise_token) {

        $get_enterprise_query = $this->generate_query_data_enterprise_by_token($enterprise_token);
        $enterprise_data = $this->db->simple_query($get_enterprise_query);

        if (mysqli_num_rows($enterprise_data) > 0) {
            return $enterprise_data;
        } else {
            return null;
        }
    }

    public function get_enterprise_rol_list() {

        $rol_list_query = $this->generate_query_rol_list();
        $enterprise_rol_list = $this->db->simple_query($rol_list_query);

        if (mysqli_num_rows($enterprise_rol_list) > 0) {
            return $enterprise_rol_list;
        } else {
            return null;
        }
    }

    public function update_company_data($company) {

        $company_id = $company["company_id"];

        $is_mail_admin_exist = $this->is_user_admin_mail_exist($company_id, $company["user_email"]);

        if (!$is_mail_admin_exist) {

            $register_query = $this->generate_update_enterprise_data($company);


            if ($this->db->simple_query($register_query)) {


                $is_schedule_company_query = $this->generate_schedule_company($company);

                if ($is_schedule_company_query) {

                    $admmin_register_query = $this->generate_update_admin_enterprise_data($company);



                    if ($this->db->simple_query($admmin_register_query)) {
                        $message_return["status"] = 200;
                        $message_return["message"] = "Empresa actualizada satisfactoriamente!";

                        return $message_return;
                    } else {
                        $message_return["status"] = 400;
                        $message_return["message"] = "Hubo un error al actualizar los datos del administrador";

                        return $message_return;
                    }
                } else {
                    $message_return["status"] = 400;
                    $message_return["message"] = "Hubo un error al actualizar los datos de la empresa";

                    return $message_return;
                }
            } else {
                $message_return["status"] = 400;
                $message_return["message"] = "Hubo un error al actualizar los datos de la empresa";

                return $message_return;
            }
        } else {
            $message_return["status"] = 400;
            $message_return["message"] = "El correo del administrador ya está registrado en la plataforma Def-Com";

            return $message_return;
        }
    }

    protected function generate_schedule_company($company) {

        $schedule = $company["schedule"];
        $is_schedule_complete = true;

        foreach ($schedule as $hour) {
            $query = "INSERT INTO company_scheduler " .
                    "(company_id,scheduler_label,scheduler_init_hour,scheduler_finish_hour) " .
                    "VALUES (" .
                    "" . $company["company_id"] . ", " .
                    "'" . $hour["label"] . "', " .
                    "'" . $hour["init"] . "', " .
                    "'" . $hour["finish"] . "'" .
                    ")";

            if (!$this->db->simple_query($query)) {
                $is_schedule_complete = false;
            }
        }

        return $is_schedule_complete;
    }

    protected function generate_update_enterprise_data($company) {

        $query = "UPDATE company SET " .
                " company_name =  '" . $company["company_name"] . "'," .
                " company_token =  '1'," .
                " sub_category_id =  " . $company["sub_category"] . "," .
                " company_image =  '" . $company["company_img"] . "'," .
                " company_banner =  '" . $company["company_banner_img"] . "'," .
                " company_status =  '2'" .
                " WHERE company_id=" . $company["company_id"];
        return $query;
    }

    protected function generate_update_admin_enterprise_data($company) {

        $query = "UPDATE user SET " .
                " user_email =  '" . $company["user_email"] . "'," .
                " user_name =  '" . $company["user_name"] . "'," .
                " user_tel =  '" . $company["user_tel"] . "'" .
                " WHERE company_id=" . $company["company_id"];



        return $query;
    }

    protected function generate_query_rol_list() {
        $query = " SELECT *  "
                . " FROM rol ";

        return $query;
    }

    protected function generate_query_data_enterprise_by_token($enterprise_token) {
        $query = " SELECT *  "
                . " FROM company c, user u "
                . " WHERE c.company_token = '" . $enterprise_token . "'"
                . " AND u.company_id = c.company_id "
                . " AND u.rol_id = 1 ";

        return $query;
    }

    protected function generate_enterprise_admin_query($enterprise_id, $enterprie) {

        $query = "INSERT INTO user " .
                "(company_id,rol_id,user_name,"
                . "residence_place,residence_lat,residence_long,"
                . "user_password,user_email,user_tel) " .
                "VALUES (" .
                "" . $enterprise_id . ", " .
                "1, " .
                "'" . $enterprie["name"] . "', " .
                "'" . $enterprie["place"] . "', " .
                "'" . $enterprie["place_lat"] . "', " .
                "'" . $enterprie["place_long"] . "', " .
                "'" . $enterprie["admin_password"] . "', " .
                "'" . $enterprie["email"] . "', " .
                "'" . $enterprie["tel"] . "'" .
                ")";

        // echo $query;

        return $query;
    }

    protected function generate_enterprise_register_query($enterprise) {
        $query = "INSERT INTO company " .
                "(company_status,company_name,company_domain,company_sales_points,"
                . "company_is_franchise, company_folder_token,company_comments,"
                . "company_token,company_creation_date) " .
                "VALUES (" .
                "0, " .
                "'" . $enterprise["company"] . "', " .
                "'" . $enterprise["company_domain"] . "', " .
                "'" . $enterprise["sales_points"] . "', " .
                "'" . $enterprise["is_franchise"] . "', " .
                "'" . $enterprise["enterprise_folder_token"] . "', " .
                "'" . $enterprise["comments"] . "', " .
                "'" . $enterprise["enterprise_token"] . "', " .
                "'" . date('m/d/Y h:i:s', time()) . "'" .
                ")";

        return $query;
    }

}
