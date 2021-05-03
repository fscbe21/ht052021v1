<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Production_dc_outward extends MY_Controller {

    function __construct(){

        parent::__construct();
    }

    function index() {

        $this->template->rander("production_dc_outward/index");
    }

    function create() {
        $view_data['warehouse_all'] = $this->Warehouse_model->get_details()->result();
        $view_data['clients_all']   = $this->Clients_model->get_details()->result();
        $view_data['user_all']      = $this->Users_model->active_member();
        //$view_data['supplier_all']  = $this->Supplier_model->get_details()->result();
        $view_data['supplier_all']  = $this->Vendor_model->get_details()->result();
        $this->template->rander("production_dc_outward/create",$view_data);
    }

    function search($search_text){
        $data = array();
        $data = $this->Products_model->search_raw_material($search_text)->result();

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function save(){
        $data                           = array();
        $data['dc_type']                = $this->input->post('dc_type');
        $data['dc_no']                  = $this->input->post('dc_no');
        $data['dc_date']                = $this->input->post('dc_date');
        if($data['dc_type'] == 1){
            $data['work_order_no']      = $this->input->post('work_order_no');
            $data['work_order_date']    = $this->input->post('work_order_date');
            $data['sale_order_number']  = $this->input->post('sale_order_number');
            $data['from_warehouse']     = $this->input->post('from_warehouse');
            $data['to_warehouse']       = $this->input->post('to_warehouse');
            $data['shop_keeper_name']   = $this->input->post('shop_keeper_name');
            $data['process_incharge']   = $this->input->post('process_incharge');
            $data['reciever_name']      = $this->input->post('reciever_name');
            $data['customer_name']      = $this->input->post('customer_name');
            $data['vendor']             = $this->input->post('vendor');
            $data['delivery_type']      = $this->input->post('delivery_type');
            $data['reference_no']       = $this->input->post('reference_no');
            $data['reference']          = $this->input->post('reference');
            $data['vehicle_no']         = $this->input->post('vehicle_no');
            $data['vehicle_name']       = $this->input->post('vehicle_name');

            if($this->input->post('indent_id')){
                $data['indent_id']      = $this->input->post('indent_id');
            }
            
        }else if($data['dc_type'] == 2){
            $data['from_warehouse']     = $this->input->post('from_warehouse');
            $data['shop_keeper_name']   = $this->input->post('shop_keeper_name');
            $data['reciever_name']      = $this->input->post('reciever_name');
            $data['vendor']             = $this->input->post('vendor');
            $data['delivery_type']      = $this->input->post('delivery_type');
            $data['reference']          = $this->input->post('reference');
            $data['vehicle_no']         = $this->input->post('vehicle_no');
            $data['vehicle_name']       = $this->input->post('vehicle_name');

        }else if($data['dc_type'] == 3){
            $data['work_order_no']      = $this->input->post('work_order_no');
            $data['purchase_no']        = $this->input->post('purchase_no');
            $data['purchase_date']      = $this->input->post('purchase_date');
            $data['to_warehouse']       = $this->input->post('to_warehouse');
            $data['shop_keeper_name']   = $this->input->post('shop_keeper_name');
            $data['customer_name']      = $this->input->post('customer_name');
            $data['vendor']             = $this->input->post('vendor');
            $data['delivery_type']      = $this->input->post('delivery_type');
            $data['reference']          = $this->input->post('reference');
            $data['vehicle_no']         = $this->input->post('vehicle_no');
            $data['vehicle_name']       = $this->input->post('vehicle_name');
        }

        $dc_outward_id = $this->Dc_outward_model->save($data);

        $product_id_array           = array();
        $product_qty_array          = array();

        $product_id_array           = $this->input->post('id');
        $product_qty_array          = $this->input->post('qty');

        for($j = 0; $j < count($product_id_array); $j++){
            $product_details                    = array();
            $product_details['dc_outward_id']   = $dc_outward_id;
            $product_details['product_id']      = $product_id_array[$j];
            $product_details['qty']             = $product_qty_array[$j];
            $this->Dc_outward_details_model->save($product_details);

            if($data['dc_type'] == 1){

                $this->Productwarehouse_model->updatewhdata($data['from_warehouse'], $product_id_array[$j], $product_qty_array[$j], 0);
 
                $this->Productwarehouse_model->updatewhdata($data['to_warehouse'], $product_id_array[$j], $product_qty_array[$j], 1);
 
             }else if($data['dc_type'] == 2){
 
                $this->Productwarehouse_model->updatewhdata($data['from_warehouse'], $product_id_array[$j], $product_qty_array[$j], 0);
                 
             }else if($data['dc_type'] == 3){
                 $this->Productwarehouse_model->updatewhdata($data['to_warehouse'], $product_id_array[$j], $product_qty_array[$j], 1); 
             }

        }

        $view_data['success']       = 1;
        $view_data['warehouse_all'] = $this->Warehouse_model->get_details()->result();
        $view_data['clients_all']   = $this->Clients_model->get_details()->result();
        $view_data['user_all']      = $this->Users_model->active_member();
        //$view_data['supplier_all']  = $this->Supplier_model->get_details()->result();
        $view_data['supplier_all']  = $this->Vendor_model->get_details()->result();

        $this->template->rander("production_dc_outward/create",$view_data);
    }

    function list_data() {
        $list_data    = $this->Dc_outward_model->get_details()->result();
        $result       = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    function _row_data($id) {
        $options = array("id" => $id);
        $data    = $this->Dc_outward_model->get_details($options)->row();

        return $this->_make_row($data);
    }

    function _make_row($data) {

        $user_data = $this->Users_model->get_one($data->shop_keeper_name);
        $shop_keeper_name = $user_data->first_name.' '.$user_data->last_name;

        return array(
            $data->id,
            $data->dc_date,
            $data->work_order_no,
            $data->work_order_date,
            $shop_keeper_name,
            $data->reciever_name,
            '<a class="edit" href="production_dc_outward/edit/'.$data->id.'"><i class="fa fa-pencil"></i></a>'
            .modal_anchor(get_uri("production_dc_outward/view/".$data->id), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View DC outward detail", "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("production_dc_outward/delete"), "data-action" => "delete"))
        );
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');

        if ($this->input->post('undo')) {
            if ($this->Dc_outward_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Dc_outward_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    function edit($dc_outward_id, $ok=0){
        $view_data  = array();
        $options    = array();

        if($ok){
            $view_data['success'] = 1;
        }

        $options['outward_id']      = $dc_outward_id;
        $view_data['model_data']    = $this->Dc_outward_model->get_one($dc_outward_id);
        $view_data['model_detail']  = $this->Dc_outward_details_model->get_details($options)->result();
        $view_data['warehouse_all'] = $this->Warehouse_model->get_details()->result();
        $view_data['clients_all']   = $this->Clients_model->get_details()->result();
        $view_data['user_all']      = $this->Users_model->active_member();
       // $view_data['supplier_all']  = $this->Supplier_model->get_details()->result();
        $view_data['supplier_all']  = $this->Vendor_model->get_details()->result();
        $view_data['tax_all']       = $this->Taxes_model->get_all()->result();

        $this->template->rander("production_dc_outward/edit", $view_data);
    }

    function update(){
        $hidden_from_warehouse          = $this->input->post('hidden_from_warehouse');
        $hidden_to_warehouse            = $this->input->post('hidden_to_warehouse');
        $hidden_dc_type                 = $this->input->post('hidden_dc_type');
        $dc_outward_id                  = $this->input->post('dc_outward_id');

        $data                           = array();
        $data['dc_type']                = $this->input->post('dc_type');
        $data['dc_no']                  = $this->input->post('dc_no');
        $data['dc_date']                = $this->input->post('dc_date');

        if($data['dc_type'] == 1){
            $data['work_order_no']      = $this->input->post('work_order_no');
            $data['work_order_date']    = $this->input->post('work_order_date');
            $data['sale_order_number']  = $this->input->post('sale_order_number');
            $data['from_warehouse']     = $this->input->post('from_warehouse');
            $data['to_warehouse']       = $this->input->post('to_warehouse');
            $data['shop_keeper_name']   = $this->input->post('shop_keeper_name');
            $data['process_incharge']   = $this->input->post('process_incharge');
            $data['reciever_name']      = $this->input->post('reciever_name');
            $data['customer_name']      = $this->input->post('customer_name');
            $data['vendor']             = $this->input->post('vendor');
            $data['delivery_type']      = $this->input->post('delivery_type');
            $data['reference_no']       = $this->input->post('reference_no');
            $data['reference']          = $this->input->post('reference');
            $data['vehicle_no']         = $this->input->post('vehicle_no');
            $data['vehicle_name']       = $this->input->post('vehicle_name');
        }else if($data['dc_type'] == 2){
            $data['from_warehouse']     = $this->input->post('from_warehouse');
            $data['shop_keeper_name']   = $this->input->post('shop_keeper_name');
            $data['reciever_name']      = $this->input->post('reciever_name');
            $data['vendor']             = $this->input->post('vendor');
            $data['delivery_type']      = $this->input->post('delivery_type');
            $data['reference']          = $this->input->post('reference');
            $data['vehicle_no']         = $this->input->post('vehicle_no');
            $data['vehicle_name']       = $this->input->post('vehicle_name');

        }else if($data['dc_type'] == 3){
            $data['work_order_no']      = $this->input->post('work_order_no');
            $data['purchase_no']        = $this->input->post('purchase_no');
            $data['purchase_date']      = $this->input->post('purchase_date');
            $data['to_warehouse']       = $this->input->post('to_warehouse');
            $data['shop_keeper_name']   = $this->input->post('shop_keeper_name');
            $data['customer_name']      = $this->input->post('customer_name');
            $data['vendor']             = $this->input->post('vendor');
            $data['delivery_type']      = $this->input->post('delivery_type');
            $data['reference']          = $this->input->post('reference');
            $data['vehicle_no']         = $this->input->post('vehicle_no');
            $data['vehicle_name']       = $this->input->post('vehicle_name');
        }

        $this->Dc_outward_model->save($data, $dc_outward_id);

        $options                    = array();
        $options['outward_id']      = $dc_outward_id;
        $details                    = $this->Dc_outward_details_model
                                           ->get_details($options)
                                           ->result();
        
        foreach($details as $d){

            $product_qty  = $d->qty;
            $product_id   = $d->product_id;

            if($hidden_dc_type == 1){

               $this->Productwarehouse_model->updatewhdata($hidden_from_warehouse, $product_id, $product_qty, 1);

               $this->Productwarehouse_model->updatewhdata($hidden_to_warehouse, $product_id, $product_qty, 0);

            }else if($hidden_dc_type == 2){

               $this->Productwarehouse_model->updatewhdata($hidden_from_warehouse, $product_id, $product_qty, 1);
                
            }else if($hidden_dc_type == 3){
                $this->Productwarehouse_model->updatewhdata($hidden_to_warehouse, $product_id, $product_qty, 0); 
            }

            $this->Dc_outward_details_model->deleteEntry($d->id);

        }

        $product_id_array           = array();
        $product_qty_array          = array();

        $product_id_array           = $this->input->post('id');
        $product_qty_array          = $this->input->post('qty');

        for($j = 0; $j < count($product_id_array); $j++){
            $product_details                    = array();
            $product_details['dc_outward_id']   = $dc_outward_id;
            $product_details['product_id']      = $product_id_array[$j];
            $product_details['qty']             = $product_qty_array[$j];
            $this->Dc_outward_details_model->save($product_details);

            if($data['dc_type'] == 1){

                $this->Productwarehouse_model->updatewhdata($data['from_warehouse'], $product_id_array[$j], $product_qty_array[$j], 0);
 
                $this->Productwarehouse_model->updatewhdata($data['to_warehouse'], $product_id_array[$j], $product_qty_array[$j], 1);
 
             }else if($data['dc_type'] == 2){
 
                $this->Productwarehouse_model->updatewhdata($data['from_warehouse'], $product_id_array[$j], $product_qty_array[$j], 0);
                 
             }else if($data['dc_type'] == 3){
                 $this->Productwarehouse_model->updatewhdata($data['to_warehouse'], $product_id_array[$j], $product_qty_array[$j], 1); 
             }

        }

        redirect('production_dc_outward/edit/'.$dc_outward_id.'/1');
    }

    /** AG2403 */
    function indent_to_dc_outward($work_order_id, $bom_id, $warehouse_id, $indent_id){
        $options = array();
        $options['work_order_id']  = $work_order_id;
        $options['bom_id']         = $bom_id;
        $options['warehouse_id']   = $warehouse_id;

        $view_data                    = array();
        $view_data['wo_info'] = $this->Work_order_model->get_one($work_order_id);
        $view_data['item_data']       = $this->Assignbom_model->get_details($options)->result();
        $view_data['warehouse_id']  = $warehouse_id;
        $view_data['warehouse_all'] = $this->Warehouse_model->get_details()->result();
        $view_data['clients_all']   = $this->Clients_model->get_details()->result();
        $view_data['user_all']      = $this->Users_model->active_member();
        //$view_data['supplier_all']  = $this->Supplier_model->get_details()->result();
        $view_data['supplier_all']  = $this->Vendor_model->get_details()->result();
        $view_data['tax_all']       = $this->Taxes_model->get_all()->result();
        $view_data['indent_id']     = $indent_id;

        //$view_data['indent_data']   = $this->Indent_model->get_one($indent_id);
    
        $this->template->rander("production/view_production/from_indent", $view_data);
    }
      //29-3
      function view($id){
        $view_data = array();        
        $view_data['model_info'] = $this->Dc_outward_model->get_one($id);
        $this->load->view('production_dc_outward/modal_form', $view_data);
    }

}