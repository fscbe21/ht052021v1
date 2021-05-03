<?php

class Insurance_company_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'insurance_company';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $insurace_company_table = $this->db->dbprefix('insurance_company');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $insurace_company_table.id=$id";
        }

        $sql = "SELECT $insurace_company_table.*
        FROM $insurace_company_table
        WHERE $insurace_company_table.deleted=0 $where
        ORDER BY $insurace_company_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $insurace_company_table = $this->db->dbprefix('insurance_company');

        $sql = "SELECT MAX($insurace_company_table.sort) as sort
        FROM $insurace_company_table
        WHERE $insurace_company_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
