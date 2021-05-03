<div class="tab-content">
    <?php echo form_open(get_uri("leads/save_lead_visit_info"), array("id" => "lead-visit-form", "class" => "general-form dashed-row white", "role" => "form")); ?>
    <div class="panel">
        <div class="panel-default panel-heading">
            <h4> <?php echo 'Visit Info'; ?></h4>
        </div>
        <div class="panel-body">
            <?php $this->load->view("leads/lead_form_fields_visit_info"); ?>
        </div>
        <div class="panel-footer">
         <!--darini 11-2-->
    <button type="button" class="btn btn-default" ><span class="fa fa-upload"></span>  Upload</button>
    <!--end-->
            <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>


<script type="text/javascript">

    $(document).ready(function () {
        $("#lead-visit-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
                // console.log('leadStatus:',result.lead_status_id);
                //if(result.lead_status_id == '5'){
                    //$('.lead-to-client-button').trigger('click');
                // }
            }
        });
    });

    $(document).on('change', '.lead-status-id', function(){
        if($(this).val() == '5'){
            $('.lead-to-client-button').trigger('click');
        }
    });

    console.error = function(){
    window.location.reload()
    }

</script>
