
<div id="page-content" class="p20 clearfix">
    <div class="p-1">
    <?php
        if($success){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong> Purchase Order created successfully.
      </div>

      <?php
        }
        ?>

        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('add_purchase_order'); ?></h4>
                    <div class="title-button-group">
                    <a href="<?php echo_uri("purchase_order") ?>">
                            <button class="btn btn-md btn-default">Purchase Order List</button>
                    </a>
                    </div>
                </div>
                <br />
                <?php echo form_open(get_uri("purchase_order/savepurchase_order"), array("id" => "purchase-form", "class" => "general-form", "role" => "form")); ?>
                <div class="container row">
                <div class="col-md-5">
                        <div class="form-group">
                <label for="title" class=" col-md-3">Purchase Order No*</label>
                            <div class="<?php echo $field_column; ?>">
                            <?php   $id = $this->Purchase_order_model->getmaxid()->result();                                                               
                                ?>
                                <div class=" col-md-8">
                                  <input type="number" name="po_no" class="form-control" value="<?php echo ($id[0]->id)+1; ?>" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                <label for="title" class=" col-md-3">Date*</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-8">
                                  <input type="date" name="date" class="form-control"  value="<?php  echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <br />
                <div class="container row">
                <div class="col-md-5">
                        <div class="form-group">
                <label for="title" class=" col-md-3">Quotation Number</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-8">
                                  <input type="number" name="quotation_number" class="form-control"  >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
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
                    </div>
                    <!--changes 30-3-->
                    </br>
                    <div  class="container row">

               
                    <div class="col-md-5">
                        <div class="form-group">
                <label for="title" class=" col-md-3">Purchase requisition Number*</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-8">
                                <!--  <input type="number" name="purchase_requstion_number" class="form-control"  required>-->
                                <select name="purchase_requstion_number" class="form-control">   
                                    <option value="">Select requisition number</option> 
                                                                    
                                        <?php foreach($request as $tx){?>
                                            <?php  if(in_array($tx->id,$pch_list)){ }else{
                                        ?>   
                                            <option value="<?php echo $tx->id; ?>"><?php echo $tx->prno; ?> </option>
                                          <?php } } ?>                                                    
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
<!--end-->

                <!-- <div id="post-dropzone">
                 <div class="container row">
                    <div class="col-md-5">
            <div class="form-group">
            
                <label for="title" class=" col-md-3">Purchase Order Document</label>
                            <div class="<?php echo $field_column; ?>">
                               

                <div  class="post-dropzone box-content form-group">
            <?php $this->load->view("includes/dropzone_preview"); ?>

            
                <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> <?php echo lang("upload_file"); ?></button>
            
        </div>
                </div>
    
</div>
</div>-->



                
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
                                <th align="right">Quantity to be Recieved</th>
                              
                                <th align="left">Unit</th>
                                <th>Unit Cost</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Subtotal</th>
                                <th><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody id="order-table">
                        </tbody>
                    </table>
                </div>
              </div>
              <br />
              <div class="container p-2">
                   <div class="row" style="width: 80%">
                        <div class="col-md-4">
                            <p>Order Tax</p>
                            <select name="order_tax" class="form-control">   
                                    <option value="">Select Order Tax</option> 
                                        <?php foreach($tax_all as $tx){?>
                                            <option value="<?php echo $tx->id; ?>"><?php echo $tx->title; ?> </option>
                        <?php }  ?>                                                    
                                </select>
                        </div>

                        <div class="col-md-4">
                            <p>Discount</p>
                            <input type="number" name="total_discount" class="form-control"/>
                        </div>

                        <div class="col-md-4">
                            <p>Shipping Cost</p>
                            <input type="number" name="shipping_cost" class="form-control"/>
                        </div>
                    

                   </div>
                   <br />
                   <div class="row" >
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
                   <br />
                   <label>Note:</label>

                        <textarea class="form-control" style="width: 80%" name="note" rows="3" cols="50">
                       
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
                        $('#product-list').append('<option data-name="'+namep+'" data-code='+data[index].code+' data-id="'+data[index].id+'" data-cost='+data[index].cost+' data-unit='+data[index].unit_id+' data-tax='+data[index].tax_id+' value="'+data[index].code+'" class="form-control selected" style="width: 80%">'+data[index].name+' ( '+data[index].code+' )</option>');
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
        var taxp   = $(this).data('tax');
        var taxrate=0;
        var taxall=<?php echo json_encode($tax_all)?>;
        console.log("tax"+taxall);
        taxall.forEach(function(value,index) {
            if(value.id==taxp){
                console.log("val"+value.percentage);
                taxrate =value.percentage;
            }
        });
        if(indexv == 1){
            var closestTr = $('#order-table').find('.'+code).closest("tr").index();
            var qtychange = $('#order-table tr:eq(' + closestTr + ')').find('.qtychange').val();
            qtychange = parseFloat(qtychange);
            qtychange += 1;

            $('#order-table tr:eq(' + closestTr + ')').find('.qtychange').val(qtychange);
            var cost = $('#order-table tr:eq(' + closestTr + ')').find('.cost').text();
            cost = parseFloat(cost);
            var tax = ((parseFloat(cost * qtychange)*taxrate)/100).toFixed(2);
            console.log("tax"+(parseFloat(cost * qtychange)*taxrate)/100);
            $('#order-table tr:eq(' + closestTr + ')').find('.tax').text(tax);
            $('#order-table tr:eq(' + closestTr + ')').find('.tax-value').val(tax);
           
            var subTotal = parseFloat(cost * qtychange)+parseFloat(tax);   
            subtotal = subTotal.toFixed(2);
            $('#order-table tr:eq(' + closestTr + ')').find('.subtotal').text(subtotal);
        }
        else
        {
            var cost = $(this).data('cost');
            var unit = $(this).data('unit');
            var discount = 0;
            var tax = ((cost*taxrate)/100 ).toFixed(2);
            var subtotal = parseFloat(cost)+parseFloat(tax);
            var qty = 1;
            var orderlist = '<tr>';
            orderlist += '<td>'+name+'</td>';
            orderlist += '<td class="'+code+'">'+code+'</td>';
            orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="1"/></td>';
            orderlist += '<td class="unit-name"></td>';
            orderlist += '<td class="cost">'+cost+'</td>';
            orderlist += '<td>'+discount+'</td>';
            orderlist += '<td class="tax">'+tax+'</td>';
            orderlist += '<td class="subtotal">'+subtotal.toFixed(2)+'</td>';
            orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
            orderlist += '<input type="hidden" name="code[]" value="'+code+'"/>';
            orderlist += '<input type="hidden" name="id[]" value="'+id+'"/>';
            orderlist += '<input type="hidden" name="product_cost[]" value="'+cost+'"/>';
            orderlist += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="'+taxrate+'"/>';
            orderlist += '<input type="hidden" class="tax-value" name="tax[]" value="'+tax+'"/>';
            orderlist += '</td>'
            orderlist += '</tr>';

            $('#order-table').append(orderlist);
            getUnitName(unit);
        }
        
        $('#product-list').empty();
        $('#search').val('');
    });

    $(document).on('input', '.qtychange', function(){
        var row_index = $(this).closest("tr").index();
        var cost = $('#order-table tr:eq(' + row_index + ')').find('.cost').text();
        cost = parseFloat(cost);
        var qty  = $('#order-table tr:eq(' + row_index + ')').find('.qtychange').val();
        qty = parseFloat(qty);
        var taxrate=$('#order-table tr:eq(' + row_index + ')').find('.tax-rate').val();
        var tax = ((parseFloat(cost * qty)*taxrate)/100).toFixed(2) ;
       // console.log("tax"+(parseFloat(cost * qty)*taxrate)/100);
        $('#order-table tr:eq(' + row_index + ')').find('.tax').text(tax);
        $('#order-table tr:eq(' + row_index + ')').find('.tax-value').val(tax);
        var subTotal = parseFloat(cost * qty)+parseFloat(tax)    ;   
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
            window.location.href = '../purchase_order';
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

      
       //darini21-3
       $('select[name="purchase_requstion_number"]').on("change", function() {
         
         var req=$(this).val();
         //console.log('entered'+req);
         $('#order-table').empty();
         $.ajax({
            type: 'GET',
            url: 'getprtdet/'+req,
            
            
            success: function(data) 
            {
                console.log(JSON.parse(data));
               var result= JSON.parse(data);
               console.log(result.supplier_id);
               

               $('select[name="supplier_id"]').val(result.supplier_id);
               (result.data_array).forEach(function(value,index) {
                if(value.remaining_qty>=0){
                    var taxall=<?php echo json_encode($tax_all)?>;
                    var taxrate=0;
                    
                    var taxp=value.tax;
                    taxall.forEach(function(value,index) {
                        if(value.id==taxp){
                            console.log("val"+value.percentage);
                            taxrate =value.percentage;
                        }
                    });
                    console.log("tax"+value.tax);
                var discount = 0;
                var tax = ((parseFloat(value.cost*value.qty)*taxrate)/100).toFixed(2) ;
                var subtotal =parseFloat(value.cost*value.qty)+parseFloat(tax);
                var orderlist = '<tr>';
                orderlist += '<td>'+value.name+'</td>';
                orderlist += '<td class="'+value.code+'">'+value.code+'</td>';
                orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]"  value="'+value.remaining_qty+'" />Total Quantity:'+value.remaining_qty +'</td>';
                orderlist += '<td class="unit-name">'+value.unit+'</td>';
                orderlist += '<td class="cost">'+value.cost+'</td>';
                orderlist += '<td>'+discount+'</td>';
                orderlist += '<td class="tax">'+tax+'</td>';
                orderlist += '<td class="subtotal">'+subtotal.toFixed(2)+'</td>';
                orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
                orderlist += '<input type="hidden" name="code[]" value="'+value.code+'"/>';
                orderlist += '<input type="hidden" name="id[]" value="'+value.id+'"/>';
                orderlist += '<input type="hidden" name="product_cost[]" value="'+value.cost+'"/>';
                orderlist += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="'+taxrate+'"/>';
                orderlist += '<input type="hidden" class="tax-value" name="tax[]" value="'+tax+'"/>';
                orderlist += '</td>'
                orderlist += '</tr>';

                $('#order-table').append(orderlist);
                //getUnitName(value.unit);
                }

               })
               
            }
         });
       
        
    });//end
//changes 24-3
var uploadUrl = "<?php echo get_uri("sales/upload_file"); ?>";
var validationUrl = "<?php echo get_uri("sales/validate_post_file"); ?>";
var dropzone = attachDropzoneWithForm("#post-dropzone", uploadUrl, validationUrl);


$(document).on('click', '#fs-supplier-btn', function(){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo base_url(); ?>index.php/purchase_order/get_all_suppliers',
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