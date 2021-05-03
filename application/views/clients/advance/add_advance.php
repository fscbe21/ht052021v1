<?php echo form_open(get_uri("clients/save_advance"), array("id" => "payment-form", "class" => "general-form", "role" => "form")); ?>   
<div class="modal-body clearfix" >
    <div class="table-responsive" id="sale_details">  
    <div>
   
                                <div id="payment" >
                                <input type="hidden" name="id" value="<?php echo $model_info->id ?>" />

                                <input type="hidden" name="client_id" value="<?php echo $client_id ?>" />
                                <input type="hidden" name="pre_adamt" value="<?php echo $model_info->advance_amount ?>"/>
                                
                                <div class="form-group">
        <label for="advance_amount" class="<?php echo $label_column; ?>"><?php echo "Advance Amount"; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "advance_amount",
                "name" => "advance_amount",
                "value" => $model_info->advance_amount,
                "class" => "form-control",
                "placeholder" => "Advance Amount",                
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
                "autocomplete" => "off"
            ));
            ?>
        </div>
    </div>

<div class="form-group">
    <label for="advance_date" class="<?php echo $label_column; ?>"><?php echo "Advance Date"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "advance_date",
            "name" => "advance_date",
            "value" => $model_info->advance_date ? $model_info->advance_date : "",
            "class" => "form-control",
            "placeholder" => "Advance Date",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
            "autocomplete" => "off"
        ));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="advance_notes" class="<?php echo $label_column; ?>">Notes</label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "advance_notes",
            "name" => "advance_notes",
            "value" => $model_info->advance_notes ? $model_info->advance_notes : "",
            "class" => "form-control",
            "placeholder" => "Notes"
        ));
        ?>
    </div>
</div>

                                </div>
                                                            
  </div>
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>

    
</div>   
<?php echo form_close(); ?>      
<script>
 setDatePicker("#advance_date", {
            startDate: moment().add(0, 'days').format("MM-YYYY")
        });
$(document).ready(function () {
        $("#payment-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 1000});
                var reloadUrl = "<?php echo echo_uri("clients/view/".$client_id); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
    });
</script>