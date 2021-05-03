

<?php

class ProductSalesOrder extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'product_sales_order';
        parent::__construct($this->table);
    }
    
    public function salesorder_product_list($sales_id){
        $sql  = "SELECT * FROM `product_sales_order` WHERE `sale_id` =$sales_id  ";
        return $this->db->query($sql)->result();     
        
    }

    function deleteProductSalesOrder($sales_id){
        $sql     = "DELETE FROM product_sales_order WHERE id=$sales_id ";
        $this->db->query($sql);

        return TRUE;
    }
    
}
?>