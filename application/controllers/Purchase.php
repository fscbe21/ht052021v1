<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->access_only_admin();
    }

    function index() {
        $this->template->rander("purchase/index");
    }

    function create(){
        $view_data = array();
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
       // $view_data['request']=$this->Purchase_request_model->get_all()->result();//darini 22-3
        //$view_data['order']=$this->Purchase_order_model->get_all()->result();//darini 22-3
        $request=$this->Purchase_request_model->get_all()->result();//darini 22-3
        $order=$this->Purchase_order_model->get_all()->result();//darini 22-3
        $pch_list=$this->Purchase_model->get_all()->result();
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
        $view_data['order']=$final_order;
        //echo json_encode($list_order);
        //echo json_encode($list_req);

        //darini10-4
        $view_data['grn']=$this->Grn_model->get_all()->result();
        
        $list=array();
        foreach($pch_list as $grn){
            $list[]=$grn->grn_id;
        }
        $view_data['grn_list']=$list;
        //end
       $this->template->rander("purchase/create", $view_data);
    }

    function savepurchase(){
        $data = array();
        $data['reference_no'] = 'pr-' . date("Ymd") . '-'. date("his");
        $data['user_id'] = $this->login_user->id;
        $data['warehouse_id'] = $this->input->post('warehouse_id');
        $data['supplier_id'] = $this->input->post('supplier_id');
        $data['item'] = count($this->input->post('code'));
        $data['total_qty'] = array_sum($this->input->post('qty'));
        $data['total_discount'] = $this->input->post('total_discount');
        //$data['total_tax'] = $this->input->post('order_tax');
        $data['request_number']=$this->input->post('request_number');//extra 23-3
        $data['request_order']=$this->input->post('request_order');//extra 23-3
        $data['grn_id']=$this->input->post('grn_id');//darini 10-4
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
             $target_path = get_setting("timeline_file_path_purchase");
             $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "purchase");
             $image_data = unserialize($files_data);
             $data['document'] = $image_data[0]['file_name'];
         }//end
        $purchase_id = $this->Purchase_model->save($data);

        $product_id = array();
        $product_id = $this->input->post('id');
        
        for($j = 0; $j < count($item_qty); $j++){
            $purchase_data = array();
            $purchase_data['purchase_id'] = $purchase_id;
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
            
            $warehouse_data = array();
            $warehouse_data['product_id'] = $product_id[$j];

            $pdata = $this->Products_model->get_one($product_id[$j]);

            $whid = $pdata->warehouse_id;

            if($whid){
                $warehouse_data['warehouse_id'] = $whid;
            }else{
                $warehouse_data['warehouse_id'] = $this->input->post('warehouse_id');
            }

            /* changes 22-3 $get_warehouse_data = $this->Productwarehouse_model->check_product($warehouse_data['warehouse_id'], $product_id[$j])->num_rows();

            if($get_warehouse_data > 0){
                $this->Productwarehouse_model->updatewhdata($warehouse_data['warehouse_id'], $product_id[$j], $item_qty[$j], 1);
            }else{
                $warehouse_data['qty'] = $item_qty[$j];
                $warehouse_data['price'] = $item_cost[$j];
                $warehouse_data['created_at'] = get_my_local_time();
                $warehouse_data['updated_at'] = get_my_local_time();
                $this->Productwarehouse_model->save($warehouse_data);
            }*/


            $purchase_data['warehouse_id'] = $warehouse_data['warehouse_id'];
            $this->Productpurchase_model->save($purchase_data);
        }

        if($data['request_order']==1){
            $product_purchase_data = $this->Purchase_request_details_model->getprdtdetails($data['request_number']);
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
        }else if($data['request_order']==2){
            $options = array();
            $options['purchase_order_id'] = $data['request_number'];
            $product_purchase_data = $this->Purchaseorder_details_model->get_details($options)->result();
            foreach($product_purchase_data as $prd){
                for($j = 0; $j < count($item_qty); $j++){
                    if($prd->product_id==$product_id[$j]){                    
                        $remaing_qty=$prd->remaining_qty-$item_qty[$j];                   
                        $update=array();
                        $update['remaining_qty']= $remaing_qty;
                        $this->Purchaseorder_details_model->save($update,$prd->id);
                    }
                }
    
            }

        }
        $view_data = array();
        $view_data['success'] = 1;
        $this->template->rander("purchase/create", $view_data);
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');
        if ($this->input->post('undo')) { //changes 22-3
            if ($this->Purchase_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Purchase_model->delete($id)) {//changes 22-3
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Purchase_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    function list_data() {
        $list_data = $this->Purchase_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {
        $supplier_data = $this->Supplier_model->get_one($data->supplier_id);
        $purchase_status = $this->Purchase_status_model->get_one($data->status);
        $payment_status  = $this->Payment_status_model->get_one($data->payment_status);
         //darini 19-3
         $edit= '<li role="presentation">' .'<a class="edit" href="purchase/edit/'.$data->id.'"><i class="fa fa-pencil"></i>Edit</a>'. '</li>';
         $view='<li role="presentation">' .modal_anchor(get_uri("purchase/modal_form/".$data->id), "<i class='fa fa-eye'></i>View Purchase", array("class" => "edit", "title" => "View purchase detail", "data-post-id" => $data->id)). '</li>';
         $delete='<li role="presentation" style="display:none">' .js_anchor("<i class='fa fa-times fa-fw'></i> Delete", array('title' => "Delete BOM", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("purchase/delete"), "data-action" => "delete")). '</li>';
         $add_payment='<li role="presentation">' . modal_anchor(get_uri("purchase/add_payment_form/".$data->id), "<i class='fa fa-plus-circle'></i> " . lang('add_payment'), array("title" => lang('add_payment'))) . '</li>';
         $view_payment='<li role="presentation">' . modal_anchor(get_uri("purchase/view_payment_modal_form/".$data->id), "<i class='fa fa-eye'></i> View Payment" , array("title" => "View Payment")) . '</li>';
//end 
        return array(
            $data->created_at,
            $data->reference_no,
            $supplier_data->name.' ( '.$supplier_data->company_name.' )',
            $purchase_status->title,
            $data->grand_total,
            $data->paid_amount,
            ($data->grand_total - $data->paid_amount),
            $payment_status->title,
            
           //darini 19-3
           ' <span class="dropdown inline-block">
           <button class="btn btn-default dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
               <i class="fa fa-cogs"></i>&nbsp;
               <span class="caret"></span>
           </button>
           
           <ul class="dropdown-menu pull-right" role="menu">' . $edit . $view .$delete .$add_payment. $view_payment. '</ul>'  //end
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

    function edit($purchase_id){
        $view_data  = array();

        $view_data['purchase_data'] = $this->Purchase_model->get_one($purchase_id);

        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['request']=$this->Purchase_request_model->get_all()->result();//darini 23-3
        $view_data['order']=$this->Purchase_order_model->get_all()->result();//darini 23-3
        $view_data['grn']=$this->Grn_model->get_all()->result();//darini 10-4
        $this->template->rander("purchase/edit", $view_data);
    }

    function updatepurchase(){
        $purchase_id = $this->input->post('purchase_id');

        $data = array();
        $data['warehouse_id'] = $this->input->post('warehouse_id');
        $data['supplier_id'] = $this->input->post('supplier_id');
        $data['item'] = count($this->input->post('code'));
        $data['total_qty'] = array_sum($this->input->post('qty'));
        $data['total_discount'] = $this->input->post('total_discount');
        //$data['total_tax'] = $this->input->post('order_tax');
        $data['request_number']=$this->input->post('request_number');//extra 23-3
        $data['request_order']=$this->input->post('request_order');//extra 23-3
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
         //changes
        $oldfilename = $this->input->post('old_file');
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){    
            if($oldfilename != NULL)
            {
                unlink('./files/timeline_files/purchase/'.$oldfilename);
            }
                
            $target_path = get_setting("timeline_file_path_purchase");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "purchase");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end
        $purchase_idy = $this->Purchase_model->save($data, $purchase_id);
        $purchase_id = $this->input->post('purchase_id');

        $product_id = array();
        $product_id = $this->input->post('id');

        $options = array();
        $options['purchase_id'] = $purchase_id;
        $product_purchase_data = $this->Productpurchase_model->get_details($options)->result();

        foreach($product_purchase_data as $purchasedata){
            $p_product_id   = $purchasedata->product_id;
            $p_warehouse_id = $purchasedata->warehouse_id;
            $p_product_qty  = $purchasedata->qty;

            // changes 22-3 $this->Productwarehouse_model->updatewhdata($p_warehouse_id, $p_product_id, $p_product_qty, 0);
            
            $this->Productpurchase_model->deleteProductPurchase($purchasedata->id);
            if($data['request_order']==1){
                $this->Purchaseorder_details_model-> updateremaingqty( $p_product_id,$data['request_number'],$p_product_qty);
            }else if($data['request_order']==2){
                $this->Purchase_request_details_model-> updateremaingqty( $p_product_id,$data['request_number'],$p_product_qty);
            }
        }
        
        for($j = 0; $j < count($item_qty); $j++){
            $purchase_data = array();
            $purchase_data['purchase_id'] = $purchase_id;
            $purchase_data['product_id']  = $product_id[$j];
            $purchase_data['qty']         = $item_qty[$j];
            $purchase_data['recieved']    = $item_qty[$j];
            $purchase_data['purchase_unit_id'] = 1;
            $purchase_data['net_unit_cost'] = $item_cost[$j];
            $purchase_data['tax_rate'] =  $item_tax_rate[$j];
            $purchase_data['tax'] = $item_tax[$j];
            $purchase_data['total'] = ($purchase_data['qty'] * $purchase_data['net_unit_cost'])+$item_tax[$j];
            $purchase_data['created_at'] = get_my_local_time();
            $purchase_data['updated_at'] = get_my_local_time();
            
            $warehouse_data = array();
            $warehouse_data['product_id'] = $product_id[$j];

            $pdata = $this->Products_model->get_one($product_id[$j]);

            $whid = $pdata->warehouse_id;

            if($whid){
                $warehouse_data['warehouse_id'] = $whid;
            }else{
                $warehouse_data['warehouse_id'] = $this->input->post('warehouse_id');
            }

            $purchase_data['warehouse_id'] = $warehouse_data['warehouse_id'];
            $this->Productpurchase_model->save($purchase_data);
 
           /* changes 22-3 $alreadyFound1 = $this->Productwarehouse_model->check_product($warehouse_data['warehouse_id'], $product_id[$j])->num_rows();

            if($alreadyFound1 > 0){
                $this->Productwarehouse_model->updatewhdata($warehouse_data['warehouse_id'], $product_id[$j], $item_qty[$j], 1);
            }else{
                $warehouse_data['qty'] = $item_qty[$j];
                $warehouse_data['price'] = $item_cost[$j];
                $warehouse_data['created_at'] = get_my_local_time();
                $warehouse_data['updated_at'] = get_my_local_time();
                $this->Productwarehouse_model->save($warehouse_data);
            }*/
        }

        
        if($data['request_order']==1){
            $product_purchase_data = $this->Purchase_request_details_model->getprdtdetails($data['request_number']);
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
        }else if($data['request_order']==2){
            $options = array();
            $options['purchase_order_id'] = $data['request_number'];
            $product_purchase_data = $this->Purchaseorder_details_model->get_details($options)->result();
            foreach($product_purchase_data as $prd){
                for($j = 0; $j < count($item_qty); $j++){
                    if($prd->product_id==$product_id[$j]){                    
                        $remaing_qty=$prd->remaining_qty-$item_qty[$j];                   
                        $update=array();
                        $update['remaining_qty']= $remaing_qty;
                        $this->Purchaseorder_details_model->save($update,$prd->id);
                    }
                }
    
            }

        }



        $view_data = array();
        $view_data['success'] = 1;
        $view_data['purchase_data'] = $this->Purchase_model->get_one($purchase_id);
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();

        $this->template->rander("purchase/edit", $view_data);
    }

    function modal_form($purchase_id)
    {
        $view_data = array();
        
        $view_data['model_info'] = $this->Purchase_model->get_one($purchase_id);
        $this->load->view('purchase/modal_form', $view_data);
    }

  //darini 19-3
  function add_payment_form($id){
    $view_data = array();        
    $view_data['model_info'] = $this->Purchase_model->get_one($id);       
    $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
    $view_data['account']=$this->AccountingModel->get_account_list();
    $this->load->view('purchase/payment_modal_form', $view_data);
}
function edit_payment_modal_form($id,$purchase_id){
    
     $view_data = array();        
     $view_data['model_info'] = $this->Purchase_model->get_one($purchase_id);       
     $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
     $view_data['account']=$this->AccountingModel->get_account_list();
     $view_data['payments_info']=$this->Payments->get_one($id);
     $view_data['payments_info_cheque']=$this->Payment_cheque->getPaymentdetails($id);
     $this->load->view('purchase/edit_payment_modal', $view_data);
 }
function view_payment_modal_form($save_id){
    $view_data = array();        
    $view_data['model_info'] = $this->Purchase_model->get_one($save_id);            
    $view_data['payments_info']=$this->Payments->getPaymentsofPurchase($save_id);
    $this->load->view('purchase/view_payment_modal', $view_data);

}


function  add_payment(){
    $purchase_id = $this->input->post('purchase_id');
    $grand_total = $this->input->post('grand_total');
    $data=array();
    $data['payment_reference'] = 'ppr-' . date("Ymd") . '-'. date("his");
    $data['user_id'] = $this->login_user->id;
    $data['purchase_id']= $this->input->post('purchase_id');      
    $data['account_id'] =$this->input->post('account_id');
    $paying_amount =$this->input->post('paying_amount');
    $paid_amount =$this->input->post('paid_amount');
    $data['amount']= $paid_amount ;
    $data['change']=$paying_amount - $paid_amount ;
    $data['paying_method']=$this->input->post('paid_by_id');
    $data['payment_note']=$this->input->post('payment_note');
    $data['created_at'] = get_my_local_time();
    $data['updated_at'] = get_my_local_time();
    $save_id=$this->Payments->save($data);

    //echo json_encode($data);

    if($save_id){
        if($data['paying_method']==5){
            $cheque_data=array();
            $cheque_data['payment_id']= $save_id;
            $cheque_data['cheque_no']=$this->input->post('cheque_no');
            $cheque_data['created_at'] = get_my_local_time();
            $cheque_data['updated_at'] = get_my_local_time();
            $save_id_ch=$this->Payment_cheque->save($cheque_data);

        }else{
            $save_id_ch=TRUE;
        }
    }
    if($save_id){
        $purchase_data=array();
        
        $purchase_data['paid_amount']=($this->input->post('last_paid_amount')+ $paid_amount );
        $balance=$grand_total- $purchase_data['paid_amount'];
        if($balance > 0 || $balance < 0){
            $purchase_data['payment_status']=2;
        }else if($balance == 0){
            $purchase_data['payment_status']=4;
        }
        $save_id_purchase = $this->Purchase_model->save($purchase_data,$purchase_id);
    }
    if( $save_id_purchase){                     
            echo json_encode(array("success" => true,   'message' => lang('record_saved')));
     } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
     }
        


}

function  edit_payment(){

    
    
    $purchase_id = $this->input->post('purchase_id');
    $grand_total = $this->input->post('grand_total');
    $payment_id= $this->input->post('payment_id');
    $last_paid=$this->input->post('last_paid_amount');
    $totalpaid=$this->input->post('last_paid_amount_total');
    $paying_amount =$this->input->post('paying_amount');
    $paid_amount =$this->input->post('paid_amount');
    $lastpayment_method =$this->input->post('previous_payment_method');
    $cheque_id =$this->input->post('cheque_id');

    $amount_diff=$last_paid - $paid_amount;
    $purchase_paid= $totalpaid-$amount_diff;


   


    $data=array();
    
    $data['user_id'] = $this->login_user->id;
    $data['purchase_id']= $this->input->post('purchase_id');      
    $data['account_id'] =$this->input->post('account_id');
   
    $data['amount']= $paid_amount ;
    $data['change']=$paying_amount - $paid_amount ;
    $data['paying_method']=$this->input->post('paid_by_id');
    $data['payment_note']=$this->input->post('payment_note');
    
    $data['updated_at'] = get_my_local_time();
    $save_id=$this->Payments->save($data,$payment_id);

    //echo json_encode($data);

    if($save_id){
        if($data['paying_method']==5){

            if($lastpayment_method ==$data['paying_method']){

                $cheque_data=array();
             
                $cheque_data['cheque_no']=$this->input->post('cheque_no');
               
                $cheque_data['updated_at'] = get_my_local_time();
                $save_id_ch=$this->Payment_cheque->save($cheque_data, $cheque_id);
            }else{
                $cheque_data=array();
                $cheque_data['payment_id']= $save_id;
                $cheque_data['cheque_no']=$this->input->post('cheque_no');
                $cheque_data['created_at'] = get_my_local_time();
                $cheque_data['updated_at'] = get_my_local_time();
                $save_id_ch=$this->Payment_cheque->save($cheque_data);
            }
        }
    }
    if($save_id){
        $purchase_data=array();
        
        $purchase_data['paid_amount']=$purchase_paid;
        $balance=$grand_total- $purchase_data['paid_amount'];
        if($balance > 0 || $balance < 0){
            $purchase_data['payment_status']=2;
        }else if($balance == 0){
            $purchase_data['payment_status']=4;
        }
        $save_id_purchase = $this->Purchase_model->save($purchase_data,$purchase_id);
    }
    if( $save_id_purchase){                     
            echo json_encode(array("success" => true,   'message' => lang('record_saved')));
     } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
     }
        


}

function deletePayment($payment_id){
    $payments_info=$this->Payments->get_one($payment_id);
    $purchase= $this->Purchase_model->get_one( $payments_info->purchase_id);     
    $purchase_data=array();
    $purchase_data['paid_amount']= $purchase->paid_amount-$payments_info->amount;
    $balance= $purchase->grand_total- $purchase_data['paid_amount'];
     if($balance > 0 || $balance < 0){
             $purchase_data['payment_status']=2;
     }else if($balance == 0){
             $purchase_data['payment_status']=4;
     }
   
     $save_id_purchase = $this->Purchase_model->save($purchase_data,$payments_info->purchase_id);

     if($payments_info->paying_method==5){
         $cheque_data=$this->Payment_cheque->getPaymentdetails($payment_id);
         $this->Payment_cheque->deletepaymentCheque($cheque_data[0]->id);

     }
     if($this->Payments->deletepayment($payment_id)){
        echo json_encode(array("success" => true,   'message' => lang('record_deleted')));
         
     } else {
        echo json_encode(array("success" => true,   'message' => lang('record_cannot_be_deleted')));
      
     }



 }
 //end

 //darini 22-3
 function getprdt($purchase_id){

    $purchaseorder=$this->Purchase_order_model->get_one($purchase_id);
    $view_data['supplier_id']=$purchaseorder->supplier_id;
    $options = array();
    $options['purchase_order_id'] = $purchase_id;
    $product_purchase_data = $this->Purchaseorder_details_model->get_details($options)->result();
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
        $data["remaining_qty"]=$prd->remaining_qty;
        $result[]=  $data;
    }
    $view_data['data_array']=$result;
    echo json_encode( $view_data);
   //echo json_encode($product_purchase_data);
 }

 //darini 10-4

 function getprtdetgrn($grn_id){

    $purchaseorder=$this->Grn_model->get_one($grn_id);
    $view_data['supplier_id']=$purchaseorder->supplier_id;
    $options = array();
    $options['grn_id'] = $grn_id;
    $product_grn_data = $this->Productgrn_model->get_details($options)->result();
    $result=array();
    foreach($product_grn_data as $prd){
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
    $view_data['data_array']=$result;
    echo json_encode($view_data);
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
function get_all_products(){  
    $data = array();
    $data = $this->Products_model->get_al()->result();
    $newdata = array();
    foreach($data as $d){
        $newdata['id'] = $d->id;
    }

    echo json_encode($newdata, JSON_PRETTY_PRINT);
}

 //end
}