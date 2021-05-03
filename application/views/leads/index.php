<div id="page-content" class="p20 clearfix">
    <ul class="nav nav-tabs bg-white title" role="tablist">
        <li class="title-tab"><h4 class="pl15 pt10 pr15"><?php echo lang("leads"); ?></h4></li>

        <?php $this->load->view("leads/tabs", array("active_tab" => "leads_list")); ?>

        <div class="tab-title clearfix no-border">
            <div class="title-button-group">
                <!-- <?php echo modal_anchor(get_uri("leads/import_leads_modal_form"), "<i class='fa fa-upload'></i> " . lang('import_leads'), array("class" => "btn btn-default", "title" => lang('import_leads'))); ?> -->
                <?php echo modal_anchor(get_uri("leads/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_lead'), array("class" => "btn btn-default", "title" => lang('add_lead'))); ?>
            </div>
        </div>
    </ul>
<style>
    .companyname{
        color: #4e5e6a !important;
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
            source: '<?php echo_uri("leads/list_data") ?>',
            columns: [
                {title: "<?php echo lang("company_name") ?>"},
                {title: "<?php echo lang("status") ?>"},
                <?php 
                    $ci =&get_instance();
                    if($ci->login_user->role_id != 3) { 
                ?>
                {title: "Assign to"},
                <?php } ?>
                {title: "<?php echo lang("source") ?>"},
                {title: "<?php echo "Company Branch" ?>"},//darini 12-2
                {title: "<?php echo lang("opening_date") ?>"},
                {title: "Followup date and time"},
                {title: "Updated date"},
                {title: "Company Unit"}//darini 12-2
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
