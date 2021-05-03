<?php

class Vendor_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'vendor';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $vendor_table = $this->db->dbprefix('vendor');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $vendor_table.id=$id";
        }

        $sql = "SELECT $vendor_table.*
        FROM $vendor_table
        WHERE $vendor_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
