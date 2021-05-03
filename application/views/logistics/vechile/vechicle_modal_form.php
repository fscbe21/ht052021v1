<?php echo form_open(get_uri("logistics/vechiclesave"), array("id" => "other-area-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('vechicle_num'); ?></label>
        <div class=" col-md-9">
           <input type="text" value="<?= $model_info->v_number; ?>" name="v_number" class="form-control" placeholder="Vehicle Number" <?= ($model_info->id) ? ' readonly' : ''; ?>/>
           <!--  <?php
            echo form_input(array(
                "id" => "title",
                "name" => "v_number",
                "value" => $model_info->v_number,
                "class" => "form-control",
                "placeholder" => lang('vechicle_num'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?> -->
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Vehicle Model"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "v_model",
                "value" => $model_info->v_model,
                "class" => "form-control",
                "placeholder" => "vehicle Model",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "vehicle Name"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "v_name",
                "value" => $model_info->v_name,
                "class" => "form-control",
                "placeholder" => "vehicle Name",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>


    <!--<div class="form-group">
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
    </div>-->

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Speedometer Open Reading"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "spm_open_reading",
                "value" => $model_info->spm_open_reading,
                "class" => "form-control",
                "type" => "number",
                "placeholder" => "Speedometer Open Reading",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Engine Number"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "engine_number",
                "value" => $model_info->engine_number,
                "class" => "form-control",
                "placeholder" => "Engine Number",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Chassis Number"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "chassis_number",
                "value" => $model_info->chassis_number,
                "class" => "form-control",
                "placeholder" => "Chassis Number",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "FC"; ?></label>
        <label for="title" class=" col-md-2"><?php echo "From Date"; ?></label>
        <div class=" col-md-4">
        
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "fc_from_date",
                "type" => "date",
                "value" => $model_info->fc_from_date,
                "class" => "form-control",
                "placeholder" => lang('vechicle_num'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
        
    </div>
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo ""; ?></label>
    <label for="title" class=" col-md-2"><?php echo "To Date"; ?></label>
        <div class=" col-md-4">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "fc_to_date",
                "type" => "date",
                "value" => $model_info->fc_to_date,
                "class" => "form-control",
                "placeholder" => lang('vechicle_num'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
</div>

<div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Insurance Id"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "insurance_id",
                "value" => $model_info->insurance_id,
                "class" => "form-control",
                "placeholder" => "Insurance Id",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Insurance"; ?></label>
        <label for="title" class=" col-md-2"><?php echo "From Date"; ?></label>
        <div class=" col-md-4">
        <input type="date" value="<?= $model_info->insurance_f_date; ?>" name="insurance_f_date" class="form-control" <?= ($model_info->id) ? ' readonly' : ''; ?>/>
           <!--  <?php
            echo form_input(array(
                "id" => "title",
                "name" => "insurance_f_date",
                "type" => "date",
                "value" => $model_info->insurance_f_date,
                "class" => "form-control",
                "placeholder" => lang('vechicle_num'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?> -->
        </div>
        
    </div>
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo ""; ?></label>
    <label for="title" class=" col-md-2"><?php echo "To Date"; ?></label>
        <div class=" col-md-4">
            <input type="date" value="<?= $model_info->insurance_t_date; ?>" name="insurance_t_date" class="form-control" <?= ($model_info->id) ? ' readonly' : ''; ?>/>
            <!-- <?php
            echo form_input(array(
                "id" => "title",
                "name" => "insurance_t_date",
                "type" => "date",
                "value" => $model_info->insurance_t_date,
                "class" => "form-control",
                "placeholder" => lang('vechicle_num'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?> -->
        </div>
</div>

<div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Insurance Value"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "insurance_value",
                "value" => $model_info->insurance_value,
                "class" => "form-control",
                "placeholder" => "Insurance Value",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    <!-- <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Insurance Company Name"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "insurance_cname",
                "value" => $model_info->insurance_cname,
                "class" => "form-control",
                "placeholder" => "Insurance Company Name",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div> -->
    <div class="form-group" id="insurance_cname">
        <label for="title" class=" col-md-3"><?php echo "Insurance Company"; ?></label>
        <div class=" col-md-9">

        <select id="" name="insurance_cname" class="form-control" required>   
                    <option value="" >Select Insurance Company</option> 
                    <?php foreach($insurance_cmpdata as $inscmp){?>
                    <option
                    
                    <?php echo ($inscmp->id == $model_info->insurance_cname) ? ' selected' : ''; ?>
                    
                     value="<?php echo $inscmp->id; ?>"><?php echo $inscmp->title; ?> </option>
                    <?php }  ?>                                                    
                </select>
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
                location.reload();
            }
        });

        $("#title").focus();
    });
</script>    