<?php

class ProductTransfer extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'product_transfer';
        parent::__construct($this->table);
    }
    
    public function transfer_product_list($id){
        $sql  = "SELECT * FROM `product_transfer` WHERE `transfer_id` =$id  ";
        return $this->db->query($sql)->result();     
        
    }

    function deleteProductTransfer($id){
        $sql     = "DELETE FROM product_transfer WHERE id=$id ";
        $this->db->query($sql);

        return TRUE;
    }


    function report_transfer($options = array()){
        $prod_transfer_table = $this->db->dbprefix('product_transfer');
        $transfers_table = $this->db->dbprefix('transfers');

        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $prod_transfer_table.id=$id";
        }

        $from_date = get_array_value($options, "from_date");
        if ($from_date) {
            $where .= " AND $prod_transfer_table.created_at >= '$from_date'";
        }

        $to_date = get_array_value($options, "to_date");
        if ($to_date) {
            $where .= " AND $prod_transfer_table.created_at <= '$to_date'";
        }

        $from_warehouse = get_array_value($options, "from_warehouse");
        if ($from_warehouse) {
            $where .= " AND $transfers_table.from_warehouse_id = $from_warehouse";
        }

        $to_warehouse = get_array_value($options, "to_warehouse");
        if ($to_warehouse) {
            $where .= " AND $transfers_table.to_warehouse_id = $to_warehouse";
        }

        $sql = "SELECT $prod_transfer_table.* FROM $prod_transfer_table 
        LEFT JOIN $transfers_table ON $transfers_table.id=$prod_transfer_table.transfer_id WHERE $transfers_table.status=1 $where";
        
        return $this->db->query($sql);
    }

}
?>