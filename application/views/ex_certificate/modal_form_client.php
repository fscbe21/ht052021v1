<?php echo form_open(get_uri("salarylist/save"), array("id" => "other-district-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('dep'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "title",
                "value" => $model_info->title,
                "class" => "form-control",
                "placeholder" => "Enter Client Name",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
           
        </div>
    </div>


    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('publication_status'); ?></label>
        <div class=" col-md-9">
        <select name="category" class="form-control">
                                    <option value="1">Published</option>
                                    <option value="2">UnPublished</option>
                                </select>
           
        </div>
    </div>
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('dep_description'); ?></label>
        <div class=" col-md-9">
        <textarea name="description" cols="40" rows="10" id="increment_purpose" class="form-control" placeholder="Enter Client Description"></textarea>
           
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
        $("#other-district-form").appForm({

            onSuccess: function (result) {
                $("#other-district-table").appTable({newData: result.data, dataId: result.id});
            }

        });

        $("#title").focus();
    });
</script>    