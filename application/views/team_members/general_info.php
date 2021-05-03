<div class="tab-content">
    <?php echo form_open(get_uri("team_members/save_general_info/" . $user_info->id), array("id" => "general-info-form", "class" => "general-form dashed-row white", "role" => "form")); ?>
    <div class="panel">
        <div class="panel-default panel-heading">
            <h4> <?php echo lang('general_info'); ?></h4>
        </div>
        <div class="panel-body">

        <div class="form-group">
                <label for="name" class=" col-md-2"><?php echo lang('emp_id'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "emp_id",
                        "name" => "emp_id",
                        "value" => $user_info->emp_id,
                        "class" => "form-control",
                        "placeholder" => lang('emp_id'),
                        "autofocus" => true,
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                    ));
                    ?>
                </div>
            </div>


            <div class="form-group">
                <label for="first_name" class=" col-md-2"><?php echo lang('first_name'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "first_name",
                        "name" => "first_name",
                        "value" => $user_info->first_name,
                        "class" => "form-control",
                        "placeholder" => lang('first_name'),
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required")
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class=" col-md-2"><?php echo lang('last_name'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "last_name",
                        "name" => "last_name",
                        "value" => $user_info->last_name,
                        "class" => "form-control",
                        "placeholder" => lang('last_name'),
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required")
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class=" col-md-2"><?php echo lang('mailing_address'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_textarea(array(
                        "id" => "address",
                        "name" => "address",
                        "value" => $user_info->address,
                        "class" => "form-control",
                        "placeholder" => lang('mailing_address')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="alternative_address" class=" col-md-2"><?php echo lang('alternative_address'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_textarea(array(
                        "id" => "alternative_address",
                        "name" => "alternative_address",
                        "value" => $user_info->alternative_address,
                        "class" => "form-control",
                        "placeholder" => lang('alternative_address')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class=" col-md-2"><?php echo lang('phone'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "phone",
                        "name" => "phone",
                        "value" => $user_info->phone,
                        "class" => "form-control",
                        "placeholder" => lang('phone')
                    ));
                    ?>
                </div>
            </div>


            <div class="form-group">
                <label for="alternative_phone" class=" col-md-2"><?php echo lang('alternative_phone'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "alternative_phone",
                        "name" => "alternative_phone",
                        "value" => $user_info->alternative_phone,
                        "class" => "form-control",
                        "placeholder" => lang('alternative_phone')
                    ));
                    ?>
                </div>
            </div>


           
            <div class="form-group">
                <label for="web" class=" col-md-2"><?php echo lang('web'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "web",
                        "name" => "web",
                        "value" => $user_info->web,
                        "class" => "form-control",
                        "placeholder" => lang('web')
                    ));
                    ?>
                </div>
            </div>





            <div class="form-group">
                <label for="date_of_hire" class=" col-md-2"><?php echo lang('department'); ?></label>
                <div class="col-md-10">
                   

                <select name="department" class="form-control" required>   
              <option value=""></option> 
                <?php 
                    $department_type = $user_info->department ? $user_info->department : '';
                ?>
                <?php foreach($department_info as $di){?>
                    <option 
                    
                    <?php
                        if($department_type != ''){
                            echo ($department_type == $di->id) ? ' selected' : '';
                        }
                    ?>
                    value="<?php echo $di->id; ?>"><?php echo $di->name; ?>
        </option>
       <?php }  ?>                                                      
        </select>

                </div>
            </div>
            
           
            <div class="form-group">
                <label for="skype" class=" col-md-2">Skype</label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "skype",
                        "name" => "skype",
                        "value" => $user_info->skype ? $user_info->skype : "",
                        "class" => "form-control",
                        "placeholder" => "Skype"
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="dob" class=" col-md-2"><?php echo lang('date_of_birth'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "dob",
                        "name" => "dob",
                        "value" => $user_info->dob,
                        "class" => "form-control",
                        "placeholder" => lang('date_of_birth'),
                        "autocomplete" => "off"
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="ssn" class=" col-md-2"><?php echo lang('ssn'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "ssn",
                        "name" => "ssn",
                        "value" => $user_info->ssn,
                        "class" => "form-control",
                        "placeholder" => lang('ssn')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="gender" class=" col-md-2"><?php echo lang('gender'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_radio(array(
                        "id" => "gender_male",
                        "name" => "gender",
                            ), "male", ($user_info->gender === "male") ? true : false);
                    ?>
                    <label for="gender_male" class="mr15"><?php echo lang('male'); ?></label> <?php
                    echo form_radio(array(
                        "id" => "gender_female",
                        "name" => "gender",
                            ), "female", ($user_info->gender === "female") ? true : false);
                    ?>
                    <label for="gender_female" class=""><?php echo lang('female'); ?></label>
                </div>
            </div>



            <div class="form-group">
                <label for="fathers_name" class=" col-md-2"><?php echo lang('fathers_name'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "fathers_name",
                        "name" => "fathers_name",
                        "value" => $user_info->fathers_name,
                        "class" => "form-control",
                        "placeholder" => lang('fathers_name')
                    ));
                    ?>
                </div>
            </div>



            <div class="form-group">
                <label for="mothers_name" class=" col-md-2"><?php echo lang('mothers_name'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "mothers_name",
                        "name" => "mothers_name",
                        "value" => $user_info->mothers_name,
                        "class" => "form-control",
                        "placeholder" => lang('mothers_name')
                    ));
                    ?>
                </div>
            </div>



            <div class="form-group">
                <label for="spouse_name" class=" col-md-2"><?php echo lang('spouse_name'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "spouse_name",
                        "name" => "spouse_name",
                        "value" => $user_info->spouse_name,
                        "class" => "form-control",
                        "placeholder" => lang('spouse_name')
                    ));
                    ?>
                </div>
            </div>

    <div class="form-group">
                <label for="academic_quali" class=" col-md-2"><?php echo lang('academic_quali'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "academic_quali",
                        "name" => "academic_quali",
                        "value" => $user_info->academic_quali,
                        "class" => "form-control",
                        "placeholder" => lang('academic_quali')
                    ));
                    ?>
                </div>
            </div>
            
<!--R.V_01_03S-->


<div id="post-dropzone">
            <div class="form-group">
            <label for="id_name" class=" col-md-2">ID Proof</label>
    <div class=" col-md-6">
   
       

<?php
        $idproof_array = array();

        foreach ($id_proof as $idp) {
            $idproof_array[$idp->id] = $idp->title;
        }

        echo form_dropdown("id_proof", $idproof_array, array($model_info->id_proof), "class='select2 form-control selected'");
        ?>

</div>
<div class="col-md-2">
                <div  class="post-dropzone box-content form-group">
            <?php $this->load->view("includes/dropzone_preview"); ?>

            
                <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> <?php echo lang("upload_file"); ?></button>
            
        </div>
                </div>
    
</div>


<div class="form-group">
            <label for="id_name" class=" col-md-2">Address Proof</label>
    <div class=" col-md-6">
   
       

<?php
        $addrproof_array = array();

        foreach ($address_proof as $addrp) {
            $addrproof_array[$addrp->id] = $addrp->title;
        }

        echo form_dropdown("addr_proof", $addrproof_array, array($model_info->addr_proof), "class='select2 form-control'");
        ?>

</div>
<div class="col-md-2">
<div id="" class="post-dropzone box-content form-group">
               <!--  <div id="post-dropzone1" class="post-dropzone1 box-content form-group">
            <?php $this->load->view("includes/dropzone_preview"); ?> -->

            
                <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> <?php echo lang("upload_file"); ?></button>
            
        </div>
                </div>
    
</div>
</div>
 
<!--R.V_01_03E-->
<div class="form-group">
                <label for="reference" class=" col-md-2"><?php echo lang('reference'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "reference",
                        "name" => "reference",
                        "value" => $user_info->reference,
                        "class" => "form-control",
                        "placeholder" => lang('reference')
                    ));
                    ?>
                </div>
            </div>



            <div class="form-group">
                <label for="marital_status" class=" col-md-2"><?php echo lang('marital_status'); ?></label>
                <div class=" col-md-10">
                <?php
                         $maratial_status = $user_info->marital_status;
                                       
                                ?>
        <select name="marital_status" id="marital_status" class="form-control">
                                    <option value="" selected="" disabled="">Select one</option>
                                    <option value="1" <?php if($maratial_status=="1") echo 'selected="selected"'; ?>>Married</option>
                                    <option value="2" <?php if($maratial_status=="2") echo 'selected="selected"'; ?>>Single</option>
                                    <option value="3" <?php if($maratial_status=="3") echo 'selected="selected"'; ?>>Divorced</option>
                                    <option value="4" <?php if($maratial_status=="4") echo 'selected="selected"'; ?>>Separated</option>
                                    <option value="5" <?php if($maratial_status=="5") echo 'selected="selected"'; ?>>Widowed</option>
                                </select>
                    
                </div>
            </div>


            <div class="form-group">
                <label for="dob" class=" col-md-2"><?php echo lang('dob'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "date",
                        "name" => "dob",
                        "value" => $user_info->dob,
                        "class" => "form-control",
                        "placeholder" => lang('dob')
                    ));
                    ?>
                </div>
            </div>
            <?php $this->load->view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => "col-md-3", "field_column" => " col-md-9")); ?> 

        </div>


            <?php $this->load->view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => "col-md-2", "field_column" => " col-md-10")); ?> 

        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#general-info-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
                setTimeout(function () {
                    window.location.href = "<?php echo get_uri("team_members/view/" . $user_info->id); ?>" + "/general";
                }, 500);
            }
        });
        $("#general-info-form .select2").select2();

        setDatePicker("#dob");

    });


    //R.V01_03S
    $(document).ready(function () {

        var uploadUrl = "<?php echo get_uri("team_members/upload_file"); ?>";
        var validationUrl = "<?php echo get_uri("team_members/validate_post_file"); ?>";

        dropzone = attachDropzoneWithForm("#post-dropzone", uploadUrl, validationUrl);
        dropzone = attachDropzoneWithForm("#post-dropzone1", uploadUrl, validationUrl);

    });
//R.V01_03E
</script>    