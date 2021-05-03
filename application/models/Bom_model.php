<?php
/* AG1803 */
/* AG10032021 - INITIAL CREATION */
class Bom_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'bom_creation';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $bom_table = $this->db->dbprefix('bom_creation');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $bom_table.id=$id";
        }

        $name = get_array_value($options, "name");
        if ($name) {
            $where = " AND $bom_table.name LIKE '".$name."'";
        }

        $end_product = get_array_value($options, "end_product");
        if ($end_product) {
            $where = " AND $bom_table.end_product=$end_product";
        }

        $sql = "SELECT $bom_table.*
        FROM $bom_table
        WHERE $bom_table.deleted=0 $where";

        return $this->db->query($sql);
    }

    function end_product_list(){
        $sql = "SELECT * FROM products WHERE type IN (6, 7)";

        return $this->db->query($sql);
    }

    function searchbom($search, $type){
        if($type == 7){
            $sql = "SELECT * FROM products WHERE (deleted = 0) AND (type = 5) AND (name LIKE '%".$search."%' OR code LIKE '%".$search."%')";
        }else{
            $sql = "SELECT * FROM products WHERE (deleted = 0) AND (type IN (5, 7)) AND (name LIKE '%".$search."%' OR code LIKE '%".$search."%')";
        }
       
        return $this->db->query($sql);
    }

    function search_end_product($search){
        $sql = "SELECT * FROM products WHERE (deleted = 0) AND (type IN (6, 7)) AND (name LIKE '%".$search."%' OR code LIKE '%".$search."%')";

        return $this->db->query($sql)->result();
    }

    function search_end_product_only($search, $type){
        $sql = "SELECT * FROM products WHERE (deleted = 0) AND (type = $type) AND (name LIKE '%".$search."%' OR code LIKE '%".$search."%')";

        return $this->db->query($sql)->result();
    }

    function checkName($name){
        $sql = "SELECT * FROM bom_creation WHERE (deleted = 0) AND name='$name'";
        
        return $this->db->query($sql)->result();
    }

}
