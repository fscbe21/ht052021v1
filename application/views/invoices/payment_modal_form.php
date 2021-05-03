<?php echo form_open(get_uri("invoice_payments/save_payment"), array("id" => "invoice-payment-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <input type="hidden" name="previous_amount" value="<?php echo  $model_info->amount ? to_decimal_format($model_info->amount) : 0?>" /><!--darini 11-4-->
    <?php if ($invoice_id) { ?>
        <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>" />
    <?php } else { ?>
        <div class="form-group">
            <label for="invoice_id" class=" col-md-3"><?php echo lang('invoice'); ?></label>
            <div class="col-md-9">
                <?php
                echo form_dropdown("invoice_id", $invoices_dropdown, "", "class='select2 validate-hidden' id='invoice_id' data-rule-required='true' data-msg-required='" . lang('field_required') . "' ");
                ?>
            </div>
        </div>
    <?php } ?>

    <div class="form-group">
        <label for="invoice_payment_method_id" class=" col-md-3"><?php echo lang('payment_method'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_dropdown("invoice_payment_method_id", $payment_methods_dropdown, array($model_info->payment_method_id), "class='select2'");
            ?>
        </div>
    </div>
    <!--darini 12-2-->
    <div id="chequediv" style="display:none">
    <div class="form-group">
    <label for="post_date" class=" col-md-3"><?php echo "Post Date"; ?></label>
        <div class="col-md-9">
            <?php
            echo form_input(array(
                "id" => "post_date",
                "name" => "post_date",                
                "value" => $model_info->post_date,
                "class" => "form-control",
                "placeholder" => "Post Date",
                "autocomplete" => "off",
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required")
            ));
            ?>
        </div>
    </div>

    
        
    </div>
    <!--end-->


    <div class="form-group">
        <label for="invoice_payment_date" class=" col-md-3"><?php echo lang('payment_date'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_input(array(
                "id" => "invoice_payment_date",
                "name" => "invoice_payment_date",
                "value" => $model_info->payment_date,
                "class" => "form-control",
                "placeholder" => lang('payment_date'),
                "autocomplete" => "off",
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required")
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="invoice_payment_amount" class=" col-md-3"><?php echo lang('amount'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_input(array(
                "id" => "invoice_payment_amount",
                "name" => "invoice_payment_amount",
                "value" => $model_info->amount ? to_decimal_format($model_info->amount) : "",
                "class" => "form-control",
                "placeholder" => lang('amount'),
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="invoice_payment_note" class="col-md-3">Payment reference</label>
        <div class=" col-md-9">
            <?php
            echo form_textarea(array(
                "id" => "invoice_payment_note",
                "name" => "invoice_payment_note",
                "value" => $model_info->note ? $model_info->note : "",
                "class" => "form-control",
                "placeholder" => "Payment reference",
                "data-rich-text-editor" => true
            ));
            ?>
        </div>
    </div>
    <input type="hidden" name="oldimage" value="<?php echo $model_info->image ? $model_info->image : NULL;
?>"/>
</div>

<div class="modal-footer">
    <div id="post-dropzone" class="post-dropzone box-content form-group">
        <?php $this->load->view("includes/dropzone_preview"); ?>

        <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i>&nbsp;Upload Payment proof</button>
        
    </div>

    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#invoice-payment-form").appForm({
            onSuccess: function (result) {
                if (typeof RELOAD_VIEW_AFTER_UPDATE !== "undefined" && RELOAD_VIEW_AFTER_UPDATE) {
                    location.reload();
                } else {
                    if ($("#invoice-payment-table").length) {
                        //it's from invoice details view
                        $("#invoice-payment-table").appTable({newData: result.data, dataId: result.id});
                        $("#invoice-total-section").html(result.invoice_total_view);
                        if (typeof updateInvoiceStatusBar == 'function') {
                            updateInvoiceStatusBar(result.invoice_id);
                        }
                    } else {
                        //it's from invoices list view
                        //update table data
                        $("#" + $(".dataTable:visible").attr("id")).appTable({reload: true});
                    }
                }
            }
        });
        $("#invoice-payment-form .select2").select2();

        setDatePicker("#invoice_payment_date");
  //darini 12-2
  setDatePicker("#post_date");

if($('select[name="invoice_payment_method_id"]').val()==5){

   document.getElementById("chequediv").style.display="block";
}else{
    document.getElementById("chequediv").style.display="none";
}       
});

$(document).ready(function(){



$('select[name="invoice_payment_method_id"]').on('change', function() {
       // alert( this.value );
       if(this.value==5){
            document.getElementById("chequediv").style.display="block";
       }else{
            document.getElementById("chequediv").style.display="none";
       }
});

});

$(document).ready(function () {

var uploadUrl = "<?php echo get_uri("invoice_payments/upload_file"); ?>";
var validationUrl = "<?php echo get_uri("invoice_payments/validate_post_file"); ?>";
var dropzone = attachDropzoneWithForm("#post-dropzone", uploadUrl, validationUrl);

$("#post-form").appForm({
    isModal: false,
    onSuccess: function (result) {
        if ($("body").hasClass("dropzone-disabled")) {
            location.reload();
        } else {
            $("#post_description").val("");
            $("#invoicepayment").prepend(result.data);
            dropzone.removeAllFiles();
        }
    }
});

});
//end
</script>