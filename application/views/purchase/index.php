
<div id="page-content" class="p20 clearfix">
    <div class="p-1">

    
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('purchase_list'); ?></h4>
                    <div class="title-button-group">
                        <a href="<?php echo_uri("purchase/create") ?>">
                            <button class="btn btn-md btn-default">Add Purchase</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="purchases-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#purchases-table").appTable({
            source: '<?php echo_uri("purchase/list_data") ?>',
            columns: [
                {title: 'Date'},
                {title: 'Reference Number'},
                {title: 'Supplier'},
                {title: 'Purchase Status'},
                {title: 'Grand Total'},
                {title: 'Paid'},
                {title: 'Due'},
                {title: 'Payment Status'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center dropdown-option "}//changes darini 19-3
            ]
        });
    });

   

</script>