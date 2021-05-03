<!-- AG1903 - INITIAL CREATION -->
<style>
td.option a, .dtr-details .edit, .dtr-details .delete, .select-member-field a.delete, .send-invitation-form .delete, .calendar-ids-form .delete-post-dropzone, .edit-image-file .delete-saved-file, .external-tickets-embedded-code {
    cursor: pointer;
    min-width: 28px;
    background-color: #4a69bd;
    color: #ffffff;
    border-radius: 0% !important;
    display: inline-block;
    position: relative;
    vertical-align: central;
    text-align: center;
    margin: 0 5px;
    padding: 5px 5px;
    border: none !important;
}

.set-process{
    background-color: #a1a3a5;
    padding: 10px;
}
</style>

<div id="page-content" class="p20 clearfix">
    <div class="p-1">

    <?php
        if($ok){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong>&nbsp;Data updated successfully.
      </div>
      <?php
        }
        ?>
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                <?php
                    if($work_order_info->order_type == "work_order"){
                        ?>
                            <h4>SALE ORDER - SET PROCESS</h4>
                        <?php
                    }else{
                        ?>
                            <h4>JOB ORDER - SET PROCESS</h4>
                        <?php
                    }
                ?>
                    <div class="title-button-group">
                        <a href="<?php echo_uri("work_order") ?>">
                            <button class="btn btn-md btn-default">Work Order List</button>
                        </a>
                        <!-- <div class="pull-right p-3">
                            <a href="<?php echo base_url(); ?>index.php/assignbom/index/<?php echo $work_order_id; ?>">
                                <button class="btn btn-primary btn-md">Assign BOM</button>
                            </a>
                    </div> -->
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="work-order-list-table" class="display" cellspacing="0" width="100%">            
                    </table>
                    <br />
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $ar = array();
    $ar['work_order_id'] = $work_order_id;

    $wo_details_data = array();
    $wo_details_data = $this->Work_order_details_model->get_details($ar)->result();

    $setcount         = count($wo_details_data);
    $show_next_button = 1;

    if($setcount > 0){
        foreach($wo_details_data as $processdata){
            $ar1                     = array();
            $ar1['work_order_id']    = $work_order_id;
            $ar1['wo_product_id']    = $processdata->product_id;
            
            $assindata = array();
            $assindata = $this->Set_process_model->get_details($ar1)->result();
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
            <a href="<?php echo base_url(); ?>index.php/assignbom/index/<?php echo $work_order_id; ?>">
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
        $("#work-order-list-table").appTable({
            source: '<?php echo_uri("set_process/list_data/".$work_order_id) ?>',
            columns: [
                {title: 'NO'},
                {title: 'Work Order No'},//dsk 30 march2021
                {title: 'NAME'},
                {title: 'TYPE'},
                {title: 'QUANTITY'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w200"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 3, 5] ),
            xlsColumns: combineCustomFieldsColumns([0, 1, 3, 5])
        });
    });

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });

</script>