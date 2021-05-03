<?php

class Vechicle_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'vechicle_details';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $vechicle_table = $this->db->dbprefix('vechicle_details');
        $insurance_date_table = $this->db->dbprefix('insurance_renewdates');
        /*$team_member_job_info_table = $this->db->dbprefix('team_member_job_info');
        $clients_table = $this->db->dbprefix('clients');*/

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $vechicle_table.id=$id";
        }

       /* $sql = "SELECT $vechicle_table.*
        FROM $vechicle_table
        WHERE $vechicle_table.deleted=0";
        return $this->db->query($sql);
        
        WHERE $users_table.deleted=0 $where
        ORDER BY $users_table.first_name"
        */

        $sql = "SELECT $vechicle_table.*
           
        FROM $vechicle_table
       
        LEFT JOIN $insurance_date_table ON $insurance_date_table.v_number=$vechicle_table.v_number";
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


    

}
