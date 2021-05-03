<div class="panel panel-default no-border clearfix mb0">

    <?php echo form_open(get_uri("settings/save_sms_settings"), array("id" => "textlocal-sms-form", "class" => "general-form dashed-row", "role" => "form")); ?>

    <div class="panel-body">

        <div class="form-group">
            <label class=" col-md-12">
                <?php echo lang("get_your_key_from_here") . " " . anchor("https://control.textlocal.in/settings/apikeys/", "Text Local India", array("target" => "_blank")); ?>
            </label>
        </div>

        <div class="form-group">
            <label for="re_captcha_site_key" class=" col-md-2">API Key</label>
            <div class=" col-md-10">
                <?php
                echo form_input(array(
                    "id" => "sms_api_key",
                    "name" => "sms_api_key",
                    "value" => get_setting("sms_api_key"),
                    "class" => "form-control",
                    "placeholder" => "API Key"
                ));
                ?>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
    </div>
    <?php echo form_close(); ?>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#textlocal-sms-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
            }
        });

    });
</script>