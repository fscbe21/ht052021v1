

<?php

class ReturnModel extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'returns';
        parent::__construct($this->table);
    }
    
    function return_list(){
        $sql  = "SELECT * FROM  `returns` ";
        return $this->db->query($sql)->result();         

    }

    function deleteSalesReturn($id){
        $sql     = "DELETE FROM  `returns` WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }
}
?>