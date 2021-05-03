<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale_return extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->init_permission_checker("message_permission");
    }
    function index(){   
        $this->template->rander("return/index");
    }
    function add_sales_return(){
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['cust_all'] = $this->Clients_model->client_list();
        $view_data['bill'] = $this->Biller_model->get_all()->result();
        $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
        $this->template->rander("return/add_sales_return",$view_data);  
    }
    function edit($id){
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['cust_all'] = $this->Clients_model->client_list();
        $view_data['bill'] = $this->Biller_model->get_all()->result();
        $view_data['payment_method']=$this->Payment_methods_model->get_all()->result();
        $view_data['info']=$this->ReturnModel->get_one($id);
        $this->template->rander("return/edit_sales_return",$view_data);  
    }

    function view($id){
        $view_data=array();
        $view_data['model_info'] = $this->ReturnModel->get_one($id);
        $this->load->view('return/view_sales_return', $view_data);
    }
    function list_data(){
         $list_data = $this->ReturnModel->return_list();
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
        $warehouse = $this->Warehouse_model->get_one($data->warehouse_id);
        $edit='<li role="presentation">' .'<a class="edit" href="sale_return/edit/'.$data->id.'"><i class="fa fa-pencil"></i>Edit</a></li>';
        $view='<li role="presentation">' .modal_anchor(get_uri("sale_return/view/".$data->id), "<i class='fa fa-eye'></i>View Sales Return", array("class" => "edit", "title" => "View Sales detail", "data-post-id" => $data->id)).'</li>';
        $delete='<li role="presentation">' .js_anchor("<i class='fa fa-times fa-fw'></i> ". lang('delete'), array('title' => "Delete Sales Return", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("sale_return/delete"), "data-action" => "delete-confirmation")).'</li>';
        
       
        return array(
            $data->created_at,
            $data->reference_no,
            $biller_data->name,
            $customer_id->company_name,
            $warehouse->name,
            $data->grand_total,
         
            
            
            ' <span class="dropdown inline-block">
            <button class="btn btn-default dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-cogs"></i>&nbsp;
                <span class="caret"></span>
            </button>
            
            <ul class="dropdown-menu pull-right" role="menu">' . $edit . $view .$delete .$add_payment. $view_payment. '</ul>'             
           
        );

    }

    function save(){
        $data = array();
        $data['reference_no'] = 'rr-' . date("Ymd") . '-'. date("his");
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
        $data['return_note']=$this->input->post('return_note');
        $data['staff_note']=$this->input->post('staff_note');
        $data['created_at'] = get_my_local_time();
        $data['updated_at'] = get_my_local_time();
        $data['account_id'] = 1; //1-4
        //changes 24-3
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){            
            $target_path = get_setting("timeline_file_path_sales_return");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "sales_return");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end
        $save_id = $this->ReturnModel->save($data);

      

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
            $sales_data['return_id'] = $save_id;
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

            $id=$this->ProductReturn->save( $sales_data);
            $pid= $this->Productwarehouse_model->updateqtyps($data['warehouse_id'], $product_id[$j], $item_qty[$j]);

            
       }
       // $view_data = array();
        
        //$view_data['success'] = 1;
        
       // return $pid;
        //$this->template->rander("sales/index",$view_data);
         if($id){
            $this->session->set_flashdata("success_message", lang("record_saved"));
            redirect("sale_return");
         } else {
            $this->session->set_flashdata("error_message", lang("error_occurred"));
            redirect("sale_return");
         
         }
    }

function update(){
    $sales_return_id = $this->input->post('sale_return_id');
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
        $data['return_note']=$this->input->post('return_note');
        $data['staff_note']=$this->input->post('staff_note');
      
        $data['updated_at'] = get_my_local_time();
        //changes 24-3
        $oldfilename = $this->input->post('old_file');
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){    
            if($oldfilename != NULL)
            {
                unlink('./files/timeline_files/sales_return/'.$oldfilename);
            }
                    
            $target_path = get_setting("timeline_file_path_sales_return");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "sales_return");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end
        $save_id = $this->ReturnModel->save($data,$sales_return_id);

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
        
        $product_sales_data =$this->ProductReturn->sales_return_product_list($sales_return_id); 
                                            
      foreach($product_sales_data as $bdata){

        $p_product_id   = $bdata->product_id;
       
        $p_product_qty  = $bdata->qty;        
            $this->Productwarehouse_model->updateqtyminus( $old_wid, $p_product_id, $p_product_qty);            
            $this->ProductReturn->deleteProductSalesReturn($bdata->id);
     }

     for($j = 0; $j < count($item_qty); $j++){
        $sales_data = array();
        $sales_data['return_id'] = $save_id;
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

        $id=$this->ProductReturn->save( $sales_data);
        $pid= $this->Productwarehouse_model->updateqtyps($data['warehouse_id'], $product_id[$j], $item_qty[$j]);

        
   }

      if($id){
        $this->session->set_flashdata("success_message", lang("record_saved"));
        redirect("sale_return");
     } else {
        $this->session->set_flashdata("error_message", lang("error_occurred"));
        redirect("sale_return");
     
     }


}

function delete(){
    validate_submitted_data(array(
        "id" => "numeric|required"
        
    ));

    $id = $this->input->post('id');
    $wid = $this->ReturnModel->get_one($id );
      
    $product_sales_data =$this->ProductReturn->sales_return_product_list($id); 
                                            
    foreach($product_sales_data as $bdata){
        $p_product_id   = $bdata->product_id;           
        $p_product_qty  = $bdata->qty;   
       // return   $p_product_id.  $p_product_qty .$wid;     
        $this->Productwarehouse_model->updateqtyminus($wid->warehouse_id, $p_product_id, $p_product_qty);
        $this->ProductReturn->deleteProductSalesReturn($bdata->id);
    }

    if ($this->ReturnModel->deleteSalesReturn($id)) {
        echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
    } else {
        echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
    }
    
}

   
}

?>