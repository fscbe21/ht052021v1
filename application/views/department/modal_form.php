<?php echo form_open(get_uri("department/save"), array("id" => "department-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('department').' '.lang('name'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "department_name",
                "name" => "department_name",
                "value" => $model_info->name ? $model_info->name : "",
                "class" => "form-control",
                "placeholder" => 'Enter '.lang('department').' '.lang('name'),
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
            <input type="number" name="department_phone" class="form-control" id="department_phone" value="<?php echo $model_info->phone ? $model_info->phone : '' ?>" placeholder="Enter Phone Number" required/>
        </div>
    </div>
    <div class="form-group">
        <label for="percentage" class=" col-md-3">Email Address</label>
        <div class=" col-md-9">
            <input type="email" name="department_email" class="form-control" id="department_email" value="<?php echo $model_info->email ? $model_info->email : '' ?>" placeholder="Enter Email Address" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">Department Address</label>
        <div class=" col-md-9">
        <textarea placeholder="Enter Department Address" name="department_address" class="form-control"><?php echo $model_info->address ? $model_info->address : '' ?></textarea>
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
        $("#department-form").appForm({
            onSuccess: function(result) {
                $("#department-table").appTable({newData: result.data, dataId: result.id});
            }
        });
        $("#title").focus();
    });
</script>    