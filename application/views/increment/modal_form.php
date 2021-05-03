<?php echo form_open(get_uri("increment/save"), array("id" => "project-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
<input type="hidden" value="<?php echo $info->id;?>" id="id" name="id"/>

<div class="form-group">
    <label for="user_id" class="<?php echo $label_column; ?>"><?php echo "Employee Name"; ?></label>
    <div class="<?php echo $field_column; ?>">
    <select name="user_id" class="form-control" required>   
                    <option value="" > Select Employee</option> 
                    <?php foreach($employee_list as $emp){?>
                        <option value="<?php echo $emp->id; ?>" <?php if($info->emp_id==$emp->id) {?> selected='selected'<?php }?>><?php echo $emp->first_name." ".$emp->last_name ; ?></option>
                    <?php }  ?>                                                      
                    </select>
    </div>
</div>







<div class="form-group">
    <label for="month" class="<?php echo $label_column; ?>"><?php echo "Select month"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "month",
            "name" => "month",
            "value" => $info->date,
            "class" => "form-control",
            "placeholder" => "Select month",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),

        ));
        ?>
    </div>
</div>




<div class="form-group ">
    <label for="amt" class="<?php echo $label_column; ?>"><?php echo "Increment Amount"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "amt",
            "name" => "amt",
            "value" =>  $info->amount,
            "class" => "form-control",
            "placeholder" => "Increment Amount",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="increment_purpose" class="<?php echo $label_column; ?>"><?php echo "Increment Purpose"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "increment_purpose",
            "name" => "increment_purpose",
            "value" =>  $info->incr_purpose,
            "class" => "form-control",
            "placeholder" => "Increment Purpose"
        ));
        ?>

    </div>
</div>






</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>





<script type="text/javascript">
   $(document).ready(function () {
        $("#project-form").appForm({
            onSuccess: function (result) {
                console.log("res"+result.message);
                appAlert.success(result.message, {duration: 10000});
                var reloadUrl = "<?php echo echo_uri("increment"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
     
        $("#project-form .select2").select2();
        
        setDatePicker("#month", {
            startDate: moment().add(0, 'days').format("MM-YYYY")
        });
       
      
    });
</script>  



    




