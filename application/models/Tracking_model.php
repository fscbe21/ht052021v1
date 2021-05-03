<?php

class Tracking_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'tracking';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $Tracking_table = $this->db->dbprefix('tracking');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $Tracking_table.id=$id";
        }

        $sql = "SELECT $Tracking_table.*
        FROM $Tracking_table
        WHERE $Tracking_table.deleted=0 $where
        ORDER BY $Tracking_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $Tracking_table = $this->db->dbprefix('tracking');

        $sql = "SELECT MAX($Tracking_table.sort) as sort
        FROM $Tracking_table
        WHERE $Tracking_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
