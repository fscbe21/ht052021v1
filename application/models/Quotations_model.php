<?php

class Quotations_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'quotations';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $quotations_table = $this->db->dbprefix('quotations');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $quotations_table.id=$id";
        }

        $where .= " ORDER BY id DESC";

        $sql = "SELECT $quotations_table.*
        FROM $quotations_table
        WHERE $quotations_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
