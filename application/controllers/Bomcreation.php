<?php
/* AG10032021 - INITIAL CREATION */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bomcreation extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->access_only_admin();
    }

    function index() {
        $this->template->rander("production/bomindex");
    }

    function create() {
        $view_data = array();
        $view_data['end_product_list'] = $this->Bom_model->end_product_list()->result();

        $this->template->rander("production/bomcreate", $view_data);
    }
    

    function search($search_text, $endproductid){

        $endproductid = (int)$endproductid;

        if($endproductid != 0){
            $proddata = array();
            $proddata = $this->Products_model->get_one($endproductid);
            $type = $proddata->type;
        }else{
            $type = 0;
        }

        $data = array();
        $data = $this->Bom_model->searchbom($search_text, $type)->result();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function get_unit_name($unit_id){
        $unit_id = (int)$unit_id;
        $unitdata = $this->Unit_model->get_one($unit_id);
        echo json_encode($unitdata, JSON_PRETTY_PRINT);
    }

    function savebomcreation(){
        $data = array();
        $data['created_by']  = $this->login_user->id;
        $data['name']        = trim($this->input->post('bom_name'));
        $data['end_product'] = $this->input->post('bom_product_type');

        $end_product_type         = $this->input->post('bom_product_type');
        $product_type_data        = $this->Products_model->get_one($end_product_type);
        $data['end_product_type'] = $product_type_data->type;
        
        $data['created_at']  = get_my_local_time();
        $data['updated_at']  = get_my_local_time();

        $bom_id = $this->Bom_model->save($data);

        $item_qty     = array();
        $item_weight  = array();
        $item_wastage = array();
        $item_unit    = array();
        /* $item_count    = array(); */

        $item_qty     = $this->input->post('qty');
        $item_weight  = $this->input->post('weight');
        $item_wastage = $this->input->post('wastage');
        $item_unit    = $this->input->post('unit');
        /* $item_count   = $this->input->post('quantity'); */

        $product_id   = array();
        $product_id   = $this->input->post('id');
        
        for($j = 0; $j < count($item_qty); $j++){
            $bom_detail_data                     = array();
            $bom_detail_data['bom_id']           = $bom_id;
            $bom_detail_data['product_id']       = $product_id[$j];
            $bom_detail_data['product_qty']      = $item_qty[$j];
            $bom_detail_data['product_unit']     = $item_unit[$j];
            $bom_detail_data['product_weight']   = $item_weight[$j];
            $bom_detail_data['product_wastage']  = $item_wastage[$j];
            /* $bom_detail_data['product_count']    = $item_count[$j]; */
            
            $this->Bomdetail_model->save($bom_detail_data);
        }

        $view_data = array();
        $view_data['success'] = 1;
        $this->template->rander("production/bomcreate", $view_data);
    }

    function list_data() {
        $list_data = $this->Bom_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Bom_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    private function _make_row($data) {
        $end_product_data = $this->Products_model->get_one($data->end_product);
        $end_product_name = $end_product_data->name;
        $end_producttype_data = $this->Producttype_model->get_one($data->end_product_type);
        $end_producttype_name = $end_producttype_data->name;

        return array(
            $data->id,
            $data->name,
            $end_product_name,
            $end_producttype_name,

            '<a class="edit" href="bomcreation/copybom/'.$data->id.'"><i class="fa fa-clone"></i></a>'
            
            .'<a class="edit" href="bomcreation/editbom/'.$data->id.'"><i class="fa fa-pencil"></i></a>'

            .modal_anchor(get_uri("bomcreation/modal_form_view_bom_details/".$data->id), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View BOM", "data-post-id" => $data->id))

            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete BOM", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("bomcreation/delete"), "data-action" => "delete"))
        );
    }

    function search_end_product($searchEndProduct){
        $data = array();
        $data = $this->Bom_model->search_end_product($searchEndProduct);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function modal_form_view_bom_details($bom_id){
        $data = array();
        $data['model_info'] = $this->Bom_model->get_one($bom_id);
        $this->load->view('production/modal_form_view_bom', $data);
    }

    function editbom($bom_id){
        $view_data = array();
        $view_data['bom_data'] = $this->Bom_model->get_one($bom_id);
        $this->template->rander("production/bomedit", $view_data);
    }

    function search_end_product_only($searchEndProduct, $type){
        $ddata = array();
        $ddata = $this->Products_model->get_one($type);
        $typee = $ddata->type;
        $data  = array();
        $data  = $this->Bom_model->search_end_product_only($searchEndProduct, $typee);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function updatebom(){
       $bom_data                 = array();
       $bom_id                   = $this->input->post('bom_id');
       $bom_data['name']         = trim($this->input->post('bom_name'));
       $bom_data['end_product']  = $this->input->post('bom_product_type');
       $end_product_type         = $this->input->post('bom_product_type');
       $product_type_data        = $this->Products_model->get_one($end_product_type);
       $bom_data['end_product_type'] = $product_type_data->type;
       $bom_data['updated_at']   = get_my_local_time();

       
       $rovalue = $this->Bomdetail_model->delete_all($bom_id);

       $update_bom = $this->Bom_model->save($bom_data, $bom_id);

       if($update_bom){
        $item_qty     = array();
        $item_weight  = array();
        $item_wastage = array();
        $item_unit    = array();
        /* $item_count   = array(); */

        $item_qty     = $this->input->post('qty');
        $item_weight  = $this->input->post('weight');
        $item_wastage = $this->input->post('wastage');
        $item_unit    = $this->input->post('unit');
        /* $item_count   = $this->input->post('quantity'); */

        $product_id   = array();
        $product_id   = $this->input->post('id');
        
        for($j = 0; $j < count($item_qty); $j++)
        {
            $bom_detail_data                     = array();
            $bom_detail_data['product_qty']      = $item_qty[$j];
            $bom_detail_data['product_unit']     = $item_unit[$j];
            $bom_detail_data['product_weight']   = $item_weight[$j];
            $bom_detail_data['product_wastage']  = $item_wastage[$j];
           /*  $bom_detail_data['product_count']    = $item_count[$j]; */
            $bom_detail_data['bom_id']           = $bom_id;
            $bom_detail_data['product_id']       = $product_id[$j];
            $this->Bomdetail_model->save($bom_detail_data);
        }

        $view_data = array();
        $view_data['success'] = 1;
        $view_data['bom_data'] = $this->Bom_model->get_one($bom_id);
        $this->template->rander("production/bomedit", $view_data);

       }

    }

    function copybom($bom_id)
    {
        $view_data = array();
        $view_data['bom_data'] = $this->Bom_model->get_one($bom_id);
        $this->template->rander("production/bomcopy", $view_data);
    }

    function copyandcreatebom(){
        $data = array();
        $data['created_by']  = $this->login_user->id;
        $data['name']        = trim($this->input->post('bom_name'));

        $data['end_product'] = $this->input->post('bom_product_type');

        $end_product_type         = $this->input->post('bom_product_type');
        $product_type_data        = $this->Products_model->get_one($end_product_type);
        $data['end_product_type'] = $product_type_data->type;
        
        $data['created_at']  = get_my_local_time();
        $data['updated_at']  = get_my_local_time();

        $bom_id = $this->Bom_model->save($data);

        $item_qty     = array();
        $item_weight  = array();
        $item_wastage = array();
        $item_unit    = array();
        /* $item_count   = array(); */

        $item_qty     = $this->input->post('qty');
        $item_weight  = $this->input->post('weight');
        $item_wastage = $this->input->post('wastage');
        $item_unit    = $this->input->post('unit');
        /* $item_count   = $this->input->post('quantity'); */

        $product_id   = array();
        $product_id   = $this->input->post('id');
        
        for($j = 0; $j < count($item_qty); $j++){
            $bom_detail_data                     = array();
            $bom_detail_data['bom_id']           = $bom_id;
            $bom_detail_data['product_id']       = $product_id[$j];
            $bom_detail_data['product_qty']      = $item_qty[$j];
            $bom_detail_data['product_unit']     = $item_unit[$j];
            $bom_detail_data['product_weight']   = $item_weight[$j];
            $bom_detail_data['product_wastage']  = $item_wastage[$j];
            /* $bom_detail_data['product_count']    = $item_count[$j]; */
            
            $this->Bomdetail_model->save($bom_detail_data);
        }

        $view_data = array();
        $view_data['success'] = 1;
        $view_data['bom_data'] = $this->Bom_model->get_one($bom_id);
        $this->template->rander("production/bomcopy", $view_data);
    }

    function delete() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));


        $id = $this->input->post('id');
        if ($this->input->post('undo')) {
            if ($this->Bom_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Bom_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }

    function check_bom_name($bomname){//AG2703QQQ
        $bomname = str_replace("%20"," ",$bomname);
        $data = $this->Bom_model->checkName($bomname);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }


}