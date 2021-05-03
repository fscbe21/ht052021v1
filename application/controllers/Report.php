<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function production_stock_report() {
        $this->template->rander("report/production_stock_report");
    }

    function productionStockReport(){
        $options = array();
        $options['warehouse_id'] = 7;
        $list_data = $this->Productwarehouse_model->get_details($options)->result();
        $result = array();
        $sl = 1;
        foreach ($list_data as $data) {
            $product_data  = $this->Products_model->get_one($data->product_id);
            $product_name  = $product_data->name;
            $product_code  = $product_data->code;

            $unit_data     = $this->Unit_model->get_one($product_data->unit_id);
            $unit_name     = $unit_data->name;

            $result[] = array(
                $sl++,
                $product_code,
                $product_name,
                ($data->qty > 0) ? $data->qty.' '.$unit_name : 0
            );
        }

        echo json_encode(array("data" => $result));
    }

    function warehouse_stock_report(){
        $view_data = array();
        $view_data['warehouse_list'] = $this->Warehouse_model->get_details()->result();
        $this->template->rander("report/warehouse_stock_report", $view_data);
    }

    function warehouseStockReport(){
        $warehouse_list = array();
        $warehouse_list = $this->Warehouse_model->get_details()->result();

        $product_list   = array();
        $product_list   = $this->Products_model->get_details()->result();

        $result = array();
        $sl = 1;
        $i  = 0;
        foreach ($product_list as $data) {
           
            $product_name  = $data->name;
            $product_code  = $data->code;

            $unit_data     = $this->Unit_model->get_one($data->unit_id);
            $unit_name     = $unit_data->name;

            $result[$i][]  = $sl++;
            $result[$i][]  = $product_code;
            $result[$i][]  = $product_name;

            foreach($warehouse_list as $wh){
                $qty = 0;
                $qty = $this->Productwarehouse_model->checkwhqty($wh->id, $data->id);
                $result[$i][]  = ($qty > 0) ? $qty.' '.$unit_name : 0;
            }

            $i++;
        }

        echo json_encode(array("data" => $result));
    }

    function vehicleInsuranceReport(){
        $this->template->rander("report/vehicle/vehicle_insurance");
    }

    function vehicleInsurance(){

        $from_date = $this->input->post("start_date"); 
        $to_date = $this->input->post("end_date");

        $options = array();
        $options['from_date'] = $from_date;
        $options['to_date']   = $to_date;

        $vehicles_data = array();
        $vehicles_data = $this->Vechicle_model->report_insurance($options)->result();

        $result = array();
        $i  = 1;
        $a_s = "<b><span style='color: red'>";
        $a_e = "</span></b>";

        foreach ($vehicles_data as $data) {

            if($data->insurance_t_date <= date('YYY-MM-DD')){
                $result[] = array(
                    $a_s.$i.$a_e,
                    $a_s.$data->v_number.$a_e,
                    $a_s.$data->v_model.$a_e,
                    $a_s.$data->v_name.$a_e,
                    $a_s.$data->insurance_t_date.$a_e
                );
            }else{
                $result[] = array(
                    $i,
                    $data->v_number,
                    $data->v_model,
                    $data->v_name,
                    $data->insurance_t_date
                );
            }
            

            $i++;
        }

        echo json_encode(array("data" => $result));
    }

    function transfer_products(){

        $from_date = $this->input->post("start_date"); 
        $to_date = $this->input->post("end_date");
        $from_warehouse = $this->input->post("from_warehouse"); 
        $to_warehouse = $this->input->post("to_warehouse");

        $options = array();
        $options['from_date']      = $from_date;
        $options['to_date']        = $to_date;
        //$options['from_warehouse'] = $from_warehouse;
        //$options['to_warehouse']   = $to_warehouse;

        $transfer_data = array();
        $transfer_data = $this->ProductTransfer->report_transfer($options)->result();

        $result = array();
        $i  = 1;

        foreach ($transfer_data as $data) {

            $product_data     = $this->Products_model->get_one($data->product_id);
            $product_name = $product_data->name;

            if($data->created_at <= date('Y-m-d')){
                $result[] = array(
                  $i,
                  $product_name,
                   $data->qty,
                   $data->total
                   
                );
            }else{
                $result[] = array(
                    $i,
                    $product_name,
                    $data->qty,
                  
                    $data->total
                );
            }
            

            $i++;
        }
        echo json_encode(array("data" => $result));
    }

    function yearly() {
        $this->load->view("report/vehicle/yearly");
    }

    function custom() {
        $this->load->view("report/vehicle/custom_list");
    }

    function transfer_report() {
        $this->template->rander("report/transfer/index");
    }

    function transfer_yearly() {
        $this->load->view("report/transfer/yearly");
    }

    function transfer_custom() {
        $this->load->view("report/transfer/custom_list");
    }

    function overall_stock_report() {
        $this->template->rander("report/overall_stock_report");
    }

    function overallStockReport(){
        
        $product_list = array();
        $product_list = $this->Products_model->get_details()->result();

        $result = array();
        $sl = 1;
        foreach ($product_list as $data) {
            $options = array();
            $options['product_id']   = $data->id;
            $options['warehouse_id'] = $this->input->post('warehouse_id');
            $list_data = $this->Productwarehouse_model->get_details($options)->result();
            $qty = 0;
            foreach($list_data as $ld){
                $qty += $ld->qty;
            }

            $unit_data     = $this->Unit_model->get_one($data->unit_id);
            $unit_name     = $unit_data->name;
            if($qty > 0){
            $result[] = array(
                $sl++,
                $data->code,
                $data->name,
                ($qty > 0) ? $qty.' '.$unit_name : 0
            );
        }

        }

        echo json_encode(array("data" => $result));
    }


}