<?php
/* AG15042021 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Qcpass extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->template->rander("production/qcpass/index");
    }

    function list_data() {

        $list_data = $this->Set_process_model->get_qc_pass()->result();

        $result = array();
        foreach($list_data as $data) {
            $stages_data = array();
            $option = array();
            $option['work_order_id'] = $data->work_order_id;
            $option['end_product_id']= $data->end_product_id;

            $stages_data = $this->Set_stages_model->get_details($option)->result();

            $proceed = 1;

            if(count($stages_data) > 0){
                foreach($stages_data as $sd){
                    if(! $sd->start_date_time){
                        $proceed = 0;
                    }else{
                        if(! $sd->end_date_time){
                            $proceed = 0;
                        }
                    }
                }
            }else{
                $proceed = 0;
            }

            if($proceed){
                $result[] = $this->_make_row($data);
            }

        }

        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {
        $options = array();
        $options['work_order_no'] = $data->work_order_no;
        $options['end_product_id']= $data->end_product_id;

        $assign_bom_data = $this->Assignbom_model->get_details($options)->result();

        $button = "<a href='".get_uri()."production_processing/show/".$data->work_order_id."/".$assign_bom_data[0]->wo_product_id."/".$data->end_product_id."/".$assign_bom_data[0]->bom_id."'><button class='btn btn-md' style='background-color: #ff7675; color: #f5f6fa'>Quality Check</button></a>";

        return array(
            $data->work_order_id,
            $data->process_id,
            get_product_name($data->end_product_id),
            get_bom_name($assign_bom_data[0]->bom_id),
            $assign_bom_data[0]->qty,
            $button
        );
    }

}