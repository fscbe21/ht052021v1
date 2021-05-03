<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_order extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->init_permission_checker("message_permission");
    }
    function index(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-4";    
      
        $this->template->rander("sales_order/index",$view_data);
    }

    function add_sales(){
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['cust_all'] = $this->Clients_model->client_list();
        $view_data['bill'] = $this->Biller_model->get_all()->result();
        $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
        //$view_data['quotation']=$this->SalesQuotationModel->sales_quotation_list();
        $view_data['quotation'] = $this->SalesQuotationModel->sales_quoordno_list()->result();//R.V24_04
        $this->template->rander("sales_order/add_sales_order",$view_data);  
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
       // echo ($data[0]->qty);
      

    }

    function list_data(){
        $list_data = $this->SalesOrderModel->sales_order_list();
        $result = array();
        foreach ($list_data as $data) {
             $result[] = $this->_make_row($data);
         }
         echo json_encode(array("data" => $result));
  }

  function _make_row($data){
      $biller_data = $this->Biller_model->get_one($data->biller_id);
      $customer_id = $this->Clients_model->get_one($data->customer_id);
      //$payment_status  = $this->Payment_status_model->get_one($data->payment_status);
      $salesdata = array();
      //$op = array();
      //$op['sales_order'] = $data->id;
      $salesdata = $this->SalesModel->getdetails($data->id);

      if(count($salesdata) > 0){
          $salesFound = "Sale Created";
      }else{
          $salesFound = "Pending Sale";
      }


      $edit='<li role="presentation">' .'<a class="edit" href="sales_order/edit/'.$data->id.'"><i class="fa fa-pencil"></i>Edit</a></li>';
      $view='<li role="presentation">' .modal_anchor(get_uri("sales_order/modal_form/".$data->id), "<i class='fa fa-eye'></i>View Sales Order", array("class" => "edit", "title" => "View Sales detail", "data-post-id" => $data->id)).'</li>';
      $delete='<li role="presentation">' .js_anchor("<i class='fa fa-times fa-fw'></i> ". lang('delete'), array('title' => "Delete Sales Order", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("sales_order/delete"), "data-action" => "delete-confirmation")).'</li>';
     

      if($data->sale_status==1){
          $status="Completed";
          $status_color="Green";
      }else if($data->sale_status==2){
          $status="Pending";
          $status_color="Red";
      }

      
      return array(
          $data->id,
          $data->created_at,
          $data->reference_no,
          $biller_data->name,
          $customer_id->company_name,
          '<span style="background-color:'.$status_color.' ;padding:3px; color:white;border-radius: .25rem;font-size: 11px;" >'.$status.'</span>',         
          $data->grand_total, 
          $salesFound,     
          ' <span class="dropdown inline-block">
          <button class="btn btn-default dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-cogs"></i>&nbsp;
              <span class="caret"></span>
          </button>
          
          <ul class="dropdown-menu pull-right" role="menu">' . $edit . $view .$delete .'</ul>'
          

          

          
         
      );

  }
    function save(){



        $data = array();
        $data['reference_no'] = 'sor-' . date("Ymd") . '-'. date("his");
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
        $data['sale_note']=$this->input->post('sale_note');
        $data['staff_note']=$this->input->post('staff_note');
        $data['created_at'] = get_my_local_time();
        $data['updated_at'] = get_my_local_time();
        $data['sales_quotation']=$this->input->post('sales_quotation');
        $data['purchase_order_number']=$this->input->post('purchase_order_number');
        $data['sales_order_date']=$this->input->post('sales_order_date');
        //changes 24-3

        $data['order_type']=$this->input->post('order_type');//R.V24_04
        //changes 24-3
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){            
            $target_path = get_setting("timeline_file_path_sales_order");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "sales_order");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end
        $save_id = $this->SalesOrderModel->save($data);

        

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

            $id=$this->ProductSalesOrder->save( $sales_data);

          
       }
       // $view_data = array();
        
        //$view_data['success'] = 1;
        
       // return $pid;
        //$this->template->rander("sales/index",$view_data);
         if($id){
            $this->session->set_flashdata("success_message", lang("record_saved"));
            redirect("sales_order");
         } else {
            $this->session->set_flashdata("error_message", lang("error_occurred"));
            redirect("sales_order");
         
         }
       
    }
    function edit($sales_id){

        $view_data['info']=$this->SalesOrderModel->get_one($sales_id);
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['cust_all'] = $this->Clients_model->client_list();
        $view_data['bill'] = $this->Biller_model->get_all()->result();
        $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
        $view_data['quotation']=$this->SalesQuotationModel->sales_quotation_list();
        $this->template->rander("sales_order/edit",$view_data);  
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
        $data['sale_note']=$this->input->post('sale_note');
        $data['staff_note']=$this->input->post('staff_note');
        $data['purchase_order_number']=$this->input->post('purchase_order_number');
        $data['sales_order_date']=$this->input->post('sales_order_date');
       
        $data['updated_at'] = get_my_local_time();
        //changes 24-3
        $oldfilename = $this->input->post('old_file');
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){    
            if($oldfilename != NULL)
            {
                unlink('./files/timeline_files/sales_order/'.$oldfilename);
            }
                    
            $target_path = get_setting("timeline_file_path_sales_order");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "sales_order");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end

       $save_id = $this->SalesOrderModel->save($data,$salesid);

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
        
        $product_sales_data = $this->ProductSalesOrder->salesorder_product_list( $salesid); 
                                                
        foreach($product_sales_data as $bdata){

            $p_product_id   = $bdata->product_id;
           
            $p_product_qty  = $bdata->qty;
            
            $this->ProductSalesOrder->deleteProductSalesOrder($bdata->id);
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

            $id=$this->ProductSalesOrder->save( $sales_data);
        }
        
     
          if($id){
            $this->session->set_flashdata("success_message", lang("record_saved"));
            redirect("sales_order");
         } else {
            $this->session->set_flashdata("error_message", lang("error_occurred"));
            redirect("sales_order");
         
         }
       
    }

    function modal_form($save_id)
    {
        $view_data = array();        
        $view_data['model_info'] = $this->SalesOrderModel->get_one($save_id);
        $this->load->view('sales_order/modal_form', $view_data);
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
            
        ));

        $id = $this->input->post('id');
        $wid = $this->SalesOrderModel->get_one($id);
        $product_sales_data = $this->ProductSalesOrder->salesorder_product_list( $id); 
                                                
        foreach($product_sales_data as $bdata){
            $p_product_id   = $bdata->product_id;           
            $p_product_qty  = $bdata->qty;   
           
          
           $this->ProductSalesOrder->deleteProductSalesOrder($bdata->id);
        }

        if ($this->SalesOrderModel->deleteSalesOrder($id)) {
            echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }
        
    

    }

    function getprdt($id){
        
        $product_purchase_data = $this->ProductSalesQuotation->salesquotation_product_list( $id);

        $sales_quotation_data = $this->SalesQuotationModel->get_one($id); 
        $customer_id          = $sales_quotation_data->customer_id;

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
            $data['customer_id'] = $customer_id;
            $result[]=  $data;
        }
        echo json_encode($result);
       //echo json_encode($product_purchase_data);
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
}


?>