<?php
/* AG20-03-2021 */
class Assignbom_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'production_assign_bom';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $production_assign_bom_table = $this->db->dbprefix('production_assign_bom');

        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $production_assign_bom_table.id=$id";
        }

        $work_order_id = get_array_value($options, "work_order_id");
        if ($work_order_id) {
            $where .= " AND $production_assign_bom_table.work_order_id=$work_order_id";
        }

        $end_product_id = get_array_value($options, "end_product_id");
        if ($end_product_id) {
            $where .= " AND $production_assign_bom_table.end_product_id=$end_product_id";
        }

        $wo_product_id = get_array_value($options, "wo_product_id");
        if ($wo_product_id) {
            $where .= " AND $production_assign_bom_table.wo_product_id=$wo_product_id";
        }

        $product_id = get_array_value($options, "product_id");
        if ($product_id) {
            $where .= " AND $production_assign_bom_table.product_id=$product_id";
        }

        $warehouse_id = get_array_value($options, "warehouse_id");
        if ($warehouse_id) {
            $where .= " AND $production_assign_bom_table.warehouse_id=$warehouse_id";
        }

        $bom_id = get_array_value($options, "bom_id");
        if ($bom_id) {
            $where .= " AND $production_assign_bom_table.bom_id=$bom_id";
        }

        $sql = "SELECT $production_assign_bom_table.*
        FROM $production_assign_bom_table
        WHERE $production_assign_bom_table.deleted=0 $where";
        
        return $this->db->query($sql);
    }

    function delete_old_entries($work_order_id, $end_product_id, $bom_id){
        $sql = "DELETE FROM production_assign_bom WHERE bom_id=$bom_id AND work_order_id=$work_order_id AND end_product_id=$end_product_id";

        $this->db->query($sql);

        return TRUE;
    }

    function get_unique_warehouse_list($work_order_id, $end_product_id, $bom_id){
        $sql = "SELECT DISTINCT warehouse_id FROM production_assign_bom WHERE work_order_id=$work_order_id AND end_product_id=$end_product_id AND bom_id=$bom_id";

        return $this->db->query($sql)->result();
    }

}
