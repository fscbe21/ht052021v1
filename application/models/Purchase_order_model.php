<?php

class Purchase_order_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'purchase_orders';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $purchase_order_table = $this->db->dbprefix('purchase_orders');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $purchase_order_table.id=$id";
        }

        $where .= " ORDER BY id DESC";

        $sql = "SELECT $purchase_order_table.*
        FROM $purchase_order_table
        WHERE $purchase_order_table.deleted=0 $where";
        return $this->db->query($sql);
    }
    //extra
    function getmaxid(){
        $sql = "SELECT MAX(id) as id FROM `purchase_orders`";
        
        return $this->db->query($sql);
    }
}
