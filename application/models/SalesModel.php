<?php

class SalesModel extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'sales';
        parent::__construct($this->table);
    }
    
    function sales_list(){
        $sql  = "SELECT * FROM  sales ";
        return $this->db->query($sql)->result();         

    }

    function deleteSales($id){
        $sql     = "DELETE FROM sales WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }

    function get_details($options = array()) {
        $sales_table = $this->db->dbprefix('sales');
        $where = "";

        $sales_order = get_array_value($options, "sales_order");
        if ($sales_order) {
            $where .= " AND $sales_table.sales_order=$sales_order";
        }

        $sql = "SELECT $sales_table.*
        FROM $sales_table
        WHERE $sales_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function getdetails($sale_order){
        $sql  = "SELECT * FROM  sales WHERE sales_order = $sale_order";
        return $this->db->query($sql)->result(); 
    }
    
}
?>