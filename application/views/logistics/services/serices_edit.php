<?php echo form_open(get_uri("vechicle_services/save"), array("id" => "other-area-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <input type="hidden" name="service_type" value="<?php echo $model_info->service_type; ?>" />

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
        <label for="title" class=" col-md-3"><?php echo "Driver Name"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "driver_name",
                "name" => "driver_name",
                "value" => $model_info->driver_name,
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
        <label for="title" class=" col-md-3"><?php echo "Notes"; ?></label>
        <div class=" col-md-9">
        
            <?php
            echo form_textarea(array(
                "id" => "",
                "name" => "notes",
                "value" => $model_info->notes,
                "class" => "form-control",
                "placeholder" => "Notes",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>

        <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Service type"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "typeof_service",
               
                "value" => $model_info->typeof_service,
                "class" => "form-control",
                "placeholder" => "Service type",
                
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



    <label for="title" class=" col-md-1"><?php echo "Tax Mode"; ?></label>
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