<?php

class Purchase_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'purchases';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $purchases_table = $this->db->dbprefix('purchases');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $purchases_table.id=$id";
        }

        $where .= " ORDER BY id DESC";

        $sql = "SELECT $purchases_table.*
        FROM $purchases_table
        WHERE $purchases_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
