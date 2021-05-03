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
       </table>

       <?php
            $options = array();
            $options['bom_id'] = $bomid;
            $bom_detail_data = $this->Bomdetail_model->get_details($options)->result();
       ?>

    <table class="table table-striped table-bordered">

       <tr>
            <th class="text-center">Sno</th><th>Code</th><th>Raw Material</th><th class="text-center">Expected<br /> Quantity</th><th class="text-center">Reuse <br />Quantity</th><th class="text-center">Required<br /> Quantity</th><th class="text-center">Available Qty [ Warehouse name ]</th><th class="text-right">Total Quantity<br /> (All Warehouses)</th><th class="text-right">Weight</th><th class="text-right">Wastage</th><th class="text-center">Unit</th>
       </tr>

        <?php
            $sno = 1;
            foreach($bom_detail_data as $bdata){
                $prd_data     = $this->Products_model->get_one($bdata->product_id);
                $product_name = $prd_data->name;
                $product_code = $prd_data->code;

                $unit_data    = $this->Unit_model->get_one($bdata->product_unit);
                $unit_name    = $unit_data->name;

                $option = array();
                $option['work_order_id'] = $work_order_id;
                $option['product_id']    = $product_id;
                $work_order_data         = $this->Work_order_details_model->get_details($option)->result();

                $qty = $bdata->product_qty * $wop_qty;

                $opt = array();
                $warehouse_data = array();
                $opt['product_id'] = $bdata->product_id;
                $warehouse_data = $this->Productwarehouse_model->get_details($opt)->result();

                $available_qty = 0;

                $wodata = array();
                $wodata = $this->Work_order_model->get_one($work_order_id);
                $reuse_id = 0;
                $reuse_id = $wodata->reuse_id;

                $optionss = array();
                $optionss['reuse_id']   = $reuse_id;
                $optionss['product_id'] = $bdata->product_id;

                $reuse_details = array();
                $reuse_details = $this->Reuse_details_model->get_details($optionss)->result();

                if(count($warehouse_data) > 0){
                    foreach($warehouse_data as $whd){
                        if($whd->warehouse_id == 7){
                            $available_qty += ($whd->qty - $reuse_details->working_qty); 
                        }else{
                            $available_qty += $whd->qty;
                        }                        
                    }
                }

                $opt = array();
                $assignbom_data = array();
                $opt['work_order_id']  = $set_process_data->work_order_id;
                $opt['end_product_id'] = $end_product_id;
                $opt['wo_product_id']  = $end_product_id;
                $opt['product_id']     = $bdata->product_id;
                $opt['bom_id']         = $bomid;

                $assignbom_data = $this->Assignbom_model->get_details($opt)->result();
                $select_warehouse = 0;
                if(count($assignbom_data) > 0 ){
                    $select_warehouse = $assignbom_data[0]->warehouse_id;
                }

                $wh_list = "<select name='warehouse_id[]' class='warehouse form-control' style='min-width: 100%'>";
                $cnt = 0;

                foreach($warehouse_data as $wh){
                    if($wh->qty >= ($qty - $reuse_details[0]->working_qty)){
                        $cnt +=1;
                        if($cnt == 1){
                            $wh_list .= "<option value=''><b> -- Select a Warehouse --</option>";
                        }
                        $whdata = array();
                        
                        $whdata = $this->Warehouse_model->get_one($wh->warehouse_id);
                        $wh_list .= "<option "; 
                        
                        if($select_warehouse){
                            $wh_list .= ($select_warehouse == $wh->warehouse_id) ? ' selected': '';
                        }

                        $wh_list .= " value='".$wh->warehouse_id."'><b>".$wh->qty."</b>&nbsp;&nbsp;&nbsp;&nbsp;[ ".$whdata->name." ]</option>";
                    }
                }

                if($cnt == 0){
                    $wh_list .= '<option value="7">Not Available / Inadequate Quantity Found.</option>';
                }

                $wh_list .= "</select>";
                
                ?>
                <tr>
                    <td class="text-center"><?= $sno; ?></td>
                    <td><?= $product_code; ?>
                    <input type="hidden" name="product_id[]" class="product-id" value="<?= $bdata->product_id;?>"/>
                    <td><?= $product_name; ?></td>
                    
                    <td class="text-center"><?= $qty; ?>
                    <td><?= $reuse_details[0]->working_qty; ?></td>
                    <td><?= $qty - $reuse_details[0]->working_qty; ?></td>
                    <input type="hidden" name="qty[]" value="<?= $qty - $reuse_details[0]->working_qty; ?>"> 
                    </td>
                    <td class="text-center"><?= $wh_list; ?></td>
                    <td class="text-right"><?= $available_qty; ?></td>

                    <td class="text-right"><?= $bdata->product_weight * $wop_qty; ?>
                    <input type="hidden" name="weight[]" value="<?= $bdata->product_weight * $wop_qty; ?>"> </td>
                    <td class="text-right"><?= $bdata->product_wastage * $wop_qty; ?>
                    <input type="hidden" name="wastage[]" value="<?= $bdata->product_wastage * $wop_qty; ?>"> 
                    </td>
                    <td class="text-center"><?= $unit_name; ?></td>
                </tr>
                <?php
                $sno += 1;
            }
        ?>
    </table>
  </div>
</div>

<input type="hidden" name="work_order_id" value="<?php echo $work_order_id; ?>">
<input type="hidden" name="end_product_id" value="<?php echo $end_product_id; 
?>">
<input type="hidden" name="wo_product_id" value="<?php echo $end_product_id; 
?>">
<input type="hidden" name="bom_id" value="<?php echo $bomid; ?>">
<div class="modal-footer">

    <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span>&nbsp;Next&nbsp;</button>

    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>

</div>

<?php echo form_close(); ?>