<?php
/* AG20-03-2021 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assignbom extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->access_only_admin();
    }

    function index($woid) {

        $view_data                      = array();
        $view_data['woid']              = $woid;
        $view_data['detail']  = $details = $this->Work_order_model->get_one($woid);
        $view_data['cdetail'] = $this->Clients_model->get_one($details->customer_id);

        if($details->reuse_id != 0){
            $this->template->rander("production/reuse/assignbom_index", $view_data);
        }else{
            $this->template->rander("production/assignbom/index", $view_data);
        }
    }

    function list_data($woid) {
        $options = array();
        $options['work_order_id'] = $woid;

        $list_data = $this->Set_process_model->get_details($options)->result();

        $result = array();
        
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {

        $option = array();
        $option['work_order_id'] = $data->work_order_id;
        $option['product_id']    = $data->wo_product_id;

        $wodetails    = array();
        $wodetails    = $this->Work_order_details_model->get_details($option)->result();

        $bom_array    = $this->Bom_model->get_details()->result();

        $product_data = $this->Products_model->get_one($data->end_product_id);
        $product_name = $product_data->name;
        $unit_id      = $product_data->unit_id;

        $process_data = $this->Process_model->get_one($data->process_id);
        $process_name = $process_data->title;

        $vendor_data  = $this->Supplier_model->get_one($data->vendor_id);
        $vendor_name  = $vendor_data->name;
 
        return array(
            $product_name,
            $process_name,
            $vendor_name,
            $wodetails[0]->qty,
            $data->stages,

            (1) ?
            
            modal_anchor(get_uri("assignbom/modal_form"), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View & Assign BOM", "data-post-endproductid" => $data->end_product_id, "data-post-workorderid" => $data->work_order_id,"data-post-woproductid" => $data->wo_product_id, "data-post-qty" => $wodetails[0]->qty))

            : 
            
            "Bom Not found."
        );
    }

    function modal_form() {

        $view_data                      = array();
        $view_data['bomid']             = $this->input->post('bomid');
        $view_data['work_order_id']     = $this->input->post('workorderid');
        $view_data['wo_product_id']     = $this->input->post('woproductid');
        $view_data['wop_qty']           = $this->input->post('qty');
        $view_data['end_product_id']    = $this->input->post('endproductid');

        $options  = array();
        $options['work_order_id']       = $this->input->post('workorderid');
        $options['wo_product_id']       = $this->input->post('woproductid');
        $view_data['set_process_data']  = $this->Set_process_model->get_details($options)->result();

        $wodata = array();
        $wodata = $this->Work_order_model->get_one($this->input->post('workorderid'));

        if($wodata->reuse_id != 0){
            $this->load->view('production/reuse/assignbom_modal_form', $view_data);
        }else{
            $this->load->view('production/assignbom/modal_form', $view_data);
        }
    }

    function save_assign_bom(){
       $work_order_id   = $this->input->post('work_order_id');
       $end_product_id  = $this->input->post('end_product_id');
       $bom_id          = $this->input->post('bom_id');
       $wo_product_id   = $this->input->post('wo_product_id');

       $assignbomdata = array();
       $options = array();
       $options['bom_id']          = $bom_id;
       $options['work_order_id']   = $work_order_id;
       $options['wo_product_id']   = $wo_product_id;
       $options['end_product_id']  = $end_product_id;

       $assignbomdata = $this->Assignbom_model->get_details($options)->result();
       if(count($assignbomdata) > 0){
          $this->Assignbom_model->delete_old_entries($work_order_id, $end_product_id, $bom_id);
       }

       $product_id      = array();
       $qty             = array();
       $warehouse_id    = array();
       $weight          = array();
       $wastage         = array();

       $product_id      = $this->input->post('product_id');
       $qty             = $this->input->post('qty');
       $warehouse_id    = $this->input->post('warehouse_id');
       $weight          = $this->input->post('weight');
       $wastage         = $this->input->post('wastage'); 

       for($i=0; $i < count($product_id); $i++){
           $data = array();

           $data['work_order_id']   = $work_order_id;
           $data['end_product_id']  = $end_product_id;
           $data['wo_product_id']   = $wo_product_id;
           $data['bom_id']          = $bom_id;
           
           $data['product_id']      = $product_id[$i];
           $data['qty']             = $qty[$i];
           $data['warehouse_id']    = $warehouse_id[$i];
           $data['weight']          = $weight[$i];
           $data['wastage']         = $wastage[$i];

           $this->Assignbom_model->save($data);
       }

       redirect("assignbom/index/".$work_order_id);
       
    }

    function set_stages($work_order_id){
        $view_data                      = array();
        $view_data['work_order_data']   = $data =  $this->Work_order_model->get_one($work_order_id);

        if($data->reuse_id != 0){
            $this->template->rander("production/reuse/assignbom_set_stages", $view_data);
        }else{
            $this->template->rander("production/assignbom/set_stages", $view_data);
        }
    }

    function save_set_stages(){
        $data = array();
        $data['work_order_id'] = $this->input->post('work_order_id');

        $end_product_id = array();
        $end_product_id = $this->input->post('end_product_id');

        $wo_product_id  = array();
        $wo_product_id  = $this->input->post('wo_product_id');

        $process_id     = array();
        $process_id     = $this->input->post('process_id');

        $stage          = array();
        $stage          = $this->input->post('stage');

        $stage_name     = array();
        $stage_name     = $this->input->post('stage_name');

        for($i=0; $i < count($end_product_id); $i++){
            $data['wo_product_id']  = $wo_product_id[$i];
            $data['end_product_id'] = $end_product_id[$i];
            $data['process_id']     = $process_id[$i];
            $data['stage']          = $stage[$i];
            $data['stage_name']     = $stage_name[$i];

            $ok = $this->Set_stages_model->deleteEntries($data['work_order_id'], $data['wo_product_id'], $data['process_id'], $data['stage']);

            if($ok){
                $this->Set_stages_model->save($data);
            }
        }

        redirect("viewproduction");
    }

    function insert_materials($work_order_id, $work_order_product_id, $bom_id){
        $option1 = array();
        $option1['work_order_id'] = $work_order_id;
        $option1['product_id']    = $work_order_product_id;

        $work_order_details = array();
        $work_order_details = $this->Work_order_details_model->get_details($option1)->result();

        $wo_qty = $work_order_details[0]->qty;

        $bom_materials_data = array();
        $option2 = array();
        $option2['bom_id'] = $bom_id;
        $bom_materials_data = $this->Bomdetail_model->get_details($option2)->result();


        


    }

}