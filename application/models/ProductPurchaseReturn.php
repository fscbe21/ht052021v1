

<?php

class ProductPurchaseReturn extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'purchase_product_return';
        parent::__construct($this->table);
    }
    public function purchase_return_product_list($id){
        $sql  = "SELECT * FROM `purchase_product_return` WHERE `return_id` =$id  ";
        return $this->db->query($sql)->result();     
        
    }
    function deleteProductPurchaseReturn($id){

        $sql     = "DELETE FROM purchase_product_return WHERE id=$id ";
        $this->db->query($sql);
    
        return TRUE;
    
       }
}
?>