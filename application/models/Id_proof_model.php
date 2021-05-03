<?php

class Id_proof_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'id_proof';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $idproof_table = $this->db->dbprefix('id_proof');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $idproof_table.id=$id";
        }

        $sql = "SELECT $idproof_table.*
        FROM $idproof_table
        WHERE $idproof_table.deleted=0 $where
        ORDER BY $idproof_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $idproof_table = $this->db->dbprefix('tds');

        $sql = "SELECT MAX($idproof_table.sort) as sort
        FROM $idproof_table
        WHERE $idproof_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}
