<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Manage Holidays"; ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo modal_anchor(get_uri("holidays/modal_form"), "<i class='fa fa-plus-circle'></i> " . "Add Holidays", array("class" => "btn btn-default", "title" => "Add Holidays"));
                    
                    ?>
                </div>
            </div>
        

        <div class="table-responsive" id="holidays-list">
            <table id="holiday-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
    
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#holiday-table").appTable({                       
            source: '<?php echo_uri("holidays/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "Name" ?>', "class": "w50"},               
                {title: '<?php echo "Created By" ?>'},                
                {title: '<?php echo "Start Date" ?>'},               
                {title: '<?php echo "End Date" ?>'},
                {title: '<?php echo "Holiday Purpose" ?>'},                      
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>

        