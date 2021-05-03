<?php

class Sale_status_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'sale_status';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $sale_status_table = $this->db->dbprefix('sale_status');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $sale_status_table.id=$id";
        }

        $sql = "SELECT $sale_status_table.*
        FROM $sale_status_table
        WHERE $sale_status_table.deleted=0 $where
        ORDER BY $sale_status_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $sale_status_table = $this->db->dbprefix('sale_status');

        $sql = "SELECT MAX($sale_status_table.sort) as sort
        FROM $sale_status_table
        WHERE $sale_status_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
