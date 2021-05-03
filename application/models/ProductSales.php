

<?php

class ProductSales extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'product_sales';
        parent::__construct($this->table);
    }
    
    public function sales_product_list($sales_id){
        $sql  = "SELECT * FROM `product_sales` WHERE `sale_id` =$sales_id  ";
        return $this->db->query($sql)->result();     
        
    }

    function deleteProductSales($sales_id){
        $sql     = "DELETE FROM product_sales WHERE id=$sales_id ";
        $this->db->query($sql);

        return TRUE;
    }
}
?>