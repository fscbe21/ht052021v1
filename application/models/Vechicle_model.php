<?php

class Vechicle_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'vechicle_details';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $vechicle_table = $this->db->dbprefix('vechicle_details');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $vechicle_table.id=$id";
        }

        $statusline = " $vechicle_table.deleted=0";

        $status = get_array_value($options, "status");
        if ($status == "inactive") {
            $statusline = " $vechicle_table.deleted=1";
        }

        $sql = "SELECT $vechicle_table.*
        FROM $vechicle_table
        WHERE $statusline $where";
        return $this->db->query($sql);
    }

    function get_max_sort_value() {
        $vechicle_table = $this->db->dbprefix('vechicle_details');

        $sql = "SELECT MAX($vechicle_table.sort) as sort
        FROM $vechicle_table
        WHERE $vechicle_table.deleted=0";
        $result = $this->db->query($sql);
        if ($result->num_rows()) {
            return $result->row()->sort;
        } else {
            return 0;
        }
    }


    function search_vechicles($search){
        $sql = "SELECT * FROM vechicle_details WHERE (v_number LIKE '%".$search."%')";
        return $this->db->query($sql);

    }

    function update_insurance($insfromdate, $instodate, $vehicle_id){

        $sql = "UPDATE vechicle_details 
                SET 
                insurance_f_date = '$insfromdate',
                insurance_t_date = '$instodate'
                WHERE 
                v_number = '$vehicle_id'";
                
        return $this->db->query($sql);
    }

    function report_insurance($options = array()){
        $vehicle_table = $this->db->dbprefix('vechicle_details');

        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $vehicle_table.id=$id";
        }

        $from_date = get_array_value($options, "from_date");
        if ($from_date) {
            $where .= " AND $vehicle_table.insurance_t_date >= '$from_date'";
        }

        $to_date = get_array_value($options, "to_date");
        if ($to_date) {
            $where .= " AND $vehicle_table.insurance_t_date <= '$to_date'";
        }

        $sql = "SELECT $vehicle_table.*
        FROM $vehicle_table
        WHERE $vehicle_table.deleted=0 $where ORDER BY DATE(insurance_t_date) ASC";
        return $this->db->query($sql);

    }

    function undo_delete($id){
        $sql = "UPDATE vechicle_details SET deleted=0 WHERE id=$id";
        return $this->db->query($sql);
    }


    

}
