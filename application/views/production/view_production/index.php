<!-- AG2103  INITIAL CREATION -->
<div id="page-content" class="p20 clearfix">
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Production List</h4>
                </div>
                <div class="table-responsive">
                    <table id="production-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#production-table").appTable({
            source: '<?php echo_uri("viewproduction/list_data") ?>',
            filterDropdown: [
                {name: "production_status", class: "w150", options: <?php $this->load->view("report/common_dropdowns/production_status"); ?>}          
            ],
            order: [[0, "desc"]],
            columns: [
                {title: 'Work order number'},
                {title: 'Sales order number'},
                {title: 'Date'},
                {title: 'Customer Name'},
                {title: 'Start Date'},
                {title: 'End Date'},
                {title: 'Duration'},
                {title: 'Status'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ]
        });
    });

</script>