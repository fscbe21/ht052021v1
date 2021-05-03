<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Dc Outward list"; ?></h4>
                <div class="title-button-group">
                        <a href="<?php echo_uri("production_dc_outward/create") ?>">
                            <button class="btn btn-md btn-default">Add Dc Outward</button>
                        </a>
                    </div>
                <!--<div class="title-button-group">
                    <?php
                   
                       

                        echo modal_anchor(get_uri("pickup/modal_form"), "<i class='fa fa-plus-circle'></i> " . "Dc Outward", array("class" => "btn btn-default", "title" => "Dc Outward"));

                     
   // echo modal_anchor(get_uri("noc/modal_form_client"), "<i class='fa fa-plus-circle'></i> " . lang('add_noc_for_client'), array("class" => "btn btn-default", "title" => lang('add_department')));
                    
                    ?>
                </div>-->
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
            source: '<?php echo_uri("production_dc_outward/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "DC_NO" ?>', "class": ""},
               
                {title: '<?php echo "Date" ?>'},
                {title: '<?php echo "WO_NO" ?>', "class": ""},
               
               {title: '<?php echo "WO_Date" ?>'},
               {title: '<?php echo "Shopkeeper_Name" ?>', "class": ""},
               
               {title: '<?php echo "Receiver_Name" ?>'},
              
                
                
               
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });
    });
 
        </script>