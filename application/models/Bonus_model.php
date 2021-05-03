<?php

class Bonus_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'bonus';
        parent::__construct($this->table);
    }

    function get_all_bonus()
    { 
        $sql  = "SELECT * FROM bonus WHERE deletion_status = 0 ORDER BY id DESC";
        return $this->db->query($sql)->result();
    }

    function get_user_data($id){
        $sql  = "SELECT * FROM users WHERE id = $id";
        return $this->db->query($sql)->result();
    }

    function get_one_bonus($id){
        $sql  = "SELECT * FROM bonus WHERE id = $id";
        return $this->db->query($sql)->result();
    }

    function delete_bonus($id) {
        $sql  = "UPDATE bonus SET deletion_status = 1 WHERE id = $id";
        return $this->db->query($sql);
    }

}
