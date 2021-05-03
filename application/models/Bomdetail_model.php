<?php
/* AG10032021 - INITIAL CREATION */
class Bomdetail_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'bom_creation_detail';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $bom_detail_table = $this->db->dbprefix('bom_creation_detail');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $bom_detail_table.id=$id";
        }

        $bom_id = get_array_value($options, "bom_id");
        if ($bom_id) {
            $where .= " AND $bom_detail_table.bom_id=$bom_id";
        }

        $product_id = get_array_value($options, "product_id");
        if ($product_id) {
            $where .= " AND $bom_detail_table.product_id=$product_id";
        }

        $sql = "SELECT $bom_detail_table.*
        FROM $bom_detail_table
        WHERE $bom_detail_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function bom_prod_found($bom_id, $product_id){
        $sql = "SELECT * FROM bom_creation_detail WHERE bom_id=$bom_id AND product_id=$product_id";

        $numrows = $this->db->query($sql)->num_rows();

        if($numrows > 0){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    function delete_all($bom_id){
        $sql     = "DELETE FROM bom_creation_detail WHERE bom_id=$bom_id";
        $this->db->query($sql);

        return TRUE;
    }

}

