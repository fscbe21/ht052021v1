<?php

class Fasttag_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'fasttag';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
       $Fasttag_table = $this->db->dbprefix('fasttag');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $Fasttag_table.id=$id";
        }

        $sql = "SELECT $Fasttag_table.*
        FROM $Fasttag_table
        WHERE $Fasttag_table.deleted=0";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
       $Fasttag_table = $this->db->dbprefix('fasttag');

        $sql = "SELECT MAX($Pickup_table.sort) as sort
        FROM $Fasttag_table
        WHERE $Fasttag_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
