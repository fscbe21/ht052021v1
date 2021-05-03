<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qc_process extends MY_Controller {

    function __construct() {

        parent::__construct();
    
    }


    function index(){

    }

    function show($work_order_id,$end_product_id,$product_id,$bom_id,$qty,$process_id){        

        $view_data["bom_data"]=$this->Bom_model->get_one($bom_id);

        $view_data["end_product_data"]=$this->Products_model->get_one($end_product_id);

        $view_data["qty"]=$qty;

        $view_data["product_data"]=$this->Products_model->get_one($product_id);

        $view_data["work_order_id"] =$work_order_id;
        $view_data["end_product_id"] =$end_product_id;
        $view_data["product_id"] =$product_id;
        $view_data["bom_id"] =$bom_id;
        $view_data["qty"] =$qty;

        $view_data["process_id"] = $process_id;
        
        //$view_data['production_assign_bom_data']=$this->Assignbom_model->get_details(array("work_order_id"=>$work_order_id,"end_product_id"=>$end_product_id,"bom_id"=>$bom_id))->result();

        $view_data["bom_details_data"]=$this->Bomdetail_model->get_details(array("bom_id"=>$bom_id))->result();
        
        $this->template->rander("production_processing/qc_process/index.php", $view_data);


    }

    function save(){




        if($this->input->post('qc_pass_submit')){



               
        $process_product_id = $this->input->post('process_product_id');

        $process_product_qty=$this->input->post('qty');

        $this->Productwarehouse_model->updatewhdata(7,$process_product_id,$process_product_qty,1);

        $product_id_array_input=$this->input->post('product_id');      

        $product_total_qty_array_input=$this->input->post('product_total_qty');      

        foreach($product_id_array_input as $key=>$val) {
$this->Productwarehouse_model->updatewhdata(7,$val,$product_total_qty_array_input[$key],0);
        } 


        $this->Set_process_model->update_status($this->input->post('work_order_id'),$process_product_id,1);


        $work_order_data=$this->Work_order_model->get_one($this->input->post('work_order_id'));

        if( $work_order_data->reuse_work_order_id){

            $this->Set_process_model->update_status($work_order_data->reuse_work_order_id,$process_product_id,1);

        }
           //start dsk 7april2021

        /*create an automatic DC record from production to after production warehouse  */
        /* $data                           = array();
        $data['dc_type']                = 1;
        $data['dc_no']                  = 0;
        $data['dc_date']                = date("Y-m-d H:i:s");      
        
        $data['work_order_no']      = $this->input->post('work_order_id');

        $work_order_details=$this->Work_order_model->get_one($this->input->post('work_order_id'));

        $data['work_order_date']    = $work_order_details->date;
        $data['sale_order_number']  = $work_order_details->sale_order_number;
        $data['from_warehouse']     = 7;
        $data['to_warehouse']       = 2;

        $data['shop_keeper_name']   = 1;
        $data['process_incharge']   = 1;
        $data['reciever_name']      = 'Auto';
        $data['customer_name']      = $work_order_details->customer_id;
        $data['vendor']             = 1;

        $data['delivery_type']      = 1;
        $data['reference_no']       = $this->input->post('work_order_id');
        $data['reference']          = $this->input->post('work_order_id');

        $data['vehicle_no']         = 'NA';
        $data['vehicle_name']       = 'NA';


        $dc_outward_id = $this->Dc_outward_model->save($data); 

        $data['dc_no']  = $dc_outward_id ;

        $this->Dc_outward_model->save($data,$dc_outward_id);    

        
            $product_details                    = array();
            $product_details['dc_outward_id']   = $dc_outward_id;
            $product_details['product_id']      = $process_product_id;
            $product_details['qty']             = $process_product_qty;
            $this->Dc_outward_details_model->save($product_details);

        
            $this->Productwarehouse_model->updatewhdata(7,$process_product_id,$process_product_qty,0);
            $this->Productwarehouse_model->updatewhdata(2,$process_product_id,$process_product_qty,1); */
        

    //end dsk 7april2021


        }



        if($this->input->post('wastage_submit')){

           


            $process_product_id = $this->input->post('process_product_id');

            $process_product_qty=$this->input->post('qty');
    
            $this->Productwarehouse_model->updatewhdata(7,$process_product_id,$process_product_qty,1);
    
            $product_id_array_input=$this->input->post('product_id');      
    
            $product_total_qty_array_input=$this->input->post('product_total_qty');      
    
            foreach($product_id_array_input as $key=>$val) {
    $this->Productwarehouse_model->updatewhdata(7,$val,$product_total_qty_array_input[$key],0);
            }
            
            //add to wastage warehouse id =3, production id=7


            $product_qty_array_input=$this->input->post('product_qty');   

            $wastage_qty= $this->input->post('waste_qty'); 

            foreach($product_id_array_input as $key=>$val) {
                $this->Productwarehouse_model->updatewhdata(7,$val,($product_qty_array_input[$key]*$wastage_qty),0);
                        }


            foreach($product_id_array_input as $key=>$val) {
                $this->Productwarehouse_model->updatewhdata(3,$val,($product_qty_array_input[$key]*$wastage_qty),1);
                                    }

            //end add to wastage warehouse
           
            $this->Set_process_model->update_status($this->input->post('work_order_id'),$process_product_id,2);
    
            }

            if($this->input->post('partial-delivery')){
                
            }


            
            

            $options                  = array();
            $options['work_order_id'] = $this->input->post('work_order_id');
            $options['bom_id']        = $this->input->post('bom_id');

        $wastage_data = $this->Assignbom_model->get_details($options)->result();

        foreach($wastage_data as $wd){
            if($wd->wastage){
                $this->Productwarehouse_model->updatewhdata(3, $wd->product_id, $wd->wastage, 1);
                $this->Productwarehouse_model->updatewhdata(7, $wd->product_id, $wd->wastage, 0);
            }
        }
        
        redirect("qcpass");

    }

}