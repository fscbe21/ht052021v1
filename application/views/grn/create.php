
<div id="page-content" class="p20 clearfix">
    <div class="p-1">
    <?php
        if($success){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong> Grn created successfully.
      </div>

      <?php
        }
        ?>

        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('add_grn'); ?></h4>
                    <div class="title-button-group">
                    <a href="<?php echo_uri("grn") ?>">
                            <button class="btn btn-md btn-default">GRN List</button>
                    </a>
                    </div>
                </div>
                <br />
                <?php echo form_open(get_uri("grn/savegrn"), array("id" => "grn-form", "class" => "general-form", "role" => "form")); ?>
                <div class="container-1 row">
                <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">GRN Date</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                     <input type="date" name="grn_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">GRN No</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                <?php
                                    $grn_data = $this->Grn_model->get_last_data()->result();
                                    $last_id = $grn_data[0]->id;
                                    $new_grn = $last_id + 1;
                                ?>
                                     <input readonly type="text" class="form-control" value="<?= $new_grn; ?>">
                                </div>
                            </div>
                        </div>
                   </div>
                    <div class="col-md-5">
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
                <br />
                <div class="container-1 row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">Grn Status *</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                  <select name="status" class="form-control" required>   
                                    <option value="" >Select Grn Status</option>  
                                    <?php foreach($grn_status_all as $psa){?>
                                            <option value="<?php echo $psa->id; ?>"><?php echo $psa->title; ?> </option>
                                            <?php }  
                                            ?>                       
                                  </select>
                                </div>
                            </div>
                        </div>
                    </div>

                  <!--darini 22-33-->
                  <div class="col-md-5" style="display:none"><!--darini 10-4-->
                        <div class="form-group">
                            <label for="title" class=" col-md-3">Select Purchase Id</label>
                            <div class="<?php echo $field_column; ?>">
                           
                                <div class=" col-md-9">
                                <select name="purchase_id" class="form-control" >   
                                    <option value="" >Select Id</option>  
                                 
                                    <?php foreach($purchase as $psa){

                                        if(in_array($psa->id,$grn_list)){ }else{
                                        ?>                                            
                                            <option value="<?php echo $psa->id; ?>"><?php echo $psa->id; ?> </option>
                                            <?php } }  
                                            ?>                       
                                  </select> 
                                </div>
                            </div>
                        </div>

                    </div>
<!--end-->

            <!--darini 10-4-->                                        
            <div class="col-md-5" >
                        <div class="form-group">
                            <label for="title" class=" col-md-3">Select Request Order</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                <!--  <input type="number" name="purchase_requstion_number" class="form-control"  required>-->
                                <select name="request_order" class="form-control">   
                                    <option value="">Select Request number</option> 
                                      
                                            <option value="1">Purchase Requstion Number</option>
                                            <option value="2">Purchase Order Number</option>
                                            <option value="3">Direct</option><!-- R.V14_04Modified-->
                                                                                     
                                </select>
                                </div>
                            </div>
                        </div>
                   </div>


                    <div class="col-md-5" id="o_number" style="display:none">
                        <div class="form-group">
                            <label for="title" class=" col-md-3" id="title_number"></label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                <!--  <input type="number" name="purchase_requstion_number" class="form-control"  required>-->
                                <select name="request_number" id="request_number" class="form-control">   
                                    
                                            
                                                                                     
                                </select>
                                </div>
                            </div>
                        </div>
                   </div>

                   <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">DC Number</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                     <input type="text" name="dc_number" class="form-control">
                                </div>
                            </div>
                        </div>
                   </div>

                   <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">Date</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                     <input type="date" name="dc_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                   </div>

                   

                   <div class="col-md-5">
                        <div class="form-group">
                            <label for="title" class=" col-md-3">Receiver Name</label>
                            <div class="<?php echo $field_column; ?>">
                                <div class=" col-md-9">
                                     <input type="text" name="receiver_name" class="form-control">
                                </div>
                            </div>
                        </div>
                   </div>

                   <!--end-->         


                </div>
                <br />
                <div class="pl-2 container-2">
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
                                <th align="right">Quantity</th>
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
              <div class="container-2 p-2">
                   <div class="row" style="width: 82%">
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
              <div class="container-2 p-2">
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
        //console.log("tax"+taxall);
        taxall.forEach(function(value,index) {
            if(value.id==taxp){
                //console.log("val"+value.percentage);
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
            //console.log("tax"+(parseFloat(cost * qtychange)*taxrate)/100);
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
       // console.log('clicked');
        $(this).parents('tr').first().remove();
    });

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
        window.setTimeout(function() {
            window.location.href = '../grn';
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
    
//darini 22-3
$('select[name="purchase_id"]').on("change", function() {
         
         var req=$(this).val();
         //console.log('entered'+req);
         $('#order-table').empty();
         $.ajax({
            type: 'GET',
            url: 'getprtdet/'+req,
            
            
            success: function(data) 
            {
               // console.log(JSON.parse(data));
               var result= JSON.parse(data);
               result.forEach(function(value,index) {
                var discount = 0;
                var tax = value.tax;
                var subtotal =value.total;
                var orderlist = '<tr>';
                orderlist += '<td>'+value.name+'</td>';
                orderlist += '<td class="'+value.code+'">'+value.code+'</td>';
                orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]"  value="'+value.qty+'" /></td>';
                orderlist += '<td class="unit-name">'+value.unit+'</td>';
                orderlist += '<td class="cost">'+value.cost+'</td>';
                orderlist += '<td>'+discount+'</td>';
                orderlist += '<td class="tax">'+tax+'</td>';
                orderlist += '<td class="subtotal">'+subtotal+'</td>';
                orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
                orderlist += '<input type="hidden" name="code[]" value="'+value.code+'"/>';
                orderlist += '<input type="hidden" name="id[]" value="'+value.id+'"/>';
                orderlist += '<input type="hidden" name="product_cost[]" value="'+value.cost+'"/>';
                orderlist += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="'+value.tax_rate+'"/>';
                orderlist += '<input type="hidden" class="tax-value" name="tax[]" value="'+tax+'"/>';
                orderlist += '</td>'
                orderlist += '</tr>';

                $('#order-table').append(orderlist);
                //getUnitName(value.unit);

               })
               
            }
         });
       
        
    });

     //darini 10-4 
     //R.V14_04Modified
     $('select[name="request_order"]').on("change", function() {
        var req=$(this).val();
        //console.log(req);

        $('#request_number').find('option').remove();
        var select=document.getElementById('request_number');
        document.getElementById('o_number').style.display="block";
        if(req==1){
            $('#request_number').show();
            $('#title_number').show();
            $('#option').show();
            $("#request_number").prop('required',true);
            document.getElementById('title_number').innerHTML="Select Purchase Requstion Number ";
            var data=<?php echo json_encode($request)?>;
            //var result= JSON.parse(data);
            var opt=document.createElement('option');
            opt.innerHTML="Select One";            
            opt.value='';
            select.appendChild(opt);
            data.forEach(function(value,index) {
            var opt=document.createElement('option');
            opt.innerHTML=value.prno;            
            opt.value=value.id;
            select.appendChild(opt);
        });
        }else if(req==2){
            $('#request_number').show();
            $('#title_number').show();
            
            document.getElementById('title_number').innerHTML="Select Purchase Order Number";
            var data=<?php echo json_encode($order)?>;
            var opt=document.createElement('option');
            opt.innerHTML="Select One";            
            opt.value='';
            select.appendChild(opt);
            data.forEach(function(value,index) {
                var opt=document.createElement('option');
                opt.innerHTML=value.po_no;            
                opt.value=value.id;
                select.appendChild(opt);
               
            });
        } 
        
        else if(req==3){
            
            document.getElementById("request_number").style.display = "none";
            document.getElementById("title_number").style.display = "none";
           }
        
        else{
            $("#request_number").prop('required',false);
        }       
    });

    //R.V14_04Modified

    $('select[name="request_number"]').on("change", function() {

        var req= $('select[name="request_order"]').find(':selected').val();
        var val=$(this).val();
       // console.log(req);

        if(req==1){
            $('#order-table').empty();
         $.ajax({
            type: 'GET',
            url: '<?php echo_uri('purchase_order/getprtdet/'); ?>'+val,
            
            
            success: function(data) 
            {
              //  console.log(JSON.parse(data));
               var result= JSON.parse(data);
             
               (result.data_array).forEach(function(value,index) {
                $('select[name="supplier_id"]').val(result.supplier_id);
                if(value.remaining_qty>=0){
                var taxall=<?php echo json_encode($tax_all)?>;
                    var taxrate=0;
                    
                    var taxp=value.tax;
                    taxall.forEach(function(value,index) {
                        if(value.id==taxp){
                           // console.log("val"+value.percentage);
                            taxrate =value.percentage;
                        }
                    });
                  //  console.log("tax"+value.tax);
                var discount = 0;
                var tax = (((value.cost*value.qty)*taxrate)/100).toFixed(2) ;
                var subtotal =parseFloat(value.cost*value.qty)+parseFloat(tax);
                var orderlist = '<tr>';
                orderlist += '<td>'+value.name+'</td>';
                orderlist += '<td class="'+value.code+'">'+value.code+'</td>';
                orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]"  value="'+value.remaining_qty+'" readonly />Total Quantity:'+value.remaining_qty +'</td>';
                orderlist += '<td class="unit-name">'+value.unit+'</td>';
                orderlist += '<td ><input type="text" class="cost" value="'+value.cost+'"/></td>';
                orderlist += '<td>'+discount+'</td>';
                orderlist += '<td class="tax">'+tax+'</td>';
                orderlist += '<td class="subtotal">'+subtotal.toFixed(2)+'</td>';
                orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
                orderlist += '<input type="hidden" name="code[]" value="'+value.code+'"/>';
                orderlist += '<input type="hidden" name="id[]" value="'+value.id+'"/>';
                orderlist += '<input type="hidden" name="product_cost[]" class="product_cost" value="'+value.cost+'"/>';
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
        }else if(req==2){
            $('#order-table').empty();
            $.ajax({
            type: 'GET',
            url: '<?php echo_uri('purchase/getprdt/'); ?>'+val,
            
            
            success: function(data) 
            {
               // console.log(data);
                var result= JSON.parse(data);
                $('select[name="supplier_id"]').val(result.supplier_id);
                
                (result.data_array).forEach(function(value,index) {
                    if(value.remaining_qty>=0){
                var discount = 0;
                var tax = value.tax;
                var subtotal =value.total;
                var orderlist = '<tr>';
                orderlist += '<td>'+value.name+'</td>';
                orderlist += '<td class="'+value.code+'">'+value.code+'</td>';
                orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]"  value="'+value.remaining_qty+'" />Total Quantity:'+value.remaining_qty +'</td>';
                orderlist += '<td class="unit-name">'+value.unit+'</td>';
                orderlist += '<td ><input type="text" class="cost" value="'+value.cost+'"/></td>';
                orderlist += '<td>'+discount+'</td>';
                orderlist += '<td class="tax">'+tax+'</td>';
                orderlist += '<td class="subtotal">'+subtotal+'</td>';
                orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
                orderlist += '<input type="hidden" name="code[]" value="'+value.code+'"/>';
                orderlist += '<input type="hidden" name="id[]" value="'+value.id+'"/>';
                orderlist += '<input type="hidden" name="product_cost[]" class="product_cost" value="'+value.cost+'"/>';
                orderlist += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="'+value.tax_rate+'"/>';
                orderlist += '<input type="hidden" class="tax-value" name="tax[]" value="'+tax+'"/>';
                orderlist += '</td>'
                orderlist += '</tr>';

                $('#order-table').append(orderlist);
                //getUnitName(value.unit);
                    }
               })
            }
            
            })
        }


    });//end


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