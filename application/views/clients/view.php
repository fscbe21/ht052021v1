<div class="page-title clearfix no-border bg-off-white">
    <h1>
        <?php echo lang('client_details') . " - " . $client_info->company_name ?>
        <span id="star-mark">
            <?php
            if ($is_starred) {
                $this->load->view('clients/star/starred', array("client_id" => $client_info->id));
            } else {
                $this->load->view('clients/star/not_starred', array("client_id" => $client_info->id));
            }
            ?>
        </span>
    </h1>
</div>

<div id="page-content" class="clearfix">

    <?php
    if ($client_info->lead_status_id) {
        $this->load->view("clients/lead_information");
    }
    ?>

    <div class="mt15">
        <?php $this->load->view("clients/info_widgets/index"); ?>
    </div>


    <ul id="client-tabs" data-toggle="ajax-tab" class="nav nav-tabs" role="tablist">
        <li><a  role="presentation" href="<?php echo_uri("clients/contacts/" . $client_info->id); ?>" data-target="#client-contacts"> <?php echo lang('contacts'); ?></a></li>
        <li><a  role="presentation" href="<?php echo_uri("clients/company_info_tab/" . $client_info->id); ?>" data-target="#client-info"> <?php echo lang('client_info'); ?></a></li>
        <li><a  role="presentation" href="<?php echo_uri("clients/projects/" . $client_info->id); ?>" data-target="#client-projects"><?php echo lang('projects'); ?></a></li>

        <?php if ($show_invoice_info  && $this->login_user->role_id != 3) { ?>
            <li><a  role="presentation" href="<?php echo_uri("clients/invoices/" . $client_info->id); ?>" data-target="#client-invoices"> <?php echo lang('invoices'); ?></a></li>
            <li><a  role="presentation" href="<?php echo_uri("clients/payments/" . $client_info->id); ?>" data-target="#client-payments"> <?php echo lang('payments'); ?></a></li>
        <?php } ?>
        <?php if ($show_estimate_info  && $this->login_user->role_id != 3) { ?>
            <li><a  role="presentation" href="<?php echo_uri("clients/estimates/" . $client_info->id); ?>" data-target="#client-estimates"> <?php echo lang('estimates'); ?></a></li>
        <?php } ?>

        <?php if ($show_order_info  && $this->login_user->role_id != 3) { ?>
            <!-- <li><a  role="presentation" href="<?php echo_uri("clients/orders/" . $client_info->id); ?>" data-target="#client-orders"> <?php echo lang('orders'); ?></a></li> -->
        <?php } ?>

        <?php if ($show_estimate_request_info  && $this->login_user->role_id != 3) { ?>
            <li><a  role="presentation" href="<?php echo_uri("clients/estimate_requests/" . $client_info->id); ?>" data-target="#client-estimate-requests"> <?php echo lang('estimate_requests'); ?></a></li>
        <?php } ?>
        <?php if ($show_ticket_info  && $this->login_user->role_id != 3) { ?>
            <li><a  role="presentation" href="<?php echo_uri("clients/tickets/" . $client_info->id); ?>" data-target="#client-tickets"> <?php echo lang('tickets'); ?></a></li>
        <?php } ?>
        <?php if ($show_note_info  && $this->login_user->role_id != 3) { ?>
            <li><a  role="presentation" href="<?php echo_uri("clients/notes/" . $client_info->id); ?>" data-target="#client-notes"> <?php echo lang('notes'); ?></a></li>
        <?php } ?>
        <li><a  role="presentation" href="<?php echo_uri("clients/files/" . $client_info->id); ?>" data-target="#client-files"><?php echo lang('files'); ?></a></li>

        <?php if ($show_event_info && $this->login_user->role_id != 3) { ?>
            <li><a  role="presentation" href="<?php echo_uri("clients/events/" . $client_info->id); ?>" data-target="#client-events"> <?php echo lang('events'); ?></a></li>
        <?php } ?>

        <?php if ($show_expense_info && $this->login_user->is_admin) { ?>
            <li><a  role="presentation" href="<?php echo_uri("clients/expenses/" . $client_info->id); ?>" data-target="#client-expenses"> <?php echo lang('expenses'); ?></a></li>
        <?php } ?>
<!--darini 13-2-->
<!-- <li><a  role="presentation" href="<?php echo_uri("clients/new_work_order/" . $client_info->id); ?>" data-target="#new_work_order"> New order</a></li> -->

        <!--end-->

<!-- <li><a  role="presentation" href="<?php echo_uri("clients/production_status/" . $client_info->id); ?>" data-target="#production-status">Production Status</a></li> -->
            <!--darini 10-4-->
            <li><a  role="presentation" href="<?php echo_uri("clients/advance/" . $client_info->id); ?>" data-target="#client-advance"> <?php echo "Advance"; ?></a></li>
            <!--end-->


    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade" id="client-projects"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-files"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-info"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-contacts"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-invoices"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-payments"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-estimates"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-orders"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-estimate-requests"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-tickets"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-notes"></div>
        <div role="tabpanel" class="tab-pane" id="client-events" style="min-height: 300px"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-expenses"></div>
        <div role="tabpanel" class="tab-pane fade" id="client-advance"></div><!--darini 10-4-->
        <!-- <div role="tabpanel" class="tab-pane fade" id="new_work_order"></div>  --><!--darini 13-2-->
       <!--  <div role="tabpanel" class="tab-pane fade" id="production-status"></div> -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        setTimeout(function () {
            var tab = "<?php echo $tab; ?>";
            if (tab === "info") {
                $("[data-target=#client-info]").trigger("click");
            } else if (tab === "projects") {
                $("[data-target=#client-projects]").trigger("click");
            } else if (tab === "invoices") {
                $("[data-target=#client-invoices]").trigger("click");
            } else if (tab === "payments") {
                $("[data-target=#client-payments]").trigger("click");
            }
        }, 210);

    });
</script>
