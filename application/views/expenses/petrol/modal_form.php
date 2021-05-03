<!-- AG -->
<?php echo form_open(get_uri("expenses/save_petrol_allowance"), array("id" => "petrol-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />
<div class="modal-body clearfix">
<input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>"/>

<div class="form-group">
    <label for="empy_id" class="<?php echo $label_column; ?>"><?php echo "Employee Name"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <select name="user_id" class="form-control" required>   
            <option value="">Select Employee</option> 
            <?php 
                $employeeid = isset($employee_id) ? $employee_id : 0;
            ?>
                    <?php foreach($employee_list as $emp){?>
                        <option 
                        <?php
                            if($employeeid != 0){
                                echo ($employeeid == $emp->id) ? ' selected' : '';
                            }
                        ?>
                        value="<?php echo $emp->id; ?>"><?php echo $emp->first_name.' '.$emp->last_name; ?>
            </option>
                    <?php }  ?>                                                      
        </select>
    </div>
</div>

<div class="form-group">
    <label for="bonus_purpose" class="<?php echo $label_column; ?>"><?php echo "Amount"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "petrol_amount",
            "name" => "petrol_amount",
            "value" => isset($petrol_amount) ? $petrol_amount : '',
            "class" => "form-control",
            "placeholder" => "Enter petrol allowance amount"
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
        $("#petrol-form").appForm({
            onSuccess: function (result) {
                console.log("res"+result.message);
                appAlert.success(result.message, {duration: 10000});
                var reloadUrl = "<?php echo echo_uri("expenses/petrol_allowance"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
              
      
    });

</script>    



