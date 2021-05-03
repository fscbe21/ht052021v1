<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Holidays extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index(){
        $this->template->rander("holidays/index");
    }

    function modal_form(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $id = $this->input->post('id');
        $view_data['info']=$this->Holidays_model->get_one($id);
        $this->load->view('holidays/modal_form', $view_data);
    }

    function list_data() {
        $list_data = $this->Holidays_model->get_details()->result();
         $result = array();
        foreach ($list_data as $data) {
             $result[] = $this->_make_row($data);
         }
         echo json_encode(array("data" => $result));
     }

     function _make_row($data){

        $createdby=$this->Users_model->get_one($data->created_by);
        $row_data = array(
            $data->name,
            $createdby->first_name." ".$createdby->last_name,
            $data->start_date,
            $data->end_date,
            $data->holiday_purpose,
            modal_anchor(get_uri("holidays/modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => 'Edit Holidays', "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => 'Delete Holidays', "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("holidays/delete"), "data-action" => "delete"))
        );
        return $row_data;
     }

     function save(){
        $id=$this->input->post("id");
            $data = array();

            $data['name'] = $this->input->post('name');
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $data['holiday_purpose'] = $this->input->post('holiday_purpose');
            $now = get_current_utc_time();
            if(! $id){
               $data['created_at']=$now ;
               $data['created_by']=$this->login_user->id;              
            }

            $data['updated_at']=$now;

            if($id){
                $save_id=$this->Holidays_model->save($data,$id);
            }
            else{
                $save_id=$this->Holidays_model->save($data);
            }
            

            if ($save_id) {           
               echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_saved')));
           } else {
               echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
           }                  
     }

     function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));


        $id = $this->input->post('id');
        if ($this->input->post('undo')) {
            if ($this->Holidays_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Holidays_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    
}

?>