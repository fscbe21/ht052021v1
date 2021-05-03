<?php echo form_open(get_uri("new_work_order/save"), array("id" => "project-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
<input type="hidden" name="client_id" value="<?php echo $model_info->client_id; ?>" />
<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="company_name" value="<?php echo $client_info->company_name; ?>"/>

<div class="form-group ">
    <label for="contact_person" class="<?php echo $label_column; ?>"><?php echo lang('contact_person'); ?></label>
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
    <label for="phone" class="<?php echo $label_column; ?>"><?php echo lang('contact_number'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "phone",
            "name" => "phone",
            "value" => $model_info->phone,
            "class" => "form-control",
            "placeholder" => lang('contact_number')
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="person_role" class="<?php echo $label_column; ?>"><?php echo lang('person_role'); ?></label>
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

        echo form_dropdown("lead_source_id", $lead_source, array($model_info->lead_source_id), "class='select2'");
        ?>
    </div>
</div>

<div class="form-group">
    <label for="product_category" class="<?php echo $label_column; ?>"><?php echo lang('product_category'); ?></label>
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

<div class="form-group " >
    <label for="product" class="<?php echo $label_column; ?>"><?php echo lang('product'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "product",
            "name" => "product",
            "value" => $model_info->product,
            "class" => "form-control",
            "placeholder" => lang('product'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>
<div class="form-group " >
    <label for="orders" class="<?php echo $label_column; ?>"><?php echo "Order"; ?></label>
    <div class="<?php echo $field_column; ?>" >
        <?php
        echo form_input(array(
            "id" => "orders",
            "name" => "orders",
            "value" => $model_info->orders? $model_info->orders : $order_data,
            "class" => "form-control",
            "placeholder" => "Order",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
            "readonly"=>'true'
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="quantity" class="<?php echo $label_column; ?>"><?php echo lang('quantity'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "quantity",
            "name" => "quantity",
            "value" => $model_info->quantity,
            "class" => "form-control",
            "placeholder" => lang('quantity'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group" >
    <label for="total_value" class="<?php echo $label_column; ?>"><?php echo "Total value"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "total_valu",
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
    <label for="status_id" class="<?php echo $label_column; ?>"><?php echo lang('status'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        foreach ($statuses as $status) {
            $lead_status[$status->id] = $status->title;
        }

        echo form_dropdown("status_id", $lead_status, array($model_info->status_id), "class='select2'");
        ?>
    </div>
</div>

<div class="form-group">
    <label for="followup_date" class="<?php echo $label_column; ?>"><?php echo lang('followup_date'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "followup_date",
            "name" => "followup_date",
            "value" => $model_info->follow_date ? $model_info->follow_date : "",
            "class" => "form-control",
            "placeholder" => lang('followup_date'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),

        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="time" class="<?php echo $label_column; ?>"><?php echo "Followup Time"; ?></label>
    <div class="<?php echo $field_column; ?>">

        <?php
            $start_time = is_date_exists($model_info->time) ? (convert_time_to_12hours_format($model_info->time)) : "";
            echo form_input(array(
                "id" => "time",
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
        $team = array();
        foreach ($team_members as $tm) {
            $team[$tm->id] = $tm->first_name;
            if($tm->id==$client_info->owner_id){
                $name=$tm->first_name;
            }
        }
       if($this->login_user->role_id!=3){
         
         
         echo form_dropdown("assigned_to", $team, array($client_info->owner_id), "class='select2'");
        }else{?>

        <input type="hidden" id="assigned_to" name="assigned_to" value="<?php echo $client_info->owner_id ?>" class="form-control"  /><!--darini 15-2-->
            <input type="text"  value="<?php   echo $name ; ?>" class="form-control" readonly /><!--darini 19-2-->
       <?php  }
       
        ?>
    </div>
</div>


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


<?php $this->load->view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => $label_column, "field_column" => $field_column)); ?> 



</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
   $(document).ready(function () {
        $("#project-form").appForm({
            onSuccess: function (result) {
                console.log("res"+result.message);
                appAlert.success(result.message, {duration: 10000});
                var reloadUrl = "<?php echo echo_uri("clients/view/" . $model_info->client_id); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
        $("#title").focus();
        $("#project-form .select2").select2();
        setDatePicker("#followup_date", {
            startDate: moment().add(0, 'days').format("DD-MM-YYYY")
        });

        //setTimePicker("#start_time");

        $("#time").timepicker({
            'timeFormat': 'H:i:s',
            'step': '10',
            'forceRoundTime': true,
            'scrollDefault': '10:00:00',

        });
        
        $("#project_labels").select2({multiple: true, data: <?php echo json_encode($label_suggestions); ?>});
    });
</script>    



