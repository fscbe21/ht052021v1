<?php

class Holidays_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'holidays';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $holidays_table = $this->db->dbprefix('holidays');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $holidays_table.id=$id ";
        }


        $start_date = get_array_value($options, "start_date");
        $end_date = get_array_value($options, "end_date");
        if ($start_date && $end_date) {

            $where .= " AND $holidays_table.start_date='$start_date' ";
            
        }

        $sql = "SELECT $holidays_table.*
        FROM $holidays_table
        WHERE $holidays_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
