<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />





<div class="form-group">
    <label for="company_name" class="<?php echo $label_column; ?>"><?php echo lang('company_name')."*"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "company_name",
            "name" => "company_name",
            "value" => $model_info->company_name,
            "class" => "form-control",
            "placeholder" => lang('company_name'),
            "autofocus" => true,
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>




<!-- anand12022021 -->

<?php if ($this->login_user->is_admin || get_array_value($this->login_user->permissions, "client") === "all") { ?>
    <div class="form-group">
        <label for="created_by" class="<?php echo $label_column; ?>"><?php echo lang('owner'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "created_by",
                "name" => "created_by",
                "value" => $model_info->created_by ? $model_info->created_by : $this->login_user->id,
                "class" => "form-control",
                "placeholder" => lang('owner'),
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required")
            ));
            ?>
        </div>
    </div>
<?php } ?>
<!---darini 19-2-->
<div class="form-group">
    <label for="branch" class="<?php echo $label_column; ?>"><?php echo "Company Branch *"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "branch",
            "name" => "branch",
            "value" => $model_info->branch,
            "class" => "form-control",
            "placeholder" => "Company Branch",
            "autofocus" => true,
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
        <span class="show-lead-available" style="display:none;color:red"></span>
    </div>
    
</div>


<div class="form-group">
    <label for="company_unit" class="<?php echo $label_column; ?>"><?php echo "Company Unit"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "company_unit",
            "name" => "company_unit",
            "value" => $model_info->company_unit,
            "class" => "form-control",
            "placeholder" => "Company Unit"
        ));
        ?>
       
    </div>
    
</div>

<div class="form-group">
    <label for="contact_person" class="<?php echo $label_column; ?>"><?php echo lang('contact_person')."*"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "contact_person",
            "name" => "contact_person",
            "value" => $model_info->contact_person,
            "class" => "form-control",
            "placeholder" => lang('contact_person'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="person_role" class="<?php echo $label_column; ?>"><?php echo lang('person_role')."*"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "person_role",
            "name" => "person_role",
            "value" => $model_info->person_role,
            "class" => "form-control",
            "placeholder" => lang('person_role'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">

    <label for="lead_source_id" class="<?php echo $label_column; ?>"><?php echo lang('source'); ?></label>

    <div class="<?php echo $field_column; ?>">
        <?php
        $lead_source = array();

        foreach ($sources as $source) {
            $lead_source[$source->id] = $source->title;
        }

        echo form_dropdown("lead_source_id", $lead_source, array($model_info->lead_source_id), "class='select2 form-control'");
        ?>
    </div>

</div>
<!--end-->
<div class="form-group">
    <label for="address" class="<?php echo $label_column; ?>"><?php echo lang('address'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "address",
            "name" => "address",
            "value" => $model_info->address ? $model_info->address : "",
            "class" => "form-control",
            "placeholder" => lang('address')
        ));
        ?>

    </div>
</div>
<!--darini 11-2-->
<div class="form-group">
    <label for="street" class="<?php echo $label_column; ?>"><?php echo "Street"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "street",
            "name" => "street",
            "value" => $model_info->street ? $model_info->street : "",
            "class" => "form-control",
            "placeholder" => "Street"
        ));
        ?>

    </div>
</div>

<div class="form-group">
    <label for="road" class="<?php echo $label_column; ?>"><?php echo "Road"; ?></label>
    <div class="<?php echo $field_column; ?>">
   
        <?php
        /*
        echo form_input(array(
            "id" => "road",
            "name" => "road",
            "value" => $model_info->road ? $model_info->road : "",
            "class" => "form-control",
            "placeholder" => "Road"
        ));
        */
        ?>

<?php
        $road_array = array();

        foreach ($roads as $road) {
            $road_array[$road->id] = $road->title;
        }

        echo form_dropdown("road", $road_array, array($model_info->road), "class='select2 form-control'");
        ?>



    </div>
</div>








<div class="form-group">
    <label for="area" class="<?php echo $label_column; ?>"><?php echo "Area"; ?></label>
    <div class="<?php echo $field_column; ?>">

<?php
        $area_array = array();

        foreach ($areas as $area) {
            $area_array[$area->id] = $area->title;
        }

        echo form_dropdown("area", $area_array, array($model_info->area), "class='select2 form-control'");
        ?>

    </div>
</div>
<!--end-->

<div class="form-group">
    <label for="city" class="<?php echo $label_column; ?>"><?php echo lang('city'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "city",
            "name" => "city",
            "value" => $model_info->city,
            "class" => "form-control",
            "placeholder" => lang('city')
        ));
        ?>
    </div>
</div>



<div class="form-group">
    <label for="district" class="<?php echo $label_column; ?>"><?php echo "District"; ?></label>
    <div class="<?php echo $field_column; ?>">

<?php
        $district_array = array();

        foreach ($districts as $district) {
            $district_array[$district->id] = $district->title;
        }

        echo form_dropdown("district", $district_array, array($model_info->district), "class='select2 form-control'");
        ?>



    </div>
</div>


<div class="form-group">
    <label for="state" class="<?php echo $label_column; ?>"><?php echo lang('state'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "state",
            "name" => "state",
            "value" => $model_info->state,
            "class" => "form-control",
            "placeholder" => lang('state')
        ));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="zip" class="<?php echo $label_column; ?>"><?php echo lang('zip'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "zip",
            "name" => "zip",
            "value" => $model_info->zip,
            "class" => "form-control",
            "placeholder" => lang('zip')
        ));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="country" class="<?php echo $label_column; ?>"><?php echo lang('country'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "country",
            "name" => "country",
            "value" => $model_info->country,
            "class" => "form-control",
            "placeholder" => lang('country')
        ));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="phone" class="<?php echo $label_column; ?>"><?php echo lang('phone'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "phone",
            "name" => "phone",
            "value" => $model_info->phone,
            "class" => "form-control",
            "placeholder" => lang('phone')
        ));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="website" class="<?php echo $label_column; ?>"><?php echo lang('website'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "website",
            "name" => "website",
            "value" => $model_info->website,
            "class" => "form-control",
            "placeholder" => lang('website')
        ));
        ?>
    </div>
</div>
<div class="form-group">
    <label for="vat_number" class="<?php echo $label_column; ?>"><?php echo lang('vat_number'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "vat_number",
            "name" => "vat_number",
            "value" => $model_info->vat_number,
            "class" => "form-control",
            "placeholder" => lang('vat_number')
        ));
        ?>
    </div>
</div>

<?php if ($this->login_user->user_type === "staff") { ?>
    <div class="form-group">
        <label for="groups" class="<?php echo $label_column; ?>"><?php echo lang('client_groups'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "group_ids",
                "name" => "group_ids",
                "value" => $model_info->group_ids,
                "class" => "form-control",
                "placeholder" => lang('client_groups')
            ));
            ?>
        </div>
    </div>
<?php } ?>


<?php if ($this->login_user->is_admin && get_setting("module_invoice")) { ?>
    <div class="form-group">
        <label for="currency" class="<?php echo $label_column; ?>"><?php echo lang('currency'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "currency",
                "name" => "currency",
                "value" => $model_info->currency,
                "class" => "form-control",
                "placeholder" => lang('keep_it_blank_to_use_default') . " (" . get_setting("default_currency") . ")"
            ));
            ?>
        </div>
    </div>    
    <div class="form-group">
        <label for="currency_symbol" class="<?php echo $label_column; ?>"><?php echo lang('currency_symbol'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "currency_symbol",
                "name" => "currency_symbol",
                "value" => $model_info->currency_symbol,
                "class" => "form-control",
                "placeholder" => lang('keep_it_blank_to_use_default') . " (" . get_setting("currency_symbol") . ")"
            ));
            ?>
        </div>
    </div>

<?php } ?>
<!--darini 19-2 -->

<div class="form-group">
    <label for="product_category" class="<?php echo $label_column; ?>"><?php echo lang('product_category')."*"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "product_category",
            "name" => "product_category",
            "value" => $model_info->product_category,
            "class" => "form-control",
            "placeholder" => lang('product_category'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="lead_status_id" class="<?php echo $label_column; ?>"><?php echo lang('status'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        foreach ($statuses as $status) {
            $lead_status[$status->id] = $status->title;
        }

        echo form_dropdown("lead_status_id", $lead_status, array($model_info->lead_status_id), "class='select2 form-control'");
        ?>
    </div>
</div>

<div class="form-group">
    <label for="followup_date" class="<?php echo $label_column; ?>"><?php echo lang('followup_date')."*"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "followup_date",
            "name" => "followup_date",
            "value" => $model_info->followup_date ? $model_info->followup_date : "",
            "class" => "form-control",
            "placeholder" => lang('followup_date'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="time" class="<?php echo $label_column; ?>"><?php echo "Followup Time"; ?></label><!--darini 11-2-->
    <div class="<?php echo $field_column; ?>">

        <?php
            $start_time = is_date_exists($model_info->time) ? (convert_time_to_12hours_format($model_info->time)) : "";
            echo form_input(array(
                "id" => "start_time",
                "name" => "time",
                "value" => $start_time,
                "class" => "form-control",
                "placeholder" => lang('time'),
            ));
            ?>
    </div>
</div>

<div class="form-group">
    <label for="assigned_to" class="<?php echo $label_column; ?>"><?php echo lang('assigned_to'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        if($this->login_user->role_id!=3){
         $team = array();
         foreach ($team_members as $tm) {
             $team[$tm->id] = $tm->first_name;
         }
         echo form_dropdown("assigned_to", $team, array($this->login_user->id), "class='select2 form-control'");
        }else{
        ?>
         <input type="hidden" id="assigned_to" name="assigned_to" value="<?php echo $this->login_user->id ?>" class="form-control"  />
            <input type="text"  value="<?php echo $this->login_user->first_name ?>" class="form-control" readonly />
        <?php }
        ?>
    </div>
</div>
<!-- AG040321 START -->
<div class="form-group">
    <label class="<?php echo $label_column; ?>">Payment due date</label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "payment_due_date",
            "name" => "payment_due_date",
            "value" => $model_info->payment_due_date ? $model_info->payment_due_date : "",
            "class" => "form-control",
            "placeholder" => "Select payment due date"
        ));
        ?>
    </div>
</div>
<!-- AG040321 END -->


<div class="form-group">
    <label for="comments" class="<?php echo $label_column; ?>"><?php echo lang('comments'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "comments",
            "name" => "comments",
            "value" => $model_info->comments ? $model_info->comments : "",
            "class" => "form-control",
            "placeholder" => lang('comments')
        ));
        ?>

    </div>
</div>
<!--end-->
<?php $this->load->view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => $label_column, "field_column" => $field_column)); ?> 

<?php if ($this->login_user->is_admin && get_setting("module_invoice")) { ?>
    <div class="form-group">
        <label for="disable_online_payment" class="<?php echo $label_column; ?> col-xs-8 col-sm-6"><?php echo lang('disable_online_payment'); ?>
            <span class="help" data-container="body" data-toggle="tooltip" title="<?php echo lang('disable_online_payment_description') ?>"><i class="fa fa-question-circle"></i></span>
        </label>
        <div class="<?php echo $field_column; ?> col-xs-4 col-sm-6">
            <?php
            echo form_checkbox("disable_online_payment", "1", $model_info->disable_online_payment ? true : false, "id='disable_online_payment'");
            ?>                       
        </div>
    </div>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {

        setDatePicker("#followup_date", {
            startDate: moment().add(0, 'days').format("DD-MM-YYYY")
        });

        setDatePicker("#payment_due_date", {
            startDate: moment().add(0, 'days').format("DD-MM-YYYY")
        });

        //setTimePicker("#start_time");

        $("#start_time").timepicker({
            'timeFormat': 'H:i:s',
            'step': '10',
            'forceRoundTime': true,
            'scrollDefault': '10:00:00',

        });
 
        $(".select2").select2();       

        $('[data-toggle="tooltip"]').tooltip();

<?php if (isset($currency_dropdown)) { ?>
            if ($('#currency').length) {
                $('#currency').select2({data: <?php echo json_encode($currency_dropdown); ?>});
            }
<?php } ?>

<?php if (isset($groups_dropdown)) { ?>
            $("#group_ids").select2({
                multiple: true,
                data: <?php echo json_encode($groups_dropdown); ?>
            });
<?php } ?>

<?php if ($this->login_user->is_admin || get_array_value($this->login_user->permissions, "client") === "all") { ?>
            $('#created_by').select2({data: <?php echo $team_members_dropdown; ?>});
<?php } ?>

    });
 
/*AG040321 added a field = payment_due_date in clients table */
</script>