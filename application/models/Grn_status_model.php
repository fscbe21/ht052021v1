<?php

class Grn_status_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'grn_status';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $grn_status_table = $this->db->dbprefix('grn_status');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $grn_status_table.id=$id";
        }

        $sql = "SELECT $grn_status_table.*
        FROM $grn_status_table
        WHERE $grn_status_table.deleted=0 $where
        ORDER BY $grn_status_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $grn_status_table = $this->db->dbprefix('grn_status');

        $sql = "SELECT MAX($grn_status_table.sort) as sort
        FROM $grn_status_table
        WHERE $grn_status_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
