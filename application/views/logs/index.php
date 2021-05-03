<div id="page-content" class="p20 clearfix">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <?php
            $tab_view['active_tab'] = "login_duration";
            $this->load->view("settings/tabs", $tab_view);
            ?>
        </div>

        <div class="col-sm-9 col-lg-10">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('logs'); ?></h4>
                </div>
                <div class="table-responsive">
                    <table id="logs-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        customDatePicker = [{startDate: {name: "start_date", value: moment().format("YYYY-MM-DD")}, endDate: {name: "end_date", value: moment().format("YYYY-MM-DD")}, showClearButton: true}];
        $("#logs-table").appTable({
            source: '<?php echo_uri("logs/list_data") ?>',
            filterDropdown: [
               
            
               {name: "employee", class: "w200", options: <?php echo $team_members_dropdown; ?>}
          
       ],
       rangeDatepicker: customDatePicker,
            columns: [
                {title: 'Employee Name'},
                {title: 'Login Time'},
                {title: 'Logout Time'},
                {title: 'IP Address'},
                {title: 'Duration'}                
            ]
        });

        setDatePicker("#selecteddate");

        $('button[name="end_date"]').css("display", "none");
        
    });



    
</script>