<style>
#search{
    min-height: 50px;
    border: 1px solid #2c3e50;
}
</style>
<div class="p20 panel panel-default">
 

     <div class="page-title clearfix">
        <h4>QC Process</h4>
        <div class="title-button-group">

        </div>
    </div>
    <br />
    <?php echo form_open(get_uri("qc_process/save"), array("id" => "qc-process-form", "class" => "general-form", "role" => "form")); ?>
    
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
                <input  type="text" name="end_product" class="form-control" value="<?php echo $product_data->name;?>" readonly>

                <input  type="hidden" name="process_product_id" class="form-control" value="<?php echo $product_data->id;?>" readonly>


                <input  type="hidden" name="work_order_id" class="form-control" value="<?php echo $work_order_id;?>" >


            </div>
        </div>


              
        <div class="col-md-3" >
            <div class="form-group">
                <label for="qty" >Qty</label>

                <input  type="number" name="qty" id="qty-id" class="form-control" min=0 max="<?php echo $qty;?>" value="<?php echo $qty;?>">


                <input  type="hidden"  id="ref-qty-id" class="form-control" value="<?php echo $qty;?>">

                <input type="hidden"  id="wastage-qty-id" name="waste_qty" class="form-control" >

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
                        
                        </tr>
                    </thead>
                    <tbody id="order-table">
                    <?php 
                       foreach($bom_details_data as $single_data){


                           $product_data = $this->Products_model->get_one($single_data->product_id);
                                                     ?>
                           <tr class="tr-class">

                                <td>
                                
                                <input type="hidden"  name="product_id[]" value="<?php echo  $product_data->id;?>">
                                
                                <input type="hidden" name="product_qty[]" value="<?php echo  $single_data->product_qty;?>">

                                <input type="hidden" class="product-total-qty-class" name="product_total_qty[]" value="<?php echo number_format((float)$single_data->product_qty*$qty, 2, '.', '');?>">


                                <?= $product_data->name; ?>
                                
                                
                                </td>

                                <td><?= $product_data->code; ?></td>

                                <td class="qty-class">                              
                               

                                <?php echo number_format((float)$single_data->product_qty, 2, '.', '');?></td>
                           
                                <td class="total-qty-class"><?php echo number_format((float)$single_data->product_qty*$qty, 2, '.', '');?></td>

                               
                           </tr>
                           <?php
                       }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

<?php if ($this->login_user->is_admin || get_array_value($this->login_user->permissions, "quality_check") == "all") { ?>
        <div class="col-md-12">     
             
            <!-- <input type="submit" value="Submit" name="submit" class="btn btn-md btn-primary"/>  -->

            <button type="button" class="btn btn-warning btn"  style="display: none;"
            
            
            data-woid="<?php echo $work_order_id?>"
            data-epid="<?php echo $end_product_id?>" 
            data-pid="<?php echo $product_id?>"
            data-bomid="<?php echo $bom_id?>" 
            data-qty="<?php echo $qty;?>"

            data-processid="<?php echo $process_id;?>"


            id="qc-id">Reuse</button>

<br>

            <!-- <button type="button" class="btn btn-danger btn"  style="display: none;"            
            
            data-woid="<?php echo $work_order_id?>"
            data-epid="<?php echo $end_product_id?>" 
            data-pid="<?php echo $product_id?>"
            data-bomid="<?php echo $bom_id?>" 
            data-qty="<?php echo $qty;?>"

            id="qc-wastage">Wastage</button> -->


            <input  type="submit" id="qc-wastage" value="Wastage" name="wastage_submit" class="btn btn-md btn-danger" style="display: none;"   >

            
            <input  type="submit" id="qc-pass" value="QcPass" name="qc_pass_submit" class="btn btn-md btn-success" >

           

        </div>    
        <?php } ?>       
    </div>

            
    <?php echo form_close(); ?>                          
</div>
        
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {


    

    document.getElementById("qc-id").addEventListener("click", function() {

        let reuseQty=parseFloat(this.dataset.qty)-parseFloat( document.getElementById("qty-id").value);

        //console.log('reuseQty:',reuseQty);

window.location="<?php echo get_uri()?>"+'reuse/show/'+this.dataset.woid+'/'+this.dataset.epid+'/'+this.dataset.pid+'/'+this.dataset.bomid+'/'+reuseQty+'/'+parseFloat( document.getElementById("qty-id").value)+'/'+this.dataset.processid;

});



    $("[type='number']").keypress(function (evt) {
    evt.preventDefault();
});

    document.getElementById("qty-id").addEventListener("click", function() {




console.log('clicked');
       


        if(parseFloat(document.getElementById("ref-qty-id").value) === parseFloat(this.value)){

            document.getElementById("qc-pass").style.display = "block";
            document.getElementById("qc-id").style.display = "none";
            document.getElementById("qc-wastage").style.display = "none";

        }else{
        
        document.getElementById("qc-id").style.display = "block";
        document.getElementById("qc-wastage").style.display = "block";
        document.getElementById("qc-pass").style.display = "none";
       

      }
   
      
   


        const qtySingles = document.querySelectorAll('.qty-class');
Array.from(qtySingles).forEach((qtySingle, index) => {
  console.log(qtySingle.innerHTML);
  
  console.log(document.querySelectorAll('.total-qty-class')[index].innerHTML=parseFloat(qtySingle.innerHTML) * parseFloat(this.value));
});





//new


const productTotalQtys = document.querySelectorAll('.product-total-qty-class');

Array.from(productTotalQtys).forEach((productTotalQty, index) => {

    document.querySelectorAll('.product-total-qty-class')[index].value=parseFloat(document.querySelectorAll('.total-qty-class')[index].innerHTML);

});


document.getElementById('wastage-qty-id').value = parseFloat(document.getElementById('ref-qty-id').value)-parseFloat(document.getElementById('qty-id').value)


//end new






});

});

</script>