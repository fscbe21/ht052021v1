<div id="page-content" class="p20 clearfix">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <?php
            $tab_view['active_tab'] = "other_settings";
            $this->load->view("settings/tabs", $tab_view);
            ?>
        </div>

        <div class="col-sm-9 col-lg-10">
            <div class="panel panel-default">

                <ul data-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
                    <li><a  role="presentation" class="active" href="javascript:;" data-target="#other-district-tab"> <?php echo lang('other_district'); ?></a></li>
                    
                    <li><a role="presentation" href="<?php echo_uri("other_road"); ?>" data-target="#other-road-tab"><?php echo lang('other_road'); ?></a></li>
                    <li><a role="presentation" href="<?php echo_uri("other_area"); ?>" data-target="#other-area-tab"><?php echo lang('other_area'); ?></a></li>
                    <!-- R.V24_02S-->
                    <li><a role="presentation" href="<?php echo_uri("tds"); ?>" data-target="#tds-tab"><?php echo 'TDS'; ?></a></li>
                     <!-- R.V24_02E-->
					 
                     <!-- R.V1_03S-->
                    <li><a role="presentation" href="<?php echo_uri("id_proof"); ?>" data-target="#id_proof-tab"><?php echo lang('id_proof'); ?></a></li>
                    <li><a role="presentation" href="<?php echo_uri("address_proof"); ?>" data-target="#address_proof-tab"><?php echo lang('address_proof'); ?></a></li>
                     <!-- R.V1_03E-->
					 <!--R.V03_03_21S-->
                     <li><a role="presentation" href="<?php echo_uri("purchase_status"); ?>" data-target="#purchase_status-tab"><?php echo lang('purchase_status'); ?></a></li>
                     <li><a role="presentation" href="<?php echo_uri("sale_status"); ?>" data-target="#sale_status-tab"><?php echo lang('sale_status'); ?></a></li>
                     <li><a role="presentation" href="<?php echo_uri("payment_status"); ?>" data-target="#payment_status-tab"><?php echo lang('payment_status'); ?></a></li>
<!--R.V03_03_21E-->
<li><a role="presentation" href="<?php echo_uri("other_stage"); ?>" data-target="#other-stage-tab"><?php echo lang('stage'); ?></a></li>

                  <!--R.V16_04_21S--><li><a role="presentation" href="<?php echo_uri("insurance_company"); ?>" data-target="#inc-company-tab"><?php echo lang('Inc_company'); ?></a></li>
                  
                  <li><a role="presentation" href="<?php echo_uri("petrol_bunk"); ?>" data-target="#petrol-bunk-tab"><?php echo lang('petrol_bunk'); ?></a></li>
                   <!--R.V16_04_21S-->


                    <div class="tab-title clearfix no-border">
                        <div class="title-button-group">
                            <?php echo modal_anchor(get_uri("other_settings/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('other_settings'), array("class" => "btn btn-default", "title" => lang('other_settings'), "id" => "other-settings-add-btn")); ?>
                        </div>
                    </div>
                </ul>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane fade" id="other-district-tab">
                        <div class="table-responsive">
                            <table id="other-district-table" class="display no-thead b-t b-b-only no-hover" cellspacing="0" width="100%">         
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="other-area-tab"></div>

                    
                    <div role="tabpanel" class="tab-pane fade" id="other-road-tab"></div>
<!--R.V Start 26_02-->
                    <div role="tabpanel" class="tab-pane fade" id="tds-tab"></div>
<!--R.V End 26_02-->
<!--R.V Start 01_03-->
<div role="tabpanel" class="tab-pane fade" id="id_proof-tab"></div>
<div role="tabpanel" class="tab-pane fade" id="address_proof-tab"></div>
<!--R.V End 01_03-->
<div role="tabpanel" class="tab-pane fade" id="purchase_status-tab"></div>
<div role="tabpanel" class="tab-pane fade" id="sale_status-tab"></div>
<div role="tabpanel" class="tab-pane fade" id="payment_status-tab"></div>
<div role="tabpanel" class="tab-pane fade" id="other-stage-tab"></div>
<!--R.V End 03_03_2021-->

<!--R.v17_04-->
<div role="tabpanel" class="tab-pane fade" id="inc-company-tab"></div>
<div role="tabpanel" class="tab-pane fade" id="petrol-bunk-tab"></div>
<!--R.v17_04-->

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
            source: '<?php echo_uri("other_settings/list_data") ?>',
            order: [[0, "asc"]],
            hideTools: true,
            displayLength: 100,
            columns: [
                {visible: false},
                {title: '<?php echo lang("title"); ?>'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            onInitComplete: function () {
                //apply sortable
                $("#other-district-table").find("tbody").attr("id", "custom-field-table-sortable");
                var $selector = $("#custom-field-table-sortable");

                Sortable.create($selector[0], {
                    animation: 150,
                    chosenClass: "sortable-chosen",
                    ghostClass: "sortable-ghost",
                    onUpdate: function (e) {
                        appLoader.show();
                        //prepare sort indexes 
                        var data = "";
                        $.each($selector.find(".field-row"), function (index, ele) {
                            if (data) {
                                data += ",";
                            }

                            data += $(ele).attr("data-id") + "-" + index;
                        });

                        //update sort indexes
                        $.ajax({
                            url: '<?php echo_uri("other_settings/update_field_sort_values") ?>',
                            type: "POST",
                            data: {sort_values: data},
                            success: function () {
                                appLoader.hide();
                            }
                        });
                    }
                });

            }

        });


        //change the add button attributes on changing tab panel
        var addButton = $("#other-settings-add-btn");

        $(".nav-tabs li").click(function () {
            var activeField = $(this).find("a").attr("data-target");

            //lead status
            if (activeField === "#other-district-tab") {
                addButton.attr("title", "<?php echo lang("other_district"); ?>");
                addButton.attr("data-title", "<?php echo lang("other_district"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("other_settings/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang('other_district'); ?>");
            } else if (activeField === "#other-area-tab") {
                addButton.attr("title", "<?php echo lang("other_area"); ?>");
                addButton.attr("data-title", "<?php echo lang("other_area"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("other_area/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang('other_area'); ?>");
            }else if (activeField === "#other-road-tab") {
                addButton.attr("title", "<?php echo lang("other_road"); ?>");
                addButton.attr("data-title", "<?php echo lang("other_road"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("other_road/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang('other_road'); ?>");
            }
//R.V Start 26_02 Start
            else if (activeField === "#tds-tab") {
                addButton.attr("title", "<?php echo 'TDS'; ?>");
                addButton.attr("data-title", "<?php echo 'TDS'; ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("tds/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . "TDS"; ?>");
            }

 //R.V Start 26_02 End   

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

//R.v17_04_s
            else if (activeField === "#inc-company-tab") {
                addButton.attr("title", "<?php echo lang("Inc_company"); ?>");
                addButton.attr("data-title", "<?php echo lang("Inc_company"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("insurance_company/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang("Inc_company"); ?>");
            }    
//R.v17_04_e
 
//R.v17_04_s
else if (activeField === "#petrol-bunk-tab") {
                addButton.attr("title", "<?php echo lang("petrol_bunk"); ?>");
                addButton.attr("data-title", "<?php echo lang("petrol_bunk"); ?>");
                addButton.attr("data-action-url", "<?php echo get_uri("petrol_bunk/modal_form"); ?>");

                addButton.html("<?php echo "<i class='fa fa-plus-circle'></i> " . lang("petrol_bunk"); ?>");
            }    
//R.v17_04_e

        });

        
    });
</script>