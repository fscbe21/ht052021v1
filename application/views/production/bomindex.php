<!-- AG10032021 - INITIAL CREATION -->
<div id="page-content" class="p20 clearfix">
    <div class="p-1">

    
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('bom_list'); ?></h4>
                    <div class="title-button-group">
                        <a href="<?php echo_uri("bomcreation/create") ?>">
                            <button class="btn btn-md btn-default">Add New BOM</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="bom-list-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#bom-list-table").appTable({
            source: '<?php echo_uri("bomcreation/list_data") ?>',
            columns: [
                {title: 'BOM NO'},
                {title: 'BOM NAME'},
                {title: 'END PRODUCT NAME'},
                {title: 'TYPE'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ]
        });
    });

   

</script>