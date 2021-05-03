<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo lang("attendance_manage"); ?></h4>
               
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
            source: '<?php echo_uri("machine_attendance/list_data_attendance/") ?>',                      
            columns: [
                {title: '<?php echo "SI" ?>', "class": "w50"},
                {title: '<?php echo "Employee ID" ?>'},
                {title: '<?php echo "Employee Name" ?>'},
                {title: '<?php echo "Date" ?>'},
                {title: '<?php echo "In Time" ?>'},
                
                {title: '<?php echo "Out Time" ?>'},
               
                {title: '<?php echo "Work Time" ?>'},
                {title: '<?php echo "Late" ?>'},
                {title: '<?php echo "Early" ?>'},
                {title: '<?php echo "Absence" ?>'}
                                     
           
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>