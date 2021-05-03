<?php

class Process_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'process';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $process_table = $this->db->dbprefix('process');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $process_table.id=$id";
        }

        $sql = "SELECT $process_table.* FROM $process_table
        WHERE $process_table.deleted=0 $where";

        return $this->db->query($sql);
    }


    function get_max_sort_value() {
        $process_table = $this->db->dbprefix('process');

        $sql = "SELECT MAX($process_table.sort) as sort
        FROM $process_table
        WHERE $process_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

  

  

}
