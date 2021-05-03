<?php echo form_open(get_uri("invoice_payments/save_otp_payment"), array("id" => "invoice-payment-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

    <div class="form-group">
        <label for="invoice_payment_method_id" class=" col-md-3">OTP</label>
        <div class="col-md-9">
           <input class="form-control" type="text" name="otp" placeholder="Enter otp to verify your payment"/>
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