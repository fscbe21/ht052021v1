

<div id="page-content" class="p20 clearfix">
    <div class="p-1">
    <?php
        if($success){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong> <?php echo lang('purchase_requisition') ?> created successfully.
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
                    <h4> <?php echo lang('purchase_requisition'); ?></h4>
                    <div class="title-button-group">
                    <a href="<?php echo_uri("purchase_request") ?>">
                            <button class="btn btn-md btn-default"><?php echo lang('purchase_requisition'); ?> List</button>
                    </a>
                    </div>
                </div>
                <br />
                <?php echo form_open(get_uri("purchase_request/save"), array("id" => "purchase-request-form", "class" => "general-form", "role" => "form")); ?>
                <div class="container">
                    
                    <div class="row">


                    <div class="col-md-6">
<div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('purchase_request_number');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                <?php   $id = $this->Purchase_request_model->getmaxid()->result();
                                
                                
                                ?>
                                <input type="text" class="form-control" name="purchase_request_number" value="<?php echo ($id[0]->id)+1; ?>" readonly>
                                </div>
                            </div>
                        </div>
</div>




<div class="col-md-6">
<div class="form-group">
                            <label for="title" class=" col-md-3"><?php echo lang('date');?></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                <input type="date" class="form-control" name="purchase_request_date" value="<?php echo date('Y-m-d');?>">
                                </div>
                            </div>
                        </div>
</div>


<div class="col-md-6">
<div class="form-group">
                            <label for="title" class=" col-md-3">Warehouse *</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                  <select name="warehouse_id" class="form-control" required>   
                                    <option value="" >Select Warehouse</option> 
                                        <?php foreach($warehouse_all as $wh){?>
                                            <option value="<?php echo $wh->id; ?>"><?php echo $wh->name; ?> </option>
                        <?php }  ?>                                                    
                                </select>
                                </div>
                            </div>
                        </div>
</div>



<div class="col-md-6">
<div class="form-group">
                            <label for="title" class=" col-md-3">User</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                  <select name="user_id" class="form-control" required>   
                                    <option value="" >Select User</option> 
                                        <?php foreach($customer_list as $wh){?>
                                            <option value="<?php echo $wh->id; ?>"><?php echo $wh->name; ?> </option>
                        <?php }  ?>                                                    
                                </select>
                                </div>
                            </div>
                        </div>
</div>



                   


                 
                    
                    </div>
                      <!--changes 30-3-->
                      <br />
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">Supplier *</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class="col-md-7">
                                  <select name="supplier_id" class="form-control new" required>   
                                    <option value="">Select Supplier</option>
                                        <?php foreach($supplier_all as $sp){?>
                                            <option class="old" value="<?php echo $sp->id; ?>"><?php echo $sp->name.' ( '.$sp->company_name.' )'; ?> </option>
                                            <?php }  
                                            ?>                                         
                                </select>
                                </div>
                                <div class="col-md-2">
                                <?php echo modal_anchor(get_uri("supplier/modal_form"), "<i class='fa fa-plus-circle'></i> " . '', array("class" => "btn btn-default ", "title" => 'Add Supplier')); ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div><!--end-->
                </div>
               


                <div class="container row">
                

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3"></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                  
                                </div>
                            </div>
                        </div>

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
                    <table id="myTable" class="table table-hover order-list" style="width: 80%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th align="right">Quantity</th>
                                <th align="left">Unit</th>
                                <th class="text-center" >Client</th>
                                <th class="text-center">Remarks</th>
                                <th><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody id="order-table">
                        </tbody>
                    </table>
                </div>
              </div>
              <br />
              <br />
              <div class=" container p-2" >
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Attach Document</label> 
                                             <!--changes-->
                                             <div id="post-dropzone" class="post-dropzone box-content  form-control col-md-4">
                                                <?php $this->load->view("includes/dropzone_preview"); ?>
                                                <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> Upload </button>
            
                                             </div>
                                        <!--end-->
                                           
                                        </div>
                                    </div>
                                  
                                </div>
                   <br />
              <div class="container p-2">
                 
                   <label>Note:</label>

                        <textarea class="form-control" style="width: 80%" name="notes" rows="3" cols="50">
                       
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
            url: 'search/'+searchContent,
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
            url: '../bomcreation/get_unit_name/'+unit,
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
            url: '<?php echo base_url(); ?>index.php/purchase_request/get_all_suppliers',
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