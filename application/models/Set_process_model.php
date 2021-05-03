<?php
/* AG1903 */
class Set_process_model extends Crud_model {

    
    private $table = null;

    function __construct() {
        $this->table = 'production_set_process';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $set_process_table = $this->db->dbprefix('production_set_process');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $set_process_table.id=$id";
        }

        $work_order_id = get_array_value($options, "work_order_id");
        if ($work_order_id) {
            $where .= " AND $set_process_table.work_order_id=$work_order_id";
        }

        $end_product_id = get_array_value($options, "end_product_id");
        if ($end_product_id) {
            $where .= " AND $set_process_table.end_product_id=$end_product_id";
        }

        $product_id = get_array_value($options, "product_id");
        if ($product_id) {
            $where .= " AND $set_process_table.product_id=$product_id";
        }

        $wo_product_id = get_array_value($options, "wo_product_id");
        if ($wo_product_id) {
            $where .= " AND $set_process_table.wo_product_id=$wo_product_id";
        }

        $status = get_array_value($options, "status");
        if ($status) {
            $where .= " AND $set_process_table.status=$status";
        }

        $sql = "SELECT $set_process_table.* FROM $set_process_table
        WHERE $set_process_table.deleted=0 $where";

        return $this->db->query($sql);
    }

    function delete_old_enties($wo_id, $ep_id){
        $sql = "DELETE FROM production_set_process WHERE work_order_id=$wo_id AND end_product_id=$ep_id";

        $this->db->query($sql);

        return TRUE;
    }


    function update_status($work_order_id, $process_product_id, $status){

        $sql = "UPDATE production_set_process SET status='$status' WHERE work_order_id='$work_order_id' AND end_product_id='$process_product_id'";

        $this->db->query($sql);

        return TRUE;
    }

    function get_qc_pass(){
        $sql = "SELECT * FROM production_set_process WHERE status=0";
        return $this->db->query($sql);
    }
      
}
