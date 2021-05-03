<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_return extends MY_Controller {

    function __construct() {
        parent::__construct();
 
    }
    function index(){        
        $this->template->rander("purchase_return/index");
    }

    function view($id){
        $view_data=array();
        $view_data['model_info'] = $this->PurchaseReturnModel->get_one($id);
        $this->load->view('purchase_return/view_return', $view_data);
    }

    function list_data(){
        $list_data = $this->PurchaseReturnModel->return_list();
         $result = array();
        foreach ($list_data as $data) {
              $result[] = $this->_make_row($data);
          }
          echo json_encode(array("data" => $result));
   }

   function _make_row($data){
       $supplier_data = $this->Supplier_model->get_one($data->supplier_id);       
       $warehouse = $this->Warehouse_model->get_one($data->warehouse_id);
       $acc = $this->AccountingModel->get_one($data->account_id);//1-4

       $edit='<li role="presentation">' .'<a class="edit" href="purchase_return/edit/'.$data->id.'"><i class="fa fa-pencil"></i>Edit</a></li>';
       $view='<li role="presentation">' .modal_anchor(get_uri("purchase_return/view/".$data->id), "<i class='fa fa-eye'></i>View Purchase Return", array("class" => "edit", "title" => "View Sales detail", "data-post-id" => $data->id)).'</li>';
       $delete='<li role="presentation">' .js_anchor("<i class='fa fa-times fa-fw'></i> ". lang('delete'), array('title' => "Delete Purchase Return", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("purchase_return/delete"), "data-action" => "delete-confirmation")).'</li>';
       
      
       return array(
           $data->created_at,
           $data->reference_no,
           $warehouse->name,           
           $supplier_data->name.' ( '.$supplier_data->company_name.' )',  
           $acc->name,    //1-4   
           $data->grand_total,                              
           ' <span class="dropdown inline-block">
           <button class="btn btn-default dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
               <i class="fa fa-cogs"></i>&nbsp;
               <span class="caret"></span>
           </button>
           
           <ul class="dropdown-menu pull-right" role="menu">' . $edit . $view .$delete .$add_payment. $view_payment. '</ul>'             
          
       );

   }

   function add_purchase_return(){
    $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
    $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
    $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
    $view_data['accounts']=$this->AccountingModel->get_account_list();//1-4
    $this->template->rander("purchase_return/add_purchase_return",$view_data);  
   }

   function edit($id){
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['info']=$this->PurchaseReturnModel->get_one($id);
        $view_data['accounts']=$this->AccountingModel->get_account_list();//1-4
        $this->template->rander("purchase_return/edit_purchase_return",$view_data);  
   }

   function save(){
    $data = array();
    $data['reference_no'] = 'prr-' . date("Ymd") . '-'. date("his");
    $data['user_id'] = $this->login_user->id;
    $data['supplier_id'] = $this->input->post('supplier_id');
    $data['warehouse_id'] = $this->input->post('warehouse_id'); 
    $data['account_id'] = $this->input->post('account_id');   //1-4       
    $data['item'] = count($this->input->post('code'));
    $data['total_qty'] = $this->input->post('total_qty');       
    $data['total_tax'] = $this->input->post('total_tax');  
    $data['total_discount'] = $this->input->post('total_discount'); 
    $data['total_cost'] = $this->input->post('total_price');
    $data['grand_total'] = $this->input->post('grand_total');              
    $data['order_tax_rate'] = $this->input->post('order_tax_rate_value');
    $data['order_tax']=  $this->input->post('order_tax');               
    $data['return_note']=$this->input->post('return_note');
    $data['staff_note']=$this->input->post('staff_note');
    $data['created_at'] = get_my_local_time();
    $data['updated_at'] = get_my_local_time();
     //changes 24-3
     $filenames = $this->input->post('file_names');
     if(count($filenames) > 0){            
         $target_path = get_setting("timeline_file_path_purchase_return");
         $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "purchase_return");
         $image_data = unserialize($files_data);
         $data['document'] = $image_data[0]['file_name'];
     }//end

    $save_id = $this->PurchaseReturnModel->save($data);

  

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
        $purchase_data = array();
        $purchase_data['return_id'] = $save_id;
        $purchase_data['product_id']  = $product_id[$j];
        $purchase_data['qty']         = $item_qty[$j];           
        $purchase_data['purchase_unit_id'] = $unit_code[$j];
        $purchase_data['net_unit_cost'] = $item_cost[$j];
        $purchase_data['discount']= $item_discount[$j];
        $purchase_data['tax_rate'] = $item_tax_rate[$j];
        $purchase_data['tax'] =$item_tax[$j];
        $purchase_data['total'] = (($purchase_data['qty'] * $purchase_data['net_unit_cost'])+$purchase_data['tax'])-$purchase_data['discount'];
        $purchase_data['created_at'] = get_my_local_time();
        $purchase_data['updated_at'] = get_my_local_time();

        $id=$this->ProductPurchaseReturn->save( $purchase_data);
        $pid= $this->Productwarehouse_model->updateqtyminus($data['warehouse_id'], $product_id[$j], $item_qty[$j]);

        
   }
   
     if($id){
        $this->session->set_flashdata("success_message", lang("record_saved"));
        redirect("purchase_return");
     } else {
        $this->session->set_flashdata("error_message", lang("error_occurred"));
        redirect("purchase_return");     
     }

   }

   function update(){
    $purchase_return_id = $this->input->post('purchase_return_id');
    $old_wid= $this->input->post('warehouse_id_old');
   // echo $salesid.$old_wid;
    $data = array();
   
    $data['user_id'] = $this->login_user->id;
    $data['supplier_id'] = $this->input->post('supplier_id');
    $data['warehouse_id'] = $this->input->post('warehouse_id');          
    $data['item'] = count($this->input->post('code'));
    $data['total_qty'] = $this->input->post('total_qty');       
    $data['total_tax'] = $this->input->post('total_tax');  
    $data['total_discount'] = $this->input->post('total_discount'); 
    $data['total_cost'] = $this->input->post('total_price');
    $data['grand_total'] = $this->input->post('grand_total');              
    $data['order_tax_rate'] = $this->input->post('order_tax_rate_value');
    $data['order_tax']=  $this->input->post('order_tax');               
    $data['return_note']=$this->input->post('return_note');
    $data['staff_note']=$this->input->post('staff_note');
    $data['account_id'] = $this->input->post('account_id');   //1-4
   
    $data['updated_at'] = get_my_local_time();
    //changes
    $oldfilename = $this->input->post('old_file');
    $filenames = $this->input->post('file_names');
    if(count($filenames) > 0){    
        if($oldfilename != NULL)
        {
            unlink('./files/timeline_files/purchase_return/'.$oldfilename);
        }
                
        $target_path = get_setting("timeline_file_path_purchase_return");
        $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "purchase_return");
        $image_data = unserialize($files_data);
        $data['document'] = $image_data[0]['file_name'];
    }//end
    $save_id = $this->PurchaseReturnModel->save($data,$purchase_return_id);

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
        
    $product_sales_data = $this->ProductPurchaseReturn->purchase_return_product_list($purchase_return_id);
                                            
    foreach($product_sales_data as $bdata){

        $p_product_id   = $bdata->product_id;
       
        $p_product_qty  = $bdata->qty;        
            $this->Productwarehouse_model->updateqtyps( $old_wid, $p_product_id, $p_product_qty);            
            $this->ProductPurchaseReturn->deleteProductPurchaseReturn($bdata->id);
     }
    
     for($j = 0; $j < count($item_qty); $j++){
         $purchase_data = array();
         $purchase_data['return_id'] = $save_id;
         $purchase_data['product_id']  = $product_id[$j];
         $purchase_data['qty']         = $item_qty[$j];           
         $purchase_data['purchase_unit_id'] = $unit_code[$j];
         $purchase_data['net_unit_cost'] = $item_cost[$j];
         $purchase_data['discount']= $item_discount[$j];
         $purchase_data['tax_rate'] = $item_tax_rate[$j];
         $purchase_data['tax'] =$item_tax[$j];
         $purchase_data['total'] = (($purchase_data['qty'] * $purchase_data['net_unit_cost'])+$purchase_data['tax'])-$purchase_data['discount'];
         $purchase_data['created_at'] = get_my_local_time();
         $purchase_data['updated_at'] = get_my_local_time();
 
         $id=$this->ProductPurchaseReturn->save( $purchase_data);
         $pid= $this->Productwarehouse_model->updateqtyminus($data['warehouse_id'], $product_id[$j], $item_qty[$j]);
 
         
    }

      if($id){
        $this->session->set_flashdata("success_message", lang("record_saved"));
        redirect("purchase_return");
     } else {
        $this->session->set_flashdata("error_message", lang("error_occurred"));
        redirect("purchase_return");
     
     }
   }

   function delete(){
    validate_submitted_data(array(
        "id" => "numeric|required"
        
    ));

    $id = $this->input->post('id');
    $wid = $this->PurchaseReturnModel->get_one($id );
      
    $product_sales_data = $this->ProductPurchaseReturn->purchase_return_product_list($id);
                                            
    foreach($product_sales_data as $bdata){
        $p_product_id   = $bdata->product_id;           
        $p_product_qty  = $bdata->qty;   
       // return   $p_product_id.  $p_product_qty .$wid;     
       $this->Productwarehouse_model->updateqtyps( $wid->warehouse_id, $p_product_id, $p_product_qty);            
       $this->ProductPurchaseReturn->deleteProductPurchaseReturn($bdata->id);
    }

    if ($this->PurchaseReturnModel->deletePurchaseReturn($id)) {
        echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
    } else {
        echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
    } 
   }

    
}

?>