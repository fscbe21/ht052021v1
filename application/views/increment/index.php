<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Manage Increment"; ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo modal_anchor(get_uri("increment/modal_form"), "<i class='fa fa-plus-circle'></i> " . "Add Increment", array("class" => "btn btn-default", "title" => "Add Increment"));
                    
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
            source: '<?php echo_uri("increment/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "ID NO" ?>', "class": "w50"},               
                {title: '<?php echo "Created By" ?>'},                
                {title: '<?php echo "Employee" ?>'},               
                {title: '<?php echo "Increment Date" ?>'},
                {title: '<?php echo "Increment Amount" ?>'},
                {title: '<?php echo "Increment Purpose" ?>'},                        
                //{title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>

        