
<div id="page-content" class="p20 clearfix">
    <div class="p-1">

    
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('quotation_list'); ?></h4>
                    <div class="title-button-group">
                        <a href="<?php echo_uri("Quotations/create") ?>">
                            <button class="btn btn-md btn-default">Add Quotation</button>
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
            source: '<?php echo_uri("quotations/list_data") ?>',
            columns: [
                {title: 'S.No'},
                {title: 'Quotation_No'},
                {title: 'Date_Time'},
                {title: 'Purchase Request Number'},
                {title: 'file_name'},
                {title: 'file'},
                
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ]
        });
    });

   

</script>