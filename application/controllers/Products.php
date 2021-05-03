<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends MY_Controller {

    function __construct() {
        parent::__construct();
      //  $this->access_only_admin();
    }

    function index() {
        $this->template->rander("products/index");
    }

    function modal_form() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $view_data['product_type']   = $this->Producttype_model->get_all()->result();
        $view_data['brand_all']   = $this->Brand_model->get_all()->result();
        $view_data['unit_all']   = $this->Unit_model->get_all()->result();
        $view_data['tax_all']   = $this->Taxes_model->get_all()->result();
        $view_data['category_all']   = $this->Item_categories_model->get_all()->result();

        $view_data['warehouse_all']   = $this->Warehouse_model->get_all()->result();
        $view_data['barcode_symbology_all']   = $this->Barcodesymbology_model->get_all()->result();
        $view_data['model_info'] = $this->Products_model->get_one($this->input->post('id'));
        $this->load->view('products/modal_form', $view_data);
    }
    function modal_form_noimage() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $view_data['product_type']   = $this->Producttype_model->get_all()->result();
        $view_data['brand_all']   = $this->Brand_model->get_all()->result();
        $view_data['unit_all']   = $this->Unit_model->get_all()->result();
        $view_data['tax_all']   = $this->Taxes_model->get_all()->result();
        $view_data['category_all']   = $this->Item_categories_model->get_all()->result();

        $view_data['warehouse_all']   = $this->Warehouse_model->get_all()->result();
        $view_data['barcode_symbology_all']   = $this->Barcodesymbology_model->get_all()->result();
        $view_data['model_info'] = $this->Products_model->get_one($this->input->post('id'));
        $this->load->view('products/modal_form_noimage', $view_data);
    }
    function save() {

        $id = $this->input->post('id');

        $data = array(
            "name" => $this->input->post('name'),
            "type" => $this->input->post('type'),
            "code" => $this->input->post('code'),
            "barcode_symbology" => $this->input->post('barcode_symbology'),
            "brand_id" => $this->input->post('brand'),
            "category_id" => $this->input->post('category'),
            "unit_id" => $this->input->post('unit_id'),
            "purchase_unit_id" => $this->input->post('purchase_unit_id'),
            "sale_unit_id" => $this->input->post('sale_unit_id'),
            "cost" => $this->input->post('cost'),
            "price" => $this->input->post('price'),
            "alert_quantity" => $this->input->post('alert_quantity'),
            "warehouse_id" => $this->input->post('warehouse_id'),
            "tax_id" => $this->input->post('tax_id'),
            "tax_method" => $this->input->post('tax_method'),
            "updated_at" => get_current_utc_time()
        );

        $filenames = $this->input->post('file_names');
        $oldfilename = $this->input->post('oldimage');

        if(count($filenames) > 0){

            if($oldfilename != NULL)
            {
                unlink('./files/timeline_files/'.$oldfilename);
            }
            
            $target_path = get_setting("timeline_file_path");
            $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "products");
            $image_data = unserialize($files_data);
            $data['image'] = $image_data[0]['file_name'];
        }
        
        if($id){
            $save_id = $this->Products_model->save($data, $id);
        }else{
            $data['created_at'] = get_current_utc_time();
            $save_id = $this->Products_model->save($data);
        }
       
        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
        
    }
    function save_noimage() {

        $id = $this->input->post('id');

        $data = array(
            "name" => $this->input->post('name'),
            "type" => $this->input->post('type'),
            "code" => $this->input->post('code'),
            "barcode_symbology" => $this->input->post('barcode_symbology'),
            "brand_id" => $this->input->post('brand'),
            "category_id" => $this->input->post('category'),
            "unit_id" => $this->input->post('unit_id'),
            "purchase_unit_id" => $this->input->post('purchase_unit_id'),
            "sale_unit_id" => $this->input->post('sale_unit_id'),
            "cost" => $this->input->post('cost'),
            "price" => $this->input->post('price'),
            "alert_quantity" => $this->input->post('alert_quantity'),
            "warehouse_id" => $this->input->post('warehouse_id'),
            "tax_id" => $this->input->post('tax_id'),
            "tax_method" => $this->input->post('tax_method'),
            "updated_at" => get_current_utc_time()
        );

        
        if($id){
            $save_id = $this->Products_model->save($data, $id);
        }else{
            $data['created_at'] = get_current_utc_time();
            $save_id = $this->Products_model->save($data);
        }
       
        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
        
    }


    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));


        $id = $this->input->post('id');
        if ($this->input->post('undo')) {
            if ($this->Products_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Products_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    function list_data() {
        $list_data = $this->Products_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Products_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    private function _make_row($data) {
        $brand_data = $this->Brand_model->get_one($data->brand_id);
        $producttype_data = $this->Producttype_model->get_one($data->type);
        $category_data = $this->Item_categories_model->get_one($data->category_id);
        $unit_data = $this->Unit_model->get_one($data->unit_id); 

        return array(
            $data->image ? '<div class="text-center"><img class="img-rounded" src="../files/timeline_files/'.$data->image.'" width="90px"/></div>' : '<div class="text-center"><img src="../files/noimage.png" width="60px" height="50px"/></div>',
            $data->name,
            $data->code,
            $producttype_data->name,
            $category_data->title,
            $data->qty ? $data->qty : 0,
            $unit_data->name,
            $data->price,
            modal_anchor(get_uri("products/modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Product", "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete Product", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("products/delete"), "data-action" => "delete"))
        );
    }

    function upload_file() {
        upload_file_to_temp();
    }

    function validate_post_file() {
        return validate_post_file($this->input->post("file_name"));
    }

}