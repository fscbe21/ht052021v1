
<?php

class Payment_cheque  extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'payment_with_cheque';
        parent::__construct($this->table);
    }

    public function getPaymentdetails($id){
        $sql  = "SELECT * FROM `payment_with_cheque` WHERE `payment_id` =$id  ";
        return $this->db->query($sql)->result();     
        
    }


    function deletepaymentCheque($id){
        $sql     = "DELETE FROM payment_with_cheque WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }

}
