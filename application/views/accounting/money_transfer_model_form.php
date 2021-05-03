<?php echo form_open(get_uri("accounting/save_money_transfer"), array("id" => "project-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
<input type="hidden" value="<?php echo $info->id;?>" id="id" name="id"/>

<div class="form-group">
    <label for="from_account_id" class="<?php echo $label_column; ?>"><?php echo "From Account"; ?></label>
    <div class="<?php echo $field_column; ?>">
    <select name="from_account_id" class="form-control" required>   
                    <option value="" > Select Account</option> 
                    <?php foreach($accounts as $account){?>
                        <option value="<?php echo $account->id; ?>" <?php if($info->from_account_id==$account->id) {?> selected='selected'<?php }?>><?php echo $account->name; ?></option>
                    <?php }  ?>                                                      
                    </select>
    </div>
</div>

<div class="form-group">
    <label for="to_account_id" class="<?php echo $label_column; ?>"><?php echo "To Account"; ?></label>
    <div class="<?php echo $field_column; ?>">
    <select name="to_account_id" class="form-control" required>   
                    <option value="" > Select Account</option> 
                    <?php foreach($accounts as $account){?>
                        <option value="<?php echo $account->id; ?>" <?php if($info->to_account_id==$account->id) {?> selected='selected'<?php }?>><?php echo $account->name ; ?></option>
                    <?php }  ?>                                                      
                    </select>
    </div>
</div>




<div class="form-group ">
    <label for="amount" class="<?php echo $label_column; ?>"><?php echo "Amount"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "amount",
            "name" => "amount",
            "value" =>  $info->amount,
            "class" => "form-control",
            "placeholder" => "Increment Amount",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
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
                var reloadUrl = "<?php echo echo_uri("accounting/money_transfer"); ?>";
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



    




