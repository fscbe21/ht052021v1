<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vechicle_Services extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->access_only_admin();
    }

    function index() {
        $this->template->rander("logistics/services/index");
    }

    function services_modal_form() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));
        $view_data = array();

        $view_data['bunk_data'] = $this->Petrol_bunk_model->get_details()->result();
        $view_data['insurance_cmpdata'] = $this->Insurance_company_model->get_details()->result();
        $view_data['model_info'] = $this->Vechicle_services_model->get_one($this->input->post('id'));
       // $view_data['date_info'] = $this->Insurance_dates_model->get_one($this->input->post('v_number'));
        $this->load->view('logistics/services/services_modal_form', $view_data);
    }

    function services_edit() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));
        $view_data = array();

        $view_data['bunk_data'] = $this->Petrol_bunk_model->get_details()->result();
        $view_data['insurance_cmpdata'] = $this->Insurance_company_model->get_details()->result();
        $view_data['model_info'] = $this->Vechicle_services_model->get_one($this->input->post('id'));
        $this->load->view('logistics/services/services_edit', $view_data);
    }

     function insurance_modal_form() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));
        $view_data = array();

        $view_data['bunk_data'] = $this->Petrol_bunk_model->get_details()->result();
        $view_data['insurance_cmpdata'] = $this->Insurance_company_model->get_details()->result();

        
        $view_data['model_info'] = $this->Vechicle_services_model->get_one($this->input->post('id'));
        $this->load->view('logistics/services/insurance_edit', $view_data);
    }

    function save() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));

       $id = $this->input->post('id');
    $data["service_type"] = $this->input->post('service_type');
    $data["bill_no"] = $this->input->post('bill_no');
    $data["v_number"] = $this->input->post('v_number');
    $data["spm_open_reading"] = $this->input->post('spm_open_reading');
    $data["closing_reading"] = $this->input->post('closing_reading');	
    $data["running_km"] = $this->input->post('running_km');
    $data["driver_name"] = $this->input->post('driver_name');
    $data["petrol_bunk_name"] = $this->input->post('petrol_bunk_name');

    $data["litter"] = $this->input->post('litter');
    $data["price"] = $this->input->post('price');
    $data["amount"] = $this->input->post('amount');
    $data["from"] = $this->input->post('from');
    $data["to"] = $this->input->post('to');	
    $data["km"] = $this->input->post('km');
    $data["company_name"] = $this->input->post('company_name');
    $data["notes"] = $this->input->post('notes');


    $data["typeof_service"] = $this->input->post('typeof_service');
    $data["insurance_company"] = $this->input->post('insurance_company');
    $data["insurance_type"] = $this->input->post('insurance_type');
    $data["insurance_from_date"] = $this->input->post('insurance_from_date');
    $data["insurance_exp_date"] = $this->input->post('insurance_exp_date');
    $data["pay_mode"] = $this->input->post('pay_mode');
    $data["tax_mode"] = $this->input->post('tax_mode');	
    $data["datetime"] = get_my_local_time();
    //$data["service_type"] = $service_types;
    
   
        $save_id = $this->Vechicle_services_model->save($data, $id);
       if($data["service_type"]=="3"){
         
        $ins_date_data["insurance_pay_id"] = $save_id;
        $ins_date_data["v_number"] = $this->input->post('v_number');
        $ins_date_data["insurance_from_date"] = $this->input->post('insurance_from_date');
        $ins_date_data["datetime"] =  get_my_local_time();
        $ins_date_data["insurance_exp_date"] = $this->input->post('insurance_exp_date');
        $this->Insurance_dates_model->save($ins_date_data);

        $insfromdate = $this->input->post('insurance_from_date');
        $instodate   = $this->input->post('insurance_exp_date');
        $vehicle_id  = $this->input->post('v_number');

        $this->Vechicle_model->update_insurance($insfromdate, $instodate, $vehicle_id);


       }






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
                $this->Services_model->save($data, $id);
            }
        }
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "required|numeric"
        ));

        $id = $this->input->post('id');
        $details=array(
                       
            "service_deleted"=>1
        );

        $save_id=$this->Vechicle_services_model->save($details,$id);

        if ($save_id) {           
            echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }    
/*
        if ($this->input->post('undo')) {
            if ($this->Vechicle_services_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Vechicle_services_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }*/
    }

    function insurance_delete() {
        validate_submitted_data(array(
            "id" => "required|numeric"
        ));

        $id = $this->input->post('id');
        $details=array(
                       
            "insurance_deleted"=>1
        );

        $save_id=$this->Vechicle_services_model->save($details,$id);

        if ($save_id) {           
            echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }    
}


    function list_data() {
        $list_data = $this->Vechicle_services_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Vechicle_services_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    private function _make_row($data) {
        $edit = modal_anchor(get_uri("vechicle_services/services_edit"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Details", "data-post-id" => $data->id));

        $delete = js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('edit_service_num'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("vechicle_services/delete"), "data-action" => "delete-confirmation"));
        //R.V22_04_S
        return array(
           // $data->id,
            $data-> v_number,
            $data->	driver_name,  	
            $data->	typeof_service,
            $data->	datetime, 
            $data->	bill_no,
            $data->	amount, 
            


            $edit . $delete
        );    //R.V22_04_E
    } 



    function insurance_list_data() {
        $list_data = $this->Vechicle_services_model->get_insurance_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_insurance_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    private function _insurance_row_data($id) {
        $options = array("id" => $id);
        $data = $this->Vechicle_services_model->get_insurance_details($options)->row();
        return $this->_insurance_make_row($data);
    }

    private function _insurance_make_row($data) {
        $insurance_company_data = $this->Insurance_company_model->get_one($data->insurance_company);
        $edit = modal_anchor(get_uri("vechicle_services/insurance_modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Details", "data-post-id" => $data->id));

        $delete = js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('edit_service_num'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("vechicle_services/insurance_delete"), "data-action" => "delete-confirmation"));
        
        return array(
           // $data->id,
            $data-> v_number,
            $insurance_company_data->title,  	
            $data->	insurance_type,
            "<span style='color: red'>".$data->insurance_exp_date."</span>",
            $data->	bill_no,
            $data->	amount,


            $edit . $delete
        );
    }


}

/* End of file Other_area.php */
/* Location: ./application/controllers/Other_area.php */