<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_payment extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $view_data = array();
        $view_data["currencies_dropdown1"] = $this->_get_currencies_dropdown1();
        $view_data["custom_field_headers"] = $this->Custom_fields_model->get_custom_field_headers_for_table("product_purchases", $this->login_user->is_admin, $this->login_user->user_type);
        $this->template->rander("report/payment/index", $view_data);
    }

    function yearly() {
        $this->load->view("report/payment/yearly");
    }

    function custom() {
        $this->load->view("report/payment/custom_list");
    }

    function list_data() { 
        $options = array(
            "start_date" => $this->input->post("start_date"),
            "end_date" => $this->input->post("end_date"),
            "payment_method_id" => $this->input->post("payment_method")
        );
       
        $list_data = $this->Invoice_payments_model->get_details($options)->result();
        
        $result = array();

        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {

        $option = array();
        $option["product_id"] = $data->product_id;

        $client_data = $this->Clients_model->get_one($data->created_by);
        $payment_method_data = $this->Payment_methods_model->get_one($data->payment_method_id);

        $client_name     = "";
        $client_name     = $client_data->company_name;
        $transaction_data = ($data->transaction_id)?($data->transaction_id) : "";
        
        $row_data = array($data->payment_date,
            $data->amount,
            $payment_method_data->title,
            $transaction_data,
            $client_name
        );      

        return $row_data;
    } 
    protected function _get_currencies_dropdown1() {
        $used_currencies = $this->Invoices_model->get_used_currencies_of_client()->result();

        if ($used_currencies) {
            $default_currency = get_setting("default_currency");

            $currencies_dropdown1 = array(
                array("id" => "", "text" => "- " . lang("currency") . " -"),
                array("id" => $default_currency, "text" => $default_currency) // add default currency
            );

            foreach ($used_currencies as $currency) {
                $currencies_dropdown1[] = array("id" => $currency->currency, "text" => $currency->currency);
            }

            return json_encode($currencies_dropdown1);
        }
    }

    
}
