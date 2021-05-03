<style>
    .modal-body{
        min-width: 100%;
    }
    .table-responsive{
        font-weight: 600;
    }

    .w30{
        width: 30%;
    }

    .w60{
        width: 60%;
    }
</style>
<div class="modal-body clearfix">
    <div class="table-responsive" id="details">    <button id="print-btn" type="button" class="btn btn-default btn-sm " style="margin-bottom:5px"><i class=" fa fa-print"></i> Print</button> 
     DC outward Detail<br /> <br />        
       <table class="table table-striped table-bordered">
       <?php if($model_info->dc_type == 1){ $type="Transfer";}else if($model_info->dc_type == 2){$type="Returnable";}else if($model_info->dc_type == 3){$type="GRN";}?>

       <?php if($model_info->delivery_type == 1){ $delivery_type="Courier";}else if($model_info->delivery_type == 2){$delivery_type="Parcel";}else if($model_info->delivery_type == 3){$delivery_type="Direct";}?>
       <tr>
          <td class="w30">DC Type</td><td class="w60">&nbsp;<?php echo $type; ?></td>
       </tr>

       <tr>
          <td class="w30">DC No</td><td class="w60">&nbsp;<?php echo $model_info->dc_no; ?></td>
       </tr>

       <tr>
          <td class="w30">DC Date</td><td class="w60">&nbsp;<?php echo $model_info->dc_date; ?></td>
       </tr>

       <tr <?php if($model_info->dc_type == 2){ ?> style="display:none" <?php }?>>
          <td class="w30">Work order  Number</td><td class="w60">&nbsp;<?php echo $model_info->work_order_no; ?></td>
       </tr>

       <tr <?php if($model_info->dc_type == 2 ||$model_info->dc_type == 3  ){ ?> style="display:none" <?php }?> >
          <td class="w30">Work order Date </td><td class="w60">&nbsp;<?php echo $model_info->work_order_date; ?></td>
       </tr>
       <tr <?php if($model_info->dc_type == 2 ||$model_info->dc_type == 3  ){ ?> style="display:none" <?php }?> >
          <td class="w30">Sales order  Number</td><td class="w60">&nbsp;<?php echo $model_info->sale_order_number; ?></td>
       </tr>

       <tr <?php if($model_info->dc_type == 3  ){ ?> style="display:none" <?php }?>>
       <?php 
         $warehouse_data = $this->Warehouse_model->get_one($model_info->from_warehouse);
         $warehouse_name_from = $warehouse_data->name;
       ?>
          <td class="w30">From Warehouse</td><td class="w60">&nbsp;<?php echo  $warehouse_name_from ; ?></td>
       </tr>
     
       <tr <?php if($model_info->dc_type == 2 ){ ?> style="display:none" <?php }?>>
       <?php 
         $warehouse_data = $this->Warehouse_model->get_one($model_info->to_warehouse);
         $warehouse_name_to= $warehouse_data->name;
       ?>
          <td class="w30">To Warehouse</td><td class="w60">&nbsp;<?php echo $warehouse_name_to ; ?></td>
       </tr>

       <tr>
       <?php 
         $sname = $this->Users_model->get_one($model_info->shop_keeper_name);
         $name= $sname->first_name.' '.$sname->last_name;;
       ?>
          <td class="w30">Shop Keeper Name</td><td class="w60">&nbsp;<?php echo $name; ?></td>
       </tr>

       <tr <?php if($model_info->dc_type == 2 ||$model_info->dc_type == 3  ){ ?> style="display:none" <?php }?> >
       <?php 
         $sname = $this->Users_model->get_one($model_info->process_incharge);
         $name= $sname->first_name.' '.$sname->last_name;;
       ?>
          <td class="w30">Process Incharge</td><td class="w60">&nbsp;<?php echo $name; ?></td>
       </tr>
          

       <tr <?php if($model_info->dc_type == 3  ){ ?> style="display:none" <?php }?>>
     
          <td class="w30">Recievername</td><td class="w60">&nbsp;<?php echo $model_info->reciever_name; ?></td>
       </tr>


       <tr <?php if($model_info->dc_type == 2  ){ ?> style="display:none" <?php }?>>
       <?php 
         $sname = $this->Clients_model->get_one($model_info->customer_name);
         $name= $sname->company_name;
       ?>
          <td class="w30">Customer Name</td><td class="w60">&nbsp;<?php echo $name; ?></td>
       </tr>

       <tr>
       <?php 
         $sname = $this->Supplier_model->get_one($model_info->vendor);
         $name= $sname->name;
       ?>
          <td class="w30">vendor</td><td class="w60">&nbsp;<?php echo $name; ?></td>
       </tr>
       
       <tr>
          <td class="w30">Delivery Type</td><td class="w60">&nbsp;<?php echo $delivery_type; ?></td>
       </tr>
       <tr>
          <td class="w30">Reference</td><td class="w60">&nbsp;<?php echo $model_info->reference; ?></td>
       </tr>
       <tr <?php if($model_info->dc_type == 2 ||$model_info->dc_type == 3  ){ ?> style="display:none" <?php }?>  >
          <td class="w30">Reference Number</td><td class="w60">&nbsp;<?php echo $model_info->reference_no; ?></td>
       </tr>
       <tr>
          <td class="w30">Vehicle</td><td class="w60">&nbsp;<?php echo $model_info->vehicle_name; ?></td>
       </tr>
       <tr>
          <td class="w30">Vehicle Number</td><td class="w60">&nbsp;<?php echo $model_info->vehicle_no; ?></td>
       </tr>
       </table>
       Purchase Products Detail
       <br />
       <br />

       <?php
            $options = array();
            $options['outward_id']      =$model_info->id ;
            $product_purchase_data = $this->Dc_outward_details_model->get_details($options)->result();
       ?>

    <table class="table table-striped table-bordered">
       <tr>
       <th class="text-center">Sno</th><th>Name</th><th class="text-center">Quantity</th><th class="text-center">Unit</th><th class="text-right">Net unit cost</th><th class="text-right">Tax</th>
       <th class="text-right">Discount</th><th class="text-right">Total</th>
       </tr>

        <?php
            $total_tax      = 0;
            $total_discount = 0;
            $total_total    = 0;
            $sno = 1;
            foreach($product_purchase_data as $bdata){
                $prd_data     = $this->Products_model->get_one($bdata->product_id);
                $product_name = $prd_data->name;

                $unit_data    = $this->Unit_model->get_one($bdata->purchase_unit_id);
                $unit_name    = $unit_data->name;
                ?>
                <tr>
                    <td class="text-center">
                        <?= $sno; ?>
                    </td>
                    <td>
                        <?= $product_name; ?>
                    </td>
                    <td class="text-center">
                        <?= $bdata->qty; ?>
                    </td>
                    <td class="text-center">
                        <?= $unit_name; ?>
                    </td>
                    <td class="text-right">
                        <?= $bdata->net_unit_cost; ?>
                    </td>
                    <td class="text-right">
                        <?= $bdata->tax; ?>
                        <?php $total_tax += $bdata->tax; ?>
                    </td>
                    <td class="text-right">
                        <?= $bdata->discount; ?>
                        <?php $total_discount += $bdata->discount; ?>
                    </td>
                    <td class="text-right">
                        <?= $bdata->total; ?>
                        <?php $total_total += $bdata->total; ?>
                    </td>
                </tr>
                <?php
                $sno += 1;
            }
        ?>
        <tr>
            
            <td colspan="5"></td>
            <td class="text-right"><?php echo number_format($total_tax,2); ?></td>
            <td class="text-right"><?php echo number_format($total_discount,2); ?></td>
            <td class="text-right"><?php echo number_format($total_total,2 ); ?></td>
        </tr>

    </table>


  </div>
</div>

<div class="modal-footer">

    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>

    <a href="purchase_order/edit/<?php echo $model_info->id; ?>">
        <button type="button" class="btn btn-primary"><span class="fa fa-pencil"></span>&nbsp;Edit</button>
    </a>
</div>   

<script type="text/javascript">
$("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('details');
        /*  console.log(divToPrint);
        var WinPrint=window.open('','','');
        WinPrint.document.write(divToPrint.innerHTML);
        WinPrint.document.close();
        WinPrint.print();
        setTimeout(function(){newWin.close();},10);*/
                     document.body.innerHTML = divToPrint.innerHTML; //add invoice's print view to the page
                    $("html").css({"overflow": "visible"});

                    setTimeout(function () {
                        window.print();
                    }, 200);
          
    });

    window.onafterprint = function () {
        location.reload();
    };

</script>