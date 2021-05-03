<?php echo form_open(get_uri("leads/save"), array("id" => "lead-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <?php $this->load->view("leads/lead_form_fields"); ?>
</div>

<div class="modal-footer">
    <!--darini 11-2-->
        <button type="button" class="btn btn-default" ><span class="fa fa-upload"></span>  Upload</button>
    <!--end-->
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary lead-add-button"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
       
//darini 12-2
        <?php if(isset($leadapp)){
            $edid=1;
        } else{
            $edid= 0;
        }?>

        $("#lead-form").appForm({
            onSuccess: function (result) {
                console.log("res"+result.message);
                
                var res=<?php echo $edid ?>;
                console.log("res"+res);
                if(res==1){
                    appAlert.success(result.message, {duration: 10000});
                    setTimeout(function () {
                        location.reload();
                    }, 500);
                }else{//end
                if (result.view === "details") {
                    appAlert.success(result.message, {duration: 10000});
                    setTimeout(function () {
                        location.reload();
                    }, 500);
                } else {
                    $("#lead-table").appTable({newData: result.data, dataId: result.id});
                    $("#reload-kanban-button:visible").trigger("click");
                }
            }
            }
        });
        $("#company_name").focus();
    });
</script>    