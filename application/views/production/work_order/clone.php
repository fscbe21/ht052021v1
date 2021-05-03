<!-- AG2103Q INITIAL CREATION -->
<?php echo form_open(get_uri("work_order/saveclone"), array("id" => "add-work-order-form", "class" => "general-form", "role" => "form")); ?>

<div id="page-content" class="p20 clearfix">
    <div class="p-1">
    <?php
        if($success){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong>&nbsp;<?php echo lang('work_order');?> clonned successfully.
      </div>

      <?php
        }
        ?>
 <br />
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Clone Work Order</h4>
                    <div class="title-button-group">
                    <a href="<?php echo_uri("work_order") ?>">
                            <button type="button" class="btn btn-md btn-default"><?php echo lang('work_order').' List';?></button>
                    </a>
                    </div>
                </div>
                <br />
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class="col-md-3"><?php echo lang('date');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class="col-md-9">

                                 <input type="date" id="add_work_order_date"  name="date" class="form-control" value="<?= date('Y-m-d')?>" required/>   
                                                              
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('sales_order_number');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9"> 

                                 <input type="text" name="sales_order_number" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-5">
                        <div class="form-group">

                            <label for="title" class=" col-md-3">Reference</label>

                            <div class="<?php echo $field_column; ?>">
                                <div class="col-md-9">
                                    <input type="text" name="reference" class="form-control" value="New">                              
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-5" id="customer">
                    <div class="form-group">
                        <label for="client_id" class=" col-md-3"><?php echo lang('client'); ?></label>
                        <div class="col-md-9">
                            <?php
                            echo form_dropdown("customer_id", $clients_dropdown, array($info->	customer_id), "class='select2 form-control validate-hidden' data-rule-required='true', data-msg-required='" . lang('field_required') . "'");
                            ?>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('start_date');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">

                                 <input type="date" id="start_date"  name="start_date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">   
                                                              
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('end_date');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">

                                 <input type="date" id="end_date"  name="end_date" class="form-control" required>   
                                                              
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('duration');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                 <input type="text"  name="duration"  id="duration" class="form-control">                      
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">Department</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                <select name="department" class="form-control" required>
                                    <option value="">Select department</option>
                                    <option <?php echo ($info->department == "gas_cutting") ? ' selected': ''; ?> value="gas_cutting">Gas Cutting</option>
                                    <option <?php echo ($info->department == "laser_cutting") ? ' selected': ''; ?> value="laser_cutting">Laser Cutting</option>
                                    <option <?php echo ($info->department == "fabrication") ? ' selected': ''; ?>value="fabrication">Fabrication</option>
                                 </select>                     
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">Order Type</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                <select name="order_type" class="form-control" required>
                                    <option value="">Select order type</option>
                                    <option <?php echo ($info->order_type == "work_order") ? ' selected': ''; ?> value="work_order">Sale Order</option>
                                    <option <?php echo ($info->order_type == "job_order") ? ' selected': ''; ?> value="job_order">Job Order</option>
                                 </select>                     
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="form-group">

                            <label for="title" class=" col-md-3"><?php echo lang('notes');?></label>

                            <div class="<?php echo $field_column; ?>">
                                <div class="col-md-9">
                                    <input type="text" name="notes" class="form-control" placeholder="Enter Notes" value="<?= $info->notes; ?>">                              
                                </div>
                            </div>
                        </div>

                    </div>

                <div class="pl-2 container">

                <div class="table-responsive mt-3">
                    <table id="myTable" class="table table-hover order-list" style="width: 80%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th align="left">Unit</th>
                                <th align="right">Quantity</th>
                                <th align="left">Unit Price</th>
                                <th align="left">Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="order-table" style="font-weight: 900;">
                        <?php
                        foreach($details as $detail){
                            $product_id  = $detail->product_id;
                            $product_qty = $detail->qty;

                            $product_data= $this->Products_model->get_one($product_id);

                            $unit_data   = $this->Unit_model->get_one($product_data->purchase_unit_id);

                            $product_name= $product_data->name;
                            $unit_name   = $unit_data->name;
                            $product_code= $product_data->code;

                            $product_cost= $detail->cost;
                            $product_total= $detail->total_cost;

                            ?>
                                <tr>
                                    <td><?= $product_name; ?></td>
                                    <td class="code"><?= $product_code; ?></td>
                                    <td class="unit-name"><?= $unit_name; ?></td>
                                    <td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="<?= $product_qty; ?>"/></td>
                                    <td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control cost" type="number" name="cost[]" value="<?= $product_cost; ?>"/></td><td class="subtotal"><?php echo $product_total; ?></td>
                                    <td style="color: red"><input type="hidden" name="code[]" value="<?= $product_code; ?>"/><input type="hidden" class="wo-product-id" name="id[]" value="<?= $product_id; ?>"/><input type="hidden" name="unit[]" value="<?= $product_data->purchase_unit_id; ?>"/>
                                    <input type="hidden" class="old-product-qty" value="<?= $product_qty;?>">
                                    </td>
                                </tr></tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
              </div>
              <br />                             
            </div>
        </div>
    </div>
</div>
<div id="page-content1" class="p20 clearfix">
    <div class="p-1">
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Set Process Details</h4>
                </div>
                <br />                    
                <div class="pl-2 container">

                <div class="table-responsive mt-3">
                    <table class="table table-hover" style="width: 80%">
                        <thead>
                            <tr>
                                <th>End Product Name</th>
                                <th>Process</th>
                                <th align="center">Vendor</th>
                            </tr>
                        </thead>
                        <tbody style="font-weight: 900;">
                        <?php
                        foreach($details as $det){
                            $options = array();
                            $options['work_order_id'] = $old_work_order_id;
                            $options['wo_product_id'] = $det->product_id;
                            $set_process_data = $this->Set_process_model->get_details($options)->result();
                            foreach($set_process_data as $sp){
                                $end_product_id  = $sp->end_product_id;

                                $end_product_data= $this->Products_model->get_one($end_product_id);

                                $end_unit_data   = $this->Unit_model->get_one($end_product_data->purchase_unit_id);

                                $end_product_name= $end_product_data->name;
                                $end_unit_name   = $end_unit_data->name;

                                $process_data    = $this->Process_model->get_one($sp->process_id);

                                ?>
                                    <tr>
                                        <td><?= $end_product_name; ?></td>
                                        <td><?= $process_data->title; ?></td>
                                        <td>
                                            <select class="form-control" name="set_process_vendor_name[]" required>
                                                <option value="">-- Select Vendor --</option>
                                                <?php 
                                                    foreach($supplier_list as $sl){
                                                    ?>
                                                        <option value="<?= $sl->id; ?>"><?= $sl->name; ?></option>
                                                    <?php
                                                    }
                                                ?>
                                            </select>

                                            <input type="hidden" name="set_process_wo_product_id[]" value="<?= $det->product_id; ?>">

                                            <input type="hidden" name="set_process_end_product_id[]" value="<?= $sp->end_product_id; ?>">
                                        
                                        </td>
                                        
                                    </tr></tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
              </div>
              <br />                             
            </div>
        </div>
    </div>
</div>

<div id="page-content2" class="p20 clearfix">
    <div class="p-1">
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Assign BOM Details</h4>
                </div>
                <br />                    
                <div class="pl-2 container">

                <div class="table-responsive mt-3">
                    <table class="table table-hover" style="width: 80%">
                        <thead>
                            <tr>
                                <th>End Product Name</th>
                                <th>BOM Name</th>
                                <th>Raw Material Name</th>
                                <th>Expected Qty</th>
                                <th>Available Qty</th>
                                <th>Total Qty (All Warehouse)</th>
                            </tr>
                        </thead>
                        <tbody style="font-weight: 900;" id="assign-bom-table">
                        <?php
                        foreach($details as $det){
                            $options = array();
                            $options['work_order_id'] = $old_work_order_id;
                            $options['wo_product_id'] = $det->product_id;
                            $assign_bom_data = $this->Assignbom_model->get_details($options)->result();
                            foreach($assign_bom_data as $ab){
                                $end_product_id  = $ab->end_product_id;
                                $bom_id          = $ab->bom_id;
                                $rm_id           = $ab->product_id;
                                $expected_qty    = $ab->qty;

                                $wh_list = "<select name='ab_warehouse_id[]' class='warehouse form-control' style='min-width: 100%' required>";
                                $op = array();
                                $op['product_id'] = $rm_id;
                                $warehouse_data = array();
                                $warehouse_data = $this->Productwarehouse_model->get_details($op)->result();
                                $cnt = 0;

                                $available_qty = 0;

                                if(count($warehouse_data) > 0){
                                    foreach($warehouse_data as $whd){
                                        $available_qty += $whd->qty;
                                    }
                                }

                                foreach($warehouse_data as $wh){
                                    if($wh->qty > 0){
                                        $cnt +=1;
                                        if($cnt == 1){
                                            $wh_list .= "<option value='7'><b> -- Select a Warehouse --</option>";
                                        }

                                        $whdata = array();
                                        
                                        $whdata = $this->Warehouse_model->get_one($wh->warehouse_id);
                                        $wh_list .= "<option "; 
                                        
                                        if($select_warehouse){
                                            $wh_list .= ($select_warehouse == $wh->warehouse_id) ? ' selected': '';
                                        }

                                        $wh_list .= " value='".$wh->warehouse_id."'><b>".$wh->qty."</b>&nbsp;&nbsp;&nbsp;&nbsp;[ ".$whdata->name." ]</option>";
                                    }
                                }

                                if($cnt == 0){
                                    $wh_list .= '<option value="7">Not Available / Inadequate Quantity Found.</option>';
                                }

                                $wh_list .= "</select>";

                                ?>
                                    <tr>
                                        <td><?= get_product_name($end_product_id); ?></td>
                                        <td><?= get_bom_name($bom_id); ?></td>
                                        <td><?= get_product_name($rm_id); ?></td>
                                        <td align="right" class="<?php echo $det->product_id; ?>"><?= $expected_qty; ?></td>
                                        <td style="display: none" class="original-qty <?php echo "FS".$det->product_id; ?>"><?= $expected_qty; ?></td>
                                        <td>
                                            <?= $wh_list; ?>

                                            <input type="hidden" name="ab_wo_product_id[]" value="<?= $det->product_id; ?>">

                                            <input type="hidden" name="ab_bom_id[]" value="<?= $bom_id; ?>">

                                            <input type="hidden" name="ab_end_product_id[]" value="<?= $ab->end_product_id; ?>">

                                            <input type="hidden" name="ab_rm_product_id[]" value="<?= $rm_id; ?>">

                                            <input class="expected-qty" type="hidden" name="ab_expected_qty[]" value="<?= $expected_qty; ?>">

                                        </td>
                                        <td align="right"><?= $available_qty; ?></td>
                                    </tr>
                                <?php
                            }
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
              </div>
              <input type="hidden" name="old_work_order_id" value="<?= $old_work_order_id; ?>">
              <div class="container p-2">
                 <input type="submit" value="Submit" name="submit" class="btn btn-md btn-primary"/> 
             </div><br />                            
            </div>
        </div>
       
    </div>
</div>

<br />
              


<?php echo form_close(); ?>           
<script type="text/javascript">

    var startDate = new Date($('#start_date').val());
    var endDate   = new Date($('#end_date').val());

    if(($('#start_date').val()) && ($('#end_date').val()))
    {
        if(startDate <= endDate)
        {
            var days = (endDate - startDate) / (1000 * 60 * 60 * 24);   
            days += 1;
            if(days == 1){
                days = Math.round(days) + ' Day'
            }else{
                days = Math.round(days) + ' Days'
            }
            
            $('#duration').val(days);
        }
    }

    $("#customer .select2").select2();

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });

    $(document).on('change', '#start_date, #end_date', function(){
        startDate = new Date($('#start_date').val());
        endDate   = new Date($('#end_date').val());

        if(($('#start_date').val()) && ($('#end_date').val()))
        {
            if(startDate <= endDate)
            {
                days = (endDate - startDate) / (1000 * 60 * 60 * 24);   
                days += 1;
                if(days == 1){
                    days = Math.round(days) + ' Day'
                }else{
                    days = Math.round(days) + ' Days'
                }
                
                $('#duration').val(days);
            }
            else
            {
                alert('Invalid start date and end date !');
                $('#start_date').val('');
                $('#end_date').val('');
            }
        }
    });

    $(document).on('keyup', '.cost', function(){
        var row_index = $(this).closest("tr").index();
        cost = $(this).val();
        cost = parseFloat(cost);
        var qty  = $('#order-table tr:eq(' + row_index + ')').find('.qtychange').val();
        qty = parseFloat(qty);
        var subTotal = parseFloat(cost * qty);   
        subtotal = subTotal.toFixed(2);

        $('#order-table tr:eq(' + row_index + ')').find('.subtotal').text(subtotal);
    });

    $(document).on('keyup', '.qtychange', function(){
        row_index = $(this).closest("tr").index();
        cost = $('#order-table tr:eq(' + row_index + ')').find('.cost').val();
        cost = parseFloat(cost);
        var qty  = $(this).val();
        qty = parseFloat(qty);
        subTotal = parseFloat(cost * qty);   
        subtotal = subTotal.toFixed(2);

        $('#order-table tr:eq(' + row_index + ')').find('.subtotal').text(subtotal);

        var woProductId = $('#order-table tr:eq(' + row_index + ')').find('.wo-product-id').val();

        var oldProductQty = $('#order-table tr:eq(' + row_index + ')').find('.old-product-qty').val();

        changeAssignBomDetail(woProductId, oldProductQty, qty);

    });

    function changeAssignBomDetail(woProductId, oldProductQty, qty){    
        var rowCount = $('#assign-bom-table tr').length;
        for (var i = 0; i<rowCount; i++) {
            var valText = $( "#assign-bom-table tr:eq( "+i+" )" ).find('.FS'+woProductId).text();

            valText = parseFloat(valText);
            valText = (valText / oldProductQty) * qty;

            $( "#assign-bom-table tr:eq( "+i+" )" ).find('.'+woProductId).text(valText);
            $( "#assign-bom-table tr:eq( "+i+" )" ).find('.'+woProductId).find('.expected-qty').val(valText);

        }
    }

</script>