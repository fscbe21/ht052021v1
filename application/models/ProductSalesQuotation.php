

<?php

class ProductSalesQuotation extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'product_sales_quotation';
        parent::__construct($this->table);
    }
    
    public function salesquotation_product_list($sales_id){
        $sql  = "SELECT * FROM `product_sales_quotation` WHERE `sale_id` =$sales_id  ";
        return $this->db->query($sql)->result();     
        
    }

    function deleteProductSalesQuotation($sales_id){
        $sql     = "DELETE FROM product_sales_quotation WHERE id=$sales_id ";
        $this->db->query($sql);

        return TRUE;
    }
}
?>