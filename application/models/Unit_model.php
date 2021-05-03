<?php

class Unit_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'unit';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $unit_table = $this->db->dbprefix('unit');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $unit_table.id=$id";
        }

        $sql = "SELECT $unit_table.*
        FROM $unit_table
        WHERE $unit_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
