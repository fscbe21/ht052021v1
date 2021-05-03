<div id="page-content" class="p20 clearfix">
    <div class="p-1">
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('product_list'); ?></h4>
                    <div class="title-button-group">
                        
                        <?php echo modal_anchor(get_uri("products/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_product'), array("class" => "btn btn-default", "title" => lang('add_product'))); ?>

                    </div>
                </div>
                <div class="table-responsive">
                    <table id="products-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#products-table").appTable({
            source: '<?php echo_uri("products/list_data") ?>',
            columns: [
                {title: 'Image'},
                {title: 'Name'},
                {title: 'Code'},
                {title: 'Type'},
                {title: 'Category'},
                {title: 'Quantity'},
                {title: 'Unit'},
                {title: 'Price'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ]
        });
    });
    
</script>