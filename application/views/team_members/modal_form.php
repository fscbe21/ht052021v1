<?php echo form_open(get_uri("team_members/add_team_member"), array("id" => "team_member-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">

    <div class="form-widget">
        <div class="widget-title clearfix">
            <div id="general-info-label" class="col-sm-4"><i class="fa fa-circle-o"></i><strong> <?php echo lang('general_info'); ?></strong></div>
            <div id="job-info-label" class="col-sm-4"><i class="fa fa-circle-o"></i><strong>  <?php echo lang('job_info'); ?></strong></div>
            <div id="account-info-label" class="col-sm-4"><i class="fa fa-circle-o"></i><strong>  <?php echo lang('account_settings'); ?></strong></div> 
        </div>

        <div class="progress ml15 mr15">
            <div id="form-progress-bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
            </div>
        </div>
    </div>

    <div class="tab-content mt15">


    
  <!-- R.V22_2 start-->
        <div role="tabpanel" class="tab-pane active" id="general-info-tab">
        <div class="form-group">
                <label for="name" class=" col-md-3"><?php echo lang('emp_id'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "emp_id",
                        "name" => "emp_id",
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
                <label for="name" class=" col-md-3"><?php echo lang('first_name'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "first_name",
                        "name" => "first_name",
                        "class" => "form-control",
                        "placeholder" => lang('first_name'),
                        "autofocus" => true,
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class=" col-md-3"><?php echo lang('last_name'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "last_name",
                        "name" => "last_name",
                        "class" => "form-control",
                        "placeholder" => lang('last_name'),
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class=" col-md-3"><?php echo lang('mailing_address'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_textarea(array(
                        "id" => "address",
                        "name" => "address",
                        "class" => "form-control",
                        "placeholder" => lang('mailing_address')
                    ));
                    ?>
                </div>
            </div> 
            <div class="form-group">
                <label for="phone" class=" col-md-3"><?php echo lang('phone'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "phone",
                        "name" => "phone",
                        "class" => "form-control",
                        "placeholder" => lang('phone')
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="Emergency_contact" class=" col-md-3"><?php echo lang('Emergency_contact'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "Emergency_contact",
                        "name" => "alternative_phone",
                        "class" => "form-control",
                        "placeholder" => lang('Emergency_contact')
                    ));
                    ?>
                </div>
            </div>


           
            <div class="form-group">
                <label for="web" class=" col-md-3"><?php echo lang('web'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "web",
                        "name" => "web",
                        "class" => "form-control",
                        "placeholder" => lang('web')
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="gender" class=" col-md-3"><?php echo lang('gender'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_radio(array(
                        "id" => "gender_male",
                        "name" => "gender",
                            ), "male", true);
                    ?>
                    <label for="gender_male" class="mr15"><?php echo lang('male'); ?></label> <?php
                    echo form_radio(array(
                        "id" => "gender_female",
                        "name" => "gender",
                            ), "female", false);
                    ?>
                    <label for="gender_female" class=""><?php echo lang('female'); ?></label>
                </div>
            </div>
           
            <div class="form-group">
                <label for="fathers_name" class=" col-md-3"><?php echo lang('fathers_name'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "fathers_name",
                        "name" => "fathers_name",
                        "class" => "form-control",
                        "placeholder" => lang('fathers_name')
                    ));
                    ?>
                </div>
            </div>



            <div class="form-group">
                <label for="mothers_name" class=" col-md-3"><?php echo lang('mothers_name'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "mothers_name",
                        "name" => "mothers_name",
                        "class" => "form-control",
                        "placeholder" => lang('mothers_name')
                    ));
                    ?>
                </div>
            </div>



            <div class="form-group">
                <label for="spouse_name" class=" col-md-3"><?php echo lang('spouse_name'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "spouse_name",
                        "name" => "spouse_name",
                        "class" => "form-control",
                        "placeholder" => lang('spouse_name')
                    ));
                    ?>
                </div>
            </div>

    <div class="form-group">
                <label for="academic_quali" class=" col-md-3"><?php echo lang('academic_quali'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "academic_quali",
                        "name" => "academic_quali",
                        "class" => "form-control",
                        "placeholder" => lang('academic_quali')
                    ));
                    ?>
                </div>
            </div>



<!--R.V_01_03S-->
<div id="post-dropzone">
            <div class="form-group">
            <label for="id_name" class=" col-md-3">ID Proof</label>
    <div class=" col-md-6">
   
       

<?php
        $idproof_array = array();

        foreach ($id_proof as $idp) {
            $idproof_array[$idp->id] = $idp->title;
        }

        echo form_dropdown("id_proof", $idproof_array, array($model_info->id_proof), "class='select2 form-control'");
        ?>

</div>
<div class="col-md-3">
                <div  class="post-dropzone box-content form-group">
            <?php $this->load->view("includes/dropzone_preview"); ?>

            
                <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> <?php echo lang("upload_file"); ?></button>
            
        </div>
                </div>
    
</div>


<div class="form-group">
            <label for="id_name" class=" col-md-3">Address Proof</label>
    <div class=" col-md-6">
   
       

<?php
        $addrproof_array = array();

        foreach ($address_proof as $addrp) {
            $addrproof_array[$addrp->id] = $addrp->title;
        }

        echo form_dropdown("addr_proof", $addrproof_array, array($model_info->addr_proof), "class='select2 form-control'");
        ?>

</div>
<div class="col-md-3">
<div id="" class="post-dropzone box-content form-group">
                <!--<div id="post-dropzone" class="post-dropzone box-content form-group">
            <?php $this->load->view("includes/dropzone_preview"); ?>-->

            
                <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> <?php echo lang("upload_file"); ?></button>
            
        </div>
                </div>
    
</div>
</div>

 
<!--R.V_01_03E-->
<div class="form-group"><!-- department_list -->
                <label for="department" class=" col-md-3"><?php echo lang('department'); ?></label>
                <div class=" col-md-9">
                    <!-- <?php
                    echo form_input(array(
                        "id" => "department",
                        "name" => "department",
                        "class" => "form-control",
                        "placeholder" => lang('department')
                    ));
                    ?> -->

                <select name="department" class="form-control" required>   
              <option value="" ></option> 
                <?php 
                    $department_type = $model_info->department ? $model_info->department : '';
                ?>
                <?php foreach($department_list as $dl){?>
                    <option 
                    
                    <?php
                        if($department_type != ''){
                            echo ($department_type == $dl->id) ? ' selected' : '';
                        }
                    ?>
                    value="<?php echo $dl->id; ?>"><?php echo $dl->name; ?>
        </option>
       <?php }  ?>                                                      
        </select>


                </div>
            </div>




            <div class="form-group">
                <label for="reference" class=" col-md-3"><?php echo lang('reference'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "reference",
                        "name" => "reference",
                        "class" => "form-control",
                        "placeholder" => lang('reference')
                    ));
                    ?>
                </div>
            </div>



            <div class="form-group">
                <label for="marital_status" class=" col-md-3"><?php echo lang('marital_status'); ?></label>
                <div class=" col-md-9">
                <select name="marital_status" id="marital_status" class="form-control">
                                    <option value="" selected="" disabled="">Select one</option>
                                    <option value="1">Married</option>
                                    <option value="2">Single</option>
                                    <option value="3">Divorced</option>
                                    <option value="4">Separated</option>
                                    <option value="5">Widowed</option>
                                </select>
                    
                </div>
            </div>


            <div class="form-group">
                <label for="dob" class=" col-md-3"><?php echo lang('dob'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "date",
                        "name" => "dob",
                        "class" => "form-control",
                        "placeholder" => lang('dob')
                    ));
                    ?>
                </div>
            </div>
            <?php $this->load->view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => "col-md-3", "field_column" => " col-md-9")); ?> 

        </div>

        
  <!-- R.V22_2 end-->
        <div role="tabpanel" class="tab-pane" id="job-info-tab">
            <div class="form-group"><!-- ANAND10022021 -->
                <label for="job_title" class=" col-md-3">Current&nbsp;<?php echo lang('job_title'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "job_title",
                        "name" => "job_title",
                        "class" => "form-control",
                        "placeholder" => "Current ".lang('job_title'),
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">  <!-- ANAND10022021 -->
                <label for="job_title" class=" col-md-3">Last&nbsp;<?php echo lang('job_title'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "last_job_title",
                        "name" => "last_job_title",
                        "class" => "form-control",
                        "placeholder" => "Last job title"
                    ));
                    ?>
                </div>
            </div>
  <!-- R.V22_2-->
            <div class="form-group"><!-- ANAND10022021 -->

          
                <label for="job_title" class=" col-md-3">Professional Qualification</label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "qualification",
                        "name" => "qualification",
                        "class" => "form-control",
                        "placeholder" => "Qualification",
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                    ));
                    ?>
                </div>
            </div>
  <!-- R.V22_2-->
            <div class="form-group">
                <label for="salary" class=" col-md-3"><?php echo lang('salary'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "salary",
                        "name" => "salary",
                        "class" => "form-control",
                        "placeholder" => lang('salary')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="salary_term" class=" col-md-3"><?php echo lang('salary_term'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "salary_term",
                        "name" => "salary_term",
                        "class" => "form-control",
                        "placeholder" => lang('salary_term')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="date_of_hire" class=" col-md-3"><?php echo lang('date_of_hire'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "date_of_hire",
                        "name" => "date_of_hire",
                        "class" => "form-control",
                        "placeholder" => lang('date_of_hire'),
                        "autocomplete" => "off"
                    ));
                    ?>
                </div>
            </div>
        </div>
   <!-- R.V01_03 Start-->

        <div role="tabpanel" class="tab-pane" id="account-info-tab">
          

            <div class="form-group">
                <label for="bank_acc" class=" col-md-3"><?php echo lang('bank_acc_no'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "bank_acc_no",
                        "name" => "bank_acc_no",
                        "class" => "form-control",
                        "placeholder" => lang('bank_acc_no'),
                       
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-3"><?php echo lang('account_type'); ?></label>
                <div class=" col-md-6">
                <select name="account_type" id="" class="form-control">
                                    <option value="" selected="" disabled="">Select one</option>
                                    <option value="1">Current</option>
                                    <option value="2">Savings</option>
                                    <option value="3">Salary account</option>
                                    
                                </select>
                    
                </div>
                </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-3"><?php echo lang('acc_holder_name'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "acc_holder_name",
                        "name" => "acc_holder_name",
                        "class" => "form-control",
                        "placeholder" => lang('acc_holder_name'),
                       
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-3"><?php echo lang('ifsc_code'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "ifsc_code",
                        "name" => "ifsc_code",
                        "class" => "form-control",
                        "placeholder" => lang('ifsc_code'),
                       
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-3"><?php echo lang('bank_name'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "bank_name",
                        "name" => "bank_name",
                        "class" => "form-control",
                        "placeholder" => lang('bank_name'),
                       
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-3"><?php echo lang('branch'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "branch_name",
                        "name" => "branch_name",
                        "class" => "form-control",
                        "placeholder" => lang('branch'),
                       
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class=" col-md-3"><?php echo lang('email'); ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "email",
                        "name" => "email",
                        "class" => "form-control",
                        "placeholder" => lang('email'),
                        "autofocus" => true,
                        "autocomplete" => "off",
                        "data-rule-email" => true,
                        "data-msg-email" => lang("enter_valid_email"),
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3"><?php echo lang('password'); ?></label>
                <div class=" col-md-8">
                    <div class="input-group">
                        <?php
                        echo form_password(array(
                            "id" => "password",
                            "name" => "password",
                            "class" => "form-control",
                            "placeholder" => lang('password'),
                            "autocomplete" => "off",
                            "data-rule-required" => true,
                            "data-msg-required" => lang("field_required"),
                            "data-rule-minlength" => 6,
                            "data-msg-minlength" => lang("enter_minimum_6_characters"),
                            "autocomplete" => "off",
                            "style" => "z-index:auto;"
                        ));
                        ?>
                        <label for="password" class="input-group-addon clickable" id="generate_password"><span class="fa fa-key"></span> <?php echo lang('generate'); ?></label>
                    </div>
                </div>
                <div class="col-md-1 p0">
                    <a href="#" id="show_hide_password" class="btn btn-default" title="<?php echo lang('show_text'); ?>"><span class="fa fa-eye"></span></a>
                </div>
            </div>

          

            <div class="form-group">
                <label for="role" class="col-md-3"><?php echo lang('role'); ?></label>
                <div class="col-md-9">
                    <?php
                    echo form_dropdown("role", $role_dropdown, array(), "class='select2' id='user-role'");
                    ?>
                    <div id="user-role-help-block" class="help-block ml10 hide"><i class="fa fa-warning text-warning"></i> <?php echo lang("admin_user_has_all_power"); ?></div>
                </div>
            </div>

            


            <div class="form-group ">
                <div class="col-md-12">  
                    <?php
                    echo form_checkbox("email_login_details", "1", true, "id='email_login_details'");
                    ?> <label for="email_login_details"><?php echo lang('email_login_details'); ?></label>
                </div>
            </div>
        </div>
<!-- R.V01_03 End-->


		
		
		
		
    </div>

</div>


<div class="modal-footer">
    <button class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button id="form-previous" type="button" class="btn btn-default hide"><span class="fa fa-arrow-circle-left"></span> <?php echo lang('previous'); ?></button>
    <button id="form-next" type="button" class="btn btn-info"><span class="fa  fa-arrow-circle-right"></span> <?php echo lang('next'); ?></button>
    <button id="form-submit" type="button" class="btn btn-primary hide"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#team_member-form").appForm({
            onSuccess: function (result) {
                if (result.success) {
                    $("#team_member-table").appTable({newData: result.data, dataId: result.id});
                }
            },
            onSubmit: function () {
                $("#form-previous").attr('disabled', 'disabled');
            },
            onAjaxSuccess: function () {
                $("#form-previous").removeAttr('disabled');
            }
        });

//R.V Start
        setDatePicker("#date, #hour_date");
//R.V End

        $("#team_member-form input").keydown(function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                if ($('#form-submit').hasClass('hide')) {
                    $("#form-next").trigger('click');
                } else {
                    $("#team_member-form").trigger('submit');
                }
            }
        });
        $("#first_name").focus();
        $("#team_member-form .select2").select2();

        setDatePicker("#date_of_hire");

        $("#form-previous").click(function () {
            var $generalTab = $("#general-info-tab"),
                    $jobTab = $("#job-info-tab"),
                    $accountTab = $("#account-info-tab"),
                    $previousButton = $("#form-previous"),
                    $nextButton = $("#form-next"),
                    $submitButton = $("#form-submit");

            if ($accountTab.hasClass("active")) {
                $accountTab.removeClass("active");
                $jobTab.addClass("active");
                $nextButton.removeClass("hide");
                $submitButton.addClass("hide");
            } else if ($jobTab.hasClass("active")) {
                $jobTab.removeClass("active");
                $generalTab.addClass("active");
                $previousButton.addClass("hide");
                $nextButton.removeClass("hide");
                $submitButton.addClass("hide");
            }
        });

        $("#form-next").click(function () {
            var $generalTab = $("#general-info-tab"),
                    $jobTab = $("#job-info-tab"),
                    $accountTab = $("#account-info-tab"),
                    $previousButton = $("#form-previous"),
                    $nextButton = $("#form-next"),
                    $submitButton = $("#form-submit");
            if (!$("#team_member-form").valid()) {
                return false;
            }
            if ($generalTab.hasClass("active")) {
                $generalTab.removeClass("active");
                $jobTab.addClass("active");
                $previousButton.removeClass("hide");
                $("#form-progress-bar").width("35%");
                $("#general-info-label").find("i").removeClass("fa-circle-o").addClass("fa-check-circle");
                $("#team_member_id").focus();
            } else if ($jobTab.hasClass("active")) {
                $jobTab.removeClass("active");
                $accountTab.addClass("active");
                $previousButton.removeClass("hide");
                $nextButton.addClass("hide");
                $submitButton.removeClass("hide");
                $("#form-progress-bar").width("72%");
                $("#job-info-label").find("i").removeClass("fa-circle-o").addClass("fa-check-circle");
                $("#username").focus();
            }
        });

        $("#form-submit").click(function () {
            $("#team_member-form").trigger('submit');
        });

        $("#generate_password").click(function () {
            $("#password").val(getRndomString(8));
        });

        $("#show_hide_password").click(function () {
            var $target = $("#password"),
                    type = $target.attr("type");
            if (type === "password") {
                $(this).attr("title", "<?php echo lang("hide_text"); ?>");
                $(this).html("<span class='fa fa-eye-slash'></span>");
                $target.attr("type", "text");
            } else if (type === "text") {
                $(this).attr("title", "<?php echo lang("show_text"); ?>");
                $(this).html("<span class='fa fa-eye'></span>");
                $target.attr("type", "password");
            }
        });

        $("#user-role").change(function () {
            if ($(this).val() === "admin") {
                $("#user-role-help-block").removeClass("hide");
            } else {
                $("#user-role-help-block").addClass("hide");
            }
        });
    });


    /*$(document).ready(function () {

        var uploadUrl = "<?php echo get_uri("timeline/upload_file"); ?>";
        var validationUrl = "<?php echo get_uri("timeline/validate_post_file"); ?>";
        var dropzone = attachDropzoneWithForm("#post-dropzone", uploadUrl, validationUrl);
        dropzone = attachDropzoneWithForm("#post-dropzone1", uploadUrl, validationUrl);

        $("#post-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                if ($("body").hasClass("dropzone-disabled")) {
                    location.reload();
                } else {
                    $("#post_description").val("");
                    $("#timeline").prepend(result.data);
                    dropzone.removeAllFiles();
                }
            }
        });

        });*/
		
		
		//R.V01_03S
    $(document).ready(function () {

        var uploadUrl = "<?php echo get_uri("team_members/upload_file"); ?>";
        var validationUrl = "<?php echo get_uri("team_members/validate_post_file"); ?>";
        
      
        dropzone = attachDropzoneWithForm("#post-dropzone", uploadUrl, validationUrl);
        

       

        });
//R.V01_03E
</script>
