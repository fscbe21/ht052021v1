<?php
/** AG2103Q - INITIAL CREATION */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Viewproduction extends MY_Controller {

    function __construct() {
        parent::__construct();
      //  $this->access_only_admin();
    }

    function index() {
        $this->template->rander("production/view_production/index");
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Work_order_model->get_details($options)->row();
        return $this->_make_row($data, "");
    }

    function list_data() {
        $production_status = $this->input->post('production_status');

        $list_data = $this->Work_order_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $info = $this->_make_row($data, $production_status);
            if($info){
                $result[] = $this->_make_row($data, $production_status);
            }
        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data, $production_status) {

        $client_data   = $this->Clients_model->get_one($data->customer_id);
        $customer_name = $client_data->company_name;

        $prod_status = "";

        $date1 = date_create($data->start_date);
        $datet = date('Y-m-d', strtotime( $data->end_date." +1 days"));
        $date2 = date_create($datet);
        $diff  = date_diff($date1,$date2); 
        
        $op                  = array();
        $op['work_order_id'] = $data->id;
        
        $set_process_data    = array();
        $set_process_data    = $this->Set_process_model->get_details($op)->result();
        $set_stages_data     = array();
        $set_stages_data     = $this->Set_stages_model->get_details($op)->result();
        $setprocesscount     = count($set_process_data);
        $setstagescount      = count($set_stages_data);

        $completedcount      = 0;
        $status              = '';

        if($setprocesscount > 0){
            foreach($set_process_data as $setprocess){
                if($setprocess->status == 1){
                    $completedcount = $completedcount + 1;
                }
            }
        }

        $extra          = "<a class='delete' href='#'><i class='fa fa-pencil'></i></a> ";

        if(($setprocesscount == 0) || ($setstagescount == 0)){
            $status         = '<span class="btn btn-block" style="border-radius: 4px;color: #2d3436;background-color: #dfe6e9;padding: 5px;" >Pending</span>';
            $extra          = "<a href='".base_url()."index.php/work_order/edit/".$data->id."'><i class='fa fa-pencil'></i></a> ";
            $prod_status = "pending";
        }else if($setprocesscount == $completedcount){
            $status         = '<span class="btn btn-block" style="border-radius: 4px;color: #f7f1e3;background-color: #474787;padding: 5px;" >Completed</span>';
            $prod_status = "completed";
        }else if($completedcount != 0){
            $status         = '<span class="btn btn-block" style="border-radius: 4px;color: #2c2c54;background-color: #ffb142;padding: 5px;">Processing</span>';
            $prod_status = "processing";
        }else{
            $opt = array();
            $opt['work_order_id']    = $data->id;
            $stages_data             = array();
            $stages_data             = $this->Set_stages_model->get_details($opt)->result();
            $tot_rec = 0;
            $tot_rec = count($stages_data);
            $tot_com = 0;

            foreach($stages_data as $stdata)
            {
                if($stdata->start_date_time != '')
                {
                    $tot_com = $tot_com + 0.5;
                    if($stdata->end_date_time != '')
                    {
                        $tot_com = $tot_com + 0.5;
                    }
                }
            }

            if($tot_com > 0){
                $status         = '<span class="btn btn-block" style="border-radius: 4px;color: #2c2c54;background-color: #ffb142;padding: 5px;">Processing</span>';
                $prod_status = "processing";
            }else{
                $status         = '<span class="btn btn-block" style="width: 100%; border-radius: 4px;color: #f7f1e3;background-color: #ff5252;padding: 5px;" >Not Started</span>';
                $prod_status = "not_started";
            }
        }

        if($production_status != ""){
            if($production_status == $prod_status){
                return array(
                    $data->id,
                    $data->sales_order_number,
                    $data->date,
                    $customer_name,
                    $data->start_date,
                    $data->end_date,
                    $diff->format("%a day(s)"),
                    $status,

                    $extra.
                    modal_anchor(get_uri("viewproduction/modal_form"), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View", "data-post-workorderid" => $data->id))
        
                );
            }else{
                return NULL;
            }
        }else{

            return array(
                $data->id,
                $data->sales_order_number,
                $data->date,
                $customer_name,
                $data->start_date,
                $data->end_date,
                $diff->format("%a day(s)"),
                $status,

                $extra.
                modal_anchor(get_uri("viewproduction/modal_form"), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View", "data-post-workorderid" => $data->id))
    
            );

        }

    }

    function delete(){
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');
        if ($this->input->post('undo')) {
            if ($this->Work_order_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Work_order_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }
    

    function modal_form(){
        $data    = array();
        $options = array();
        $options['work_order_id']  = $this->input->post('workorderid');
        $data['work_order_detail'] = $this->Work_order_details_model->get_details($options)->result();
        
        $work_order_id             = $this->input->post('workorderid');
        $data['work_order_info']   = $this->Work_order_model->get_one($work_order_id);
        
        $this->load->view('production/view_production/modal_form', $data);
    }

    function indent_creation($work_order_id, $end_product_id, $bom_id){
        $warehouse = array();
        $warehouse = $this->Assignbom_model->get_unique_warehouse_list($work_order_id, $end_product_id, $bom_id);

        $opt = array();
        $opt['work_order_id']  = $work_order_id;
        $opt['end_product_id'] = $end_product_id;

        $setprocessdata = $this->Set_process_model->get_details($opt)->result();
        $vendor_id      = $setprocessdata[0]->vendor_id;

        
        foreach($warehouse as $whlist){
            $options = array();
            $options['work_order_id'] = $work_order_id;
            $options['end_product_id'] = $end_product_id;
            $options['bom_id'] = $bom_id;
            $options['warehouse_id'] = $whlist->warehouse_id;

            $indent = array();
            $indent['work_order_id'] = $work_order_id;
            $indent['end_product_id'] = $end_product_id;
            $indent['bom_id'] = $bom_id;
            $indent['vendor_id'] = $vendor_id;
            $indent['warehouse_id'] = $whlist->warehouse_id;
            $indent['created_at'] = get_my_local_time();
            
            $indent_id = $this->Indent_model->save($indent);

            $data  = array();
            $data  = $this->Assignbom_model->get_details($options)->result();

            foreach($data as $d){
                $savedetails = array();
                $savedetails['indent_id'] = $indent_id;
                $savedetails['product_id']= $d->product_id;
                $savedetails['qty'] = $d->qty;
                
                $this->Indent_details_model->save($savedetails);
            } 
        }

        //redirect("indent/index/".$work_order_id."/".$end_product_id."/".$bom_id);
        redirect("viewproduction");
    }

}