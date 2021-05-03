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

<?php
      $setprocessdata = array();
      $options = array();
      $options['work_order_id'] = $work_order_data->id;
      $options['wo_product_id'] = $wo_product_id;
      $setprocessdata = $this->Set_process_model->get_details($options)->result();
      $noofprocess = 0;

      if(count($setprocessdata) > 0){
          $noofprocess = $setprocessdata[0]->no_of_process;
      }
?>

<?php echo form_open(get_uri("set_process/save_set_process"), array("id" => "add-set-process-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="table-responsive">  
       <table class="table table-striped table-bordered">

       <tr>
          <td class="w30">Work Order</td><td class="w60">&nbsp;<?php echo $work_order_data->id; ?></td>
       </tr>


       <tr>
          <td class="w30">Date</td><td class="w60">&nbsp;<?php echo $work_order_data->date; ?></td>
       </tr>


       <tr>
          <td class="w30">Customer Name</td><td class="w60">&nbsp;<?php echo $customer_data->company_name; ?></td>
       </tr>

       <tr>
          <td class="w30">Notes</td><td class="w60">&nbsp;<?php echo $work_order_data->notes; ?></td>
       </tr>

       <tr>
          <td class="w30">Product Name</td><td class="w60">&nbsp;<?php echo $product_data->name; ?></td>
       </tr>


       <tr>
          <td class="w30">Product Type</td><td class="w60">&nbsp;<?php echo $product_type->name; ?></td>
       </tr>

       <tr>
        <td class="w30">No of process</td><td class="w60">
        <div class="form-group">
        
        <div class="col-md-9">
          <?php
        $process_array = array();

        $no_of_process_array=array();

        $no_of_process_array['-'] = ' - select- ';

        $process_array['-'] = ' - select no of process- ';

    for($i=1;$i<=count($process_list_data);$i++)
    {
      $process_array[$i] = $i;
    }

    foreach ($process_list_data as $key=>$value)
    {
      $no_of_process_array[$key] = $value;
    }
        
      //echo form_dropdown("no_of_process", $process_array,array() ,"class='form-control select2' id='no_of_process'");
        
        ?>

            <select name="no_of_process" class="form-control select2" id="no_of_process">
            <option value="">-- select number of processes --</option>
            <?php
            
                    foreach($process_list_data as $proc){
                      ?>
                          <option 
                            <?php
                                if($noofprocess){
                                  echo ($noofprocess == $proc->id) ? ' selected' : ''; 
                                }
                            ?>
                          value="<?php echo $proc->id; ?>"><?php echo  $proc->id; ?></option>
                      <?php
                    }
            ?>

            </select>


        </div>

    </div>

        
        
        </td>
       </tr>


       </table>     
    <?php
if(count($setprocessdata) > 0){
  ?>
  <input name="already_wo_id" type="hidden" value="<?php echo $work_order_data->id; ?>"> 
  <input name="already_ep_id" type="hidden" value="<?php echo $wo_product_id; ?> ">
  <?php
}else{
  ?>
  <input name="already_wo_id" type="hidden" value="0">
  <?php
}
    ?>


       <table class="table dynamic-input-table1" id="process-table">

  <thead>
    <tr>

      <th>End Product</th>
      <th>Process</th>
      <th>Vendor</th>
      <th>Unit</th>
      <th>Qty</th>
      <th>No Of Stages</th>

    </tr>
  </thead>

  <tbody>
    <?php
      if(count($setprocessdata) > 0){
          foreach($setprocessdata as $spd){
            ?>
            <tr>
              <td>
                  <select name="product_field[]" class="select2 form-control product-id" required>
                    <option value=""> -- Select One --</option>
                    <?php
                      foreach($product_list_data as $pld){
                        ?>
                          <option 
                          <?php
                          echo ($pld->id == $spd->end_product_id) ? ' selected' : '';
                          //echo ($pld->id == $wo_product_id) ? ' selected' : '';
                          ?>
                          value="<?php echo $pld->id; ?>"><?php echo $pld->name; ?></option>
                        <?php
                      }
                    ?>
                  </select>              
              </td>

              <td>
                  <select name="process_field[]" class="select2 form-control" required>
                    <option value=""> -- Select One --</option>
                    <?php
                      foreach($process_list_data as $plsd){
                        ?>
                          <option 
                          <?php
                          echo ($plsd->id == $spd->process_id) ? ' selected' : ''; ?>
                          
                          value="<?php echo $plsd->id; ?>"><?php echo $plsd->title; ?></option>
                        <?php
                      }
                    ?>
                  </select>              
              </td>

              <td>
                  <select name="vendor_field[]" class="select2 form-control" required>
                    <option value=""> -- Select One --</option>
                    <?php
                      foreach($supplier_list_data as $sd){
                        ?>
                          <option 
                          <?php
                          echo ($sd->id == $spd->vendor_id) ? ' selected' : ''; ?>
                          
                          value="<?php echo $sd->id; ?>"><?php echo $sd->name; ?></option>
                        <?php
                      }
                    ?>
                  </select>              
              </td>

              <td class="unit-name">
                   <?php
                        $product_data = $this->Products_model->get_one($spd->product_id);
                        $unit_data    = $this->Unit_model->get_one($product_data->purchase_unit_id);

                        if(count($unit_data) > 0){
                          echo $unit_data->name;
                        }
                   ?>
              </td>

              <td>
                <?php 
                    echo $work_order_detail[0]->qty;
                ?>                   
              </td>

              <td>
                  <select name="stages_field[]" class="select2 form-control" required>
                    <option value=""> -- Select One --</option>
                    <?php
                      foreach($stages_list_data as $sl){
                        ?>
                          <option 
                          <?php
                          echo ($sl->id == $spd->stages) ? ' selected' : ''; ?>
                          
                          value="<?php echo $sl->id; ?>"><?php echo $sl->title; ?></option>
                        <?php
                      }
                    ?>
                  </select>              
              </td>

          </tr>
            <?php
          }
          ?>
          
          <?php
      }

    ?>

    <tr>
     
      <td>    <?php
        $product_array = array();

        $product_array['-'] = ' - select - ';

        foreach ($product_list_data as $single_data)
    {
      $product_array[$single_data->id] = $single_data->name;
    }

       // echo form_dropdown("product_field", $product_array,array() ,"class='select2'");
        
        ?>
        </td>
      <td></td>
      <th>
      <?php
        $vendor_array = array();
        $vendor_array['-'] = ' - select - ';
        foreach ($supplier_list_data as $single_data)
        {
          $vendor_array[$single_data->id] = $single_data->name;
        }
        

       // echo form_dropdown("vendor_field", $vendor_array,array() ,"class='select2'");
        
        ?>
      
      </th>
      <th></th>
      <th></th>
      <th>
      
      <?php
        $stages_array = array();

        $stages_array['-'] = ' - select - ';

        for($i=1;$i<=count($stages_list_data);$i++)
     {
       $stages_array[$i] = $i;
     }

     //   echo form_dropdown("no_of_stages", $stages_array,array() ,"class='select2'");
        
        ?>
      </th>
     
    </tr>


  
  </tbody>
</table>
     

    

<input type="hidden" name="work_order_id" value="<?= $work_order_data->id; ?>"/>
<input type="hidden" name="wo_product_id" value="<?= $product_data->id; ?>"/>

  </div>
</div>

<div class="modal-footer">

    
    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>

    <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span>&nbsp;SAVE DETAIL&nbsp;</button>


   
</div>   
<?php echo form_close(); ?>
<script>
$( document ).ready(function() {


  $(".select2").select2();

  

 

  $("#no_of_process").select2().on("change", function () {

            var noOfProcess = $(this).val();

            $("table.dynamic-input-table1 tbody").html('');

            if ($(this).val()) {



            var dynamicInput ='';

           

            for (let i = 1; i <= $(this).val(); i++) { 
 
               dynamicInput += `<tr>
               
              <td><?php echo form_dropdown("product_field[]", $product_array,array($product_data->id) ,"class='select2 product-id form-control'");?></td>

              
              <td>
              <select name="process_field[]" class="select2 form-control" required>
                     <option value="">-select-</option>
              <?php
                  
                  foreach($process_list_data as $process){
                    ?>
                      <option value="<?= $process->id; ?>"><?= $process->title; ?></option>
                    <?php
                  }
              ?>
              </select>
              
              </td>

              <td><?php echo form_dropdown("vendor_field[]", $vendor_array,array() ,"class='select2 form-control' data-rule-required='true'");?></td>

              <td class='unit-name'><?php echo $unitdata->name; ?></td>
              <td><?php echo $work_order_detail[0]->qty; ?><input type='hidden' name='qty_field[]' value="<?php echo $work_order_detail[0]->qty; ?>" readonly></td>

              <td><?php echo form_dropdown("stages_field[]", $stages_array,array() ,"class='select2 form-control'");?></td>
              
              </tr>`;


}

$("table.dynamic-input-table1 tbody").append(dynamicInput);
            
}

        });  
});

$(document).on('change', '.product-id', function(){
   var productId = $(this).val();
   var row_index = $(this).closest("tr").index();
   $.ajax({
        type: 'GET',
        url: '<?php echo base_url(); ?>index.php/work_order/get_unit_data/'+productId,
        dataType: 'json',
        success: function(data) 
        {
          $('table.dynamic-input-table1 tbody tr:eq(' + row_index + ')').find('.unit-name').text(data.name);        
        }                   
    });
});
</script>