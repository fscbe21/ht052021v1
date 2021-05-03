<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Production_processing extends MY_Controller {

    function __construct(){

        parent::__construct();
    }

    function index() {

      // echo  $work_order_id;
    }

    function show($work_order_id,$end_product_id,$product_id,$bom_id){


    $view_data['details']  = $this->Set_stages_model->get_details(array("work_order_id"=>$work_order_id,"end_product_id"=>$product_id))->result();  
    
    
    
    
    $view_data['work_order_id']=$work_order_id;
    
    $view_data['end_product_id']=$end_product_id;

    $view_data['product_id']=$product_id;

    $view_data['bom_id']=$bom_id;
    
    $this->template->rander("production_processing/index",$view_data);
    
}

function update_production_set_stages_start_time($work_order_id,$product_id,$process_id,$stage_id){

  echo  $this->Set_stages_model->update_start_time($work_order_id, $product_id, $process_id,$stage_id);

}


function fetch_production_set_stages_start_time($work_order_id,$product_id,$process_id,$stage_id){

    echo  json_encode($this->Set_stages_model->fetch_start_time($work_order_id, $product_id, $process_id,$stage_id)->result());
  
  }


function update_production_set_stages_end_time($work_order_id,$product_id,$process_id,$stage_id){

    echo  $this->Set_stages_model->update_end_time($work_order_id, $product_id, $process_id,$stage_id);
  
  }


  function fetch_production_set_stages_end_time($work_order_id,$product_id,$process_id,$stage_id){

    echo  json_encode($this->Set_stages_model->fetch_end_time($work_order_id, $product_id, $process_id,$stage_id)->result());
  
  }

}