<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo lang("account_list"); ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo modal_anchor(get_uri("accounting/add_account_modal"), "<i class='fa fa-plus-circle'></i> " . "Add Account", array("class" => "btn btn-default", "title" => "Add Account"));
                    
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
            source: '<?php echo_uri("accounting/list_data_accounting/") ?>',                      
            columns: [
                {title: '<?php echo "AcountNO" ?>'},
                {title: '<?php echo "Name" ?>'},
                {title: '<?php echo "Initial balnace" ?>'},
                {title: '<?php echo "Default" ?>'},
                {title: '<?php echo "Note" ?>'},
                
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
               
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>