<!-- AG2103  INITIAL CREATION -->
<div id="page-content" class="p20 clearfix">
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Reuse List</h4>
                </div>
                <div class="table-responsive">
                    <table id="reuse-list-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#reuse-list-table").appTable({

            source: '<?php echo_uri("reuse/list_data") ?>',

            columns: [
                {title: 'Created Date'},
                {title: 'Reuse Id'},
                {title: 'Work Order Id'},
                {title: 'Start Time'},
                {title: 'Product Name'},
                {title: 'Qty'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ]

        });
    });

</script>