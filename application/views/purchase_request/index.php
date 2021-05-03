
<div id="page-content" class="p20 clearfix">
    <div class="p-1">

    
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('purchase_request_list'); ?></h4>
                    <div class="title-button-group">
                        <a href="<?php echo_uri("purchase_request/create") ?>">
                            <button class="btn btn-md btn-default"><?php echo lang('add_purchase_request'); ?></button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="purchase-request-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#purchase-request-table").appTable({
            source: '<?php echo_uri("purchase_request/list_data") ?>',
            columns: [

                {title: 'S NO'},
                {title: 'Date'},
                {title: 'PR. Number'},
                {title: 'User'},
                {title: 'Warehouse'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ]
        });
    });

   

</script>