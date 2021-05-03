<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo lang("import_attendance"); ?></h4>
               
            </div>
       
        <!-- AG2402 START  -->     
        <div class="modal-body clearfix">
         <div class="col-md-12 panel">
            <div class=" col-md-6">
            <div class="form-group">
                    <label for="file_name" ><strong><?php echo "Choose XLSX File *"; ?></strong></label>
                  
                        <input type="file" id="excel_file" name="import_file1"  class="form-control"accept=".xls,.xlsx"  />
                        <button type="button" class="btn btn-info"  style="margin-top: 10px;" ><span class="fa fa-plus"></span>&nbsp;Import Excel File</button>
                   
            </div> 
            </div>
            <div class=" col-md-6">
            <div class="form-group">
                    <label for="file_name" ><strong><?php echo "Choose CSV File  *"; ?></strong></label>
                  
                        <input type="file" id="csv_file" name="import_file2"  class="form-control" accept=".csv" />
                        <button type="button" class="btn btn-info" style="margin-top: 10px;"><span class="fa fa-plus"></span>&nbsp;Import CSV File</button>
                   
            </div> 
            </div>
         </div>
        </div>
<!-- AG2402 END  --> 

        <div class="table-responsive" id="new_work_list">
            <table id="salary-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
    
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#salary-table").appTable({                       
            source: '<?php echo_uri("machine_attendance/list_data/") ?>',                      
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