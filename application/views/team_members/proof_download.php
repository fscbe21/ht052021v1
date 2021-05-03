<div class="tab-content">
    <div class="panel">
        <div class="panel-default panel-heading">
            <h4>Proof Download</h4>
        </div>
        <div class="panel-body">
            <div class="row">
            <div class="col-md-8">
           
                <?php
                    if(count($files) > 0){
                    foreach($files as $f){
                ?>
              
              <br />
                   <img class="img img-thumbnail" src="<?php echo base_url(); ?>files/timeline_files/<?php echo $f['file_name']; ?>" style="width: 40%; height: 40%"> <br />
              
               <?php }
               }
               ?>
               </div>
               <div class="col-md-4"> 
               <?php
            if ($files) {
                $download_caption = lang('download');
                if ($files > 1) {
                    $download_caption = sprintf(lang('download_files'), count($files));
                }
                echo anchor(get_uri("team_members/download_files/" . $user_id), $download_caption, array("class" => "btn btn-md btn-primary", "title" => $download_caption));
            }else{
                ?>
                    <img class="img img-thumbnail" src="<?php echo base_url(); ?>files/noimage.png" style="width: 40%; height: 40%"> <br /><br />
                    <span style="color: red">Looks like proofs are not uploaded !</span>
                   <?php

            }
        ?>
               </div>
            </div>
            
        </div>    
    </div> 
</div> 
<script type="text/javascript">
    $(document).ready(function () {
        $("#job-info-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
                window.location.href = "<?php echo get_uri("team_members/view/" . $job_info->user_id); ?>" + "/proof_download";
            }
        });
    });
</script>  