<?php

class Payment_status_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'payment_status';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $payment_status_table = $this->db->dbprefix('payment_status');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $payment_status_table.id=$id";
        }

        $sql = "SELECT $payment_status_table.*
        FROM $payment_status_table
        WHERE $payment_status_table.deleted=0 $where
        ORDER BY $payment_status_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $payment_status_table = $this->db->dbprefix('payment_status');

        $sql = "SELECT MAX($payment_status_table.sort) as sort
        FROM $payment_status_table
        WHERE $payment_status_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

    function get_name($id){
        $sql = "SELECT name FROM payment_status WHERE id=$id";
        return $this->db->query($sql);
    }

}
