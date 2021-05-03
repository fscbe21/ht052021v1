<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class  Loan extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index(){
        
        $this->template->rander("salary/loan/loan_manage");
    }

    function modal_form(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $view_data['employee_list']=$this->Users_model->active_member();
        $this->load->view('salary/loan/modal_form', $view_data);
    }

    function modal_form_update($id){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $loan_data   = $this->Loan_model->get_one_loan($id);

        foreach($loan_data as $loan){
            $view_data['loan_name'] = $loan->loan_name;
            $view_data['loan_amount'] = $loan->loan_amount;
            $view_data['loan_desc'] = $loan->loan_description;
            $view_data['loan_userid'] = $loan->user_id;
            $view_data['number_of_emi'] = $loan->number_of_installments;
        }

        $view_data['loan_id'] = $id;

        $view_data['employee_list']= $this->Users_model->active_member();  
        $this->load->view('salary/loan/modal_form', $view_data);
    }

     function save(){

        $data = array(
            "user_id" => $this->input->post('user_id'),
            "loan_name" => $this->input->post('loan_name'),
            "number_of_installments" => $this->input->post('number_of_emi'),
            "remaining_installments" => $this->input->post('number_of_emi'),
            "loan_amount" => $this->input->post('loan_amount'),
            "loan_description" => $this->input->post('descrpition')        
        );

        $loan_id = $this->input->post('id');

        if($loan_id != ''){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $save_id = $this->Loan_model->save($data, $loan_id);
        }
        else{
            $data['created_by'] = $this->login_user->id;
            $data['created_at'] = date('Y-m-d h:i:s');
            $save_id = $this->Loan_model->save($data);
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

        $list_data = $this->Loan_model->get_all_loan();
    
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
                $data->loan_name,
                $data->loan_amount,
                $data->number_of_installments,
                $data->remaining_installments,
                $data->created_at
            );
    
            $row_data[] = modal_anchor(get_uri("loan/modal_form_update/".$data->id), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Loan", "data-post-id" => $data->id))
                    . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => 'Delete Loan', "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("loan/delete/".$data->id), "data-action" => "delete-confirmation"));
    
            return $row_data;
        }
    
        function delete($id){
    
            if ($this->Loan_model->delete_loan($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
}

?>