<?php

class  Advance_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'advance';
        parent::__construct($this->table);
    }

    function getadvancelist($id){
        $sql  = "SELECT * FROM  advance where client_id=$id";
        return $this->db->query($sql)->result();            
      } 

}
