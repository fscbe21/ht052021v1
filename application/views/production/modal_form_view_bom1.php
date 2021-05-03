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
    <div class="table-responsive">  
      Bom Detail<br /> <br />        
       <table class="table table-striped table-bordered">
       <tr>
          <td class="w30">BOM Name</td><td class="w60">&nbsp;<?php echo $model_info->name; ?></td>
       </tr>
       <tr>
          <?php
            $product_data = $this->Products_model->get_one($model_info->end_product);
            $end_product_name = $product_data->name;
          ?>
          <td class="w30">End Product Name</td><td class="w60">&nbsp;<?php echo $end_product_name; ?></td>
       </tr>
       <tr>
         <?php
            $product_type_data = $this->Producttype_model->get_one($model_info->end_product_type);
            $end_product_type = $product_type_data->name;
          ?>
          <td class="w30">End Product Type</td><td class="w60">&nbsp;<?php echo $end_product_type; ?></td>
       </tr>
       </table>
       Bom Products Detail
       <br />
       <br />

       <?php
            $options = array();
            $options['bom_id'] = $model_info->id;
            $bom_detail_data = $this->Bomdetail_model->get_details($options)->result();
       ?>

    <table class="table table-striped table-bordered">
       <tr>
       <th class="text-center">Sno</th><th>Name</th><th class="text-center">Quantity</th><th class="text-center">Unit</th><th class="text-right">Weight</th><th class="text-right">Wastage</th>
       </tr>

        <?php
            $sno = 1;
            foreach($bom_detail_data as $bdata){
                $prd_data     = $this->Products_model->get_one($bdata->product_id);
                $product_name = $prd_data->name;

                $unit_data    = $this->Unit_model->get_one($bdata->product_unit);
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
                        <?= $bdata->product_qty; ?>
                    </td>
                    <td class="text-center">
                        <?= $unit_name; ?>
                    </td>
                    <td class="text-right">
                        <?= $bdata->product_weight; ?>
                    </td>
                    <td class="text-right">
                        <?= $bdata->product_wastage; ?>
                    </td>
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

    <a href="bomcreation/editbom/<?php echo $model_info->id; ?>">
        <button type="button" class="btn btn-primary"><span class="fa fa-pencil"></span>&nbsp;Edit</button>
    </a>

    <a href="bomcreation/copybom/<?php echo $model_info->id; ?>">
       <button type="button" class="btn btn-info"><span class="fa fa-clone"></span>&nbsp;Copy</button>
    </a>
</div>   