<?php

class Warehouse_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'warehouse';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $warehouse_table = $this->db->dbprefix('warehouse');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $warehouse_table.id=$id";
        }

        $sql = "SELECT $warehouse_table.*
        FROM $warehouse_table
        WHERE $warehouse_table.deleted=0 $where";
        return $this->db->query($sql);
    }
    
}
