<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
        <ul id="payment-tabs" data-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
            <li class="title-tab"><h4 class="pl15 pt10 pr15">Payment Report</h4></li>
            <li><a id="monthly-expenses-button"  role="presentation" class="active" href="javascript:;" data-target="#monthly-payment"><?php echo lang("monthly"); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("report_payment/yearly/"); ?>" data-target="#yearly-payment"><?php echo lang('yearly'); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("report_payment/custom/"); ?>" data-target="#custom-payment"><?php echo lang('custom'); ?></a></li>
        </ul>


        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="monthly-payment">
                <div class="table-responsive">
                    <table id="monthly-payment-table" class="display" cellspacing="0" width="100%">   
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="yearly-payment"></div>
            <div role="tabpanel" class="tab-pane fade" id="custom-payment"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    loadPaymentTable = function (selector, dateRange) {
    var customDatePicker = "";
    if (dateRange === "custom") {
    customDatePicker = [{startDate: {name: "start_date", value: moment().format("YYYY-MM-DD")}, endDate: {name: "end_date", value: moment().format("YYYY-MM-DD")}, showClearButton: true}];
    dateRange = "";
    }

    var optionVisibility = false;
    $(selector).appTable({
    source: '<?php echo_uri("report_payment/list_data") ?>',
            dateRangeType: dateRange,
            order: [[0, "desc"]],
            filterDropdown: [
            {name: "payment_method", class: "w150", options: <?php $this->load->view("report/common_dropdowns/payment_method_dropdown"); ?>}
            ,
<?php if ($currencies_dropdown1) { ?>
                {name: "currency", class: "w150", options: <?php echo $currencies_dropdown1; ?>}
<?php } ?>
            ],
            rangeDatepicker: customDatePicker,
            columns: [
            {title: "<?php echo lang("payment_date") ?>", "class": "w10p", "iDataSort": 3},
            {title: "<?php echo lang("amount") ?>", "class": "w10p text-right"},
            {title: "<?php echo lang("payment_method") ?>", "class": "w10p text-left"},
            {title: "<?php echo lang("transaction_id") ?>", "class": "w15p text-left"},
            {title: "<?php echo lang("created_by") ?>", "class": "w15p text-left"}
            ],
            //printColumns: combineCustomFieldsColumns([0, 1, 2, 3, 5, 7]),
            //xlsColumns: combineCustomFieldsColumns([0, 1, 2, 3, 5, 7]),
            //summation: [{column: 5, dataType: 'number'}, {column: 6, dataType: 'number'}]
    });
    };

    $(document).ready(function () {
        loadPaymentTable("#monthly-payment-table", "monthly");
    });

</script>