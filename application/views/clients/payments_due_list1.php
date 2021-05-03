<!-- ag -->
<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
       
         <h4 class="pl15 pt10 pr15"><?php echo lang("payments_due"); ?></h4>
         <hr>


         <div class="container" style="padding: 30px;">
                <button id="print" class="btn btn-md btn-primary"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print</button>
         </div>


        <div class="tab-content" id="printable_area">
           <div class="form-group col-md-12">
              <div class="col-md-6">
              <style>
                    .firstTable {
                        font-family: Arial, Helvetica, sans-serif;
                        border-collapse: collapse;
                        width: 750px;
                    }
                    .firstTable td, #customers th {
                                border: 1px solid #ddd;
                            }
                </style>
                <table class="table table-striped table-hovered firstTable">
                     <tr>
                            <td colspan="3" align="center"><img src="<?php echo get_logo_url(); ?>"/></td>
                    </tr>
                    <tr>
                            <td colspan="3" align="center"><h5><b><?php echo date('d-m-Y'); ?></b></h5></td>
                    </tr>
                    <tr>
                            <td style="width: 4%" align="center"><h6><b>SL</b></h6></td>
                            <td align="center"><h6><b>COMPANY NAME</b></h6></td>
                            <td align="center"><h6><b>TOTAL</b></h6></td>
                    </tr>

                    <?php 
                        $ci =& get_instance();
                        $data = $ci->Clients_model->get_details()->result();
                        $i = 1;

                        $client_owners = array();
                        $clients_list  = array();
                        $due_amount    = array();
                        $due_date      = array();
                        $days          = array();
                        $total_due = 0;

                        foreach($data as $d){
                            if($d->deleted == 0){
                                $total_invoice_amount = 0;
                                $payment_received = 0;
                                $options1 = array();
                                $options1['client_id'] = $d->id;
                                $invoice_data = $ci->Invoices_model->get_details($options1)->result();
                                foreach($invoice_data as $idata){
                                    $options2 = array();
                                    $options2['invoice_id'] = $idata->id;
                                    $invoice_items_data  = $ci->Invoice_items_model->get_details($options2)->result();
                                    foreach($invoice_items_data as $itdata){
                                        $total_invoice_amount += $itdata->total;
                                    }

                                    $options3 = array();
                                    $options3['invoice_id'] = $idata->id;

                                    $payments_data  = $ci->Invoice_payments_model->get_details($options3)->result();
                                    foreach($payments_data as $pdata){
                                        $payment_received += $pdata->amount;
                                    }
                                }

                                $due = $total_invoice_amount - $payment_received;

                            if($due > 0){
                               
                               $clients_list[]  = $d->id;
                               $due_amount[]    = $due;
                               $due_date[]      = $d->payment_due_date;

                               $total_due += $due;

                                if (! in_array($d->owner_id, $client_owners))
                                {
                                    $client_owners[] = $d->owner_id;
                                }

                                $payment_due_date = $d->payment_due_date;

                                if($payment_due_date  >= strtotime("today"))
                                {
                                    $days[] = 0;
                                }
                                else
                                {
                                    $now = time();
                                    $your_date = strtotime($payment_due_date);
                                    $datediff = $now - $your_date;
                                    $days[] =  round($datediff / (60 * 60 * 24));
                                }
                            ?>
                            <tr>
                            <td align="center"><b><?php echo $i; ?></b></td>
                            <td align="center"><b><?php echo $d->company_name; ?></b></td>
                            <td align="center"><b><?php echo $due; ?></b></td>
                    </tr>
                            <?php
                            $i++;
                            }
                        }
                    }
                    
                    ?>
                    <tr><td colspan="3">&nbsp;</td></tr>
                    <tr>
                        <td colspan="2"><b>TOTAL</b></td>
                        <td align="center"><b><?php echo $total_due; ?></b></td>
                    </tr>

                </table>
                <br />
 </div>
                <br/>
                <div style="padding: 10px;">
                <table class="table table-striped table-hovered firstTable">
                    <tr>
                        <td style="width: 4%"><b>Sl</b></td>
                        <td><b>Name</b></td>
                        <td><b>Below-30 Days</b></td>
                        <td><b>31-60 Days</b></td>
                        <td><b>61-90 Days</b></td>
                        <td><b>91-120 Days</b></td>
                        <td><b>121-150 Days</b></td>
                        <td><b>Above-151 Days</b></td>
                        <td><b>TDS</b></td>
                        <td><b>Total</b></td>
                    </tr>
                     <?php 
                        $ci =& get_instance();
                        $data = $ci->Clients_model->get_details()->result();
                        $i = 1;

                        $client_owners = array();
                        $clients_list  = array();
                        $due_amount    = array();
                        $due_date      = array();
                        $days          = array();
                        $total_due = 0;
                         
                        foreach($data as $d){
                            if($d->deleted == 0){
                                $total_invoice_amount = 0;
                                $payment_received = 0;
                                $options1 = array();
                                $options1['client_id'] = $d->id;
                                $invoice_data = $ci->Invoices_model->get_details($options1)->result();
                               
                                foreach($invoice_data as $idata){
                                    $options2 = array();
                                    $options2['invoice_id'] = $idata->id;
                                    $invoice_items_data  = $ci->Invoice_items_model->get_details($options2)->result();
                                    foreach($invoice_items_data as $itdata){
                                        $total_invoice_amount += $itdata->total;
                                    }

                                    $options3 = array();
                                    $options3['invoice_id'] = $idata->id;

                                    $payments_data  = $ci->Invoice_payments_model->get_details($options3)->result();
                                    foreach($payments_data as $pdata){
                                        $payment_received += $pdata->amount;
                                    }                           
                                }

                                $due = $total_invoice_amount - $payment_received;
                                $total_due += $due;

                                $days30_total = $days60_total = $days90_total = $days120_total = 0;
                                $days150_total = $days151_total = $days152_total =  0;
                          
                            if($due>0){
                                $due_date_data =   date('d-m-Y',strtotime( $idata->due_date));
                                $due_date     =   strtotime($due_date_data);
                                $date =   date('d-m-Y');
                                $current_date     =   strtotime($date);
                                $total_due_date   =   ($current_date - $due_date)/60/60/24;
                                
                                $days30 = $days60  = $days90 = $days120 = $days150 = $days152 = 0;
                                $total_amount = 0;

                                if($total_due_date <= 30)
                                {
                                    $days30       = $due;
                                    $days30_total += $due;
                                }
                                else if(($total_due_date > 30) && ($total_due_date <= 60))
                                {
                                    $days60       = $due;
                                    $days60_total += $due;
                                }
                                else if(($total_due_date > 60) && ($total_due_date <= 90))
                                {
                                    $days90       = $due;
                                    $days90_total += $due;
                                }
                                else if(($total_due_date > 90) && ($total_due_date <= 120))
                                {
                                    $days120       = $due;
                                    $days120_total += $due;
                                }
                                else if(($total_due_date > 120) && ($total_due_date <= 150))
                                {
                                    $days150       = $due;
                                    $days150_total += $due;
                                }
                                else if($total_due_date > 151)
                                {
                                    
                                    $days152       = $due;
                                    $days152_total += $due;
                                }
                                else 
                                { 
                                    $day = 0;
                                    $days151_total += $due;
                                }
                            ?>
                            <tr>
                            <td align="center"><b><?php echo $i; ?></b></td>
                            <td align="center"><?php echo $d->company_name; ?></td>
                            <td align="center"><?php echo $days30; ?></td>
                            <td align="center"><?php echo $days60; ?></td>
                            <td align="center"><?php echo $days90; ?></td>
                            <td align="center"><?php echo $days120; ?></td>
                            <td align="center"><?php echo $days150; ?></td>
                            <td align="center"><?php echo $days152; ?></td>
                            <td align="center">0</td>
                            <td align="center"><b><?php echo $due; ?></b></td>
                            </tr>
                            <?php
                            $i++;
                            }
                        }
                    }
                    ?>
                     <tr><td colspan="10">&nbsp;</td></tr>
                <tr>
                    
                    <td colspan="2"><b>TOTAL</b></td>
                    <td><b><?php echo $days30_total; ?></b></td>
                    <td><b><?php echo $days60_total; ?></b></td>
                    <td><b><?php echo $days90_total; ?></b></td>
                    <td><b><?php echo $days120_total; ?></b></td>
                    <td><b><?php echo $days150_total; ?></b></td>
                    <td><b><?php echo $days152_total; ?></b></td>
                    <td>0</td>
                    <td><b><?php echo $total_due; ?></b></td></tr>
                
            </table>
                    </div>
             
            </div>
            
        </div>



    </div>
</div>

<script type="text/javascript">
    $(document).on('click','#print', function(){
        var prtContent = document.getElementById("printable_area");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });
        
    </script>