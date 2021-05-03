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


<?php echo form_open(get_uri("reuse/save_working_qty"), array("id" => "reuse-working-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="table-responsive">  
     Reuse Data
      <?php
                $clients_data = $this->Clients_model->get_one($work_order_info->customer_id);
                $client_name  = $clients_data->company_name;
      ?>


<input type="hidden" name="reuse_id" value="<?php echo $reuse_data->id ;?>">      

<input type="hidden" name="work_order_id" value="<?php echo $reuse_data->work_order_id ;?>">
<input type="hidden" name="process_product_id" value="<?php echo $process_product_data->id ;?>">
<input type="hidden" name="process_product_qty" value="<?php echo $reuse_data->end_product_qty ;?>">
     
       <table class="table table-striped table-bordered">
       <tr>
          <td class="w30">Reuse Id</td><td class="w60">&nbsp;<?php echo $reuse_data->id; ?></td>
       </tr>
       <tr>
          <td class="w30">Work Order Id</td><td class="w60">&nbsp;<?php echo $reuse_data->work_order_id; ?></td>
       </tr>

       <tr>
          <td class="w30">Product Name</td><td class="w60">&nbsp;<?php echo $process_product_data->name; ?></td>
       </tr>

       <tr>
          <td class="w30">Qty</td><td class="w60">&nbsp;<?php echo $reuse_data->end_product_qty; ?></td>
       </tr>

       </table>


       Reuse Details Data

       
       <table class="table table-striped table-bordered">
       <thead>
    <tr>
      <th>Product</th>
      <th>Total Qty</th>
      <th>Working Qty</th>
      <th>Wastage Qty</th>
      <th>Stage</th>
    </tr>
   </thead>
   <tbody>


   <?php 
   
   
   foreach($reuse_details_data as $data) {
       
       $product_data = $this->Products_model->get_one($data->product_id);
       
       $stage_data =$this->Set_stages_model->get_details(array("work_order_id"=>$reuse_data->work_order_id,"end_product_id"=>$reuse_data->process_product_id,"process_id"=>$reuse_data->process_id))->result();

if(count($stage_data)){

    $stage_detail= $stage_data[0]->stage_name ;
    

}else{

    $stage_detail= $data->stage_id ;

}

       ?>
    <input type="hidden" name="product_id[]" value="<?php echo $product_data->id ;?>">

    <input type="hidden" name="product_qty[]" value="<?php echo $data->working_qty ;?>">

   <tr>

       <td><?php echo $product_data->name; ?></td>
       <td><?php echo $data->total_qty ?></td>
       <td><?php echo $data->working_qty ?></td>
       <td><?php echo $data->wastage_qty ?></td>
       <td><?php echo  $stage_detail; ?></td>

    </tr>

   <?php } ?>

   </tbody>

       </table>
    
  </div>
</div>

<div class="modal-footer">
  



<?php if( $reuse_data->status == 0){?>


  
    <input type="submit" class="btn btn-md btn-primary" name="wastage_button" value="To Wastage" >

    <input type="submit" class="btn btn-md btn-warning" name="main_store_button" value="To Transfer" >

    

    <!-- <a href="<?= base_url(); ?>index.php/work_order/create/<?= $reuse_data->id; ?>">
        <button type="button" class="btn btn-md btn-info">To Work Order</button>
    </a>  -->
    
    <input type="submit" class="btn btn-md btn-info" name="work_order_button" value="To Work Order" >

<?php }else if($reuse_data->status == 1){?>

    <input type="button" class="btn btn-md btn-primary" disabled value="Sent To Wastage" >

<?php }else if($reuse_data->status == 2){?>

    <input type="button" class="btn btn-md btn-warning" disabled value="Sent To Main Store" >

<?php }else if($reuse_data->status == 3){?>

    <input type="button" class="btn btn-md btn-info"  disabled value="Sent To Work Order " >

    <?php }else{?>

        <input type="button" class="btn btn-md btn-danger" disabled value="Unknown Operation" >

    <?php }?>
    
     <!-- AG2903 -->

    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
</div>   

<?php echo form_close(); ?>