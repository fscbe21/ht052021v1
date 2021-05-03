<?php echo form_open(get_uri("warehouse/save"), array("id" => "warehouse-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('warehouse').' '.lang('name'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "warehouse_name",
                "name" => "warehouse_name",
                "value" => $model_info->name ? $model_info->name : "",
                "class" => "form-control",
                "placeholder" => 'Enter '.lang('warehouse').' '.lang('name'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="percentage" class=" col-md-3">Phone Number</label>
        <div class=" col-md-9">
            <input type="number" name="warehouse_phone" class="form-control" id="warehouse_phone" value="<?php echo $model_info->phone ? $model_info->phone : '' ?>" placeholder="Enter Phone Number" required/>
        </div>
    </div>
    <div class="form-group">
        <label for="percentage" class=" col-md-3">Email Address</label>
        <div class=" col-md-9">
            <input type="email" name="warehouse_email" class="form-control" id="warehouse_email" value="<?php echo $model_info->email ? $model_info->email : '' ?>" placeholder="Enter Email Address" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">Warehouse Address</label>
        <div class=" col-md-9">
        <textarea placeholder="Enter Warehouse Address" name="warehouse_address" class="form-control"><?php echo $model_info->address ? $model_info->address : '' ?></textarea>
        </div>
    </div>
</div>



<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#warehouse-form").appForm({
            onSuccess: function(result) {
                $("#warehouse-table").appTable({newData: result.data, dataId: result.id});
            }
        });
        $("#title").focus();
    });
</script>    