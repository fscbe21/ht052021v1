<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo lang("attendance_import"); ?></h4>
               
            </div>
            <div class="modal-body clearfix " >

            <form>

             <div class="form-group  col-sm-offset-3 col-sm-6">
                <label class="<?php echo $label_column; ?>"><strong><?php echo "Select Employee"; ?></strong></label>
                <div class="<?php echo $field_column; ?>">
                <select name="user_id" class="form-control" required>   
                    <option value="" > Select Employee</option> 
                    <?php foreach($employee_list as $emp){?>
                        <option value="<?php echo $emp->id; ?>" <?php if($user_id==$emp->id) {?> selected='selected'<?php }?>><?php echo $emp->first_name." ".$emp->last_name ; ?></option>
                    <?php }  ?>                                                      
                    </select>
                </div>
            </div>

            <div class="form-group  col-sm-offset-3 col-sm-6">
                <label for="month" class="<?php echo $label_column; ?>"><strong><?php echo "Select Month"; ?></strong></label>
                <div class="col-sm-4">
                    <?php
                    echo form_input(array(
                        "id" => "from_month",
                        "name" => "from_month",
                        "value" => "",
                        "class" => "form-control",
                        "placeholder" => "From",
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                        "required"=>true
                    ));
                    ?>
                </div>
                <div class="col-sm-4">
                    <?php
                    echo form_input(array(
                        "id" => "to_month",
                        "name" => "to_month",
                        "value" => "",
                        "class" => "form-control",
                        "placeholder" => "TO",
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                        "required"=>true
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group  col-sm-offset-3 col-sm-6">
            <div class="col-sm-offset-3">
                    <button type="submit" class="btn btn-info "><span class="fa fa-arrow-right"></span> View Salary Statement</btton>
                    </div>
            </div>
        </form>
    </div>

        <div class="table-responsive" id="report_lsit">
            <table id="report-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
    
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#report-table").appTable({                       
            source: '<?php echo_uri("machine_attendance/list_data_attendance_report/") ?>',                      
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
    setDatePicker("#to_month", {
            startDate: moment().add(-365, 'days').format("DD-MM-YYYY")
        });
        setDatePicker("#from_month", {
            startDate: moment().add(-365, 'days').format("DD-MM-YYYY")
        });

        </script>