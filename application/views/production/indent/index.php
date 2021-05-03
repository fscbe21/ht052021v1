<!-- AG2303 - INITIAL CREATION -->
<div id="page-content" class="p20 clearfix">
    <div class="p-1">

        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Indent List</h4>
                    <!-- <div class="title-button-group">
                        <?php if($indent_id) {?>
                        <a href="<?php echo_uri("work_order") ?>">
                            <button class="btn btn-md btn-default">Work Order List</button>
                        </a>
                        <?php } ?>
                    </div> -->
                </div>
                <div class="table-responsive">
                    <table id="indent-list-table" class="display" cellspacing="0" width="100%">            
                    </table>
                    <br />
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#indent-list-table").appTable({
            source: '<?php echo_uri("indent/list_data/".$work_order_id."/".$end_product_id."/".$bom_id) ?>',
            columns: [
                {title: 'NO'},
                {title: 'Work<br /> order <br />Number'},
                {title: 'End Product Name'},
                {title: 'Bom Name'},
                {title: 'Vendor Name'},
                {title: 'Requested To'},
                {title: 'Created at'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ]
        });
    });
</script>