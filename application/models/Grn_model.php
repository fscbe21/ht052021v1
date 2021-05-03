<?php

class Grn_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'grns';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $grns_table = $this->db->dbprefix('grns');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $grns_table.id=$id";
        }

        $where .= " ORDER BY id DESC";

        $sql = "SELECT $grns_table.*
        FROM $grns_table
        WHERE $grns_table.deleted=0 $where";
        return $this->db->query($sql);
    }
    //extra
    function purchaseIdList(){
        $sql = "SELECT `purchase_id`FROM `grns`";
        return $this->db->query($sql);
    }

    function get_last_data(){
        $sql = "SELECT * FROM grns ORDER BY id DESC LIMIT 1";
        return $this->db->query($sql);
    }

}
