
<div id="page-content" class="p20 clearfix">
    <div class="p-1">

    
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('grn_list'); ?></h4>
                    <div class="title-button-group">
                        <a href="<?php echo_uri("grn/create") ?>">
                            <button class="btn btn-md btn-default">Add GRN</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="grns-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#grns-table").appTable({
            source: '<?php echo_uri("grn/list_data") ?>',
            columns: [
                {title: 'GRN No'},
                {title: 'Created Date<br />and Time'},
                {title: 'Reference Number'},
                {title: 'Supplier'},
                {title: 'Grn Status'},
                {title: 'Grand Total'},
                {title: 'GRN Date'},
                {title: 'DC No'},
                {title: 'DC Date'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ]
        });
    });
</script>