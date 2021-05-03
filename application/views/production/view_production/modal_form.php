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
    <div class="table-responsive">  
      Work Order Production detail<br /><br />  
      <?php
            $clients_data = $this->Clients_model->get_one($work_order_info->customer_id);
            $client_name  = $clients_data->company_name;
      ?>
       <table class="table table-striped table-bordered">
       <tr>
          <td class="w30">Customer Name</td><td class="w60">&nbsp;<?php echo $client_name; ?></td>
       </tr>
       <tr>
          <td class="w30">Start Date</td><td class="w60">&nbsp;<?php echo $work_order_info->start_date; ?></td>
       </tr>
       <tr>
          <td class="w30">End Date</td><td class="w60">&nbsp;<?php echo $work_order_info->end_date; ?></td>
       </tr>
       </table>
       Work order Products Detail 
       <!-- <div class="pull-right" style="padding: 10px;">
       
            <button type="button" class="btn btn-md btn-success">Indent All</button>
       
       </div> -->
       <br />
       <br />


    <table class="table table-striped table-bordered">
       <tr>
       <th class="text-center">Sno</th><th>End Product</th><th class="text-center">Process</th><th class="text-center">Vendor</th><th class="text-center">BOM Name</th><th class="text-right">Quantity</th><th class="text-center">No. of stages</th><th class="text-center">Status</th>
       </tr>

        <?php
            $sno = 1;
            foreach($work_order_detail as $detail){
                $options                     = array();
                $options['work_order_id']    = $detail->work_order_id;
                $options['wo_product_id']   = $detail->product_id;
                $set_process_data = $this->Set_process_model->get_details($options)->result();

                foreach($set_process_data as $ssdata){

                    $prd_data     = $this->Products_model->get_one($ssdata->end_product_id);
                    $product_name = $prd_data->name;

                    $options['product_id'] = $ssdata->product_id;
                    
                    $process_data    = $this->Process_model->get_one($ssdata->process_id);
                    $process_name    = $process_data->title;  

                   // $vendor_data     = $this->Supplier_model->get_one($ssdata->vendor_id);
                    $vendor_data = $this->Vendor_model->get_one($ssdata->vendor_id);
                    $vendor_name     = $vendor_data->name;

                    $option = array();
                    $option['work_order_id']    = $detail->work_order_id;
                    $option['end_product_id']   = $ssdata->end_product_id;

                    $assignbom_data  = $this->Assignbom_model->get_details($option)->result();

                    $bom_data        = $this->Bom_model->get_one($assignbom_data[0]->bom_id);
                    $bom_name        = $bom_data->name;

                    $qty             = $detail->qty;

                    $unit_data       = $this->Unit_model->get_one($prd_data->purchase_unit_id);
                    $unit_name       = $unit_data->name;
                    ?>

                    <tr>
                        <td class="text-center"><?= $sno; ?></td>
                        <td class="text-center"><?= $product_name; ?></td>
                        <td class="text-center"><?= $process_name; ?></td>
                        <td class="text-center"><?= $vendor_name; ?></td>
                        <td class="text-center"><?= $bom_name; ?></td>
                        <td class="text-right"> <?= $qty; ?></td>
                        <!-- <td class="text-center"><?= $unit_name; ?></td> -->
                        <td class="text-center"><?= $ssdata->stages; ?></td>
                        <td class="text-center">
                            <?php
                                if($ssdata->status == 1){
                                    echo '<span style="border-radius: 4px;color: #f7f1e3;background-color: #474787;padding: 5px;" >Completed</span>';
                                }else if($ssdata->status == 2){
                                    echo '<span style="border-radius: 4px;color: #f7f1e3;background-color: #474787;padding: 5px;" >Wastage</span>';
                                }else if($ssdata->status == 3){
                                    echo '<span style="border-radius: 4px;color: #f7f1e3;background-color: #474787;padding: 5px;" >Reuse</span>';
                                }else{
                                    $options = array();
                                    $options['work_order_id'] = $detail->work_order_id;
                                    $options['bom_id']        = $assignbom_data[0]->bom_id;
                                    $indent_data = $this->Indent_model->get_details($options)->result();

                                    if(count($indent_data) == 0)
                                    {                                
                                    ?>
                                        <a href="<?= base_url(); ?>index.php/viewproduction/indent_creation/<?= $detail->work_order_id; ?>/<?= $ssdata->end_product_id; ?>/<?= $assignbom_data[0]->bom_id; ?>">
                                            <button class="btn btn-md btn-primary">
                                                Indent
                                            </button>
                                        </a>
                                    <?php
                                    }

                                if(count($indent_data) > 0)
                                {
                                   $options = array();
                                   $dcdata  = array();

                                   $options['work_order_id'] = $detail->work_order_id;
                                   $dcdata = $this->Dc_outward_model->get_details($options)->result();

                                   $no = 0;
                                   if(count($dcdata) == 0){
                                        $no += 1;
                                   }

                                   $opt = array();
                                   $opt['work_order_id'] = $detail->work_order_id;
                                   $opt['bom_id']        = $assignbom_data[0]->bom_id;
                                   $asdata = $this->Assignbom_model->get_details($opt)->result();
                                   
                                   foreach($asdata as $adata){
                                       $p_id          = $adata->product_id;
                                       $p_qty         = $adata->qty;
                                       $warehouse     = 7;

                                       $whdata        = array();
                                       $whdata = $this->Productwarehouse_model->check_product($warehouse, $p_id);

                                       if($whdata > 0)
                                       {
                                            $wh_qty   = $this->Productwarehouse_model->checkwhqty($warehouse, $p_id);

                                            if($wh_qty < $p_qty)
                                            {
                                                $no = $no + 1;
                                            }
                                       }
                                       else
                                       {
                                            $no   = $no + 1;

                                            $data = array();                            
                                            $data['warehouse_id'] = $warehouse;
                                            $data['product_id']   = $p_id;
                                            $data['qty']          = 0;
                                            $this->Productwarehouse_model->save($data);
                                       } 
                                   }

                                   if($no > 0)
                                   {
                                        echo "<span class='text-danger'>Unable to proceed. Please initiate QC Outward</span>";
                                   }
                                   else
                                   {
                                        $opt = array();
                                        $opt['work_order_id']    = $detail->work_order_id;
                                        $opt['end_product_id']   = $ssdata->end_product_id;
                                        $stages_data             = array();
                                        $stages_data             = $this->Set_stages_model->get_details($opt)->result();
                                        $tot_rec                 = 0;
                                        $tot_rec                 = count($stages_data);
                                        $tot_com                 = 0;

                                        foreach($stages_data as $stdata)
                                        {
                                            if(! is_null($stdata->start_date_time))
                                            {
                                                $tot_com     = $tot_com + 0.5;
                                                if(! is_null($stdata->end_date_time))
                                                {
                                                    $tot_com = $tot_com + 0.5;
                                                }
                                            }
                                        }

                                        if($tot_com == 0)
                                        {
                                            ?>
                                             <a href="<?= get_uri(); ?>production_processing/show/<?= $detail->work_order_id;?>/<?= $detail->product_id;?>/<?= $ssdata->end_product_id;?>/<?= $assignbom_data[0]->bom_id;?>">
                                                <button class="btn btn-md btn-primary">
                                                    Start
                                                </button>
                                                </a>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <a href="<?= get_uri(); ?>production_processing/show/<?= $detail->work_order_id;?>/<?= $detail->product_id;?>/<?= $ssdata->end_product_id;?>/<?= $assignbom_data[0]->bom_id;?>">
                                                <button class="btn btn-md btn-warning">
                                                    Processing
                                                </button>
                                                </a>
                                            <?php
                                        }
                                    } 

                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $sno += 1;
                }
            }
        ?>
    </table>
  </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
</div>   