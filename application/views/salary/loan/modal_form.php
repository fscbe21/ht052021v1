<?php echo form_open(get_uri("loan/save"), array("id" => "loan-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />
<div class="modal-body clearfix">
<input type="hidden" name="id" value="<?php echo isset($loan_id) ? $loan_id : ''; ?>"/>


<div class="form-group">
    <label for="empy_id" class="<?php echo $label_column; ?>"><?php echo "Employee Name"; ?></label>
    <div class="<?php echo $field_column; ?>">
    <select name="user_id" class="form-control" required>   
            <option value="" > Select Employee</option> 

            <?php 
                $userid = isset($loan_userid) ? $loan_userid : 0;
            ?>
                    <?php foreach($employee_list as $emp){?>
                        <option 
                        
                        <?php
                            if($userid != 0){
                                echo ($loan_userid == $emp->id) ? ' selected' : '';
                            }
                        ?>
                        value="<?php echo $emp->id; ?>"><?php echo $emp->first_name." ".$emp->last_name ; ?>
            </option>
                    <?php }  ?>                                                      
        </select>
    </div>
</div>

<div class="form-group ">
    <label for="loan_name" class="<?php echo $label_column; ?>"><?php echo "Loan Name"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "loan_name",
            "name" => "loan_name",
            "value" => isset($loan_name) ? $loan_name : '',
            "class" => "form-control",
            "placeholder" => "Loan Name",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group ">
    <label for="no_instal" class="<?php echo $label_column; ?>"><?php echo "Number of Installment"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "no_instal",
            "name" => "number_of_emi",
            "value" => isset($number_of_emi) ? $number_of_emi : '',
            "class" => "form-control",
            "placeholder" => "Number of Installment",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group ">
    <label for="amt" class="<?php echo $label_column; ?>"><?php echo "Loan Amount"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "amt",
            "name" => "loan_amount",
            "value" => isset($loan_amount) ? $loan_amount : '',
            "class" => "form-control",
            "placeholder" => "Loan Amount",
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="descrpition" class="<?php echo $label_column; ?>"><?php echo "Loan Description"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "descrpition",
            "name" => "descrpition",
            "value" => isset($loan_desc) ? $loan_desc : '',
            "class" => "form-control",
            "placeholder" => "Loan Description"
        ));
        ?>

    </div>
</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
   $(document).ready(function () {
        $("#loan-form").appForm({
            onSuccess: function (result) {
                console.log("res"+result.message);
                appAlert.success(result.message, {duration: 10000});
                var reloadUrl = "<?php echo echo_uri("loan"); ?>";
                if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
     
       
        
      
    });
</script>    



