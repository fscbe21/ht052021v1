<?php

class Products_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'products';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $products_table = $this->db->dbprefix('products');
        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $products_table.id=$id";
        }

          //dsk start 
          $product_type = get_array_value($options, "product_type");
          if ($product_type) {
              $where = " AND $products_table.type='$product_type'";
          }
  
          //dsk end

        $sql = "SELECT $products_table.*
        FROM $products_table
        WHERE $products_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function check_product_code($product_code){
        $sql = "SELECT * FROM products WHERE code = $product_code";
        return $this->db->query($sql)->num_rows();
    }

    function search($search){
        $sql = "SELECT * FROM products WHERE name LIKE '%".$search."%' OR code LIKE '%".$search."%'";
        return $this->db->query($sql);

    }

    function search_raw_material($search){
        $sql = "SELECT * FROM products WHERE  type='5' AND (name LIKE '%".$search."%' OR code LIKE '%".$search."%')";
        return $this->db->query($sql);

    }
    
    function get_al(){
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 1";
        return $this->db->query($sql);
    }

}
