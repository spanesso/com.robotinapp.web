<?php

class Plans_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_category_plans() {
        $query = " SELECT * "
                . " FROM category_plan";

        $category_plan_list = $this->db->simple_query($query);
        if (mysqli_num_rows($category_plan_list) > 0) {
            return $category_plan_list;
        } else {
            return null;
        }
    }

    public function get_plans() {
        $query = " SELECT cp.name as category,  p.name, p.price, p.status, p.id_plan, p.url_payment "
                . " FROM category_plan cp, plans p"
                . " WHERE p.id_category = cp.id_category ";

        $user_housekeeping_list = $this->db->simple_query($query);
        if (mysqli_num_rows($user_housekeeping_list) > 0) {
            return $user_housekeeping_list;
        } else {
            return null;
        }
    }

    public function m_get_plans() {

        $query = " SELECT  *"
                . " FROM category_plan c"
                . " ORDER BY c.id_category ASC";

        $category_plan_list_result = $this->db->simple_query($query);


        if (mysqli_num_rows($category_plan_list_result) > 0) {

            $array_category_list = array();
            while ($category = mysqli_fetch_assoc($category_plan_list_result)) {
                array_push($array_category_list, $category);
            }
            
             $array_category_list_return = array();
            foreach ($array_category_list as $category) {
                $query_plan = " SELECT  "
                        . "p.id_plan, p.name as planName, p.price, p.url_payment,"
                        . " p.description as planDesc"
                        . " FROM category_plan c, plans p"
                        . " WHERE p.id_category = c.id_category "
                        . " AND c.id_category = " . $category["id_category"]
                        . " ORDER BY c.id_category ASC";

                $plan_list_result = $this->db->simple_query($query_plan);
                if (mysqli_num_rows($plan_list_result) > 0) {

                    $array_plans_list = array();
                    while ($plan = mysqli_fetch_assoc($plan_list_result)) {
                        array_push($array_plans_list, $plan);
                    }
                    
                    $category["plans"] = $array_plans_list;
                     array_push($array_category_list_return, $category);
                }
            }


            return $array_category_list_return;
        } else {
            return null;
        }
 
    }

    public function get_plan_data_by_id($id_plan) {

        $query = " SELECT cp.name as category, cp.id_category, p.name, p.price,"
                . " p.status, p.id_plan, p.description, p.url_payment "
                . " FROM category_plan cp, plans p"
                . " WHERE p.id_category = cp.id_category "
                . " AND p.id_plan = " . $id_plan;



        $plan = $this->db->simple_query($query);

        if (mysqli_num_rows($plan) > 0) {
            return $plan;
        } else {
            return null;
        }
    }

    public function update_data_plan($plan) {


        $query = "UPDATE plans SET " .
                " name = '" . $plan["name"] . "', " .
                " url_payment = '" . $plan["url"] . "', " .
                " id_category = " . $plan["category"] . ", " .
                " price = " . $plan["price"] . ", " .
                " status = " . $plan["status"] . ", " .
                " description = '" . $plan["desc"] . "' " .
                " WHERE id_plan = " . $plan["id"];


        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => 200,
                "message" => "Plan user successfull"
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => 400,
                "message" => "Error to update plan"
            );
            return $message_return;
        }
    }

    public function create_plan($user) {

        $query = "INSERT INTO plans " .
                "(id_category,name,url_payment,price,status,description ) " .
                "VALUES (" .
                "" . $user["category"] . ", " .
                "'" . $user["name"] . "', " .
                "'" . $user["url"] . "', " .
                "" . $user["price"] . ", " .
                "1, " .
                "'" . $user["desc"] . "'" .
                ")";


        if ($this->db->simple_query($query)) {
            $message_return = array(
                "status" => 200,
                "message" => "Create plan successful."
            );
            return $message_return;
        } else {
            $message_return = array(
                "status" => 400,
                "message" => "Error to create plan."
            );
            return $message_return;
        }
    }

    public function get_count() {
        $query = "SELECT COUNT(*) AS plans FROM plans;";
        $plans_count = $this->db->simple_query($query);
        $count = 0;

        while ($count_query = $plans_count->fetch_array(MYSQLI_ASSOC)) {
            $count = $count_query["plans"];
        }
        return $count;
    }

}
