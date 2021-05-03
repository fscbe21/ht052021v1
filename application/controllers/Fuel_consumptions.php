<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fuel_consumptions extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->access_only_admin();
    }

    function index() {
        $this->template->rander("logistics/services/index");
    }

    function modal_form() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));
        $view_data = array();
        $view_data['model_info'] = $this->Fuel_model->get_one($this->input->post('id'));
        $this->load->view('logistics/fuel_consumptions/modal_form', $view_data);
    }


    function edit_modal_form() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));
        $view_data = array();
        //$view_data['model_info'] = $this->Fuel_model->get_one($this->input->post('id'));
        $view_data['bunk_data'] = $this->Petrol_bunk_model->get_details()->result();
        $view_data['insurance_cmpdata'] = $this->Insurance_company_model->get_details()->result();
        $view_data['model_info'] = $this->Vechicle_services_model->get_one($this->input->post('id'));
        $this->load->view('logistics/services/fueledit_modal', $view_data);
    }

    function save() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $id = $this->input->post('id');
        $data["v_number"] = $this->input->post('v_number');
        $data["spm_reading"] = $this->input->post('spm_reading');
        $data["date"] = $this->input->post('date');
        $data["driver_name"] = $this->input->post('driver_name');
        $data["price"] = $this->input->post('price');
        $data["litter"] = $this->input->post('litter');
       

       

        $save_id = $this->Fuel_model->save($data, $id);

        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
    }

    //update the sort value for the fields
    function update_field_sort_values($id = 0) {

        $sort_values = $this->input->post("sort_values");
        if ($sort_values) {

            //extract the values from the comma separated string
            $sort_array = explode(",", $sort_values);


            //update the value in db
            foreach ($sort_array as $value) {
                $sort_item = explode("-", $value); //extract id and sort value

                $id = get_array_value($sort_item, 0);
                $sort = get_array_value($sort_item, 1);

                $data = array("sort" => $sort);
                $this->Fuel_model->save($data, $id);
            }
        }
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "required|numeric"
        ));

        $id = $this->input->post('id');
        $details=array(
                       
            "fuel_deleted"=>1
        );

        $save_id=$this->Vechicle_services_model->save($details,$id);

        if ($save_id) {           
            echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }    
}

   /* function delete() {
        validate_submitted_data(array(
            "id" => "required|numeric"
        ));

        $id = $this->input->post('id');

        if ($this->input->post('undo')) {
            if ($this->Fuel_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Fuel_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }*/

    function list_data() {
        $list_data = $this->Fuel_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Fuel_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    private function _make_row($data) {
        $edit = modal_anchor(get_uri("fuel_consumptions/edit_modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Details", "data-post-id" => $data->id));

        $delete = js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('edit_service_num'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("fuel_consumptions/delete"), "data-action" => "delete-confirmation"));
//R.V22_04
        return array(
           // $data->id,
            $data->v_number,
            $data->driver_name,
            $data->spm_open_reading,
            $data->closing_reading,
            $data->running_km,
            $data->litter,  
            $data->datetime,
            $data->bill_no,
            $data->amount,
           
            $edit . $delete
        );

        //R.V22_04
    }

}

/* End of file Other_area.php */
/* Location: ./application/controllers/Other_area.php */