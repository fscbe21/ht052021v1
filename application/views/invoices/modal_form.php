<?php echo form_open(get_uri("invoices/save"), array("id" => "invoice-form", "class" => "general-form", "role" => "form")); ?>
<div id="invoices-dropzone" class="post-dropzone">
    <div class="modal-body clearfix">
        <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

        <?php if ($is_clone || $estimate_id) { ?>
            <?php if ($is_clone) { ?>
                <input type="hidden" name="is_clone" value="1" />
            <?php } ?>
            <input type="hidden" name="discount_amount" value="<?php echo $model_info->discount_amount; ?>" />
            <input type="hidden" name="discount_amount_type" value="<?php echo $model_info->discount_amount_type; ?>" />
            <input type="hidden" name="discount_type" value="<?php echo $model_info->discount_type; ?>" />
        <?php } ?>
        <div class="form-group">
            <label for="bill_no" class=" col-md-3"><?php echo "Bill No"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "bill_no",
                    "name" => "bill_no",
                    "value" => $model_info->bill_no,
                    "class" => "form-control",
                    "placeholder" => "Bill no",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>       
        <div class="form-group">
            <label for="invoice_bill_date" class=" col-md-3"><?php echo lang('bill_date'); ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "invoice_bill_date",
                    "name" => "invoice_bill_date",
                    "value" => $model_info->bill_date ? $model_info->bill_date : get_my_local_time("Y-m-d"),
                    "class" => "form-control recurring_element",
                    "placeholder" => lang('bill_date'),
                    "autocomplete" => "off",
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="invoice_due_date" class=" col-md-3"><?php echo lang('due_date'); ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "invoice_due_date",
                    "name" => "invoice_due_date",
                    "value" => $model_info->due_date,
                    "class" => "form-control",
                    "placeholder" => lang('due_date'),
                    "autocomplete" => "off",
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                    "data-rule-greaterThanOrEqual" => "#invoice_bill_date",
                    "data-msg-greaterThanOrEqual" => lang("end_date_must_be_equal_or_greater_than_start_date")
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="dc_no" class=" col-md-3"><?php echo "DC No"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "dc_no",
                    "name" => "dc_no",
                    "value" => $model_info->dc_no,
                    "class" => "form-control",
                    "placeholder" => "DC no",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div> 
        <div class="form-group">
            <label for="po_name" class=" col-md-3"><?php echo "PO Name"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "po_name",
                    "name" => "po_name",
                    "value" => $model_info->po_name,
                    "class" => "form-control",
                    "placeholder" => "PO Name",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="po_date" class=" col-md-3"><?php echo "PO Date"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "po_date",
                    "name" => "po_date",
                    "value" => $model_info->po_date ? $model_info->po_date : get_my_local_time("Y-m-d"),
                    "class" => "form-control",
                    "placeholder" => "PO Date",
                    "autocomplete" => "off",
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div> 
         
        <?php if ($client_id && !$project_id) { ?>
            <input type="hidden" name="invoice_client_id" class="form-control" value="<?php echo $client_id; ?>" />
        <?php } else { ?>
            <div class="form-group">
                <label for="invoice_client_id" class=" col-md-3"><?php echo lang('client'); ?></label>
                <div class="col-md-9">
                    <?php
                    echo form_dropdown("invoice_client_id", $clients_dropdown, array($model_info->client_id), "class='select2 validate-hidden form-control' id='invoice_client_id' data-rule-required='true', data-msg-required='" . lang('field_required') . "'");
                    ?>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-md-3">Invoice Type</label>
            <div class="col-md-9">
                <select id="invoice-type" name="invoice_ttype" class="form-control">
                    <option value=""> -- Select One --</option>
                    <option value="1">Fully Completed</option>
                    <option value="2">Partially Completed</option>
                </select>
            </div>
        </div>

        <?php if ($project_id) { ?>
            <input type="hidden" name="invoice_project_id" value="<?php echo $project_id; ?>" />
        <?php } else { ?>
            <div class="form-group">
                <label for="invoice_project_id" class=" col-md-3"><?php echo lang('project'); ?></label>
                <div class="col-md-9" id="invoice-porject-dropdown-section">
                    <?php
                    echo form_input(array(
                        "id" => "invoice_project_id",
                        "name" => "invoice_project_id",
                        "value" => $model_info->project_id,
                        "class" => "form-control",
                        "placeholder" => lang('project')
                    ));
                    ?>
                </div>
            </div>
        <?php } ?>
        <div class="form-group">
            <label for="add_labour_cost" class=" col-md-3"><?php echo "Add Labour Cost"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "add_labour_cost",
                    "name" => "add_labour_cost",
                    "value" => $model_info->add_labour_cost,
                    "class" => "form-control",
                    "placeholder" => "Add Labour Cost",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="additional_charge" class=" col-md-3"><?php echo "Additional Charges"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "additional_charge",
                    "name" => "additional_charge",
                    "value" => $model_info->additional_charge,
                    "class" => "form-control",
                    "placeholder" => "Additional Charges",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="tax_id" class=" col-md-3"><?php echo lang('tax'); ?></label>
            <div class="col-md-9">
                <?php
                echo form_dropdown("tax_id", $taxes_dropdown, array($model_info->tax_id), "class='select2 tax-select2'");
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="tax_id" class=" col-md-3"><?php echo lang('second_tax'); ?></label>
            <div class="col-md-9">
                <?php
                echo form_dropdown("tax_id2", $taxes_dropdown, array($model_info->tax_id2), "class='select2 tax-select2'");
                ?>
            </div>
        </div>
        <!-- <div class="form-group" style="display:none">
            <label for="tax_id" class=" col-md-3"><?php echo lang('tax_deducted_at_source'); ?></label>
            <div class="col-md-9">
                <?php
                echo form_dropdown("tax_id3", $taxes_dropdown, array($model_info->tax_id3), "class='select2 tax-select2'");
                ?>
            </div>
        </div> -->
        <div class="form-group" >
            <label for="tax_id" class=" col-md-3"><?php echo ('TCS'); ?></label>
            <div class="col-md-9">
                <?php
                echo form_dropdown("tax_id3", $taxes_dropdown, array($model_info->tax_id3), "class='select2 tax-select2'");
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="invoice_recurring" class=" col-md-3"><?php echo lang('recurring'); ?>  <span class="help" data-toggle="tooltip" title="<?php echo lang('cron_job_required'); ?>"><i class="fa fa-question-circle"></i></span></label>
            <div class=" col-md-9">
                <?php
                echo form_checkbox("recurring", "1", $model_info->recurring ? true : false, "id='invoice_recurring'");
                ?>                       
            </div>
        </div>    
        <div id="recurring_fields" class="<?php if (!$model_info->recurring) echo "hide"; ?>"> 
            <div class="form-group">
                <label for="repeat_every" class=" col-md-3"><?php echo lang('repeat_every'); ?></label>
                <div class="col-md-4">
                    <?php
                    echo form_input(array(
                        "id" => "repeat_every",
                        "name" => "repeat_every",
                        "type" => "number",
                        "value" => $model_info->repeat_every ? $model_info->repeat_every : 1,
                        "min" => 1,
                        "class" => "form-control recurring_element",
                        "placeholder" => lang('repeat_every'),
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required")
                    ));
                    ?>
                </div>
                <div class="col-md-5">
                    <?php
                    echo form_dropdown(
                            "repeat_type", array(
                        "days" => lang("interval_days"),
                        "weeks" => lang("interval_weeks"),
                        "months" => lang("interval_months"),
                        "years" => lang("interval_years"),
                            ), $model_info->repeat_type ? $model_info->repeat_type : "months", "class='select2 recurring_element' id='repeat_type'"
                    );
                    ?>
                </div>
            </div>    

            <div class="form-group">
                <label for="no_of_cycles" class=" col-md-3"><?php echo lang('cycles'); ?></label>
                <div class="col-md-4">
                    <?php
                    echo form_input(array(
                        "id" => "no_of_cycles",
                        "name" => "no_of_cycles",
                        "type" => "number",
                        "min" => 1,
                        "value" => $model_info->no_of_cycles ? $model_info->no_of_cycles : "",
                        "class" => "form-control",
                        "placeholder" => lang('cycles')
                    ));
                    ?>
                </div>
                <div class="col-md-5 mt5">
                    <span class="help" data-toggle="tooltip" title="<?php echo lang('recurring_cycle_instructions'); ?>"><i class="fa fa-question-circle"></i></span>
                </div>
            </div>  



            <div class = "form-group hide" id = "next_recurring_date_container" >
                <label for = "next_recurring_date" class = " col-md-3"><?php echo lang('next_recurring_date'); ?>  </label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "next_recurring_date",
                        "name" => "next_recurring_date",
                        "class" => "form-control",
                        "placeholder" => lang('next_recurring_date'),
                        "autocomplete" => "off",
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                    ));
                    ?>
                </div>
            </div>

        </div>  
        <div class="form-group">
            <label for="invoice_note" class=" col-md-3"><?php echo lang('note'); ?></label>
            <div class=" col-md-9">
                <?php
                echo form_textarea(array(
                    "id" => "invoice_note",
                    "name" => "invoice_note",
                    "value" => $model_info->note ? $model_info->note : "",
                    "class" => "form-control",
                    "placeholder" => lang('note'),
                    "data-rich-text-editor" => true
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="invoice_labels" class=" col-md-3"><?php echo lang('labels'); ?></label>
            <div class=" col-md-9">
                <?php
                echo form_input(array(
                    "id" => "invoice_labels",
                    "name" => "labels",
                    "value" => $model_info->labels,
                    "class" => "form-control",
                    "placeholder" => lang('labels')
                ));
                ?>
            </div>
        </div>
        

              <!--changes 29-3-->
            <div class="form-group">
            <label for="weight_slip_no" class=" col-md-3"><?php echo "Weight slip no"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "weight_slip_no",
                    "name" => "weight_slip_no",
                    "value" => $model_info->weight_slip_no,
                    "class" => "form-control",
                    "placeholder" => "Weight slip no",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="date" class=" col-md-3"><?php echo "Date"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "date",
                    "name" => "date",
                    "value" => $model_info->date,
                    "class" => "form-control",
                    "placeholder" => "Date",
                    "autocomplete" => "off",
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="empty_weight" class=" col-md-3"><?php echo "Empty Weight "; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "empty_weight",
                    "name" => "empty_weight",
                    "value" => $model_info->empty_weight,
                    "class" => "form-control",
                    "placeholder" => "Empty Weight ",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="full_weight" class=" col-md-3"><?php echo "Full Weight "; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "full_weight",
                    "name" => "full_weight",
                    "value" => $model_info->full_weight,
                    "class" => "form-control",
                    "placeholder" => "Full Weight ",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="job_weight" class=" col-md-3"><?php echo "Job Weight "; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "job_weight",
                    "name" => "job_weight",
                    "value" => $model_info->job_weight,
                    "class" => "form-control",
                    "placeholder" => "Job Weight ",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="driver_name" class=" col-md-3"><?php echo "Driver Name "; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "driver_name",
                    "name" => "driver_name",
                    "value" => $model_info->driver_name,
                    "class" => "form-control",
                    "placeholder" => "Driver Name  ",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="vechicle_no" class=" col-md-3"><?php echo "Vehicle no"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "vechicle_no",
                    "name" => "vechicle_no",
                    "value" => $model_info->vechicle_no,
                    "class" => "form-control",
                    "placeholder" => "Vehicle no",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="contact_no" class=" col-md-3"><?php echo "Dr. Contact No"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "contact_no",
                    "name" => "contact_no",
                    "value" => $model_info->contact_no,
                    "class" => "form-control",
                    "placeholder" => "Dr. Contact No",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>
        <!--changes 1-4-->
        <div class="form-group">
            <label for="consigne_name" class=" col-md-3"><?php echo "Consigne Name"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "consigne_name",
                    "name" => "consigne_name",
                    "value" => $model_info->consigne_name,
                    "class" => "form-control",
                    "placeholder" => "Consigne Name",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="consigne_add_line1" class=" col-md-3"><?php echo "Consigne Address Line 1"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_textarea(array(
                    
                    "id" => "consigne_add_line1",
                    "name" => "consigne_add_line1",
                    "value" => $model_info->consigne_add_line1,
                    "class" => "form-control",
                    "placeholder" => "Consigne Address Line 1",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>


        <div class="form-group">
            <label for="consigne_add_line2" class=" col-md-3"><?php echo "Consigne Address Line 2"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_textarea(array(
                    "id" => "consigne_add_line2",
                    "name" => "consigne_add_line2",
                    "value" => $model_info->consigne_add_line2,
                    "class" => "form-control",
                    "placeholder" => "Consigne Address Line 2",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>


        <div class="form-group">
            <label for="phone_no" class=" col-md-3"><?php echo "Consigne Phone Number"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "phone_no",
                    "name" => "phone_no",
                    "value" => $model_info->phone_no,
                    "class" => "form-control",
                    "placeholder" => "Consigne Phone Number",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>



        <div class="form-group">
            <label for="gstin" class=" col-md-3"><?php echo "GST IN"; ?></label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "gstin",
                    "name" => "gstin",
                    "value" => $model_info->gstin,
                    "class" => "form-control",
                    "placeholder" => "GST IN",                   
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                   
                ));
                ?>
            </div>
        </div>
        <!--end-->

        <?php $this->load->view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => "col-md-3", "field_column" => " col-md-9")); ?> 


        <?php if ($estimate_id) { ?>
            <input type="hidden" name="estimate_id" value="<?php echo $estimate_id; ?>" />
            <div class="form-group">
                <label for="estimate_id_checkbox" class=" col-md-12">
                    <input type="hidden" name="copy_items_from_estimate" value="<?php echo $estimate_id; ?>" />
                    <?php
                    echo form_checkbox("estimate_id_checkbox", $estimate_id, true, " class='pull-left' disabled='disabled'");
                    ?>    
                    <span class="pull-left ml15"> <?php echo lang('include_all_items_of_this_estimate'); ?> </span>
                </label>
            </div>
        <?php } ?>
        <?php if ($order_id) { ?>
            <div class="form-group">
                <label for="order_id_checkbox" class=" col-md-12">
                    <input type="hidden" name="copy_items_from_order" value="<?php echo $order_id; ?>" />
                    <?php
                    echo form_checkbox("order_id_checkbox", $order_id, true, " class='pull-left' disabled='disabled'");
                    ?>    
                    <span class="pull-left ml15"> <?php echo lang('include_all_items_of_this_order'); ?> </span>
                </label>
            </div>
        <?php } ?>

        <?php if ($is_clone) { ?>
            <div class="form-group">
                <label for="copy_items"class=" col-md-12">
                    <?php
                    echo form_checkbox("copy_items", "1", true, "id='copy_items' disabled='disabled' class='pull-left mr15'");
                    ?>    
                    <?php echo lang('copy_items'); ?>
                </label>
            </div>
            <div class="form-group">
                <label for="copy_discount"class=" col-md-12">
                    <?php
                    echo form_checkbox("copy_discount", "1", true, "id='copy_discount' disabled='disabled' class='pull-left mr15'");
                    ?>    
                    <?php echo lang('copy_discount'); ?>
                </label>
            </div>
        <?php } ?>

        <div class="form-group">
            <div class="col-md-12">
                <?php
                $this->load->view("includes/file_list", array("files" => $model_info->files));
                ?>
            </div>
        </div>

        <?php $this->load->view("includes/dropzone_preview"); ?>
    </div>

    <div class="modal-footer">
        <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class="fa fa-camera"></i> <?php echo lang("upload_file"); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
        <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        if ("<?php echo $estimate_id; ?>" || "<?php echo $order_id; ?>") {
            RELOAD_VIEW_AFTER_UPDATE = false; //go to invoice/order page
        }

        var uploadUrl = "<?php echo get_uri("invoices/upload_file"); ?>";
        var validationUri = "<?php echo get_uri("invoices/validate_invoices_file"); ?>";

        var dropzone = attachDropzoneWithForm("#invoices-dropzone", uploadUrl, validationUri);

        $("#invoice-form").appForm({
            onSuccess: function (result) {
                if (typeof RELOAD_VIEW_AFTER_UPDATE !== "undefined" && RELOAD_VIEW_AFTER_UPDATE) {
                    location.reload();
                } else {
                    window.location = "<?php echo site_url('invoices/view'); ?>/" + result.id;
                }
            },
            onAjaxSuccess: function (result) {
                if (!result.success && result.next_recurring_date_error) {
                    $("#next_recurring_date").val(result.next_recurring_date_value);
                    $("#next_recurring_date_container").removeClass("hide");

                    $("#invoice-form").data("validator").showErrors({
                        "next_recurring_date": result.next_recurring_date_error
                    });
                }
            }
        });
        $("#invoice-form .tax-select2").select2();
        $("#repeat_type").select2();

        $("#invoice_labels").select2({multiple: true, data: <?php echo json_encode($label_suggestions); ?>});

        setDatePicker("#invoice_bill_date, #invoice_due_date");

        //load all projects of selected client
        $("#invoice-type").select2().on("change", function () {
            var client_id   = $('#invoice_client_id').val();
            var invoiceType = $(this).val();
            if ($(this).val()) {
                $('#invoice_project_id').select2("destroy");
                $("#invoice_project_id").hide();
                appLoader.show({container: "#invoice-porject-dropdown-section"});
                $.ajax({
                    url: "<?php echo get_uri("invoices/get_project_suggestion1") ?>" + "/" + client_id+"/"+invoiceType,
                    dataType: "json",
                    success: function (result) {
                        $("#invoice_project_id").show().val("");
                        $('#invoice_project_id').select2({data: result});
                        appLoader.hide();
                    }
                });
            }
        });

        $('#invoice_project_id').select2({data: <?php echo json_encode($projects_suggestion); ?>});

        if ("<?php echo $project_id; ?>") {
            $("#invoice_client_id").select2("readonly", true);
        }

        //show/hide recurring fields
        $("#invoice_recurring").click(function () {
            if ($(this).is(":checked")) {
                $("#recurring_fields").removeClass("hide");
            } else {
                $("#recurring_fields").addClass("hide");
            }
        });

        setDatePicker("#next_recurring_date", {
            startDate: moment().add(1, 'days').format("YYYY-MM-DD") //set min date = tomorrow
        });


        $('[data-toggle="tooltip"]').tooltip();

        var defaultDue = "<?php echo get_setting('default_due_date_after_billing_date'); ?>";
        var id = "<?php echo $model_info->id; ?>";

        //disable this operation in edit mode
        if (defaultDue && !id) {
            //for auto fill the due date based on bill date
            setDefaultDueDate = function () {
                var dateFormat = getJsDateFormat().toUpperCase();

                var billDate = $('#invoice_bill_date').val();
                var dueDate = moment(billDate, dateFormat).add(defaultDue, 'days').format(dateFormat);
                $("#invoice_due_date").val(dueDate);

            };

            $("#invoice_bill_date").change(function () {
                setDefaultDueDate();
            });

            setDefaultDueDate();
        }
        setDatePicker("#date", {
            startDate: moment().add(0, 'days').format("MM-YYYY")
        });
       
    });
</script>