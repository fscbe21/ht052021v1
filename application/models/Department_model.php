<?php

class Department_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'department';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $department_table = $this->db->dbprefix('department');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $department_table.id=$id";
        }

        $sql = "SELECT $department_table.*
        FROM $department_table
        WHERE $department_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
