<?php

class Supplier_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'supplier';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $supplier_table = $this->db->dbprefix('supplier');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $supplier_table.id=$id";
        }

        $sql = "SELECT $supplier_table.*
        FROM $supplier_table
        WHERE $supplier_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function get_al(){
        $sql = "SELECT * FROM supplier ORDER BY id DESC LIMIT 1";
        return $this->db->query($sql);
    }

}
