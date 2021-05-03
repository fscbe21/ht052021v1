<?php

$url = "attendance/log_time";

echo form_open(get_uri($url), array("id" => "clock-in-department-form", "class" => "general-form", "role" => "form"));

?>
<div class="modal-body clearfix">

    


    <div class="form-group">

    <label for="department"  class=" col-md-12"><?php echo lang('department'); ?></label>

    <div class=" col-md-12">
        <?php
       
        $department_array =array();

        foreach ($department_dropdown as $department) {
            $department_array[$department->id] = $department->name;
        }

        echo form_dropdown("department", $department_array, array($model_info->department), "class='select2'");
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


        $(".select2").select2();


      

        // $("#attendance-note-form").appForm({
        //     onSuccess: function (result) {
        //         if (result.clock_widget) {
        //             $("#timecard-clock-out").closest("#js-clock-in-out").html(result.clock_widget);
        //         } else {
        //             if (result.isUpdate) {
        //                 $(".dataTable:visible").appTable({newData: result.data, dataId: result.id});
        //             } else {
        //                 $(".dataTable:visible").appTable({reload: true});
        //             }
        //         }
        //     }
        // });

        // $("#note").focus();

    });
</script>