<?php
/* AG10032021 - INITIAL CREATION */
class Work_order_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'work_order';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $work_order_table = $this->db->dbprefix('work_order');
        $where = "";
        
        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $work_order_table.id=$id";
        }

        $customer_id = get_array_value($options, "customer_id");
        if ($customer_id) {
            $where .= " AND $work_order_table.customer_id=$customer_id";
        }

        $order_type = get_array_value($options, "order_type");
        if ($order_type) {
            $where .= " AND $work_order_table.order_type='$order_type'";
        }

        $sql = "SELECT $work_order_table.*
        FROM $work_order_table
        WHERE $work_order_table.deleted=0 $where ORDER BY id DESC";
        
        return $this->db->query($sql);
    }

    function end_product_list(){
        $sql = "SELECT * FROM products WHERE type IN (6, 7)";
        return $this->db->query($sql);
    }

    function searchbom($search, $type){

        if($type == 7){
            $sql = "SELECT * FROM products WHERE (type = 5) AND (name LIKE '%".$search."%' OR code LIKE '%".$search."%')";
        }else{
            $sql = "SELECT * FROM products WHERE (type IN (5, 7)) AND (name LIKE '%".$search."%' OR code LIKE '%".$search."%')";
        }
       
        return $this->db->query($sql);
    }

    function search_end_product($search){
        $sql = "SELECT * FROM products WHERE (type IN (6, 7)) AND (name LIKE '%".$search."%' OR code LIKE '%".$search."%')";

        return $this->db->query($sql)->result();
    }

    function search_end_product_only($search, $type){
        $sql = "SELECT * FROM products WHERE (type = $type) AND (name LIKE '%".$search."%' OR code LIKE '%".$search."%')";

        return $this->db->query($sql)->result();
    }

}
