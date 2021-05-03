<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->access_only_admin();
    }

    function index() {
        $this->template->rander("customer/index");
    }

    function modal_form() {

        validate_submitted_data(array(
            "id" => "numeric"
        ));
        
        $view_data['cg_list']    = $this->Customergrp_model->get_all()->result();
        $view_data['model_info'] = $this->Customer_model->get_one($this->input->post('id'));
        $this->load->view('customer/modal_form', $view_data);

    }

    function save() {

        $id = $this->input->post('id');
        $data = array(
            "name" => $this->input->post('customer_name'),
            "email" => $this->input->post('email'),
            "phone_number" => $this->input->post('phone_number'),
            "address" => $this->input->post('address'),
            "city" => $this->input->post('city'),
            "state" => $this->input->post('state'),
            "postal_code" => $this->input->post('pincode'),
            "country" => $this->input->post('country'),
            "cgid" => $this->input->post('cgid'),
            "updated_at" => get_current_utc_time()
        );
        if($id){
            $save_id = $this->Customer_model->save($data, $id);
        }else{
            $data['created_at'] = get_current_utc_time();
            $save_id = $this->Customer_model->save($data);
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
            if ($this->Customer_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Customer_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    function list_data() {
        $list_data = $this->Customer_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Customer_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    private function _make_row($data) {
        return array(
            $data->name,
            'Phone Number : '.$data->phone_number.'<br />Email : '.$data->email,
            $data->address.'<br />'.$data->city.', '.$data->state.'<br />'.$data->country.'-'.$data->postal_code,
            modal_anchor(get_uri("customer/modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => lang('edit_customer'), "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('delete_customer'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("customer/delete"), "data-action" => "delete"))
        );
    }

}