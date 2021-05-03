<?php

class Deduction_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'deduction';
        parent::__construct($this->table);
    }

    function get_all_deduction()
    { 
        $sql  = "SELECT * FROM deduction WHERE deletion_status = 0 ORDER BY id DESC";
        return $this->db->query($sql)->result();
    }

    function get_user_data($id){
        $sql  = "SELECT * FROM users WHERE id = $id";
        return $this->db->query($sql)->result();
    }

    function get_one_deduction($id){
        $sql  = "SELECT * FROM deduction WHERE id = $id";
        return $this->db->query($sql)->result();
    }

    function delete_deduction($id) {
        $sql  = "UPDATE deduction SET deletion_status = 1 WHERE id = $id";
        return $this->db->query($sql);
    }

}
