<?php echo form_open(get_uri("deduction/save"), array("id" => "deduction-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />
<div class="modal-body clearfix">
<input type="hidden" name="id" value="<?php echo isset($deduction_id) ? $deduction_id : ''; ?>"/>

<div class="form-group">
    <label for="empy_id" class="<?php echo $label_column; ?>"><?php echo "Employee Name"; ?></label>
    <div class="<?php echo $field_column; ?>">
    <select name="user_id" class="form-control" required>   
            <option value="" > Select Employee</option> 

            <?php 
                $userid = isset($deduction_userid) ? $deduction_userid : 0;
            ?>
                    <?php foreach($employee_list as $emp){?>
                        <option 
                        
                        <?php
                            if($userid != 0){
                                echo ($deduction_userid == $emp->id) ? ' selected' : '';
                            }
                        ?>
                        value="<?php echo $emp->id; ?>"><?php echo $emp->first_name." ".$emp->last_name ; ?>
            </option>
                    <?php }  ?>                                                      
        </select>
    </div>
</div>

<div class="form-group ">
    <label for="deduction_name" class="<?php echo $label_column; ?>"><?php echo "Deduction Name"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "deduction_name",
            "name" => "deduction_name",
            "value" => isset($deduction_name) ? $deduction_name : '',
            "class" => "form-control",
            "placeholder" => "Deduction Name",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="month" class="<?php echo $label_column; ?>"><?php echo "Deduction month"; ?></label>
    <div class="<?php echo $field_column; ?>">
    <input type="month" value="<?php echo isset($deduction_month) ? $deduction_month : ''; ?>" name="deduction_month" class="form-control" required>
    </div>
</div>

<div class="form-group ">
    <label for="amt" class="<?php echo $label_column; ?>"><?php echo "Deduction Amount"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "amt",
            "name" => "deduction_amount",
            "value" => isset($deduction_amount) ? $deduction_amount : '',
            "class" => "form-control",
            "placeholder" => "Deduction Amount",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="deduction_purpose" class="<?php echo $label_column; ?>"><?php echo "Deduction Purpose"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "deduction_purpose",
            "name" => "deduction_purpose",
            "value" => isset($deduction_purpose) ? $deduction_purpose : '',
            "class" => "form-control",
            "placeholder" => "Deduction Purpose"
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
        $("#deduction-form").appForm({
            onSuccess: function (result) {
                console.log("res"+result.message);
                appAlert.success(result.message, {duration: 10000});
                var reloadUrl = "<?php echo echo_uri("deduction"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
     
        $("#deduction-form .select2").select2();
        setDatePicker("#month", {
            startDate: moment().add(0, 'days').format("MM-YYYY")
        });

        //setTimePicker("#start_time");

        $("#start_time").timepicker({
            'timeFormat': 'H:i:s',
            'step': '10',
            'forceRoundTime': true,
            'scrollDefault': '10:00:00',

        });
        
      
    });
</script>    



