<div id="page-content" class="p20 clearfix">
    <ul class="nav nav-tabs bg-white title" role="tablist">
        <li class="title-tab"><h4 class="pl15 pt10 pr15">Client Approval</h4></li>

        <div class="tab-title clearfix no-border">
            <div class="title-button-group">
               
            </div>
        </div>
    </ul>
<style>
    .companyname{
        color: #4e5e6a !important;
    }

    td.option a, .dtr-details .edit, .dtr-details .delete, .select-member-field a.delete, .send-invitation-form .delete, .calendar-ids-form .delete-post-dropzone, .edit-image-file .delete-saved-file, .external-tickets-embedded-code {
        min-width: 23px !important;
}
</style>
    <div class="panel panel-default">
        <div class="table-responsive">
            <table id="lead-table" class="display table-sm" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#lead-table").appTable({
            source: '<?php echo_uri("client_approval/list_data") ?>',
            columns: [
                {title: "<?php echo lang("company_name") ?>"},
                {title: "Assign To"},
                {title: "<?php echo lang("status") ?>"},
                {title: "<?php echo lang("source") ?>"},
                {title: "<?php echo lang("product") ?>"},
                {title: "<?php echo lang("opening_date") ?>"},
                {title: "Followup date and time"},
                {title: "Updated date"},
                {title: "Sales value"}
<?php echo $custom_field_headers; ?>,
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            filterDropdown: [
               // {name: "status", class: "w200", options: <?php $this->load->view("leads/lead_statuses"); ?>},
                {name: "source", class: "w200", options: <?php $this->load->view("leads/lead_sources"); ?>},
                
                <?php if(get_array_value($this->login_user->permissions, "lead") !== "own"){ ?>
                    {name: "owner_id", class: "w200", options: <?php echo json_encode($owners_dropdown); ?>}
                <?php } ?>
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 2], '<?php echo $custom_field_headers; ?>'),
            xlsColumns: combineCustomFieldsColumns([0, 1, 2], '<?php echo $custom_field_headers; ?>')
        });
        
    });

</script>

<?php $this->load->view("leads/update_lead_status_script"); ?>
