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
     Purchase Request Details<br /> <br />        
       <table class="table table-striped table-bordered">
       <tr>
          <td class="w30">PR No</td><td class="w60">&nbsp;<?php echo $model_info->prno; ?></td>
       </tr>

       <tr>
          <td class="w30">Date</td><td class="w60">&nbsp;<?php echo $model_info->date; ?></td>
       </tr>

       <tr>
       <?php
            $warehouse_data = $this->Warehouse_model->get_one($model_info->warehouse_id);
            $warehouse_name = $warehouse_data->name;
          ?>
          <td class="w30">Warehouse</td><td class="w60">&nbsp;<?php echo  $warehouse_name; ?></td>
       </tr>

       <tr>
       <?php
            $user_data = $this->Customer_model
            ->get_one($model_info->user_id);
            $user_name = $user_data->name;
          ?>
          <td class="w30">User</td><td class="w60">&nbsp;<?php echo $user_name; ?></td>
       </tr>
       
       </table>
       Purchase Products Detail
       <br />
       <br />

       <?php
            $options = array();
            $options['purchase_request_id'] = $model_info->id;//changes 23-3
            $product_purchase_data = $this->Purchase_request_details_model->get_details($options)->result();
       ?>

    <table class="table table-striped table-bordered">
       <tr>
       <th class="text-center">Sno</th><th>Name</th><th class="text-center">Quantity</th><th class="text-center">Unit</th><th class="text-center">Client</th>
       <th>Remarks</th>
       </tr>

        <?php
            $total_tax      = 0;
            $total_discount = 0;
            $total_total    = 0;
            $sno = 1;
            foreach($product_purchase_data as $bdata){
                $prd_data     = $this->Products_model->get_one($bdata->product_id);
                $product_name = $prd_data->name;
              
                $customer_data = $this->Clients_model->get_one($bdata->supplier_id);
                $customer_name = $customer_data->company_name;
                $unit_data    = $this->Unit_model->get_one($prd_data ->unit_id);//changes 23-3
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
                    <td class="text-center">
                        <?= $customer_name ; ?>
                    </td>
                    <td><?php echo $bdata->remarks?></td>
                    
                </tr>
                <?php
                $sno += 1;
            }
        ?>
        <!--<tr>
            
            <td colspan="5"></td>
            <td class="text-right"><?php echo number_format($total_tax,2); ?></td>
            <td class="text-right"><?php echo number_format($total_discount,2); ?></td>
            <td class="text-right"><?php echo number_format($total_total,2 ); ?></td>
        </tr>-->

    </table>


  </div>
</div>

<div class="modal-footer">

    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>

    <a href="purchase_request/edit/<?php echo $model_info->id; ?>">
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