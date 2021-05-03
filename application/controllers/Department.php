<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->access_only_admin();
    }

    function index() {
        $this->template->rander("department/index");
    }

    function modal_form() {

        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $view_data['model_info'] = $this->Department_model->get_one($this->input->post('id'));
        $this->load->view('department/modal_form', $view_data);
    }

    function save() {

        $id = $this->input->post('id');
        $data = array(
            "name" => $this->input->post('department_name'),
            "phone" => $this->input->post('department_phone'),
            "email" => $this->input->post('department_email'),
            "address" => $this->input->post('department_address'),
            "updated_at" => get_current_utc_time()
        );
        if($id){
            $save_id = $this->Department_model->save($data, $id);
        }else{
            $data['created_at'] = get_current_utc_time();
            $save_id = $this->Department_model->save($data);
        }
       
        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => lang('record_saved')));
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
            if ($this->Department_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Department_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    function list_data() {
        $list_data = $this->Department_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Department_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    private function _make_row($data) {
        return array(
            $data->name,
            'Phone : '.$data->phone.'<br />Email : '.$data->email,
            $data->address,
            modal_anchor(get_uri("department/modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => lang('edit_department'), "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('delete_department'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("department/delete"), "data-action" => "delete"))
        );
    }

}