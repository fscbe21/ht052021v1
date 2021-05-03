<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
       
         <h4 class="pl15 pt10 pr15"><?php echo "Account Statement"; ?></h4>
         <hr>
           
        

        <div class="tab-content" style="padding:30px">
           <div class="form-group col-md-12">
           <div class="col-sm-offset-3 col-sm-6">


           <?php echo form_open(get_uri("accounting/view_statement"), array("id" => "project-form", "class" => "general-form", "role" => "form")); ?>
            <div class="modal-body clearfix">
       

            <div class="form-group">
                <label for="account_id" class="<?php echo $label_column; ?>"><?php echo "From Account"; ?></label>
                <div class="<?php echo $field_column; ?>">
                <select name="account_id" class="form-control" required>   
                                <option value="" > Select Account</option> 
                                <?php foreach($accounts as $account){?>
                                    <option value="<?php echo $account->id; ?>" ><?php echo $account->name; ?></option>
                                <?php }  ?>                                                      
                                </select>
                </div>
            </div>

            <div class="form-group">
                <label for="type" class="<?php echo $label_column; ?>"><?php echo "Type"; ?></label>
                <div class="<?php echo $field_column; ?>">
                <select name="type" class="form-control" required>   
                                <option value="0" >All</option> 
                                <option value="1" >Debit</option> 
                                <option value="2" >Credit</option>            

                                </select>
                </div>
            </div>




            <div class="form-group ">
                <label for="date" class="<?php echo $label_column; ?>"><?php echo "Choose Date"; ?></label>
                <div class="col-md-4">
                    <?php
                    echo form_input(array(
                        "id" => "from_date",
                        "name" => "from_date",
                        "value" =>  $info->amount,
                        "class" => "datepicker form-control",
                        "placeholder" => "Select Date",
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                        "autocomplete" => "off",
                        "required"=>true
                    ));
                    ?>
                </div>
                <div class=" col-md-4">
                    <?php
                    echo form_input(array(
                        "id" => "to_date",
                        "name" => "to_date",
                        "value" =>  $info->amount,
                        "class" => "datepicker form-control",
                        "placeholder" => "Select Date",
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                        "autocomplete" => "off",
                        "required"=>true
                    ));
                    ?>
                </div>
            </div>







            </div>

            <div class="modal-footer">
             
                <button type="submit" class="btn btn-primary"><span class="fa fa-arrow-right"></span>  Submit </button>
            </div>
            <?php echo form_close(); ?>

</div>
</div>
</div>
</div>
</div>



<script type="text/javascript">
   $(document).ready(function () {
       
     
        $("#project-form .select2").select2();
        
        setDatePicker("#from_date", {
            //startDate: moment().add(0, 'days').format("MM-YYYY")
        });

        setDatePicker("#to_date", {
            //startDate: moment().add(0, 'days').format("MM-YYYY")
        });
       
       
      
    });
</script>  
