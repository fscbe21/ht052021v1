<?php

class Purchase_request_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'purchase_request';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {

        $purchase_request_table = $this->db->dbprefix('purchase_request');

        $where = "";

        $id = get_array_value($options, "id");

        if ($id) {
            $where = " AND $purchase_request_table.id=$id";
        }

        $where .= " ORDER BY id DESC";

        $sql = "SELECT $purchase_request_table.*
        FROM $purchase_request_table
        WHERE $purchase_request_table.deleted=0 $where";
        
        return $this->db->query($sql);

    }
    //changes 
    function getmaxid(){
        $sql = "SELECT MAX(id) as id FROM `purchase_request`";
        
        return $this->db->query($sql);
    }

}
