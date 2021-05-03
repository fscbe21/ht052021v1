<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logistics extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->access_only_admin();
    }

    function index() {
        $this->template->rander("logistics/vechile/index");
    }

    function modal_form() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));
        $view_data = array();
        $view_data['model_info'] = $this->Vechicle_model->get_one($this->input->post('id'));
        $this->load->view('logistics/vechile/modal_form', $view_data);
    }


    function vechicle_modal_form() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));
        $view_data = array();
        $view_data['model_info'] = $this->Vechicle_model->get_one($this->input->post('id'));
        $view_data['date_info'] = $this->Vechicle_model->get_one($this->input->post('v_number'));
        $view_data['insurance_cmpdata'] = $this->Insurance_company_model->get_details()->result();
        $this->load->view('logistics/vechile/vechicle_modal_form', $view_data);
    }

    function save() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $id = $this->input->post('id');
        $data["number"] = $this->input->post('number');

        if (!$id) {
            //get sort value
            $max_sort_value = $this->Vechicle_model->get_max_sort_value();
            $data["sort"] = $max_sort_value * 1 + 1; //increase sort value
        }

        $save_id = $this->Vechicle_model->save($data, $id);

        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
    }



    function vechiclesave() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $id = $this->input->post('id');
        $data["v_number"] = $this->input->post('v_number');
        $data["v_model"] = $this->input->post('v_model');
        $data["v_name"] = $this->input->post('v_name');
        
        //$data["driver_name"] = $this->input->post('driver_name');
        $data["spm_open_reading"] = $this->input->post('spm_open_reading');
        $data["engine_number"] = $this->input->post('engine_number');
        $data["chassis_number"] = $this->input->post('chassis_number');


        $data["fc_from_date"] = $this->input->post('fc_from_date');
        $data["fc_to_date"] = $this->input->post('fc_to_date');
        $data["insurance_id"] = $this->input->post('insurance_id');
        $data["insurance_f_date"] = $this->input->post('insurance_f_date');
        $data["	insurance_t_date"] = $this->input->post('insurance_t_date');
        $data["insurance_value"] = $this->input->post('insurance_value');
        $data["insurance_cname"] = $this->input->post('insurance_cname');


        /*if (!$id) {
            //get sort value
            $max_sort_value = $this->Vechicle_model->get_max_sort_value();
            $data["sort"] = $max_sort_value * 1 + 1; //increase sort value
        }*/

        $save_id = $this->Vechicle_model->save($data, $id);

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
                $this->Vechicle_model->save($data, $id);
            }
        }
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "required|numeric"
        ));

        $id = $this->input->post('id');

        if ($this->input->post('undo')) {
            if ($this->Vechicle_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Vechicle_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    function list_data() {
        $list_data = $this->Vechicle_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Vechicle_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    private function _make_row($data) {
        $edit = modal_anchor(get_uri("logistics/vechicle_modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Vehicle Details", "data-post-id" => $data->id));

        $delete = js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('vechicle_num'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("logistics/delete"), "data-action" => "delete-confirmation"));

        return array(
           // $data->sort,
            $data->id,
           
            $data->v_number,
            $data->v_model,
            $data->v_name,
            "<span style='color: red'>".$data->insurance_t_date."</span>",
            $edit . $delete
        );
    }

}

/* End of file Other_area.php */
/* Location: ./application/controllers/Other_area.php */