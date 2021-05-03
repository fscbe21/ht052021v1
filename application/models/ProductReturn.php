

<?php

class ProductReturn extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'product_returns';
        parent::__construct($this->table);
    }
    public function sales_return_product_list($id){
        $sql  = "SELECT * FROM `product_returns` WHERE `return_id` =$id  ";
        return $this->db->query($sql)->result();     
        
    }
   function deleteProductSalesReturn($id){

    $sql     = "DELETE FROM product_returns WHERE id=$id ";
    $this->db->query($sql);

    return TRUE;

   }
}
?>