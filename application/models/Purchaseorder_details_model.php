<?php

class Purchaseorder_details_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'purchase_order_details';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $purchase_order_details_table = $this->db->dbprefix('purchase_order_details');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $purchase_order_details_table.id=$id";
        }

        $purchase_order_id = get_array_value($options, "purchase_order_id");
        if ($purchase_order_id) {
            $where = " AND $purchase_order_details_table.purchase_order_id=$purchase_order_id";
        }

        $sql = "SELECT $purchase_order_details_table.*
        FROM $purchase_order_details_table
        WHERE $purchase_order_details_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function deleteProductPurchase($purchase_order_id){
        $sql     = "DELETE FROM purchase_order_details WHERE id=$purchase_order_id";
        $this->db->query($sql);

        return TRUE;
    }
      //changes 31-3
      function updateremaingqty($pid,$orid,$qty){
        $sql = "UPDATE `purchase_order_details` SET remaining_qty=(remaining_qty + $qty)  WHERE purchase_order_id = $orid AND product_id = $pid";
        return $this->db->query($sql);
    }
    
}
