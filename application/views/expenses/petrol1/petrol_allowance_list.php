<div id="page-content" class="m20 clearfix">
<!-- AG -->

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Manage Petrol Allowance"; ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo modal_anchor(get_uri("expenses/modal_form_petrol"), "<i class='fa fa-plus-circle'></i> " . "Add Petrol Allowance", array("class" => "btn btn-default", "title" => "Add Petrol Allowance"));
                    
                    ?>
                </div>
            </div>
        
        <div class="table-responsive" id="petrol_list">
            <table id="petrol-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
    
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#petrol-table").appTable({                       
            source: '<?php echo_uri("expenses/petrol_payments/") ?>',                      
            columns: [
                {title: '<?php echo "SI" ?>', "class": "w50"},
                {title: '<?php echo "Employee Name" ?>'},
                {title: '<?php echo "Amount" ?>'},
                {title: '<?php echo "Issued By" ?>'},
                {title: '<?php echo "Date and Time" ?>'},                       
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([1, 3, 5]),
            xlsColumns: combineCustomFieldsColumns([1, 3, 5])
        });
    });
 
        </script>