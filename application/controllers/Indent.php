<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Indent extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->access_only_admin();
    }

    function index($work_order_id=0, $end_product_id=0, $bom_id=0) {

        $view_data = array();
        $view_data['work_order_id']  = $work_order_id;
        $view_data['end_product_id'] = $end_product_id;
        $view_data['bom_id']         = $bom_id;

        $this->template->rander("production/indent/index", $view_data);

    }

    function list_data($work_order_id, $end_product_id, $bom_id) {

        if(($work_order_id != 0) && ($end_product_id != 0) && ($bom_id != 0)){

            $options = array();
            $options['work_order_id']  = $work_order_id;
            $options['end_product_id'] = $end_product_id;
            $options['bom_id']         = $bom_id;

            $list_data = $this->Indent_model->get_details($options)->result();
        }else{
            $list_data = $this->Indent_model->get_details()->result();
        }
        
        $result = array();
        $sn = 1;  //AG2403Q
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $sn++);
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data, $sl) {//AG2403Q
        $product_data     = $this->Products_model->get_one($data->end_product_id);
        $end_product_name = $product_data->name;

        $bom_data         = $this->Bom_model->get_one($data->bom_id);
        $bom_name         = $bom_data->name;

        $warehouse_data   = $this->Warehouse_model->get_one($data->warehouse_id);
        $warehouse_name   = $warehouse_data->name;

        $option                    = array();
        $option['indent_id']       = $data->id;
        $option['work_order_id']   = $data->work_order_id;
        $option['from_warehouse']  = $data->warehouse_id;

        $indent_data               = array();
        $indent_data               = $this->Dc_outward_model->get_details($option)->result();

        $ok                        = '';
        $dcrecordstatus            = 0;

        if(count($indent_data) > 0){
            $ok                    = "<br /><span class='text-success'>DC Outward Received</span>";
            $dcrecordstatus        = 1;

        } //R.V29_03_S
        else{
        if ($this->login_user->is_admin ||  get_array_value($this->login_user->permissions, "dc_outward"))        
        {

           // if($data->warehouse_id != 7)
           // {
                $ok = "<a href='".base_url()."index.php/production_dc_outward/indent_to_dc_outward/".$data->work_order_id."/".$data->bom_id."/".$data->warehouse_id."/".$data->id."'><i class='fa fa-shopping-basket' aria-hidden='true'></i></a>";
                $dcrecordstatus        = 0;
           // }
        }
    }
      //R.V29_03_E

      $vendor_data = $this->Vendor_model->get_one($data->vendor_id);

        return array(
            $sl,
            $data->work_order_id,
            $end_product_name,
            $bom_name,
            $vendor_data->name,
            $warehouse_name,
            $data->created_at,
            modal_anchor(get_uri("indent/modal_form"), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View Indent", "data-post-id" => $data->id, "data-post-workorderid" => $data->work_order_id, "data-post-bomid" => $data->bom_id,"data-post-warehouseid" => $data->warehouse_id, "data-post-dcrecordstatus" => $dcrecordstatus))
            .
            $ok
        );
    }

    function modal_form() {

        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $view_data['work_order_id'] = $this->input->post('workorderid');
        $view_data['bom_id']        = $this->input->post('bomid');
        $view_data['warehouse_id']  = $this->input->post('warehouseid');
        $view_data['dcrecordstatus'] = $this->input->post('dcrecordstatus');

        $view_data['model_data'] = $this->Indent_model->get_one($this->input->post('id'));
        $this->load->view('production/indent/modal_form', $view_data);
    }
    
}