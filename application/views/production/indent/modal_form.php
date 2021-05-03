<!-- AG2103Q -->

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

    .modal .modal-dialog {
        width: 80%;
    }

</style>
<div class="modal-body clearfix">
    <div class="table-responsive" id="intent_details">  <button id="print-btn" type="button" class="btn btn-default btn-sm " style="margin-bottom:5px"><i class=" fa fa-print"></i> Print</button> 
      Indent Detail<br /> <br />  
       <table class="table table-striped table-bordered">
       <tr>
          <td class="w30">Work Order Number</td><td class="w60">&nbsp;<?php echo $model_data->work_order_id; ?></td>
       </tr>
       <tr>
          <td class="w30">From ( Warehouse )</td><td class="w60">&nbsp;
              
          <?php 
          
          $warehouse_data = $this->Warehouse_model->get_one($model_data->warehouse_id);
          $warehouse_name = $warehouse_data->name;

          echo $warehouse_name;
          
          ?></td>
       </tr>
       <tr>
          <td class="w30">Vendor Name</td><td class="w60">&nbsp;
              
          <?php 
          
          $vendor_data = $this->Vendor_model->get_one($model_data->vendor_id);
          $vendor_name = $vendor_data->name;

          echo $vendor_name;
          
          ?></td>
       </tr>
       <tr>
          <td class="w30">Created Date & Time</td><td class="w60">&nbsp;<?php echo $model_data->created_at; ?></td>
       </tr>
       </table>
       Products Detail
       <br />
       <br />

        <table class="table table-striped table-bordered">
        <tr>
                <th class="text-left">Sno</th><th class="text-left">Product Code</th><th class="text-left">Product Name</th><th class="text-right">Quantity</th>
        </tr>
            <?php
                $options              = array();
                $options['indent_id'] = $model_data->id;
                $indent_details       = $this->Indent_details_model->get_details($options)->result();

                $sno = 1;
                foreach($indent_details as $detail){
                    $product_data = $this->Products_model->get_one($detail->product_id);
                    $product_name = $product_data->name;
                    ?>
                    <tr>
                        <td class="text-left"><?= $sno; ?></td>
                        <td class="text-left"><?= $product_data->code; ?></td>
                        <td class="text-left"><?= $product_name; ?></td>
                        <td class="text-right"><?= $detail->qty; ?></td>
                    </tr>
                    <?php
                    $sno += 1;
                }
            ?>
        </table>
  </div>
</div>

<div class="modal-footer">

    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
<?php
        if($dcrecordstatus == 0 ){
            if($warehouse_id != 7){
?>
    <a href="<?php echo base_url(); ?>index.php/production_dc_outward/indent_to_dc_outward/<?= $work_order_id.'/'.$bom_id.'/'.$warehouse_id.'/'.$model_data->id; ?>">
        <button type="button" class="btn btn-primary"><span class="fa fa-shopping-basket"></span>&nbsp;DC Outward</button>
    </a>

    <?php
            }
        }
    ?>

</div>
<!--changes 29-3-->
<script type="text/javascript">
$("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('intent_details');
        
                     document.body.innerHTML = divToPrint.innerHTML; 
                    $("html").css({"overflow": "visible"});

                    setTimeout(function () {
                        window.print();
                    }, 200);
          
    });

    window.onafterprint = function () {
        location.reload();
    };

</script>