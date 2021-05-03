<?php echo form_open(get_uri("invoices/save_discount_item"), array("id" => "discount-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <input type="hidden" name="rate" value="<?php echo $model_info->rate; ?>" />
    <input type="hidden" name="quantity" value="<?php echo $model_info->quantity; ?>" />
    <input type="hidden" name="invoice_id" value="<?php echo $model_info->invoice_id; ?>" />
    <?php $total=$model_info->rate * $model_info->quantity?>
    <div class="form-group">
        <label for="discount" class="col-md-3"><?php echo lang('discount'); ?></label>
        <div class="col-md-4">
            <?php
            echo form_input(array(
                "id" => "discount",
                "name" => "discount_amount",
                "value" => $model_info->discount ? ($model_info->discount*100)/$total : "",
                "class" => "form-control",
                "autofocus" => "true",
                "placeholder" => lang('discount'),
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
        <div class="col-md-5">
            <?php
            $discount_percentage_dropdown = array("percentage" => lang("percentage"));
            echo form_dropdown("discount_amount_type", $discount_percentage_dropdown, $model_info->discount_amount_type, "class='select2'");
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
        $("#discount-form").appForm({
            onSuccess: function (result) {
                if (result.success ) {
                    location.reload();
                } else {
                    appAlert.error(result.message);
                }
            }
        });

        $("#discount-form .select2").select2();
    });

</script>