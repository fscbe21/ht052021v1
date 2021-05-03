<?php

class Noc_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'noc';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $noc_table = $this->db->dbprefix('noc');
        $users_table = $this->db->dbprefix('users');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $noc_table.id=$id";
        }

       /* $sql = "SELECT $noc_table.*
        FROM $noc_table
        WHERE $noc_table.deleted=0";
        return $this->db->query($sql);*/

 $sql = "SELECT $noc_table.*,  CONCAT($users_table.first_name, ' ',$users_table.last_name) AS created_by_user, $users_table.image as created_by_avatar, $users_table.id as employee, $users_table.job_title as user_job_title
        FROM $noc_table
        LEFT JOIN $users_table ON $users_table.id = $noc_table.employee
        WHERE $noc_table.deleted=0 AND $noc_table.type=1";
        return $this->db->query($sql);



    }



    function get_details_info($id = 0) {
        $noc_table = $this->db->dbprefix('noc');
        $users_table = $this->db->dbprefix('users');
       
        $sql =  "SELECT $noc_table.*,  CONCAT($users_table.first_name, ' ',$users_table.last_name) AS applicant_name, $users_table.image as created_by_avatar, $users_table.id as employee, $users_table.job_title as user_job_title
        FROM $noc_table
        LEFT JOIN $users_table ON $users_table.id = $noc_table.employee
        WHERE $noc_table.deleted=0 AND $noc_table.type=1";
        
        return $this->db->query($sql)->row();
    }



   

   

}
