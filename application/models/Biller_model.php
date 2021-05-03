<?php

class Biller_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'billers';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $biller_table = $this->db->dbprefix('billers');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $biller_table.id=$id";
        }

        $sql = "SELECT $biller_table.*
        FROM $biller_table
        WHERE $biller_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
