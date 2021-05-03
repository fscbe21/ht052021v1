<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->init_permission_checker("message_permission");
    }
    function index(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-4";    
      
        $this->template->rander("sales/index",$view_data);
    }
    function add_sales(){
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['cust_all'] = $this->Clients_model->client_list();
        $view_data['bill'] = $this->Biller_model->get_all()->result();
        $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
        $view_data['order']=$this->SalesOrderModel->sales_order_list();
        $this->template->rander("sales/add_sales",$view_data);  
    }
    function list_data(){
          $list_data = $this->SalesModel->sales_list();
          $result = array();
          foreach ($list_data as $data) {
               $result[] = $this->_make_row($data);
           }
           echo json_encode(array("data" => $result));
    }

    function _make_row($data){
        $biller_data = $this->Biller_model->get_one($data->biller_id);
        $customer_id = $this->Clients_model->get_one($data->customer_id);
        $payment_status  = $this->Payment_status_model->get_one($data->payment_status);

        $edit='<li role="presentation">' .'<a class="edit" href="sales/edit/'.$data->id.'"><i class="fa fa-pencil"></i>Edit</a></li>';
        $view='<li role="presentation">' .modal_anchor(get_uri("sales/modal_form/".$data->id), "<i class='fa fa-eye'></i>View Sales", array("class" => "edit", "title" => "View Sales detail", "data-post-id" => $data->id)).'</li>';
        $delete='<li role="presentation">' .js_anchor("<i class='fa fa-times fa-fw'></i> ". lang('delete'), array('title' => "Delete Sales", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("sales/delete"), "data-action" => "delete-confirmation")).'</li>';
        $add_payment='<li role="presentation">' . modal_anchor(get_uri("sales/payment_modal_form/".$data->id), "<i class='fa fa-plus-circle'></i> " . lang('add_payment'), array("title" => lang('add_payment'))) . '</li>';
        $view_payment='<li role="presentation">' . modal_anchor(get_uri("sales/view_payment_modal_form/".$data->id), "<i class='fa fa-eye'></i> View Payment" , array("title" => "View Payment")) . '</li>';

        if($data->sale_status==1){
            $status="Completed";
            $status_color="Green";
        }else if($data->sale_status==2){
            $status="Pending";
            $status_color="Red";
        }

        if($data->payment_status==4){
            $payment_color="Green";
        }else if($data->payment_status==3){
            $payment_color="#ffc107";
        }else{
            $payment_color="Red";
        }
        return array(
            $data->created_at,
            $data->reference_no,
            $biller_data->name,
            $customer_id->company_name,
            '<span style="background-color:'.$status_color.' ;padding:3px; color:white;border-radius: .25rem;font-size: 11px;" >'.$status.'</span>',
            '<span style="background-color:'.$payment_color.' ;padding:3px; color:white;border-radius: .25rem;font-size: 11px;" >'.$payment_status->title.'</span>',
            
            $data->grand_total,
            $data->paid_amount,
            ($data->grand_total - $data->paid_amount),
            
            
            ' <span class="dropdown inline-block">
            <button class="btn btn-default dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-cogs"></i>&nbsp;
                <span class="caret"></span>
            </button>
            
            <ul class="dropdown-menu pull-right" role="menu">' . $edit . $view .$delete .$add_payment. $view_payment. '</ul>'
            

            

            
           
        );

    }
    function search($search_text){
        $data = array();
        $data = $this->Products_model->search($search_text)->result();
        echo json_encode($data, JSON_PRETTY_PRINT);

    }

    function prdctqty($wid=null,$pid=null){
        if(($this->input->post('pid'))){
            $wid=$this->input->post('wid');
            $pid=$this->input->post('pid');
        }
        $data=  $this->Productwarehouse_model->check_product($wid, $pid)->result();
        echo json_encode( $data, JSON_PRETTY_PRINT);
    }

    function save(){
        $data = array();
        $data['reference_no'] = 'sr-' . date("Ymd") . '-'. date("his");
        $data['user_id'] = $this->login_user->id;
        $data['customer_id'] = $this->input->post('customer_id');
        $data['warehouse_id'] = $this->input->post('warehouse_id');       
        $data['biller_id'] = $this->input->post('biller_id');
        $data['item'] = count($this->input->post('code'));
        $data['total_qty'] = $this->input->post('total_qty');       
        $data['total_tax'] = $this->input->post('total_tax');  
        $data['total_discount'] = $this->input->post('total_discount'); 
        $data['total_price'] = $this->input->post('total_price');
        $data['grand_total'] = $this->input->post('grand_total');              
        $data['order_tax_rate'] = $this->input->post('order_tax_rate_value');
        $data['order_tax']=  $this->input->post('order_tax');        
        $data['order_discount'] = $this->input->post('order_discount');
        $data['shipping_cost']=$this->input->post('shipping_cost');
        $data['sale_status']= $this->input->post('sale_status');
        $data['payment_status']= $this->input->post('payment_status');
        $data['paid_amount']=$this->input->post('paid_amount');
        $data['paid_by']=$this->input->post('paid_by_id');
        $data['sale_note']=$this->input->post('sale_note');
        $data['staff_note']=$this->input->post('staff_note');
        $data['created_at'] = get_my_local_time();
        $data['updated_at'] = get_my_local_time();
        $data['sales_order']=$this->input->post('sales_order');
        //changes 24-3
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){            
            $target_path = get_setting("timeline_file_path_sales");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "sales");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end
        $save_id = $this->SalesModel->save($data);

        if($data['payment_status'] == 3 || $data['payment_status'] == 4){
        $data_payment=array();
        $data_payment['payment_reference'] = 'spr-' . date("Ymd") . '-'. date("his");
        $data_payment['user_id'] = $this->login_user->id;
        $data_payment['sale_id']=  $save_id;      
        $data['account_id'] =$this->input->post('account_id');
        $paying_amount =$this->input->post('paying_amount');
        $paid_amount =$this->input->post('paid_amount');
        $data_payment['amount']= $data['paid_amount'] ;
        $data_payment['change']=$paying_amount - $paid_amount ;
        $data_payment['paying_method']=$this->input->post('paid_by_id');
        $data_payment['payment_note']=$this->input->post('payment_note');
        $data_payment['created_at'] = get_my_local_time();
        $data_payment['updated_at'] = get_my_local_time();
        $save_id_payment=$this->Payments->save($data_payment);

        //echo json_encode($data);

        if($save_id_payment){
            if($data_payment['paying_method']==5){
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
    }

        $item_qty = array();
        $item_cost =array();
        $product_id = array();
        $item_tax=array();
        $item_tax_rate=array();
        $item_discount=array();
        
        $item_tax= $this->input->post('tax');
        $item_tax_rate= $this->input->post('tax_rate');
        $item_discount=$this->input->post('discount');
        $item_qty = $this->input->post('qty');
        $item_cost= $this->input->post('product_cost');
        $product_id = $this->input->post('id');
        $unit_code=array();
        $unit_code=$this->input->post('unit-code');
        for($j = 0; $j < count($item_qty); $j++){
            $sales_data = array();
            $sales_data['sale_id'] = $save_id;
            $sales_data['product_id']  = $product_id[$j];
            $sales_data['qty']         = $item_qty[$j];           
            $sales_data['sale_unit_id'] = $unit_code[$j];
            $sales_data['net_unit_price'] = $item_cost[$j];
            $sales_data['discount']= $item_discount[$j];
            $sales_data['tax_rate'] = $item_tax_rate[$j];
            $sales_data['tax'] =$item_tax[$j];
            $sales_data['total'] = (($sales_data['qty'] * $sales_data['net_unit_price'])+$sales_data['tax'])-$sales_data['discount'];
            $sales_data['created_at'] = get_my_local_time();
            $sales_data['updated_at'] = get_my_local_time();

            $id=$this->ProductSales->save( $sales_data);

            if( $data['sale_status']==1){
                $product_warehouse_data= $this->Productwarehouse_model->check_product($data['warehouse_id'], $product_id[$j])->result();
                $qtytot=$product_warehouse_data[0]->qty;
                $totalq= ((int)$qtytot)-((int)$item_qty[$j]);
               //echo  $product_id[$j];
                //echo $data['warehouse_id'];
                $pid= $this->Productwarehouse_model->updateqty($data['warehouse_id'], $product_id[$j], $totalq);

            }
       }
       // $view_data = array();
        
        //$view_data['success'] = 1;
        
       // return $pid;
        //$this->template->rander("sales/index",$view_data);
         if($id){
            $this->session->set_flashdata("success_message", lang("record_saved"));
            redirect("sales");
         } else {
            $this->session->set_flashdata("error_message", lang("error_occurred"));
            redirect("sales");
         
         }
       
    }

    function modal_form($save_id)
    {
        $view_data = array();        
        $view_data['model_info'] = $this->SalesModel->get_one($save_id);
        $this->load->view('sales/modal_form', $view_data);
    }

    function edit($sales_id){

        $view_data['info']=$this->SalesModel->get_one($sales_id);
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['cust_all'] = $this->Clients_model->client_list();
        $view_data['bill'] = $this->Biller_model->get_all()->result();
        $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
        $view_data['order']=$this->SalesOrderModel->sales_order_list();
        $this->template->rander("sales/edit",$view_data);  
    }


    function update_sales(){
        $salesid = $this->input->post('sales_id');
        $old_wid= $this->input->post('warehouse_id_old');
       // echo $salesid.$old_wid;
      $data = array();
       
        $data['user_id'] = $this->login_user->id;
        $data['customer_id'] = $this->input->post('customer_id');
        $data['warehouse_id'] = $this->input->post('warehouse_id');       
        $data['biller_id'] = $this->input->post('biller_id');
        $data['item'] = count($this->input->post('code'));
        $data['total_qty'] = $this->input->post('total_qty');       
        $data['total_tax'] = $this->input->post('total_tax');  
        $data['total_discount'] = $this->input->post('total_discount'); 
        $data['total_price'] = $this->input->post('total_price');
        $data['grand_total'] = $this->input->post('grand_total');              
        $data['order_tax_rate'] = $this->input->post('order_tax_rate_value');
        $data['order_tax']=  $this->input->post('order_tax');        
        $data['order_discount'] = $this->input->post('order_discount');
        $data['shipping_cost']=$this->input->post('shipping_cost');
        $data['sale_status']= $this->input->post('sale_status');
        $data['payment_status']= $this->input->post('payment_status');
        $data['paid_amount']=$this->input->post('paid_amount');
        $data['paid_by']=$this->input->post('paid_by_id');
        $data['sale_note']=$this->input->post('sale_note');
        $data['staff_note']=$this->input->post('staff_note');
       
        $data['updated_at'] = get_my_local_time();
        //changes 24-3
        $oldfilename = $this->input->post('old_file');
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){    
            if($oldfilename != NULL)
            {
                unlink('./files/timeline_files/sales/'.$oldfilename);
            }
                    
            $target_path = get_setting("timeline_file_path_sales");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "sales");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end

       $save_id = $this->SalesModel->save($data,$salesid);

        $item_qty = array();
        $item_cost =array();
        $product_id = array();
        $item_tax=array();
        $item_tax_rate=array();
        $item_discount=array();
        
        $item_tax= $this->input->post('tax');
        $item_tax_rate= $this->input->post('tax_rate');
        $item_discount=$this->input->post('discount');
        $item_qty = $this->input->post('qty');
        $item_cost= $this->input->post('product_cost');
        $product_id = $this->input->post('id');
        $unit_code=array();
        $unit_code=$this->input->post('unit-code');
        
        $product_sales_data = $this->ProductSales->sales_product_list( $salesid); 
                                                
        foreach($product_sales_data as $bdata){

            $p_product_id   = $bdata->product_id;
           
            $p_product_qty  = $bdata->qty;
            if($old_wid== $data['warehouse_id'] ){
                $this->Productwarehouse_model->updateqtyps($data['warehouse_id'], $p_product_id, $p_product_qty);
                
                //echo $data['warehouse_id'];
            }else {
                $this->Productwarehouse_model->updateqtyps($old_wid, $p_product_id, $p_product_qty);
            }
            
            $this->ProductSales->deleteProductSales($bdata->id);
        }

        for($j = 0; $j < count($item_qty); $j++){
            $sales_data = array();
            $sales_data['sale_id'] = $save_id;
            $sales_data['product_id']  = $product_id[$j];
            $sales_data['qty']         = $item_qty[$j];           
            $sales_data['sale_unit_id'] = $unit_code[$j];
            $sales_data['net_unit_price'] = $item_cost[$j];
            $sales_data['discount']= $item_discount[$j];
            $sales_data['tax_rate'] = $item_tax_rate[$j];
            $sales_data['tax'] =$item_tax[$j];
            $sales_data['total'] = (($sales_data['qty'] * $sales_data['net_unit_price'])+$sales_data['tax'])-$sales_data['discount'];
            $sales_data['created_at'] = get_my_local_time();
            $sales_data['updated_at'] = get_my_local_time();

            $id=$this->ProductSales->save( $sales_data);

            if( $data['sale_status']==1){
                $product_warehouse_data= $this->Productwarehouse_model->check_product($data['warehouse_id'], $product_id[$j])->result();
                $qtytot=$product_warehouse_data[0]->qty;
                $totalq= ((int)$qtytot)-((int)$item_qty[$j]);
               //echo  $product_id[$j];
                //echo $data['warehouse_id'];
               $pid= $this->Productwarehouse_model->updateqty($data['warehouse_id'], $product_id[$j], $totalq);

            }


        }
        
       // return $pid;
       // $this->template->rander("sales/index",$view_data);
      /* if($id){
                echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_saved')));
        } else {
               echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
          }*/
          if($id){
            $this->session->set_flashdata("success_message", lang("record_saved"));
            redirect("sales");
         } else {
            $this->session->set_flashdata("error_message", lang("error_occurred"));
            redirect("sales");
         
         }
       
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
            
        ));

        $id = $this->input->post('id');
        $wid = $this->SalesModel->get_one($id );
        $product_sales_data = $this->ProductSales->sales_product_list( $id); 
                                                
        foreach($product_sales_data as $bdata){
            $p_product_id   = $bdata->product_id;           
            $p_product_qty  = $bdata->qty;   
           // return   $p_product_id.  $p_product_qty .$wid;     
            $this->Productwarehouse_model->updateqtyps($wid->warehouse_id, $p_product_id, $p_product_qty);
            $this->ProductSales->deleteProductSales($bdata->id);   
        }

        if ($this->SalesModel->deleteSales($id)) {
            echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }
        
      /*  if ($this->input->post('undo')) {
            if ($this->Products_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Products_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }*/

    }

    function payment_modal_form($save_id){
        $view_data = array();        
        $view_data['model_info'] = $this->SalesModel->get_one($save_id);       
        $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
        $view_data['account']=$this->AccountingModel->get_account_list();
        $this->load->view('sales/payment_modal_form', $view_data);
    }

    function edit_payment_modal_form($id,$sales_id){
       // $sales_id = $this->input->post('sales_id');
        //$id = $this->input->post('id');
        $view_data = array();        
        $view_data['model_info'] = $this->SalesModel->get_one($sales_id);       
        $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
        $view_data['account']=$this->AccountingModel->get_account_list();
        $view_data['payments_info']=$this->Payments->get_one($id);
        $view_data['payments_info_cheque']=$this->Payment_cheque->getPaymentdetails($id);
        $this->load->view('sales/edit_payment_model', $view_data);
    }

    function view_payment_modal_form($save_id){
        $view_data = array();        
        $view_data['model_info'] = $this->SalesModel->get_one($save_id);            
        $view_data['payments_info']=$this->Payments->getPayments($save_id);
        $this->load->view('sales/view_payment_modal', $view_data);

    }

    function  add_payment(){
        $sales_id = $this->input->post('sales_id');
        $grand_total = $this->input->post('grand_total');
        $data=array();
        $data['payment_reference'] = 'spr-' . date("Ymd") . '-'. date("his");
        $data['user_id'] = $this->login_user->id;
        $data['sale_id']= $this->input->post('sales_id');      
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
            $sales_data=array();
            
            $sales_data['paid_amount']=($this->input->post('last_paid_amount')+ $paid_amount );
            $balance=$grand_total- $sales_data['paid_amount'];
            if($balance > 0 || $balance < 0){
                $sales_data['payment_status']=2;
            }else if($balance == 0){
                $sales_data['payment_status']=4;
            }
            $save_id_sales = $this->SalesModel->save($sales_data,$sales_id);
        }
        if( $save_id_sales){                     
                echo json_encode(array("success" => true,   'message' => lang('record_saved')));
         } else {
                echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
         }
            


    }

    function  edit_payment(){

        
        
        $sales_id = $this->input->post('sales_id');
        $grand_total = $this->input->post('grand_total');
        $payment_id= $this->input->post('payment_id');
        $last_paid=$this->input->post('last_paid_amount');
        $totalpaid=$this->input->post('last_paid_amount_total');
        $paying_amount =$this->input->post('paying_amount');
        $paid_amount =$this->input->post('paid_amount');
        $lastpayment_method =$this->input->post('previous_payment_method');
        $cheque_id =$this->input->post('cheque_id');

        $amount_diff=$last_paid - $paid_amount;
        $sales_paid= $totalpaid-$amount_diff;


       


        $data=array();
        
        $data['user_id'] = $this->login_user->id;
        $data['sale_id']= $this->input->post('sales_id');      
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
            $sales_data=array();
            
            $sales_data['paid_amount']=$sales_paid;
            $balance=$grand_total- $sales_data['paid_amount'];
            if($balance > 0 || $balance < 0){
                $sales_data['payment_status']=2;
            }else if($balance == 0){
                $sales_data['payment_status']=4;
            }
            $save_id_sales = $this->SalesModel->save($sales_data,$sales_id);
        }
        if( $save_id_sales){                     
                echo json_encode(array("success" => true,   'message' => lang('record_saved')));
         } else {
                echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
         }
            


    }

    function deletePayment($payment_id){
       $payments_info=$this->Payments->get_one($payment_id);
       $sales= $this->SalesModel->get_one( $payments_info->sale_id);     
       $sales_data=array();
       $sales_data['paid_amount']= $sales->paid_amount-$payments_info->amount;
       $balance= $sales->grand_total- $sales_data['paid_amount'];
        if($balance > 0 || $balance < 0){
                $sales_data['payment_status']=2;
        }else if($balance == 0){
                $sales_data['payment_status']=4;
        }

        $save_id_sales = $this->SalesModel->save($sales_data,$payments_info->sale_id);

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
    function sample(){
        $data=$this->Payment_cheque->getPaymentdetails(1);
        echo "xx";
        echo json_encode($data);
    }
//changes 24
    function upload_file() {
        upload_file_to_temp();
    }

    function validate_post_file() {
        return validate_post_file($this->input->post("file_name"));
    }

    function getprdt($id){
        
        $product_purchase_data =  $this->ProductSalesOrder->salesorder_product_list( $id); 
        $result=array();
        foreach($product_purchase_data as $prd){
            $prdts=$this->Products_model->get_one($prd->product_id);
            $unit_data    = $this->Unit_model->get_one($prd->sale_unit_id);
            $unit_name    = $unit_data->name;
           // echo json_encode(  $prd);
            $data=array();
            $data["id"]=$prdts->id;
            $data["name"]=$prdts->name;
            $data["code"]=$prdts->code;
            $data["cost"]=$prd->net_unit_price; 
            $data["unit"]= $unit_name;
            $data["unit_id"]= $prd->sale_unit_id;
            $data["tax"]=$prd->tax;
            $data["tax_rate"]=$prd->tax_rate;
            $data["discount"]=$prd->discount;
            $data["tax_rate"]=$prd->tax_rate;
            $data["tax"]=$prd->tax;
            $data["total"]=$prd->total;
            $data["qty"]=$prd->qty;
            $result[]=  $data;
        }
        echo json_encode($result);
       //echo json_encode($product_purchase_data);
     }

   
}

?>