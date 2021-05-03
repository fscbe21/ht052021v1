

<?php

class PurchaseReturnModel extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'return_purchases';
        parent::__construct($this->table);
    }
    
    function return_list(){
        $sql  = "SELECT * FROM  `return_purchases` ";
        return $this->db->query($sql)->result();         

    }

    function deletePurchaseReturn($id){
        $sql     = "DELETE FROM  `return_purchases` WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }
}
?>