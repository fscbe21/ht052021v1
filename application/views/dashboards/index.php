<div id="page-content" class="p20 clearfix">

    <?php
    if (count($dashboards)) {
        $this->load->view("dashboards/dashboard_header");
    }

    announcements_alert_widget();
    ?>

    <div class="row">
        <?php
        $widget_column = "3"; //default bootstrap column class
        $total_hidden = 0;

        if (!$show_attendance) {
            $total_hidden += 1;
        }

        if (!$show_event) {
            $total_hidden += 1;
        }

        if (!$show_timeline) {
            $total_hidden += 1;
        }

        //set bootstrap class for column
        if ($total_hidden == 1) {
            $widget_column = "4";
        } else if ($total_hidden == 2) {
            $widget_column = "6";
        } else if ($total_hidden == 3) {
            $widget_column = "12";
        }
        ?>

        <?php if ($show_attendance) { ?>
            <div class="col-md-<?php echo $widget_column; ?> col-sm-6 widget-container">
                <?php
                clock_widget();
                ?>
            </div>
        <?php } ?>
        <?php if ($show_timeline) { ?>
            <div class="col-md-<?php echo $widget_column; ?> col-sm-6  widget-container">
                <?php
                //new_posts_widget();
                total_clients_widget();
                ?>  
            </div>
        <?php } ?>

        <div class="col-md-<?php echo $widget_column; ?> col-sm-6  widget-container">
            <?php
         //   my_open_tasks_widget();
                total_leads_widget();
            ?> 
        </div>

        <?php if ($show_event) { ?>
            <div class="col-md-<?php echo $widget_column; ?> col-sm-6  widget-container">
                <?php
                events_today_widget();
                ?> 
            </div>
        <?php } ?>

        

    </div>

    <div class="row">
        <div class="col-md-4">

            
                <div class="row">
                    <div class="col-md-12 mb20 text-center">
                        <div class="bg-white project_and_clock_status_widget">
                            <?php
                            if (1) {
                                //count_project_status_widget();
                                ?>

                        <div class="box">
                            <div class="box-content widget-container b-r">
                                <div class="panel-body ">
                                    <h1><?php echo count_open_lead(1, "open"); ?></h1>
                                    <span class="text-off uppercase">Open Lead</span>
                                </div>
                            </div>
                            <div class="box-content widget-container">
                                <div class="panel-body ">
                                <h1><?php echo count_open_lead(1, "hot"); ?></h1>
                                    <span class="text-off uppercase">Hot Lead</span>
                                </div>
                            </div>
                            
                        </div>
                        
                        </div>
                        <div id="clock-status-widget" class="box b-t bg-white">
                                    <div class="box-content widget-container b-r">
                                        <div class="panel-body ">
                                        <h1><?php echo count_open_lead(1, "won"); ?></h1>
                                            <span class="text-off uppercase">Won Lead</span>

                                        </div>
                                    </div>
                                    <div class="box-content widget-container">
                                        <div class="panel-body ">
                                        <h1><?php echo count_open_lead(1, "lost"); ?></h1>
                                        <span class="text-off uppercase">Lost Lead</span>
                                        </div>
                                    </div>
                           
                            
                 
                       

                                <?php
                            }
                            ?> 
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                            
                    <?php
                        
                    if ($show_invoice_statistics) {
                        //invoice_statistics_widget();
                    } else if ($show_project_timesheet) {
                        if ($this->login_user->is_admin) {
                          // project_timesheet_statistics_widget("all_timesheet_statistics");
                        } else {
                           // project_timesheet_statistics_widget("my_timesheet_statistics");
                        }
                    }
                    ?> 
                </div>
            </div>
                

            <div class="row">
                <div class="col-md-12">
                    <?php
                        sales_target();
                       // type_of_materials();
                    ?> 
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <?php
                        events_widget();
                    if ($show_invoice_statistics) {
                        //invoice_statistics_widget();
                    } else if ($show_project_timesheet) {
                        if ($this->login_user->is_admin) {
                          // project_timesheet_statistics_widget("all_timesheet_statistics");
                        } else {
                           // project_timesheet_statistics_widget("my_timesheet_statistics");
                        }
                    }
                    ?> 
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 mb15">
                    <?php
                    if ($show_ticket_status) {
                       // ticket_status_widget();
                    } else if ($show_attendance) {
                        //timecard_statistics_widget();
                    }
                    ?>                        
                </div>
            </div>

        </div>

        <div class="col-md-5 widget-container">
            <?php                                                           //AG12022021
            $role = $this->login_user->role_id;                     //AG12022021

            if($role < 3) //for above sales executive               //AG12022021 
            {                                                       //AG12022021
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text-o"></i>&nbsp;Payment
                </div>
                <div id="project-timeline-container" style="max-height: 225px !important;">
                    <div class="panel-body"> 
                        <p style="padding: 10px"><strong>
                        TOTAL PAYMENTS : 12345632<br/><br />
                        PAID:125463<br /><br />
                        UNPAID : 458721</strong>
                        </p>
                    </div>
                </div>
            </div>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user-o"></i>&nbsp;Employee Attendance
                </div>
                <div id="project-timeline-container2" style="min-height: 225px !important;">
                    <div class="panel-body"> 
                        <?php
                          $current_emp = $this->login_user->id;
                          $attendence_data = $this->Attendance_model->members_currently_clocked_in($current_emp);
                          $ad = 1;
                          foreach($attendence_data as $adata){
                            $username = $this->Users_model->get_one($adata->user_id);
                            echo "<strong>".$ad.". ".$username->first_name." ".$username->last_name."</strong><br />";
                            $ad += 1;
                          }
                        ?>
                    </div>
                </div>
            </div>
                <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-check-square-o"></i>&nbsp;Approval Pending
                </div>
                <div id="project-timeline-container3" style="min-height: 225px !important;">
                    <div class="panel-body"> 
                    <?php
                        $pending_data = $this->Clients_model->current_approval_pending_list($role);
                        $ap = 1;
                        foreach($pending_data as $pdata){
                            echo "<strong>".$ap.". ".$pdata->company_name."</strong><br />";
                            $ap += 1;
                        }
                            ?>
                    </div>
                </div>
            </div>

            <?php
            }
            else if($role == 3)
            {
                ?>
                <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user-o"></i>&nbsp;Latest Customers
                </div>
                <div id="project-timeline-container4" style="min-height: 225px !important;">
                    <div class="panel-body"> 
                        <?php 
                            $currentemp = $this->login_user->id;
                            $customerData = $this->Clients_model->get_latest_client_list($currentemp);
                            $cd = 1;
                            foreach($customerData as $cdata){
                                echo "<strong>".$cd.". ".$cdata->company_name."</strong><br />";
                                $cd += 1;
                            }
                        ?>
                    </div>
                </div>
            </div>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-indent"></i>&nbsp;Customer to be invoiced
                </div>
                <div id="project-timeline-container5" style="min-height: 225px !important;">
                    <div class="panel-body"> 
                        <?php
                         /*  $current_emp = $this->login_user->id;
                          $attendence_data = $this->Attendance_model->members_currently_clocked_in($current_emp);
                          $ad = 1;
                          foreach($attendence_data as $adata){
                            $username = $this->Users_model->get_one($adata->user_id);
                            echo "<strong>".$ad.". ".$username->first_name." ".$username->last_name."</strong><br />";
                            $ad += 1;
                          } */
                        ?>
                    </div>
                </div>
            </div>
                <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-check-square-o"></i>&nbsp;Bill issue
                </div>
                <div id="project-timeline-container6" style="min-height: 225px !important;">
                    <div class="panel-body"> 
                    <!-- <?php
                        $pending_data = $this->Clients_model->current_approval_pending_list($role);
                        $ap = 1;
                        foreach($pending_data as $pdata){
                            echo "<strong>".$ap.". ".$pdata->company_name."</strong><br />";
                            $ap += 1;
                        }
                            ?> -->
                    </div>
                </div>
            </div>

                <?php
            }else{
                ?>
                <?php
            }
            ?>
        </div>
        

        <div class="col-md-3 widget-container">
            <?php
            
              //  income_vs_expenses_widget();
              
            ?>
        </div>

            <div class="col-md-3 widget-container">
                <?php target_achieved(); ?>
            </div>

            <div class="col-md-3 widget-container">
            <?php performance_chart(); ?>
            <?php sticky_note_widget(); ?>
            </div>

    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        initScrollbar('#project-timeline-container', {
            setHeight: 955
        });

        //update dashboard link
        $(".dashboard-menu, .dashboard-image").closest("a").attr("href", window.location.href);

    });
</script>    

