<div id="page-content" class="m20 clearfix">
  

<div class="panel">
    <div class="tab-title clearfix">
                <h4><?php echo "Edit Transfer"; ?></h4>
    </div>

    <div>
    <?php echo form_open(get_uri("transfer/updatetransfer"), array("id" => "transfer-form", "class" => "general-form", "role" => "form")); ?>
    <input type="hidden" name="transfer_id" value="<?php echo $info->id; ?>"/>
    <input type="hidden" name="warehouse_id_from_old" value="<?php echo  $info->from_warehouse_id; ?>"/>
    <input type="hidden" name="warehouse_id_to_old" value="<?php echo  $info->to_warehouse_id; ?>"/>
    <div class="row" style="padding:10px">
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> <strong> From Warehouse * </strong></label>
                                            <select required name="warehouse_id_from" id="warehouse_id_from" class="selectpicker form-control" >
                                            <option value="" >Select Warehouse</option> 
                                            <?php foreach($warehouse_all as $wh){?>
                                                 <option value="<?php echo $wh->id; ?>" <?php if($info->from_warehouse_id==  $wh->id){ ?> selected <?php } ?>><?php echo $wh->name; ?> </option>
                                            <?php }  ?>   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>To Warehouse * </strong></label>
                                            <select required name="warehouse_id_to" id="warehouse_id_to" class="selectpicker form-control" >
                                            <option value="" >Select Warehouse</option> 
                                            <?php foreach($warehouse_all as $wh){?>
                                                 <option value="<?php echo $wh->id; ?>" <?php if($info->to_warehouse_id==  $wh->id){ ?> selected <?php } ?> ><?php echo $wh->name; ?> </option>
                                            <?php }  ?>   
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> <strong>Status</strong> </label>
                                            <select name="status" class="form-control">
                                                <option value="1" <?php if($info->status==  1){ ?> selected <?php } ?>  >Completed</option>
                                                <option value="2" <?php if($info->status==  2){ ?> selected <?php } ?>>Pending</option>
                                                <option value="3" <?php if($info->status==  3){ ?> selected <?php } ?>>Sent</option>
                                            </select>
                                        </div>
                                    </div>
        </div>
        <div class="row" style="padding:10px">
             <div class="col-md-12">
                     <label><strong>Select Product</strong></label>
                     <input type="text" id="search" name="search" class="form-control"  placeholder="Search product with product code or name"/>
                     <div id="product-list"></div>
                            
              </div>
        </div>

        <div class="row mt-5" style="padding:10px">
                                    <div class="col-md-12">
                                        <h5>Order Table *</h5>
                                        <div class="table-responsive mt-3">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                    <tr>
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th align="right">Quantity</th>
                                                    <th align="left">Unit</th>
                                                    <th>Unit Cost</th>
                                                    
                                                    <th>Tax</th>
                                                    <th>Subtotal</th>
                                                    <th><i class="fa fa-trash-o"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="order-table">
                                                
                                                <?php
                                                        
                                                        $product_sales_data = $this->ProductTransfer->transfer_product_list($info->id);
                                                        foreach($product_sales_data as $bdata){
                                                            $prd_data     = $this->Products_model->get_one($bdata->product_id);
                                                            $product_name = $prd_data->name;
                                            
                                                            $unit_data    = $this->Unit_model->get_one($bdata->purchase_unit_id);
                                                            $unit_name    = $unit_data->name;
                                                ?>

                                                        <tr>
                                                            <td class="name"><?php echo $product_name?></td>
                                                            <td class="<?php echo  $prd_data->code?>"><?php echo  $prd_data->code?></td>
                                                            <td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="<?php echo $bdata->qty;?>" required /></td>
                                                            <td class="unit-name"><?php echo   $unit_name?></td>
                                                            <td class="cost"><?php echo  $bdata->net_unit_cost?></td>                                                         
                                                            <td class="tax"><?php echo $bdata->tax;?></td>
                                                            <td class="subtotal"><?php  echo $bdata->total;?></td>
                                                            <td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>
                                                                    <input type="hidden" name="code[]" value="<?php echo  $prd_data->code?>"/>
                                                                    <input type="hidden" name="id[]" value="<?php echo $bdata->product_id;?>"/>
                                                                    <input type="hidden" name="product_cost[]" value="<?php echo  $bdata->net_unit_cost?>"/>
                                                                    <input type="hidden" name="unit-code[]" value="<?php echo   $bdata->purchase_unit_id ?>"/>                                                                  
                                                                    <input type="hidden" class="tax-rate" name="tax_rate[]" value="<?php echo $bdata->tax_rate ?>"/>
                                                                    <input type="hidden" class="tax-value" name="tax[]" value="<?php echo $bdata->tax ?>"/>
                                                                    <input type="hidden" class="subtotal-value" name="subtotal[]" />
                                                            </td>
                                                            <td class="id" style="display:none"><?php echo $bdata->product_id ?></td>
                                                        </tr>
                                               <?php }
                                                ?>
                                                 </tbody>
                                                <tfoot class="tfoot active">
                                                    <th colspan="2">Total</th>
                                                    <th id="total-qty" >0</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th id="total-discount">0.00</th>
                                                    <th id="total-tax">0.00</th>
                                                    <th id="total">0.00</th>
                                                    <th><i class="dripicons-trash"></i></th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
         </div>
         <div class="row" >
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_discount" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_price" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="item" />
                                            <input type="hidden" name="order_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="grand_total" />
                                           
                                        </div>
                                    </div>
                                    </div>

         <div class="row mt-3" style="padding:10px">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <strong>Shipping Cost</strong>
                                            </label>
                                            <input type="number" name="shipping_cost" class="form-control" step="any" value="<?php echo $info->shipping_cost ?>"/>
                                        </div>
                                    </div>
                              
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>Attach Document</strong></label> <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                            <input type="file" name="document" class="form-control" />
                                           
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row" style="padding:10px">
                                <div  class="col-md-12">
                                         <div class="form-group">
                                            <label><strong>Note</strong></label>
                                            <textarea rows="6" class="form-control" name="note"><?php echo $info->note?></textarea>
                                        </div>
                                </div>
                                </div>
                                <div class="form-group" style="padding:10px">
                                    <input type="submit" value="Submit" class="btn btn-primary" id="submit-button">
                                </div>
    <?php echo form_close(); ?>   

    </div>
 </div>
</div>
<div class="container-fluid" style="margin-right:50px">
        <table class="table table-bordered table-condensed totals">
            <td><strong>Items</strong>
                <span class="pull-right" id="item">0.00</span>
            </td>
            <td><strong>Total</strong>
                <span class="pull-right" id="subtotal">0.00</span>
            </td>
           
           
            <td><strong>Shipping Cost</strong>
                <span class="pull-right" id="shipping_cost">0.00</span>
            </td>
            <td><strong>Grand total</strong>
                <span class="pull-right" id="grand_total">0.00</span>
            </td>
        </table>
    </div>

<script type="text/javascript">
$(document).ready(function(){
    calculateTotal();
 });
    $(document).on('keyup', '#search', function(){
        var warehouse_id = $('#warehouse_id_from').val();
        temp_data = $('#search').val();
        if(!warehouse_id){
            alert("Please Select Warehouse");
            $('#search').val(temp_data.substring(0, temp_data.length - 1));
        }else{
        var searchContent = $(this).val();
        console.log(searchContent);
        if(searchContent.length != 0){
            $.ajax({
            type: 'GET',
            url: '<?php echo echo_uri('sales/search/'); ?>'+searchContent,
            dataType: 'json',
            success: function(data) 
            {
                console.log(data);
                $('#product-list').empty();
                if(data.length > 0)
                {
                    $.each(data, function (index, value) 
                    {
                        $('#product-list').append('<option data-name="'+data[index].name+'" data-code='+data[index].code+' data-id="'+data[index].id+'" data-cost='+data[index].cost+' data-unit='+data[index].unit_id+' data-tax='+data[index].tax_id+' value="'+data[index].code+'" class="form-control selected" style="width: 80%">'+data[index].name+' ( '+data[index].code+' )</option>');
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
        }
        
    });

    $(document).on('click', '.selected', function(){
        var name = $(this).data('name');
        var code = $(this).data('code');
        var id   = $(this).data('id');
        var taxp   = $(this).data('tax');
        var indexv = $('#order-table').find('.'+code).index();
        var wid = $('#warehouse_id_from').val();
        var taxrate=0;
        
      
       var taxall=<?php echo json_encode($tax_all)?>;
       console.log("tax"+taxall);
       taxall.forEach(function(value,index) {
        if(value.id==taxp){
            //console.log("val"+value.percentage);
            taxrate =value.percentage;
        }
       });
        if(indexv == 1){
            var closestTr = $('#order-table').find('.'+code).closest("tr").index();
            var  qtychange = $('#order-table tr:eq(' + closestTr + ')').find('.qtychange').val();
           
            qtychange = parseFloat(qtychange);
            qtychange += 1;

            $('#order-table tr:eq(' + closestTr + ')').find('.qtychange').val(qtychange);
            var cost = $('#order-table tr:eq(' + closestTr + ')').find('.cost').text();
            cost = parseFloat(cost);      
                  
            var tax = (parseFloat(cost * qtychange)*taxrate)/100 ;
            console.log("tax"+(parseFloat(cost * qtychange)*taxrate)/100);
            $('#order-table tr:eq(' + closestTr + ')').find('.tax').text(tax);
            $('#order-table tr:eq(' + closestTr + ')').find('.tax-value').val(tax);
            var dis=0;

            var subTotal = (parseFloat(cost * qtychange)+tax)-dis;   
            subtotal = subTotal.toFixed(2);
            $('#order-table tr:eq(' + closestTr + ')').find('.subtotal').text(subtotal);
           

        }
        else
        {
            var cost = $(this).data('cost');
            var unit = $(this).data('unit');
            var discount = 0;
            var tax = (cost*taxrate)/100 ;
            var subtotal = (cost+tax)-discount;
            var qty = 1;
            var orderlist = '<tr>';
            orderlist += '<td class="name">'+name+'</td>';
            orderlist += '<td class="'+code+'">'+code+'</td>';
            orderlist += '<td><input style="width: 100px; background-color: white; border: 1px solid #2c3e50" class="form-control qtychange" type="number" name="qty[]" value="1" required=true /></td>';
            orderlist += '<td class="unit-name"></td>';
            orderlist += '<td class="cost">'+cost+'</td>';
            
            orderlist += '<td class="tax">'+tax+'</td>';
            orderlist += '<td class="subtotal">'+subtotal.toFixed(2)+'</td>';
            orderlist += '<td style="color: red"><i class="fa fa-trash-o deletethis" aria-hidden="true"></i>';
            orderlist += '<input type="hidden" name="code[]" value="'+code+'"/>';
            orderlist += '<input type="hidden" name="id[]" value="'+id+'"/>';
            orderlist += '<input type="hidden" name="product_cost[]" value="'+cost+'"/>';
            orderlist += '<input type="hidden" name="unit-code[]" value="'+unit+'"/>';
          
            orderlist += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="'+taxrate+'"/>';
            orderlist += '<input type="hidden" class="tax-value" name="tax[]" value="'+tax+'"/>';
          
            orderlist += '</td>'
            orderlist += '<td class="id" style="display:none">'+id +'</td>';
           
            orderlist += '</tr>';

            $('#order-table').append(orderlist);
            getUnitName(unit);
           
        }
      
        check();
        calculateTotal();
        $('#product-list').empty();
        $('#search').val('');

    });
    $('select[name="warehouse_id_from"]').on('change', function() {
        check();
    });
    $(document).on('input', '.qtychange', function(){

        var row_index = $(this).closest("tr").index();
        var cost = $('#order-table tr:eq(' + row_index + ')').find('.cost').text();
        cost = parseFloat(cost);
        var qty  = $('#order-table tr:eq(' + row_index + ')').find('.qtychange').val();
        qty = parseFloat(qty);
        var taxrate=$('#order-table tr:eq(' + row_index + ')').find('.tax-rate').val();
        var tax = (parseFloat(cost * qty)*taxrate)/100 ;
        console.log("tax"+(parseFloat(cost * qty)*taxrate)/100);
        $('#order-table tr:eq(' + row_index + ')').find('.tax').text(tax);
        $('#order-table tr:eq(' + row_index + ')').find('.tax-value').val(tax);
        var dis=0;
        var subTotal = (parseFloat(cost * qty)+tax)-dis;   
        subtotal = subTotal.toFixed(2);
       
        console.log(subtotal);

        $('#order-table tr:eq(' + row_index + ')').find('.subtotal').text(subtotal);
        check();
        calculateTotal();
        
    });

    $(document).on('click', '.deletethis', function(){
        console.log('clicked');
        $(this).parents('tr').first().remove();
    });

    
   
    
    
    function getUnitName(unit){
        return $.ajax({
            type: 'GET',
            url: '<?php echo echo_uri('/bomcreation/get_unit_name/'); ?>'+unit,
            dataType: 'json',
            success: function(data) 
            {
               // console.log(data);
                $('#order-table tr:last').find('.unit-name').text(data.name);                  
            }                   
        });


    }

    function check(){

        var wid = $('#warehouse_id_from').val();
        console.log("entered");
        $('#myTable > tbody > tr').each(function(index,tr){
            console.log(index);
           console.log( $('#order-table tr:eq(' + index + ')').find('.id').text());
           var pid= $('#order-table tr:eq(' + index + ')').find('.id').text();
           var qtych= parseInt($('#order-table tr:eq(' + index + ')').find('.qtychange').val());
           var name=$('#order-table tr:eq(' + index + ')').find('.name').text();
           console.log("qty"+qtych);
           $.ajax({
            type: 'GET',
            url: '<?php echo echo_uri('/sales/prdctqty/')?>'+wid+'/'+pid,
            
            
            success: function(data) 
            {
                //console.log(data);
                var obj=JSON.parse(data);
                console.log(obj);
                var qt;
                if(obj.length ==0){
                    //return 0;
                    qt=0;
                }else{
                     qt=parseInt(obj[0].qty);
                    //return qt;
                }
                
                console.log('totq'+qt);
                console.log(qtych > qt);
              if(qtych > qt){
                alert('Quantity exceeds stock quantity in '+name);
                if(qt==0){
                    tr.remove();
                   // calculateTotal();
                }else{
                    var qtyy=$('#order-table tr:eq(' + index + ')').find('.qtychange').val();
                    var  sale_qty = qtyy.substring(0, qtyy.length - 1);
                    $('table.order-list tbody tr:nth-child(' + (index + 1) + ')').find('.qtychange').val(sale_qty);
                }
                calculateTotal();
                
              }
               
            }
        });
        });
      
    
    }

    function calculateTotal() {
    //Sum of quantity
    var total_qty = 0;
    $(".qtychange").each(function() {

        if ($(this).val() == '') {
            total_qty += 0;
        } else {
            total_qty += parseFloat($(this).val());
        }
    });
    $("#total-qty").text(total_qty);
    $('input[name="total_qty"]').val(total_qty);

    //Sum of tax
    var total_tax = 0;
    $(".tax").each(function() {
        total_tax += parseFloat($(this).text());
    });
    $("#total-tax").text(total_tax.toFixed(2));
    $('input[name="total_tax"]').val(total_tax.toFixed(2));

    //Sum of subtotal
    var total = 0;
    $(".subtotal").each(function() {
        total += parseFloat($(this).text());
    });
    $("#total").text(total.toFixed(2));
    $('input[name="total_price"]').val(total.toFixed(2));

    calculateGrandTotal();
}

function calculateGrandTotal() {

    var item = $('table.order-list tbody tr:last').index();

    var total_qty = parseFloat($('#total-qty').text());
    var subtotal = parseFloat($('#total').text());
    var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());

    if (!shipping_cost)
        shipping_cost = 0.00;

    item = ++item + '(' + total_qty + ')';

    var grand_total = (subtotal + shipping_cost);

    $('#item').text(item);
    $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
    $('#subtotal').text(subtotal.toFixed(2));
    $('#shipping_cost').text(shipping_cost.toFixed(2));
    $('#grand_total').text(grand_total.toFixed(2));
    $('input[name="grand_total"]').val(grand_total.toFixed(2));
}

$('input[name="shipping_cost"]').on("input", function() {
    calculateGrandTotal();
});




$('#transfer-form').on('submit',function(e){
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        alert("Please insert product to order table!")
        e.preventDefault();
    }
    if($('select[name="warehouse_id_from"]').val() == $('select[name="warehouse_id_to"]').val()){
        alert('Both Warehouse can not be same!');
        e.preventDefault();
    }

  
});

</script>