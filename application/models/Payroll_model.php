<?php

class  Payroll_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'payroll';
        parent::__construct($this->table);
    }

  function getpayroll($id){

    $sql  = "SELECT * FROM  payroll  WHERE user_id=$id ";
    return $this->db->query($sql)->row();
        
  }

  function getpayroll_list(){

    $sql  = "SELECT * FROM payroll";
    return $this->db->query($sql)->result();
        
  }
}
?>