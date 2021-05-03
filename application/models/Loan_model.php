<?php

class Loan_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'loan';
        parent::__construct($this->table);
    }

    function get_all_loan()
    { 
        $sql  = "SELECT * FROM loan WHERE deletion_status = 0 ORDER BY id DESC";
        return $this->db->query($sql)->result();
    }

    function get_user_data($id){
        $sql  = "SELECT * FROM users WHERE id = $id";
        return $this->db->query($sql)->result();
    }

    function get_one_loan($id){
        $sql  = "SELECT * FROM loan WHERE id = $id";
        return $this->db->query($sql)->result();
    }

    function delete_loan($id) {
        $sql  = "UPDATE loan SET deletion_status = 1 WHERE id = $id";
        return $this->db->query($sql);
    }

    function get_details($options = array()) {
        $loan_table = $this->db->dbprefix('loan');
        $where = "";

        $user_id = get_array_value($options, "user_id");
        if ($user_id) {
            $where = " AND $loan_table.user_id=$id";
        }

        $sql = "SELECT $loan_table.*
        FROM $loan_table
        WHERE $loan_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function get_latest_loan($user_id){
        $sql  = "SELECT * FROM loan WHERE user_id = $user_id";
        return $this->db->query($sql)->result();
    }

    function decrease_emi($user_id){
        $sql  = "UPDATE loan SET remaining_installments = (remaining_installments - 1) WHERE user_id = $user_id ORDER BY id DESC LIMIT 1";
        return $this->db->query($sql);
    }

}
