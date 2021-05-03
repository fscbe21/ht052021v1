<?php

class Salarypaymentdetails_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'salary_payment_details';
        parent::__construct($this->table);
    }

    function get_salary_detail($id){
        $sql = "SELECT * FROM salary_payment_details WHERE `salary_payment_id`=$id";
        return $this->db->query($sql)->result();
    }

}
?>