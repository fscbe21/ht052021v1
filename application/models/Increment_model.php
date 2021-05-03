<?php

class  Increment_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'increment';
        parent::__construct($this->table);
    }

    function get_increment_list(){

        $sql  = "SELECT * FROM  increment";
        return $this->db->query($sql)->result();
            
      }
}
?>