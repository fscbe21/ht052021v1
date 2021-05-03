<?php echo form_open(get_uri("experience_certificate/save"), array("id" => "other-district-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

    <div class="form-group">
        <label for="employee" class="col-md-3"><?php echo lang('employee'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_input(array(
                "id" => "employee",
                "name" => "employee",
                "value" => $model_info->employee, //$model_info->employee : $this->login_user->id,
                "class" => "form-control",
                "placeholder" => "Select Employee",
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required")
            ));
            ?>
        </div>
    </div>

  <!--  <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('type'); ?></label>
        <div class=" col-md-9">
        <select name="category" class="form-control">
                                    <option value="1">NOC</option>
                                    <option value="2">Experience Certificate</option>
                                </select>
           
        </div>
    </div>-->
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('description'); ?></label>
        <div class=" col-md-9">
        <textarea name="description" cols="40" rows="10" id="increment_purpose" class="form-control" placeholder="Enter Description" required></textarea>
           
        </div>
    </div>
    
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('bottom'); ?></label>
        <div class=" col-md-9">
        <textarea name="bottom_description" cols="40" rows="10" id="increment_purpose" class="form-control" placeholder="Enter Bottom Description"></textarea>
           
        </div>
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

$('[data-toggle="tooltip"]').tooltip();

    $('#employee').select2({data: <?php echo $team_members_dropdown; ?>});
        $("#other-district-form").appForm({

            onSuccess: function (result) {
                $("#other-district-table").appTable({newData: result.data, dataId: result.id});
            }

        });

        $("#title").focus();
    });
</script>    