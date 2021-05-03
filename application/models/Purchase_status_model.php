<?php

class Purchase_status_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'purchase_status';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $purchase_status_table = $this->db->dbprefix('purchase_status');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $purchase_status_table.id=$id";
        }

        $sql = "SELECT $purchase_status_table.*
        FROM $purchase_status_table
        WHERE $purchase_status_table.deleted=0 $where
        ORDER BY $purchase_status_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $purchase_status_table = $this->db->dbprefix('purchase_status');

        $sql = "SELECT MAX($purchase_status_table.sort) as sort
        FROM $purchase_status_table
        WHERE $purchase_status_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
