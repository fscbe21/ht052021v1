<!-- AG2103Q INITIAL CREATION -->

<div id="page-content" class="p20 clearfix">
    <div class="p-1">
    <?php
        if($success){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong>&nbsp;<?php echo lang('work_order');?> updated successfully.
      </div>

      <?php
        }
        ?>
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Edit Work Order</h4>
                    <div class="title-button-group">
                    <a href="<?php echo_uri("work_order") ?>">
                            <button class="btn btn-md btn-default"><?php echo lang('work_order').' List';?></button>
                    </a>
                    </div>
                </div>
                <br />
                <?php echo form_open(get_uri("work_order/save"), array("id" => "add-work-order-form", "class" => "general-form", "role" => "form")); ?>
                    <input type="hidden" name="work_order_id" value="<?= $work_order_data->id; ?>">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class="col-md-3"><?php echo lang('date');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class="col-md-9">

                                 <input type="date" id="add_work_order_date"  name="date" class="form-control" value="<?= $work_order_data->date?>" required/>   
                                                              
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('sales_order_number');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9"> 

                                 <input type="text" id="sale-order-search" name="sales_order_number" class="form-control" value="<?= $work_order_data->sales_order_number; ?>" required> 

                                    <div id="sales_order"></div> 

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
                echo form_dropdown("customer_id", $clients_dropdown, array($work_order_data->	customer_id), "class='select2 form-control validate-hidden' data-rule-required='true', data-msg-required='" . lang('field_required') . "'");
                ?>
            </div>
            </div>
        </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('start_date');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">

                                 <input type="date" id="start_date"  name="start_date" class="form-control" required value="<?php echo $work_order_data->start_date; ?>">   
                                                              
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('end_date');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">

                                 <input type="date" id="end_date"  name="end_date" class="form-control" value="<?= $work_order_data->end_date; ?>" required>   
                                                              
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('duration');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                 <input type="text"  name="duration"  id="duration" class="form-control" required>                      
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
                                    <option <?php echo ($work_order_data->department == "gas_cutting") ? ' selected': ''; ?> value="gas_cutting">Gas Cutting</option>
                                    <option <?php echo ($work_order_data->department == "laser_cutting") ? ' selected': ''; ?> value="laser_cutting">Laser Cutting</option>
                                    <option <?php echo ($work_order_data->department == "fabrication") ? ' selected': ''; ?>value="fabrication">Fabrication</option>
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
                                    <option <?php echo ($work_order_data->order_type == "work_order") ? ' selected': ''; ?> value="work_order">Sale Order</option>
                                    <option <?php echo ($work_order_data->order_type == "job_order") ? ' selected': ''; ?> value="job_order">Job Order</option>
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
                                    <input type="text" name="notes" class="form-control" placeholder="Enter Notes" value="<?= $work_order_data->notes; ?>">                              
                                </div>
                            </div>
                        </div>

                    </div>

                <div class="pl-2 container">
                    <div class="form-group">
                        <input type="text" id="search" name="search" class="form-control" style="width: 80%; height: 50px" placeholder="Search semi goods and finished goods"/>
                        <div id="product-list"></div>
                    </div>
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
                                <th><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody id="order-table" style="font-weight: 900;">
                        <?php
                        foreach($work_order_detail as $detail){
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
                                    <td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i><input type="hidden" name="code[]" value="<?= $product_code; ?>"/><input type="hidden" name="id[]" value="<?= $product_id; ?>"/><input type="hidden" name="unit[]" value="<?= $product_data->purchase_unit_id; ?>"/>
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
              <br />
              <div class="container p-2">
                 <input type="submit" value="Submit" name="submit" class="btn btn-md btn-primary"/> 
             </div><br />
             <br />
              <?php echo form_close(); ?>                          
            </div>
        </div>
    </div>
</div>

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
    $(document).on('click', '.selected', function(){
        var name = $(this).data('name');
        var code = $(this).data('code');
        var id   = $(this).data('id');
        var indexv = $('#order-table').find('.'+code).index();
        
        if(indexv == 1){

        }
        else
        {
            var cost = $(this).data('cost');
            var unit = $(this).data('unit');
            var unitName = getUnitName(unit);
            var discount = 0;
            var tax = 0;
            var subtotal = cost;
            var qty = 1;
            var orderlist = '<tr>';
            orderlist += '<td>'+name+'</td>';
            orderlist += '<td class="'+code+'">'+code+'</td>';
            orderlist += '<td class="unit-name"></td>';
            orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="1"/></td>';
            orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control cost" type="number" name="cost[]" value="'+cost+'"/></td>';
            orderlist += '<td class="subtotal">'+cost+'</td>';
            orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
            orderlist += '<input type="hidden" name="code[]" value="'+code+'"/>';
            orderlist += '<input type="hidden" name="id[]" value="'+id+'"/>';
            orderlist += '<input type="hidden" name="unit[]" value="'+unit+'"/>';
            orderlist += '</td>'
            orderlist += '</tr>';

            $('#order-table').append(orderlist);
        }
        
        $('#product-list').empty();
        $('#search').val('');
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
            url: '<?= base_url(); ?>index.php/work_order/get_unit_name/'+unit,
            dataType: 'json',
            success: function(data) 
            {
                $('#myTable tr:last').find('.unit-name').text(data.name);                  
            }                   
        });
    }

    $(document).on('keyup', '#search', function(){
        $('#product-list').empty();
        
        var typeSelect = $(this).val();
        if(typeSelect.length != 0){
            $.ajax({
            type: 'GET',
            url: '<?= base_url(); ?>index.php/work_order/search_end_product/'+typeSelect,
            dataType: 'json',
            success: function(data) 
            {
                $('#product-list').empty();
                if(data.length > 0)
                {
                    $.each(data, function (index, value) 
                    {
                        $('#product-list').append('<option data-name="'+data[index].name+'" data-code='+data[index].code+' data-id="'+data[index].id+'" data-cost='+data[index].cost+' data-unit='+data[index].unit_id+' value="'+data[index].code+'" class="form-control selected" style="width: 80%">'+data[index].name+' ( '+data[index].code+' )</option>');
                    });
                }
                else
                {
                    $('#product-list').append('<option class="form-control" style="width: 80%">No End Product Found</option>');
                }
                                     
            }                   
        });
        }
        else
        {
            $('#product-list').empty();
        }

        
    });

    $(document).on('click','.selectendproduct', function(){
        var endproname = $(this).data('name');
        var endproid = $(this).data('id');

        $('#end-product-id').val(endproname);
        $('#bom-product-type').val(endproid);
        $('#end-product-list').empty();
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
    });

    $(document).on('keyup', '#sale-order-search', function(){
        var saleOrderSearch = $(this).val();

        if(saleOrderSearch.length != 0){
            $.ajax({
            type: 'GET',
            url: '<?= base_url(); ?>index.php/work_order/search_sale_order/'+saleOrderSearch,
            dataType: 'json',
            success: function(data)
            {
                $('#sales_order').empty();
                if(data.length > 0)
                {
                    $.each(data, function (index, value) 
                    {
                        $('#sales_order').append('<option data-customerid="'+data[index].customer_id+'" data-ordertype="'+data[index].order_type+'" data-id="'+data[index].id+'" value="'+data[index].id+'" class="form-control selected-from-sales-order" style="width: 100%">'+data[index].id+' ( '+data[index].reference_no+' )</option>');
                    });
                }
                else
                {
                    $('#sales_order').append('<option class="form-control" style="width: 100%">No Sales Order Found</option>');
                }                 
            }                   
        });
        }
        else
        {
            $('#sales_order').empty();
        }

    });

    $(document).on('click', '.selected-from-sales-order', function(){
        var salesOrderId     =  $(this).data('id');
        var orderType        =  $(this).data('ordertype');
        $('#order-type').val(orderType);
        $('#order-table').empty();  
        $.ajax({
        type: 'GET',
        url: '<?= base_url(); ?>index.php/work_order/add_sale_order_products/'+salesOrderId,
        dataType: 'json',
            success: function(data)
            {
                $('#product-list').empty();
                if(data.length > 0)
                {
                    $.each(data, function (index, value) 
                    {
                        var orderlist = '<tr>';
                        orderlist += '<td>'+data[index].name+'</td>';
                        orderlist += '<td class="'+data[index].code+'">'+data[index].code+'</td>';
                        orderlist += '<td class="unit-name">'+data[index].unit_name+'</td>';
                        orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="'+data[index].qty+'"/></td>';
                        orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control cost" type="number" name="cost[]" value="'+data[index].unit_price+'"/></td>';
                        orderlist += '<td class="subtotal">'+data[index].total+'</td>';
                        orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
                        orderlist += '<input type="hidden" name="code[]" value="'+data[index].code+'"/>';
                        orderlist += '<input type="hidden" name="id[]" value="'+data[index].id+'"/>';
                        orderlist += '<input type="hidden" name="unit[]" value="'+data[index].unit+'"/>';
                        orderlist += '</td>'
                        orderlist += '</tr>';

                        $('#order-table').append(orderlist);
                    });
                }                     
            }                   
        });

        $('#sales_order').empty();
        $('#sale-order-search').val('');
        $('#sale-order-search').val(salesOrderId);
    });

</script>