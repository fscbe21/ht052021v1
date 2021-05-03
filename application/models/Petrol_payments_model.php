<?php

class Petrol_payments_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'petrol_payments';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $pp_table = $this->db->dbprefix('petrol_payments');
        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $pp_table.id=$id";
        }

        $user_id = get_array_value($options, "user_id");
        if ($user_id) {
            $where .= " AND $pp_table.user_id=$user_id";
        }

        $order = get_array_value($options, "order_by");
        if ($order) {
            $where .= " ORDER BY id DESC";
        }

        $sql = "SELECT $pp_table.*
        FROM $pp_table
        WHERE $pp_table.deleted=0 $where";
        return $this->db->query($sql);

    }

}
