<?php

class Customer_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'customer';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $customer_table = $this->db->dbprefix('customer');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $customer_table.id=$id";
        }

        $sql = "SELECT $customer_table.*
        FROM $customer_table
        WHERE $customer_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
