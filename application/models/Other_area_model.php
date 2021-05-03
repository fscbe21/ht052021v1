<?php

class Other_area_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'other_area';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $other_area_table = $this->db->dbprefix('other_area');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $other_area_table.id=$id";
        }

        $sql = "SELECT $other_area_table.*
        FROM $other_area_table
        WHERE $other_area_table.deleted=0 $where
        ORDER BY $other_area_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $other_area_table = $this->db->dbprefix('other_area');

        $sql = "SELECT MAX($other_area_table.sort) as sort
        FROM $other_area_table
        WHERE $other_area_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
