

<?php

class TransferModel extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'transfers';
        parent::__construct($this->table);
    }

    function gettransferlist(){
        $sql  = "SELECT * FROM  transfers ";
        return $this->db->query($sql)->result();         

    }
    function deleteTransfer($id){
        $sql     = "DELETE FROM transfers WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }
    
}
?>