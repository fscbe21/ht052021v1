<?php if (isset($page_type) && $page_type === "full") { ?>
    <div id="page-content" class="m20 clearfix">
    <?php } ?>

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "New order"; ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo modal_anchor(get_uri("new_work_order/modal_form"), "<i class='fa fa-plus-circle'></i> " . "Add New order", array("class" => "btn btn-default", "data-post-client_id" => $client_id, "title" => "Add new order"));
                    
                    ?>
                </div>
            </div>
        

        <div class="table-responsive" id="new_work_list">
            <table id="project-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
    <?php if (isset($page_type) && $page_type === "full") { ?>
    </div>
<?php } ?>

<?php
if (!isset($project_labels_dropdown)) {
    $project_labels_dropdown = "0";
}
?>


<script type="text/javascript">
    $(document).ready(function () {
        var hideTools = "<?php
if (isset($page_type) && $page_type === 'dashboard') {
    echo 1;
}
?>" || 0;


        var filters = [{name: "project_label", class: "w200", options: <?php echo $project_labels_dropdown; ?>}];

        //don't show filters if hideTools is true or $project_labels_dropdown is empty
        if (hideTools || !<?php echo $project_labels_dropdown; ?>) {
            filters = false;
        }

        var optionVisibility = false;
        if ("<?php echo get_setting("client_can_edit_projects"); ?>") {
            optionVisibility = true;
        }


        $("#project-table").appTable({
            source: '<?php echo_uri("new_work_order/list_data_of_client/".$client_id) ?>',//darini 19-2
            order: [[0, "desc"]],
            hideTools: hideTools,
            multiSelect: [
                {
                    name: "status",
                    text: "<?php echo lang('status'); ?>",
                    options: [
                        {text: '<?php echo lang("open") ?>', value: "open", isChecked: true},
                        {text: '<?php echo lang("completed") ?>', value: "completed"},
                        {text: '<?php echo lang("hold") ?>', value: "hold"},
                        {text: '<?php echo lang("canceled") ?>', value: "canceled"}
                    ]
                }
            ],
            filterDropdown: filters,
            columns: [
                {title: '<?php echo "Order" ?>', "class": "w50"},
               
                {title: '<?php echo "Company name" ?>'},
               
                {title: '<?php echo "Status" ?>', "class": "w10p"},
                
                {title: '<?php echo "Assigned to" ?>', "class": "w10p", "iDataSort": 4},
               
                {title: '<?php echo "Source" ?>', "class": "w10p", "iDataSort": 6},
                {title: '<?php echo "Followup date" ?>', "class": "w15p"},
               
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9], '<?php echo $custom_field_headers; ?>'),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9], '<?php echo $custom_field_headers; ?>')
        });
    });
</script>