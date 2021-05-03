<?php

class Customergrp_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'customer_groups';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $customergrp_table = $this->db->dbprefix('customer_groups');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $customergrp_table.id=$id";
        }

        $sql = "SELECT $customergrp_table.*
        FROM $customergrp_table
        WHERE $customergrp_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
