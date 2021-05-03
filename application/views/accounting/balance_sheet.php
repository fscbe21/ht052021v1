<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo lang("balance_sheet"); ?></h4>
              
            </div>
        

        <div class="table-responsive" id="new_work_list">
            <table id="balance-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
    
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#balance-table").appTable({                       
            source: '<?php echo_uri("accounting/list_data_balance_sheet/") ?>',                      
            columns: [
                {title: '<?php echo "Name" ?>'},
                {title: '<?php echo "Account no" ?>'},
                {title: '<?php echo "Credit" ?>'},
                {title: '<?php echo "Debit" ?>'},
                {title: '<?php echo "Balance" ?>'}
                
               
               
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>