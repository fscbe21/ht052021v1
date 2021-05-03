<!-- AG20-03-2021 -->
<style>
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

<?php echo form_open(get_uri("assignbom/save_assign_bom"), array("id" => "assign-bom-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix" id="myModal">
    <div class="table-responsive">  
     <br /> <br />        
       <table class="table table-striped table-bordered" style="width: 100%">
       <tr>
          <td class="w30">End Product Name</td><td class="w60">&nbsp;
          <?php 
            $productdata = $this->Products_model->get_one($end_product_id);
            echo $productdata->name;
          ?>
          </td>
       </tr>
       <tr>
          <td class="w30">Select BOM</td><td class="w60">&nbsp;
          <?php 
            $options = array();
            $options['end_product'] = $end_product_id;
            $bom_data = $this->Bom_model->get_details($options)->result();
            
            if(count($bom_data) > 0){
                $bom_list = '<select name="bom_name" id="bom-name" class="form-control select2">';
                $bom_list .= '<option value=""> -- Select One --</option>';
                foreach($bom_data as $bomd){
                    $bom_list .= '<option value="'.$bomd->id.'">'.$bomd->name.'</option>';
                }
                $bom_list .= '</select>';
                echo $bom_list;
            }

          ?>
          </td>
       </tr>
       </table>

       <?php
            $options = array();
            $options['bom_id'] = $bomid;
            $bom_detail_data = $this->Bomdetail_model->get_details($options)->result();
       ?>

    <table class="table table-striped table-bordered">

       <tr>
            <th class="text-center">Sno</th><th>Code</th><th>Raw Material</th><th class="text-center">Expected Quantity</th><th class="text-center">Available Qty [ Warehouse name ]</th><th class="text-right">Total Quantity<br /> (All Warehouses)</th><th class="text-right">Weight</th><th class="text-right">Wastage</th><th class="text-center">Unit</th>
       </tr>
            <div id="insert-materials"></div>
    </table>
  </div>
</div>

<input type="hidden" name="work_order_id" value="<?php echo $work_order_id; ?>">
<input type="hidden" name="end_product_id" value="<?php echo $end_product_id; 
?>">
<input type="hidden" name="wo_product_id" value="<?php echo $wo_product_id; 
?>">
<input type="hidden" name="bom_id">
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>

    <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span>&nbsp;Next&nbsp;</button>

    
</div>

<?php echo form_close(); ?>

<script>
    $(document).on('change', '#bom-name', function(){
        var bomid               = $(this).val();
        var endProductId        = '<?php echo $end_product_id; ?>';
        var workOrderId         = '<?php echo $work_order_id; ?>';
        var workOrderProductId  = '<?php echo $woproductid; ?>';
        $.ajax({
            type: 'GET',
            url: '<?= base_url(); ?>index.php/assignbom/insert_materials/'+workOrderId+'/'+workOrderProductId+'/'+bomid,
            dataType: 'json',
            success: function(data) 
            {
                $('#insert-materials').empty();
                if(data.length > 0)
                {
                    $.each(data, function (index, value) 
                    {
                        var namex = data[index].name;
                        var namep = namex.replace(/"/g, '');
                        $('#product-list').append('<option data-name="'+namep+'" data-code='+data[index].code+' data-id="'+data[index].id+'" data-cost='+data[index].cost+' data-unit='+data[index].unit_id+' data-tax='+data[index].tax_id+' value="'+data[index].code+'" class="form-control selected" style="width: 80%">'+data[index].name+' ( '+data[index].code+' )</option>');
                    }); 
                }                                     
            }                   
        });
    });
</script>