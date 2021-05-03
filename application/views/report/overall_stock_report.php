<div id="page-content" class="p20 clearfix">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Overall Stock Report</h4>
                </div>
                <div class="table-responsive">
                    <table id="overall-stock-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#overall-stock-table").appTable({
            source: '<?php echo_uri("report/overallStockReport") ?>',
            filterDropdown: [
                {name: "warehouse_id", class: "w150", options: <?php $this->load->view("report/common_dropdowns/warehouse_dropdown"); ?>}          
            ],
            columns: [
                {title: 'Sl. Number'},
                {title: 'Product Code'},
                {title: 'Product Name'},
                {title: 'Product Quantity'},
            ],
            xlsColumns: combineCustomFieldsColumns([0, 1, 2, 3], '<?php echo $custom_field_headers; ?>')
        });
    });
</script>