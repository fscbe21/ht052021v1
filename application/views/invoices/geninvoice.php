<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
    body {
        /*margin: 4px;*/
    word-wrap: break-word;
  
   /*font-family:georgia, times, serif;*/
    font-size: 11px;
    
}


table, th, td {
    border: 0.01em solid #A9A9A9;
    border-collapse: collapse;
  
}

th, td {
   
    text-align: left;
    vertical-align: top;
}

.fixed_table {
    table-layout: fixed;
}
.style_hidden {
   border-style: hidden;
  
  
  
}

.bg-sky {
    background-color: #E0E0E0;
}

.text-bold {
    font-weight: bold;
}
.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

.btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
           
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            
        }

    @media print {
      @page { margin: 0; }
  body { margin: 1.0cm; }

      .hidden-print {
                display: none !important;
                
            }
    }

    </style>
  </head>

  <body ><!--  -->
   

    <div class="hidden-print" >
      <a style="text-decoration:none;" href="<?php echo get_uri("invoices/view/". $id) ?>" ><button class="btn btn-info"><i class="fa fa-arrow-left"></i>Back</button></a> 
     <button onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                 <input type="checkbox" name="include_in" id="include_in" checked="true"/>
                 <label for="include_in">  <strong> Include in Extra Information for print</strong></label>
                  
      <br>
  </div>


    <center>
      <span style="font-size:18px;text-transform: uppercase;">
       Invoice
      </span>
    </center>


<table autosize="1" style="overflow: wrap" id="mytable" width="100%"  cellspacing="0" cellpadding="0" align="center">
<!-- <table align="center" width="100%" height='100%'   > -->
  <thead>

    <tr>
      <th colspan="16">
        <table class="style_hidden fixed_table" width="100%" >
            <tbody><tr>

    
              <!-- First Half -->
              <td colspan="2" style="background-color: white; height: 30%; vertical-align: middle;padding:10px">
              <img src="<?php echo get_file_from_setting('invoice_logo', get_setting('only_file_path')); ?>" width="100%" />
              </td>

              <td colspan="6" >
                <b><?php echo strtoupper($biller_data[0]->name)?></b>
                <div style="line-height:13px;">
                <span style="font-size:11px;font-weight:100;">
                <?php echo $biller_data[0]->address."</br>" ;
                 echo $biller_data[0]->city."<br>";
                  
                 echo $biller_data[0]->state."-".$biller_data[0]->postal_code."<br>";                 
                 echo $biller_data[0]->email.",".$biller_data[0]->company_name;

                    ?>
                    <br><span style="font-weight:600;">GSTIN:<?php echo $biller_data[0]->vat_number;?></span> </span>
                </div>
              </td>
                

           

              <!-- Second Half -->
              <td colspan="8" rowspan="2">
                <span>
                  <table style="width: 100%;" class="style_hidden fixed_table">
                  
                      <tbody style="font-size:11px;font-weight:100">
                          
                        
                        <tr>
                        <td colspan="4">
                          Invoice No.<br>
                          <span >
                            <b><?php echo $invoice_info->id;?></b>
                          </span>
                        </td>
                        <td colspan="4">
                          Dated<br>
                          <span >
                            <?php 
                            $new_date = format_to_date($invoice_info->bill_date, false);;
                                        ?>
                            <b><?php echo $new_date;?></b>
                          </span>
                        </td>
                      </tr>


                      <tr>
                        <td colspan="4">
                          DC Challan <br>
                          <span >
                          
                            <b> </b>
                           
                           
                          </span>
                        </td>
                        <td colspan="4">
                          DC Date<br>
                          <span >
                          <b> </b>
                          </span>
                        </td>
                      </tr>


                      <tr>
                        <td colspan="4">
                          Eway BillNo:<br>
                          <span >
                            <b></b>
                          </span>
                        </td>
                        <td colspan="4">
                          Mode/Status Payment<br>
                          <span >
                          <?php  $options = array(
                            "invoice_id" => $id  
                            );

                        $list_data = $this->Invoice_payments_model->get_details($options)->result();// echo json_encode(  $list_data);
                           foreach($list_data as $payment_data){
                           echo "<b>".$payment_data->payment_method_title."/".number_format((float)$payment_data->amount, 2, '.', '')."</b>";
                           }?>
                          </span>
                        </td>
                      </tr>


                      <tr>
                        <td colspan="4">
                          Supplier's ref.<br>
                          <span >
                            <b></b>
                          </span>
                        </td>
                        <td colspan="4">
                          Other reference(s)<br>
                          <span >
                          <b></b>
                          </span>
                        </td>
                      </tr>


                      <tr>
                        <td colspan="4">
                          Buyer's Order No.<br>
                          <span >
                            <b></b>
                          </span>
                        </td>
                        <td colspan="4">
                          Dated<br>
                          <span >
                            <b></b>
                          </span>
                        </td>
                      </tr>



                      <tr>
                        <td colspan="4">
                          Despatched Through<br>
                          <span >
                          <b></b>
                          </span>
                        </td>
                        <td colspan="4">
                          Destination<br>
                          <span >
                            <b></b>
                          </span>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="8">
                          Despatch Document No.<br>
                          <span >
                            <b></b>
                          </span>
                        </td>
                      </tr>
                    <tr>
                    <td colspan="8">
                    <div id="extra">
                     <table style="width: 100%;max-width: 100%;">
                                <tr  >
                              <td><span class="ml15"> Weight slip no: <?php echo $invoice_info->weight_slip_no; ?></span></td>
                              <td><span class="ml15">Date:<?php echo $invoice_info->date; ?></span></td></tr>
                              <tr><td><span class="ml15">Empty Weight:<?php echo $invoice_info->empty_weight; ?></span></td>
                              <td><span class="ml15">Full Weight: <?php echo $invoice_info->full_weight; ?></span></td>
                              </tr>

                              <tr>
                              <td><span class="ml15">Job Weight: <?php echo $invoice_info->job_weight; ?></span></td>
                              <td><span class="ml15">Driver Name: <?php echo $invoice_info->driver_name; ?></span></td>
                              </tr>
                              <tr>
                              <td><span class="ml15">Vehicle No:  <?php echo $invoice_info->vechicle_no; ?></span></td>
                              <td><span class="ml15">Dr. Contact No: <?php echo $invoice_info->contact_no; ?></span></td>
                              </tr>
                              </table>
                           </div>
                    </td>
                    </tr>


                 
                  
                      
                   
                      <!-- if UPI Exist then only show this Row -->
                                              <tr style="display: none">
                        <td colspan="8" style="text-align: right;">
                          <b>Pay by UPI</b><br>

                          <img src="#" width="35%"><br>
                          webmagics.test@qr                          </td>
                      </tr>
                                              <!-- UPI Image show end -->


                  
                  </tbody></table>
                </span>
              </td>
            </tr>

            <tr>
              <!-- Bottom Half -->
             <!--changes consignee part-->
                <td colspan="4" >
                <b style="font-size:11px;"><?php echo $invoice_info->consigne_name; ?></b><br>
                <div style="line-height:13px;">
                <span style="font-size:11px;font-weight:100">
                <?php echo $invoice_info->consigne_add_line1." <br>";
                    echo $invoice_info->consigne_add_line2."<br>";
                    echo "Phone:".$invoice_info->phone_no."<br>";
                   echo "GSTIN:".$invoice_info->gstin;
                   
                   ?>
                </div>
                </td>
               <!--buyerpart-->            
                <td colspan="4" >
                <b style="font-size:11px;"><?php echo $client_info->company_name; ?></b><br>
                <div style="line-height:13px;">
                <span style="font-size:11px;font-weight:100">
                <?php echo $client_info->address." <br>";
                    echo $client_info->city."<br>";
                    echo "Phone:".$client_info->phone."<br>";
                   echo "GSTIN:".$client_info->tax_no;
                   
                   ?>
                </div>
                </td>
            </tr>




          
        </tbody></table>
    </th>
    </tr>

    

    <tr style="display:none">
      <td colspan="14">&nbsp; </td>
    </tr>
    <tr class="bg-sky"><!-- Colspan 10 -->
      <th colspan="1" class="text-center">Sl.No.</th>
      <th colspan="5" class="text-center">Description of Goods</th>
    
      <th colspan="2" class="text-center">Qty</th>
      <th colspan="2" class="text-center">Per</th>
      <th colspan="2" class="text-center">Rate</th>
      <th colspan="2" class="text-center">Discount</th>
      <th colspan="2" class="text-center">Amount</th>
    </tr>
</thead>
<tbody>

<?php $sno=0;$qty_column=0;$amount_column=0;$cgst_column=0;$sgst_column=0;$total_column=0; $tax5sum=0;$tax12sum=0;$tax18sum=0;$tax28sum=0;

$list_data = $this->Invoice_items_model->get_details(array("invoice_id" => $invoice_info->id ))->result();
foreach($list_data as $product_sale_data){

  $sno=$sno+1; 
  ?>  
  
 
               
<tr>
<td colspan="1"  class="text-center" style="width:1%;border:none;border-right:0.5px solid #A9A9A9;"><?php echo $sno;?></td>
    <td colspan="5" style="border:none;border-right:0.5px solid #A9A9A9;"><b><?php echo $product_sale_data->title?></b><br>
    <span><?php echo $product_sale_data->description?></span>
    
   
      </td>
  <?php $type = $product_sale_data->unit_type ? $product_sale_data->unit_type : "";?>
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;"><?php echo to_decimal_format($product_sale_data->quantity); ?></td>
   
    <?php  $qty_column=$qty_column+($product_sale_data->quantity) ?>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><?php echo $type?></td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><?php echo  to_currency($product_sale_data->rate, $product_sale_data->currency_symbol)?></td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><?php $total=$product_sale_data->quantity*$product_sale_data->rate; echo  ($product_sale_data->discount*100)/$total;echo "%";?></td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><?php echo     to_currency($product_sale_data->total, $product_sale_data->currency_symbol)?></td>
    <?php  $amount_column=$amount_column+$product_sale_data->total ?>
</tr>  

<?php }?>

 
        

</tbody>
<tfoot>





<tr style="height:100px;">
    <td colspan="1" style="width:1%;border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="5" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>      
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>

</tr> 



<tr>
    <td colspan="1" style="width:1%;border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="5" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>   
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td> 
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>   
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>   
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;border-top:0.5px solid #A9A9A9;"><?php echo to_currency(number_format((float)$amount_column, 2, '.', ''),$invoice_total_summary->currency_symbol) ;?></td>

</tr> 

<tr>
    <td colspan="1"  style="width:1%;border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="5" class="text-right"  style="border:none;border-right:0.5px solid #A9A9A9;"><b>GST</b></td>    
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>   
   
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b>9%</b></td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
<td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b><?php echo to_currency(($amount_column*9)/100, $invoice_total_summary->currency_symbol); ?></b></td>

</tr> 
<tr>
    <td colspan="1"  style="width:1%;border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="5" class="text-right"  style="border:none;border-right:0.5px solid #A9A9A9;"><b>SGST</b></td>   
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>    
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b>9%</b></td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
<td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b><?php echo to_currency(($amount_column*9)/100, $invoice_total_summary->currency_symbol); ?></b></td>

</tr> 

<?php 
$stax=($amount_column*9)/100;
$gtax=($amount_column*9)/100;
if ($invoice_total_summary->tax) { ?>
<tr>
    <td colspan="1"  style="width:1%;border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
     
    <td colspan="5" class="text-right"  style="border:none;border-right:0.5px solid #A9A9A9;"><b><?php echo $invoice_total_summary->tax_name; ?></b></td>    
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b></b></td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
<td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b><?php echo to_currency($invoice_total_summary->tax, $invoice_total_summary->currency_symbol); ?></b></td>

</tr> 
<?php }

 if ($invoice_total_summary->tax2) { ?>

<tr>
    <td colspan="1"  style="width:1%;border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
      
    <td colspan="5" class="text-right"  style="border:none;border-right:0.5px solid #A9A9A9;"><b><?php echo $invoice_total_summary->tax_name2; ?></b></td>  
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b></b></td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b><?php echo to_currency($invoice_total_summary->tax2, $invoice_total_summary->currency_symbol); ?></b></td>
    
</tr> 

<?php }

 if ($invoice_total_summary->tax3) { ?>

<tr>
    <td colspan="1"  style="width:1%;border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="5" class="text-right"  style="border:none;border-right:0.5px solid #A9A9A9;"><b><?php echo $invoice_total_summary->tax_name3; ?></b></td>  
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>   
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b></b></td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;"><b><?php echo to_currency($invoice_total_summary->tax3, $invoice_total_summary->currency_symbol); ?></b></td>
    
</tr> 
<?php }?>




<tr style="height: 40px;">
    <td colspan="1" style="width:1%;border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="5" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>   
    
    <td colspan="2" class="text-center" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>
    <td colspan="2" class="text-right" style="border:none;border-right:0.5px solid #A9A9A9;">&nbsp;</td>

</tr> 



<tr>

    <tr>
        <td colspan="1"></td>
       
        <td colspan="5" class="text-right" >Total</td>
        
        
        <td colspan="2" class="text-center"><?php echo number_format((float)$qty_column,2, '.', ''); ?></td>
        <td colspan="2" class="text-center" >&nbsp;</td>  
        <td colspan="2" class="text-right"></td>
        <td colspan="2" class="text-right"></td>
        <td colspan="2" class="text-right"><b><?php echo to_currency($invoice_total_summary->invoice_subtotal, $invoice_total_summary->currency_symbol); ?></b></td>
    
    </tr>  

   

  <tr>
      
    <td colspan="10" class="text-right">Order Discount:</td>
    
    
  <td colspan="6" class="text-right" ><?php echo to_currency($invoice_total_summary->discount_total, $invoice_total_summary->currency_symbol) ?></td>
    
</tr> 




<tr style="font-weight: 600">
      
  <td colspan="10" class="text-right">Grand Total:</td>
  
  
<td colspan="6" class="text-right" ><?php echo to_currency(($invoice_total_summary->invoice_total+$stax+$gtax), $invoice_total_summary->currency_symbol) ?>  </td>
  
</tr> 

  



<tr>

<!--//R.V_29_03S-->
<td colspan="8"  style="border:none;border-bottom:0.5px solid #A9A9A9;">
<span class="amt-in-word">Amount Chargable (in words):<br> <?php echo convert_number($invoice_total_summary->invoice_total+$stax+$gtax);?>
 Only</span>  
</td>
<!--//R.V_29_03E-->
<td colspan="8" class="text-right" style="border:none;border-bottom:0.5px solid #A9A9A9;">
    <span >E. & O.E</span>  
    </td>
</tr>



  <tr>
    <td colspan="8" class="text-left" style="border:none;">Company's PAN No. :<b> </b></td> 
    <td colspan="8" class="text-left" style="border:none;">Company's Bank Details.</td> 
    
  </tr>

  <tr>
    <td colspan="8" class="text-left" style="border:none;">Declaration:</td> 
   
    <td colspan="4" class="text-left" style="border:none;">Bank Name</td> 
    <td colspan="4" class="text-left" style="border:none;">:</td> 
    
  </tr>

  <tr>
    <td colspan="8" class="text-left" style="border:none;">We declare that this invoice shows the actual price of the</td> 
   
    <td colspan="4" class="text-left" style="border:none;">A/c No.</td> 
    <td colspan="4" class="text-left" style="border:none;">:</td> 
    
  </tr>

  <tr>
    <td colspan="8" class="text-left" style="border:none;">goods described and all particulars are true and correct.</td> 
   
    <td colspan="4" class="text-left" style="border:none;">Branch</td> 
    <td colspan="4" class="text-left" style="border:none;">:</td> 
    
  </tr>

  <tr>
    <td colspan="8" class="text-left" style="border:none;">Tax collected as per GST rule 32(5) of 2017</td> 
   
    <td colspan="4" class="text-left" style="border:none;">IFS Code</td> 
    <td colspan="4" class="text-left" style="border:none;">:</td> 
    
  </tr>






    <!-- T&C & Bank Details & signatories-->
    <tr >
      <td colspan="16">
        <table class="style_hidden fixed_table" width="100%">
         
            <tbody><tr>
              <td colspan="16">
                <span>
                  <table style="width: 100%;" class="style_hidden fixed_table">
                  
                      <!-- T&C & Bank Details -->
                      <tbody><tr>
                        <td colspan="16">
                          <span><b> Terms &amp; Conditions</b></span><br>
                          <span style="font-size: 11px;"> 
                            Interest will be charged if bills are not paid within the due date.<br>
                            We reserve lien on goods till full payment is made.<br>
                            </td>
                      </tr>


  <tr>
  <td colspan="4"> Customer Sign</td>
  <td colspan="4"> Prepared By</td>
  <td colspan="4"> Verified By </td>
  <td colspan="4"> Approved By</td>
  </tr>





                     
                   
                  </tbody></table>
                </span>
              </td>
            </tr>
         
        </tbody></table>
    </td>
    </tr>
    <!-- T&C & Bank Details & signatories End -->

        
    </tfoot>
</table>
<p class="text-center">Under Coimbatore Jurisdiction



</body>

</html>
<script>
$('#include_in').change(function(){
  if($(this).is(':checked')){
    document.getElementById('extra').style.display="block";
  
  }else{
    document.getElementById('extra').style.display="none";
  
  }
})
</script>