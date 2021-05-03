
<div id="page-content" class="p20 clearfix">
    <div class="p-1">

    
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('purchase_order_list'); ?></h4>
                    <div class="title-button-group">
                        <a href="<?php echo_uri("purchase_order/create") ?>">
                            <button class="btn btn-md btn-default">Add Purchase Order</button>
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
            source: '<?php echo_uri("purchase_order/list_data") ?>',
            columns: [
                {title: 'S NO'},
                {title: 'Date'},
                {title: 'Purchase Order Number'},
               
                {title: 'Quotation Number'},
                {title: 'Purchase Requisition Number'},
                {title:'Total value'},
                {title:'PO Status'},//R.V12_04
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ]
        });
    });

   

</script>