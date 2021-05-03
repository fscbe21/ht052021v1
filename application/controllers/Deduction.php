<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deduction extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->init_permission_checker("message_permission");
    }

    function index(){
        
        $this->template->rander("salary/deduction/deduction_list");
    }

    function modal_form(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $view_data['employee_list']=$this->Users_model->active_member();
        $this->load->view('salary/deduction/modal_form', $view_data);
    }

    function modal_form_update($id){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $deduction_data   = $this->Deduction_model->get_one_deduction($id);

        foreach($deduction_data as $deduction){
            $view_data['deduction_name'] = $deduction->deduction_name;
            $view_data['deduction_amount'] = $deduction->deduction_amount;
            $view_data['deduction_purpose'] = $deduction->deduction_description;
            $view_data['deduction_userid'] = $deduction->user_id;
            $view_data['deduction_month'] = $deduction->deduction_month;
        }

        $view_data['deduction_id'] = $id;

        $view_data['employee_list']= $this->Users_model->active_member();  
        $this->load->view('salary/deduction/modal_form', $view_data);
    }

     function save(){

        $data = array(
            "user_id" => $this->input->post('user_id'),
            "deduction_name" => $this->input->post('deduction_name'),
            "deduction_month" => $this->input->post('deduction_month'),
            "deduction_amount" => $this->input->post('deduction_amount'),
            "deduction_description" => $this->input->post('deduction_purpose')        
        );

        $deduction_id = $this->input->post('id');

        if($deduction_id != ''){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $save_id = $this->Deduction_model->save($data, $deduction_id);
        }
        else{
            $data['created_by'] = $this->login_user->id;
            $data['created_at'] = date('Y-m-d h:i:s');
            $save_id = $this->Deduction_model->save($data);
        }

        if ($save_id) 
        {
            echo json_encode(array("success" => true, 'id' => $save_id, 'view' => $this->input->post('view'), 'message' => lang('record_saved')));
        } 
        else 
        {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
     }

     function list_data() {

        $list_data = $this->Deduction_model->get_all_deduction();
    
        $result = array();
        $sl = 1;
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $sl++);
        }
    
        echo json_encode(array("data" => $result));
    }
    
    function _make_row($data, $sl) {
    
            $employee    =  $this->Bonus_model->get_user_data($data->user_id);
            foreach($employee as $emp){
                $empname = $emp->first_name.' '.$emp->last_name;
                $empdesg = $emp->job_title;
            }
    
            $row_data = array(
                $sl,
                $empname,
                $empdesg,
                $data->deduction_name,
                $data->deduction_month,
                $data->deduction_amount,
                $data->created_at
            );
    
            $row_data[] = modal_anchor(get_uri("deduction/modal_form_update/".$data->id), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Deduction", "data-post-id" => $data->id))
                    . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => 'Delete Deduction', "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("deduction/delete/".$data->id), "data-action" => "delete-confirmation"));
    
            return $row_data;
        }
    
        function delete($id){
    
            if ($this->Deduction_model->delete_deduction($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
}

?>