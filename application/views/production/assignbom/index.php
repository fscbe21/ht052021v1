<!-- AG1703 - INITIAL CREATION -->
<!-- AG20-03-2021 -->
<div id="page-content" class="p20 clearfix">
    <div class="p-1">
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4>Assign BOM</h4>
                    <div class="title-button-group">
                        <div class="pull-right p-3">
                           
                        </div>
                    </div>
                </div>
                <br />
                <b>
                    <div class="container table-responsive">
                        <table class="table table-bordered table-striped" cellspacing="0" width="80%"> 
                        <tr>
                            <th style="max-width: 40px">Work order Number</th>
                            <th>Customer Name</th>
                            <th>Notes</th>
                        </tr>
                        <tr>
                            <td><?= $detail->id; ?></td>
                            <td><?= $cdetail->company_name; ?></td>
                            
                            <td><?= $detail->notes; ?></td>
                        </tr>  
                        <tr style="display: none">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>           
                        </table>
                    </div>
                </b>
                <div class="table-responsive">
                    <table id="assign-bom-list-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>

    <?php
    $ar = array();
    $ar['work_order_id'] = $woid;
    $ar['wo_product_id'] = $wo_product_id;

    $set_process_data = array();
    $set_process_data = $this->Set_process_model->get_details($ar)->result();

    $setcount         = count($set_process_data);
    $show_next_button = 1;

    if($setcount > 0){
        foreach($set_process_data as $processdata){
            $ar1                     = array();
            $ar1['work_order_id']    = $woid;
            $ar1['wo_product_id']    = $wo_product_id;
            $ar1['end_product_id']   = $processdata->end_product_id;
            
            $assindata = array();
            $assindata = $this->Assignbom_model->get_details($ar1)->result();
            if(count($assindata) == 0){
                $show_next_button = 0; 
            }
        }
    }

    if($show_next_button){
    ?>
    <div id="page-content1" class="p20 clearfix">
        <div class="p-1">
            <div class="">
                <div class="panel panel-default">
                    <div class="page-title clearfix">
                        <div class="title-button-group">
                            <div class="pull-right p-3">
                                <a href="<?php echo base_url(); ?>index.php/assignbom/set_stages/<?php echo $woid; ?>">
                                    <button class="btn btn-primary btn-md">NEXT</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#assign-bom-list-table").appTable({
                source: '<?php echo_uri("assignbom/list_data/".$woid); ?>',
                columns: [
                    {title: 'End Product Name'},
                    {title: 'Process Name'},
                    {title: 'Vendor Name'},
                    {title: 'BOM Name'},
                    {title: 'Qty'},
                    /* {title: 'Unit'}, */
                    {title: 'Number of stages'},
                    {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
                ]
            });
        });
    </script>