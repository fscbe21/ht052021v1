<!-- AG -->
<?php echo form_open(get_uri("bonus/save"), array("id" => "bonus-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />
<div class="modal-body clearfix">
<input type="hidden" name="id" value="<?php echo isset($bonus_id) ? $bonus_id : ''; ?>"/>

<div class="form-group">
    <label for="empy_id" class="<?php echo $label_column; ?>"><?php echo "Bonus Name"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <select name="bonus_group_id" class="form-control" required>   
            <option value="" > Select Bonus Group</option> 

            <?php 
                $bonusgroupid = isset($bonus_group_id) ? $bonus_group_id : 0;
            ?>
                    <?php foreach($employee_list as $emp){?>
                        <option 
                        
                        <?php
                            if($bonusgroupid != 0){
                                echo ($bonusgroupid == $emp->id) ? ' selected' : '';
                            }
                        ?>
                        value="<?php echo $emp->id; ?>"><?php echo $emp->name; ?>
            </option>
                    <?php }  ?>                                                      
        </select>
    </div>
</div>

<div class="form-group ">
    <label for="bonus_name" class="<?php echo $label_column; ?>"><?php echo "Bonus Name"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "bonus_name",
            "name" => "bonus_name",
            "value" => isset($bonus_name) ? $bonus_name : '',
            "class" => "form-control",
            "placeholder" => "Bonus Name",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="month" class="<?php echo $label_column; ?>"><?php echo "Bonus month"; ?></label>
    <div class="<?php echo $field_column; ?>">
<!-- AG2402 -->
        <input type="month" value="<?php echo isset($bonus_month) ? $bonus_month : ''; ?>" name="bonus_month" class="form-control" required>
    </div>
</div>

<div class="form-group ">
    <label for="amt" class="<?php echo $label_column; ?>"><?php echo "Bonus Percentage"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "amt",
            "name" => "bonus_percentage",
            "value" => isset($bonus_percentage) ? $bonus_percentage : '',
            "class" => "form-control",
            "placeholder" => "Bonus Percentage",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="bonus_purpose" class="<?php echo $label_column; ?>"><?php echo "Bonus Purpose"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "bonus_purpose",
            "name" => "bonus_purpose",
            "value" => isset($bonus_purpose) ? $bonus_purpose : '',
            "class" => "form-control",
            "placeholder" => "Bonus Purpose"
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
        $("#bonus-form").appForm({
            onSuccess: function (result) {
                console.log("res"+result.message);
                appAlert.success(result.message, {duration: 10000});
                var reloadUrl = "<?php echo echo_uri("bonus"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });      
      
    });

</script>    



