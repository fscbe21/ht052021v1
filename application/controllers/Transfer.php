<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transfer extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->init_permission_checker("message_permission");
    }
    function index(){
          
        $this->template->rander("transfer/index");
    }
   
    function list_data(){
        $list_data = $this->TransferModel->gettransferlist();
        $result = array();
        foreach ($list_data as $data) {
             $result[] = $this->_make_row($data);
         }
         echo json_encode(array("data" => $result));
  }

  function _make_row($data){
    $from_warehouse = $this->Warehouse_model->get_one($data->from_warehouse_id);
    $to_warehouse = $this->Warehouse_model->get_one($data->to_warehouse_id);
    $edit='<li role="presentation">' .'<a class="edit" href="transfer/edit/'.$data->id.'"><i class="fa fa-pencil"></i>Edit</a></li>';
    $view='<li role="presentation">' .modal_anchor(get_uri("transfer/view_transfer/".$data->id), "<i class='fa fa-eye'></i>View Transfer", array("class" => "edit", "title" => "View Transfer detail", "data-post-id" => $data->id)).'</li>';
    $delete='<li role="presentation">' .js_anchor("<i class='fa fa-times fa-fw'></i> ". lang('delete'), array('title' => "Delete Transfer", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("transfer/delete"), "data-action" => "delete-confirmation")).'</li>';
    if($data->status==1){
           $status="Completed";
            $status_color="Green";
    }else if($data->status==2){
      $status="Pending";
      $status_color="#ffc107";
    }else if($data->status==3){
      $status="Sent";
      $status_color="#ffc107";
    }
    return array(
      $data->created_at,
      $data->reference_no,
      $from_warehouse->name,
      $to_warehouse ->name,
      $data->total_cost,
      $data->total_tax,
      $data->grand_total,
      '<span style="background-color:'.$status_color.' ;padding:3px; color:white;border-radius: .25rem;font-size: 11px;" >'.$status.'</span>',
       
      ' <span class="dropdown inline-block">
      <button class="btn btn-default dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
          <i class="fa fa-cogs"></i>&nbsp;
          <span class="caret"></span>
      </button>
      
      <ul class="dropdown-menu pull-right" role="menu">' . $edit . $view .$delete .$add_payment. $view_payment. '</ul>'
      

      
    );


  }

  function add_transfer(){
    $view_data=array();
    $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
    $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
    $this->template->rander("transfer/add_transfer",$view_data);
  }
  function edit($sales_id){
        
    $view_data['info']=$this->TransferModel->get_one($sales_id);
    $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
    $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
    $this->template->rander("transfer/edit_transfer",$view_data);  
}

  function view_transfer($id){
    $view_data=array();
    $view_data['model_info'] = $this->TransferModel->get_one($id);
    $this->load->view('transfer/view_transfer', $view_data);
  }

  function save(){
     $data=array(); 
     $data['reference_no'] = 'tr-' . date("Ymd") . '-'. date("his");
     $data['user_id'] = $this->login_user->id;
     $data['status']=$this->input->post('status');
     $data['from_warehouse_id']=$this->input->post('warehouse_id_from');
     $data['to_warehouse_id']=$this->input->post('warehouse_id_to');
     $data['item'] = count($this->input->post('code'));
     $data['total_qty'] = $this->input->post('total_qty');       
     $data['total_tax'] = $this->input->post('total_tax');      
     $data['total_cost'] = $this->input->post('total_price');
     $data['shipping_cost'] = $this->input->post('shipping_cost');   
     $data['grand_total'] = $this->input->post('grand_total');                  
     $data['note'] = $this->input->post('note');  
     $data['created_at'] = get_my_local_time();
     $data['updated_at'] = get_my_local_time();

     $save_id=$this->TransferModel->save($data);
    // return $save_id;

     

    $item_qty = array();
     $item_cost =array();
     $product_id = array();
     $item_tax=array();
     $item_tax_rate=array();
    
     
     $item_tax= $this->input->post('tax');
     $item_tax_rate= $this->input->post('tax_rate');    
     $item_qty = $this->input->post('qty');
     $item_cost= $this->input->post('product_cost');
     $product_id = $this->input->post('id');
     $unit_code=array();
     $unit_code=$this->input->post('unit-code');

     for($j = 0; $j < count($item_qty); $j++){
         $sales_data = array();
         $sales_data['transfer_id'] = $save_id;
         $sales_data['product_id']  = $product_id[$j];
         $sales_data['qty']         = $item_qty[$j];           
         $sales_data['purchase_unit_id'] = $unit_code[$j];
         $sales_data['net_unit_cost'] = $item_cost[$j];          
         $sales_data['tax_rate'] = $item_tax_rate[$j];
         $sales_data['tax'] =$item_tax[$j];
         $sales_data['total'] = (($sales_data['qty'] * $sales_data['net_unit_cost'])+$sales_data['tax']);
         $sales_data['created_at'] = get_my_local_time();
         $sales_data['updated_at'] = get_my_local_time();    
         
         $this->Productwarehouse_model->updateqtyminus( $data['from_warehouse_id'],$product_id[$j], $item_qty[$j]);


        
         if($data['status'] == 1){
          $warehouse_data = array();
          $warehouse_data['product_id'] = $product_id[$j];
          $warehouse_data['warehouse_id'] = $this->input->post('warehouse_id_to');
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

         
        }
        $id=$this->ProductTransfer->save($sales_data);

     }

     if($id){
      $this->session->set_flashdata("success_message", lang("record_saved"));
      redirect("transfer");
     } else {
      $this->session->set_flashdata("error_message", lang("error_occurred"));
      redirect("transfer");   
   }

  }

  function updatetransfer(){

    $transfer_id = $this->input->post('transfer_id');
    $old_wid_from= $this->input->post('warehouse_id_from_old');
    $old_wid_to= $this->input->post('warehouse_id_to_old');

    $data=array();    
    $data['user_id'] = $this->login_user->id;
    $data['status']=$this->input->post('status');
    $data['from_warehouse_id']=$this->input->post('warehouse_id_from');
    $data['to_warehouse_id']=$this->input->post('warehouse_id_to');
    $data['item'] = count($this->input->post('code'));
    $data['total_qty'] = $this->input->post('total_qty');       
    $data['total_tax'] = $this->input->post('total_tax');      
    $data['total_cost'] = $this->input->post('total_price');
    $data['shipping_cost'] = $this->input->post('shipping_cost');   
    $data['grand_total'] = $this->input->post('grand_total');                  
    $data['note'] = $this->input->post('note');     
    $data['updated_at'] = get_my_local_time();

    $save_id=$this->TransferModel->save($data,$transfer_id);

    

    $item_qty = array();
    $item_cost =array();
    $product_id = array();
    $item_tax=array();
    $item_tax_rate=array();
   
    
    $item_tax= $this->input->post('tax');
    $item_tax_rate= $this->input->post('tax_rate');    
    $item_qty = $this->input->post('qty');
    $item_cost= $this->input->post('product_cost');
    $product_id = $this->input->post('id');
    $unit_code=array();
    $unit_code=$this->input->post('unit-code');

    $product_sales_data = $this->ProductTransfer->transfer_product_list( $transfer_id); 
                                                
        foreach($product_sales_data as $bdata){

            $p_product_id   = $bdata->product_id;
           
            $p_product_qty  = $bdata->qty;
            
            $this->Productwarehouse_model->updateqtyps($old_wid_from, $p_product_id, $p_product_qty);
            $this->Productwarehouse_model->updateqtyminus($old_wid_to, $p_product_id, $p_product_qty);            
            $this->ProductTransfer->deleteProductTransfer($bdata->id);
        }

        for($j = 0; $j < count($item_qty); $j++){
          $sales_data = array();
          $sales_data['transfer_id'] = $save_id;
          $sales_data['product_id']  = $product_id[$j];
          $sales_data['qty']         = $item_qty[$j];           
          $sales_data['purchase_unit_id'] = $unit_code[$j];
          $sales_data['net_unit_cost'] = $item_cost[$j];          
          $sales_data['tax_rate'] = $item_tax_rate[$j];
          $sales_data['tax'] =$item_tax[$j];
          $sales_data['total'] = (($sales_data['qty'] * $sales_data['net_unit_cost'])+$sales_data['tax']);
          $sales_data['created_at'] = get_my_local_time();
          $sales_data['updated_at'] = get_my_local_time();    
          
          $this->Productwarehouse_model->updateqtyminus( $data['from_warehouse_id'],$product_id[$j], $item_qty[$j]);
 
 
         
          if($data['status'] == 1){
           $warehouse_data = array();
           $warehouse_data['product_id'] = $product_id[$j];
           $warehouse_data['warehouse_id'] = $this->input->post('warehouse_id_to');
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
 
          
         }
         $id=$this->ProductTransfer->save($sales_data);
 
      }

        if($id){
            $this->session->set_flashdata("success_message", lang("record_saved"));
            redirect("transfer");
        } else {
            $this->session->set_flashdata("error_message", lang("error_occurred"));
            redirect("transfer");   
       }

  }

  function delete() {
    validate_submitted_data(array(
        "id" => "numeric|required"
        
    ));

    $id = $this->input->post('id');
    $wid = $this->TransferModel->get_one($id );
    $product_sales_data = $this->ProductTransfer->transfer_product_list( $id); 
                                            
    foreach($product_sales_data as $bdata){
        $p_product_id   = $bdata->product_id;           
        $p_product_qty  = $bdata->qty;   
       // return   $p_product_id.  $p_product_qty .$wid;     
       $this->Productwarehouse_model->updateqtyps($wid->from_warehouse_id, $p_product_id, $p_product_qty);
       $this->Productwarehouse_model->updateqtyminus($wid->to_warehouse_id, $p_product_id, $p_product_qty);         
       $this->ProductTransfer->deleteProductTransfer($bdata->id);
    }

    if ($this->TransferModel->deleteTransfer($id)) {
        echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
    } else {
        echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
    }
    
  

}


  
   
}

?>