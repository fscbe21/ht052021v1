<?php

class Salarypayments_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'salary_payments';
        parent::__construct($this->table);
    }

    function has_salary_detail($userid, $month){
        $sql = "SELECT * FROM salary_payments WHERE `user_id`=$userid AND `payment_month`='$month'";
        return $this->db->query($sql)->result();
    }

    function payments_history($userid){
        $sql = "SELECT * FROM salary_payments WHERE `user_id`=$userid ORDER BY id DESC LIMIT 6";
        return $this->db->query($sql)->result();
    }

    function payments_history_all($userid){
        $sql = "SELECT * FROM salary_payments WHERE `user_id`=$userid";
        return $this->db->query($sql)->result();
    }

}
?>