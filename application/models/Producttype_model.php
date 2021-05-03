<?php

class Producttype_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'producttype';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $ptype_table = $this->db->dbprefix('producttype');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $ptype_table.id=$id";
        }

        $sql = "SELECT $ptype_table.*
        FROM $ptype_table
        WHERE $ptype_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
