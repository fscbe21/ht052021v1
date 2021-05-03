<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
        <ul id="due-tabs" data-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
            <li class="title-tab"><h4 class="pl15 pt10 pr15">Due Report</h4></li>
            <li><a id="monthly-expenses-button"  role="presentation" class="active" href="javascript:;" data-target="#monthly-due"><?php echo lang("monthly"); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("report_due/yearly/"); ?>" data-target="#yearly-due"><?php echo lang('yearly'); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("report_due/custom/"); ?>" data-target="#custom-due"><?php echo lang('custom'); ?></a></li>
        </ul>


        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="monthly-due">
                <div class="table-responsive">
                    <table id="monthly-due-table" class="display" cellspacing="0" width="100%">   
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="yearly-due"></div>
            <div role="tabpanel" class="tab-pane fade" id="custom-due"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    loadDueTable = function (selector, dateRange) {
    var customDatePicker = "";
    if (dateRange === "custom") {
    customDatePicker = [{startDate: {name: "start_date", value: moment().format("YYYY-MM-DD")}, endDate: {name: "end_date", value: moment().format("YYYY-MM-DD")}, showClearButton: true}];
    dateRange = "";
    }

    var optionVisibility = false;
    $(selector).appTable({
    source: '<?php echo_uri("report_due/list_data") ?>',
            dateRangeType: dateRange,
            order: [[0, "desc"]],
            filterDropdown: [
           
            ],
            rangeDatepicker: customDatePicker,
            columns: [
            {title: "<?php echo lang("client_name") ?>", "class": "w15p text-left"},
            {title: "Invoice Amount", "class": "w10p text-right"},
            {title: "Paid Amount", "class": "w10p text-right"},
            {title: "Due Amount", "class": "w10p text-right"}
            ],
    });
    };

    $(document).ready(function () {
        loadDueTable("#monthly-due-table", "monthly");
    });

</script>