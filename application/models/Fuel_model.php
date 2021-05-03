<?php

class Fuel_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'vechicle_services';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $fuel_table = $this->db->dbprefix('vechicle_services');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $fuel_table.id=$id";
        }

        $sql = "SELECT $fuel_table.*
        FROM $fuel_table
        WHERE $fuel_table.service_type=1 AND fuel_deleted=0";
        return $this->db->query($sql);
    }

   
}
