<div class="page-title clearfix no-border bg-off-white">
    <h1>
        <?php echo lang('lead_details') . " - " . $lead_info->company_name ?> 
    </h1>
    <?php echo modal_anchor(get_uri("leads/make_client_modal_form/") . $lead_info->id, "", array("class" => "btn btn-link pull-right mr15 lead-to-client-button")); ?>
</div>


<style>
.dashed-row .form-group {
    border-bottom: 0px !important;
    padding-bottom: 1px !important;
    margin-bottom: 1px !important;
}
.form-control{
    font-size: 13px !important;
}
/* .lead-to-client-button{
    color: #f2f4f6;
} */
</style>

<div id="page-content" class="clearfix">
    <ul data-toggle="ajax-tab" class="nav nav-tabs" role="tablist">
        
        <li><a  role="presentation" href="<?php echo_uri("leads/company_info_tab/" . $lead_info->id); ?>" data-target="#lead-info"> <?php echo lang('lead_info'); ?></a></li>
        <li><a  role="presentation" href="<?php echo_uri("leads/contacts/" . $lead_info->id); ?>" data-target="#lead-contacts"> <?php echo lang('contacts'); ?></a></li>
       <!--  <?php if ($show_estimate_info) { ?>
            <li><a  role="presentation" href="<?php echo_uri("leads/estimates/" . $lead_info->id); ?>" data-target="#lead-estimates"> <?php echo lang('estimates'); ?></a></li>
        <?php } ?> -->
        <!-- <?php if ($show_estimate_request_info) { ?>
            <li><a  role="presentation" href="<?php echo_uri("leads/estimate_requests/" . $lead_info->id); ?>" data-target="#lead-estimate-requests"> <?php echo lang('estimate_requests'); ?></a></li>
        <?php } ?>
        <?php if ($show_ticket_info) { ?>
            <li><a  role="presentation" href="<?php echo_uri("leads/tickets/" . $lead_info->id); ?>" data-target="#lead-tickets"> <?php echo lang('tickets'); ?></a></li>
        <?php } ?>

        <?php if ($show_note_info) { ?>
            <li><a  role="presentation" href="<?php echo_uri("leads/notes/" . $lead_info->id); ?>" data-target="#lead-notes"> <?php echo lang('notes'); ?></a></li>
        <?php } ?>-->
        <li><a  role="presentation" href="<?php echo_uri("leads/files/" . $lead_info->id); ?>" data-target="#lead-files"><?php echo lang('files'); ?></a></li>
        <!--
        <?php if ($show_event_info) { ?>
            <li><a  role="presentation" href="<?php echo_uri("leads/events/" . $lead_info->id); ?>" data-target="#lead-events"> <?php echo lang('events'); ?></a></li>
        <?php } ?> -->

        <li><a  role="presentation" href="<?php echo_uri("leads/visit_info_tab/" . $lead_info->id); ?>" data-target="#lead-visit-info"> <?php echo 'Visit Info'; ?></a></li>

    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade" id="lead-projects"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-files"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-info"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-contacts"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-estimates"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-estimate-requests"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-tickets"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-notes"></div>
        <div role="tabpanel" class="tab-pane" id="lead-events" style="min-height: 300px"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-visit-info"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        var tab = "<?php echo $tab; ?>";
        if (tab === "info") {
            $("[data-target=#lead-info]").trigger("click");
        }
    });
</script>
