<?php

class Dc_outward_details_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'dc_outward_details';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {

        $dc_outward_details_table = $this->db->dbprefix('dc_outward_details');
        $where = "";

        
        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $dc_outward_details_table.id=$id";
        }

        $outward_id = get_array_value($options, "outward_id");
        if ($outward_id) {
            $where .= " AND $dc_outward_details_table.dc_outward_id=$outward_id";
        }
        
        $sql = "SELECT $dc_outward_details_table.*
        FROM $dc_outward_details_table
        WHERE $dc_outward_details_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function deleteEntry($id){
        $sql     = "DELETE FROM dc_outward_details WHERE id=$id";
        $this->db->query($sql);

        return TRUE;
    }

    

}
