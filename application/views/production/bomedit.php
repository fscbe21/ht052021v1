<!-- AG10032021 - INITIAL CREATION -->
<div id="page-content" class="p20 clearfix">
    <div class="p-1">
    <?php
    if($success){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong>&nbsp;Bom updated successfully.
      </div>

      <?php
        }
        ?>
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Edit BOM</h4>
                    <div class="title-button-group">
                    <a href="<?php echo_uri("bomcreation") ?>">
                            <button class="btn btn-md btn-default">BOM List</button>
                    </a>
                    </div>
                </div>
                <br />
                <?php echo form_open(get_uri("bomcreation/updatebom"), array("id" => "bom-update-form", "class" => "general-form", "role" => "form")); ?>
                <div class="container row">
                    <div class="col-md-5">
                        <div class="form-group">
                        <input type="hidden" name="bom_id" value="<?= $bom_data->id; ?>"/>
                            <label for="title" class=" col-md-3">BOM Name *</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                  <input required type="text" id="bom-name" class="form-control" name="bom_name" placeholder="Enter BOM Name"
                                  value="<?= $bom_data->name; ?>"/> 
                                </div>
                            </div>
                            <input type="hidden" id="hidden-bom-name" name="hidden_bom_name" value="<?= $bom_data->name; ?>"/>
                        </div>
                    </div>
                    <input type="hidden" name="bom_product_type" id="bom-product-type" value="<?= $bom_data->end_product; ?>"/>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">End Product Name *</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                <?php
                                    $product_data = $this->Products_model->get_one($bom_data->end_product);
                                    $end_product_name = $product_data->name;
                                ?>
                                 <input type="text" id="end-product-id" name="end_product_id" class="form-control" value="<?= $end_product_name; ?>" required>   
                            <div id="end-product-list">
                            </div>                                       
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <br />
                <br /> <br />
                <div class="pl-2 container">
                    <b>
                    <p>Search and select product</p>
                    </b>
                    
                    <div class="form-group">
                        <input type="text" id="search" name="search" class="form-control" style="width: 80%; height: 50px" placeholder="Search product with product code or name"/>
                        <div id="product-list"></div>
                    </div>
                <b><p>BOM Creation Products*</p></b>
                <div class="table-responsive mt-3">
                    <table id="myTable" class="table table-hover order-list" style="width: 80%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th align="right">Total Quantity</th>
                                <th align="left">Unit</th>
                               <!--  <th>Quantity</th> -->
                                <th>Weight</th>
                                <th>Wastage</th>
                                <th><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody id="order-table" style="font-weight: 900;">
                        <?php
                            $options = array();
                            $options['bom_id'] = $bom_data->id;
                            $bom_detail_data = $this->Bomdetail_model->get_details($options)->result();

                            foreach($bom_detail_data as $bomdetail)
                            {
                                $product_data = $this->Products_model->get_one($bomdetail->product_id);
                                $end_product_name = $product_data->name;
                                $product_code     = $product_data->code;

                                $unit_data = $this->Unit_model->get_one($bomdetail->product_unit);
                                $unit_name = $unit_data->name;
                        ?>
                            <tr>
                                <td><?php echo $end_product_name; ?></td>

                                <td class="<?php echo $product_code; ?>"><?php echo $product_code; ?></td>

                                <td><input style="width: 100px;" readonly class="form-control qtychange" type="text" name="qty[]" value="<?php echo $bomdetail->product_qty; ?>"/></td>

                                <td class="unit-name"><?php echo $unit_name; ?></td>

                                <!-- <td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50"  class="form-control qtychange1 qtychng" type="text" name="quantity[]" value="<?php echo $bomdetail->product_count; ?>"/></td> -->

                                <td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50"  class="form-control qtychange2 qtychng" type="text" name="weight[]" value="<?php echo $bomdetail->product_weight; ?>"/></td>

                                <td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange3 qtychng" type="text" name="wastage[]" value="<?php echo $bomdetail->product_wastage; ?>"/></td>

                                <td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>
                                <input type="hidden" name="code[]" value="<?php echo $product_code; ?>"/>
                                <input type="hidden" name="id[]" value="<?php echo $bomdetail->product_id; ?>"/>
                                <input type="hidden" name="unit[]" value="<?php echo $bomdetail->product_unit; ?>"/>
                                </td>
                            </tr>
                            
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
    var endProductId = $('#bom-product-type').val();
    var rowCount = $('#myTable tr').length - 1;

    $(document).on('change', '#end-product-id', function(){
        endProductId = $(this).val();
        $('#bom-product-type').val(endProductId);
    });

    $(document).on('focus', '#search', function(){
        if(! endProductId){
            window.alert('Please select end product name !');
            $('#end-product-id').focus();
        }
    });

    $(document).on('keyup', '#search', function(){
        var searchContent = $(this).val();
        if(searchContent.length != 0){
            $.ajax({
            type: 'GET',
            url: '../search/'+searchContent+'/'+endProductId,
            dataType: 'json',
            success: function(data) 
            {
                $('#product-list').empty();
                if(data.length > 0)
                {
                    $.each(data, function (index, value) 
                    {
                        var na = data[index].name;
                        na = na.replace(/\"/g, "");
                        $('#product-list').append('<option data-name="'+na+'" data-code="'+data[index].code+'" data-id="'+data[index].id+'" data-cost='+data[index].cost+' data-unit='+data[index].unit_id+' value="'+data[index].code+'" class="form-control selected" style="width: 80%">'+data[index].name+' ( '+data[index].code+' )</option>');
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
            orderlist += '<td><input readonly style="width: 100px;" class="form-control qtychange" type="text" name="qty[]" value="0"/></td>';
            orderlist += '<td class="unit-name"></td>';
            //orderlist += '<td><input style="width: 100px;" class="form-control qtychange1 qtychng" type="text" name="quantity[]" value="0"/></td>';
            orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange2 qtychng" type="text" name="weight[]" value="0.000"/></td>';
            orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange3 qtychng" type="text" name="wastage[]" value="0.000"/></td>';
            orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
            orderlist += '<input type="hidden" name="code[]" value="'+code+'"/>';
            orderlist += '<input type="hidden" name="id[]" value="'+id+'"/>';
            orderlist += '<input type="hidden" name="unit[]" value="'+unit+'"/>';
            orderlist += '</td>'
            orderlist += '</tr>';

            $('#order-table').append(orderlist);
            rowCount = rowCount + 1;
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

        $('#order-table1 tr:eq(' + row_index + ')').find('.subtotal').text(subtotal);
    });

    $(document).on('click', '.deletethis', function(){
        $(this).parents('tr').first().remove();
        rowCount = rowCount - 1;
    });

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
        window.setTimeout(function() {
            window.location.href = '../bomcreation';
        }, 500);
    });

    function getUnitName(unit){
        return $.ajax({
            type: 'GET',
            url: '../get_unit_name/'+unit,
            dataType: 'json',
            success: function(data) 
            {
                $('#myTable tr:last').find('.unit-name').text(data.name);                  
            }                   
        });
    }

    $(document).on('keyup', '#end-product-id', function(){
        var typeSelect    = $(this).val();
        var type          = $('#bom-product-type').val();

        if(typeSelect.length != 0){
            if(rowCount == 0)
            {
                $.ajax({
                    type: 'GET',
                    url: '../search_end_product/'+typeSelect,
                    dataType: 'json',
                    success: function(data) 
                    {
                        $('#end-product-list').empty();
                        if(data.length > 0)
                        {
                            $.each(data, function (index, value) 
                            {
                                $('#end-product-list').append('<option data-name="'+data[index].name+'" data-id="'+data[index].id+'" value="'+data[index].id+'" class="form-control selectendproduct" style="width: 80%">'+data[index].name+'</option>');
                            });
                        }
                        else
                        {
                            $('#end-product-list').append('<option class="form-control" style="width: 80%">No End Product Found</option>');
                        }
                                            
                    }                   
                });
            }
            else
            {
                $.ajax({
                    type: 'GET',
                    url: '../search_end_product_only/'+typeSelect+'/'+type,
                    dataType: 'json',
                    success: function(data) 
                    {
                        $('#end-product-list').empty();
                        if(data.length > 0)
                        {
                            $.each(data, function (index, value) 
                            {
                                $('#end-product-list').append('<option data-name="'+data[index].name+'" data-id="'+data[index].id+'" value="'+data[index].id+'" class="form-control selectendproduct" style="width: 80%">'+data[index].name+'</option>');
                            });
                        }
                        else
                        {
                            $('#end-product-list').append('<option class="form-control" style="width: 80%">No End Product Found</option>');
                        }                   
                    }                   
                });
            }
         
        }
        else
        {
            $('#end-product-list').empty();
        }
    });

    $(document).on('click','.selectendproduct', function(){
        var endproname = $(this).data('name');
        var endproid = $(this).data('id');

        $('#end-product-id').val(endproname);
        $('#bom-product-type').val(endproid);
        $('#end-product-list').empty();
    });

    $(document).on('focusout', '#bom-name', function(){ //AG2703QQQ
        var bomName = $(this).val();
        bomName = bomName.trim();
        bomName = bomName.replace(' ', '%20');
        var hiddenBomName = $('#hidden-bom-name').val(); 
        if((bomName.length != 0) && (bomName != hiddenBomName)){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/bomcreation/check_bom_name/'+bomName,
                dataType: 'json',
                success: function(data) 
                {
                    if(data.length > 0)
                    {
                        alert('Bom name already found !');
                        $('#bom-name').val(hiddenBomName).focus();
                    }                    
                }                   
            });
        }
    });
    

    $(document).on('keyup', '.qtychng', function(){
        var row_index = $(this).closest("tr").index();
        //var quantity = $('#order-table tr:eq(' + row_index + ')').find('.qtychange1').val();
        var weight = $('#order-table tr:eq(' + row_index + ')').find('.qtychange2').val();
        var wastage = $('#order-table tr:eq(' + row_index + ')').find('.qtychange3').val();

        //var totalqty = parseFloat(quantity) + parseFloat(weight) + parseFloat(wastage);
        var totalqty = parseFloat(weight) + parseFloat(wastage);

        totalqty = totalqty.toFixed(3);

        $('#order-table tr:eq(' + row_index + ')').find('.qtychange').val(totalqty);

    });

</script>