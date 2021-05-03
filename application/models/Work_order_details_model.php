<?php
/* AG10032021 - INITIAL CREATION */
class Work_order_details_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'work_order_details';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $work_order_details_table = $this->db->dbprefix('work_order_details');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $work_order_details_table.id=$id";
        }

        $work_order_id = get_array_value($options, "work_order_id");
        if ($work_order_id) {
            $where .= " AND $work_order_details_table.work_order_id=$work_order_id";
        }

/* AG1703 start*/
        $product_id = get_array_value($options, "product_id");
        if ($product_id) {
            $where .= " AND $work_order_details_table.product_id=$product_id";
        }
/* AG1703 end*/

        $bom_id = get_array_value($options, "bom_id");
        if ($bom_id) {
            $where .= " AND $work_order_details_table.bom_id=$bom_id";
        }

        $sql = "SELECT $work_order_details_table.*
        FROM $work_order_details_table
        WHERE $work_order_details_table.deleted=0 $where ORDER BY id DESC";
        return $this->db->query($sql);
    }

    function bom_prod_found($bom_id, $product_id){
        $sql = "SELECT * FROM work_order_details WHERE bom_id=$bom_id AND product_id=$product_id";

        $numrows = $this->db->query($sql)->num_rows();

        if($numrows > 0){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    function delete_all($bom_id){
        $sql     = "DELETE FROM work_order_details WHERE bom_id=$bom_id";
        $this->db->query($sql);

        return TRUE;
    }

    /** AG2103Q */
    function deleteEntries($work_order_id){
        $sql     = "DELETE FROM work_order_details WHERE work_order_id=$work_order_id";
        $this->db->query($sql);

        return TRUE;
    }

}

