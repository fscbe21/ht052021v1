<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_request extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->access_only_admin();
    }

    function index() {

        $this->template->rander("purchase_request/index");

    }

    function create(){

   
        $view_data = array();
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['client_list'] =  $this->Clients_model->client_list();

        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();
        $view_data['customer_list'] = $this->Customer_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();

        $this->template->rander("purchase_request/create", $view_data);
    }

    function save(){

   
        $data = array();

        $data['prno'] = $this->input->post('purchase_request_number');
        $data['date'] = $this->input->post('purchase_request_date');
     
        $data['warehouse_id'] = $this->input->post('warehouse_id');
        $data['user_id'] = $this->input->post('user_id');
        $data['notes'] = $this->input->post('notes');
        $data['supplier_id'] = $this->input->post('supplier_id');
        $qty_array =array();
        $supplier_array = array();
        $product_array =array();
        $qty_array = $this->input->post('qty');
        $supplier_array = $this->input->post('vendor_field');
        $product_array = $this->input->post('id');
          //changes 24-3
        $filenames = $this->input->post('file_names');
        if(count($filenames) > 0){            
            $target_path = get_setting("timeline_file_path_purchase_request");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "purchase_request");
            $image_data = unserialize($files_data);
            $data['document'] = $image_data[0]['file_name'];
        }//end

        $purchase_request_id = $this->Purchase_request_model->save($data);

        $remarks =array();
        $remarks = $this->input->post('remarks');
        for($j = 0; $j < count($product_array); $j++){

            $purchase_request_details_data = array();
            $purchase_request_details_data['purchase_request_id'] = $purchase_request_id;
            $purchase_request_details_data['product_id']  = $product_array[$j];
            $purchase_request_details_data['qty']         = $qty_array[$j];
            $purchase_request_details_data['supplier_id']         = $supplier_array[$j];//changes 23-3
            $purchase_request_details_data['remarks']         =  $remarks[$j];
            $purchase_request_details_data['remaining_qty']=$qty_array[$j];//chenges 30-3

            $this->Purchase_request_details_model->save($purchase_request_details_data);
        }
        $update_id=array();
        $update_id['prno']= $purchase_request_id;

        $purchase_request= $this->Purchase_request_model->save($update_id,$purchase_request_id);

        $view_data = array();
        $view_data['success'] = 1;
        $this->template->rander("purchase_request/create", $view_data);
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');
        if ($this->input->post('undo')) {
            if ($this->Purchase_request_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Purchase_request_model->delete($id)) {
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
        $list_data = $this->Purchase_request_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {
        $warehouse_data = $this->Warehouse_model->get_one($data->warehouse_id);
        $user_data = $this->Customer_model->get_one($data->user_id);
       
        return array(
            $data->id,
            $data->date,
            $data->prno,
            $user_data->name,
            $warehouse_data->name,
            
            '<a class="edit" href="purchase_request/edit/'.$data->id.'"><i class="fa fa-pencil"></i></a>'

            .modal_anchor(get_uri("purchase_request/modal_form/".$data->id), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View Purchase Request detail", "data-post-id" => $data->id))

             //. js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete Data", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("purchase_request/delete"), "data-action" => "delete"))
        
           // modal_anchor(get_uri("purchase_request/modal_form/".$data->id), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View Purchase Request detail", "data-post-id" => $data->id))

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

        $view_data['purchase_data'] = $this->Purchase_request_model->get_one($purchase_id);

        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();
        $view_data['customer_list'] = $this->Customer_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();
        $view_data['client_list'] =  $this->Clients_model->client_list();

        $this->template->rander("purchase_request/edit", $view_data);
    }

    function updatepurchase(){
        $purchase_id = $this->input->post('purchase_request_id');

        $data = array();
        $data['prno'] = $this->input->post('prno');
        $data['user_id'] = $this->input->post('user_id');
        $data['date'] = $this->input->post('date');
        $data['warehouse_id'] = $this->input->post('warehouse_id');
        $data['notes'] = $this->input->post('notes');
        $data['supplier_id'] = $this->input->post('supplier_id');
          //changes
          $oldfilename = $this->input->post('old_file');
          $filenames = $this->input->post('file_names');
          if(count($filenames) > 0){    
              if($oldfilename != NULL)
              {
                  unlink('./files/timeline_files/purchase_request/'.$oldfilename);
              }
                  
              $target_path = get_setting("timeline_file_path_purchase_request");
              $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "purchase_request");
              $image_data = unserialize($files_data);
              $data['document'] = $image_data[0]['file_name'];
          }//end
        $purchase_idy = $this->Purchase_request_model->save($data, $purchase_id);
        $purchase_id = $this->input->post('purchase_request_id');

        $options = array();
        $options['purchase_request_id'] = $purchase_id;
        $product_purchase_data = $this->Purchase_request_details_model->get_details($options)->result();

        $qty_array =array();
        $supplier_array = array();
        $product_array =array();
        $qty_array = $this->input->post('qty');
        $supplier_array = $this->input->post('vendor_field');
        $product_array = $this->input->post('id');
        $remarks =array();
        $remarks = $this->input->post('remarks');
        
        foreach($product_purchase_data as $purchasedata){
            $p_product_id   = $purchasedata->product_id;         
            $p_product_qty  = $purchasedata->qty;            
            $this->Purchase_request_details_model->deleteProductRequest($purchasedata->id);
        }
        //changes 23-3
        for($j = 0; $j < count($product_array); $j++){

            $purchase_request_details_data = array();
            $purchase_request_details_data['purchase_request_id'] = $purchase_id;
            $purchase_request_details_data['product_id']  = $product_array[$j];
            $purchase_request_details_data['qty']         = $qty_array[$j];
            $purchase_request_details_data['supplier_id']         = $supplier_array[$j];//changes 23-3
            $purchase_request_details_data['remarks']         =  $remarks[$j];
            $purchase_request_details_data['remaining_qty']=$qty_array[$j];//chenges 30-3
            $this->Purchase_request_details_model->save($purchase_request_details_data);
           // echo json_encode( $purchase_request_details_data);
        }
//end

        $view_data = array();
        $view_data['success'] = 1;
        $view_data['purchase_data'] = $this->Purchase_model->get_one($purchase_id);
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();

        $this->template->rander("purchase_request/edit", $view_data);
       
    }

    function modal_form($purchase_id)
    {
        $view_data = array();
        
        $view_data['model_info'] = $this->Purchase_request_model->get_one($purchase_id);
        $this->load->view('purchase_request/modal_form', $view_data);
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


    /*function modal_form($id)
    {

        $view_data = array();

        
        $view_data['purchase_request'] = $this->Purchase_request_model->get_one($id);

        $view_data['purchase_request_details'] = $this->Purchase_request_details_model->get_details(array("purchase_request_id"=>$id))->result();


        $view_data['product_data']=array();

        

        $view_data['warehouse_data'] = $this->Warehouse_model->get_one($view_data['purchase_request']->warehouse_id);

        $view_data['user_data'] = $this->Customer_model->get_one($view_data['purchase_request']->user_id);


        $this->load->view('purchase_request/modal_form', $view_data);

    }*/


}