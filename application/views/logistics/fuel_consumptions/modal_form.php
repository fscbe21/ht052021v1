<?php echo form_open(get_uri("fuel_consumptions/save"), array("id" => "other-area-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Vechicle Number"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "v_number",
                "value" => $model_info->v_number,
                "class" => "form-control",
                "placeholder" => "Vechicle Number",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>


    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Speedometer Reading"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "spm_reading",
                "value" => $model_info->spm_reading,
                "class" => "form-control",
                "placeholder" => "Speedometer Reading",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>




    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Date"; ?></label>
        <div class=" col-md-4">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "date",
                "type" => "date",
                "value" => $model_info->date,
                "class" => "form-control",
                "placeholder" => "Date",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Driver Name"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "driver_name",
                "value" => $model_info->driver_name,
                "class" => "form-control",
                "placeholder" => "Driver Name",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Price"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "price",
                "value" => $model_info->price,
                "class" => "form-control",
                "placeholder" => "Price",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Litter"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "litter",
                "value" => $model_info->litter,
                "class" => "form-control",
                "placeholder" => "Litter",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
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
        $("#other-area-form").appForm({
            onSuccess: function (result) {
                $("#other-area-table").appTable({newData: result.data, dataId: result.id});
            }
        });

        $("#title").focus();
    });
</script>    