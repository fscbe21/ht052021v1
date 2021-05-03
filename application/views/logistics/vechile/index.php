<div id="page-content" class="m20 clearfix">
    <div class="row">

        <div class="panel">
            <div class="panel panel-default">

                <ul data-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
                    <li><a  role="presentation" class="active" href="javascript:;" data-target="#vechicle-tab"> <?php echo "Vehicles"; ?></a></li>
                    
                    <li><a role="presentation" href="<?php echo_uri("vechicle_services"); ?>" data-target="#services-tab"><?php echo "Services"; ?></a></li>
                    
                    <li><a role="presentation" href="<?php echo_uri(""); ?>" data-target="#fuel-tab"><?php echo "Fuel Consumptions"; ?></a></li>

                    <li><a role="presentation" href="<?php echo_uri(""); ?>" data-target="#insurance-tab"><?php echo "Insurance"; ?></a></li>

                    <!--<li><a role="presentation" href="<?php echo_uri(""); ?>" data-target="#fasttag-tab"><?php echo "Fast Tag"; ?></a></li>-->
              
                    <div class="tab-title clearfix no-border">
                        <div class="title-button-group">
                            <?php echo modal_anchor(get_uri("logistics/vechicle_modal_form"), "<i class='fa fa-plus-circle'></i> " . "Vehicles", array("class" => "btn btn-default", "title" => "Vehicles", "id" => "other-settings-add-btn")); ?>
                        </div>
                    </div>
                </ul>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane fade" id="vechicle-tab">
                        <div class="table-responsive">
                            <table id="other-district-table" class="display b-t b-b-only no-hover" cellspacing="0" width="100%">         
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="services-tab">
                        <div class="table-responsive">
                            <table id="services-table" class="display b-t b-b-only no-hover" cellspacing="0" width="100%">         
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="fuel-tab">
                        <div class="table-responsive">
                            <table id="fuel-table" class="display b-t b-b-only" cellspacing="0" width="100%">         
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="insurance-tab">
                        <div class="table-responsive">
                            <table id="insurance-table" class="display b-t b-b-only" cellspacing="0" width="100%">         
                            </table>
                        </div>
                    </div>
                     
                    <div role="tabpanel" class="tab-pane fade" id="fasttag-tab">
                        <div class="table-responsive">
                            <table id="fasttag-table" class="display b-t b-b-only" cellspacing="0" width="100%">         
                            </table>
                        </div>
                    </div>

                    
                    <!--<div role="tabpanel" class="tab-pane fade" id="services-tab"></div>-->

                    

                </div>

                </div>

                </div>

            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#other-district-table").appTable({                       
            source: '<?php echo_uri("logistics/list_data/") ?>', 
            radioButtons: [{text: 'Active Vehicles', name: "status", value: "active", isChecked: true}, {text: 'Inactive Vehicles', name: "status", value: "inactive", isChecked: false}],                    
            columns: [
                {title: '<?php echo "SL" ?>', "class": ""},
                {title: '<?php echo "Vehicle  Number" ?>'},
                {title: '<?php echo "Vehicle Model" ?>'},
                {title: '<?php echo "vehicle Name" ?>'},
                {title: 'Insurance Expire Date'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });

        $("#services-table").appTable({                       
            source: '<?php echo_uri("vechicle_services/list_data/") ?>',                      
            columns: [
                //{title: '<?php //echo "SL" ?>', "class": ""},
               
                {title: '<?php echo "Vehicle  Number" ?>'},

                {title: '<?php echo "Driver Name" ?>'},

                {title: '<?php echo "Service Type" ?>'},

                {title: '<?php echo "Date And Time" ?>'},

                {title: '<?php echo "Bill no" ?>'},

                {title: '<?php echo "Amount" ?>'},

              {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9]),
            summation: [ {column: 5, dataType: 'number'}]
        });


//R.V22_04
        $("#fuel-table").appTable({                       
            source: '<?php echo_uri("fuel_consumptions/list_data/") ?>',                      
            columns: [
                //{title: '<?php //echo "SL" ?>', "class": ""},
               
                {title: '<?php echo "Vehicle  Number" ?>'},

                {title: '<?php echo "Driver Name" ?>'},

                {title: '<?php echo "Opening Reading" ?>'},

                {title: '<?php echo "Closing Reading" ?>'},

                {title: '<?php echo "Running KM" ?>'},

                {title: '<?php echo "Litter" ?>'},

                {title: '<?php echo "Date And Time" ?>'},

                {title: '<?php echo "Bill No" ?>'},

                {title: '<?php echo "Amount" ?>'},

                
               
               
                
                
               
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9]),
            summation: [ {column: 8, dataType: 'number'}]
        });


        $("#fasttag-table").appTable({                       
            source: '<?php echo_uri("fasttag/list_data/") ?>',                      
            columns: [
                {title: '<?php echo "SL" ?>', "class": ""},
               
                {title: '<?php echo "Vehicle Number" ?>'},

                {title: '<?php echo "Date" ?>'},

                {title: '<?php echo "Amount" ?>'},

                {title: '<?php echo "Payment Mode" ?>'},

                
               
               
                
                
               
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9])
        });


        $("#insurance-table").appTable({                       
            source: '<?php echo_uri("vechicle_services/insurance_list_data/") ?>',                      
            columns: [
                //{title: '<?php echo "SL" ?>', "class": ""},
               
                {title: '<?php echo "Vehicle Number" ?>'},

                {title: '<?php echo "Insurance Company" ?>'},

                {title: '<?php echo "Type Of Insurance" ?>'},

                {title: '<?php echo "Insurance Expiry Date" ?>'},

                {title: '<?php echo "Bill No" ?>'},
 
                {title: '<?php echo "Amount" ?>'},
                
               
               
                
                
               
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5, 7, 9]),
            summation: [ {column: 5, dataType: 'number'}]
        });


        //change the add button attributes on changing tab panel
       var addButton = $("#other-settings-add-btn");

        $(".nav-tabs li").click(function () {
            var activeField = $(this).find("a").attr("data-target");

            //lead status
            if (activeField === "#vechicle-tab") {
                addButton.attr("title", "<?php echo "Vehicles"; ?>");
                addButton.attr("data-title", "<?php echo "Vehicles"; ?>");
                addButton.attr("style", "display:block");
                addButton.attr("data-action-url", "<?php echo get_uri("logistics/vechicle_modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . "Vehicles"; ?>");
            } else if (activeField === "#fuel-tab") {
                addButton.attr("style", "display:none");
                addButton.attr("title", "<?php echo "Fuel Consumptions"; ?>");
                addButton.attr("data-title", "<?php echo "Fuel Consumptions"; ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("Fuel_consumptions/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . "Fuel Consumptions"; ?>");
            }else if (activeField === "#services-tab") {
                addButton.attr("title", "<?php echo "Services"; ?>");
                addButton.attr("data-title", "<?php echo "Services"; ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("vechicle_services/services_modal_form"); ?>");
                addButton.attr("style", "display:block");
                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " ."Services"; ?>");
            }
//R.V Start 26_02 Start
            else if (activeField === "#fasttag-tab") {
                addButton.attr("title", "<?php echo 'Fast Tag'; ?>");
                addButton.attr("data-title", "<?php echo 'Fast Tag'; ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("fasttag/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . "Fast Tag"; ?>");
            }
//R.V Start 26_02 End   


     else if (activeField === "#insurance-tab") {
        //addButton.attr("style", "display:none");

        addButton.attr("title", "<?php echo 'Fast Tag'; ?>");
                addButton.attr("data-title", "<?php echo 'Fast Tag'; ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("fasttag/modal_form"); ?>");
                addButton.attr("style", "display:none");
                addButton.html();
                
            }
 
  
 //R.V Start 03_01 Start
            else if (activeField === "#id_proof-tab") {
                addButton.attr("title", "<?php echo lang("id_proof"); ?>");
                addButton.attr("data-title", "<?php echo lang("id_proof"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("id_proof/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang("id_proof"); ?>");
            }

            else if (activeField === "#address_proof-tab") {
                addButton.attr("title", "<?php echo lang("address_proof"); ?>");
                addButton.attr("data-title", "<?php echo lang("address_proof"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("address_proof/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang("address_proof"); ?>");
            }


 //R.V Start 03_01 End  
 //R.V_03_02 Start        
 else if (activeField === "#purchase_status-tab") {
                addButton.attr("title", "<?php echo lang("purchase_status"); ?>");
                addButton.attr("data-title", "<?php echo lang("purchase_status"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("purchase_status/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang("purchase_status"); ?>");
            }

            else if (activeField === "#sale_status-tab") {
                addButton.attr("title", "<?php echo lang("sale_status"); ?>");
                addButton.attr("data-title", "<?php echo lang("sale_status"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("sale_status/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang("sale_status"); ?>");
            }


            else if (activeField === "#payment_status-tab") {
                addButton.attr("title", "<?php echo lang("payment_status"); ?>");
                addButton.attr("data-title", "<?php echo lang("payment_status"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("payment_status/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang("payment_status"); ?>");
            }
       //R.V_03_02 End
       else if (activeField === "#other-stage-tab") {
                addButton.attr("title", "<?php echo lang("other_stage"); ?>");
                addButton.attr("data-title", "<?php echo lang("other_stage"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("other_stage/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang('other_stage'); ?>");
            }    

 
        });

        
    });
</script>