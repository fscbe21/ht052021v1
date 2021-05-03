<?php echo form_open(get_uri("vechicle_services/save"), array("id" => "other-area-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <input type="hidden" name="service_type" value="<?php echo $model_info->service_type; ?>" />

    <input type="hidden" name="v_number" value="<?php echo $model_info->v_number; ?>" />

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Bill No"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "bill_no",
                "value" => $model_info->bill_no,
                "class" => "form-control",
                "placeholder" => "Bill No",
               
            ));
            ?>
        </div>
    </div>


    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Vechicle Number"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "v_number",
                "name" => "v_number",
                "value" => $model_info->v_number,
                "class" => "form-control",
                "placeholder" => "Vechicle Number",
              
            ));
            ?>
        </div>
    </div>


    

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Amount"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "amount",
               
                "value" => $model_info->amount,
                "class" => "form-control",
                "placeholder" => "Amount",
                
            ));
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Insurance Company"; ?></label>
        <div class=" col-md-9">
        <select id="" name="insurance_company" class="form-control">   
                    <option value="" >Select Insurance Company</option> 
                    <?php foreach($insurance_cmpdata as $inscmp){?>
                    <option
                    
                    <?php echo ($inscmp->id == $model_info->insurance_company) ? ' selected' : ''; ?>
                    
                     value="<?php echo $inscmp->id; ?>"><?php echo $inscmp->title; ?> </option>
                    <?php }  ?>                                                    
                </select>
            <?php
            /*echo form_input(array(
                "id" => "title",
                "name" => "insurance_company",
                "value" => $model_info->insurance_company,
                "class" => "form-control",
                "placeholder" => "Driver Name",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));*/
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Insurance Type"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "insurance_type",
                "value" => $model_info->insurance_type,
                "class" => "form-control",
                "placeholder" => "Insurance Type",
               
            ));
            ?>
        </div>

        


    </div>


    <div class="form-group" id="insurance_dates">
        <label for="title" class=" col-md-3"><?php echo "Insurance  From Date"; ?></label>
        <div class=" col-md-4">
            <?php
            echo form_input(array(
                //"id" => "insurance_type",
                "name" => "insurance_from_date",
                "value" => $model_info->insurance_from_date,
                "class" => "form-control",
                "type" => "date",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
               
            ));
            ?>
        </div>
        <label for="title" class=" col-md-2"><?php echo "Insurance Expiry Date"; ?></label>
        <div class=" col-md-3">
            <?php
            echo form_input(array(
                //"id" => "insurance_type",
                "name" => "insurance_exp_date",
                "value" => $model_info->insurance_exp_date,
                "class" => "form-control",
                "type" => "date",
                "placeholder" => "",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
               
            ));
            ?>
        </div>
    </div>

    <div class="form-group"  id="pay_mode">
    <label for="title" class=" col-md-3"><?php echo "Pay Mode"; ?></label>
    <div class=" col-md-4">
    <select name="pay_mode" class="form-control" required>   
        <option value="">Select Pay Mode</option>
        <option value="1" <?php echo ($model_info->pay_mode == 1) ? ' selected' : ''; ?>>Credit</option>
        <option value="2" <?php echo ($model_info->pay_mode == 2) ? ' selected' : ''; ?>>Cash</option>
                                    
    </select>
</div>



    <label for="title" class=" col-md-2"><?php echo "Tax Mode"; ?></label>
    <div class=" col-md-3">
    <select name="tax_mode" class="form-control" required>   
        <option value="">Select Tax Mode</option>
        <option value="1" <?php echo ($model_info->tax_mode == 1) ? ' selected' : ''; ?> >With Tax</option>
        <option value="2" <?php echo ($model_info->tax_mode == 2) ? ' selected' : ''; ?>>Without Tax</option>
                                    
    </select>
</div>


</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">

document.getElementById("v_number").readOnly = true;
    $(document).ready(function () {
        $("#other-area-form").appForm({
            onSuccess: function (result) {
                $("#other-area-table").appTable({newData: result.data, dataId: result.id});
            }
        });

        $("#title").focus();
    });
</script>    