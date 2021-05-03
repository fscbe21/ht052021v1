

<?php

class SalesOrderModel extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'sales_order';
        parent::__construct($this->table);
    }
    
    function sales_order_list(){
        $sql  = "SELECT * FROM  sales_order ";
        return $this->db->query($sql)->result();         

    }

    function deleteSalesOrder($id){
        $sql     = "DELETE FROM sales_order WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }

    function search_using_so_or_ref($search){

        $sql = "SELECT * from sales_order WHERE id LIKE '%".$search."%' AND id NOT IN (SELECT sales_order_number from work_order WHERE sales_order_number = '$search')";

        return $this->db->query($sql)->result();
    }
        
}
?>