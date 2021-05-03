<?php echo form_open(get_uri("purchase/edit_payment"), array("id" => "payment-form", "class" => "general-form", "role" => "form")); ?>   
<div class="modal-body clearfix" >
    <div class="table-responsive" id="sale_details">  
    <div>
   
                                <div id="payment" >
                                <input type="hidden" name="purchase_id" value="<?php echo $model_info->id ?>" />

                                <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $model_info->grand_total ?>" />                                
                                <input type="hidden" name="last_paid_amount_total" value="<?php echo $model_info->paid_amount ?>" />
                                <input type="hidden" name="payment_id" value=" <?php echo $payments_info->id;?>"/>
                                <input type="hidden" name="last_paid_amount" value=" <?php echo $payments_info->amount;?>"/>
                                <input type="hidden" name="previous_payment_method" value="<?php echo $payments_info->paying_method;?>"/>
                                <input type="hidden" name="cheque_id" value="<?php echo $payments_info_cheque[0]->id; ?>"/>
                                     <div  >
                                       
                                      
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Recieved Amount *</label>
                                                <input type="number" name="paying_amount" class="form-control" id="paying-amount" value="<?php echo ($payments_info->amount+$payments_info->change)?>" step="any" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Paying Amount *</label>
                                                <input type="number" name="paid_amount" class="form-control" id="paid-amount" step="any" value="<?php echo  ($payments_info->amount)?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Change</label>
                                                <p id="change" class="ml-2"><?php echo $payments_info->change;?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Paid By</label>
                                                <select name="paid_by_id" class="form-control">
                                                <?php foreach($payment_method as $tx){?>
                                                    <option value="<?php echo $tx->id; ?>" <?php if($payments_info->paying_method== $tx->id){?> selected <?php }?> ><?php echo $tx->title; ?> </option>
                                                <?php }  ?>  
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div id="cheque"  <?php if($payments_info->paying_method!=5){?>  style="display:none" <?php }?> class="col-md-12">
                                         <div class="form-group">
                                            <label>Cheque Number *</label>
                                            <input type="text" name="cheque_no" class="form-control" value="<?php  if($payments_info->paying_method==5){echo  $payments_info_cheque[0]->cheque_no;}?>"/>
                                          </div>
                                        </div>   
                                      
                                        <div class="form-group col-md-12">
                                            <label> Account</label>
                                            <select class="form-control selectpicker" name="account_id">
                                            <?php foreach($account as $tx){?>
                                                    <option value="<?php echo $tx->id; ?>" <?php if($payments_info->account_id== $tx->id){?> selected <?php }?> ><?php echo $tx->name; ?> </option>
                                                <?php }  ?>  
                                            </select>
                                          </div>                                
                                        <div class="col-md-12">
                                            <label>Payment Note</label>
                                            <textarea rows="3" class="form-control" name="payment_note" ><?php  echo $payments_info->payment_note; ?></textarea>
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
$('input[name="paid_amount"]').on("input", function() {  
    
    if(parseFloat( $(this).val()) > parseFloat($('input[name="paying_amount"]').val()) ) {
        alert('Paying amount cannot be bigger than recieved amount');        
        $(this).val('');
        
    }
    else if( parseFloat($(this).val()) > parseFloat($('#grand_total').text()) ){
        alert('Paying amount cannot be bigger than grand total');        
        $(this).val('');        
    }
    $("#change").text( parseFloat($("#paying-amount").val() - $(this).val()).toFixed(2) );
});
$('input[name="paying_amount"]').on("input", function() {
    $("#change").text( parseFloat( $(this).val() - $("#paid-amount").val()).toFixed(2));
});

$('select[name="paid_by_id"]').on("change", function() {
    if($(this).val()==5){
     document.getElementById('cheque').style.display="block";
     
    }else{
        document.getElementById('cheque').style.display="none";
    }
});

$(document).ready(function () {
        $("#payment-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 1000});
                var reloadUrl = "<?php echo echo_uri("purchase"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
    });
</script>