<div id="page-content" class="m20 clearfix">
<!-- AG -->
    <div class="panel">
            <div class="tab-title clearfix">
                <h4><?php echo "Manage Petrol Allowance"; ?></h4>
                <div class="title-button-group">
                    <?php
                     if($this->login_user->is_admin){
                        echo modal_anchor(get_uri("expenses/modal_form_petrol"), "<i class='fa fa-plus-circle'></i> " . "Add Petrol Allowance", array("class" => "btn btn-default", "title" => "Add Petrol Allowance"));
                        ?>
                       <!--  <?php echo modal_anchor(get_uri("expenses/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_expense'), array("class" => "btn btn-default mb0", "title" => lang('add_expense'))); ?> -->
                        <?php
                     }
                    ?>
                </div>
            </div>
        <div class="table-responsive" id="petrol_list">
            <table id="petrol-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
</div>

<div id="page-content" class="m20 clearfix">
<!-- AG -->
    <div class="panel">
            <div class="tab-title clearfix">
                <h4><?php echo "Petrol Allowance In Hand"; ?></h4>
                
            </div>
        <div class="table-responsive" id="petrol_list">
            <table id="petrol-table1"  class="display" width="100%">            
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
                {title: '<?php echo "Created By" ?>'},
                {title: '<?php echo "Date and Time" ?>'},                       
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([1, 3, 5]),
            xlsColumns: combineCustomFieldsColumns([1, 3, 5])
        });

        $("#petrol-table1").appTable({                       
            source: '<?php echo_uri("expenses/petrol_payments_in_hand/") ?>',                      
            columns: [
                {title: '<?php echo "SI" ?>', "class": "w50"},
                {title: '<?php echo "Employee Name" ?>'},
                {title: '<?php echo "Issued Amount" ?>'},
                {title: '<?php echo "Amount In hand" ?>'}
            ],
            printColumns: combineCustomFieldsColumns([1, 3]),
            xlsColumns: combineCustomFieldsColumns([1, 3])
        });
    });
</script>