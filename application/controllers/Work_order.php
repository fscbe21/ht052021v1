<?php
/* AG10032021 - INITIAL CREATION */

use Firebase\JWT\JWT;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Work_order extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->access_only_admin();
    }

    function index() {
        $this->template->rander("production/work_order/index");
    }

    function create($reuse_id=0) {
        $view_data = array();
        $view_data['end_product_list'] = $this->Bom_model->end_product_list()->result();
         //R.V start13_03s
        $view_data['clients_dropdown'] = $this->Clients_model->get_dropdown_list(array("company_name"), "id", array("is_lead" => 0));
         //R.V start13_03E
        if($reuse_id){
            $view_data['reuse_id'] = $reuse_id;
            $reuse_data = array();
            $reuse_data = $this->Reuse_model->get_one($reuse_id);
            $view_data['reuse_data']      = $reuse_data;
            $view_data['work_order_data'] = $this->Work_order_model->get_one($reuse_data->work_order_id);
            $this->template->rander("production/reuse/wo_create", $view_data);
        }else{
            $this->template->rander("production/work_order/create", $view_data);
        }
    }

    function search($search_text, $endproductid){

        $endproductid = (int)$endproductid;

        if($endproductid != 0){
            $proddata = array();
            $proddata = $this->Products_model->get_one($endproductid);
            $type = $proddata->type;
        }else{
            $type = 0;
        }

        $data = array();
        $data = $this->Bom_model->searchbom($search_text, $type)->result();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function get_unit_name($unit_id){
        $unit_id = (int)$unit_id;
        $unitdata = $this->Unit_model->get_one($unit_id);
        echo json_encode($unitdata, JSON_PRETTY_PRINT);
    }

    function save(){
        $workorderid = 0;
        if($this->input->post('work_order_id')){
            $workorderid = $this->input->post('work_order_id');
            $delete_all_entries = $this->Work_order_details_model->deleteEntries($workorderid);
        }

        $data = array();
        
        $data['sales_order_number'] = $this->input->post('sales_order_number');
        $data['date'] = $this->input->post('date');
        $data['start_date'] = $this->input->post('start_date');
        $data['end_date'] = $this->input->post('end_date');
        $data['customer_id'] = $this->input->post('customer_id');
        $data['notes'] = $this->input->post('notes');
        $data['department'] = $this->input->post('department');
        $data['order_type'] = $this->input->post('order_type');

        if($this->input->post('reuse_work_order_id')){
            $data['reuse_work_order_id'] = $this->input->post('reuse_work_order_id'); 
            $data['reuse_id'] = $this->input->post('reuse_id');
        }

        if($workorderid){
            $work_order_id = $this->Work_order_model->save($data, $workorderid);
            $work_order_id = $workorderid;
        }else{
            $work_order_id = $this->Work_order_model->save($data);
        }
        
        $item_qty     = array();
        $item_qty     = $this->input->post('qty');
        $product_id   = array();
        $product_id   = $this->input->post('id');
        $product_cost = array();
        $product_cost = $this->input->post('cost');

        $total_cost   = 0;
        
        for($j = 0; $j < count($item_qty); $j++)
        {
            $work_order_details_data    = array();
            $work_order_details_data['work_order_id']    = $work_order_id;
            $work_order_details_data['product_id']       = $product_id[$j];
            $work_order_details_data['qty']              = $item_qty[$j];     
            $work_order_details_data['cost']             = $product_cost[$j]; 
            $work_order_details_data['total_cost']       = $product_cost[$j] * $item_qty[$j]; 
            $total_cost                                 += $product_cost[$j] * $item_qty[$j];

            $this->Work_order_details_model->save($work_order_details_data);
        }

        $work_order_data                 = array();
        $work_order_data['total_amount'] =  $total_cost;
        $this->Work_order_model->save($work_order_data, $work_order_id);

        $view_data                       = array();
        $view_data['success']            = 1;
        $view_data['work_order_id']      = $work_order_id;
        
        if($workorderid){
            redirect('work_order/edit/'.$work_order_id.'/1');
        }else{
            if($this->input->post('reuse_work_order_id')){
                redirect("set_process/reuse_index/".$work_order_id."/1");
            }else{
                redirect("set_process/index/".$work_order_id."/1");
            }
        }

       // $this->template->rander("production/work_order/create", $view_data);
    }

    function list_data() {

        $work_order_type = $this->input->post('type');

        $options = array();
        $options['order_type'] = $work_order_type;

        $list_data = $this->Work_order_model->get_details($options)->result();
        $result = array();

        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Bom_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    private function _make_row($data) {

        $end_product_data = $this->Products_model->get_one($data->end_product);
        $end_product_name = $end_product_data->name;
        $end_producttype_data = $this->Producttype_model->get_one($data->end_product_type);
        $end_producttype_name = $end_producttype_data->name;
        $client_modal_data=$this->Clients_model->get_one($data->customer_id);

        //dsk 30march2021
        if($data->order_type == "work_order"){
            $work_order_type='Sales Order';
        }else{
           $work_order_type="Job Order";
        }

        return array(

            $data->id,
            $work_order_type,//dsk 30march2021
            $data->date,
            $data->sales_order_number,
            $client_modal_data->company_name,
            $data->start_date,
            $data->end_date,

            //modal_anchor(get_uri("work_order/modal_form_view_work_order_details/".$data->id), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View Work Order", "data-post-id" => $data->id))

            "<a href='".base_url()."index.php/set_process/index/".$data->id."'>Process</a>".

            "<a href='".base_url()."index.php/work_order/edit/".$data->id."'><i class='fa fa-pencil'></i></a>".

            js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("work_order/delete"), "data-action" => "delete")).

            "<a href='".base_url()."index.php/work_order/clone/".$data->id."'><i class='fa fa-clone'></i></a>".
            
            modal_anchor(get_uri("work_order/modal_form_view_work_order_details/".$data->id), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "Print Work Order", "data-post-id" => $data->id))
        );
    }

    function search_end_product($searchEndProduct){
        $data = array();
        $data = $this->Bom_model->search_end_product($searchEndProduct);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function modal_form_view_work_order_details($work_order_id){
        $data = array();
        $data['model_info'] = $this->Work_order_model->get_one($work_order_id);
        $this->load->view('production/work_order/modal_form_view_work_order', $data);
    }

    function modal_form_process($work_order_id,$product_id){

        $data = array();
        $data['work_order_data'] = $this->Work_order_model->get_one($work_order_id);  
        $data["customer_data"] = $this->Clients_model->get_one($data['work_order_data']->customer_id);  
        $data['product_data'] = $this->Products_model->get_one($product_id);
        $data['product_type'] = $this->Producttype_model->get_one($data['product_data']->type);

        /* AG1703 start*/
        $data['product_list_data'] = $this->Bom_model->end_product_list()->result();
        $op = array();
        $op['work_order_id'] = $work_order_id;
        $op['product_id']    = $product_id;
        $data['work_order_detail'] = $this->Work_order_details_model->get_details($op)->result();
        /* AG1703 end*/

        //$data['supplier_list_data'] = $this->Supplier_model->get_details()->result();
        $data['supplier_list_data'] = $this->Vendor_model->get_details()->result();

        $data['process_list_data'] = $this->Process_model->get_details()->result();
        $data['stages_list_data'] = $this->Other_stage_model->get_details()->result();
        $this->load->view('production/work_order/modal_form_view_process', $data);
    }

    function get_unit_data($product_id){
        $product_data = array();
        $product_data = $this->Products_model->get_one($product_id);

        $unit_data    = array();
        $unit_data    = $this->Unit_model->get_one($product_data->unit_id);

        $data = array();
        $data['name'] = $unit_data->name;

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function save_set_process(){
        $data = array();
        $data['work_order_id'] = $woid = $this->input->post('work_order_id');
        $data['end_product_id'] = $endpid = $this->input->post('end_product_id');
        $data['no_of_process'] = $this->input->post('no_of_process');

        $product_list       = array();
        $product_list       = $this->input->post('product_field');

        $process_list       = array();
        $process_list       = $this->input->post('process_field');

        $vendor_list        = array();
        $vendor_list        = $this->input->post('vendor_field');

        $qty_list           = array();
        $qty_list           = $this->input->post('qty_field');
        
        $stages_list        = array();
        $stages_list        = $this->input->post('stages_field');
        
        for($j = 0; $j < count($product_list); $j++){

            $data['product_id']  = $product_list[$j];
            $data['process_id']  = $process_list[$j];
            $data['vendor_id']   = $vendor_list[$j];
            $data['stages']      = $stages_list[$j];         
         
            $this->Set_process_model->save($data);
        }

        redirect("assignbom/index/".$woid."/".$endpid);
        
    }

    /* AG2103 -- */
    function edit($work_order_id, $ok=0){
        $options  = array();
        $options['work_order_id'] = $work_order_id;

        $view_data = array();
        if($ok){
            $view_data['success'] = 1;
        }
        $view_data['work_order_data']   = $this->Work_order_model->get_one($work_order_id);
        $view_data['work_order_detail'] = $this->Work_order_details_model->get_details($options)->result();
        $view_data['end_product_list']  = $this->Bom_model->end_product_list()->result();
        $view_data['clients_dropdown']  = $this->Clients_model->get_dropdown_list(array("company_name"), "id", array("is_lead" => 0));

        $this->template->rander("production/work_order/edit", $view_data);
    }

    function delete(){
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');
        if ($this->input->post('undo')) {
            if ($this->Work_order_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Work_order_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    function search_sale_order($search){
        $data = array();
        $data = $this->SalesOrderModel->search_using_so_or_ref($search);

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function add_sale_order_products($saleOrderId){
        $product_sales_order_data = array();
        $product_sales_order_data = $this->ProductSalesOrder->salesorder_product_list($saleOrderId);
        $i = 0;
        foreach($product_sales_order_data as $psdata){
            $product_data = array();
            $product_data = $this->Products_model->get_one($psdata->product_id);

            $unit_data    = array();
            $unit_data    = $this->Unit_model->get_one($psdata->sale_unit_id);

            $data[$i]['id']         = $psdata->product_id;
            $data[$i]['name']       = $product_data->name;
            $data[$i]['code']       = $product_data->code;
            $data[$i]['unit_name']  = $unit_data->name;
            $data[$i]['qty']        = $psdata->qty;
            $data[$i]['unit_price'] = $psdata->net_unit_price;
            $data[$i]['tax_rate']   = $psdata->tax_rate;
            $data[$i]['tax']        = $psdata->tax;
            $data[$i]['total']      = $psdata->total;
            $data[$i]['unit']       = $psdata->sale_unit_id;
            $i++;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function clone($old_work_order_id){
        $view_data = array();

        $view_data['clients_dropdown'] = $this->Clients_model->get_dropdown_list(array("company_name"), "id", array("is_lead" => 0));

        $view_data['old_work_order_id']= $old_work_order_id;
        $view_data['info'] = $this->Work_order_model->get_one($old_work_order_id);

        $options                  = array();
        $options['work_order_id'] = $old_work_order_id;

        $view_data['details']     = $this->Work_order_details_model->get_details($options)->result();

        $view_data['assignbom']   = $this->Assignbom_model->get_details($options)->result();
        $view_data['setstages']   = $this->Set_stages_model->get_details($options)->result();
        
        //$view_data['supplier_list'] = $this->Supplier_model->get_details()->result();
        $view_data['supplier_list'] = $this->Vendor_model->get_details()->result();

        $view_data['Process_list'] = $this->Process_model->get_details()->result();

        $this->template->rander("production/work_order/clone", $view_data);
    }

    function saveclone(){

        $info = array();
        $info['sales_order_number'] = $this->input->post('sales_order_number');
        $info['date']               = $this->input->post('date');
        $info['start_date']         = $this->input->post('start_date');
        $info['end_date']           = $this->input->post('end_date');
        $info['notes']              = $this->input->post('notes');
        $info['customer_id']        = $this->input->post('customer_id');
        $info['reference']          = $this->input->post('reference');
        $info['department']         = $this->input->post('department');
        $info['total_amount']       = 0.00;
        $info['order_type']         = $this->input->post('order_type');

        $work_order_id              = $this->Work_order_model->save($info);

        if($work_order_id){ //work order details
            $wo_product_id          = array();
            $wo_product_id          = $this->input->post('id');

            $qty                    = array();
            $qty                    = $this->input->post('qty');

            $cost                   = array();
            $cost                   = $this->input->post('cost');

            $total_cost             = 0;

            for($i=0; $i<count($wo_product_id); $i++){
                $detail                 = array();
                $detail['work_order_id']= $work_order_id;
                $detail['product_id']   = $wo_product_id[$i];
                $detail['qty']          = $qty[$i];
                $detail['cost']         = $cost[$i];
                $detail['total_cost']   = $qty[$i] * $cost[$i];
                $this->Work_order_details_model->save($detail);

                $total_cost             += $qty[$i] * $cost[$i];
            }
            
            $update_data = array();
            $update_data['total_amount'] = $total_cost;
            $this->Work_order_model->save($update_data, $work_order_id);
        }

        if($work_order_id){ //set process details   
           $wo_product_id               = array();
           $wo_product_id               = $this->input->post('set_process_wo_product_id');

           $end_product_id              = array();
           $end_product_id              = $this->input->post('set_process_end_product_id');

           $vendor_id                   = array();
           $vendor_id                   = $this->input->post('set_process_vendor_name');


           for($j=0; $j<count($end_product_id); $j++){
               $set_process_data = array();
               $set_process_data['work_order_id']  = $work_order_id;
               $set_process_data['wo_product_id']  = $wo_product_id[$j];
               $set_process_data['end_product_id'] = $end_product_id[$j];

               $options = array();
               $options['work_order_id']  = $this->input->post('old_work_order_id');
               $options['wo_product_id']  = $wo_product_id[$j];
               $options['end_product_id'] = $end_product_id[$j];

               $prev_data = array();
               $prev_data = $this->Set_process_model->get_details($options)->result();

               $set_process_data['process_id']     = $prev_data[0]->process_id;
               $set_process_data['stages']         = $prev_data[0]->stages;
               $set_process_data['vendor_id']      = $vendor_id[$j];
               $set_process_data['no_of_process']  = $prev_data[0]->no_of_process; 

               $this->Set_process_model->save($set_process_data);
           }

           if($work_order_id){ //assign bom detail
            $wo_product_id              = array();
            $wo_product_id              = $this->input->post('ab_wo_product_id');

            $end_product_id             = array();
            $end_product_id             = $this->input->post('ab_end_product_id');

            $product_id                 = array();
            $product_id                 = $this->input->post('ab_rm_product_id');

            $bom_id                     = array();
            $bom_id                     = $this->input->post('ab_bom_id');

            $warehouse_id               = array();
            $warehouse_id               = $this->input->post('ab_warehouse_id');

            $qty                        = array();
            $qty                        = $this->input->post('ab_expected_qty');

            for($k=0; $k<count($end_product_id); $k++){
                $assign_bom_data = array();
                $assign_bom_data['work_order_id']  = $work_order_id;
                $assign_bom_data['wo_product_id']  = $wo_product_id[$k];
                $assign_bom_data['end_product_id'] = $end_product_id[$k]; 
                $assign_bom_data['bom_id']         = $bom_id[$k];
                $assign_bom_data['product_id']     = $product_id[$k];
                $assign_bom_data['warehouse_id']   = $warehouse_id[$k];
                $assign_bom_data['qty']            = $qty[$k];

                $work_order_details_data           = array();
                $wo_options                        = array();
                $wo_options['work_order_id']       = $work_order_id;
                $wo_options['product_id']          = $wo_product_id[$k];
                $work_order_details_data = $this->Work_order_details_model->get_details($wo_options)->result();

                $work_order_qty                    = 0;
                foreach($work_order_details_data as $wodd){
                    $work_order_qty                = $wodd->qty;
                }

                $bom_data                          = array();
                $bo_options                        = array();
                $bo_options['bom_id']              = $bom_id[$k];
                $bo_options['product_id']          = $product_id[$k];

                $bom_data = $this->Bomdetail_model->get_details($bo_options)->result();

                $wastage_bom                       = 0;
                $weight_bom                        = 0;
                foreach($bom_data as $bod){
                    $wastage_bom                   = $bod->product_wastage;
                    $weight_bom                    = $bod->product_weight;
                }
                
                $assign_bom_data['weight']         = $work_order_qty * $weight_bom;
                $assign_bom_data['wastage']        = $work_order_qty * $wastage_bom;
 
                $this->Assignbom_model->save($assign_bom_data);
            }
          }

          //set stages detail

          $option = array();
          $option['work_order_id'] = $this->input->post('old_work_order_id');

          $set_stages_data = $this->Set_stages_model->get_details($option)->result();
          foreach($set_stages_data as $ssd){
              $ssdata                   = array();
              $ssdata['work_order_id']  = $work_order_id;
              $ssdata['wo_product_id']  = $ssd->wo_product_id;
              $ssdata['end_product_id'] = $ssd->end_product_id;
              $ssdata['process_id']     = $ssd->process_id;
              $ssdata['stage']          = $ssd->stage;
              $ssdata['stage_name']     = $ssd->stage_name;

              $this->Set_stages_model->save($ssdata);
          }

        }

        redirect("viewproduction");
    }
    
}