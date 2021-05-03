

<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_due extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $view_data = array();
        $view_data["custom_field_headers"] = $this->Custom_fields_model->get_custom_field_headers_for_table("invoices", $this->login_user->is_admin, $this->login_user->user_type);
        $this->template->rander("report/due/index", $view_data);
    }

    function yearly() {
        $this->load->view("report/due/yearly");
    }

    function custom() {
        $this->load->view("report/due/custom_list");
    }

    function list_data() {
        $start_date = $this->input->post("start_date"); 
        $end_date = $this->input->post("end_date"); 
        $options = array(
            "start_date" => $this->input->post("start_date"),
            "end_date" => $this->input->post("end_date")
        );
       
        $list_data = $this->Invoices_model->unique_id($options)->result();
        
        $result = array();

        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {

        $option = array();
        $option["invoice_id"] = $data->id;

        $client_data = $this->Clients_model->get_one($data->client_id);
        
        $payments_data       = $this->Invoice_payments_model->get_details($option)->result();
        $invoice_amount_data = $this->Invoice_items_model->get_details($option)->result();
       
        $client_name     = "";
        $client_name     = $client_data->company_name;
        $invoice_amount  = 0;
        $paid_amount     = 0;
        $due_amount      = 0;

        foreach($invoice_amount_data as $iad){
            $invoice_amount += $iad->total;
        }

        foreach($payments_data as $pd){
            $paid_amount += $pd->amount;
        }

        $due_amount = $invoice_amount-$paid_amount;

        $due_amount = ($due_amount > 0) ? "<span style='color: red'>".$due_amount."</span>" : "<span style='color: green'>".-$due_amount."</span>";
         
        $row_data = array($client_name,
        $invoice_amount,
        $paid_amount,
        $due_amount);      

        return $row_data;
    } 
}//<!-- NANDHINI 1704 -->
