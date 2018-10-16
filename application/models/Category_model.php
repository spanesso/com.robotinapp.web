<?php

class Category_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_category_list() {
        $query = " SELECT *  "
                . " FROM category   ";

        $category_list = $this->db->simple_query($query);
        if (mysqli_num_rows($category_list) > 0) {
            return $category_list;
        } else {
            return null;
        }
    }

    public function get_sub_catgories($category) {
        $query = " SELECT *  "
                . " FROM sub_category"
                . " WHERE category_id = " . $category;

        $sub_category_list = $this->db->simple_query($query);

        if (mysqli_num_rows($sub_category_list) > 0) {
            $sub_category_list_array = null;
            while ($category = $sub_category_list->fetch_array(MYSQLI_ASSOC)) {
                $sub_category_list_array[] = $category;
            }
            return $sub_category_list_array;
        } else {
            return null;
        }
    }
}
