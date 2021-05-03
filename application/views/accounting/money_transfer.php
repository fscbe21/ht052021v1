<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo lang("money_tranfer"); ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo modal_anchor(get_uri("accounting/money_transfer_modal"), "<i class='fa fa-plus-circle'></i> " . "Add Money Transfer", array("class" => "btn btn-default", "title" => "Add Money Transfer"));
                    
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
            source: '<?php echo_uri("accounting/list_data_moneytransfer/") ?>',                      
            columns: [
                {title: '<?php echo "Date" ?>'},
                {title: '<?php echo "Reference No" ?>'},
                {title: '<?php echo "From Account" ?>'},
                {title: '<?php echo "To Account" ?>'},
                {title: '<?php echo "Amount" ?>'},
                
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
               
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>