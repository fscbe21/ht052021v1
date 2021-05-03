<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reuse extends MY_Controller {

    function __construct() {
parent::__construct();
    }


    function index() {
        $this->template->rander("production_processing/reuse/reuse_list");
    }

    function show($work_order_id,$end_product_id,$product_id,$bom_id,$qty,$qc_ok_qty,$process_id){   
        
        
        $view_data["work_order_id"] =$work_order_id;
        $view_data["end_product_id"] =$end_product_id;
        $view_data["product_id"] =$product_id;
        $view_data["bom_id"] =$bom_id;
        $view_data["qty"] =$qty;
        $view_data["qc_ok_qty"] =$qc_ok_qty;
        $view_data["process_id"] =$process_id;



        $view_data["bom_data"]=$this->Bom_model->get_one($bom_id);

        $view_data["end_product_data"]=$this->Products_model->get_one($end_product_id);

       


        $view_data["stages_data"]=$this->Set_stages_model->get_details(array("work_order_id" => $work_order_id,"end_product_id" => $product_id))->result();

        //$view_data['production_assign_bom_data']=$this->Assignbom_model->get_details(array("work_order_id"=>$work_order_id,"end_product_id"=>$end_product_id,"bom_id"=>$bom_id))->result();

        $view_data["bom_details_data"]=$this->Bomdetail_model->get_details(array("bom_id"=>$bom_id))->result();
        
        $this->template->rander("production_processing/reuse/index.php", $view_data);

    }


    function save(){

  
        $data['process_id'] = $this->input->post('process_id');
        $data['work_order_id'] = $this->input->post('work_order_id');
        $data['process_product_id'] = $this->input->post('process_product_id');
        $data['end_product_id'] = $this->input->post('end_product_id');
        $data['bom_id'] = $this->input->post('bom_id');
        $data['end_product_qty'] = $this->input->post('qty');

       $reuse_id = $this->Reuse_model->save($data);

       $product_id_array=$this->input->post('product_id');
       $total_qty_array=$this->input->post('total_qty');
       $working_qty_array=$this->input->post('working_qty');
       $wastage_qty_array=$this->input->post('wastage_qty');
       $stages_array=$this->input->post('stages');


       $qc_ok_total_qty_array=$this->input->post('qc_ok_total_qty');


       $this->Productwarehouse_model->updatewhdata(7,$data['process_product_id'],$this->input->post('process_product_qc_ok_qty'),1);


       foreach($product_id_array as $key=>$value){

       
        
        $this->Productwarehouse_model->updatewhdata(7,$value,$qc_ok_total_qty_array[$key],0);        

        $this->Productwarehouse_model->updatewhdata(7,$value,$wastage_qty_array[$key],0);

        $this->Productwarehouse_model->updatewhdata(3,$value,$wastage_qty_array[$key],1);

           $details['product_id']=$value;
           $details['total_qty']=$total_qty_array[$key];
           $details['working_qty']=$working_qty_array[$key];
           $details['wastage_qty']=$wastage_qty_array[$key];
           $details['stage_id']=$stages_array[$key];
           $details['reuse_id']=$reuse_id;

          $this->Reuse_details_model->save($details);



       }

       $this->Set_process_model->update_status($this->input->post('work_order_id'),$this->input->post('process_product_id'),3);

       redirect("reuse");
    }



    function list_data() {
        $list_data = $this->Reuse_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }

  

    private function _make_row($data) {

        $product_data   = $this->Products_model->get_one($data->process_product_id);
        
        $set_stages_data =$this->Set_stages_model->get_work_order_start_time($data->work_order_id,$data->process_product_id)->result();

        if(count( $set_stages_data)){
            $work_order_start_time = $set_stages_data[0]->start_date_time;
        }else{
            $work_order_start_time = 'Not Available';
        }

        return array(

            $data->created_date,
            $data->id,
            $data->work_order_id,
            $work_order_start_time,
            $product_data->name,
            $data->end_product_qty,
            modal_anchor(get_uri("reuse/modal_form"), "<i class='fa fa-eye'></i>", array("class" => "edit", "title" => "View", "data-post-reuseid" => $data->id))

        );
    }



    function modal_form(){

        $data    = array();
        $options = array();

        $options['reuse_id']  = $this->input->post('reuseid');
        $data['reuse_details_data'] = $this->Reuse_details_model->get_details($options)->result();

        $data['reuse_data']   = $this->Reuse_model->get_one( $this->input->post('reuseid'));
        $data['process_product_data'] = $this->Products_model->get_one( $data['reuse_data']->process_product_id);
        
        $this->load->view('production_processing/reuse/modal_form', $data);

    }

    function save_working_qty(){


        $work_order_id=$this->input->post('work_order_id');
        $process_product_id=$this->input->post('process_product_id');
        $process_product_qty=$this->input->post('process_product_qty');
        $reuse_id=$this->input->post('reuse_id');


$product_id_array=$this->input->post('product_id');
$product_qty_array=$this->input->post('product_qty');

//wastage
        if($this->input->post('wastage_button')){


            foreach($product_id_array as $key=>$value ){

                $this->Productwarehouse_model->updatewhdata(7,$value,$product_qty_array[$key],0);
                $this->Productwarehouse_model->updatewhdata(3,$value,$product_qty_array[$key],1);

            }
            

       $this->Reuse_model->update_status($reuse_id,1);

       redirect('reuse');

        }

        //end wastage

        //main store
        if($this->input->post('main_store_button')){


            // $data    = array();
            // $options = array();
    
            // $options['reuse_id']  = $reuse_id;
            // $data['reuse_details_data'] = $this->Reuse_details_model->get_details($options)->result();
            
            // $data['reuse_data']   = $this->Reuse_model->get_one( $reuse_id);
            // $data['process_product_data'] = $this->Products_model->get_one( $data['reuse_data']->process_product_id);
            
            $data['product_id_array']=$product_id_array;

            $data['work_order_data'] = $this->Work_order_model->get_one($work_order_id);

            $data['product_qty_array']=$product_qty_array;

            $data['from_warehouse_id']=7;

            $data['to_warehouse_id']=1;

            $data['clients_all']   = $this->Clients_model->get_details()->result();

            $data['user_all']      = $this->Users_model->active_member();
        $data['supplier_all']  = $this->Supplier_model->get_details()->result();

            $data['warehouse_all'] = $this->Warehouse_model->get_details()->result();

            $data['product_qty_array']=$product_qty_array;

         


           // $this->load->view('production_processing/reuse/modal_form', $data);

           $this->template->rander('production_processing/reuse/reuse_to_dc', $data);



/*
            foreach($product_id_array as $key=>$value ){

                $this->Productwarehouse_model->updatewhdata(7,$value,$product_qty_array[$key],0);
                $this->Productwarehouse_model->updatewhdata(1,$value,$product_qty_array[$key],1);

            }
            
            $this->Reuse_model->update_status($reuse_id,2);

            redirect('reuse');
*/


        }

        //main store



         //work order
         if($this->input->post('work_order_button')){


            $this->Reuse_model->update_status($reuse_id,3);

            redirect('work_order/create/'.$reuse_id);

        }

        //end work order
    }




}