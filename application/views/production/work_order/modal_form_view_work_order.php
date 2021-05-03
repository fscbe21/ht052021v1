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
<div id="print-this">
<style>
.table{
    min-width: 100%;
    font-weight: 600;
}

.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border: 1px solid #ddd;
}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}

.w30 {
    width: 30%;
}

html, body {
    background-color: #e5e9ec;
    color: #4e5e6a;
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 13px;
    -webkit-font-smoothing: antialiased;
    height: 100%;
    overflow: hidden;
    overflow-x: hidden;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

</style>
<div class="modal-body clearfix">
    <div class="table-responsive">  
      Work Order Detail    <br /> <br />


       <?php
        $work_order_data = $this->Work_order_model->get_one($model_info->id);
       ?>

 

       <table class="table table-striped table-bordered">
       <tr>
          <td class="w30">Work Order</td><td class="w60">&nbsp;<?php echo $model_info->id; ?></td>
       </tr>


       <tr>
       
       <td class="w30"><?php echo lang('date')?></td>
       
       <td class="w60">&nbsp;<?php echo $work_order_data->date; ?></td>
    </tr>



       <tr>
       
          <td class="w30"><?php echo lang('sales_order_number')?></td>
          
          <td class="w60">&nbsp;<?php echo $work_order_data->sales_order_number; ?></td>
       </tr>

       <tr>
       
       <td class="w30">Client Name</td>
       <?php 
            $client_data = $this->Clients_model->get_one($work_order_data->customer_id);
       ?>
       <td class="w60">&nbsp;<?php echo $client_data->company_name; ?></td>
    </tr>


       <tr>
       
       <td class="w30"><?php echo lang('start_date')?></td>
       
       <td class="w60">&nbsp;<?php echo $work_order_data->start_date; ?></td>
    </tr>




    
    <tr>
       
       <td class="w30"><?php echo lang('end_date')?></td>
       
       <td class="w60">&nbsp;<?php echo $work_order_data->end_date; ?></td>
    </tr>

    <tr>
       
       <td class="w30">Department</td>
       <?php
            if($work_order_data->department == "gas_cutting"){
                $department = "Gas Cutting";
            }else if($work_order_data->department == "laser_cutting"){
                $department = "Laser Cutting";
            }else if($work_order_data->department == "fabrication"){
                $department = "Fabrication";
            }
       ?>
       <td class="w60">&nbsp;<?php echo $department; ?></td>
    </tr>
    <tr>
       
       <td class="w30">Order Type</td>
       <?php
            if($work_order_data->order_type == "work_order"){
                $order_type = "Sale Order";
            }else if($work_order_data->order_type == "job_order"){
                $order_type = "Job Order";
            }
       ?>
       <td class="w60">&nbsp;<?php echo $order_type; ?></td>
    </tr>

    <tr>
       
       <td class="w30"><?php echo lang('notes')?></td>
       
       <td class="w60">&nbsp;<?php echo $work_order_data->notes; ?></td>

    </tr>

       </table>


       <?php
            $options = array();
            $options['work_order_id'] = $model_info->id;
            $work_order_details_data = $this->Work_order_details_model->get_details($options)->result();
       ?>
   
   
   <br /> <br />
      
Work order Products Details<br /> <br />
    <table class="table table-striped table-bordered">
       <tr>
        <th class="text-center">Sno</th>
        <th>Name</th>
        <th>Type</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Unit</th>
        <th class="text-center">Unit Price</th>
        <th class="text-center">Total Price</th>
       </tr>

        <?php
            $sno = 1;
            foreach($work_order_details_data as $data){

                $prd_data     = $this->Products_model->get_one($data->product_id);
                $unit_data=$this->Unit_model->get_one($prd_data->unit_id);

                $product_type_data=$this->Producttype_model->get_one($prd_data->type);

                ?>
                <tr>
                    <td class="text-center">
                        <?= $sno; ?>
                    </td>

                    <td>
                        <?= $prd_data->name; ?>
                    </td>

                    <td>
                        <?= $product_type_data->name; ?>
                    </td>

                    <td class="text-center">
                        <?= $data->qty; ?>
                    </td>

                    <td class="text-center">
                        <?= $unit_data->name; ?>
                    </td>

                    <td class="text-center">
                        <?= $data->cost; ?>
                    </td>

                    <td class="text-center">
                        <?= $data->total_cost; ?>
                    </td>
                  
                </tr>
                <?php
                $sno += 1;
            }
        ?>
    </table>


  </div>
</div>
</div>
<div class="modal-footer">

    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>

    <button id="print" type="button" class="btn btn-primary"><span class="fa fa-print"></span>&nbsp;Print</button>


</div> 

<script>
    $(document).on('click', '#print', function(){
        var prtContent = document.getElementById("print-this");
        var WinPrint = window.open('', '', 'left=0,top=0,width=1000,height=800,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print({bUI: false, bSilent: true,
            bShrinkToFit: true});
        WinPrint.close();
    });
</script>