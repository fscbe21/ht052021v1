<?php

class Vechicle_Services_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'vechicle_services';
        parent::__construct($this->table);
    }
   

    function get_details($options = array()) {
        $services_table = $this->db->dbprefix('vechicle_services');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $services_table.id=$id";
        }

        $sql = "SELECT $services_table.*
        FROM $services_table WHERE $services_table.service_type=2 AND $services_table.service_deleted=0";
        return $this->db->query($sql);
    }

    function get_insurance_details($options = array()) {
        $services_table = $this->db->dbprefix('vechicle_services');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $services_table.id=$id";
        }

        $sql = "SELECT $services_table.*
        FROM $services_table WHERE $services_table.service_type=3 AND $services_table.insurance_deleted=0";
        return $this->db->query($sql);
    }

   

}
