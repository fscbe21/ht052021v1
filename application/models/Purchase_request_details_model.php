<?php

class Purchase_request_details_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'purchase_request_details';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {

        $purchase_request_details_table = $this->db->dbprefix('purchase_request_details');

        $where = "";

        $id = get_array_value($options, "id");

        if ($id) {
            $where = " AND $purchase_request_details_table.id=$id";
        }

       // $where .= " ORDER BY id DESC";

       $purchase_request_id = get_array_value($options, "purchase_request_id");
       if ($purchase_request_id) {
           $where .= " AND $purchase_request_details_table.purchase_request_id=$purchase_request_id";
       }

        $sql = "SELECT $purchase_request_details_table.*
        FROM $purchase_request_details_table
        WHERE $purchase_request_details_table.deleted=0 $where";
        
        return $this->db->query($sql);

    }
 //darini 22-3
    function deleteProductRequest($id){
        $sql     = "DELETE FROM purchase_request_details WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }


   
    function getprdtdetails($id){
        $sql  = "SELECT * FROM `purchase_request_details` WHERE `purchase_request_id` =$id  ";
        return $this->db->query($sql)->result();     
    }
 //changes 31-3
 function updateremaingqty($pid,$reqid,$qty){
    $sql = "UPDATE `purchase_request_details` SET remaining_qty=(remaining_qty + $qty)  WHERE purchase_request_id = $reqid AND product_id = $pid";
    return $this->db->query($sql);
}
}
