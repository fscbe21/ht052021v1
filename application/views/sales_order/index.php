<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Sales order List"; ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo anchor(get_uri("sales_order/add_sales"), "<i class='fa fa-plus-circle'></i> " . "Add Sales Order", array("class" => "btn btn-default", "title" => "Add Account"));
                    
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
            source: '<?php echo_uri("sales_order/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "Sales<br />Order<br />Number" ?>'},
                {title: '<?php echo "Date" ?>'},
                {title: '<?php echo "Reference" ?>'},
                {title: '<?php echo "Biller" ?>'},
                {title: '<?php echo "Customer" ?>'},
                {title: '<?php echo "Status" ?>' ,"class": " text-center"},
                {title: '<?php echo "Grand Total" ?>'},
                {title: '<?php echo "Sales Order Status" ?>'},
                {title: '<i class="fa fa-bars"></i>', "class": " text-center dropdown-option"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>