<style>
#search{
    min-height: 50px;
    border: 1px solid #2c3e50;
}
</style>
<div class="p20 panel panel-default">
 

     <div class="page-title clearfix">
        <h4>Reuse</h4>
        <div class="title-button-group">

        </div>
    </div>
    <br />
    <?php echo form_open(get_uri("reuse/save"), array("id" => "reuse-form", "class" => "general-form", "role" => "form")); ?>
    
<input type="hidden" name="work_order_id" value="<?php echo $work_order_id;?>" >

<input type="hidden" name="process_product_id" value="<?php echo $product_id;?>" >

<input type="hidden" name="process_id" value="<?php echo $process_id;?>" >


<input type="hidden" name="end_product_id" value="<?php echo $end_product_id;?>" >

<input type="hidden" name="process_product_qc_ok_qty" value="<?php echo number_format((float)$qc_ok_qty, 2, '.', '');?>">
                             



    <div class="row">

        <div class="col-md-3" >
            <div class="form-group">
                <label for="bom_id" >BOM No.</label>
                <input  type="text" name="bom_id" class="form-control" value="<?php echo $bom_data->id;?>" readonly>
            </div>
        </div>


        
        <div class="col-md-3" >
            <div class="form-group">
                <label for="bom_name" >BOM Name</label>
                <input  type="text" name="bom_name" class="form-control" value="<?php echo $bom_data->name;?>" readonly>
            </div>
        </div>


          
        <div class="col-md-3" >
            <div class="form-group">
                <label for="end_product" >End Product - Semi/Finished Goods</label>
                <input  type="text" name="end_product" class="form-control" value="<?php echo $end_product_data->name;?>" readonly>
            </div>
        </div>


              
        <div class="col-md-3" >
            <div class="form-group">
                <label for="qty" >Qty</label>

                <input  type="number" name="qty"  readonly class="form-control" min=0 max="<?php echo $qty;?>" value="<?php echo $qty;?>">

            </div>
        </div>


    </div>


         
    <div class="row">                   
    

        <div class="col-md-12"> 
            <div class="table-responsive">
                <table id="myTable" class="table table-hover order-list" >
                    <thead>

                        <tr>

                            <th>Name</th>
                            <th>Code</th>
                            <th>Qty</th>
                            <th>Total Qty</th>
                            <th>Working Qty</th>
                            <th>Wastage</th>
                            <th>Stages</th>
                        
                        </tr>
                        
                    </thead>
                    <tbody id="order-table">
                    <?php 
                       foreach($bom_details_data as $single_data){


                           $product_data = $this->Products_model->get_one($single_data->product_id);
                                                     ?>
                           <tr class="tr-class">

                                <td><?= $product_data->name; ?></td>

                                <td>

                                <input type="hidden" name="product_id[]" value="<?php echo $product_data->id;?>">

                                <input type="hidden" name="total_qty[]" value="<?php echo number_format((float)$single_data->product_qty*$qty, 2, '.', '');?>">

                                <input type="hidden" name="qc_ok_total_qty[]" value="<?php echo number_format((float)$single_data->product_qty*$qc_ok_qty, 2, '.', '');?>">
                                
                              
                               
                            
                                <?= $product_data->code; ?>
                                
                                
                                </td>

                                <td class="qty-class"><?php echo number_format((float)$single_data->product_qty, 2, '.', '');?></td>
                           
                                <td class="total-qty-class">
                                <?php echo number_format((float)$single_data->product_qty*$qty, 2, '.', '');?>
                                </td>

                                <td><input class="working-qty-class" name=working_qty[] type="number" min=0 max="<?php echo number_format((float)$single_data->product_qty*$qty, 2, '.', '');?>" value="<?php echo number_format((float)$single_data->product_qty*$qty, 2, '.', '');?>"></td>

                                <td>

                                <input class="wastage-class" name=wastage_qty[] type="number" readonly value=0>
                                
                                </td>

                                <td class="stage-class">
                                
                                <select name=stages[]>

  <?php foreach($stages_data as $data){?>
  <option value="<?php echo $data->stage?>"><?php echo $data->stage_name?></option>
  <?php }?>

</select>
                                
                                </td>

                               
                           </tr>
                           <?php
                       }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12">          
            <input type="submit" value="Submit" name="submit" class="btn btn-md btn-primary"/> 
        </div>    
           
    </div>
            
    <?php echo form_close(); ?>                          
</div>
        
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {

    let workingQtyElements = document.getElementsByClassName("working-qty-class");


Array.from(workingQtyElements).forEach(function(workingQtyElement,index) {

    workingQtyElement.addEventListener('click', function() {

       document.getElementsByClassName('wastage-class')[index].value= parseFloat(document.getElementsByClassName('total-qty-class')[index].innerHTML)-parseFloat(this.value);

    });

});

    $("[type='number']").keypress(function (evt) {
    evt.preventDefault();
}); 

});

</script>