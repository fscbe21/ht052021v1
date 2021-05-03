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
    <div class="table-responsive" id="purchase_details">   <button id="print-btn" type="button" class="btn btn-default btn-sm " style="margin-bottom:5px"><i class=" fa fa-print"></i> Print</button> 
     Purchase Detail<br /> <br />        
       <table class="table table-striped table-bordered">
       <tr>
          <td class="w30">Purchase Reference No</td><td class="w60">&nbsp;<?php echo $model_info->reference_no; ?></td>
       </tr>
       <tr>
          <?php
            $warehouse_data = $this->Warehouse_model->get_one($model_info->warehouse_id);
            $warehouse_name = $warehouse_data->name;
          ?>
          <td class="w30">Warehouse Name</td><td class="w60">&nbsp;<?php echo $warehouse_name; ?></td>
       </tr>
       <tr>
         <?php
            $supplier_data = $this->Supplier_model->get_one($model_info->supplier_id);
            $supplier_name = $supplier_data->name;
          ?>
          <td class="w30">Supplier Name</td><td class="w60">&nbsp;<?php echo $supplier_name; ?></td>
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
       </table>
       Purchase Products Detail
       <br />
       <br />

       <?php
            $options = array();
            $options['purchase_id'] = $model_info->id;
            $product_purchase_data = $this->Productpurchase_model->get_details($options)->result();
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

    <a href="purchase/edit/<?php echo $model_info->id; ?>">
        <button type="button" class="btn btn-primary"><span class="fa fa-pencil"></span>&nbsp;Edit</button>
    </a>
</div>   
<script type="text/javascript">
$("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('purchase_details');
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