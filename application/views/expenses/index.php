<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
        <ul id="expenses-tabs" data-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
            <li class="title-tab"><h4 class="pl15 pt10 pr15"><?php echo lang("expenses"); ?></h4></li>
            <li><a id="monthly-expenses-button"  role="presentation" class="active" href="javascript:;" data-target="#monthly-expenses"><?php echo lang("monthly"); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("expenses/yearly/"); ?>" data-target="#yearly-expenses"><?php echo lang('yearly'); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("expenses/custom/"); ?>" data-target="#custom-expenses"><?php echo lang('custom'); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("expenses/recurring/"); ?>" data-target="#recurring-expenses"><?php echo lang('recurring'); ?></a></li>
            <li><a role="presentation" href="<?php echo_uri("expenses/yearly_chart/"); ?>" data-target="#yearly-chart"><?php echo lang('chart'); ?></a></li>
            <div class="tab-title clearfix no-border">
                <div class="title-button-group">
                    
                    <?php echo modal_anchor(get_uri("expenses/modal_form_new"), "<i class='fa fa-plus-circle'></i> " . lang('add_expense'), array("class" => "btn btn-default mb0", "title" => lang('add_expense'))); ?>
                </div>
            </div>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="monthly-expenses">
                <div class="table-responsive">
                    <table id="monthly-expense-table" class="display" cellspacing="0" width="100%">
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="yearly-expenses"></div>
            <div role="tabpanel" class="tab-pane fade" id="custom-expenses"></div>
            <div role="tabpanel" class="tab-pane fade" id="recurring-expenses"></div>
            <div role="tabpanel" class="tab-pane fade" id="yearly-chart"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    loadExpensesTable = function (selector, dateRange) {
        var customDatePicker = "", recurring = "0";
        if (dateRange === "custom" || dateRange === "recurring") {
            customDatePicker = [{startDate: {name: "start_date", value: moment().format("YYYY-MM-DD")}, endDate: {name: "end_date", value: moment().format("YYYY-MM-DD")}, showClearButton: true}];
            
            if(dateRange === "recurring"){
                recurring = "1";
            }
            
            dateRange = "";
        }        

        $(selector).appTable({
            source: '<?php echo_uri("expenses/list_data") ?>',
            dateRangeType: dateRange,
            filterDropdown: [
                {name: "expense_category", class: "w200", options: <?php echo $categories_dropdown; ?>}
            ],
            order: [[0, "asc"]],
            rangeDatepicker: customDatePicker,
            columns: [

                {title: 'Date'},
                {title: 'Category'},
                {title: 'Expense Name'},
                {title: 'Account Name'},
                {title: 'Amount'},
                {title: 'Payment Method'},
                {title: 'Note'}

                <?php echo $custom_field_headers; ?>,
                
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: [1, 2, 3, 4, 6, 7, 8, 9],
            xlsColumns: [1, 2, 3, 4, 6, 7, 8, 9],
           // summation: [{column: 6, dataType: 'currency'}, {column: 7, dataType: 'currency'}, {column: 8, dataType: 'currency'}, {column: 9, dataType: 'currency'}]
        });
    };

    $(document).ready(function () {
        loadExpensesTable("#monthly-expense-table", "monthly");
    });
</script>
