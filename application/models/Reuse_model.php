<?php

class Reuse_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'reuse';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $reuse_table = $this->db->dbprefix('reuse');
        
        $where= "";
        $id=get_array_value($options, "id");

        if($id){
            $where .=" AND $reuse_table.id=$id";
        }
        
        $sql = "SELECT $reuse_table.*
        FROM $reuse_table
        WHERE $reuse_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    //update reuse status

    function update_status($reuse_id,$status){

$sql="UPDATE reuse SET status = '$status' WHERE id = '$reuse_id'";

return $this->db->query($sql);

    }

     //end update reuse status

}
