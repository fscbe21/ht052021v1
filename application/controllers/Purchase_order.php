<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_order extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->access_only_admin();
    }

    function index() {
        $this->template->rander("purchase_order/index");
    }

    function create(){
        $view_data = array();
       /* $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();*/
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['request']=$this->Purchase_request_model->get_all()->result();//darini 21-3
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        //29-3

        $pch_list=$this->Purchase_order_model->get_all()->result();
        $list=array();
        foreach($pch_list as $grn){
            $product_purchase_data = $this->Purchase_request_details_model->getprdtdetails($grn->purchase_requstion_number);
            $count=0;
           // $size=sizeof($product_purchase_data );
            //$sizecount=1;
            foreach($product_purchase_data as $prch){
                $sizecount++;
                if($prch->remaining_qty>0){                  
                   $count++;                   
                }else{
                    if($count==0){
                        $list[]=$grn->purchase_requstion_number;
                    }
                    
                    
                }
              

            }
           // $list[]=$grn->purchase_requstion_number;
        }
        $pcho_list=$this->Grn_model->get_all()->result();//darini 10-4
        foreach($pcho_list as $pr){
                   
             if($pr->request_order==1){
               $list[]=$pr->request_number;
   
             }                
           
           }
        $view_data['pch_list']=$list;//end
        //echo json_encode($list);
       $this->template->rander("purchase_order/create", $view_data);
    }


   /* function upload_file() {
        upload_file_to_temp();
    }

    function validate_post_file() {
        return validate_post_file($this->input->post("file_name"));
    }*/

    function savepurchase_order(){
        $data = array();
        $data['po_no'] = $this->input->post('po_no');
        $data['user_id'] = $this->login_user->id;
        $data['date'] = $this->input->post('date');
        $data['quotation_number'] = $this->input->post('quotation_number');
        $data['purchase_requstion_number'] = $this->input->post('purchase_requstion_number');
        $data['item'] = count($this->input->post('code'));
        $data['total_qty'] = array_sum($this->input->post('qty'));
        $data['total_discount'] = $this->input->post('total_discount');
        $data['supplier_id'] = $this->input->post('supplier_id');
        //$data['total_tax'] = $this->input->post('order_tax');
        
        $item_qty = array();
        $item_cost =array();
        $item_qty = $this->input->post('qty');
        $item_cost= $this->input->post('product_cost');
        $item_tax=array();
        $item_tax_rate=array();
        $item_tax= $this->input->post('tax');
        $item_tax_rate= $this->input->post('tax_rate');
        $data['total_tax'] = array_sum($this->input->post('tax'));
        $sub_total = 0;

        for($i=0; $i<count($item_qty);$i++){
            $sub_total += ($item_qty[$i] * $item_cost[$i])+$item_tax[$i]; 
        }

        $data['total_cost'] = $sub_total;
        $data['order_tax'] = $this->input->post('order_tax');
        $data['order_discount'] = $this->input->post('total_discount');
        $data['shipping_cost'] = $this->input->post('shipping_cost');     
        $tax=$this->Taxes_model->get_one($data['order_tax']);
        $data['order_tax_rate']=$tax->percentage;
        $ordertax=($sub_total-$data['order_discount'])*($data['order_tax_rate']/100);
        $data['grand_total'] = $sub_total - $data['order_discount'] + $ordertax + $this->input->post('shipping_cost');
        $data['paid_amount'] = 0;
       // $data['status'] = $this->input->post('status');
        $data['payment_status'] = 1;
        $data['note'] = $this->input->post('note');
        $data['note'] = str_replace(array("\r", "\n", "  "), ' ', $data['note']);
        $data['created_at'] = get_my_local_time();
        $data['updated_at'] = get_my_local_time();

         //changes 24-3        
         $filenames = $this->input->post('file_names');
         if(count($filenames) > 0){                                    
             $target_path = get_setting("timeline_file_path_purchase_order");
             $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "purchase_order");
             $image_data = unserialize($files_data);
             $data['document'] = $image_data[0]['file_name'];
         }//end
        $purchase_id = $this->Purchase_order_model->save($data);

        $product_id = array();
        
        $product_id = $this->input->post('id');
      
        for($j = 0; $j < count($item_qty); $j++){
            $purchase_data = array();
            $purchase_data['purchase_order_id'] = $purchase_id;
            $purchase_data['product_id']  = $product_id[$j];
            $purchase_data['qty']         = $item_qty[$j];
            $purchase_data['recieved']    = $item_qty[$j];
            $purchase_data['purchase_unit_id'] = 1;
            $purchase_data['net_unit_cost'] = $item_cost[$j];
            $purchase_data['tax_rate'] = $item_tax_rate[$j];
            $purchase_data['tax'] = $item_tax[$j];
            $purchase_data['total'] = ($purchase_data['qty'] * $purchase_data['net_unit_cost'])+$item_tax[$j];
            $purchase_data['created_at'] = get_my_local_time();
            $purchase_data['updated_at'] = get_my_local_time();
            $purchase_data['remaining_qty']=$item_qty[$j];//chenges 30-3
            
        
            //$purchase_data['warehouse_id'] = $warehouse_data['warehouse_id'];
            $this->Purchaseorder_details_model->save($purchase_data);
        }

        $product_purchase_data = $this->Purchase_request_details_model->getprdtdetails($data['purchase_requstion_number']);
        foreach($product_purchase_data as $prd){
            for($j = 0; $j < count($item_qty); $j++){
                if($prd->product_id==$product_id[$j]){                    
                    $remaing_qty=$prd->remaining_qty-$item_qty[$j];                   
                    $update=array();
                    $update['remaining_qty']= $remaing_qty;
                    $this->Purchase_request_details_model->save($update,$prd->id);
                }
            }

        }
        $update_id=array();
        $update_id['prno']= $purchase_request_id;

        $purchase_request= $this->Purchase_order_model->save($update_id,$purchase_id);
        $view_data = array();
        $view_data['success'] = 1;
        $this->template->rander("purchase_order/create", $view_data);
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');
        if ($this->input->post('undo')) {
            if ($this->Purchase_order_model->delete($id, true)) {//22-3
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Purchase_order_model->delete($id)) {//22-3
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Purchase_order_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    function list_data() {
        $list_data = $this->Purchase_order_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {

         //R.V12_04S
         $po_status = $this->Purchase_model->get_one($data->po_no);
         if($po_status->status==1){
             $status="Completed";
             $status_color="Green";
         }else if($po_status->status==2){
             $status="Pending";
             $status_color="Red";
         }
 
          //R.V12_04E
       /* $supplier_data = $this->Supplier_model->get_one($data->supplier_id);
        $purchase_status = $this->Purchase_status_model->get_one($data->status);
        $payment_status  = $this->Payment_status_model->get_one($data->payment_status);*/
        return array(
            $data->id,
            $data->date,
            $data->po_no,
          
            $data->quotation_number,
            $data->purchase_requstion_number,
            $data->grand_total
            , //R.V12_04S
            '<span style="background-color:'.$status_color.' ;padding:3px; color:white;border-radius: .25rem;font-size: 11px;" >'.$status.'</span>',////R.V12_04E
            
            
            '<a class="edit" href="purchase_order/edit/'.$data->id.'"><i class="fa fa-pencil"></i></a>'

            .modal_anchor(get_uri("purchase_order/modal_form/".$data->id), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View purchase detail", "data-post-id" => $data->id))

            //. js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete Purchse Order", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("purchase_order/delete"), "data-action" => "delete"))
        );
    }

   

    function search($search_text){
        $data = array();
        $data = $this->Products_model->search($search_text)->result();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function edit($purchase_id){
        $view_data  = array();

        $view_data['purchase_data'] = $this->Purchase_order_model->get_one($purchase_id);

       /* $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();*/
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $this->template->rander("purchase_order/edit", $view_data);
    }

    function updatepurchase(){
        $purchase_id = $this->input->post('purchase_order_id');//changes 22-3

        $data = array();
        $data['po_no'] = $this->input->post('po_no');
        $data['user_id'] = $this->login_user->id;
        $data['date'] = $this->input->post('date');
        $data['quotation_number'] = $this->input->post('quotation_number');
        $data['purchase_requstion_number'] = $this->input->post('purchase_requstion_number');
        $data['item'] = count($this->input->post('code'));
        $data['total_qty'] = array_sum($this->input->post('qty'));
        $data['total_discount'] = $this->input->post('total_discount');
        $data['supplier_id'] = $this->input->post('supplier_id');
        //$data['total_tax'] = $this->input->post('order_tax');

        $item_qty = array();
        $item_cost =array();
        $item_qty = $this->input->post('qty');
        $item_cost= $this->input->post('product_cost');
        $item_tax=array();
        $item_tax_rate=array();
        $item_tax= $this->input->post('tax');
        $item_tax_rate= $this->input->post('tax_rate');
        $data['total_tax'] = array_sum($this->input->post('tax'));
        $sub_total = 0;
        for($i=0; $i<count($item_qty);$i++){
            $sub_total += ($item_qty[$i] * $item_cost[$i])+$item_tax[$i];
        }
        $data['total_cost'] = $sub_total;
        $data['order_tax'] = $this->input->post('order_tax');
        $data['order_discount'] = $this->input->post('total_discount');
        $data['shipping_cost'] = $this->input->post('shipping_cost');       
        $tax=$this->Taxes_model->get_one($data['order_tax']);
        $data['order_tax_rate']=$tax->percentage;
        $ordertax=($sub_total-$data['order_discount'])*($data['order_tax_rate']/100); 
        $data['grand_total'] = $sub_total - $data['order_discount'] +  $ordertax+ $this->input->post('shipping_cost');
        $data['paid_amount'] = 0;
       // $data['status'] = $this->input->post('status');
        $data['payment_status'] = 1;
        $data['note'] = $this->input->post('note');
        $data['note'] = str_replace(array("\r", "\n", "  "), ' ', $data['note']);
        $data['updated_at'] = get_my_local_time();

         //changes
        $oldfilename = $this->input->post('old_file');
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){    
                if($oldfilename != NULL)
                {
                    unlink('./files/timeline_files/purchase_order/'.$oldfilename);
                }
                        
            $target_path = get_setting("timeline_file_path_purchase_order");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "purchase_order");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end
        $purchase_idy = $this->Purchase_order_model->save($data, $purchase_id);
       

        $product_id = array();
        $item_tax=array();
        $item_tax_rate=array();
        $product_id = $this->input->post('id');
        $item_tax= $this->input->post('tax');
        $item_tax_rate= $this->input->post('tax_rate');

        $options = array();
        $options['purchase_order_id'] = $purchase_id;//changes 22-3
        $product_purchase_data = $this->Purchaseorder_details_model->get_details($options)->result();
       
        foreach($product_purchase_data as $purchasedata){
            $p_product_id   = $purchasedata->product_id;
           // $p_warehouse_id = $purchasedata->warehouse_id;
            $p_product_qty  = $purchasedata->qty;

            //$this->Productwarehouse_model->updatewhdata($p_warehouse_id, $p_product_id, $p_product_qty, 0);
            
            $this->Purchaseorder_details_model->deleteProductPurchase($purchasedata->id);
            $this->Purchase_request_details_model-> updateremaingqty( $p_product_id,$data['purchase_requstion_number'],$p_product_qty);
        }
        
        for($j = 0; $j < count($item_qty); $j++){
            //changes 23-3
            $purchase_data = array();
          
            $purchase_data['purchase_order_id'] = $purchase_id;
            $purchase_data['product_id']  = $product_id[$j];
            $purchase_data['qty']         = $item_qty[$j];
            $purchase_data['recieved']    = $item_qty[$j];
            $purchase_data['purchase_unit_id'] = 1;
            $purchase_data['net_unit_cost'] = $item_cost[$j];
            $purchase_data['tax_rate'] = $item_tax_rate[$j];
            $purchase_data['tax'] = $item_tax[$j];
            $purchase_data['total'] = ($purchase_data['qty'] * $purchase_data['net_unit_cost'])+$item_tax[$j];
            $purchase_data['created_at'] = get_my_local_time();
            $purchase_data['updated_at'] = get_my_local_time();
            $purchase_data['remaining_qty']=$item_qty[$j];//chenges 30-3
            $this->Purchaseorder_details_model->save($purchase_data);//end
      
        }

        $product_purchase_order_data = $this->Purchase_request_details_model->getprdtdetails($data['purchase_requstion_number']);
        foreach($product_purchase_order_data as $prd){
            for($j = 0; $j < count($item_qty); $j++){
                if($prd->product_id==$product_id[$j]){                    
                    $remaing_qty=$prd->remaining_qty-$item_qty[$j];                   
                    $update=array();
                    $update['remaining_qty']= $remaing_qty;
                    $this->Purchase_request_details_model->save($update,$prd->id);
                }
            }

        }

        $view_data = array();
        $view_data['success'] = 1;
        /*$view_data['purchase_data'] = $this->Purchase_model->get_one($purchase_id);
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();*/
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();

        $this->template->rander("purchase_order/edit", $view_data);
    }

    function modal_form($purchase_id)
    {
        $view_data = array();
        
        $view_data['model_info'] = $this->Purchase_order_model->get_one($purchase_id);
        $this->load->view('purchase_order/modal_form', $view_data);
    }


    //darini 22-3
    function getprtdet($purchase_id){    
        
        $purchasereq=$this->Purchase_request_model->get_one($purchase_id);
        $product_purchase_data = $this->Purchase_request_details_model->getprdtdetails($purchase_id);
           //echo json_encode( $product_purchase_data);
           $view_data['supplier_id']=$purchasereq->supplier_id;
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
               $data["cost"]=$prdts->cost; 
               $data["unit"]= $unit_name;
               $data["tax"]=$prdts->tax_id;
               $data["qty"]=$prd->qty;
               $data["remaining_qty"]=$prd->remaining_qty;
               $result[]=  $data;
           }

           $view_data['data_array']=$result;
           echo json_encode( $view_data);
       
       }//end

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