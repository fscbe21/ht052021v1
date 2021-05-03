<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class  Increment extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->init_permission_checker("message_permission");
    }

    function index(){
        
        $this->template->rander("increment/index");
    }

    function modal_form(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $view_data['employee_list']=$this->Users_model->active_member();
        $id = $this->input->post('id');
        $view_data['info']=$this->Increment_model->get_one($id);
        $this->load->view('increment/modal_form', $view_data);
    }


    function list_data() {
        $list_data = $this->Increment_model->get_increment_list();
         $result = array();
        foreach ($list_data as $data) {
             $result[] = $this->_make_row($data);
         }
         echo json_encode(array("data" => $result));
     }

     function _make_row($data){

        $user=$this->Users_model->get_one($data->emp_id);
        $createdby=$this->Users_model->get_one($data->created_by);
        $row_data = array(
            $data->id,
            $createdby->first_name." ".$createdby->last_name,
            $user->first_name." ".$user->last_name,
            $data->date,
            $data->amount,
            $data->incr_purpose,
          
        );
        return $row_data;
     }

     function save(){
        $id=$this->input->post("id");
        $user_id=$this->input->post("user_id");
        $amount=$this->input->post("amt");
        $details=array(
               "emp_id"=>$user_id,
               "amount"=>$amount,
               "date"=>$this->input->post("month"),
               "incr_purpose"=>$this->input->post("increment_purpose"),               
               "created_by"=> $this->login_user->id,
           );
            $now = get_current_utc_time();
           if(!$id){
               $details['created_at']=$now ;           
           }
            $details['updated_at']=$now;
            $save_id=$this->Increment_model->save($details,$id);
            if($save_id){
                $payroll=$this->Payroll_model->getpayroll($user_id);
                $totalamt=(float)($payroll->basic_salary)+(float)$amount;
                $det=array("basic_salary"=>$totalamt);
                $pay_id= $payroll->id;
                $save_id1=$this->Payroll_model->save($det,$pay_id);

            }
            if ($save_id1) {           
               echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_saved')));
           } else {
               echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
           }                  
     }

    
}

?>