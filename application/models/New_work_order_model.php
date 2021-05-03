<?php

class  New_work_order_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'client_lead';
        parent::__construct($this->table);
    }

   function get_order($client_id){
    $sql = "SELECT *  FROM  client_lead  WHERE client_id=$client_id";
    return $this->db->query($sql)->num_rows();  
   }

   function get_client_lead($client_id){

    $sql = "SELECT * FROM client_lead WHERE client_id=$client_id";//darini 19-2
    return $this->db->query($sql);

}


}
