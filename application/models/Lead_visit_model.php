<?php

class Lead_visit_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'lead_visit_info';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $lead_visit_table = $this->db->dbprefix('lead_visit_info');

        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $lead_visit_table.id=$id";
        }

        $lead_id = get_array_value($options, "lead_id");
        if ($lead_id) {
            $where = " AND $lead_visit_table.lead_id='$lead_id'";
        }

        $sql = "SELECT $lead_visit_table.*
        FROM $lead_visit_table
        WHERE $lead_visit_table.deleted=0 $where";

        return $this->db->query($sql);
    }


    function get_upcoming_visit_detail(){
        $today = get_my_local_time();
        $owner = $this->login_user->id;

        $where = "WHERE nextmeet >= '".$today."' AND deleted=0 AND is_lead=1 AND lead_status_id != 5"; 
        if(! $this->login_user->is_admin)
        {
            if($this->login_user->role_id == 3){
                $where .= " AND owner_id='".$owner."'";
            }            
        }

        $sql = "SELECT * FROM clients ".$where." ORDER BY followup_date, time ASC";

        return $this->db->query($sql)->result();
    }

    function get_pending_visit_detail(){
        $today = get_my_local_time();
        $time  = date('H:i:s');
        $owner = $this->login_user->id;
        $where = "WHERE nextmeet < '".$today."' AND deleted=0 AND is_lead=1 AND lead_status_id != 5";

        if(! $this->login_user->is_admin)
        {
            if($this->login_user->role_id == 3){
                $where .= " AND owner_id='".$owner."'";
            }            
        }

        $sql = "SELECT * FROM clients ".$where." ORDER BY followup_date, time ASC";

        return $this->db->query($sql)->result();
    }

    function get_discussion_visit_detail(){
        $today = date('Y-m-d');
        $owner = $this->login_user->id;
        $where = "WHERE lead_status_id IN (1,2,3) AND deleted=0 AND is_lead=1";
        
        if(! $this->login_user->is_admin)
        {
            if($this->login_user->role_id == 3){
                $where .= " AND owner_id='".$owner."'";
            }            
        }

        $sql = "SELECT *FROM clients ".$where;

        return $this->db->query($sql)->result();
    }

    function get_negotiation_visit_detail(){
        $today = date('Y-m-d');
        $owner = $this->login_user->id;
        $where = "WHERE lead_status_id IN (4) AND deleted=0 AND is_lead=1";
        
        if(! $this->login_user->is_admin)
        {
            if($this->login_user->role_id == 3){
                $where .= " AND owner_id='".$owner."'";
            }            
        }

        $sql = "SELECT * FROM clients ".$where;
                
        return $this->db->query($sql)->result();
    }

    function get_won_visit_detail(){
        $today = date('Y-m-d');
        $owner = $this->login_user->id;
        $where = "WHERE lead_status_id IN (5) AND deleted=0 AND is_lead=1";
        
        if(! $this->login_user->is_admin)
        {
            if($this->login_user->role_id == 3){
                $where .= " AND owner_id='".$owner."'";
            }            
        }

        $sql = "SELECT * FROM clients ".$where;                

        return $this->db->query($sql)->result();
    }

    function before_transfer_info($owner_id="", $lead_id=""){

        $sql  = "SELECT * FROM lead_visit_info WHERE lead_id=".$lead_id;
        $sql .= " AND owner_id != ".$owner_id." order by id desc limit 1";

        return $this->db->query($sql)->result();
    }
}

