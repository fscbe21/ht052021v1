<?php

class Tds_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'tds';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $tds_table = $this->db->dbprefix('tds');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $tds_table.id=$id";
        }

        $sql = "SELECT $tds_table.*
        FROM $tds_table
        WHERE $tds_table.deleted=0 $where
        ORDER BY $tds_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $tds_table = $this->db->dbprefix('tds');

        $sql = "SELECT MAX($tds_table.sort) as sort
        FROM $tds_table
        WHERE $tds_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
