<?php echo form_open(get_uri("expenses/save_new"), array("id" => "expense-form", "class" => "general-form", "role" => "form")); ?>
<div id="expense-dropzone" class="post-dropzone">
    <div class="modal-body clearfix">
        <input type="hidden" name="id" id="update-id" value="<?php echo $model_info->id; ?>" />

        <div class="form-group">
            <label for="title" class=" col-md-3">Date</label>
            <div class="col-md-9">
                <input type="text" id="expense_date" name="expense_date" class="form-control" placeholder="Expense date" value="<?php echo ($model_info->expense_date) ? $model_info->expense_date : date('Y-m-d'); ?>"/>
            </div>
        </div>

        <div class=" form-group">
            <label for="title" class=" col-md-3">Time</label>
            <div class="col-md-9">
                <?php
                echo form_input(array(
                    "id" => "time",
                    "name" => "expense_time",
                    "class" => "form-control",
                    "value" => ($model_info->time) ? $model_info->time : ''
                ));
                ?>
            </div>
        </div>


        <div class="form-group">
            <label for="category_id" class=" col-md-3">Expense Category</label>
            <div class="col-md-9">
                <select id="expense_category" class="form-control" name="expense_category" required>
                    <option value=""> -- Select Expense Category --</option>
                    <option <?php echo ($model_info->expense_category == "petty_cash") ? ' selected': ''; ?> value="petty_cash">Petty Cash</option>
                    <option <?php echo ($model_info->expense_category == "payroll") ? ' selected': ''; ?> value="payroll">Payroll</option>
                    <option <?php echo ($model_info->expense_category == "allowance") ? ' selected': ''; ?> value="allowance">Allowance</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label  class=" col-md-3">Expense Name</label>
            <div class="col-md-9">
                <div id="show_this_first" class="form-control">Please select expense category</div>
                <div id="show_expense_text">
                        <input type="text" name="expense_name" value="<?php echo $model_info->expense_name; ?>" class="form-control expense-name">
                </div>
                <div id="show_expense_select">
                        <select id="expense-name-list" name="expense_name" class="form-control select2">

                        </select>
                </div>
            </div>
        </div> 
            
        <div class="form-group" id="employee-list">
            <label for="category_id" class=" col-md-3">Employee Name</label>
            <div class="col-md-9">
                <select class="form-control select2" name="employee_id">
                    <option value=""> -- Select Employee --</option>
                    <?php 
                        foreach($employee_list as $em){
                            ?>
                                <option
                                
                                <?php if($model_info->user_id){
                                  echo ($model_info->user_id == $em->id) ? ' selected' : '';
                                } ?>

                                 value="<?= $em->id?>"><?php echo $em->emp_id." - ".$em->first_name." ".$em->last_name; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="category_id" class=" col-md-3">Account Name</label>
            <div class="col-md-9">
                <select class="form-control select2" name="account_id">
                    <option value=""> -- Select Account --</option>
                    <?php 
                        foreach($account_list as $al){
                            ?>
                                <option 
                                
                                <?php if($model_info->account_id){
                                  echo ($model_info->account_id == $al->id) ? ' selected' : '';
                                } ?>
                                
                                value="<?= $al->id?>"><?php echo $al->name." [ ".$al->account_no." ]"; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="category_id" class=" col-md-3">Amount</label>
            <div class="col-md-9">
                <input type="text" name="amount" class="form-control" placeholder="Enter expense amount" value="<?php echo ($model_info->amount) ? $model_info->amount : ''; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="category_id" class=" col-md-3">Payment Mode</label>
            <div class="col-md-9">
                <select class="form-control select2" name="payment_method">
                    <option value=""> -- Select Payment Mode --</option>
                    <?php 
                        foreach($payment_methods as $pm){
                            ?>
                                <option 
                                
                                <?php if($model_info->payment_method){
                                  echo ($model_info->payment_method == $pm->id) ? ' selected' : '';
                                } ?>
                                
                                value="<?= $pm->id?>"><?php echo $pm->title; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="category_id" class=" col-md-3">Notes</label>
            <div class="col-md-9">
                <input type="text" name="notes" class="form-control" placeholder="Notes"  value="<?php echo ($model_info->notes) ? $model_info->notes : ''; ?>"/>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <div class="row">
            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {

        $("#expense-form").appForm({
            onSuccess: function (result) {
                if (typeof $EXPENSE_TABLE !== 'undefined') {
                    $EXPENSE_TABLE.appTable({newData: result.data, dataId: result.id});
                } else {
                    location.reload();
                }
            },
            onAjaxSuccess: function (result) {
                if (!result.success && result.next_recurring_date_error) {
                    $("#next_recurring_date").val(result.next_recurring_date_value);
                    $("#next_recurring_date_container").removeClass("hide");

                    $("#expense-form").data("validator").showErrors({
                        "next_recurring_date": result.next_recurring_date_error
                    });
                }
            }
        });
        
        setDatePicker("#expense_date");

        $(".select2").select2();

        $('[data-toggle="tooltip"]').tooltip();
        $("#time").timepicker({
            'timeFormat': 'H:i:s',
            'step': '10',
            'forceRoundTime': true,
            'scrollDefault': '10:00:00',
        });

        var updateId = $('#update-id').val();
        var options = "";
        if(updateId){
            var expenseCategory = '<?php echo $model_info->expense_category; ?>';
            if(expenseCategory == "petty_cash"){
                $('#show_this_first').hide(200);
                $('#show_expense_text').show();
                $('.expense-name').val('<?php echo $model_info->expense_name; ?>');
            }else if(expenseCategory == "payroll"){
                $('#show_this_first').hide(200);
                $('#show_expense_select').show();
                $('#show_expense_text').hide();
                $('#employee-list').show();
                options += '<option selected value="advance">Advance</option>';
                $('#expense-name-list').append(options);
            }else if(expenseCategory == "allowance"){
                var expenseName = '<?php echo $model_info->expense_name; ?>';
                $('#show_this_first').hide(200);
                $('#show_expense_select').show();

                var petrolSelect = "";
                var lodgeSelect  = "";
                var foodSelect   = "";
                var othersSelect = "";

                if(expenseName == "petrol"){
                    petrolSelect = " selected";
                }else if(expenseName == "lodge"){
                    lodgeSelect  = " selected";
                }else if(expenseName == "food"){
                    foodSelect   = " selected";
                }else{
                    othersSelect = " selected";
                }

                options += '<option '+petrolSelect+' value="petrol">Petrol</option>';
                options += '<option '+lodgeSelect+'  value="lodge">Lodge</option>';
                options += '<option '+foodSelect+'  value="food">Food</option>';
                options += '<option '+othersSelect+'  value="others">Others</option>';

                $('#expense-name-list').append(options);
            }
        }else{
            $('#show_expense_text').hide();
            $('#show_expense_select').hide();
            $('#expense-name-list').empty();
            $('#show_this_first').show();
            $('#employee-list').hide();
        }
    });

    $(document).on('change', '#expense_category', function(){
        $('#show_expense_text').hide();
        $('#show_expense_select').hide();
        $('#expense-name-list').empty();
        $('#show_this_first').show();
        $('#employee-list').hide();

        var expenseCategory = $(this).val();
        var options = "";
        if(expenseCategory === "petty_cash"){
            $('#show_this_first').hide(200);
            $('#show_expense_text').show();
        }else if(expenseCategory === "payroll"){
            $('#show_this_first').hide(200);
            $('#show_expense_select').show();
            $('#employee-list').show();
            options += '<option value="advance">Advance</option>';
            $('#expense-name-list').append(options);
        }else if(expenseCategory === "allowance"){
            $('#show_this_first').hide(200);
            $('#show_expense_select').show();
            options += '<option value="petrol">Petrol</option>';
            options += '<option value="lodge">Lodge</option>';
            options += '<option value="food">Food</option>';
            options += '<option value="others">Others</option>';
            $('#expense-name-list').append(options);
        }
    });

    

</script>