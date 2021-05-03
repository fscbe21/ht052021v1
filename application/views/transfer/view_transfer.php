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
<div class="modal-body clearfix" >
    <div class="table-responsive" id="sale_details">  
    <div class="col-md-3"><button id="print-btn" type="button" class="btn btn-default btn-sm " style="margin-bottom:5px"><i class=" fa fa-print"></i> Print</button> </div>  <div class="col-md-6 text-center" > Transfer Detail </div>
       <table class="table table-striped table-bordered">
       
       <tr>
          <td class="w30">Transfer Reference No</td><td class="w60">&nbsp;<?php echo $model_info->reference_no; ?></td>
       </tr>
       <tr>
          <?php
            $warehouse_data = $this->Warehouse_model->get_one($model_info->from_warehouse_id);
            $warehouse_name = $warehouse_data->name;
          ?>
          <td class="w30">From Warehouse Name</td><td class="w60">&nbsp;<?php echo $warehouse_name; ?></td>
       </tr>

       </tr>
       <tr>
          <?php
            $warehouse_data = $this->Warehouse_model->get_one($model_info->to_warehouse_id);
            $warehouse_name = $warehouse_data->name;
          ?>
          <td class="w30">To Warehouse Name</td><td class="w60">&nbsp;<?php echo $warehouse_name; ?></td>
       </tr>
      
       <tr>
       <?php
            $user_data = $this->Users_model->get_one($model_info->user_id);
            $creator_name = $user_data->first_name.' '.$user_data->last_name;
          ?>
          <td class="w30">Created by</td><td class="w60">&nbsp;<?php echo $creator_name; ?></td>
       </tr>
       <tr>
          <td class="w30">Created at</td><td class="w60">&nbsp;<?php echo $model_info->created_at; ?></td>
       </tr>
       <tr>
          <td class="w30">Updated at</td><td class="w60">&nbsp;<?php echo $model_info->updated_at; ?></td>
       </tr>
       <tr>
       <?php 
       
       if($model_info->sale_status==1){
           $satus="Completed";
       }else if($model_info->sale_status==2){
        $satus="Pending";
       }else if($model_info->sale_status==3){
        $satus="Sent";
       } ?>
       <td class="w30">Sales Status</td><td class="w60">&nbsp;<?php echo $satus; ?></td>
       </tr>
       </table>
       <div class="col-md-12 text-center" >  Transfer Products Detail</div>
       

       <?php
            
            $product_sales_data = $this->ProductTransfer->transfer_product_list($model_info->id);
       ?>

    <table class="table table-striped table-bordered">
       <tr>
       <th class="text-center">Sno</th><th>Name</th><th class="text-center">Quantity</th><th class="text-center">Unit</th><th class="text-right">Net unit cost</th><th class="text-right">Tax</th>
       <th class="text-right">Total</th>
       </tr>

        <?php
            $total_tax      = 0;
            $total_discount = 0;
            $total_total    = 0;
            $sno = 1;
            foreach($product_sales_data as $bdata){
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
                        <?php echo"(".$bdata->tax_rate."%)"?>
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
         
            <td class="text-right"><?php echo number_format($total_total,2 ); ?></td>
        </tr>
      
        <tr>
            <td colspan="6">Shipping Cost</td>                
            <td class="text-right"><?php  echo $model_info->shipping_cost;?></td>    
        </tr>
        <tr>
            <td colspan="6">Grand Total</td>                
            <td class="text-right"><?php  echo $model_info->grand_total;?></td>    
        </tr>
        
       
               

    </table>

        <table class="table table-bordered">
        <tr>
                            <td  class="w30">Note</td>                             
                             <td class="w60 text-right"><?php  echo ($model_info->note);?></td>    
        </tr>
      
        </table>
  </div>
</div>

<div class="modal-footer">

    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>

    <a href="sales/edit/<?php echo $model_info->id; ?>">
        <button type="button" class="btn btn-primary"><span class="fa fa-pencil"></span>&nbsp;Edit</button>
    </a>
</div>   

<script type="text/javascript">
$("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('sale_details');
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