<?php

class Dc_outward_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'dc_outward';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {

        $dc_outward_table = $this->db->dbprefix('dc_outward');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $dc_outward_table.id=$id";
        }

        $indent_id = get_array_value($options, "indent_id");
        if ($indent_id) {
            $where .= " AND $dc_outward_table.indent_id=$indent_id";
        }

        $from_warehouse = get_array_value($options, "from_warehouse");
        if ($from_warehouse) {
            $where .= " AND $dc_outward_table.from_warehouse=$from_warehouse";
        }

        $work_order_id = get_array_value($options, "work_order_id");
        if ($work_order_id) {
            $where .= " AND $dc_outward_table.work_order_no=$work_order_id";
        }

        $sql = "SELECT $dc_outward_table.*
        FROM $dc_outward_table
        WHERE $dc_outward_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    /** AG2403 */
    function get_max_id(){
        $sql = "SELECT id FROM dc_outward ORDER BY id desc LIMIT 1";
        return $this->db->query($sql)->row();
    }
}
