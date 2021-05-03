<?php

class Productpurchase_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'product_purchases';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $products_purchases_table = $this->db->dbprefix('product_purchases');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $products_purchases_table.id=$id";
        }

        $purchase_id = get_array_value($options, "purchase_id");
        if ($purchase_id) {
            $where = " AND $products_purchases_table.purchase_id=$purchase_id";
        }

        $product_id = get_array_value($options, "product_id");
        if ($product_id) {
            $where = " AND $products_purchases_table.product_id=$product_id";
        }

        $start_date = get_array_value($options, "start_date");
        if ($start_date) {
            $where .= " AND $products_purchases_table.created_at >= '$start_date'";
        }

        $end_date = get_array_value($options, "end_date");
        if ($end_date) {
            $where .= " AND $products_purchases_table.created_at <= '$end_date'";
        }

        $warehouse_id = get_array_value($options, "warehouse_id");
        if ($warehouse_id) {
            $where .= " AND $products_purchases_table.warehouse_id=$warehouse_id";
        }

        $sql = "SELECT $products_purchases_table.*
        FROM $products_purchases_table
        WHERE $products_purchases_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function get_distinct_details($options = array()) {
        $products_purchases_table = $this->db->dbprefix('product_purchases');
        $where = "";

      
        $purchase_id = get_array_value($options, "purchase_id");
        

        $sql = "SELECT DISTINCT purchase_id
        FROM $products_purchases_table
        WHERE $products_purchases_table.deleted=0 ";
        return $this->db->query($sql);
    }

    function deleteProductPurchase($purchase_id){
        $sql     = "DELETE FROM product_purchases WHERE id=$purchase_id";
        $this->db->query($sql);

        return TRUE;
    }
    function unique_id($options = array()){
        $products_purchases_table = $this->db->dbprefix('product_purchases');
        $where = "";
        $warehouse_table = $this->db->dbprefix('warehouse');
        $product_table = $this->db->dbprefix('products');

        $start_date = get_array_value($options, "start_date");
        if ($start_date) {
            $where .= " AND $products_purchases_table.created_at >= '$start_date'";
        }

        $end_date = get_array_value($options, "end_date");
        if ($end_date) {
            $where .= " AND $products_purchases_table.created_at <= '$end_date'";
        }
        $product_id = get_array_value($options, "product_id");
        if ($product_id) {
            $where .= " AND $products_purchases_table.product_id=$product_id";
        }
        $warehouse_id = get_array_value($options, "warehouse_id");
        if ($warehouse_id) {
            $where .= " AND $products_purchases_table.warehouse_id=$warehouse_id";
        }

        $sql="SELECT product_id
        from $products_purchases_table
        
        LEFT JOIN $warehouse_table ON $warehouse_table.id = $products_purchases_table.warehouse_id
        WHERE $products_purchases_table.deleted=0 $where 
        GROUP BY product_id";
        
        return $this->db->query($sql);
    }
}
