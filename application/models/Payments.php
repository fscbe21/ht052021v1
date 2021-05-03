<?php

class Payments  extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'payments';
        parent::__construct($this->table);
    }

    function getPayments($sales_id){
        $sql  = "SELECT * FROM `payments` WHERE `sale_id` = $sales_id ";
        return $this->db->query($sql)->result();  
    }
    //darini 19-3
    function getPaymentsofPurchase($purchase_id){
        $sql  = "SELECT * FROM `payments` WHERE `purchase_id` = $purchase_id ";
        return $this->db->query($sql)->result();  
    }

    function deletepayment($id){
        $sql     = "DELETE FROM payments WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }


    

}
