<?php

class Reuse_details_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'reuse_details';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $reuse_details_table = $this->db->dbprefix('reuse_details');
        $where= "";

        $id=get_array_value($options, "id");
        if($id){
            $where .=" AND $reuse_details_table.id=$id";
        }

        $reuse_id=get_array_value($options, "reuse_id");
        if($reuse_id){
            $where .=" AND $reuse_details_table.reuse_id=$reuse_id";
        }

        $product_id=get_array_value($options, "product_id");
        if($product_id){
            $where .=" AND $reuse_details_table.product_id=$product_id";
        }
        
        $sql = "SELECT $reuse_details_table.*
        FROM $reuse_details_table
        WHERE $reuse_details_table.deleted=0 $where";
        return $this->db->query($sql);
        
    }

}
