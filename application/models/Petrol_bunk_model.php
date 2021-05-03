<?php

class Petrol_bunk_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'petrol_bunks';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $petrol_bunk_table = $this->db->dbprefix('petrol_bunks');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $petrol_bunk_table.id=$id";
        }

        $sql = "SELECT $petrol_bunk_table.*
        FROM $petrol_bunk_table
        WHERE $petrol_bunk_table.deleted=0 $where
        ORDER BY $petrol_bunk_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $petrol_bunk_table = $this->db->dbprefix('petrol_bunks');

        $sql = "SELECT MAX($petrol_bunk_table.sort) as sort
        FROM $petrol_bunk_table
        WHERE $petrol_bunk_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
