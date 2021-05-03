<?php echo form_open(get_uri("accounting/save_account"), array("id" => "project-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
<input type="hidden" value="<?php echo $info->id;?>" id="id" name="id"/>
<div class="form-group">
    <label for="account_no" class="<?php echo $label_column; ?>"><?php echo "Account No"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "account_no",
            "name" => "account_no",
           
            "value" => $info->account_no,
            "class" => "form-control",
            "placeholder" => "Account No",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
            "required"=>true
        ));
        ?>
    </div>
</div>




<div class="form-group ">
    <label for="name" class="<?php echo $label_column; ?>"><?php echo "Name "; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "name",
            "name" => "name",
            "value" =>  $info->name,
            "class" => "form-control",
            "placeholder" => "Name",
            "required"=>true,
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group ">
    <label for="initial_balance" class="<?php echo $label_column; ?>"><?php echo "Initial Balance"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "initial_balance",
            "name" => "initial_balance",
            "value" =>  $info->initial_balance,
            "class" => "form-control",
            "placeholder" => "Initial Balance",
         
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="note" class="<?php echo $label_column; ?>"><?php echo "Note"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "note",
            "name" => "note",
            "value" =>  $info->note,
            "class" => "form-control",
            "placeholder" => "Note"
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
                var reloadUrl = "<?php echo echo_uri("accounting"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
     
        $("#project-form .select2").select2();
        
     
       
      
    });
</script>  