<?php
/*AG*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class  Bonus extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index(){
        
        $this->template->rander("salary/bonus/bonus_list");
    }

    function modal_form(){
          $view_data['label_column'] = "col-md-3";
          $view_data['field_column'] = "col-md-9";
          $view_data['employee_list']=$this->Empgroup_model->get_details()->result();  
          $this->load->view('salary/bonus/modal_form', $view_data);
    }

    function modal_form_update($id){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $bonus_data   = $this->Bonus_model->get_one_bonus($id);

        foreach($bonus_data as $bonus){
            $view_data['bonus_name'] = $bonus->bonus_name;
            $view_data['bonus_percentage'] = $bonus->bonus_percentage;
            $view_data['bonus_purpose'] = $bonus->bonus_description;
            $view_data['bonus_group_id'] = $bonus->bonus_group_id;
            $view_data['bonus_month'] = $bonus->bonus_month;
        }

        $view_data['bonus_id'] = $id;

        $view_data['employee_list']= $this->Empgroup_model->get_details()->result();  
        $this->load->view('salary/bonus/modal_form', $view_data);
    }

    function list_data1() {

         $list_data = $this->Bonus_model->get_all()->result();
         $result = array();
         $si = 1;
         foreach ($list_data as $data) {
             $result[] = $si;
             $result[] = $data->user_id;
             $result[] = $data->user_group_id;
             $result[] = $data->bonus_name;
             $result[] = $data->bonus_month;
             $result[] = $data->bonus_percentage;
             $result[] = $data->created_at;
             $result[] = $data->user_group_id;
             $si += 1;
         }

         echo json_encode(array("data" => $result));
     }

/* AG2402 - START */
     function save(){

        $data = array(
            "bonus_group_id" => $this->input->post('bonus_group_id'),
            "bonus_name" => $this->input->post('bonus_name'),
            "bonus_month" => $this->input->post('bonus_month'),
            "bonus_percentage" => $this->input->post('bonus_percentage'),
            "bonus_description" => $this->input->post('bonus_purpose')        
        );

        $bonus_id = $this->input->post('id');

        if($bonus_id != ''){
            $data['updated_at'] = date('Y-m-d h:i:s');
            $save_id = $this->Bonus_model->save($data, $bonus_id);
        }
        else{
            $data['created_by'] = $this->login_user->id;
            $data['created_at'] = date('Y-m-d h:i:s');
            $save_id = $this->Bonus_model->save($data);
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

    $list_data = $this->Bonus_model->get_all_bonus();

    $result = array();
    $sl = 1;
    foreach ($list_data as $data) {
        $result[] = $this->_make_row($data, $sl++);
    }

    echo json_encode(array("data" => $result));
}

function _make_row($data, $sl) {

        $employee    =  $this->Empgroup_model->get_one($data->bonus_group_id);

        $empname = $employee->name;
       
        $row_data = array(
            $sl,
            $empname,
            $data->bonus_name,
            $data->bonus_month,
            $data->bonus_percentage,
            $data->created_at
        );

        $row_data[] = modal_anchor(get_uri("bonus/modal_form_update/".$data->id), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Bonus", "data-post-id" => $data->id))
        . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => 'Delete Bonus', "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("bonus/delete/".$data->id), "data-action" => "delete-confirmation"));

        return $row_data;
    }

    function delete($id){

        if ($this->Bonus_model->delete_bonus($id)) {
            echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }
    }
}

/* AG2402 - END */

?>