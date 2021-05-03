
<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
       
         <h4 class="pl15 pt10 pr15">
<?php

use function GuzzleHttp\json_encode;

echo lang("make_payment"); ?></h4>
         <hr>
          
        <div class="tab-content">
        <?php echo form_open(get_uri("salary/make_payment_find"), array("id" => "employee-payroll-form", "class" => "general-form col-md-12", "role" => "form")); ?>
        <div class="modal-body clearfix " >

        <div class="form-group  col-sm-offset-3 col-sm-6">
                <label class="<?php echo $label_column; ?>"><strong><?php echo "Employee"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                <select name="user_id" class="form-control" required>   
                  <option value="" > Select Employee</option> 

                  <?php 
                      $userid = isset($user_id) ? $user_id : 0;
                  ?>
                          <?php foreach($employee_list as $emp){?>
                              <option 
                              
                              <?php
                                  if($userid != 0){
                                      echo ($userid == $emp->id) ? ' selected' : '';
                                  }
                              ?>
                              value="<?php echo $emp->id; ?>"><?php echo $emp->first_name." ".$emp->last_name ; ?>
                  </option>
                    <?php }  ?>                                                      
        </select>
                </div>
            </div>

            <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="from_month" class="<?php echo $label_column; ?>"><strong>Month</strong></label>
                <div class="<?php echo $field_column; ?>">
                <input type="month" value="<?php echo isset($month) ? $month : ''; ?>" name="month" class="form-control" required>
    </div>
</div>
</div>
</div>

<div class="modal-footer">
    
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('submit'); ?></button>
</div>
<?php echo form_close(); ?>

         </div>
    </div>


    <?php if($proceed){?>
      <?php echo form_open(get_uri("salary/store_payment"), array("id" => "employee-payroll-form", "class" => "general-form", "role" => "form")); ?>

    <div class="container row" style="padding-left: 20px">


    <div class="col-md-3">
    <div class="panel clearfix">
       
       <h4 class="pl15 pt10 pr15"><?php echo 'Employee Details'; ?></h4>
       <hr>
         
      

      <div class="tab-content">
     
      <div class="modal-body clearfix " >





      <table class="table table-striped">


 
    
    <tbody>

      <tr>
        <td>Name</td>
        <td><?php echo $emp_data->first_name.' '.$emp_data->last_name; ?></td>    
      </tr>


      <tr>
        <td>Department</td>
        <td><?php echo $emp_data->department; ?></td>    
      </tr>


      <tr>
        <td>Designation</td>
        <td><?php echo $emp_data->job_title; ?></td>    
      </tr>



      <tr>
        <td>Joining Date</td>
        <td><?php echo $job_info[0]->date_of_hire; ?></td>    
      </tr>



    
    </tbody>
  </table>

  
       


         




</div>









       </div>
  </div>
















    </div>



    <?php





  $month_year_array = explode("-",$month);

  $no_of_days=cal_days_in_month(CAL_GREGORIAN,$month_year_array[1],$month_year_array[0]);
  
  $start_date=$month."-01";
  
  $end_date=$month."-".$no_of_days;
  
  
  
  
  
  
  
     $options = array("start_date" => $start_date, "end_date" => $end_date,  "user_id" => $emp_data->id,"login_user_id" =>$ci->login_user->id, "access_type" => "all", "allowed_members" => $emp_data->id);
          $list_data = $this->Attendance_model->get_details($options)->result();
  
          $total_work_hours =0;
          $present_days=0;
          $absent_days=0;
          $sunday=0;

          $holiday_options = array("start_date" => $start_date);
     
          $holiday_data = $this->Holidays_model->get_details($holiday_options)->result();
  
          $holiday=0;

          $leave_deduction=0;
  
  
          $begin_check  = new DateTime($start_date);
  $end_check    = new DateTime($end_date);
  
  
  while ($begin_check <= $end_check) // Loop will work begin to the end date 
  {
      if($begin_check->format("D") == "Sun") //Check that the day is Sunday here
      {
          $sunday+=1;
      }
  
      $begin_check->modify('+1 day');
  }
  
  


//holidays
$sunday_in_holiday=0;

foreach($holiday_data as $jolly_day){

    //CHECK IF JOLLY START DATE IS CURRENT MONTH
if( date("Y-m",strtotime($jolly_day->start_date)) == $month && date("Y-m",strtotime($jolly_day->end_date)) == $month){


    $begin_c  = new DateTime($jolly_day->start_date);
    $end_c    = new DateTime($jolly_day->end_date);

    while ($begin_c <= $end_c) // Loop will work begin to the end date 
    {
        if($begin_c->format("D") == "Sun") //Check that the day is Sunday here
        {
            $sunday_in_holiday+=1;  
        }    
    
        $begin_c->modify('+1 day');
    }

    $datediff = strtotime($jolly_day->end_date) - strtotime($jolly_day->start_date);

    $no_of_holidays = round($datediff / (60 * 60 * 24))+1;

    $holiday += ($no_of_holidays-$sunday_in_holiday);


    
}else if( date("Y-m",strtotime($jolly_day->start_date)) == $month){


    $begin_c  = new DateTime($jolly_day->start_date);
    $end_c    = new DateTime($month."-".$no_of_days);

    while ($begin_c <= $end_c) // Loop will work begin to the end date 
    {
        if($begin_c->format("D") == "Sun") //Check that the day is Sunday here
        {
            $sunday_in_holiday+=1;  
        }    
    
        $begin_c->modify('+1 day');
    }

    $datediff = strtotime($month."-".$no_of_days) - strtotime($jolly_day->start_date);

    $no_of_holidays = round($datediff / (60 * 60 * 24))+1;

    $holiday += ($no_of_holidays-$sunday_in_holiday);



}else if(date("Y-m",strtotime($jolly_day->end_date)) == $month){

    $begin_c  = new DateTime($month.'-01');
    $end_c    = new DateTime($jolly_day->end_date);

    while ($begin_c <= $end_c) // Loop will work begin to the end date 
    {
        if($begin_c->format("D") == "Sun") //Check that the day is Sunday here
        {
            $sunday_in_holiday+=1;  
        }    
    
        $begin_c->modify('+1 day');
    }

    $datediff = strtotime($jolly_day->end_date) - strtotime($month.'-01');

    $no_of_holidays = round($datediff / (60 * 60 * 24))+1;

    $holiday += ($no_of_holidays-$sunday_in_holiday);



}

    //END CHECK IF JOLLY START DATE IS CURRENT MONTH

       


}


//end holidays


  
      
  
      foreach ($list_data as $data) {
  
  
  
  
  
          $out_time = $data->out_time;
          if (!is_date_exists($out_time)) {
              $out_time = "";
          }
  
          $to_time = strtotime($data->out_time);
          if (!$out_time) {
              $to_time = strtotime($data->in_time);
          }
  
          $from_time = strtotime($data->in_time);
  
         
         
          $total_work_hours += abs($to_time - $from_time)/3600;
  
         if($total_work_hours >= 6){
  
         $present_days += 1;
  
         }else if($total_work_hours >= 4 && $total_work_hours < 6){
  
  $present_days += 0.5;
         }else{
          
  //$absent_days += 1;
         }
         
      }
  
  
  
  
      $absent_days=$no_of_days-$present_days-$sunday-$holiday;
  
   
  
      
  
  
      if($absent_days == 1){
  $rest_leave =1;
  $absent_days -= 1;
      }else if($absent_days >= 2 ){
  $rest_leave=2;
  $absent_days -= 2;
      }else{
          $rest_leave=0;
      }
  
  
     //per day salary calculate
  
     $per_day_salary= $payroll->basic_salary/($no_of_days-(2+$sunday+$holiday));
  
     $leave_deduction =  number_format((float)$per_day_salary*$absent_days, 2, '.', '');
  
    
     
      
         
  
             
  
          
          if( $emp_data->role_id == 5 ){
  
              $gross_salary=($payroll->shift_salary/$payroll->shift_hour)*$total_work_hours;
  
          }else{

            $gross_salary     = ($payroll->basic_salary + 
            $payroll->house_rent_allowance + 
            $payroll->medical_allowance + 
            $payroll->special_allowance + 
            $payroll->other_allowance) - $leave_deduction;


          }
  
                                     $gross_salary= number_format((float)$gross_salary, 2, '.', '');


  

$total_deduction  = $payroll->tax_deduction + 
  $payroll->provident_fund_deduction + 
  $payroll->other_deduction;

$net_salary       = $gross_salary - $total_deduction;

$provident_fund   = $payroll->provident_fund_contribution + 
  $payroll->provident_fund_deduction;




?>




    <div class="col-md-4">
        <div class="panel clearfix">
           <h4 class="pl15 pt10 pr15"><?php echo 'Payment Details'; ?></h4>
           <hr>
           <div class="tab-content">
              <div class="modal-body clearfix " >
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Sl No.</th>
                      <th>Name</th>
                      <th>Debit</th>
                      <th>Credit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Basic Salary</td>
                      <td>0</td>
                      <input type="hidden" name="itemname[]" value="Basic Salary"/>
                      <input type="hidden" name="status[]" value="Credit"/>
                      <input type="hidden" name="amount[]" value="<?php echo $payroll->basic_salary-$leave_deduction; ?>"/>
                      <td><?php echo $payroll->basic_salary-$leave_deduction; ?></td>        
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>House Rent Allowance</td>
                      <td>0</td>
                      <input type="hidden" name="itemname[]" value="House Rent Allowance"/>
                      <input type="hidden" name="status[]" value="Credit"/>
                      <input type="hidden" name="amount[]" value="<?php echo $payroll->house_rent_allowance; ?>"/>
                      <td><?php echo $payroll->house_rent_allowance; ?></td>        
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Medical Allowance</td>
                      <td>0</td>
                      <input type="hidden" name="itemname[]" value="Medical Allowance"/>
                      <input type="hidden" name="status[]" value="Credit"/>
                      <input type="hidden" name="amount[]" value="<?php echo $payroll->medical_allowance; ?>"/>
                      <td><?php echo $payroll->medical_allowance; ?></td>        
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Special Allowance</td>
                      <td>0</td>
                      <input type="hidden" name="itemname[]" value="Special Allowance"/>
                      <input type="hidden" name="status[]" value="Credit"/>
                      <input type="hidden" name="amount[]" value="<?php echo $payroll->special_allowance; ?>"/>
                      <td><?php echo $payroll->special_allowance; ?></td>        
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Provident Fund Contribution</td>
                      <td>0</td>
                      <input type="hidden" name="itemname[]" value="Provident Fund Contribution"/>
                      <input type="hidden" name="status[]" value="Credit"/>
                      <input type="hidden" name="amount[]" value="<?php echo $payroll->provident_fund_contribution; ?>"/>
                      <td><?php echo $payroll->provident_fund_contribution; ?></td>        
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>Other Allowance</td>
                      <td>0</td>
                      <input type="hidden" name="itemname[]" value="Other Allowance"/>
                      <input type="hidden" name="status[]" value="Credit"/>
                      <input type="hidden" name="amount[]" value="<?php echo $payroll->other_allowance; ?>"/>
                      <td><?php echo $payroll->other_allowance; ?></td>        
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>Tax Deduction</td>
                      <input type="hidden" name="itemname[]" value="Tax Deduction"/>
                      <input type="hidden" name="amount[]" value="<?php echo $payroll->tax_deduction; ?>"/>
                      <input type="hidden" name="status[]" value="Debit"/>
                      <td><?php echo $payroll->tax_deduction; ?></td>
                      <td>0</td>        
                    </tr>
                    <tr>
                      <td>8</td>
                      <td>Provident Fund Deduction</td>
                      <input type="hidden" name="itemname[]" value="Provident Fund Deduction"/>
                      <input type="hidden" name="status[]" value="Debit"/>
                      <input type="hidden" name="amount[]" value="<?php echo $payroll->provident_fund_deduction; ?>"/>
                      <td><?php echo $payroll->provident_fund_deduction; ?></td>
                      <td>0</td>        
                    </tr>
                    <tr>
                      <td>9</td>
                      <td>Other Deduction</td>
                      <input type="hidden" name="itemname[]" value="Other Deduction"/>
                      <input type="hidden" name="status[]" value="Debit"/>
                      <input type="hidden" name="amount[]" value="<?php echo $payroll->other_deduction; ?>"/>
                      <td><?php echo $payroll->other_deduction; ?></td>
                      <td>0</td>        
                    </tr>
                    <?php
                      $show_loan_emi = 0;
                      if(count($loan_detail) > 0)
                      {
                        foreach($loan_detail as $loan)
                        {
                          $total_amount  = $loan->loan_amount;
                          $total_emi     = $loan->number_of_installments;
                          $remaining_emi = $loan->remaining_installments;

                          if($remaining_emi > 0)
                          {
                            $emi_amount = $total_amount / $total_emi;
                            $show_loan_emi = 1;
                          }
                        }
                      }

                      if($show_loan_emi){
                        ?>
                        <tr id="removethis">
                          <td>10</td>
                          <td>Loan Deduction</td>
                          <input type="hidden" name="itemname[]" value="Loan Deduction"/>
                          <input type="hidden" name="status[]" value="Debit"/>
                          <input type="hidden" name="amount[]" value="<?php echo $emi_amount; ?>"/>
                          <input type="hidden" id="emi_amount_del" name="emi_amount_del" value="<?php echo $emi_amount; ?>"/>
                          <td><?php echo $emi_amount; ?></td>
                          <td><span style="background-color: red; padding: 2px;" class="badge badge-danger" id="delete-emi">Delete</span></td>        
                      </tr>
                        <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>



          


  <div class="panel clearfix">
       
       <h4 class="pl15 pt10 pr15"><?php echo 'Working Hours and Leave details'; ?></h4>
       <hr>
         
      

      <div class="tab-content">
     
      <div class="modal-body clearfix " >


      <input type="hidden" name="present_days" value="<?php echo $present_days; ?>" >
      <input type="hidden" name="absent_days" value="<?php echo $absent_days; ?>" >
      <input type="hidden" name="rest_leave" value="<?php echo $rest_leave; ?>" >
      <input type="hidden" name="sunday" value="<?php echo $sunday; ?>" >
      <input type="hidden" name="holidays" value="<?php echo $holiday; ?>" >
      <input type="hidden" name="total_work_hours" value="<?php echo $total_work_hours; ?>" >
      <input type="hidden" name="leave_deduction" value="<?php echo $leave_deduction; ?>" >

      <input type="hidden" name="loan_amount_ok" id="loan-amount-ok" value="0"/>



      <table class="table table-striped">


 
    
    <tbody>

      <tr>
        <td>Present</td>
        <td><?php  if($emp_data->role_id != 5){ echo $present_days;}else{ echo 'NA';}?></td>
      </tr>


      <tr>
        <td>Absent</td>
        <td><?php  if($emp_data->role_id != 5){ echo $absent_days;}else{ echo 'NA';}?></td>
      </tr>


      <tr>
        <td>Rest</td>
        <td><?php  if($emp_data->role_id != 5){ echo $rest_leave;}else{ echo 'NA';}?></td> 
      </tr>



      <tr>
        <td>Sunday+Holiday</td>
        <td><?php  echo $sunday+$holiday;?></td>    
      </tr>


      <tr>
        <td>Working Hours</td>
        <td><?php echo number_format((float)$total_work_hours, 2, '.', '');?></td>
      </tr>


      <tr>
        <td>Leave Deduction</td>
        <td><?php echo number_format((float)$leave_deduction, 2, '.', '');?></td>
      </tr>



    
    </tbody>
  </table>

  
       


         




</div>









       </div>
  </div>


        </div>




       

    <div class="col-md-4">

    

    <div class="panel clearfix">
       
       <h4 class="pl15 pt10 pr15"><?php echo lang("make_payment"); ?></h4>
       <hr>

      

      <div class="tab-content">
     
      <div class="modal-body clearfix " >

     
      <div class="form-group">
            <label for="gross_salary" class=" col-md-3"><?php echo lang('gross_salary'); ?></label>
            <div class=" col-md-9">
                <?php
                echo form_input(array(
                    "id" => "gross_salary",
                    "name" => "gross_salary",
                    "value" => $gross_salary,
                    "class" => "form-control",
                    "placeholder" => lang('gross_salary'),
                    "readonly" => true
                ));
                ?>
            </div>
        </div>
      <div class="form-group">
            <label for="total_deduction" class=" col-md-3"><?php echo lang('total_deduction'); ?></label>
            <div class=" col-md-9">
                <?php
                echo form_input(array(
                    "id" => "total_deduction",
                    "name" => "total_deduction",
                    "value" => $total_deduction,
                    "class" => "form-control",
                    "placeholder" => lang('total_deduction'),
                    "readonly" => true
                ));
                ?>
            </div>
        </div>



        <div class="form-group">
            <label for="net_salary" class=" col-md-3"><?php echo lang('net_salary'); ?></label>
            <div class=" col-md-9">
                <?php
                echo form_input(array(
                    "id" => "net_salary",
                    "name" => "net_salary",
                    "value" => $net_salary,
                    "class" => "form-control",
                    "placeholder" => lang('net_salary'),
                    "readonly" => true
                ));
                ?>
            </div>
        </div>



             
      <div class="form-group">
            <label for="provident_fund" class=" col-md-3"><?php echo lang('provident_fund'); ?></label>
            <div class=" col-md-9">
                <?php
                echo form_input(array(
                    "id" => "provident_fund",
                    "name" => "provident_fund",
                    "value" => $provident_fund,
                    "class" => "form-control",
                    "placeholder" => lang('provident_fund'),
                    "readonly" => true
                ));
                ?>
            </div>
        </div>



        <div class="form-group">
            <label for="payment_amount" class=" col-md-3"><?php echo lang('payment_amount'); ?></label>
            <div class=" col-md-9">
                <?php
                echo form_input(array(
                    "id" => "payment_amount",
                    "name" => "payment_amount",
                    "value" => $net_salary,
                    "class" => "form-control",
                    "placeholder" => lang('payment_amount'),
                   
                   
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="payment_type" class=" col-md-3"><?php echo lang('payment_type'); ?></label>
            <div class=" col-md-9">
            <select name="payment_type" class="form-control" required>    

                  <!-- <?php 
                      $userid = isset($user_id) ? $user_id : 0;
                  ?>
                          <?php foreach($employee_list as $emp){?>
                              <option 
                              
                              <?php
                                  if($userid != 0){
                                      echo ($userid == $emp->id) ? ' selected' : '';
                                  }
                              ?>
                              value="<?php echo $emp->id; ?>"><?php echo $emp->first_name." ".$emp->last_name ; ?>
                  </option>
                    <?php }  ?> -->  
                    <option value="1">Cash</option>
                    <option value="2">Cheque</option>
                    <option value="3">Bank Account</option>
           </select>
            </div>
        </div>


        <div class="form-group">
            <label for="note" class=" col-md-3"><?php echo lang('note'); ?></label>
            <div class=" col-md-9">
                <?php
                echo form_textarea(array(
                    "id" => "note",
                    "name" => "note",
                    "value" => $model_info->note ? $model_info->note : "",
                    "class" => "form-control",
                    "placeholder" => lang('note'),
                    "data-rich-text-editor" => true
                ));
                ?>
            </div>
        </div>
    <input type="hidden" name="user_id" value="<?php echo $userid; ?>"/>
    <input type="hidden" name="payment_month" value="<?php echo $month; ?>"/>
</div>

<div class="modal-footer">
  
  <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('make_payment'); ?></button>

</div>


       </div>
      </div>
    </div>
    <?php echo form_close(); ?>
    </div>
<?php 
}
?>
</div>

<script type="text/javascript">
   $(document).ready(function () {
        setDatePicker("#from_month", {
            startDate: moment().add(-365, 'days').format("DD-MM-YYYY")
        });

        setDatePicker("#to_month", {
            startDate: moment().add(-365, 'days').format("DD-MM-YYYY")
        });

        var emiamount1 = $('#emi_amount_del').val();
        emiamount1 = parseFloat(emiamount1);
        $('#loan-amount-ok').val(0);
        if(emiamount1)
        {
          var totalDeduction1 = $('#total_deduction').val();
          totalDeduction1 = parseFloat(totalDeduction1);
          var netSalary1 = $('#net_salary').val();
          netSalary1 = parseFloat(netSalary1);
          var newtotalDeduction1 = totalDeduction1 + emiamount1;
          var newNetSalary1      = netSalary1 - emiamount1;
          $('#total_deduction').val(newtotalDeduction1);
          $('#net_salary').val(newNetSalary1);
          $('#payment_amount').val(newNetSalary1);
          $('#loan-amount-ok').val(1);
        }

    });

    $(document).on('click', '#delete-emi', function(){
       
        var emiamount = $('#emi_amount_del').val();
        emiamount = parseFloat(emiamount);
        var totalDeduction = $('#total_deduction').val();
        totalDeduction = parseFloat(totalDeduction);
        var netSalary = $('#net_salary').val();
        netSalary = parseFloat(netSalary);

        var newtotalDeduction = totalDeduction - emiamount;
        var newNetSalary      = netSalary + emiamount;
        $('#total_deduction').val(newtotalDeduction);
        $('#net_salary').val(newNetSalary);
        $('#payment_amount').val(newNetSalary);
        $('#removethis').remove();
        $('#loan-amount-ok').val(0);
    });
</script>    


