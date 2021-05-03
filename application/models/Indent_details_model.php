<?php

class Indent_details_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'indent_details';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $indent_table = $this->db->dbprefix('indent_details');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $indent_table.id=$id";
        }

        $indent_id = get_array_value($options, "indent_id");
        if ($indent_id) {
            $where .= " AND $indent_table.indent_id=$indent_id";
        }

        $sql = "SELECT $indent_table.*
        FROM $indent_table
        WHERE $indent_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
