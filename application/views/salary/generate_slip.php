<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
        <h4 class="pl15 pt10 pr15"><?php echo lang("gen_payslip"); ?></h4>
        <hr>
        <div class="tab-content">
            <?php echo form_open(get_uri("salary/generate_slip_list"), array("id" => "make_payment-form", "class" => "general-form col-md-12", "role" => "form")); ?>
            <div class="modal-body clearfix " >
                <div class="form-group  col-sm-offset-3 col-sm-6">
                    <label for="month" class="<?php echo $label_column; ?>"><strong><?php echo "Select month"; ?></strong></label>
                    <div class="col-sm-6">
                    <div class="input-group ">
                        <div class="input-group-addon"></div>
                        <input type="month" name="month" class="form-control" value="<?php echo isset($month) ? $month : ''; ?>" placeholder="Select Month" required>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary"><span class="fa fa-arrow-right"></span> <?php echo "Go"; ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php if($show){ ?>
<div class="clearfix p20">
    <div class="panel clearfix">
        <h4 class="pl15 pt10 pr15">Employee Salary Slip List</h4>
        <hr>
        <div class="tab-content">
            <div class="modal-body clearfix " >
                       <div >
                        <!-- <div class="table-responsive" style="max-width: 750px"> -->

                        <div class="table-responsive" >


                        <table class="table table-bordered table-striped firstTable">
                            <tr>
                                <th style="width: 5%">sl#</th>
                                <th style="width: 10%">Employee Name</th>
                                <th style="width: 10%">Designation</th>
                                <th style="width: 10%">Salary Month</th>

                                <th>Present</th>
                                <th>Absent</th>
                                <th>Rest Leave( no 8 hour concept)</th>
                                <th>Sunday</th>
                                <th>Holiday</th>
                                <th>Worked Hours</th>
                              
                                <th style="width: 10%">leave Deduction</th>
                                <th style="width: 10%">Gross Salary</th>

                                

                                <th style="width: 10%">Other Deduction</th>
                                <th style="width: 10%">Net Salary</th>
                                <th style="width: 10%">Provident Fund</th>
                                <th style="width: 10%">Payment Status</th>
                            </tr>
                            <?php
                                $ci =&get_instance();
                                $payroll_data = $ci->Payroll_model->getpayroll_list();
                                $sl1 = 1;
                                foreach($payroll_data as $ph)
                                {
                                    $emp_data = $ci->Users_model->get_one($ph->user_id);

                                    
                                   



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

   $per_day_salary= $ph->basic_salary/($no_of_days-(2+$sunday+$holiday));

   $leave_deduction =  number_format((float)$per_day_salary*$absent_days, 2, '.', '');

  
   
    
       

           

        
        if( $emp_data->role_id == 5 ){

            $gross_salary=($ph->shift_salary/$ph->shift_hour)*$total_work_hours;

        }else{


            
            
           
            $gross_salary     = ($ph->basic_salary         + 
            $ph->house_rent_allowance + 
            $ph->medical_allowance    + 
            $ph->special_allowance    + 
            $ph->other_allowance)-$leave_deduction;

        }
                                   

                                   $gross_salary= number_format((float)$gross_salary, 2, '.', '');

                                          
                                    
                                    
                                    

                                    $total_deduction  = $ph->tax_deduction            + 
                                                        $ph->provident_fund_deduction + 
                                                        $ph->other_deduction;

                                    $net_salary       = $gross_salary - $total_deduction;

                                    $provident_fund   = $ph->provident_fund_contribution + 
                                                        $ph->provident_fund_deduction;

                                    $payment_month     = $month.'-01';

                                    $payment_data = $ci->Salarypayments_model->has_salary_detail($ph->user_id, $payment_month);

                                


                            ?>
                            <tr>
                                <td style="width: 5%"><?php echo $sl1; ?></td>
                                <td style="width: 10%"><?php echo $emp_data->first_name.' '.$emp_data->last_name; ?></td>
                                <td style="width: 10%"><?php echo $emp_data->job_title; ?></td>
                                <td style="width: 10%"><?php echo $month;?></td>

                                <td><?php  if($emp_data->role_id != 5){ echo $present_days;}else{ echo 'NA';}?></td>
                                <td><?php  if($emp_data->role_id != 5){ echo $absent_days;}else{ echo 'NA';}?></td>
                                <td><?php  if($emp_data->role_id != 5){ echo $rest_leave;}else{ echo 'NA';}?></td>
                                <td><?php echo $sunday;?></td>
                                <td><?php  echo $holiday;?></td>
                                <td><?php echo number_format((float)$total_work_hours, 2, '.', '');?></td>
                               

                                <td style="width: 10%"><?php  if($emp_data->role_id != 5){ echo $leave_deduction;}else{ echo 'NA';}?></td>
                                <td style="width: 10%"><?php echo $gross_salary; ?></td>
                               
                                <td style="width: 10%"><?php echo $total_deduction; ?></td>
                                <td style="width: 10%"><?php echo $net_salary; ?></td>
                                <td style="width: 10%"><?php echo $provident_fund; ?></td>
                                <td style="width: 10%">
                                <?php echo form_open(get_uri("salary/make_payment_find"), array("class" => "general-form", "role" => "form")); ?>
                                <input type="hidden" name="user_id" value="<?php echo $ph->user_id; ?>" />
                                <input type="hidden" name="month" value="<?php echo $month; ?>" />

                                    <?php
                                        if(count($payment_data) > 0){
                                            ?>
                                                <input type="submit" name="submit" class="btn btn-sm btn-success" value="Paid" style="min-width: 100%">
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <input type="submit" name="submit" class="btn btn-sm btn-danger" value="Make Payment" style="min-width: 100%">
                                        <?php
                                        }
                                    ?>
                                     <?php echo form_close(); ?>
                                </td>
                            </tr>
                                <?php
                                    $sl1 += 1;
                                }
                                ?>        
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>