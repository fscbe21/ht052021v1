<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo lang("salary_list"); ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo anchor(get_uri("salary"), "<i class='fa fa-edit'></i> " . "Manage Salary", array("class" => "btn btn-default", "title" => "Manage Salary"));
                    
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
            source: '<?php echo_uri("salary/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "SI" ?>', "class": "w50"},
               
                {title: '<?php echo "Employee name" ?>'},
               
                {title: '<?php echo "Designation" ?>'},
                
                {title: '<?php echo "Employee Type" ?>'},
               
                {title: '<?php echo "Gross Salary" ?>'},
                {title: '<?php echo "Deductions" ?>'},
                {title: '<?php echo "Net Salary" ?>'},
                {title: '<?php echo "Updated At" ?>'},
               
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>