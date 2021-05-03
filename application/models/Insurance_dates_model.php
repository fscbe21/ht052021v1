<?php

class Insurance_dates_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'insurance_renewdates';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $other_road_table = $this->db->dbprefix('insurance_renewdates');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $other_road_table.id=$id";
        }

        $sql = "SELECT $other_road_table.*
        FROM $other_road_table";
        return $this->db->query($sql);
    }

   

}
