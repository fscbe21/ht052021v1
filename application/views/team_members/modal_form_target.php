<?php echo form_open(get_uri("team_members/add_target"), array("id" => "team_member-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">

    <div class="mt15">
        <div class="p-2">
            <div class="form-group">
                <label for="name" class=" col-md-3">Month / Year</label>
                <div class=" col-md-4">
                    <input type="text" class="form-control" name="mnth" value="<?php echo date('M'); ?>" disabled/>
                </div>
                <div class=" col-md-4">
                    <input type="text" class="form-control" name="yer" value="<?php echo date('Y'); ?>" disabled/>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class=" col-md-3">Total Days</label>
                <div class=" col-md-9">
                <?php

                    $days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
                ?>
                    <input type="text" class="form-control" id="total_days" name="toal_days" value="<?php echo $days; ?>" disabled/>
                </div>
            </div>

            <div class="form-group">
                <label for="phone" class=" col-md-3">Holidays *</label>
                <div class=" col-md-9">
                    <input type="number" class="form-control" id="holidays" name="holidays" placeholder="Enter total holidays in this month" required/>
                </div>
            </div>

            <div class="form-group">
                <label for="phone" class=" col-md-3">Actual Days</label>
                <div class=" col-md-9">
                <input type="text" class="form-control" id="actual_days" name="actual_days"/>
                </div>
            </div>

            <div class="form-group">
                <label for="phone" class=" col-md-3">Target *</label>
                <div class=" col-md-9">
                <input type="number" class="form-control" id="target" name="target" min="1" placeholder="Enter target value" required/>
                </div>
            </div>

            <div class="form-group">
                <label for="phone" class=" col-md-3">Average </label>
                <div class=" col-md-9">
                <input type="text" class="form-control" id="avg" name="avg"/>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="empid" value="<?php echo $empid; ?>"/>
<input type="hidden" name="month" value="<?php echo date('m'); ?>"/>
<input type="hidden" name="year" value="<?php echo date('Y'); ?>"/>
<input type="hidden" name="total_days" value="<?php echo $days; ?>"/>

<div class="modal-footer">
    <button class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>

    <input type="submit" name="submit" class="btn btn-primary" value="Update"/>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#holidays').val(0);
        $('#actual_days').val($('#total_days').val());
    });

    $(document).on('change', '#holidays', function(){
        var holidays  = $('#holidays').val();
        var totalDays = $('#total_days').val();
        var actualDays = totalDays - holidays;
        $('#actual_days').val(actualDays);
        var targetAmount = $('#target').val();
        var targetAvg    = parseFloat((targetAmount * actualDays) / totalDays);
        targetAvg = targetAvg.toFixed(2);
        $('#avg').val(targetAvg);
    });

    $(document).on('change', '#target', function(){
        var targetAmount = $('#target').val();
        var holidays  = $('#holidays').val();
        var totalDays = $('#total_days').val();
        var actualDays = totalDays - holidays;
        var targetAvg    = parseFloat((targetAmount * actualDays) / totalDays);
        targetAvg = targetAvg.toFixed(2);
        $('#avg').val(targetAvg);
    });


</script>