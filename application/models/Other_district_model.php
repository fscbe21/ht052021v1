<?php

class Other_district_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'other_district';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $other_district_table = $this->db->dbprefix('other_district');
       

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $other_district_table.id=$id";
        }

        $sql = "SELECT $other_district_table.* FROM $other_district_table
        WHERE $other_district_table.deleted=0 $where
        ORDER BY $other_district_table.sort ASC";
        return $this->db->query($sql);
    }


    function get_max_sort_value() {
        $other_district_table = $this->db->dbprefix('other_district');

        $sql = "SELECT MAX($other_district_table.sort) as sort
        FROM $other_district_table
        WHERE $other_district_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

  

  

}
