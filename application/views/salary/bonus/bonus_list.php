<div id="page-content" class="m20 clearfix">
<!-- AG -->

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Manage Bonus"; ?></h4>
                <div class="title-button-group">
                    <?php
                   
                        echo modal_anchor(get_uri("bonus/modal_form"), "<i class='fa fa-plus-circle'></i> " . "Add Bonus", array("class" => "btn btn-default", "title" => " Add Bonus"));
                    
                    ?>
                </div>
            </div>
        


        <div class="table-responsive" id="bonus_list">
            <table id="bonus-table"  class="display" width="100%">            
            </table>
        </div>
    </div>
    
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#bonus-table").appTable({                       
            source: '<?php echo_uri("bonus/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "SI" ?>', "class": "w50"},
                {title: '<?php echo "Bonus Group Name" ?>'},
                {title: '<?php echo "Bonus Name" ?>'},
                {title: '<?php echo "Bonus Month" ?>'},
                {title: '<?php echo "Bonus Percentage" ?>'},
                {title: '<?php echo "Date Added" ?>'},                        
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([1, 3, 5]),
            xlsColumns: combineCustomFieldsColumns([1, 3, 5])
        });
    });
 
        </script>