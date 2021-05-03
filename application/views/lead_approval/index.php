<style>

</style>

<div id="page-content" class="p20 clearfix">
    <div class="panel panel-default">
        <div class="page-title clearfix">
            <h1> <?php echo lang('leaddataapproval') ?></h1>
            <div class="title-button-group">
               
            </div>
        </div>
        


<div class="panel panel-default">
            <div class="table-responsive">
            <table id="lead-table" class="display table-sm dataTable" cellspacing="10" width="100%">          
               <thead>
                    <td><?php echo lang("company_name") ?></td>
                    <td><?php echo lang("status") ?></td>
                    <td>Assign to</td>
                    <td><?php echo lang("source") ?></td>
                    <td><?php echo lang("opening_date") ?></td>
                    <td><?php echo lang("followup_date") ?></td>
                    <td><?php echo "Updated date";?></td>
                    <td ><i class="fa fa-bars"></i></td>                   
                </thead>
                <tbody>
                <?php foreach($lead_app as $data){
                    $lead_source = $this->Lead_source_model->get_one($data->lead_source_id);
                    $lead_status = $this->Lead_status_model->get_one($data->lead_status_id);
                    
                    ?>
                    <tr>
                    <td> <?php echo $data->company_name;?></td>
                    <td> <small style="padding: 4px;background-color:<?php echo $lead_status->color;?>"><?php echo $lead_status->title;?></small></td>
                    <td> <?php echo $data->company_name;?></td>
                    <td> <?php echo $lead_source->title;?></td>
                    <td> <?php echo dateFormatChange($data->created_date);?></td>
                    <td> <?php echo dateFormatChange($data->followup_date);?></td>
                    <td> <?php echo  dateFormatChange($data->created_date)?></td>
                  <!--  <td class=" text-center option w100"><a class="edit"><i class=" fa fa-check"></i></a></td>-->
                  <td class=" text-center option w100" ><?php echo modal_anchor(get_uri("leads/modal_form1/$data->id"), "<i class='fa fa-check'></i> " , array("class" => "btn btn-default", "title" => lang('edit_lead'), "data-post-id" => $data->client_id)); ?></td>
                </tr>
               <?php  }?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#lead-table").dataTable({
           
            printColumns: combineCustomFieldsColumns([0, 1, 2], '<?php echo $custom_field_headers; ?>'),
            xlsColumns: combineCustomFieldsColumns([0, 1, 2], '<?php echo $custom_field_headers; ?>')
          
        });


       
    });

   
    

</script>

<?php $this->load->view("leads/update_lead_status_script"); ?>
