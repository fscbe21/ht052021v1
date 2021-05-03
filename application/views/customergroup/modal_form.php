<?php echo form_open(get_uri("customergroup/save"), array("id" => "customergroup-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('customergroup').' '.lang('name'); ?>*</label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "customergroup_name",
                "name" => "customergroup_name",
                "value" => $model_info->name ? $model_info->name : "",
                "class" => "form-control",
                "placeholder" => 'Enter '.lang('customergroup').' '.lang('name'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="percentage" class=" col-md-3">Percentage *</label>
        <div class=" col-md-9">
            <input type="text" name="percentage" class="form-control" id="percentage" value="<?php echo $model_info->percentage ? $model_info->percentage : '0' ?>" placeholder="Enter Percentage" min="0" max="100" required />
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
        $("#customergroup-form").appForm({
            onSuccess: function(result) {
                $("#customergroup-table").appTable({newData: result.data, dataId: result.id});
            }
        });
        $("#customergroup_name").focus();
    });
</script>    