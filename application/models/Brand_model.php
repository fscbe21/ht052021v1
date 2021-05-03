<?php

class Brand_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'brand';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $brand_table = $this->db->dbprefix('brand');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $brand_table.id=$id";
        }

        $sql = "SELECT $brand_table.*
        FROM $brand_table
        WHERE $brand_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
