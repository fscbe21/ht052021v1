
<?php

class Other_stage_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'other_stage';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $other_stage_table = $this->db->dbprefix('other_stage');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $other_stage_table.id=$id";
        }

        $sql = "SELECT $other_stage_table.*
        FROM $other_stage_table
        WHERE $other_stage_table.deleted=0 $where
        ORDER BY $other_stage_table.sort ASC";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $other_stage_table = $this->db->dbprefix('other_stage');

        $sql = "SELECT MAX($other_stage_table.sort) as sort
        FROM $other_stage_table
        WHERE $other_stage_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }

}

//Nandhini 15-3