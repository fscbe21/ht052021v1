<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->access_only_admin();
    }

    function index() {
        $view_data['employee_list'] = $this->Users_model->get_details()->result();
        $view_data["team_members_dropdown"] = $this->get_team_members_dropdown(true);
        $view_data['search'] = 0;
        $this->template->rander("logs/index", $view_data);
    }

    
    function list_data() {

        $options = array(
            "user_id" => $this->input->post("employee"),
            "login_time" => $this->input->post("start_date")
        );
        $list_data = $this->Logs_model->get_details($options)->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));

    }

    private function _make_row($data) {
        $empdata = $this->Users_model->get_one($data->user_id);
        if($data->logout_time){
            $datetime1 = new DateTime($data->login_time);
            $datetime2 = new DateTime($data->logout_time);
            $interval = $datetime1->diff($datetime2);
            $elapsed = $interval->format('%h hours %i minutes %s seconds');
            $duration =  $elapsed;
        }else{
            $datetime1 = new DateTime($data->login_time);
            $datetime2 = new DateTime(get_my_local_time());
            $interval = $datetime1->diff($datetime2);
            $elapsed = $interval->format('%h hours %i minutes %s seconds');
            $duration =  $elapsed;
        }
        
        return array(
            $empdata->first_name.' '.$empdata->last_name,
            $data->login_time,
            $data->logout_time ? $data->logout_time : '<span class="text-danger">No Logout time found.</span>',
            $data->ip_address == '::1' ? 'Localhost' : $data->ip_address,
            $duration          
        );
    }

}