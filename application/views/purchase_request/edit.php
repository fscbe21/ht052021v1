
<div id="page-content" class="p20 clearfix">
    <div class="p-1">
    <?php
        if($success){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong>&nbsp;Purchase Request updated successfully.
      </div>

      <?php
        }
        ?>
<?php
        $vendor_array = array();
        $vendor_array[''] = '-select-';
        foreach ($client_list as $single_data)
        {
          $vendor_array[$single_data->id] = $single_data->company_name;
        }
        

       // echo form_dropdown("vendor_field", $vendor_array,array() ,"class='select2'");
        
        ?>

        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> Edit Purchase Request</h4>
                    <div class="title-button-group">
                    <a href="<?php echo_uri("purchase_request") ?>">
                            <button class="btn btn-md btn-default">Purchase Request List</button>
                    </a>
                    </div>
                </div>
                <br /> 
                <?php echo form_open(get_uri("purchase_request/updatepurchase"), array("id" => "purchase-form", "class" => "general-form", "role" => "form")); ?>
                <div class="container row">
                <div class="col-md-5">
                        <div class="form-group">
                <label for="title" class=" col-md-3">PR No*</label>
                <input type="hidden" name="purchase_request_id" value="<?= $purchase_data->id; ?>"/>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-8">
                                  <input type="text" name="prno" class="form-control" value="<?= $purchase_data->prno; ?>"  required readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                <label for="title" class=" col-md-3">Date*</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-8">
                                  <input type="date" name="date" class="form-control" value="<?= $purchase_data->date; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <br />
                <div class="container row">
                <div class="col-md-5">
                    <div class="form-group">
                            <label for="title" class=" col-md-3">Warehouse *</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                  <select name="warehouse_id" class="form-control" required>   
                                  <option value="">Select Warehouse</option> 
                                    <?php
                                        $warehouse = $purchase_data->warehouse_id;
                                    ?>
                                        <?php foreach($warehouse_all as $wh){?>
                                            <option <?php echo ($warehouse == $wh->id) ? ' selected' : ''; 
                                    ?> value="<?php echo $wh->id; ?>"><?php echo $wh->name; ?> </option>
                        <?php }  ?>                                                    
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>


                <div class="col-md-5">
                <div class="form-group">
                            <label for="title" class=" col-md-3">User</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                  <select name="user_id" class="form-control" required>   
                                    <option value="" >Select User</option> 
                                    <?php
                                        $customer = $purchase_data->user_id;
                                    ?>
                                        <?php foreach($customer_list as $wh){?>
                                            <option
                                            <?php echo ($customer == $wh->id) ? ' selected' : ''; 
                                    ?>
                                             value="<?php echo $wh->id; ?>"><?php echo $wh->name; ?> </option>
                        <?php }  ?>                                                    
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--changes 30-3-->
                <br />
                <div class=" container row">
                        <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">Supplier *</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-7">
                                  <select name="supplier_id" class="form-control new" required>   
                                    <option value="">Select Supplier</option> 
                                        <?php foreach($supplier_all as $sp){?>
                                            <option value="<?php echo $sp->id; ?>"  <?php if($sp->id==$purchase_data->supplier_id){ ?> selected <?php } ?>  ><?php echo $sp->name.' ( '.$sp->company_name.' )'; ?> </option>
                                            <?php }  
                                            ?>                                                    
                                </select>
                                </div>
                                <div class="col-md-2">
                                <?php echo modal_anchor(get_uri("supplier/modal_form"), "<i class='fa fa-plus-circle'></i> " . '', array("class" => "btn btn-default ", "title" => 'Add Supplier')); ?>
                                </div>
                            </div>
                        </div>

                    </div><!--end-->

                </div>
                    
                    </div>
                <br />
                <div class="pl-2 container">
                    <b>
                    <p>Select product *</p>
                    </b>
                    
                    <div class="form-group">
                        <input type="text" id="search" name="search" class="form-control" style="width: 80%; height: 50px" placeholder="Search product with product code or name"/>
                        <div id="product-list"></div>
                    </div>
                <b><p>Order Table *</p></b>
                <div class="table-responsive mt-3">
                    <table id="myTable" class="table table-hover table-striped order-list" style="width: 80%; font-weight: 600">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th align="right">Quantity</th>
                                <th align="left">Unit</th>                                
                                <th class="text-center">Client</th>
                                <th class="text-center">Remarks</th>
                                <th><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody id="order-table">
                        <?php
                           $options = array();
                           $options['purchase_request_id'] = $purchase_data->id;
                           
                           
                           $purchase_detail = $this->Purchase_request_details_model->get_details($options)->result();
                            foreach($purchase_detail as $pdata){
                                $product_data = $this->Products_model->get_one($pdata->product_id);
                                $product_name = $product_data->name;
                                $suplier_data = $this->Supplier_model->get_one($pdata->supplier_id);
                                $suplier_name = $suplier_data->name;
                                $product_code = $product_data->code;
                                $product_cost = $product_data->cost;

                                $unit_data    = $this->Unit_model->get_one($product_data->unit_id);//changes 23-3
                                $unit_name    = $unit_data->name;
                               
                                $typeName='';
                                if($product_data->type == 5){
                                    $typeName='Raw Material';
                                 }else if($product_data->type == 6){
                                     $typeName='Finished Product';
                                 }else if($product_data->type == 6){
                                     $typeName='Semi Goods';
                                 }else{
                                     $typeName=$product_data->type;
                                 }
                               
                        ?>
                        <tr>
                        <td><?= $product_name; ?></td>
                        <td class="<?= $product_code; ?>"><?= $product_code; ?></td>
                        <td><?php echo $typeName; ?></td>
                        <td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="<?= $pdata->qty; ?>"/></td>
                        <td><?= $unit_name; ?></td>
                        <td><?php echo form_dropdown("vendor_field[]", $vendor_array,$pdata->supplier_id,array() ,"class='form-control select2'");?></td>
                        <td> <input class="form-control" type="text" name="remarks[]" value="<?php echo  $pdata->remarks ?>"/></td>
                        <td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true">
                        </i>
                        <input type="hidden" name="code[]" value="<?= $product_code; ?>"/>
                        <input type="hidden" name="id[]" value="<?= $pdata->product_id; ?>"/>
                       
                        
                        
                      
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
              <div class="container p-2">
                   <div class="row" style="width: 80%">
                       
                       
                    

                   </div>
                   <br />
                   <div class="row" >
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Attach Document</label> <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                          <!--changes 24-3-->
                                          <input type="hidden" name="old_file" value="<?php echo $purchase_data->document; ?>"/>
                                           <div id="post-dropzone" class="post-dropzone box-content  form-control">
                                                <?php $this->load->view("includes/dropzone_preview"); ?>
                                             <button onclick="document.getElementById('label_doc').style.display='none';" class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> Upload </button>
                                            <label id="label_doc"><?php if($purchase_data->document){echo $purchase_data->document;}else{ echo "No file choosen";}?></label>
            
                                        </div>
                                        <!--end-->
                                           
                                        </div>
                                    </div>
                                  
                                </div>
                   <br />
                   <br />
                   <label>Note:</label>

                        <textarea class="form-control" style="width: 80%" name="note" rows="3" cols="50">
                        <?= $purchase_data->notes; ?>
                        </textarea>

              </div><br /><br />
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
  $(".select2").select2();


$(document).on('keyup', '#search', function(){
    var searchContent = $(this).val();
    if(searchContent.length != 0){
        $.ajax({
        type: 'GET',
        url: '../search/'+searchContent,
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
                    $('#product-list').append('<option data-name="'+namep+'" data-type="'+data[index].type+'" data-code='+data[index].code+' data-id="'+data[index].id+'" data-cost='+data[index].cost+' data-unit='+data[index].unit_id+' value="'+data[index].code+'" class="form-control selected" style="width: 80%">'+data[index].name+' ( '+data[index].code+' )</option>');
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
    var type   = $(this).data('type');
    var typeName='';
    if(type == '5'){
        typeName='Raw Material'
    }else if(type == '6'){
        typeName='Finished Product'
    }else if( type == '7'){
        typeName='Semi Goods';
    }else{
        typeName=type;
    }

    var indexv = $('#order-table').find('.'+code).index();
    if(indexv == 1){
        var closestTr = $('#order-table').find('.'+code).closest("tr").index();
        var qtychange = $('#order-table tr:eq(' + closestTr + ')').find('.qtychange').val();
        qtychange = parseFloat(qtychange);
        qtychange += 1;

        $('#order-table tr:eq(' + closestTr + ')').find('.qtychange').val(qtychange);
        var cost = $('#order-table tr:eq(' + closestTr + ')').find('.cost').text();
        cost = parseFloat(cost);
        var subTotal = parseFloat(cost * qtychange);   
        subtotal = subTotal.toFixed(2);
        $('#order-table tr:eq(' + closestTr + ')').find('.subtotal').text(subtotal);
    }else{
        var cost = $(this).data('cost');
        var unit = $(this).data('unit');
        var discount = 0;
        var tax = 0;
        var subtotal = cost;
        var qty = 1;
        var orderlist = '<tr>';
        orderlist += '<td>'+name+'</td>';
        orderlist += '<td class="'+code+'">'+code+'</td>';
        orderlist += '<td>'+ typeName +'</td>';
        orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="1"/></td>';
        orderlist += '<td class="unit-name"></td>';
        orderlist += `<td><?php echo form_dropdown("vendor_field[]", $vendor_array,array() ,"class='form-control select2'");?></td>`;
        orderlist += '<td> <input class="form-control" type="text" name="remarks[]" value=""/> </td>';
        orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
        orderlist += '<input type="hidden" name="code[]" value="'+code+'"/>';
        orderlist += '<input type="hidden" name="id[]" value="'+id+'"/>';
      
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
        console.log('clicked');
        $(this).parents('tr').first().remove();
    });

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
        window.setTimeout(function() {
            window.location.href = '../purchase_request';
        }, 400);
    });

    function getUnitName(unit){
        return $.ajax({
            type: 'GET',
            url: '<?php echo echo_uri('/bomcreation/get_unit_name/'); ?>'+unit,//changes 23-3
            dataType: 'json',
            success: function(data) 
            {
                $('#myTable tr:last').find('.unit-name').text(data.name);                  
            }                   
        });
    }
//changes 24-3
var uploadUrl = "<?php echo get_uri("sales/upload_file"); ?>";
var validationUrl = "<?php echo get_uri("sales/validate_post_file"); ?>";
var dropzone = attachDropzoneWithForm("#post-dropzone", uploadUrl, validationUrl);

$(document).on('click', '#fs-supplier-btn', function(){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo base_url(); ?>index.php/grn/get_all_suppliers',
            success: function(data) 
            {
               $.each(data, function (index, value) 
                {
                    var indexid = parseInt(data.id) + 1;
                    var supplierName = $('#supplier_name').val();
                    var companyName  = $('#company_name').val();
                    
                    $('.new').prepend('<option value="'+indexid+'" class="form-control" style="width: 80%">'+supplierName+' ( '+companyName+' )</option>');

                });
            }
    });
});

</script>