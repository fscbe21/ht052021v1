<div class="tab-content">
    <?php echo form_open(get_uri("roles/save_permissions"), array("id" => "permissions-form", "class" => "general-form dashed-row", "role" => "form")); ?>
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <div class="panel">
        <div class="panel-default panel-heading">
            <h4><?php echo lang('permissions') . ": " . $model_info->title; ?></h4>
        </div>
        <div class="panel-body">

            <ul class="permission-list">
                <li>
                    <h5><?php echo lang("set_project_permissions"); ?>:</h5>
                    <div>
                        <?php
                        echo form_checkbox("can_manage_all_projects", "1", $can_manage_all_projects ? true : false, "id='can_manage_all_projects' class='manage_project_section'");
                        ?>
                        <label for="can_manage_all_projects"><?php echo lang("can_manage_all_projects"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_create_projects", "1", $can_create_projects ? true : false, "id='can_create_projects' class='manage_project_section'");
                        ?>
                        <label for="can_create_projects"><?php echo lang("can_create_projects"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_edit_projects", "1", $can_edit_projects ? true : false, "id='can_edit_projects' class='manage_project_section'");
                        ?>
                        <label for="can_edit_projects"><?php echo lang("can_edit_projects"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_delete_projects", "1", $can_delete_projects ? true : false, "id='can_delete_projects' class='manage_project_section'");
                        ?>
                        <label for="can_delete_projects"><?php echo lang("can_delete_projects"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_add_remove_project_members", "1", $can_add_remove_project_members ? true : false, "id='can_add_remove_project_members' class='manage_project_section'");
                        ?>
                        <label for="can_add_remove_project_members"><?php echo lang("can_add_remove_project_members"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_create_tasks", "1", $can_create_tasks ? true : false, "id='can_create_tasks' class='manage_project_section'");
                        ?>
                        <label for="can_create_tasks"><?php echo lang("can_create_tasks"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_edit_tasks", "1", $can_edit_tasks ? true : false, "id='can_edit_tasks'");
                        ?>
                        <label for="can_edit_tasks"><?php echo lang("can_edit_tasks"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_delete_tasks", "1", $can_delete_tasks ? true : false, "id='can_delete_tasks'");
                        ?>
                        <label for="can_delete_tasks"><?php echo lang("can_delete_tasks"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_comment_on_tasks", "1", $can_comment_on_tasks ? true : false, "id='can_comment_on_tasks'");
                        ?>
                        <label for="can_comment_on_tasks"><?php echo lang("can_comment_on_tasks"); ?></label>
                    </div>
                    <div id="show_assigned_tasks_only_section">
                        <?php
                        echo form_checkbox("show_assigned_tasks_only", "1", $show_assigned_tasks_only ? true : false, "id='show_assigned_tasks_only'");
                        ?>
                        <label for="show_assigned_tasks_only"><?php echo lang("show_assigned_tasks_only"); ?></label>
                    </div>
                    <div id="can_update_only_assigned_tasks_status_section">
                        <?php
                        echo form_checkbox("can_update_only_assigned_tasks_status", "1", $can_update_only_assigned_tasks_status ? true : false, "id='can_update_only_assigned_tasks_status'");
                        ?>
                        <label for="can_update_only_assigned_tasks_status"><?php echo lang("can_update_only_assigned_tasks_status"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_create_milestones", "1", $can_create_milestones ? true : false, "id='can_create_milestones'");
                        ?>
                        <label for="can_create_milestones"><?php echo lang("can_create_milestones"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_edit_milestones", "1", $can_edit_milestones ? true : false, "id='can_edit_milestones'");
                        ?>
                        <label for="can_edit_milestones"><?php echo lang("can_edit_milestones"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_checkbox("can_delete_milestones", "1", $can_delete_milestones ? true : false, "id='can_delete_milestones'");
                        ?>
                        <label for="can_delete_milestones"><?php echo lang("can_delete_milestones"); ?></label>
                    </div>

                    <div>
                        <?php
                        echo form_checkbox("can_delete_files", "1", $can_delete_files ? true : false, "id='can_delete_files'");
                        ?>
                        <label for="can_delete_files"><?php echo lang("can_delete_files"); ?></label>
                    </div>

                </li>
                <li>
                    <h5><?php echo lang("set_team_members_permission"); ?>:</h5>


                    <div>
                        <?php
                        echo form_checkbox("hide_team_members_list", "1", $hide_team_members_list ? true : false, "id='hide_team_members_list'");
                        ?>
                        <label for="hide_team_members_list"><?php echo lang("hide_team_members_list"); ?></label>
                    </div>

                    <div>
                        <?php
                        echo form_checkbox("can_view_team_members_contact_info", "1", $can_view_team_members_contact_info ? true : false, "id='can_view_team_members_contact_info'");
                        ?>
                        <label for="can_view_team_members_contact_info"><?php echo lang("can_view_team_members_contact_info"); ?></label>
                    </div>

                    <div>
                        <?php
                        echo form_checkbox("can_view_team_members_social_links", "1", $can_view_team_members_social_links ? true : false, "id='can_view_team_members_social_links'");
                        ?>
                        <label for="can_view_team_members_social_links"><?php echo lang("can_view_team_members_social_links"); ?></label>
                    </div>

                    <div>
                        <label for="can_update_team_members_general_info_and_social_links"><?php echo lang("can_update_team_members_general_info_and_social_links"); ?></label>
                        <div class="ml15">
                            <div>
                                <?php
                                echo form_radio(array(
                                    "id" => "team_member_update_permission_no",
                                    "name" => "team_member_update_permission",
                                    "value" => "",
                                    "class" => "team_member_update_permission toggle_specific",
                                        ), $team_member_update_permission, ($team_member_update_permission === "") ? true : false);
                                ?>
                                <label for="team_member_update_permission_no"><?php echo lang("no"); ?></label>
                            </div>
                            <div>
                                <?php
                                echo form_radio(array(
                                    "id" => "team_member_update_permission_all",
                                    "name" => "team_member_update_permission",
                                    "value" => "all",
                                    "class" => "team_member_update_permission toggle_specific",
                                        ), $team_member_update_permission, ($team_member_update_permission === "all") ? true : false);
                                ?>
                                <label for="team_member_update_permission_all"><?php echo lang("yes_all_members"); ?></label>
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_radio(array(
                                    "id" => "team_member_update_permission_specific",
                                    "name" => "team_member_update_permission",
                                    "value" => "specific",
                                    "class" => "team_member_update_permission toggle_specific",
                                        ), $team_member_update_permission, ($team_member_update_permission === "specific") ? true : false);
                                ?>
                                <label for="team_member_update_permission_specific"><?php echo lang("yes_specific_members_or_teams"); ?>:</label>
                                <div class="specific_dropdown">
                                    <input type="text" value="<?php echo $team_member_update_permission_specific; ?>" name="team_member_update_permission_specific" id="team_member_update_permission_specific_dropdown" class="w100p validate-hidden"  data-rule-required="true" data-msg-required="<?php echo lang('field_required'); ?>" placeholder="<?php echo lang('choose_members_and_or_teams'); ?>"  />    
                                </div>
                            </div>
                        </div>
                    </div>

                </li>

                <li>
                    <h5><?php echo lang("set_message_permissions"); ?>:</h5>
                    <div>
                        <?php
                        echo form_checkbox("message_permission_no", "1", ($message_permission == "no") ? true : false, "id='message_permission_no'");
                        ?>
                        <label for="message_permission_no"><?php echo lang("cant_send_any_messages"); ?></label>
                    </div>
                    <div id="message_permission_specific_area" class="form-group <?php echo ($message_permission == "no") ? "hide" : ""; ?>">
                        <?php
                        echo form_checkbox("message_permission_specific_checkbox", "1", ($message_permission == "specific") ? true : false, "id='message_permission_specific_checkbox' class='message_permission_specific toggle_specific'");
                        ?>
                        <label for="message_permission_specific_checkbox"><?php echo lang("can_send_messages_to_specific_members_or_teams"); ?></label>
                        <div class="specific_dropdown">
                            <input type="text" value="<?php echo $message_permission_specific; ?>" name="message_permission_specific" id="message_permission_specific_dropdown" class="w100p validate-hidden"  data-rule-required="true" data-msg-required="<?php echo lang('field_required'); ?>" placeholder="<?php echo lang('choose_members_and_or_teams'); ?>"  />    
                        </div>
                    </div>
                </li>

                <li>
                    <h5><?php echo lang("set_event_permissions"); ?>:</h5>
                    <div>
                        <?php
                        echo form_checkbox("disable_event_sharing", "1", $disable_event_sharing ? true : false, "id='disable_event_sharing'");
                        ?>
                        <label for="disable_event_sharing"><?php echo lang("disable_event_sharing"); ?></label>
                    </div>
                </li>

                <li>
                    <h5><?php echo lang("can_manage_team_members_leave"); ?> <span class="help" data-toggle="tooltip" title="Assign, approve or reject leave applications"><i class="fa fa-question-circle"></i></span> </h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "leave_permission_no",
                            "name" => "leave_permission",
                            "value" => "",
                            "class" => "leave_permission toggle_specific",
                                ), $leave, ($leave === "") ? true : false);
                        ?>
                        <label for="leave_permission_no"><?php echo lang("no"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "leave_permission_all",
                            "name" => "leave_permission",
                            "value" => "all",
                            "class" => "leave_permission toggle_specific",
                                ), $leave, ($leave === "all") ? true : false);
                        ?>
                        <label for="leave_permission_all"><?php echo lang("yes_all_members"); ?></label>
                    </div>
                    <div class="form-group pb0 mb0 no-border">
                        <?php
                        echo form_radio(array(
                            "id" => "leave_permission_specific",
                            "name" => "leave_permission",
                            "value" => "specific",
                            "class" => "leave_permission toggle_specific",
                                ), $leave, ($leave === "specific") ? true : false);
                        ?>
                        <label for="leave_permission_specific"><?php echo lang("yes_specific_members_or_teams") . " (" . lang("excluding_his_her_leaves") . ")"; ?>:</label>
                        <div class="specific_dropdown">
                            <input type="text" value="<?php echo $leave_specific; ?>" name="leave_permission_specific" id="leave_specific_dropdown" class="w100p validate-hidden"  data-rule-required="true" data-msg-required="<?php echo lang('field_required'); ?>" placeholder="<?php echo lang('choose_members_and_or_teams'); ?>"  />    
                        </div>

                    </div>
                    <div class="form-group">
                        <div>
                            <?php
                            echo form_checkbox("can_delete_leave_application", "1", $can_delete_leave_application ? true : false, "id='can_delete_leave_application'");
                            ?>
                            <label for="can_delete_leave_application"><?php echo lang("can_delete_leave_application"); ?> <span class="help" data-toggle="tooltip" title="Can delete based on his/her access permission"><i class="fa fa-question-circle"></i></span></label>
                        </div>
                    </div>
                </li>
                <li>
                    <h5><?php echo lang("can_manage_team_members_timecards"); ?> <span class="help" data-toggle="tooltip" title="Add, edit and delete time cards"><i class="fa fa-question-circle"></i></span></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "attendance_permission_no",
                            "name" => "attendance_permission",
                            "value" => "",
                            "class" => "attendance_permission toggle_specific",
                                ), $attendance, ($attendance === "") ? true : false);
                        ?>
                        <label for="attendance_permission_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "attendance_permission_all",
                            "name" => "attendance_permission",
                            "value" => "all",
                            "class" => "attendance_permission toggle_specific",
                                ), $attendance, ($attendance === "all") ? true : false);
                        ?>
                        <label for="attendance_permission_all"><?php echo lang("yes_all_members"); ?></label>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_radio(array(
                            "id" => "attendance_permission_specific",
                            "name" => "attendance_permission",
                            "value" => "specific",
                            "class" => "attendance_permission toggle_specific",
                                ), $attendance, ($attendance === "specific") ? true : false);
                        ?>
                        <label for="attendance_permission_specific"><?php echo lang("yes_specific_members_or_teams") . " (" . lang("excluding_his_her_time_cards") . ")"; ?>:</label>
                        <div class="specific_dropdown">
                            <input type="text" value="<?php echo $attendance_specific; ?>" name="attendance_permission_specific" id="attendance_specific_dropdown" class="w100p validate-hidden"  data-rule-required="true" data-msg-required="<?php echo lang('field_required'); ?>" placeholder="<?php echo lang('choose_members_and_or_teams'); ?>"  />
                        </div>
                    </div>

                </li>

                <li>
                    <h5><?php echo lang("can_manage_team_members_project_timesheet"); ?></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "timesheet_manage_permission_no",
                            "name" => "timesheet_manage_permission",
                            "value" => "",
                            "class" => "timesheet_manage_permission toggle_specific",
                                ), $timesheet_manage_permission, ($timesheet_manage_permission === "") ? true : false);
                        ?>
                        <label for="timesheet_manage_permission_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "timesheet_manage_permission_all",
                            "name" => "timesheet_manage_permission",
                            "value" => "all",
                            "class" => "timesheet_manage_permission toggle_specific",
                                ), $timesheet_manage_permission, ($timesheet_manage_permission === "all") ? true : false);
                        ?>
                        <label for="timesheet_manage_permission_all"><?php echo lang("yes_all_members"); ?></label>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_radio(array(
                            "id" => "timesheet_manage_permission_specific",
                            "name" => "timesheet_manage_permission",
                            "value" => "specific",
                            "class" => "timesheet_manage_permission toggle_specific",
                                ), $timesheet_manage_permission, ($timesheet_manage_permission === "specific") ? true : false);
                        ?>
                        <label for="timesheet_manage_permission_specific"><?php echo lang("yes_specific_members_or_teams"); ?>:</label>
                        <div class="specific_dropdown">
                            <input type="text" value="<?php echo $timesheet_manage_permission_specific; ?>" name="timesheet_manage_permission_specific" id="timesheet_manage_permission_specific_dropdown" class="w100p validate-hidden"  data-rule-required="true" data-msg-required="<?php echo lang('field_required'); ?>" placeholder="<?php echo lang('choose_members_and_or_teams'); ?>"  />
                        </div>
                    </div>
                </li>


                <li>
                    <h5><?php echo lang("can_access_invoices"); ?></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "invoice_no",
                            "name" => "invoice_permission",
                            "value" => "",
                                ), $invoice, ($invoice === "") ? true : false);
                        ?>
                        <label for="invoice_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "invoice_yes",
                            "name" => "invoice_permission",
                            "value" => "all",
                                ), $invoice, ($invoice === "all") ? true : false);
                        ?>
                        <label for="invoice_yes"><?php echo lang("yes"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "invoice_read_only",
                            "name" => "invoice_permission",
                            "value" => "read_only",
                                ), $invoice, ($invoice === "read_only") ? true : false);
                        ?>
                        <label for="invoice_read_only"><?php echo lang("read_only"); ?></label>
                    </div>
                </li>
                <li>
                    <h5><?php echo lang("can_access_estimates"); ?></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "estimate_no",
                            "name" => "estimate_permission",
                            "value" => "",
                                ), $estimate, ($estimate === "") ? true : false);
                        ?>
                        <label for="estimate_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "estimate_yes",
                            "name" => "estimate_permission",
                            "value" => "all",
                                ), $estimate, ($estimate === "all") ? true : false);
                        ?>
                        <label for="estimate_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>
                <li>
                    <h5><?php echo lang("can_access_expenses"); ?></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "expense_no",
                            "name" => "expense_permission",
                            "value" => "",
                                ), $expense, ($expense === "") ? true : false);
                        ?>
                        <label for="expense_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "expense_yes",
                            "name" => "expense_permission",
                            "value" => "all",
                                ), $expense, ($expense === "all") ? true : false);
                        ?>
                        <label for="expense_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>
                <li>
                    <h5><?php echo lang("can_access_clients_information"); ?> <span class="help" data-toggle="tooltip" title="Hides all information of clients except company name."><i class="fa fa-question-circle"></i></span></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "client_no",
                            "name" => "client_permission",
                            "value" => "",
                                ), $client, ($client === "") ? true : false);
                        ?>
                        <label for="client_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "client_yes",
                            "name" => "client_permission",
                            "value" => "all",
                                ), $client, ($client === "all") ? true : false);
                        ?>
                        <label for="client_yes"><?php echo lang("yes_all_clients"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "client_yes_own",
                            "name" => "client_permission",
                            "value" => "own",
                                ), $client, ($client === "own") ? true : false);
                        ?>
                        <label for="client_yes_own"><?php echo lang("yes_only_own_clients"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "client_read_only",
                            "name" => "client_permission",
                            "value" => "read_only",
                                ), $client, ($client === "read_only") ? true : false);
                        ?>
                        <label for="client_read_only"><?php echo lang("read_only"); ?></label>
                    </div>
                </li>
                <li>
                    <h5><?php echo lang("can_access_leads_information"); ?></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "lead_no",
                            "name" => "lead_permission",
                            "value" => "",
                                ), $lead, ($lead === "") ? true : false);
                        ?>
                        <label for="lead_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "lead_yes",
                            "name" => "lead_permission",
                            "value" => "all",
                                ), $lead, ($lead === "all") ? true : false);
                        ?>
                        <label for="lead_yes"><?php echo lang("yes_all_leads"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "lead_yes_own",
                            "name" => "lead_permission",
                            "value" => "own",
                                ), $lead, ($lead === "own") ? true : false);
                        ?>
                        <label for="lead_yes_own"><?php echo lang("yes_only_own_leads"); ?></label>
                    </div>
                </li>
                <li>
                    <h5><?php echo lang("can_access_tickets"); ?></h5>       
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "ticket_permission_no",
                            "name" => "ticket_permission",
                            "value" => "",
                            "class" => "ticket_permission toggle_specific",
                                ), $ticket, ($ticket === "") ? true : false);
                        ?>
                        <label for="ticket_permission_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "ticket_permission_all",
                            "name" => "ticket_permission",
                            "value" => "all",
                            "class" => "ticket_permission toggle_specific",
                                ), $ticket, ($ticket === "all") ? true : false);
                        ?>
                        <label for="ticket_permission_all"><?php echo lang("yes_all_tickets"); ?></label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "ticket_permission_assigned_only",
                            "name" => "ticket_permission",
                            "value" => "assigned_only",
                            "class" => "ticket_permission toggle_specific",
                                ), $ticket, ($ticket === "assigned_only") ? true : false);
                        ?>
                        <label for="ticket_permission_assigned_only"><?php echo lang("yes_assigned_tickets_only"); ?></label>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_radio(array(
                            "id" => "ticket_permission_specific",
                            "name" => "ticket_permission",
                            "value" => "specific",
                            "class" => "ticket_permission toggle_specific",
                                ), $ticket, ($ticket === "specific") ? true : false);
                        ?>
                        <label for="ticket_permission_specific"><?php echo lang("yes_specific_ticket_types"); ?>:</label>
                        <div class="specific_dropdown">
                            <input type="text" value="<?php echo $ticket_specific; ?>" name="ticket_permission_specific" id="ticket_types_specific_dropdown" class="w100p validate-hidden"  data-rule-required="true" data-msg-required="<?php echo lang('field_required'); ?>" placeholder="<?php echo lang('choose_ticket_types'); ?>"  />
                        </div>
                    </div>
                </li>
                <li>
                    <h5><?php echo lang("can_manage_announcements"); ?></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "announcement_no",
                            "name" => "announcement_permission",
                            "value" => "",
                                ), $announcement, ($announcement === "") ? true : false);
                        ?>
                        <label for="announcement_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "announcement_yes",
                            "name" => "announcement_permission",
                            "value" => "all",
                                ), $announcement, ($announcement === "all") ? true : false);
                        ?>
                        <label for="announcement_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>
                <li>
                    <h5><?php echo lang("can_access_orders"); ?></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "order_no",
                            "name" => "order_permission",
                            "value" => "",
                                ), $order, ($order === "") ? true : false);
                        ?>
                        <label for="order_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "order_yes",
                            "name" => "order_permission",
                            "value" => "all",
                                ), $order, ($order === "all") ? true : false);
                        ?>
                        <label for="order_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>
                <li>
                    <h5><?php echo lang("can_manage_help_and_knowledge_base"); ?></h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "help_no",
                            "name" => "help_and_knowledge_base",
                            "value" => "",
                                ), $help_and_knowledge_base, ($help_and_knowledge_base === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "help_yes",
                            "name" => "help_and_knowledge_base",
                            "value" => "all",
                                ), $help_and_knowledge_base, ($help_and_knowledge_base === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access Client Approval ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "client_approval_no",
                            "name" => "client_approval",
                            "value" => "",
                                ), $client_approval, ($client_approval === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "client_approval_yes",
                            "name" => "client_approval",
                            "value" => "all",
                                ), $client_approval, ($client_approval === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>



                <li>
                    <h5>Can access Lead Approval ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "lead_approval_no",
                            "name" => "lead_approval",
                            "value" => "",
                                ), $lead_approval, ($lead_approval === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "lead_approval_yes",
                            "name" => "lead_approval",
                            "value" => "all",
                                ), $lead_approval, ($lead_approval === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>


                <li>
                    <h5>Can access Warehouse ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "warehouse_permission_no",
                            "name" => "warehouse_permission",
                            "value" => "",
                                ), $warehouse_permission, ($warehouse_permission === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "warehouse_permission_yes",
                            "name" => "warehouse_permission",
                            "value" => "all",
                                ), $warehouse_permission, ($warehouse_permission === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>



                <li>
                    <h5>Can access add products / products list ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "access_products",
                            "name" => "access_products",
                            "value" => "",
                                ), $access_products, ($access_products === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>

                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "access_products_yes",
                            "name" => "access_products",
                            "value" => "all",
                                ), $access_products, ($access_products === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>





                <li>
                    <h5>Can access add purchase ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_purchase",
                            "name" => "add_purchase",
                            "value" => "",
                                ), $add_purchase, ($add_purchase === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_purchase_yes",
                            "name" => "add_purchase",
                            "value" => "all",
                                ), $add_purchase, ($add_purchase === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>




                <li>
                    <h5>Can access add purchase list?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_list",
                            "name" => "purchase_list",
                            "value" => "",
                                ), $purchase_list, ($purchase_list === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_list_yes",
                            "name" => "purchase_list",
                            "value" => "all",
                                ), $purchase_list, ($purchase_list === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>





                
                <li>
                    <h5>Can access add Purchase Return ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_purchase_return",
                            "name" => "add_purchase_return",
                            "value" => "",
                                ), $add_purchase_return, ($add_purchase_return === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_purchase_return_yes",
                            "name" => "add_purchase_return",
                            "value" => "all",
                                ), $add_purchase_return, ($add_purchase_return === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>




                <li>
                    <h5>Can access add Purchase Return List?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_return_list",
                            "name" => "purchase_return_list",
                            "value" => "",
                                ), $purchase_return_list, ($purchase_return_list === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_return_list_yes",
                            "name" => "purchase_return_list",
                            "value" => "all",
                                ), $purchase_return_list, ($purchase_return_list === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>














                <li>
                    <h5>Can access add GRN / GRN list?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "grn_list",
                            "name" => "grn_list",
                            "value" => "",
                                ), $grn_list, ($grn_list === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "grn_list_yes",
                            "name" => "grn_list",
                            "value" => "all",
                                ), $grn_list, ($grn_list === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access purchase requisition?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_requisition",
                            "name" => "purchase_requisition",
                            "value" => "",
                                ), $purchase_requisition, ($purchase_requisition === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_requisition_yes",
                            "name" => "purchase_requisition",
                            "value" => "all",
                                ), $purchase_requisition, ($purchase_requisition === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access purchase quotation?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_quotation",
                            "name" => "purchase_quotation",
                            "value" => "",
                                ), $purchase_quotation, ($purchase_quotation === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_quotation_yes",
                            "name" => "purchase_quotation",
                            "value" => "all",
                                ), $purchase_quotation, ($purchase_quotation === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access purchase order list?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_order_list",
                            "name" => "purchase_order_list",
                            "value" => "",
                                ), $purchase_order_list, ($purchase_order_list === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "purchase_order_list_yes",
                            "name" => "purchase_order_list",
                            "value" => "all",
                                ), $purchase_order_list, ($purchase_order_list === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access add purchase order?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_purchase_order",
                            "name" => "add_purchase_order",
                            "value" => "",
                                ), $add_purchase_order, ($add_purchase_order === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_purchase_order_yes",
                            "name" => "add_purchase_order",
                            "value" => "all",
                                ), $add_purchase_order, ($add_purchase_order === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>




                <li>
                    <h5>Can access add sales?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_sales",
                            "name" => "add_sales",
                            "value" => "",
                                ), $add_sales, ($add_sales === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_sales_yes",
                            "name" => "add_sales",
                            "value" => "all",
                                ), $add_sales, ($add_sales === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access sales list?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "sales_list",
                            "name" => "sales_list",
                            "value" => "",
                                ), $sales_list, ($sales_list === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "sales_list_yes",
                            "name" => "sales_list",
                            "value" => "all",
                                ), $sales_list, ($sales_list === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>




                
                <li>
                    <h5>Can access add Sales Return?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_sales_return",
                            "name" => "add_sales_return",
                            "value" => "",
                                ), $add_sales_return, ($add_sales_return === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_sales_return_yes",
                            "name" => "add_sales_return",
                            "value" => "all",
                                ), $add_sales_return, ($add_sales_return === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access Sales Return List?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "sales_return_list",
                            "name" => "sales_return_list",
                            "value" => "",
                                ), $sales_return_list, ($sales_return_list === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "sales_return_list_yes",
                            "name" => "sales_return_list",
                            "value" => "all",
                                ), $sales_return_list, ($sales_return_list === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>






                <li>
                    <h5>Can access add transfer?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_transfer",
                            "name" => "add_transfer",
                            "value" => "",
                                ), $add_transfer, ($add_transfer === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "add_transfer_yes",
                            "name" => "add_transfer",
                            "value" => "all",
                                ), $add_transfer, ($add_transfer === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access transfer list?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "transfer_list",
                            "name" => "transfer_list",
                            "value" => "",
                                ), $transfer_list, ($transfer_list === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "transfer_list_yes",
                            "name" => "transfer_list",
                            "value" => "all",
                                ), $transfer_list, ($transfer_list === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access BOM list?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "bom_list",
                            "name" => "bom_list",
                            "value" => "",
                                ), $bom_list, ($bom_list === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "bom_list_yes",
                            "name" => "bom_list",
                            "value" => "all",
                                ), $bom_list, ($bom_list === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>

                <li>
                    <h5>Can access work order list?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "work_order_list",
                            "name" => "work_order_list",
                            "value" => "",
                                ), $work_order_list, ($work_order_list === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "work_order_list_yes",
                            "name" => "work_order_list",
                            "value" => "all",
                                ), $work_order_list, ($work_order_list === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>


                <li>
                    <h5>Can access A/C list, Money Transfer, Balance Sheet, Acc. Stmt?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "account_permission_no",
                            "name" => "account_permission",
                            "value" => "",
                                ), $account_permission, ($account_permission === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "account_permission_yes",
                            "name" => "account_permission",
                            "value" => "all",
                                ), $account_permission, ($account_permission === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>



                <li>
                    <h5>Can access Payments, Payments Due List?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "payments_permission_no",
                            "name" => "payments_permission",
                            "value" => "",
                                ), $payments_permission, ($payments_permission === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "payments_permission_yes",
                            "name" => "payments_permission",
                            "value" => "all",
                                ), $payments_permission, ($payments_permission === "all") ? true : false);
                        ?>
                        <label for="help_yes"><?php echo lang("yes"); ?></label>
                    </div>
                </li>



                <li>
                    <h5>Can access Petrol Allowance?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "petrol_permission_no",
                            "name" => "petrol_permission",
                            "value" => "",
                                ), $petrol_permission, ($petrol_permission === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>

                        <?php
                        echo form_radio(array(
                            "id" => "petrol_permission_yes",
                            "name" => "petrol_permission",
                            "value" => "all",
                                ), $petrol_permission, ($petrol_permission === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>



                <li>
                    <h5>Can access Expense Approval?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "expense_approval_no",
                            "name" => "expense_approval",
                            "value" => "",
                                ), $expense_approval, ($expense_approval === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                    
                        <?php
                        echo form_radio(array(
                            "id" => "expense_approval_yes",
                            "name" => "expense_approval",
                            "value" => "all",
                                ), $expense_approval, ($expense_approval === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>



                <li>
                    <h5>Can access HRM ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "hrm_permission_no",
                            "name" => "hrm_permission",
                            "value" => "",
                                ), $hrm_permission, ($hrm_permission === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                    
                        <?php
                        echo form_radio(array(
                            "id" => "hrm_permission_yes",
                            "name" => "hrm_permission",
                            "value" => "all",
                                ), $hrm_permission, ($hrm_permission === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>

                <li>  <!-- AG2103Q -->
                    <h5>Can access view production ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "view_production_no",
                            "name" => "view_production",
                            "value" => "",
                                ), $view_production, ($view_production === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                    
                        <?php
                        echo form_radio(array(
                            "id" => "view_production_yes",
                            "name" => "view_production",
                            "value" => "all",
                                ), $view_production, ($view_production === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>

<!--R.V 29_03S-->
<li>
                    <h5>Can access Dc Outward Of indent ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "indent_permission_no",
                            "name" => "indent_permission",
                            "value" => "",
                                ), $indent_permission, ($indent_permission === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                    
                        <?php
                        echo form_radio(array(
                            "id" => "indent_permission_yes",
                            "name" => "indent_permission",
                            "value" => "all",
                                ), $indent_permission, ($indent_permission === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>
                <li>
                    <h5>Can access Quality Check ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "quality_check_no",
                            "name" => "quality_check",
                            "value" => "",
                                ), $quality_check, ($quality_check === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                    
                        <?php
                        echo form_radio(array(
                            "id" => "quality_check_yes",
                            "name" => "quality_check",
                            "value" => "all",
                                ), $quality_check, ($quality_check === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>

                <li>
                    <h5>Can access DC Outward ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "dc_outward_no",
                            "name" => "dc_outward",
                            "value" => "",
                                ), $dc_outward, ($dc_outward === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                    
                        <?php
                        echo form_radio(array(
                            "id" => "dc_outward_yes",
                            "name" => "dc_outward",
                            "value" => "all",
                                ), $dc_outward, ($dc_outward === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>

                <li>
                    <h5>Can download employee id / address proof ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "download_proof_no",
                            "name" => "download_proof",
                            "value" => "",
                                ), $download_proof, ($download_proof === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                    
                        <?php
                        echo form_radio(array(
                            "id" => "download_proof_yes",
                            "name" => "download_proof",
                            "value" => "all",
                                ), $download_proof, ($download_proof === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>
                <li>
                    <h5>Can access sales order ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "sales_order_no",
                            "name" => "sales_order",
                            "value" => "",
                                ), $sales_order, ($sales_order === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                    
                        <?php
                        echo form_radio(array(
                            "id" => "sales_order_yes",
                            "name" => "sales_order",
                            "value" => "all",
                                ), $sales_order, ($sales_order === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>
                <li>
                    <h5>Can access sales quotation ?</h5>
                    <div>
                        <?php
                        echo form_radio(array(
                            "id" => "sales_quotation_no",
                            "name" => "sales_quotation",
                            "value" => "",
                                ), $sales_quotation, ($sales_quotation === "") ? true : false);
                        ?>
                        <label for="help_no"><?php echo lang("no"); ?> </label>
                    </div>
                    
                    <div>
                    
                        <?php
                        echo form_radio(array(
                            "id" => "sales_quotation_yes",
                            "name" => "sales_quotation",
                            "value" => "all",
                                ), $sales_quotation, ($sales_quotation === "all") ? true : false);
                        ?>

                        <label for="help_yes"><?php echo lang("yes"); ?></label>

                    </div>

                </li>


<!--R.V 29_03S-->


            </ul>

        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary mr10"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#permissions-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
            }
        });

        $("#leave_specific_dropdown, #attendance_specific_dropdown, #timesheet_manage_permission_specific_dropdown,  #team_member_update_permission_specific_dropdown, #message_permission_specific_dropdown").select2({
            multiple: true,
            formatResult: teamAndMemberSelect2Format,
            formatSelection: teamAndMemberSelect2Format,
            data: <?php echo ($members_and_teams_dropdown); ?>
        });

        $("#ticket_types_specific_dropdown").select2({
            multiple: true,
            data: <?php echo ($ticket_types_dropdown); ?>
        });

        $('[data-toggle="tooltip"]').tooltip();

        $(".toggle_specific").click(function () {
            toggle_specific_dropdown();
        });

        toggle_specific_dropdown();

        function toggle_specific_dropdown() {
            var selectors = [".leave_permission", ".attendance_permission", ".timesheet_manage_permission", ".team_member_update_permission", ".ticket_permission", ".message_permission_specific"];
            $.each(selectors, function (index, element) {
                var $element = $(element + ":checked");
                if ((element !== ".message_permission_specific" && $element.val() === "specific") || (element === ".message_permission_specific" && $element.is(":checked") && !$("#message_permission_specific_area").hasClass("hide"))) {
                    $element.closest("li").find(".specific_dropdown").show().find("input").addClass("validate-hidden");
                } else {
                    //console.log($element.closest("li").find(".specific_dropdown"));
                    $(element).closest("li").find(".specific_dropdown").hide().find("input").removeClass("validate-hidden");
                }
            });

        }

        //show/hide message permission checkbox
        $("#message_permission_no").click(function () {
            if ($(this).is(":checked")) {
                $("#message_permission_specific_area").addClass("hide");
            } else {
                $("#message_permission_specific_area").removeClass("hide");
            }

            toggle_specific_dropdown();
        });

        var manageProjectSection = "#can_manage_all_projects, #can_create_projects, #can_edit_projects, #can_delete_projects, #can_add_remove_project_members, #can_create_tasks";
        var manageAssignedTasks = "#show_assigned_tasks_only, #can_update_only_assigned_tasks_status";
        var manageAssignedTasksSection = "#show_assigned_tasks_only_section, #can_update_only_assigned_tasks_status_section";

        if ($(manageProjectSection).is(':checked')) {
            $(manageAssignedTasksSection).addClass("hide");
        }

        $(manageProjectSection).click(function () {
            if ($(this).is(":checked")) {
                $(manageAssignedTasks).prop("checked", false);
                $(manageAssignedTasksSection).addClass("hide");
            }
        });

        $('.manage_project_section').change(function () {
            var checkedStatus = $('.manage_project_section:checkbox:checked').length > 0;
            if (!checkedStatus) {
                $(manageAssignedTasksSection).removeClass("hide");
            }
        }).change();

    });
</script>