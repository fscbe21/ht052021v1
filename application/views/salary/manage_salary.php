<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
       
         <h4 class="pl15 pt10 pr15"><?php echo lang("manage_salary"); ?></h4>
         <hr>
           
        

        <div class="tab-content">
           <div class="form-group col-md-12">
           <div class="col-sm-offset-3 col-sm-6">
           <?php echo form_open(get_uri("salary/manage_salary"), array("id" => "selection-form", "class" => "general-form", "role" => "form")); ?>
                <div class="input-group margin">
                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                  <select name="user_id" class="form-control" required>   
                    <option value="" > Select Employee</option> 
                    <?php foreach($employee_list as $emp){?>
                        <option value="<?php echo $emp->id; ?>" <?php if($user_id==$emp->id) {?> selected='selected'<?php }?>><?php echo $emp->first_name." ".$emp->last_name ; ?></option>
                    <?php }  ?>                                                      
                    </select>
                    <span class="input-group-btn" >
                      <button type="submit" class="btn btn-info btn-flat" style="margin-left: 10px;" > <i class="fa fa-arrow-right"></i>Go</button>
                    </span>
                  </div>
                </div>
                <?php echo form_close(); ?>
           </div>
        </div>
    </div>




    <!--darini 22-2-->
<div id="details" <?php if($show=="0"){?> style="display:none" <?php }?>>
<?php echo form_open(get_uri("salary/save_salary_manage/"), array("id" => "selection_update-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" value="<?php echo $user_id?>" id="user_id" name="user_id"/>
<input type="hidden" value="<?php echo $user_info->id?>" id="id" name="id"/>
    <div class="panel clearfix" >       
       <h4 class="pl15 pt10 pr15"><?php echo "Salary Details"; ?></h4>
       <hr>
       <div class="modal-body clearfix " >
                             
            <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="employee_type" class="<?php echo $label_column; ?>"><strong><?php echo "Employee Type"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                  
                
                <select name="employee_type" id="employee_type" class="form-control" required>               
                      <option value="">Select One</option>
                      <option value="1">Provision</option>
                      <option value="2">Permanent</option>
                      <option value="3">Full Time</option>
                      <option value="4">Part Time</option>
                      <option value="5">Adhoc</option>
                    
            
                </select> 
                   
                </div>
            </div>
         
         <!--start 4march2021-->
<?php 
    
    if($user_details[0]->role_id == 5){
    ?>

         <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="shift_salary" class="<?php echo $label_column; ?>"><strong><?php echo "Shift Salary"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                    <input type="number" value="<?php echo $user_info->shift_salary?>" id="shift_salary" name="shift_salary"  class="form-control"/>
                </div>
         </div> 


         <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="shift_hour" class="<?php echo $label_column; ?>"><strong><?php echo "Shift Hour"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                    <input type="number" min="1" max="24" value="<?php echo $user_info->shift_hour?>" id="shift_hour" name="shift_hour"  class="form-control"/>
                </div>
         </div> 


         <?php  }else{?>

            <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="basic_salary" class="<?php echo $label_column; ?>"><strong><?php echo "Basic Salary"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                    <input type="number" value="<?php echo $user_info->basic_salary?>" id="basic_salary" name="basic_salary"  class="form-control"/>
                </div>
         </div> 




         <?php } ?>

         <!--end 4march2021-->

        </div>    

    </div>
	
	
	 <!--R.V 09_03 Start-->
    <!--<div id="details" <?php if($show=="0"){?> style="display:none" <?php }?>>

    
<?php //echo form_open(get_uri("salary/save_depwise_salary/"), array("id" => "dep_update-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" value="<?php //echo $user_id?>" id="user_id" name="user_id"/>
<input type="hidden" value="<?php //echo $user_info->id?>" id="id" name="id"/>-->
    <div class="panel clearfix" >       
       <h4 class="pl15 pt10 pr15"><?php echo "Department Details"; ?></h4>
       <hr>
       <div class="modal-body clearfix " >
                             
       <?php
   
   $department_array =array();

   foreach ($department_dropdown as $department) {

     // $department_array[$department->id] = $department->name;
?>
       
         
          
    <div class="form-group col-sm-offset-3 col-sm-6">

<label for="department"  class="<?php echo $label_column; ?>"><strong><?php echo lang('department'); ?></strong></label>

<div class="<?php echo $field_column; ?>">
                       <input type="text" value="<?php echo $department->name?>" id="department_id" name="departmentid[]"  class="form-control"/>

                       <input type="hidden" value="<?php echo $department->id?>" id="department_id" name="departmentids[]"  class="form-control"/>
                
   </div>
</div>
         
         <!--start 4march2021-->

         <?php 
    
    if($user_details[0]->role_id == 5){
    ?>
         <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="shift_salary" class="<?php echo $label_column; ?>"><strong><?php echo "Shift Salary"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                    <input type="number" value="<?php echo $user_info->shift_salary?>" id="shift_salary" name="shiftsalary[]"  class="form-control"/>
                </div>
         </div> 


         <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="shift_hour" class="<?php echo $label_column; ?>"><strong><?php echo "Shift Hour"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                    <input type="number" min="1" max="24" value="<?php echo $user_info->shift_hour?>" id="shift_hour" name="shifthour[]"  class="form-control"/>
                </div>
         </div> 

<!--R.V11_03 Start-->
         <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="ot_salary" class="<?php echo $label_column; ?>"><strong><?php echo "OT Salary"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                    <input type="number" value="<?php echo $user_info->ot_salary?>" id="ot_salary" name="otsalary[]"  class="form-control"/>
                </div>
         </div> 


         <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="ot_hour" class="<?php echo $label_column; ?>"><strong><?php echo "OT Hour"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                    <input type="number" min="1" max="24" value="<?php echo $user_info->ot_hour?>" id="ot_hour" name="othour[]"  class="form-control"/>
                </div>
         </div> 
 <!--R.V11_03 End-->        


         <?php  }else{?>

            <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="basic_salary" class="<?php echo $label_column; ?>"><strong><?php echo "Basic Salary"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                    <input type="number" value="<?php echo $user_info->basic_salary?>" id="basic_salary" name="basic_salary"  class="form-control"/>
                </div>
         </div> 




         <?php } ?>

         <!--end 4march2021-->
         <?php } ?>

        </div>    

    </div>

    <!--R.V 09_03 End -->
    
    <div class="col-sm-6" style="padding-left: 0px;">    
    <div class="panel " >    
       <h4 class="pl15 pt10 pr15"><?php echo "Allowances"; ?></h4>
       <hr>
       <div class="modal-body clearfix ">
          <div class="form-group">
                    <label for="house_rent_allowance" ><strong><?php echo "House Rent Allowance"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->house_rent_allowance?>" id="house_rent_allowance" name="house_rent_allowance"  class="form-control"/>
                   
            </div> 

            <div class="form-group">
                    <label for="medical_allowance" ><strong><?php echo "Medical Allowance"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->medical_allowance?>" id="medical_allowance" name="medical_allowance"  class="form-control"/>
                   
            </div> 
            <div class="form-group">
                    <label for="special_allowance" ><strong><?php echo "Special Allowance"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->special_allowance?>" id="special_allowance" name="special_allowance"  class="form-control"/>
                   
            </div> 
            <div class="form-group">
                    <label for="pf_contribution" ><strong><?php echo "Provident Fund Contribution"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->provident_fund_contribution?>" id="pf_contribution" name="pf_contribution"  class="form-control"/>
                   
            </div> 
            <div class="form-group">
                    <label for="other_allowance" ><strong><?php echo "Other Allowance"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->other_allowance?>" id="other_allowance" name="other_allowance"  class="form-control"/>
                   
            </div>  
       </div>
       </div>
    </div>
   
                        
                        
    <div class=" col-sm-6" style="padding-right:0px;">     
    <div class="panel " >    
       <h4 class="pl15 pt10 pr15"><?php echo "Deductions"; ?></h4>
       <hr>
       <div class="modal-body clearfix ">
          <div class="form-group">
                    <label for="tax_deduction" ><strong><?php echo "House Rent Allowance"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->tax_deduction?>" id="tax_deduction" name="tax_deduction"  class="form-control"/>
                   
            </div> 

            <div class="form-group">
                    <label for="pf_deduction" ><strong><?php echo "Provident Fund Deduction"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->provident_fund_deduction?>" id="pf_deduction" name="pf_deduction"  class="form-control"/>
                   
            </div> 

            <div class="form-group">
                    <label for="other_deduction" ><strong><?php echo "Other Deduction"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->other_deduction?>" id="other_deduction" name="other_deduction"  class="form-control"/>
                   
            </div> 
        </div>
       </div>
	   
	   <div class="panel " >    
       <h4 class="pl15 pt10 pr15"><?php echo "Provident Fund"; ?></h4>
       <hr>
       <div class="modal-body clearfix ">
          <div class="form-group">
                    <label for="total_pf" ><strong><?php echo "Total Provident Fund"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->total_pf?>" id="total_pf" name="total_pf"  class="form-control"/>
                   
            </div>
        </div>

	   </div>
	   
	   <div class="panel " >    
       <h4 class="pl15 pt10 pr15"><?php echo "Total Salary Details"; ?></h4>
       <hr>
       <div class="modal-body clearfix ">
          <div class="form-group">
                    <label for="gross_salary" ><strong><?php echo "Gross Salary"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->gross_salary?>" id="gross_salary" name="gross_salary"  class="form-control"/>
                   
            </div>

            <div class="form-group">
                    <label for="total_deduction" ><strong><?php echo "Total Deduction"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->total_deduction?>" id="total_deduction" name="total_deduction"  class="form-control"/>
                   
            </div>

            <div class="form-group">
                    <label for="net_salary" ><strong><?php echo "Net Salary"; ?></strong></label>
                  
                        <input type="number" value="<?php echo $user_info->net_salary?>" id="net_salary" name="net_salary"  class="form-control"/>
                   
            </div>
        </div>
		<div class="modal-footer">
			<button class="btn btn-primary"type="submit"><span class="fa fa-check-circle"></span> <?php if($user_info->id) { echo "Update Details"; }else{ echo "Save Details";}?></button>
		</div>
	   </div>
    </div>
   </form>
</div>
</div>

<script type="text/javascript">
   <?php  if($user_info->id){?>
    document.getElementById('employee_type').selectedIndex=<?php echo $user_info->employee_type;?>;
    <?php }?>
     $("#selection_update-form ").on("keyup", function() {
         calculation();
     });
     $(document).ready(function(){
    calculation();
  });
  function calculation() {
    var sum = 0;
    var basic_salary = $("#basic_salary").val();
    var house_rent_allowance = $("#house_rent_allowance").val();
    var medical_allowance = $("#medical_allowance").val();
    var special_allowance = $("#special_allowance").val();
    var provident_fund_contribution = $("#pf_contribution").val();
    var other_allowance = $("#other_allowance").val();
    var tax_deduction = $("#tax_deduction").val();
    var provident_fund_deduction = $("#pf_deduction").val();
    var other_deduction = $("#other_deduction").val();

    var gross_salary = (+basic_salary + +house_rent_allowance + +medical_allowance + +special_allowance + +other_allowance);

    var total_deduction = (+tax_deduction + +provident_fund_deduction + +other_deduction);

    $("#total_pf").val(+provident_fund_contribution + +provident_fund_deduction);

    $("#gross_salary").val(gross_salary);
    $("#total_deduction").val(total_deduction);
    $("#net_salary").val(+gross_salary - +total_deduction);
  }

  $(document).ready(function () {
        $("#selection_update-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
                var reloadUrl = "<?php echo echo_uri("salary/salaray_list"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
    });
</script>
<!--darini end-->