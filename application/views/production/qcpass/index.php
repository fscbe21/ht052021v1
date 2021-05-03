<style>
td.option a, .dtr-details .edit, .dtr-details .delete, .select-member-field a.delete, .send-invitation-form .delete, .calendar-ids-form .delete-post-dropzone, .edit-image-file .delete-saved-file, .external-tickets-embedded-code {
    cursor: pointer;
    min-width: 28px;
    color: #ffffff;
    border-radius: 0% !important;
    display: inline-block;
    position: relative;
    vertical-align: central;
    text-align: center;
    border: none !important;
}
</style>
<div id="page-content" class="p20 clearfix">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Quality Check</h4>
                </div>
                <div class="table-responsive">
                    <table id="quality-check-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#quality-check-table").appTable({
            source: '<?php echo_uri("qcpass/list_data") ?>',
            columns: [
                {title: 'Work order number'},
                {title: 'Process id'},
                {title: 'End product id'},
                {title: 'BOM Name'},
                {title: 'Quantity'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ]
        });
    });
</script>