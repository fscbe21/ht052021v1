<?php

class Productgrn_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'product_grns';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $products_grns_table = $this->db->dbprefix('product_grns');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $products_grns_table.id=$id";
        }

        $grn_id = get_array_value($options, "grn_id");
        if ($grn_id) {
            $where = " AND $products_grns_table.grn_id=$grn_id";
        }

        $sql = "SELECT $products_grns_table.*
        FROM $products_grns_table
        WHERE $products_grns_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function deleteProductGrn($grn_id){
        $sql     = "DELETE FROM product_grns WHERE id=$grn_id";
        $this->db->query($sql);

        return TRUE;
    }
}
