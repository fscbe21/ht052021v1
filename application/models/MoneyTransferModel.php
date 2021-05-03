

<?php

class MoneyTransferModel extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'money_transfer';
        parent::__construct($this->table);
    }
    function get_money_transfer_list(){
        $sql  = "SELECT * FROM  money_transfer ";
        return $this->db->query($sql)->result();            
      }
     function deleteone($id){

        $sql  = "DELETE FROM `money_transfer` WHERE `id`=$id ";
        return $this->db->query($sql);   
          
     }
}
?>