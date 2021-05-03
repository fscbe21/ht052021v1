<div id="page-content" class="p20 clearfix">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Warehouse Stock</h4>
                </div>
                <div class="table-responsive">
                    <table id="warehouse-stock-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#warehouse-stock-table").appTable({
            source: '<?php echo_uri("report/warehouseStockReport") ?>',
            columns: [
                {title: 'Sl. Number'},
                {title: 'Product Code'},
                {title: 'Product Name'},
                <?php 
                    foreach($warehouse_list as $wh){
                ?>
                {title: '<?php echo $wh->name; ?>'},
                <?php } ?>
            ],
            xlsColumns: combineCustomFieldsColumns([0, 1, 2, 3], '<?php echo $custom_field_headers; ?>')
        });
    });
</script>