<!-- AG2103  ADDED CSS-->
<style>
td.option a, .dtr-details .edit, .dtr-details .delete, .select-member-field a.delete, .send-invitation-form .delete, .calendar-ids-form .delete-post-dropzone, .edit-image-file .delete-saved-file, .external-tickets-embedded-code {
    cursor: pointer;
    min-width: 28px;
    background: #fff;
    color: #a1a3a5;
    border-radius: 0% !important;
    display: inline-block;
    position: relative;
    vertical-align: central;
    text-align: center;
    margin: 0 5px;
    padding: 4px 0px;
    border: none !important;
}
</style>
<div id="page-content" class="p20 clearfix">
    <div class="p-1">
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('work_order_list'); ?></h4>
                    <div class="title-button-group">
                        <a href="<?php echo_uri("work_order/create") ?>">
                            <button class="btn btn-md btn-default"><?php echo lang('add_work_order'); ?></button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="work-order-list-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#work-order-list-table").appTable({
            source: '<?php echo_uri("work_order/list_data") ?>',
            filterDropdown: [
                {name: "type", class: "w150", options: <?php $this->load->view("report/common_dropdowns/work_order_type"); ?>}          
            ],
            order: [[0, "desc"]],
            columns: [
                {title: '<?php echo lang('work_order_number'); ?>'},
                {title: '<?php echo 'Type'; ?>'},
                {title:'<?php echo lang('date'); ?>'},
                {title:'<?php echo lang('sales_order_number'); ?>'},
                {title:'<?php echo lang('customer'); ?>'},
                {title: '<?php echo lang('start_date'); ?>'},
                {title: '<?php echo lang('end_date'); ?>'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w250"}
            ]
        });
    });
</script>