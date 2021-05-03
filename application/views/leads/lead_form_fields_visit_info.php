<input type="hidden" name="lead_id" value="<?php echo $model_info->id; ?>" />
<div class="form-group">
    <label for="lead_source_id" class="<?php echo $label_column; ?>"><?php echo lang('source'); ?></label>
    <!--darini 11-2-->
    <div class="form-group <?php echo $field_column; ?>">
    <div style="display:none">
        <?php
        $lead_source = array();

        foreach ($sources as $source) {
            $lead_source[$source->id] = $source->title;
            //darini11-2
            if( $source->id==$model_info->lead_source_id){
                $sorce_name=$source->title;
            }
        }

        echo form_dropdown("lead_source_id", $lead_source, array($model_info->lead_source_id), "class='form-control select2'");
        ?>
        </div>
        <input type="text" class="form-control" value="<?php  echo $sorce_name;?>" readonly>
         <!--end-->
    </div>
</div>



<div class="form-group">
    <label for="lead_status_id" class="<?php echo $label_column; ?>"><?php echo lang('status'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        foreach ($statuses as $status) {
            $lead_status[$status->id] = $status->title;
        }

        echo form_dropdown("lead_status_id", $lead_status, array($model_info->lead_status_id), "class='form-control select2 lead-status-id'");
        ?>
    </div>
</div>

<div class="form-group">
    <label for="followup_date" class="<?php echo $label_column; ?>"><?php echo lang('followup_date'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
            echo form_input(array(
                "id" => "ffdate",
                "name" => "followup_date",
                "class" => "form-control",
                "value" => "",
                "placeholder" => lang('followup_date'),
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
        ?>
    </div>
</div>
<!--darini 11-2 -->
<div class="form-group">
    <label for="followup_through" class="<?php echo $label_column; ?>"><?php echo "FollowUp through"; ?></label>
    <div class="<?php echo $field_column; ?>">
       <select class="form-control" name="followup_through" id="followup_through"></select>
    </div>
</div>
<!--end-->
<div class="form-group">
    <label for="time" class="<?php echo $label_column; ?>"><?php echo lang('time'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
            echo form_input(array(
                "id" => "sstime",
                "name" => "time",
                "value" => "",
                "class" => "form-control",
                "placeholder" => lang('time')
            ));
        ?>
    </div>
</div>

<div class="form-group"style="display:none"><!--darini 11-2-->
    <label for="total_value" class="<?php echo $label_column; ?>"><?php echo lang('total_value'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "total_value",
            "name" => "total_value",
            "value" => $model_info->total_value,
            "class" => "form-control",
            "placeholder" => lang('total_value'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
<label for="description" class="<?php echo $label_column; ?>"><?php echo 'Description'; ?></label>
<div class="<?php echo $field_column; ?>">
    <?php
    echo form_textarea(array(
        "id" => "description",
        "name" => "description",
        "value" => $model_info->description,
        "placeholder" => lang('description'),
        "class" => "form-control"
    ));
    ?>
</div>
</div>
<!--darini 10-2-->
<div style="display:none"><input type="hidden" name="owner_id" id="owner_id" value="<?php echo $model_info->owner_id;?>"/></div>
<!--end-->
<script type="text/javascript">
 $(document).ready(function () {
    setDatePicker("#ffdate", {
            startDate: moment().add(0, 'days').format("DD-MM-YYYY")
        });
   // setTimePicker("#start_time, #end_time");
    $("#sstime").timepicker({
            'timeFormat': 'H:i:s'
        }); 

        $("#ffdate").datepicker().datepicker("setDate", new Date());
 });


</script>