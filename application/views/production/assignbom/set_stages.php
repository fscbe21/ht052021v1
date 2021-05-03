<!-- AG20-03-2021 INITIAL CREATION -->
<?php echo form_open(get_uri("assignbom/save_set_stages"), array("id" => "set-stages-form", "class" => "general-form", "role" => "form")); ?>
<div id="page-content" class="p20 clearfix">
    <div class="p-1">
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Set stages</h4>
                    <div class="title-button-group">
                        <div class="pull-right p-3">
                           
                        </div>
                    </div>
                </div>
<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 13px;
    line-height: 1.42857143;
    vertical-align: top;
}
</style>
                <br />
                
                <b>
                <div class="container table-responsive">
                    <table class="table table-bordered table-striped" cellspacing="0" width="80%"> 
                    <tr>
                        <th>Work order Number</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Notes</th>
                    </tr>
                    <tr>
                <?php

                $client_data   = $this->Clients_model->get_one($work_order_data->customer_id);
                $customer_name = $client_data->company_name;

                $options = array();
                $options['work_order_id'] = $work_order_data->id;
                $options['wo_product_id'] = $wo_product_id;
                $set_process_data = $this->Set_process_model->get_details($options)->result();

                ?>
                        <td><?= $work_order_data->id; ?></td>
                        <td><?= $work_order_data->date; ?></td>
                        <td><?= $customer_name; ?></td>
                        <td><?= $work_order_data->notes; ?></td>
                    </tr>  
                    <tr style="display: none">
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>           
                    </table>

                    <br />
                    <table class="table table-bordered table-striped" cellspacing="0" width="80%"> 
                    <tr>
                        <th>End Product</th>
                        <th>Process</th>
                        <th>Stages</th>
                        <th>Stage Name</th>
                    </tr>
                    <input type="hidden" name="work_order_id" value="<?= $work_order_data->id; ?>">
                    <?php
                        foreach($set_process_data as $spd){
                            $endproductdata = $this->Products_model->get_one($spd->end_product_id);
                            $end_product_name = $endproductdata->name;

                            $processdata = $this->Process_model->get_one($spd->process_id);
                            $stages_count = $spd->stages;
                            $i = 1;
                            
                            for($i=1; $i<=$stages_count; $i++){
                                ?>
                            
                            <input type="hidden" name="wo_product_id[]" value="<?= $spd->wo_product_id; ?>">

                            <input type="hidden" name="end_product_id[]" value="<?= $spd->end_product_id; ?>">

                            <input type="hidden" name="process_id[]" value="<?= $spd->process_id; ?>">
                            <input type="hidden" name="stage[]" value="<?= 'Stage - '.$i; ?>">
                            <tr>
                                <td><?= $end_product_name; ?></td>
                                <td><?= $processdata->title; ?></td>
                                <td><?= 'Stage - '.$i; ?></td>
                                <td>

                                <?php
                                    $stage_data                = array();
                                    $options                   = array();
                                    $options['work_order_id']  = $work_order_data->id;
                                    $options['wo_product_id']  = $wo_product_id;
                                    $options['end_product_id'] = $spd->end_product_id;
                                    $options['process_id']     = $spd->process_id;
                                    $options['stage']          = 'Stage - '.$i;

                                    $stage_data = $this->Set_stages_model->get_details($options)->result();

                                    $stage_name = '';
                                    if(count($stage_data) > 0){
                                        $stage_namee = $stage_data[0]->stage_name;
                                    }
                                ?>
                                    <input type="text" name="stage_name[]" value="<?= $stage_namee; ?>" class="form-control" required>

                                    <!-- <?php echo json_encode($options); ?> -->
                                </td>
                            </tr>
                                <?php
                            } 
                        }
                    ?>                            
                    </table>

                    <div class="title-button-group">
                        <div class="pull-right p-3">
                             <input type="submit" class="btn btn-md btn-primary" value="Submit">
                        </div>
                    </div>

                </div>
    </b>
                <br />
                
               
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
