<?php

class Address_proof_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'address_proof';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $addr_proof_table = $this->db->dbprefix('address_proof');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $addr_proof_table.id=$id";
        }

        $sql = "SELECT $addr_proof_table.*
        FROM $addr_proof_table
        WHERE $addr_proof_table.deleted=0 $where
        ORDER BY $addr_proof_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $addr_proof_table = $this->db->dbprefix('tds');

        $sql = "SELECT MAX($addr_proof_table.sort) as sort
        FROM $addr_proof_table
        WHERE $addr_proof_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
