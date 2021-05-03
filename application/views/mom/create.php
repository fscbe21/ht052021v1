<div id="new-message-dropzone" class="post-dropzone">
    <?php echo form_open(get_uri("mom/send_message"), array("id" => "message-form", "class" => "general-form", "role" => "form")); ?>
    <div class="modal-body clearfix">
    <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('add_mom'); ?></h4>
                    <div class="title-button-group">
                        <a href="<?php echo_uri("mom/create") ?>">
                            <button class="btn btn-md btn-default">Mom List</button>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    <div class="form-group">
            <label for="title" class=" col-md-2"><?php echo ('Title'); ?></label>
            <div class=" col-md-10">
                <?php
                echo form_input(array(
                    "id" => "title",
                    "name" => "title",
                    "class" => "form-control",
                    "placeholder" => ('Title'),
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                ));
                ?>
            </div>
        </div>




        <div class="form-group">
            <label for="to_user_id" class=" col-md-2"><?php echo ('Person Present'); ?></label>
            <div class="col-md-10">
                <?php
                if (isset($message_user_info)) {
                    $image_url = get_avatar($message_user_info->image);
                    echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span>" . $message_user_info->first_name . " " . $message_user_info->last_name;
                    ?>
                    <input type="hidden" name="to_user_id" value="<?php echo $message_user_info->id; ?>" />
                    <?php
                } else {
                   // echo form_dropdown("to_user_id", $users_dropdown, array(), "class='select2 validate-hidden' id='to_user_id' data-rule-required='true', data-msg-required='" . lang('field_required') . "'");
                   
                echo form_input(array(
                    "id" => "to_user_id",
                    "name" => "to_user_id",
                    "value" => "",
                    "class" => "form-control",
                    "placeholder" => "Person Present",
                    "data-rule-required"=>true,
                    "data-msg-required"=>lang('field_required') 
                ));
              
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="conductby" class=" col-md-2"><?php echo ('Conduct By'); ?></label>
            <div class=" col-md-10">
                <?php
                echo form_input(array(
                    "id" => "conductby",
                    "name" => "conductby",
                    "class" => "form-control",
                    "placeholder" => ('Conduct By '),
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                ));
                ?>
            </div>
        </div>
       



        <div class="form-group">
            <label for="venue" class=" col-md-2"><?php echo ('Venue'); ?></label>
            <div class=" col-md-10">
                <?php
                echo form_input(array(
                    "id" => "venue",
                    "name" => "venue",
                    "class" => "form-control",
                    "placeholder" => ('Venue'),
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="time" class=" col-md-2"><?php echo ('Time'); ?></label>
            <div class=" col-md-10">
                <?php
                echo form_input(array(
                    "id" => "time",
                    "name" => "time",
                    "class" => "form-control",
                    "placeholder" => ('Time'),
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
        <label for="content" class=" col-md-2"><?php echo ('Content'); ?></label>
            <div >
                <?php
                echo form_textarea(array(
                    "id" => "content",
                    "name" => "content",
                    "class" => "form-control",
                    "placeholder" => ('Content'),
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required"),
                    "style" => "min-height:200px;",
                    "data-rich-text-editor" => true
                ));
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?php $this->load->view("includes/dropzone_preview"); ?> 
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> <?php echo lang("upload_file"); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
        <button type="submit" class="btn btn-primary"><span class="fa fa-send"></span> <?php echo lang('send'); ?></button>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var uploadUrl = "<?php echo get_uri("mom/upload_file"); ?>";
        var validationUrl = "<?php echo get_uri("mom/validate_message_file"); ?>";

        var dropzone = attachDropzoneWithForm("#new-message-dropzone", uploadUrl, validationUrl);

        $("#message-form").appForm({
            
            onSuccess: function (result) {

                appAlert.success(result.message, {duration: 10000});
                

                //we'll check if the single user chat list is open. 
                //if so, we'll assume that, this message created from the view.
                //and we'll open the chat automatically.
                if ($("#js-single-user-chat-list").is(":visible") && typeof window.triggerActiveChat !== "undefined") {
                    setTimeout(function () {
                        window.triggerActiveChat(result.id);
                    }, 1000);
                }

            }
        });

        $("#message-form .select2").select2();
        <?php
                if (isset($message_user_info)) {}else{?>
        $('#to_user_id').select2({
           // console.log( <?php echo json_encode($cc_users_dropdown); ?>)
            tags: <?php echo json_encode($cc_users_dropdown); ?>
            

        });
        <?php }?>
    });
</script>    