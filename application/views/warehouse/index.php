<div id="page-content" class="p20 clearfix">
    <div class="row">
      

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('warehouse'); ?></h4>
                    <div class="title-button-group">
                        
                        <?php echo modal_anchor(get_uri("warehouse/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_warehouse'), array("class" => "btn btn-default", "title" => lang('add_warehouse'))); ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="warehouse-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#warehouse-table").appTable({
            source: '<?php echo_uri("warehouse/list_data") ?>',
            columns: [
                {title: '<?php echo lang("name"); ?>'},
                {title: 'Contact'},
                {title: 'Address'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ]
        });
    });
</script>