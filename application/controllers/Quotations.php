<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quotations extends MY_Controller {

    function __construct() {
        parent::__construct();
      //  $this->access_only_admin();
    }

    function index() {
        $this->template->rander("quotations/index");
    }

    function create(){
       $view_data = array();
        /*$view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();*/

        $this->template->rander("quotations/create", $view_data);
    }

    function upload_file() {
        upload_file_to_temp();
    }

    /* check valid file for post */

    function validate_post_file() {
        return validate_post_file($this->input->post("file_name"));
    }


    /* download a file */

function download_file($id) {

    $file_info = $this->Quotations_model->get_one($id);

    $this->init_project_permission_checker($file_info->id);
    /* if (!$this->can_view_files()) {
        redirect("forbidden");
    } */

    //serilize the path
    $file_data = serialize(array(array("files" => $file_info->id . "/" . $file_info->files)));

    //delete the file
    download_app_files(get_setting("timeline_file_path"), $file_data);
}


    function savequotation(){


        //R.V01_03S
$target_path = get_setting("timeline_file_path");

$files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "Quotation_file");
//R.V01_03E
        $data = array();
      
       
        $data['quotation_no'] = $this->input->post('quotation_no');
        $data['date'] = $this->input->post('date');
        $data['purchase_req_no'] = $this->input->post('purchase_req_no');
        $data['file_name'] = $this->input->post('file_name');
       
        $data = clean_data($data);
        $data["files"] = $files_data;

        $this->Quotations_model->save($data);

     

        $view_data = array();
        $view_data['success'] = 1;
        $this->template->rander("quotations/create", $view_data);
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');
        if ($this->input->post('undo')) {
            if ($this->Quotations_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Quotations_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Quotations_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    function list_data() {
        $list_data = $this->Quotations_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {
        /*$supplier_data = $this->Supplier_model->get_one($data->supplier_id);
        $purchase_status = $this->Purchase_status_model->get_one($data->status);
        $payment_status  = $this->Payment_status_model->get_one($data->payment_status);*/

        $file_icon = get_file_icon(strtolower(pathinfo($data->file_name, PATHINFO_EXTENSION)));
        $description = "<div class='pull-left'>" .
        js_anchor($data->files, array('title' => "", "data-toggle" => "app-modal", "data-sidebar" => "1", "data-url" => get_uri("projects/view_file/" . $data->id)));

if ($data->description) {
    $description .= "<br /><span>" . $data->description . "</span></div>";
} else {
    $description .= "</div>";
}



$options = anchor(get_uri("quotations/download_file/" . $data->id), "<i class='fa fa fa-cloud-download'></i>", array("title" => lang("download")));
        return array(
            $data->id,
            $data->quotation_no,
            $data->	date,
            $data->purchase_req_no,
            $data->	file_name,
            
            //$options
            anchor(get_uri("quotations/download_file/" . $data->id), "<i class='fa fa fa-cloud-download'></i>", array("title" => lang("download")))
            ,
           //"<div class='fa fa-$file_icon font-22 mr10 pull-left'></div>" . unserialize($description),
            
           // $data->	files,
            '<a class="edit" href="quotations/edit/'.$data->id.'"><i class="fa fa-pencil"></i></a>'

            .modal_anchor(get_uri("quotations/modal_form/".$data->id), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View purchase detail", "data-post-id" => $data->id))

            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete BOM", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("quotations/delete"), "data-action" => "delete"))
        );
    }

   /* function upload_file() {
        upload_file_to_temp();
    }

    function validate_post_file() {
        return validate_post_file($this->input->post("file_name"));
    }*/

    function search($search_text){
        $data = array();
        $data = $this->Products_model->search($search_text)->result();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function edit($quotation_id){
        $view_data  = array();

        $view_data['quotation_data'] = $this->Quotations_model->get_one($quotation_id);

       /* $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();*/

        $this->template->rander("quotations/edit", $view_data);
    }

    function updatequotation(){

        $target_path = get_setting("timeline_file_path");

        $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "Quotation_file");
        //R.V01_03E

        $quotation_id = $this->input->post('quotation_id');

        $data = array();
        $data['quotation_no'] = $this->input->post('quotation_no');
        $data['date'] = $this->input->post('date');
        $data['purchase_req_no'] = $this->input->post('purchase_req_no');
        $data['file_name'] = $this->input->post('file_name');
        $data = clean_data($data);
        $data["files"] = $files_data;
     
        $quotation_idy = $this->Quotations_model->save($data, $quotation_id);
     

        $view_data = array();
        $view_data['success'] = 1;
        $view_data['quotation_data'] = $this->Quotations_model->get_one($quotation_id);
        /*
        $view_data['warehouse_all'] = $this->Warehouse_model->get_all()->result();
        $view_data['supplier_all'] = $this->Supplier_model->get_all()->result();
        $view_data['purchase_status_all'] = $this->Purchase_status_model->get_all()->result();
        $view_data['tax_all'] = $this->Taxes_model->get_all()->result();*/

        $this->template->rander("quotations/edit", $view_data);
    }

    function modal_form($quotation_id)
    {
        $view_data = array();
        
        $view_data['model_info'] = $this->Quotations_model->get_one($quotation_id);
        $this->load->view('quotations/modal_form', $view_data);
    }


}