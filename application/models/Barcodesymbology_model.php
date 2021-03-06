<?php

class Barcodesymbology_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'barcodesymbology';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $bs_table = $this->db->dbprefix('barcodesymbology');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $bs_table.id=$id";
        }

        $sql = "SELECT $bs_table.*
        FROM $bs_table
        WHERE $bs_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
