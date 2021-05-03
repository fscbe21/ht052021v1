<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Machine_attendance extends MY_Controller {

    function __construct() {
        parent::__construct();
      
    }

    function import_attendance(){
        
        $this->template->rander("machine_attendance/import_attendance");
    }

    function list_data() {
         $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("leads", $this->login_user->is_admin, $this->login_user->user_type);
         $options = array(                       
             "custom_fields" => $custom_fields
         );
 
         //$list_data = $this->New_work_order_model->get_client_lead()->result();
         $result = array();
        /* foreach ($list_data as $data) {
             $result[] = $this->_make_row($data, $custom_fields);
         }*/
         echo json_encode(array("data" => $result));
     }

     function attendance_manage(){
        
        $this->template->rander("machine_attendance/attendance_mange");
    }
   
    function list_data_attendance() {
        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("leads", $this->login_user->is_admin, $this->login_user->user_type);
        $options = array(                       
            "custom_fields" => $custom_fields
        );

        //$list_data = $this->New_work_order_model->get_client_lead()->result();
        $result = array();
       /* foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $custom_fields);
        }*/
        echo json_encode(array("data" => $result));
    }
    function attendance_report(){
        $view_data['employee_list']=$this->Users_model->active_member();
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $this->template->rander("machine_attendance/attendance_report",$view_data);
    }

    
    function list_data_attendance_report() {
        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("leads", $this->login_user->is_admin, $this->login_user->user_type);
        $options = array(                       
            "custom_fields" => $custom_fields
        );

        //$list_data = $this->New_work_order_model->get_client_lead()->result();
        $result = array();
       /* foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $custom_fields);
        }*/
        echo json_encode(array("data" => $result));
    }
}

?>