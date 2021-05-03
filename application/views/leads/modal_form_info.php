
<div class="modal-body clearfix">
    <?php $this->load->view("leads/lead_form_info"); ?>
</div>
<div class="modal-footer">
<!--darini 9-2-21-->

<?php echo form_open(get_uri("leads/updatetransfer/".$info->id), array("id" => "transfer-form", "class" => "general-form", "role" => "form")); ?>
  <div id="display-transfer">
        <div class="row">
            <div class="col-md-3">
            <?php
              foreach ($team_members as $tm) {
                if($info->owner_id==$tm->id){
                    $name=$tm->first_name;
                }
             }
            ?>
            Tranfers&nbsp;:&nbsp;<?php echo $name; ?>
            </div>
            <div class="col-md-1">
              To
              </div>
              <div class="col-md-4">
            <select id="transfer_to" name="transfer_to" class="form-control">

        <?php
     foreach ($team_members as $tm) {
         if($info->owner_id != $tm->id ){                       
         ?>             
            <option  value="<?php echo $tm->id ;?>" ><?php echo $tm->first_name;?></option>
        <?php }
          }?>
       </select>
           
        </div>
        <div class="col-md-1">
        <input type="submit" class="btn btn-info" name="submit" value="submit"/>
        </div>
        
        </div><br />
        <br/>
  </div>
    <?php echo form_close(); ?>
<!--end-->


    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
<?php
if($this->login_user->role_id < 3){
    ?>
     <button type="button" id="showTransfer" class="btn btn-info"><span class="fa fa-share"></span>&nbsp;Lead Transfer</button>
    <?php
}
?>
   

    <a class="btn btn-primary" href="<?php echo get_uri("leads/view/".$info->id);?>"><span class="fa fa-check-circle"></span>&nbsp;<?php echo lang('lead_information'); ?></a>
</div>

<script>
$('.modal-dialog').css('width', '90%');
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#display-transfer').hide();
        $("#transfer-form").appForm({
            isModal: true,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
                
                var reloadUrl = "<?php echo get_uri("leads"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
    });

    $(document).on('click','#showTransfer', function(){
        $('#display-transfer').toggle();
    });
</script>


