<style>
#search{
    min-height: 50px;
    border: 1px solid #2c3e50;
}
</style>
<div class="p20 panel panel-default">
    <?php
        if($success){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong> DC Outward data updated successfully.
      </div>

      <?php
        }
        ?>

     <div class="page-title clearfix">
        <h4>DC Outward - Edit</h4>
        <div class="title-button-group">
            <a href="<?php echo_uri("production_dc_outward") ?>">
                    <button class="btn btn-md btn-default"><?php echo lang('dc_outward_list'); ?></button>
            </a>
        </div>
    </div>
    <br />
    <?php echo form_open(get_uri("production_dc_outward/update"), array("id" => "purchase-form", "class" => "general-form", "role" => "form")); ?>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="title" ><?php echo lang('dc_type'); ?></label>
                <select id="dc-type" name="dc_type" class="form-control" required>   
                    <option value="">Select DC Type</option>
                    <option <?php echo ($model_data->dc_type == 1) ? ' selected' : ''; ?> value="1">Transfer</option>
                    <option <?php echo ($model_data->dc_type == 2) ? ' selected' : ''; ?> value="2">Returnable</option>
                    <option <?php echo ($model_data->dc_type == 3) ? ' selected' : ''; ?> value="3">GRN</option>                                  
                </select>
            </div>
        </div>

        <input type="hidden" name="dc_outward_id" value="<?= $model_data->id; ?>"/>
        <input type="hidden" name="hidden_from_warehouse" value="<?= $model_data->from_warehouse; ?>"/>
        <input type="hidden" name="hidden_to_warehouse" value="<?= $model_data->to_warehouse; ?>"/>
        <input type="hidden" name="hidden_dc_type" value="<?= $model_data->dc_type; ?>"/>

        <div class="col-md-3">
            <div class="form-group">
                <label for="discount"><?php echo lang('dc_no'); ?></label>
                   <input type="text" name="dc_no" class="form-control" value="<?= $model_data->dc_no; ?>"/>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="dc_date"><?php echo lang('dc_date'); ?></label>
                <input type="date" name="dc_date" value="<?= $model_data->dc_date; ?>" class="form-control"/>
            </div>           
        </div>

        <div class="col-md-3" id="show_work_order">
            <div class="form-group">
                <label for="work_order_no" ><?php echo lang('work_order_number'); ?></label>
                <input value="<?= $model_data->work_order_no; ?>" type="text" id="work-order-no" name="work_order_no" class="form-control"/>
            </div>
        </div>

        <div class="col-md-3" id="show_work_order_date">
            <div class="form-group">
                <label for="work_order_date" ><?php echo lang('work_order_date'); ?></label>
                <input type="date" id="work-order-date" name="work_order_date" class="form-control" value="<?= $model_data->work_order_date; ?>">
            </div>
        </div>

        <div class="col-md-3" id="show_purchase_number">
            <div class="form-group">
                <label for="work_order_no" >Purchase Number</label>
                <input value="<?= $model_data->purchase_no; ?>" id="purchase-no" type="text" name="purchase_no" class="form-control"/>
            </div>
        </div>

        <div class="col-md-3" id="show_purchase_date">
            <div class="form-group">
                <label for="work_order_no" >Purchase Date</label>
                <input id="purchase-date" type="date" name="purchase_date" class="form-control" value="<?= $model_data->purchase_date; ?>"/>
            </div>
        </div>

        <div class="col-md-3" id="show_sale_order_number">
            <div class="form-group">
                <label for="sale_order_number" ><?php echo lang('sales_order_number'); ?></label>
                <input type="text" id="sale-order-number" name="sale_order_number" class="form-control" value="<?= $model_data->sale_order_number; ?>"/>
            </div>
        </div>

        <div class="col-md-3" id="show_from_warehouse">
            <div class="form-group">
                <label for="title" ><?php echo lang('from'); ?></label>
                <select id="from-warehouse" name="from_warehouse" class="form-control">   
                    <option value="" >Select Warehouse</option> 
                    <?php foreach($warehouse_all as $wh){?>
                    <option
                    
                    <?php echo ($wh->id == $model_data->from_warehouse) ? ' selected' : ''; ?>
                    
                     value="<?php echo $wh->id; ?>"><?php echo $wh->name; ?> </option>
                    <?php }  ?>                                                    
                </select>
            </div>
        </div>

        <div class="col-md-3" id="show_to_warehouse">
            <div class="form-group">
                <label for="title" ><?php echo lang('to'); ?></label>
                <select id="to-warehouse" name="to_warehouse" class="form-control">   
                    <option value="" >Select Warehouse</option> 
                    <?php foreach($warehouse_all as $wh1){?>
                    <option
                    
                    <?php echo ($wh1->id == $model_data->to_warehouse) ? ' selected' : ''; ?>
                    
                     value="<?php echo $wh1->id; ?>"><?php echo $wh1->name; ?> </option>
                    <?php }  ?>                                                    
                </select>
            </div>
        </div>


        <div class="col-md-3" id="show_shop_keeper_name">
            <div class="form-group">
                <label for="title" ><?php echo 'Shop Keeper Name'; ?></label>
                    <select id="shop-keeper-name" name="shop_keeper_name" class="form-control">   
                        <option value="" >Select</option> 
                        <?php foreach($user_all as $sk){?>
                        <option
                        
                        <?php echo ($sk->id == $model_data->shop_keeper_name) ? ' selected' : ''; ?>

                         value="<?php echo $sk->id; ?>"><?php echo $sk->first_name.' '.$sk->last_name; ?> </option>
                        <?php }  ?>                                                    
                    </select>
            </div>
        </div>

        <div class="col-md-3" id="show_process_incharge">
            <div class="form-group">
                <label for="process_incharge" ><?php echo 'Process Incharge'; ?></label>
                <select id="process-incharge" name="process_incharge" class="form-control">   
                    <option value="" >Select</option> 
                    <?php foreach($user_all as $pi){?>
                    <option
                    
                    <?php echo ($pi->id == $model_data->process_incharge) ? ' selected' : ''; ?>
                    
                     value="<?php echo $pi->id; ?>"><?php echo $pi->first_name.' '.$wh->last_name; ?> </option>
                    <?php }  ?>                                                    
                </select>
            </div>
        </div>

        <div class="col-md-3" id="show_receiver_name">
            <div class="form-group">
                <label for="sale_order_number" >Receiver Name</label>
                <input id="receiver-name" type="text" name="reciever_name" class="form-control" value="<?= $model_data->reciever_name; ?>"/>
            </div>
        </div>

        <div class="col-md-3" id="show_customer_name">
            <div class="form-group">
                <label for="title" >Customer Name</label>
                <select id="customer-name" name="customer_name" class="form-control">   
                    <option value="" >Select</option> 
                    <?php foreach($clients_all as $cn){?>
                    <option
                    
                    <?php echo ($cn->id == $model_data->customer_name) ? ' selected' : ''; ?>
                    
                     value="<?php echo $cn->id; ?>"><?php echo $cn->company_name; ?> </option>
                    <?php }  ?>                                                    
                </select>
            </div>
        </div>

        <div class="col-md-3" id="show_vendor_name">
            <div class="form-group">
                <label for="title" >vendor</label>
                <select id="vendor-name" name="vendor" class="form-control">   
                    <option value="" >Select</option> 
                    <?php foreach($supplier_all as $v){?>
                    <option
                    
                    <?php echo ($v->id == $model_data->vendor) ? ' selected' : ''; ?>
                    
                     value="<?php echo $v->id; ?>"><?php echo $v->name; ?> </option>
                    <?php }  ?>                                                    
                </select>
            </div>
        </div>

        <div class="col-md-3" id="show_delivery_type">
            <div class="form-group">
                <label for="delivery_type" >Delivery Type</label>
                <select id="delivery-type" name="delivery_type" class="form-control">   
                    <option value="" >Select</option> 
                    <option <?php echo ($model_data->delivery_type == 1) ? ' selected' : ''; ?> value="1">Courier</option>
                    <option <?php echo ($model_data->delivery_type == 2) ? ' selected' : ''; ?> value="2">Parcel</option>  
                    <option <?php echo ($model_data->delivery_type == 3) ? ' selected' : ''; ?> value="3">Direct</option>                                         
                </select>
            </div>
        </div>

        <div class="col-md-3" id="show_reference_number">
            <div class="form-group">
                <label for="reference_no" >Reference No.</label>
                <input id="reference-number" type="text" name="reference_no" class="form-control" value="<?= $model_data->reference_no; ?>"/>
            </div>
        </div>

        <div class="col-md-3" id="show_reference">
            <div class="form-group">
                <label for="reference" >Reference</label>
                <input id="reference" type="text" name="reference" class="form-control" value="<?= $model_data->reference; ?>"/>
            </div>
        </div>

        <div class="col-md-3" id="show_vehicle_number">
            <div class="form-group">
                <label for="vehicle_no" >Vehicle No</label>
                <input id="vehicle-number" type="text" name="vehicle_no" class="form-control" value="<?= $model_data->vehicle_no; ?>"/>
            </div>
        </div>

        <div class="col-md-3" id="show_vehicle_name">
            <div class="form-group">
                <label for="vehicle_name" >Vehicle Name</label>
                <input id="vehicle-name" type="text" name="vehicle_name" class="form-control" value="<?= $model_data->vehicle_name; ?>"/>
            </div>
        </div>

    </div>

    <br />
    <br />
         
    <div class="row">                   
        <div class="col-md-12">    
            <div class="form-group">
                <input type="text" id="search" name="search" class="form-control"  placeholder="Search product with product code or name"/>
                <div id="product-list"></div>
            </div>
        </div>

        <div class="col-md-12"> 
            <div class="table-responsive">
                <table id="myTable" class="table table-hover order-list" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th align="right">Quantity</th>
                            <th align="left">Unit</th>
                            <th><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody id="order-table">
                    <?php
                        foreach($model_detail as $md){
                            $product_data = $this->Products_model->get_one($md->product_id);
                            $product_name = $product_data->name;
                            $product_code = $product_data->code;
                            $product_unit = $product_data->unit_id;

                            $unit_data    = $this->Unit_model->get_one($product_unit);
                            $unit_name    = $unit_data->name;

                            ?>
                            <tr>
                                <td><?= $product_name; ?></td>
                                <td class="<?= $product_code; ?>"><?= $product_code; ?></td>
                                <td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="<?= $md->qty; ?>"/></td>
                                <td class="unit-name"><?= $unit_name; ?></td>
                                <td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i><input type="hidden" name="code[]" value="<?= $product_code; ?>"/><input type="hidden" name="id[]" value="<?= $md->product_id; ?>"/><input type="hidden" name="product_cost[]" value="<?= $product_data->cost; ?>"/>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12">          
            <input type="submit" value="Submit" name="submit" class="btn btn-md btn-primary"/> 
        </div>    
           
    </div>
            
    <?php echo form_close(); ?>                          
</div>
        
<script type="text/javascript">

    hide_all_fields();
    var dcType   = <?php echo $model_data->dc_type; ?>;
    $('#dc-type').val(dcType);

    if(dcType == 1){
        show_transfer_fields();
    }else if(dcType == 2){
        show_returnable_dc_fields();
    }else if(dcType == 3){
        show_grn_fields();
    }else{
        hide_all_fields();
    }

    $(document).on('change', '#dc-type', function()
    {
        hide_all_fields();
        dcType = $(this).val();
        if(dcType == 1){
            show_transfer_fields();
        }else if(dcType == 2){
            show_returnable_dc_fields();
        }else if(dcType == 3){
            show_grn_fields();
        }else{
            hide_all_fields();
        }
    });

    $(document).on('keyup', '#search', function(){
        var searchContent = $(this).val();
        if(searchContent.length != 0){
            $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>index.php/production_dc_outward/search/'+searchContent,
            dataType: 'json',
            success: function(data) 
            {
                $('#product-list').empty();
                if(data.length > 0)
                {
                    $.each(data, function (index, value) 
                    {
                        var namex = data[index].name;
                        var namep = namex.replace(/"/g, '');
                        $('#product-list').append('<option data-name="'+namep+'" data-code='+data[index].code+' data-id="'+data[index].id+'" data-cost='+data[index].cost+' data-unit='+data[index].unit_id+' value="'+data[index].code+'" class="form-control selected" style="width: 80%">'+data[index].name+' ( '+data[index].code+' )</option>');
                    }); 
                }
                else
                {
                    $('#product-list').append('<option class="form-control" style="width: 80%">No Product Found</option>');
                }
                                     
            }                   
        });
        }
        else
        {
            $('#product-list').empty();
        }
    });

    $(document).on('click', '.selected', function(){
        var name = $(this).data('name');
        var code = $(this).data('code');
        var id   = $(this).data('id');
        var indexv = $('#order-table').find('.'+code).index();
        if(indexv == 1){
            var closestTr = $('#order-table').find('.'+code).closest("tr").index();
            var qtychange = $('#order-table tr:eq(' + closestTr + ')').find('.qtychange').val();
            qtychange = parseFloat(qtychange);
            qtychange += 1.00;

            $('#order-table tr:eq(' + closestTr + ')').find('.qtychange').val(qtychange);
            var cost = $('#order-table tr:eq(' + closestTr + ')').find('.cost').text();
            cost = parseFloat(cost);
            var subTotal = parseFloat(cost * qtychange);   
            subtotal = subTotal.toFixed(2);
            $('#order-table tr:eq(' + closestTr + ')').find('.subtotal').text(subtotal);
        }
        else
        {
            var cost = $(this).data('cost');
            var unit = $(this).data('unit');
            var discount = 0;
            var tax = 0;
            var subtotal = cost;
            var qty = 1;
            var orderlist = '<tr>';
            orderlist += '<td>'+name+'</td>';
            orderlist += '<td class="'+code+'">'+code+'</td>';
            orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="1.00"/></td>';
            orderlist += '<td class="unit-name"></td>';
            orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
            orderlist += '<input type="hidden" name="code[]" value="'+code+'"/>';
            orderlist += '<input type="hidden" name="id[]" value="'+id+'"/>';
            orderlist += '<input type="hidden" name="product_cost[]" value="'+cost+'"/>';
            orderlist += '</td>'
            orderlist += '</tr>';

            $('#order-table').append(orderlist);
            getUnitName(unit);
        }
        
        $('#product-list').empty();
        $('#search').val('');
    });


    $(document).on('keyup', '.qtychange', function(){
        var row_index = $(this).closest("tr").index();
        var cost = $('#order-table tr:eq(' + row_index + ')').find('.cost').text();
        cost = parseFloat(cost);
        var qty  = $('#order-table tr:eq(' + row_index + ')').find('.qtychange').val();
        qty = parseFloat(qty);
        var subTotal = parseFloat(cost * qty);   
        subtotal = subTotal.toFixed(2);

        $('#order-table tr:eq(' + row_index + ')').find('.subtotal').text(subtotal);
    });

    $(document).on('click', '.deletethis', function(){
        $(this).parents('tr').first().remove();
    });

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });

    function getUnitName(unit){
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>index.php/bomcreation/get_unit_name/'+unit,
            dataType: 'json',
            success: function(data) 
            {
                $('#myTable tr:last').find('.unit-name').text(data.name);                  
            }                   
        });
    }

    function hide_all_fields(){
        make_all_fields_not_required();
        $('#show_work_order').hide();
        $('#show_purchase_number').hide();
        $('#show_purchase_date').hide();
        $('#show_work_order_date').hide();
        $('#show_sale_order_number').hide();
        $('#show_from_warehouse').hide();
        $('#show_to_warehouse').hide();
        $('#show_process_incharge').hide();
        $('#show_receiver_name').hide();
        $('#show_customer_name').hide();
        $('#show_vendor_name').hide();
        $('#show_delivery_type').hide();
        $('#show_reference_number').hide();
        $('#show_reference').hide();
        $('#show_vehicle_number').hide();
        $('#show_vehicle_name').hide();
        $('#show_shop_keeper_name').hide();
    }

    function show_transfer_fields(){
        $('#show_work_order').show();
        $('#work-order-no').prop('required', true);
        $('#show_work_order_date').show();
        $('#work-order-date').prop('required', true);
        $('#show_sale_order_number').show();
        $('#sale-order-number').prop('required', true);
        $('#show_from_warehouse').show();
        $('#from-warehouse').prop('required', true);
        $('#show_to_warehouse').show();
        $('#to-warehouse').prop('required', true);
        $('#show_process_incharge').show();
        $('#process-incharge').prop('required', true);
        $('#show_receiver_name').show();
        $('#receiver-name').prop('required', true);
        $('#show_customer_name').show();
        $('#customer-name').prop('required', true);
        $('#show_vendor_name').show();
        $('#vendor-name').prop('required', true);
        $('#show_delivery_type').show();
        $('#delivery-type').prop('required', true);
        $('#show_reference_number').show();
        $('#reference-number').prop('required', true);
        $('#show_reference').show();
        $('#reference').prop('required', true);
        $('#show_vehicle_number').show();
        $('#vehicle-number').prop('required', true);
        $('#show_vehicle_name').show();
        $('#vehicle-name').prop('required', true);
        $('#show_shop_keeper_name').show();
        $('#shop-keeper-name').prop('required', true);
    }

    function show_returnable_dc_fields(){    
        $('#show_from_warehouse').show();
        $('#from-warehouse').prop('required', true);
        $('#show_shop_keeper_name').show();
        $('#shop-keeper-name').prop('required', true);
        $('#show_receiver_name').show();
        $('#receiver-name').prop('required', true);
        $('#show_vendor_name').show();
        $('#vendor-name').prop('required', true);
        $('#show_delivery_type').show();
        $('#delivery-type').prop('required', true);
        $('#show_reference').show();
        $('#reference').prop('required', true);
        $('#show_vehicle_number').show();
        $('#vehicle-number').prop('required', true);
        $('#show_vehicle_name').show();
        $('#vehicle-name').prop('required', true);     
    }

    function show_grn_fields(){
        $('#show_work_order').show();
        $('#show_purchase_number').show();
        $('#purchase-no').prop('required', true);
        $('#show_purchase_date').show();
        $('#purchase-date').prop('required', true);
        $('#show_to_warehouse').show();
        $('#to-warehouse').prop('required', true);
        $('#show_shop_keeper_name').show();
        $('#shop-keeper-name').prop('required', true);
        $('#show_customer_name').show();
        $('#customer-name').prop('required', true);
        $('#show_vendor_name').show();
        $('#vendor-name').prop('required', true);
        $('#show_delivery_type').show();
        $('#delivery-type').prop('required', true);
        $('#show_reference').show();
        $('#reference').prop('required', true);        
        $('#show_vehicle_number').show();
        $('#vehicle-number').prop('required', true);
        $('#show_vehicle_name').show();
        $('#vehicle-name').prop('required', true);
    }

    function make_all_fields_not_required(){
        $('#work-order-no').prop('required', false);
        $('#work-order-date').prop('required', false);
        $('#sale-order-number').prop('required', false);
        $('#from-warehouse').prop('required', false);
        $('#to-warehouse').prop('required', false);
        $('#process-incharge').prop('required', false);
        $('#receiver-name').prop('required', false);
        $('#customer-name').prop('required', false);
        $('#vendor-name').prop('required', false);
        $('#delivery-type').prop('required', false);
        $('#reference-number').prop('required', false);
        $('#reference').prop('required', false);
        $('#vehicle-number').prop('required', false);
        $('#vehicle-name').prop('required', false);
        $('#shop-keeper-name').prop('required', false);
        $('#purchase-no').prop('required', false);
        $('#purchase-date').prop('required', false);
    }

</script>