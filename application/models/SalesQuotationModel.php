

<?php

class SalesQuotationModel extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'sales_quotation';
        parent::__construct($this->table);
    }
    
    function sales_quotation_list(){
        $sql  = "SELECT * FROM  sales_quotation ";
        return $this->db->query($sql)->result();         

    }

     //R.V26_04
     function sales_quoordno_list(){
   
        $sales_quotation_table = $this->db->dbprefix('sales_quotation');
        $sales_order_table = $this->db->dbprefix('sales_order');

      $sql = "SELECT * FROM $sales_quotation_table WHERE id NOT IN (SELECT sales_quotation FROM $sales_order_table)";

      return $this->db->query($sql);
    

    }
     //R.V26_04


    function deleteSalesQuotation($id){
        $sql     = "DELETE FROM sales_quotation WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }
}
?>