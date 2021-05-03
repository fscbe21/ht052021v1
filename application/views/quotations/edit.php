
<div id="page-content" class="p20 clearfix">
    <div class="p-1">
    <?php
        if($success){
    ?>
      <div id="success-alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
       <strong>Success!</strong>&nbsp;Quotation updated successfully.
      </div>

      <?php
        }
        ?>

        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> Edit Quotation</h4>
                    <div class="title-button-group">
                    <a href="<?php echo_uri("quotations") ?>">
                            <button class="btn btn-md btn-default">Quotations List</button>
                    </a>
                    </div>
                </div>
                <br />
                <?php echo form_open(get_uri("quotations/updatequotation"), array("id" => "purchase-form", "class" => "general-form", "role" => "form")); ?>
                <div class="container row">
              

                 
<div class="col-md-5">
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Quotation_No"?></label>
        <input type="hidden" name="quotation_id" value="<?= $quotation_data->id; ?>"/>
        <div class="<?php echo $field_column; ?>">
            <div class=" col-md-9">
            
             <input type="text" id=" " name="quotation_no" class="form-control" value="<?= $quotation_data->	quotation_no; ?>" required>   
        <div id=" ">
        </div>                                       
            </div>
        </div>
    </div>

</div>

<div class="col-md-5">
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Date"?></label>
       
        <div class="<?php echo $field_column; ?>">
            <div class=" col-md-9">
            
             <input type="date" id=" " name="date" class="form-control" value="<?= $quotation_data->date; ?>" required>   
        <div id=" ">
        </div>                                       
            </div>
        </div>
    </div>

</div>


                </div>
                <br />
                <div class="container row">
                <div class="col-md-5">
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Purchase Request No"?></label>
       
        <div class="<?php echo $field_column; ?>">
            <div class=" col-md-9">
            
             <input type="number" id=" " name="purchase_req_no" class="form-control" value="<?= $quotation_data->purchase_req_no; ?>" required> 
               
        <div id=" ">
        </div>                                       
            </div>
        </div>
    </div>

</div>

<div id="post-dropzone">
<div class="col-md-5">
    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "file_name"?></label>
       
        <div class="<?php echo $field_column; ?>">
            <div class=" col-md-6">
            
             <input type="text" id=" " name="file_name" class="form-control" value="<?= $quotation_data->file_name; ?>" required>   
                                         
            </div>
            <div  class="post-dropzone box-content form-group">
       <?php $this->load->view("includes/dropzone_preview"); ?>

       
           <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> <?php echo lang("upload_file"); ?></button>
            
        </div>
    </div>

</div>
</div>





                </div>


            <br /><br />



              <div class="container p-2">
                 <input type="submit" value="Submit" name="submit" class="btn btn-md btn-primary"/> 
             </div><br />
             <br />
              <?php echo form_close(); ?>                          
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function () {

var uploadUrl = "<?php echo get_uri("team_members/upload_file"); ?>";
var validationUrl = "<?php echo get_uri("team_members/validate_post_file"); ?>";


dropzone = attachDropzoneWithForm("#post-dropzone", uploadUrl, validationUrl);




});



   

   

    $(document).on('click', '.deletethis', function(){
        console.log('clicked');
        $(this).parents('tr').first().remove();
    });

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
        window.setTimeout(function() {
            window.location.href = '../quotations';
        }, 400);
    });



</script>