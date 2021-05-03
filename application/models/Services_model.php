<?php

class Services_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'services';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $services_table = $this->db->dbprefix('services');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $services_table.id=$id";
        }

        $sql = "SELECT $services_table.*
        FROM $services_table
        WHERE $services_table.deleted=0 $where
        ORDER BY $services_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $services_table = $this->db->dbprefix('services');

        $sql = "SELECT MAX($services_table.sort) as sort
        FROM $services_table
        WHERE $services_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
