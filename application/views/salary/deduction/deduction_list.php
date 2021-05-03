<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Manage Deduction"; ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo modal_anchor(get_uri("deduction/modal_form"), "<i class='fa fa-plus-circle'></i> " . "Add Deduction", array("class" => "btn btn-default", "title" => " Add Deduction"));
                    
                    ?>
                </div>
            </div>
        
        <div class="table-responsive" id="deduction_list">
            <table id="deduction-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
    
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#deduction-table").appTable({                       
            source: '<?php echo_uri("deduction/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "SI" ?>', "class": "w50"},
               
                {title: '<?php echo "Employee Name" ?>'},
               
                {title: '<?php echo "Designation" ?>'},
                
                {title: '<?php echo "Deduction Name" ?>'},
               
                {title: '<?php echo "Deduction Month" ?>'},
                {title: '<?php echo "Deduction Amount" ?>'},
                {title: '<?php echo "Date Added" ?>'},                        
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5])
        });
    });
 
        </script>