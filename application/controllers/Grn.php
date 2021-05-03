<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grn extends MY_Controller {

    function __construct() {
        parent::__construct();
       //$this->access_only_admin();
    }

    function index() {
        $this->template->rander("grn/index");
    }

    function create(){
        $view_data = array();
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['grn_status_all'] = $this->Grn_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['purchase']=$this->Purchase_model->get_all()->result();//darini 22-3
        $grn_list=$this->Grn_model->purchaseIdList()->result();
        $list=array();
        foreach($grn_list as $grn){
            $list[]=$grn->purchase_id;
        }
        $view_data['grn_list']=$list;

        //darini 10-4
        $request=$this->Purchase_request_model->get_all()->result();
        $order=$this->Purchase_order_model->get_all()->result();
        $pch_list=$this->Grn_model->get_all()->result();
        $pcho_list=$this->Purchase_order_model->get_all()->result();
       
        $list_order=array();
        $list_req=array();
        foreach($pch_list as $pr){
         if($pr->status!=2){            
          if($pr->request_order==1){
            $list_req[]=$pr->request_number;

          }

          if($pr->request_order==2){
            $list_order[]=$pr->request_number;
          }
        }
        }

        foreach($pcho_list as $grn){
            $list_req[]=$grn->purchase_requstion_number;
        }

       $final_order=array();
       foreach( $order as $or){
            if(in_array($or->id,$list_order)){ }else{
                $final_order[]=$or;
            }
       }

       $final_req=array();
       foreach( $request as $or){
            if(in_array($or->id,$list_req)){ }else{
                $final_req[]=$or;
            }
       }

         $view_data['request']=$final_req;
        $view_data['order']=$final_order;//end
        $this->template->rander("grn/create", $view_data);
    }

    function savegrn(){
        $data = array();
        $data['reference_no'] = 'grn-' . date("Ymd") . '-'. date("his");
        $data['user_id'] = $this->login_user->id;
        $data['warehouse_id'] = $this->input->post('warehouse_id');
        $data['supplier_id'] = $this->input->post('supplier_id');
        $data['item'] = count($this->input->post('code'));
        $data['total_qty'] = array_sum($this->input->post('qty'));
        $data['total_discount'] = $this->input->post('total_discount');
        //$data['total_tax'] = $this->input->post('order_tax');
        $data["purchase_id"]=$this->input->post('purchase_id');//extra 22-3
        $data['request_number']=$this->input->post('request_number');//darini 10-4
        $data['request_order']=$this->input->post('request_order');//darini 10-4
        $data['dc_number'] = $this->input->post('dc_number');
        $data['grn_date'] = $this->input->post('grn_date');
        $data['dc_date'] = $this->input->post('dc_date');
        $data['receiver_name'] = $this->input->post('receiver_name');

        $item_qty = array();
        $item_cost =array();
        $item_qty = $this->input->post('qty');
        $item_cost= $this->input->post('product_cost');
        $sub_total = 0;

        $item_tax=array();
        $item_tax_rate=array();
        $item_tax= $this->input->post('tax');
        $item_tax_rate= $this->input->post('tax_rate');


        for($i=0; $i<count($item_qty);$i++){
            $sub_total += ($item_qty[$i] * $item_cost[$i])+$item_tax[$i]; 
        }

        $data['total_cost'] = $sub_total;
        $data['total_tax'] = array_sum($this->input->post('tax'));
        $data['order_tax'] = $this->input->post('order_tax');
        $data['order_discount'] = $this->input->post('total_discount');
        $data['shipping_cost'] = $this->input->post('shipping_cost');   
        $tax=$this->Taxes_model->get_one($data['order_tax']);
        $data['order_tax_rate']=$tax->percentage;
        $ordertax=($sub_total-$data['order_discount'])*($data['order_tax_rate']/100);     
        $data['grand_total'] = $sub_total - $data['order_discount'] + $ordertax + $this->input->post('shipping_cost');
        $data['paid_amount'] = 0;
        $data['status'] = $this->input->post('status');
        $data['payment_status'] = 1;
        $data['note'] = $this->input->post('note');
        $data['note'] = str_replace(array("\r", "\n", "  "), ' ', $data['note']);
        $data['created_at'] = get_my_local_time();
        $data['updated_at'] = get_my_local_time();
           //changes 24-3
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){            
            $target_path = get_setting("timeline_file_path_grn");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "grn");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end
        $grn_id = $this->Grn_model->save($data);

        $product_id = array();
        $product_id = $this->input->post('id');
        
        for($j = 0; $j < count($item_qty); $j++){
            $grn_data = array();
            $grn_data['grn_id'] = $grn_id;
            $grn_data['product_id']  = $product_id[$j];
            $grn_data['qty']         = $item_qty[$j];
            $grn_data['recieved']    = $item_qty[$j];
            $grn_data['purchase_unit_id'] = 1;//changes 22-3
            $grn_data['net_unit_cost'] = $item_cost[$j];
            $grn_data['tax_rate'] = $item_tax_rate[$j];
            $grn_data['tax'] = $item_tax[$j];
            $grn_data['total'] = ($grn_data['qty'] * $grn_data['net_unit_cost'])+$item_tax[$j];
            $grn_data['created_at'] = get_my_local_time();
            $grn_data['updated_at'] = get_my_local_time();
            
            $warehouse_data = array();
            $warehouse_data['product_id'] = $product_id[$j];

            $pdata = $this->Products_model->get_one($product_id[$j]);

            $whid = $pdata->warehouse_id;

            if($whid){
                $warehouse_data['warehouse_id'] = $whid;
            }else{
                $warehouse_data['warehouse_id'] = $this->input->post('warehouse_id');
            }

            $get_warehouse_data = $this->Productwarehouse_model->check_product($warehouse_data['warehouse_id'], $product_id[$j])->num_rows();

            if($get_warehouse_data > 0){
                $this->Productwarehouse_model->updatewhdata($warehouse_data['warehouse_id'], $product_id[$j], $item_qty[$j], 1);
            }else{
                $warehouse_data['qty'] = $item_qty[$j];
                $warehouse_data['price'] = $item_cost[$j];
                $warehouse_data['created_at'] = get_my_local_time();
                $warehouse_data['updated_at'] = get_my_local_time();
                $this->Productwarehouse_model->save($warehouse_data);
            }
         
            $grn_data['warehouse_id'] = $warehouse_data['warehouse_id'];
            $this->Productgrn_model->save($grn_data);
        }

        $view_data = array();
        $view_data['success'] = 1;
        $this->template->rander("grn/create", $view_data);
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');
        //changes 22-3
        $options = array();
        $options['grn_id'] =$id;
        $product_grn_data = $this->Productgrn_model->get_details($options)->result();

        foreach($product_grn_data as $grndata){
            $p_product_id   = $grndata->product_id;
            $p_warehouse_id = $grndata->warehouse_id;
            $p_product_qty  = $grndata->qty;

            $this->Productwarehouse_model->updatewhdata($p_warehouse_id, $p_product_id, $p_product_qty, 0);
            
            $this->Productgrn_model->deleteProductGrn($grndata->id);
        } //end
        if ($this->input->post('undo')) {
            if ($this->Grn_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Grn_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Grn_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    function list_data() {
        $list_data = $this->Grn_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {
        $supplier_data = $this->Supplier_model->get_one($data->supplier_id);
        $grn_status = $this->Grn_status_model->get_one($data->status);
        $payment_status  = $this->Payment_status_model->get_one($data->payment_status);
        return array(
            $data->id,
            $data->created_at,
            $data->reference_no,
            $supplier_data->name.' ( '.$supplier_data->company_name.' )',
            $grn_status->title,
            $data->grand_total,
            $data->grn_date,
            $data->dc_number,
            $data->dc_date,
            
            '<a class="edit" href="grn/edit/'.$data->id.'"><i class="fa fa-pencil"></i></a>'

            .modal_anchor(get_uri("grn/modal_form/".$data->id), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View grn detail", "data-post-id" => $data->id))

            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete BOM", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("grn/delete"), "data-action" => "delete"))
        );
    }

    function upload_file() {
        upload_file_to_temp();
    }

    function validate_post_file() {
        return validate_post_file($this->input->post("file_name"));
    }

    function search($search_text){
        $data = array();
        $data = $this->Products_model->search($search_text)->result();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function edit($grn_id){
        $view_data  = array();

        $view_data['grn_data'] = $this->Grn_model->get_one($grn_id);

        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['grn_status_all'] = $this->Grn_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['purchase']=$this->Purchase_model->get_all()->result();//darini 23-3
        $view_data['request']=$this->Purchase_request_model->get_all()->result();//darini 10-4
        $view_data['order']=$this->Purchase_order_model->get_all()->result();//darini 10-4
        $this->template->rander("grn/edit", $view_data);
    }

    function updategrn(){
        $grn_id = $this->input->post('grn_id');

        $data = array();
        $data['warehouse_id'] = $this->input->post('warehouse_id');
        $data['supplier_id'] = $this->input->post('supplier_id');
        $data['item'] = count($this->input->post('code'));
        $data['total_qty'] = array_sum($this->input->post('qty'));
        $data['total_discount'] = $this->input->post('total_discount');
        //$data['total_tax'] = $this->input->post('order_tax');
        $item_qty = array();
        $item_cost =array();
        $item_qty = $this->input->post('qty');
        $item_cost= $this->input->post('product_cost');

        $item_tax=array();
        $item_tax_rate=array();
        $item_tax= $this->input->post('tax');
        $item_tax_rate= $this->input->post('tax_rate');

        $sub_total = 0;
        for($i=0; $i<count($item_qty);$i++){
            $sub_total +=( $item_qty[$i] * $item_cost[$i])+$item_tax[$i]; 
        }
        $data['total_cost'] = $sub_total;
        $data['total_tax'] = array_sum($this->input->post('tax'));
        $data['order_tax'] = $this->input->post('order_tax');
        $data['order_discount'] = $this->input->post('total_discount');
        $data['shipping_cost'] = $this->input->post('shipping_cost');  
        $tax=$this->Taxes_model->get_one($data['order_tax']);
        $data['order_tax_rate']=$tax->percentage;
        $ordertax=($sub_total-$data['order_discount'])*($data['order_tax_rate']/100);
        $data['grand_total'] = $sub_total - $data['order_discount'] + $ordertax + $this->input->post('shipping_cost');
        $data['paid_amount'] = 0;
        $data['status'] = $this->input->post('status');
        $data['payment_status'] = 1;
        $data['note'] = $this->input->post('note');
        $data['note'] = str_replace(array("\r", "\n", "  "), ' ', $data['note']);
        $data['updated_at'] = get_my_local_time();
        $data['dc_number'] = $this->input->post('dc_number');
        $data['grn_date'] = $this->input->post('grn_date');
        $data['dc_date'] = $this->input->post('dc_date');
        $data['receiver_name'] = $this->input->post('receiver_name');

          //changes
          $oldfilename = $this->input->post('old_file');
          $filenames = $this->input->post('file_names');
          if(count($filenames) > 0){    
              if($oldfilename != NULL)
              {
                  unlink('./files/timeline_files/grn/'.$oldfilename);
              }
                  
              $target_path = get_setting("timeline_file_path_grn");
              $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "grn");
              $image_data = unserialize($files_data);
              $data['document'] = $image_data[0]['file_name'];
          }//end
        $grn_idy = $this->Grn_model->save($data, $grn_id);
        $grn_id = $this->input->post('grn_id');

        $product_id = array();
        $product_id = $this->input->post('id');

        $options = array();
        $options['grn_id'] = $grn_id;
        $product_grn_data = $this->Productgrn_model->get_details($options)->result();

        foreach($product_grn_data as $grndata){
            $p_product_id   = $grndata->product_id;
            $p_warehouse_id = $grndata->warehouse_id;
            $p_product_qty  = $grndata->qty;

            $this->Productwarehouse_model->updatewhdata($p_warehouse_id, $p_product_id, $p_product_qty, 0);
            
            $this->Productgrn_model->deleteProductGrn($grndata->id);
        }
        
        for($j = 0; $j < count($item_qty); $j++){
            $grn_data = array();
            $grn_data['grn_id'] = $grn_id;
            $grn_data['product_id']  = $product_id[$j];
            $grn_data['qty']         = $item_qty[$j];
            $grn_data['recieved']    = $item_qty[$j];
            $grn_data['purchase_unit_id'] = 1;//changes 22-3
            $grn_data['net_unit_cost'] = $item_cost[$j];
            $grn_data['tax_rate'] = $item_tax_rate[$j];
            $grn_data['tax'] =$item_tax[$j];
            $grn_data['total'] = ($grn_data['qty'] * $grn_data['net_unit_cost'])+$item_tax[$j];
            $grn_data['created_at'] = get_my_local_time();
            $grn_data['updated_at'] = get_my_local_time();
            
            $warehouse_data = array();
            $warehouse_data['product_id'] = $product_id[$j];

            $pdata = $this->Products_model->get_one($product_id[$j]);

            $whid = $pdata->warehouse_id;

            if($whid){
                $warehouse_data['warehouse_id'] = $whid;
            }else{
                $warehouse_data['warehouse_id'] = $this->input->post('warehouse_id');
            }

            $grn_data['warehouse_id'] = $warehouse_data['warehouse_id'];
            $this->Productgrn_model->save($grn_data);

            $alreadyFound1 = $this->Productwarehouse_model->check_product($warehouse_data['warehouse_id'], $product_id[$j])->num_rows();

            if($alreadyFound1 > 0){
                $this->Productwarehouse_model->updatewhdata($warehouse_data['warehouse_id'], $product_id[$j], $item_qty[$j], 1);
            }else{
                $warehouse_data['qty'] = $item_qty[$j];
                $warehouse_data['price'] = $item_cost[$j];
                $warehouse_data['created_at'] = get_my_local_time();
                $warehouse_data['updated_at'] = get_my_local_time();
                $this->Productwarehouse_model->save($warehouse_data);
            }
           // echo json_encode($warehouse_data);
        }

        $view_data = array();
        $view_data['success'] = 1;
        $view_data['grn_data'] = $this->Grn_model->get_one($grn_id);
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['grn_status_all'] = $this->Grn_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();

        $this->template->rander("grn/edit", $view_data);
    }

    function modal_form($grn_id)
    {
        $view_data = array();
        
        $view_data['model_info'] = $this->Grn_model->get_one($grn_id);
        $this->load->view('grn/modal_form', $view_data);
    }

      //darini 22-3
 function getprtdet($purchase_id){
    $options = array();
    $options['purchase_id'] = $purchase_id;
    $product_purchase_data = $this->Productpurchase_model->get_details($options)->result();
    $result=array();
    foreach($product_purchase_data as $prd){
        $prdts=$this->Products_model->get_one($prd->product_id);
        $unit_data    = $this->Unit_model->get_one($prdts->unit_id);
        $unit_name    = $unit_data->name;
       // echo json_encode(  $prd);
        $data=array();
        $data["id"]=$prdts->id;
        $data["name"]=$prdts->name;
        $data["code"]=$prdts->code;
        $data["cost"]=$prd->net_unit_cost; 
        $data["unit"]= $unit_name;
        $data["tax"]=$prd->tax;
        $data["tax_rate"]=$prd->tax_rate;
        $data["discount"]=$prd->discount;
        $data["recieved"]=$prd->recieved;
        $data["qty"]=$prd->qty;
        $data["total"]=$prd->total;
        $result[]=  $data;
    }
    echo json_encode($result);
   //echo json_encode($product_purchase_data);
 }
 function get_all_suppliers(){  
    $data = array();
    $data = $this->Supplier_model->get_al()->result();
    $newdata = array();
    foreach($data as $d){
        $newdata['id'] = $d->id;
    }

    echo json_encode($newdata, JSON_PRETTY_PRINT);
}



}