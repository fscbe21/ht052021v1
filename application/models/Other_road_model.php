<?php

class Other_road_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'other_road';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $other_road_table = $this->db->dbprefix('other_road');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $other_road_table.id=$id";
        }

        $sql = "SELECT $other_road_table.*
        FROM $other_road_table
        WHERE $other_road_table.deleted=0 $where
        ORDER BY $other_road_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $other_road_table = $this->db->dbprefix('other_road');

        $sql = "SELECT MAX($other_road_table.sort) as sort
        FROM $other_road_table
        WHERE $other_road_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
