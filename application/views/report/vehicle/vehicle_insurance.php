<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
        <ul id="vehicle-tabs" data-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
            <li class="title-tab"><h4 class="pl15 pt10 pr15">Vehicle Insurance Report</h4></li>
            <li><a id="monthly-vehicle-button"  role="presentation" class="active" href="javascript:;" data-target="#monthly-vehicle"><?php echo lang("monthly"); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("report/yearly/"); ?>" data-target="#yearly-vehicle"><?php echo lang('yearly'); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("report/custom/"); ?>" data-target="#custom-vehicle"><?php echo lang('custom'); ?></a></li>
        </ul>


        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="monthly-vehicle">
                <div class="table-responsive">
                    <table id="monthly-vehicle-table" class="display" cellspacing="0" width="100%">   
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="yearly-vehicle"></div>
            <div role="tabpanel" class="tab-pane fade" id="custom-vehicle"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    loadVehicleTable = function (selector, dateRange) {
    var customDatePicker = "";
    if (dateRange === "custom") {
    customDatePicker = [{startDate: {name: "start_date", value: moment().format("YYYY-MM-DD")}, endDate: {name: "end_date", value: moment().format("YYYY-MM-DD")}, showClearButton: true}];
    dateRange = "";
    }

    var optionVisibility = false;
    $(selector).appTable({
    source: '<?php echo_uri("report/vehicleInsurance") ?>',
            dateRangeType: dateRange,
            order: [[0, "desc"]],
            filterDropdown: [
                       
            ],
            rangeDatepicker: customDatePicker,
            columns: [
            {title: "Sl. No", "class": "w15p text-left"},
            {title: "Vehicle Number", "class": "w15p text-left"},
            {title: "Model Name", "class": "w10p text-right"},
            {title: "Vehicle Name", "class": "w10p text-right"},
            {title: "Insurance Expire Date", "class": "w10p text-right"}
            ],
    });
    };

    $(document).ready(function () {
        loadVehicleTable("#monthly-vehicle-table", "monthly");
    });

</script>