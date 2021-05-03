<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salary extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->init_permission_checker("message_permission");
    }
//darini 22-2
    function index(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $view_data['show']="0";
        $view_data['employee_list']=$this->Users_model->active_member();
        $this->template->rander("salary/manage_salary",$view_data);
    }
    
    function manage_salary($id=0){
      
        if($this->input->post("user_id")){
            $id=$this->input->post("user_id");
        }
        $view_data['user_info']=$this->Payroll_model->getpayroll($id);//darini 23-2
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $view_data['show']="1";
        $view_data['user_id']=$id;
        //start dsk 4march2021 
            $view_data["department_dropdown"]=$this->Department_model->get_details()->result();//R.v11_03
        $view_data['user_details']= $this->Users_model->get_details(array("id"=>$id))->result();
        //end dsk 4march2021  
        $view_data['employee_list']=$this->Users_model->active_member();
        $this->template->rander("salary/manage_salary",$view_data);
       //echo json_encode($view_data);
    }

    function save_salary_manage(){
        $id=$this->input->post("id");
        $user_id=$this->input->post("user_id");
        $details=array(
               "user_id"=>$this->input->post("user_id"),
               "employee_type"=>$this->input->post("employee_type"),
               "basic_salary"=>$this->input->post("basic_salary"),
               "house_rent_allowance"=>$this->input->post("house_rent_allowance"),
               "medical_allowance"=>$this->input->post("medical_allowance"),
               "special_allowance"=>$this->input->post("special_allowance"),
               "provident_fund_contribution"=>$this->input->post("pf_contribution"),
               "other_allowance"=>$this->input->post("other_allowance"),
               "tax_deduction"=>$this->input->post("tax_deduction"),
               "provident_fund_deduction"=>$this->input->post("pf_deduction"),          
               "other_deduction"=>$this->input->post("other_deduction"),    
               "created_by"=> $this->login_user->id,
               "shift_salary"=>$this->input->post("shift_salary"),/*dsk 4march2021*/
               "shift_hour"=>$this->input->post("shift_hour")/*dsk 4march2021*/
           );
            $now = get_current_utc_time();
           if(!$id){
               $details['created_at']=$now ;           
           }
            $details['updated_at']=$now;
            $save_id=$this->Payroll_model->save($details,$id);
			
				//R.v10_03 start
           $department_id                 = $this->input->post("departmentids");
         $shift_salary                   = $this->input->post("shiftsalary");
         $shift_hour                   = $this->input->post("shifthour");
         $ot_salary                   = $this->input->post("otsalary");
         $ot_hour                   = $this->input->post("othour");
         for ($i = 0; $i < count($department_id); $i++) 
         {
            $data1 = array();
            $data1['payroll_id']  =  $save_id;
            $data1['department_id']          =  $department_id[$i];
            $data1['shift_salary']             =  $shift_salary[$i];
            $data1['shift_hour']             =  $shift_hour[$i];
            $data1['ot_salary']             =  $ot_salary[$i];//R.V11_03
            $data1['ot_hour']             =  $ot_hour[$i];//R.V11_03
            //$data1['created_at']         =  get_current_utc_time();
           // $data1['updated_at']         =  get_current_utc_time();
            $this->Dep_wise_model->save($data1);
         }

 //R.v10_03 End  
            if ($save_id) {           
               echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_saved')));
           } else {
               echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
           }
           
   
       }

//end
    function salaray_list(){
        $this->template->rander('salary/salary_list');
    }


    function list_data() {

       
 
       // $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("leads", $this->login_user->is_admin, $this->login_user->user_type);
 
 
         
         $list_data = $this->Payroll_model->getpayroll_list();
         $result = array();
        foreach ($list_data as $data) {
             $result[] = $this->_make_row_salary_list($data);
         }
         echo json_encode(array("data" => $result));
     }
     function _make_row_salary_list($data){

        $user=$this->Users_model->get_one($data->user_id);
        $gross_salary=$data->basic_salary+$data->house_rent_allowance+$data->medical_allowance+$data->special_allowance+$data->other_allowance;
        $pf=$data->provident_fund_contribution+$data->provident_fund_deduction;
        $ded=$data->tax_deduction+$data->provident_fund_deduction+$data->other_deduction;
        $netsal=$gross_salary-$ded;
        if($data->employee_type==1){
                $type="Provision";
        }else if($data->employee_type==2){
            $type="Permanent";
        }else if($data->employee_type==3){
            $type="Full Time";
        }else if($data->employee_type==4){
            $type="Part Time";
        }else if($data->employee_type==5){
            $type="Adhoc";
        }
        if($user->role_id==0){
                $desgination="MD";
        }else{
             $role=  $this->Roles_model->get_one( $user->role_id);
             $desgination= $role->title;
        }
        $row_data = array(
            $data->id,
            $user->first_name." ".$user->last_name,
            $desgination,
            $type,
            $gross_salary,
            $pf,
            $ded,
            $netsal,
            
        );
        $row_data[] =  anchor(get_uri("salary/manage_salary/".$data->user_id), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => lang('edit_client'), "data-post-user_id" => "$data->user_id"));
        
        return $row_data;
     }

     function make_payment(){
          
        $view_data['employee_list']= $this->Users_model->active_member();
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-6";
        $view_data['proceed']      = 0;         
        $this->template->rander('salary/make_payment',$view_data);

     }

     function make_payment_find(){
         $view_data = array();
         $view_data['user_id']      = $userid = $this->input->post("user_id");
         $view_data['month']        = $this->input->post("month");

          

         $month         = $this->input->post("month").'-01';
         $hasSalaryData = $this->Salarypayments_model->has_salary_detail($userid, $month);

         if(count($hasSalaryData) > 0)
         {
            $view_data['salaryData']     = $hasSalaryData;
            $view_data['salarydetail']   = $this->Salarypaymentdetails_model->get_salary_detail($hasSalaryData[0]->id);
            $view_data['emp_data']       = $this->Users_model->get_one($userid);
            $view_data['job_info']       = $this->Users_model->userJobInfo($userid);
            $view_data['paymentHistory'] = $this->Salarypayments_model->payments_history($userid);
            $this->template->rander('salary/print_payment',$view_data);
         }
         else
         {
            $view_data['loan_detail'] = $this->Loan_model->get_latest_loan($userid);
            $view_data['label_column'] = "col-md-3";
            $view_data['field_column'] = "col-md-6"; 
            $view_data['employee_list']= $this->Users_model->active_member();  
            $view_data['emp_data']     = $this->Users_model->get_one($userid);
            $view_data['job_info']     = $this->Users_model->userJobInfo($userid);
            $view_data['proceed']      = 1;
            $view_data['payroll']      = $this->Payroll_model->getpayroll($userid);
         
            $this->template->rander('salary/make_payment',$view_data);
         }
     }

     function store_payment(){
         $data = array();
         $data['gross_salary']     = $this->input->post("gross_salary");
         $data['total_deduction']  = $this->input->post("total_deduction");
         $data['net_salary']       = $this->input->post("net_salary");
         $data['provident_fund']   = $this->input->post("provident_fund");
         $data['payment_amount']   = $this->input->post("payment_amount");
         $data['payment_type']     = $this->input->post("payment_type");
         $data['note']             = $this->input->post("note");
         $data['created_by']       = $this->login_user->id;
         $data['user_id']          = $userid = $this->input->post("user_id");
         $data['payment_month']    = $this->input->post("payment_month").'-01';
         $data['created_at']       = get_current_utc_time();
         $data['updated_at']       = get_current_utc_time();

           //dsk 6march2021
           $data['present_days']     = $this->input->post("present_days");
           $data['absent_days']     = $this->input->post("absent_days");
           $data['rest_leave']     = $this->input->post("rest_leave");
  
           $data['sunday']     = $this->input->post("sunday");
           $data['holidays']     = $this->input->post("holidays");
           $data['total_work_hours']     = $this->input->post("total_work_hours");
           $data['leave_deduction']     = $this->input->post("leave_deduction");
           //end dsk 6march2021

         $loanpayment = 0;
         $loanpayment = $this->input->post("loan_amount_ok");

         if($loanpayment){
             $decrease_emi = $this->Loan_model->decrease_emi($userid);
         }
         
         $salary_payment_id        = $this->Salarypayments_model->save($data);
        
         $itemname                 = $this->input->post("itemname");
         $amount                   = $this->input->post("amount");
         $status                   = $this->input->post("status");

        // $this->load->model('Salarypaymentdetails_model');

         for ($i = 0; $i < count($itemname); $i++) 
         {
            $data1 = array();
            $data1['salary_payment_id']  =  $salary_payment_id;
            $data1['item_name']          =  $itemname[$i];
            $data1['amount']             =  $amount[$i];
            $data1['status']             =  $status[$i];
            $data1['created_at']         =  get_current_utc_time();
            $data1['updated_at']         =  get_current_utc_time();
            $this->Salarypaymentdetails_model->save($data1);
         }

        $month         = $this->input->post("payment_month").'-01';
        $hasSalaryData = $this->Salarypayments_model->has_salary_detail($userid, $month);

        $view_data['salaryData']     = $hasSalaryData;
        $view_data['salarydetail']   = $this->Salarypaymentdetails_model->get_salary_detail($hasSalaryData[0]->id);
        $view_data['emp_data']       = $this->Users_model->get_one($userid);
        $view_data['job_info']       = $this->Users_model->userJobInfo($userid);
        $view_data['paymentHistory'] = $this->Salarypayments_model->payments_history($userid);
        $this->template->rander('salary/print_payment',$view_data);

     }

     function generate_slip(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-6";
        $view_data['show'] = 0;
        $this->template->rander('salary/generate_slip',$view_data);
        
     }

     function generate_slip_list(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-6";
        $view_data['show'] = 1;
        $view_data['month']  = $month = $this->input->post('month');
        $this->template->rander('salary/generate_slip',$view_data);

     }

     function pf(){
        $this->template->rander('salary/pf'); 

     }

     function pf_list_data(){
        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("leads", $this->login_user->is_admin, $this->login_user->user_type);
 
        $options = array(                       
            "custom_fields" => $custom_fields
        );

        //$list_data = $this->New_work_order_model->get_client_lead()->result();
        $result = array();
       /* foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $custom_fields);
        }*/
        echo json_encode(array("data" => $result));

     }

     function sample(){
      $role=  $this->Roles_model->get_one(1);
      echo json_encode($role->title);
     }

   
}

?>