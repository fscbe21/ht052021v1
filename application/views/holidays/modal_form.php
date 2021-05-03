<?php echo form_open(get_uri("holidays/save"), array("id" => "holidays-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
<input type="hidden" value="<?php echo $info->id;?>" id="id" name="id"/>

<div class="form-group">
    <label class="<?php echo $label_column; ?>"><?php echo "Holiday Name"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "name",
            "name" => "name",
            "value" =>  $info->name,
            "class" => "form-control",
            "placeholder" => "Holiday Name"
        ));
        ?>

    </div>
</div>

<div class="form-group">
    <label class="<?php echo $label_column; ?>"><?php echo "Start Date"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "start_date",
            "name" => "start_date",
            "value" =>  $info->start_date,
            "class" => "form-control",
            "placeholder" => "Select start date"
        ));
        ?>

    </div>
</div>

<div class="form-group">
    <label class="<?php echo $label_column; ?>"><?php echo "End Date"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "end_date",
            "name" => "end_date",
            "value" =>  $info->end_date,
            "class" => "form-control",
            "placeholder" => "Select end date"
        ));
        ?>

    </div>
</div>

<div class="form-group">
    <label class="<?php echo $label_column; ?>"><?php echo "Holiday Purpose"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "holiday_purpose",
            "name" => "holiday_purpose",
            "value" =>  $info->holiday_purpose,
            "class" => "form-control",
            "placeholder" => "Holiday Purpose"
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
        $("#holidays-form").appForm({
            onSuccess: function (result) {
                console.log("res"+result.message);
                appAlert.success(result.message, {duration: 10000});
                var reloadUrl = "<?php echo echo_uri("holidays"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });

         /* setDatePicker("#start_date", {
            startDate: moment().add(0, 'days').format("DD-MM-YYYY")
        }); */

        /* setDatePicker("#end_date", {
            startDate: moment().add(0, 'days').format("DD-MM-YYYY")
        }); */ 

        
        setDatePicker("#start_date");   
        setDatePicker("#end_date");
        
    });
</script>  



    




