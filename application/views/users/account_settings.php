<div class="tab-content">
    <?php
    $url = "team_members";
    $show_submit = true;
    if ($user_info->user_type === "client") {
        $url = "clients";
        if (isset($can_edit_clients) && !$can_edit_clients) {
            $show_submit = false;
        }
    }
    echo form_open(get_uri($url . "/save_account_settings/" . $user_info->id), array("id" => "account-info-form", "class" => "general-form dashed-row white", "role" => "form"));
    ?>
    <div class="panel">
        <div class="panel-default panel-heading">
            <h4><?php echo lang('account_settings'); ?></h4>
        </div>
        <div class="panel-body">
            <input type="hidden" name="first_name" value="<?php echo $user_info->first_name; ?>" />
            <input type="hidden" name="last_name" value="<?php echo $user_info->last_name; ?>" />

            <div class="form-group">
                <label for="bank_acc" class=" col-md-2"><?php echo lang('bank_acc_no'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "bank_acc_no",
                        "name" => "bank_acc_no",
                        "type" => "number",
                        "value" => $user_info->bank_acc_no,
                        "class" => "form-control",
                        "placeholder" => lang('bank_acc_no'),
                       
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-2"><?php echo lang('account_type'); ?></label>
                <div class=" col-md-6">

                <?php
                         $account_type = $user_info->account_type;
                                       
                                ?>
                <select name="account_type" id="" class="form-control">
                                    <option value="" selected="" disabled="">Select one</option>
                                    <option <?php if($account_type=="1") echo 'selected="selected"'; ?> value="1">Current</option>
                                    <option <?php if($account_type=="2") echo 'selected="selected"'; ?> value="2">Savings</option>
                                    <option <?php if($account_type=="3") echo 'selected="selected"'; ?> value="3">Salary account</option>
                                    
                                </select>
                    
                </div>
                </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-2"><?php echo lang('acc_holder_name'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "acc_holder_name",
                        "name" => "acc_holder_name",
                        "value" => $user_info->acc_holder_name,
                        "class" => "form-control",
                        "placeholder" => lang('acc_holder_name'),
                       
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-2"><?php echo lang('ifsc_code'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "ifsc_code",
                        "name" => "ifsc_code",
                        "value" => $user_info->ifsc_code,
                        "class" => "form-control",
                        "placeholder" => lang('ifsc_code'),
                       
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-2"><?php echo lang('bank_name'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "bank_name",
                        "name" => "bank_name",
                        "value" => $user_info->bank_name,
                        "class" => "form-control",
                        "placeholder" => lang('bank_name'),
                       
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bank_acc" class=" col-md-2"><?php echo lang('branch'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "branch_name",
                        "name" => "branch_name",
                        "value" => $user_info->branch_name,
                        "class" => "form-control",
                        "placeholder" => lang('branch'),
                       
                    ));
                    ?>
                </div>
            </div>




            <div class="form-group">
                <label for="email" class=" col-md-2"><?php echo lang('email'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "email",
                        "name" => "email",
                        "value" => $user_info->email,
                        "class" => "form-control",
                        "placeholder" => lang('email'),
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
                <label for="password" class=" col-md-2"><?php echo lang('password'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_password(array(
                        "id" => "password",
                        "name" => "password",
                        "class" => "form-control",
                       // "value" => $user_info->password,
                        "placeholder" => lang('password'),
                        "autocomplete" => "off",
                        "data-rule-minlength" => 6,
                        "data-msg-minlength" => lang("enter_minimum_6_characters"),
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="retype_password" class=" col-md-2"><?php echo lang('retype_password'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_password(array(
                        "id" => "retype_password",
                        "name" => "retype_password",
                        "class" => "form-control",
                        "placeholder" => lang('retype_password'),
                        "autocomplete" => "off",
                        "data-rule-equalTo" => "#password",
                        "data-msg-equalTo" => lang("enter_same_value")
                    ));
                    ?>
                </div>
            </div>

            <?php if ($user_info->user_type === "staff" && $this->login_user->is_admin) { ?>
                <div class="form-group">
                    <label for="role" class=" col-md-2"><?php echo lang('role'); ?></label>
                    <div class=" col-md-10">
                        <?php
                        if ($this->login_user->id == $user_info->id) {
                            echo "<div class='ml15'>" . lang("admin") . "</div>";
                        } else {
                            echo form_dropdown("role", $role_dropdown, array($user_info->role_id), "class='select2' id='user-role'");
                            ?>
                            <div id="user-role-help-block" class="help-block ml10 <?php echo $user_info->role_id === "admin" ? "" : "hide" ?>"><i class="fa fa-warning text-warning"></i> <?php echo lang("admin_user_has_all_power"); ?></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->login_user->is_admin && $user_info->id !== $this->login_user->id) { ?>
                <div class="form-group">
                    <label for="disable_login" class="col-md-2"><?php echo lang('disable_login'); ?></label>
                    <div class="col-md-10">
                        <?php
                        echo form_checkbox("disable_login", "1", $user_info->disable_login ? true : false, "id='disable_login' class='ml15'");
                        ?>
                        <span id="disable-login-help-block" class="ml10 <?php echo $user_info->disable_login ? "" : "hide" ?>"><i class="fa fa-warning text-warning"></i> <?php echo lang("disable_login_help_message"); ?></span>
                    </div>
                </div>

                <?php if ($user_info->user_type === "staff") { ?>
                    <div class="form-group">
                        <label for="user_status" class="col-md-2"><?php echo lang('mark_as_inactive'); ?></label>
                        <div class="col-md-10">
                            <?php
                            echo form_checkbox("status", "inactive", $user_info->status === "inactive" ? true : false, "id='user_status' class='ml15'");
                            ?>
                            <span id="user-status-help-block" class="ml10 <?php echo $user_info->status === "inactive" ? "" : "hide" ?>"><i class="fa fa-warning text-warning"></i> <?php echo lang("mark_as_inactive_help_message"); ?></span>
                        </div>
                    </div>
                <?php } ?>

            <?php } ?>

            <?php if ($user_info->user_type === "client" && $this->login_user->is_admin) { ?>
                <div class="form-group hide" id="resend_login_details_section">
                    <label for="email_login_details" class="col-md-2"><?php echo lang('email_login_details'); ?></label>
                    <div class="col-md-10">
                        <?php
                        echo form_checkbox("email_login_details", "1", false, "id='email_login_details' class='ml15'");
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if ($show_submit) { ?>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
            </div>
        <?php } ?>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#account-info-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
            }
        });
        $("#account-info-form .select2").select2();


        //show/hide asmin permission help message
        $("#user-role").change(function () {
            if ($(this).val() === "admin") {
                $("#user-role-help-block").removeClass("hide");
            } else {
                $("#user-role-help-block").addClass("hide");
            }
        });

        //show/hide disable login help message
        $("#disable_login").click(function () {
            if ($(this).is(":checked")) {
                $("#disable-login-help-block").removeClass("hide");
            } else {
                $("#disable-login-help-block").addClass("hide");
            }
        });

        //show/hide user status help message
        $("#user_status").click(function () {
            if ($(this).is(":checked")) {
                $("#user-status-help-block").removeClass("hide");
            } else {
                $("#user-status-help-block").addClass("hide");
            }
        });

        //the checkbox will be enable if anyone enter the password
        $("#password").change(function () {
            var password = $("#password").val();
            if (password) {
                $("#resend_login_details_section").removeClass("hide");
            } else {
                $("#resend_login_details_section").addClass("hide");
            }
        });
    });
</script>    