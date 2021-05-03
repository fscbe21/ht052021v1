<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Purchase Return "; ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo anchor(get_uri("purchase_return/add_purchase_return"), "<i class='fa fa-plus-circle'></i> " . "Add Purchase Return", array("class" => "btn btn-default", "title" => "Add Purchase Return"));
                    
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
            source: '<?php echo_uri("purchase_return/list_data") ?>',                      
            columns: [
                {title: '<?php echo "Date" ?>'},
                {title: '<?php echo "Reference" ?>'},                              
                {title: '<?php echo "Warehouse" ?>' },   
                {title: '<?php echo "Supplier" ?>'},             
                {title: '<?php echo "Account" ?>'},    //1-4
                {title: '<?php echo "Grand Total" ?>'},                
                {title: '<i class="fa fa-bars"></i>', "class": " text-center dropdown-option"}
               
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>