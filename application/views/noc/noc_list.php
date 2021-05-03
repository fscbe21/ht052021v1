<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo lang("manage_noc_list"); ?></h4>
                <div class="title-button-group">
                    <?php
                   
                       

                        echo modal_anchor(get_uri("noc/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_noc'), array("class" => "btn btn-default", "title" => lang('add_noc')));

                     
   // echo modal_anchor(get_uri("noc/modal_form_client"), "<i class='fa fa-plus-circle'></i> " . lang('add_noc_for_client'), array("class" => "btn btn-default", "title" => lang('add_department')));
                    
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
            source: '<?php echo_uri("noc/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "SL" ?>', "class": ""},
               
                {title: '<?php echo "Employee" ?>'},
               
                {title: '<?php echo "Date" ?>'},
                
                
               
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>