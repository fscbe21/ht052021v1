<?php

class  Dep_wise_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'department_wise_salary';
        parent::__construct($this->table);
    }

  function getpayroll($id){

    $sql  = "SELECT * FROM  department_wise_salary  WHERE user_id=$id ";
    return $this->db->query($sql)->row();
        
  }

  function getpayroll_list(){

    $sql  = "SELECT * FROM department_wise_salary";
    return $this->db->query($sql)->result();
        
  }
}
?>