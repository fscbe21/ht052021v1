<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lead_approval extends MY_Controller {

   function __construct() {
        parent::__construct();

        //check permission to access this module
        $this->init_permission_checker("leaddataapproval");
    }

    /* load leads list view */
    private function show_own_leads_only_user_id() {
        if ($this->login_user->user_type === "staff") {
            return get_array_value($this->login_user->permissions, "lead_data_approval") == "own" ? $this->login_user->id : false;
        }
    }

    function index() {
        $this->check_module_availability("module_lead");
        $data['lead_app']=$this->Lead_approval_model->getlead_approval()->result();
        $this->template->rander('lead_approval/index',$data);
    }
    
   
   
}

