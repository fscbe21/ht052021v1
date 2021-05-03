
<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_product extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $view_data = array();
        $view_data["custom_field_headers"] = $this->Custom_fields_model->get_custom_field_headers_for_table("products", $this->login_user->is_admin, $this->login_user->user_type);
        $this->template->rander("report/product/index", $view_data);
    }

    function yearly() {
        $this->load->view("report/product/yearly");
    }

    function custom() {
        $this->load->view("report/product/custom_list");
    }

    function list_data() {
        $start_date = $this->input->post("start_date"); 
        $end_date = $this->input->post("end_date");
        $warehouse_id = $this->input->post('warehouse_id');
        /* $options = array(
            "start_date" => $this->input->post("start_date"),
            "end_date" => $this->input->post("end_date"),
            "warehouse_id" => $this->input->post("warehouse")
        ); */
       
        $list_data = $this->Products_model->get_details()->result();
        
        $result = array();

        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $start_date, $end_date, $warehouse_id);
        
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data, $start_date, $end_date, $warehouse_id) {

        $option = array();
        $option["product_id"] = $data->id;
        $option['start_date'] = $start_date;
        $option['end_date']   = $end_date;
        $option['warehouse_id'] = $warehouse_id;

        $purchase_data = array();
        $purchase_data = $this->Productpurchase_model->get_details($option)->result();

        $optio = array();
        $optio['product_id'] = $data->id;
        $optio['warehouse_id'] = $warehouse_id;

        $instock_data = array();
        $instock_data = $this->Productwarehouse_model->get_details($optio)->result();

        $purchase_qty = 0;
        $purchase_amount = 0;
        $instock_total = 0;

        foreach($purchase_data as $pd){
            $purchase_qty += $pd->qty;
            $purchase_amount += $pd->total;
        }

        foreach($instock_data as $instock){
            $instock_total += $instock->qty;
        }

        $row_data = array(
            get_product_name($data->id),
            $purchase_amount,
            $purchase_qty,
            $instock_total
        );      

        return $row_data;
    } 
    

}//<!-- NANDHINI 1604 -->
