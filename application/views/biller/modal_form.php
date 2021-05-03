<?php echo form_open(get_uri("biller/save"), array("id" => "biller-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('biller').' '.lang('name'); ?>*</label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "biller_name",
                "name" => "biller_name",
                "value" => $model_info->name ? $model_info->name : "",
                "class" => "form-control",
                "placeholder" => 'Enter '.lang('biller').' '.lang('name'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="percentage" class=" col-md-3">Company Name *</label>
        <div class=" col-md-9">
            <input type="text" name="company_name" class="form-control" id="company_name" value="<?php echo $model_info->company_name ? $model_info->company_name : '' ?>" placeholder="Enter Company Name" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">GST Number *</label>
        <div class=" col-md-9">
            <input type="text" name="vat_number" class="form-control" id="vat_number" value="<?php echo $model_info->vat_number ? $model_info->vat_number : '' ?>" placeholder="Enter GST Number" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">Email *</label>
        <div class=" col-md-9">
            <input type="email" name="email" class="form-control" id="email" value="<?php echo $model_info->email ? $model_info->email : '' ?>" placeholder="Enter Email Address" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">Phone Number *</label>
        <div class=" col-md-9">
            <input type="number" name="phone_number" class="form-control" id="phone_number" value="<?php echo $model_info->phone_number ? $model_info->phone_number : '' ?>" placeholder="Enter Phone Number" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">Address *</label>
        <div class=" col-md-9">
            <input type="text" name="address" class="form-control" id="address" value="<?php echo $model_info->address ? $model_info->address : '' ?>" placeholder="Enter Address" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">City *</label>
        <div class=" col-md-9">
            <input type="text" name="city" class="form-control" id="city" value="<?php echo $model_info->city ? $model_info->city : '' ?>" placeholder="Enter City" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">State *</label>
        <div class=" col-md-9">
            <input type="text" name="state" class="form-control" id="state" value="<?php echo $model_info->state ? $model_info->state : '' ?>" placeholder="Enter State" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">Pincode *</label>
        <div class=" col-md-9">
            <input type="text" name="pincode" class="form-control" id="pincode" value="<?php echo $model_info->postal_code ? $model_info->postal_code : '' ?>" placeholder="Enter Pincode" required />
        </div>
    </div>

    <div class="form-group">
        <label for="percentage" class=" col-md-3">Country *</label>
        <div class=" col-md-9">
            <input type="text" name="country" class="form-control" id="country" value="<?php echo $model_info->country ? $model_info->country : 'India' ?>" placeholder="Enter Country" required />
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
        $("#biller-form").appForm({
            onSuccess: function(result) {
                $("#biller-table").appTable({newData: result.data, dataId: result.id});
            }
        });
        $("#biller_name").focus();
    });
</script>    