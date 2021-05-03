<?php

class Indent_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'indent';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $indent_table = $this->db->dbprefix('indent');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $indent_table.id=$id";
        }

        $work_order_id = get_array_value($options, "work_order_id");
        if ($work_order_id) {
            $where .= " AND $indent_table.work_order_id=$work_order_id";
        }

        $end_product_id = get_array_value($options, "end_product_id");
        if ($end_product_id) {
            $where .= " AND $indent_table.end_product_id=$end_product_id";
        }

        $bom_id = get_array_value($options, "bom_id");
        if ($bom_id) {
            $where .= " AND $indent_table.bom_id=$bom_id";
        }

        $sql = "SELECT $indent_table.*
        FROM $indent_table
        WHERE $indent_table.deleted=0 $where ORDER BY id DESC";
        return $this->db->query($sql);
    }
    

}
