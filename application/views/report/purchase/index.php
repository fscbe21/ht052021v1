<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
        <ul id="purchase-tabs" data-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
            <li class="title-tab"><h4 class="pl15 pt10 pr15">Purchase Report</h4></li>
            <li><a id="monthly-expenses-button"  role="presentation" class="active" href="javascript:;" data-target="#monthly-purchase"><?php echo lang("monthly"); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("reports/yearly/"); ?>" data-target="#yearly-purchase"><?php echo lang('yearly'); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("reports/custom/"); ?>" data-target="#custom-purchase"><?php echo lang('custom'); ?></a></li>
        </ul>


        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="monthly-purchase">
                <div class="table-responsive">
                    <table id="monthly-purchase-table" class="display" cellspacing="0" width="100%">   
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="yearly-purchase"></div>
            <div role="tabpanel" class="tab-pane fade" id="custom-purchase"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    loadPurchaseTable = function (selector, dateRange) {
    var customDatePicker = "";
    if (dateRange === "custom") {
    customDatePicker = [{startDate: {name: "start_date", value: moment().format("YYYY-MM-DD")}, endDate: {name: "end_date", value: moment().format("YYYY-MM-DD")}, showClearButton: true}];
    dateRange = "";
    }

    var optionVisibility = false;
    $(selector).appTable({
    source: '<?php echo_uri("reports/list_data") ?>',
            dateRangeType: dateRange,
            order: [[0, "desc"]],
            filterDropdown: [
                {name: "warehouse", class: "w150", options: <?php $this->load->view("report/common_dropdowns/warehouse_dropdown"); ?>}          
            ],
            rangeDatepicker: customDatePicker,
            columns: [
            {title: "<?php echo lang("product_name") ?>", "class": "w15p text-left"},
            {title: "<?php echo lang("purchased_amount") ?>", "class": "w10p text-right"},
            {title: "<?php echo lang("purchased_qty") ?>", "class": "w10p text-right"},
            // {title: "<?php echo lang("bill_date") ?>", "class": "w10p", "iDataSort": 3},
            // {title: "<?php echo lang("due_date") ?>", "class": "w10p", "iDataSort": 5},
            // {title: "<?php echo lang("invoice_value") ?>", "class": "w10p text-right"},
            // {title: "<?php echo lang("payment_received") ?>", "class": "w10p text-right"},
            {title: "<?php echo lang("instock") ?>", "class": "w10p text-right"}
            ],
            //printColumns: combineCustomFieldsColumns([0, 1, 2, 3, 5, 7]),
            //xlsColumns: combineCustomFieldsColumns([0, 1, 2, 3, 5, 7]),
            //summation: [{column: 5, dataType: 'number'}, {column: 6, dataType: 'number'}]
    });
    };

    $(document).ready(function () {
        loadPurchaseTable("#monthly-purchase-table", "monthly");
    });

</script>