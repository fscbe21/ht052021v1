<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Set_process extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->access_only_admin();
    }

    function index($id, $ok = 0){

        $view_data = array();

        if($ok){
            $view_data['ok'] = 1;
        }

        $view_data['work_order_id'] = $id;
        $view_data['work_order_info'] = $this->Work_order_model->get_one($id);
        $this->template->rander("production/set_process/index", $view_data);
    }
    
    function list_data($id) {
        $options = array();
        $options['work_order_id'] = $id;
        $list_data = $this->Work_order_details_model->get_details($options)->result();
        $result = array();
        $sl = 1;
        foreach ($list_data as $data) {

            $result[] = $this->_make_row($data, $sl++);
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data, $sl) {
        $product_data = $this->Products_model->get_one($data->product_id);
        $product_name = $product_data->name;
        
        $unit_data    = $this->Unit_model->get_one($product_data->purchase_unit_id);
        $unit_name    = $unit_data->name;

        $product_type_data = $this->Producttype_model->get_one($product_data->type);
        $product_type = $product_type_data->name;

        $check_set_process_data    = array();
        $opt                       = array();
        $opt['work_order_id']      = $data->work_order_id;
        $opt['wo_product_id']      = $data->product_id;
        $check_set_process_data = $this->Set_process_model->get_details($opt)->result();

        return array(
            $sl,
            $data->work_order_id,//dsk 30march2021
            $product_name,
            $product_type,
            $data->qty,
            

            (count($check_set_process_data) == 0) 

            ?
                modal_anchor(get_uri("set_process/modal_form_process"), "Set Process", array("class" => "delete", "title" => "Set Process", "data-post-id" => $data->id, "data-post-woproductid" => $data->product_id, "data-post-workorderid" => $data->work_order_id))
            :
                modal_anchor(get_uri("set_process/modal_form_process"), "<i class='fa fa-eye' aria-hidden='true'></i>", array("class" => "delete", "title" => "Set Process", "data-post-id" => $data->id, "data-post-woproductid" => $data->product_id, "data-post-workorderid" => $data->work_order_id)).' Set Process completed'
        );
    }

    function modal_form_process(){

        $work_order_id = $this->input->post('workorderid'); 
        $wo_product_id = $this->input->post('woproductid'); 

        $data = array();
        $data['work_order_data'] = $work = $this->Work_order_model->get_one($work_order_id);  
        $data["customer_data"] = $this->Clients_model->get_one($data['work_order_data']->customer_id);  
        $data['product_data'] = $productdata = $this->Products_model->get_one($wo_product_id);
        $data['product_type'] =  $this->Producttype_model->get_one($data['product_data']->type);
        $data['unitdata']     = $this->Unit_model->get_one($productdata->purchase_unit_id);
        $data['product_list_data'] = $this->Bom_model->end_product_list()->result();
        $data['wo_product_id'] = $wo_product_id;
        $op = array();
        $op['work_order_id'] = $work_order_id;
        $op['product_id']    = $wo_product_id;
        $data['work_order_detail'] = $this->Work_order_details_model->get_details($op)->result();
        //$data['supplier_list_data'] = $this->Supplier_model->get_details()->result();
        $data['supplier_list_data'] = $this->Vendor_model->get_details()->result();
        $data['process_list_data'] = $this->Process_model->get_details()->result();
        $data['stages_list_data'] = $this->Other_stage_model->get_details()->result();

        if($work->reuse_id != 0){
            $this->load->view('production/reuse/modal_form_view_process', $data);
        }else{
            $this->load->view('production/work_order/modal_form_view_process', $data);
        }

    }

    function save_set_process(){

        $already_found = $this->input->post('already_wo_id');

        if($already_found){

            $delete_wo_id = $this->input->post('already_wo_id');
            $delete_ep_id = $this->input->post('already_ep_id');

            $this->Set_process_model->delete_old_enties($delete_wo_id, $delete_ep_id);
            
            //delete old entries then continue...
        }

        $data = array();
        $data['work_order_id'] = $woid = $this->input->post('work_order_id');
        $data['wo_product_id'] = $this->input->post('wo_product_id');
        $data['no_of_process'] = $this->input->post('no_of_process');

        $product_list       = array();
        $product_list       = $this->input->post('product_field');

        $process_list       = array();
        $process_list       = $this->input->post('process_field');

        $vendor_list        = array();
        $vendor_list        = $this->input->post('vendor_field');

        //$qty_list           = array();
        //$qty_list           = $this->input->post('qty_field');
        
        $stages_list        = array();
        $stages_list        = $this->input->post('stages_field');
        //echo "<pre>";
        for($j = 0; $j < count($product_list); $j++){

            $data['end_product_id']  = $product_list[$j];
            $data['process_id']      = $process_list[$j];
            $data['vendor_id']       = $vendor_list[$j];
            $data['stages']          = $stages_list[$j];         
            
            $this->Set_process_model->save($data);

           
        /* print_r($data); */
        
        }

        //die();

        $wodata = $this->Work_order_model->get_one($woid);
        
        if($wodata->reuse_id != 0){
            redirect("set_process/reuse_index/".$woid."/1");
        }else{
            redirect("set_process/index/".$woid."/1");
        }

    }

    function reuse_index($id, $ok=0){
        $view_data = array();

        if($ok){
            $view_data['ok'] = 1;
        }

        $view_data['work_order_id'] = $id;
        $view_data['work_order_info'] = $this->Work_order_model->get_one($id);
        $this->template->rander("production/reuse/set_process_index", $view_data);
    }

}