<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Manage Credit"; ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo modal_anchor(get_uri("loan/modal_form"), "<i class='fa fa-plus-circle'></i> " . "Add Loan", array("class" => "btn btn-default", "title" => " Add Loan"));
                    
                    ?>
                </div>
            </div>
        

        <div class="table-responsive" id="new_work_list">
            <table id="salary-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
    
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#salary-table").appTable({                       
            source: '<?php echo_uri("loan/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "SI" ?>', "class": "w50"},               
                {title: '<?php echo "Employee Name" ?>'},               
                {title: '<?php echo "Designation" ?>'},                
                {title: '<?php echo "Loan Name" ?>'},                           
                {title: '<?php echo "Loan Amount" ?>'},
                {title: '<?php echo "Number of Inst." ?>'},
                {title: '<?php echo "Remaining Inst." ?>'},
                {title: '<?php echo "Date Added" ?>'},                        
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>