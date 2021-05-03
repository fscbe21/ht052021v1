<?php

class Pickup_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'pickup';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $Pickup_table = $this->db->dbprefix('Pickup');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $Pickup_table.id=$id";
        }

        $sql = "SELECT $Pickup_table.*
        FROM $Pickup_table
        WHERE $Pickup_table.deleted=0 $where
        ORDER BY $Pickup_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $Pickup_table = $this->db->dbprefix('Pickup');

        $sql = "SELECT MAX($Pickup_table.sort) as sort
        FROM $Pickup_table
        WHERE $Pickup_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
