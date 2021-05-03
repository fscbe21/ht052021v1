<div class="modal-body clearfix">
<div class="row" id="info">
    <div class="col-md-4">
        <div class="p-2">
                
            Order :&nbsp;<span><?php echo $info->orders; ?></span><br /><br />
            Company Name :&nbsp;<span><?php echo $info->company_name; ?></span><br /><br />
            Contact Person :&nbsp;<span><?php echo $info->contact_person; ?></span><br /><br />
            Contact phone number :&nbsp;<span><?php echo $info->phone; ?></span><br /><br />
            <?php
            $CI =& get_instance();
            $st = $CI->Lead_status_model->get_one($info->status_id);
            $status = '<span style="padding: 4px;background-color: '.$st->color.'">'.$st->title.'</span>'; 
            ?>
            Status :&nbsp;<span><?php echo $status; ?></span><br /><br />
            Product :&nbsp;<span><?php echo $info->product; ?></span><br /><br />
            Assign to :&nbsp;<span>
            <?php 
                $userinfo = $CI->Users_model->get_one($info->assigned_to);
                echo $userinfo->first_name." ".$userinfo->last_name; ?>
            </span><br /><br />
            <?php
                $visitinfo = $CI->Lead_visit_model->before_transfer_info($info->assigned_to, $info->id);
                $ownerid = $visitinfo[0]->owner_id;
                if($ownerid != ''){
                    $userinfoo  = $CI->Users_model->get_one($ownerid);
                    $first_name =  $userinfoo->first_name." ".$userinfoo->last_name;
                }else{
                    $first_name = "-";
                }
            ?>
            From :&nbsp;<span><?php echo $first_name; ?></span><br /><br />
            
            Followup Date :&nbsp;<span><?php echo dateFormatChange($info->follow_date); ?></span><br /><br />
            Time :&nbsp;<span><?php echo convert_time_to_12hours_format($info->time); ?></span><br /><br />
            Sales Value :&nbsp;<span><?php echo $info->total_value; ?></span><br /><br />
            
           
        </div>
    </div>

   
    <div class="col-md-6" >
        <div class="p-2">
       
        
     
        <?php 
            
            if($visit_info){
                if(count($visit_info) > 3)
                {
                    ?>
                    <div id="dinfo">
                    <?php
                }
                else
                {
                    ?>
                    <div>
                    <?php
                }
                ?>
                
                <?php
               
                foreach($visit_info as $e){
                    $source = $CI->Lead_source_model->get_one($e->lead_source_id);
                    $status = $CI->Lead_status_model->get_one($e->status_id); 
                   
                    foreach ($team_members as $tm) {
                        if($e->owner_id==$tm->id){
                            $name=$tm->first_name;
                        }
                    }
                    echo "<div class='visit-info'><small>".$source->title." - ".$e->timestamp.", ".$status->title.".<br />".$name."<br />".$e->description."<br />"."Follow up date: ".dateFormatChange($e->followup_date).",".convert_time_to_12hours_format($e->time)."</small></div><div class='space'></div>";
                }
               
                ?>
                </div>
                <?php
            }
            else{
                echo "<small class='text-danger'>No visit information found.</small>";

            }
            
            
            ?>
            
        </div>
    </div>
    
</div>

<div id="followup" style="display:none" >
<!--darini 15-2-->
<?php echo form_open(get_uri("new_work_order/save_lead_visit"), array("id" => "lead-visit-form", "class" => "general-form", "role" => "form")); ?>

<input type="hidden" name="lead_id" value="<?php echo $info->id; ?>" />
<div class="form-group">
    <label for="lead_source_id" class="<?php echo $label_column; ?>"><?php echo lang('source'); ?></label>
   
    <div class="form-group <?php echo $field_column; ?>">
    <div style="display:none">
        <?php
        $lead_source = array();

        foreach ($sources as $source) {
            $lead_source[$source->id] = $source->title;
            
            if( $source->id==$info->lead_source_id){
                $sorce_name=$source->title;
            }
        }

        echo form_dropdown("lead_source_id", $lead_source, array($info->lead_source_id), "class='form-control select2'");
        ?>
        </div>
        <input type="text" class="form-control" value="<?php  echo $sorce_name;?>" readonly>
       
    </div>
</div>



<div class="form-group">
    <label for="lead_status_id" class="<?php echo $label_column; ?>"><?php echo lang('status'); ?></label>
    <div class=" form-group <?php echo $field_column; ?>">
        <?php
        foreach ($statuses as $status) {
            $lead_status[$status->id] = $status->title;
        }

        echo form_dropdown("lead_status_id", $lead_status, array($info->lead_status_id), "class='form-control select2'");
        ?>
    </div>
</div>

<div class="form-group">
    <label for="followup_date" class="<?php echo $label_column; ?>"><?php echo lang('followup_date'); ?></label>
    <div class="form-group <?php echo $field_column; ?>">
        <?php
            echo form_input(array(
                "id" => "ffdate",
                "name" => "followup_date",
                "class" => "form-control",
                "value" => "",
                "placeholder" => lang('followup_date'),
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="followup_through" class="<?php echo $label_column; ?>"><?php echo "FollowUp through"; ?></label>
    <div class="form-group <?php echo $field_column; ?>">
       <select class="form-control" name="followup_through" id="followup_through"></select>
    </div>
</div>

<div class="form-group">
    <label for="time" class="  <?php echo $label_column; ?>"><?php echo lang('time'); ?></label>
    <div class="form-group <?php echo $field_column; ?>">
        <?php
            echo form_input(array(
                "id" => "sstime",
                "name" => "time",
                "value" => "",
                "class" => "form-control",
                "placeholder" => lang('time')
            ));
        ?>
    </div>
</div>

<div class="form-group"style="display:none">
    <label for="total_value" class="form-group  <?php echo $label_column; ?>"><?php echo lang('total_value'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "total_value",
            "name" => "total_value",
            "value" => $info->total_value,
            "class" => "form-control",
            "placeholder" => lang('total_value'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
<label for="description" class=" <?php echo $label_column; ?>"><?php echo 'Description'; ?></label>
<div class="form-group <?php echo $field_column; ?>">
    <?php
    echo form_textarea(array(
        "id" => "description",
        "name" => "description",
        "value" => " ",
        "placeholder" => lang('description'),
        "class" => "form-control"
    ));
    ?>
</div>
</div>
<?php   $CI =& get_instance();
 $clnt=$CI->Clients_model->get_one($info->client_id);?>
<div style="display:none"><input type="hidden" name="owner_id" id="owner_id" value="<?php echo $clnt->owner_id;?>"/></div>
<button type="submit" class="btn btn-primary" ><span class="fa fa-check-circle"></span> <?php echo "Save"; ?></button>
<?php echo form_close(); ?><!--end-->
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <a class="btn btn-primary" id="butinfo" onclick="visiblefun()"><span class="fa fa-check-circle"></span>&nbsp;<?php echo "Visit Information"; ?></a>
    <input type="hidden" id="valinfo" value="1"/>
</div>




<style>
        .visit-info{
            padding: 5px;
            background-color: #dfe6e9;
        }

        #dinfo{
            position: absolute; 
            height: 300px;
            width: 100%;
            overflow-y: scroll; 
        }

        .space{
            padding: 3px;
        }
</style>
<script>
$('.modal-dialog').css('width', '90%');
function visiblefun(){
    var  val=document.getElementById("valinfo").value;
    
    if(val=="1"){
        document.getElementById("followup").style.display="block";
        document.getElementById("info").style.display="none";
        document.getElementById("butinfo").innerHTML="<span class='fa fa-check-circle'> </span> Order Information";
        document.getElementById("valinfo").value="0";
        $('.modal-dialog').css('width', '50%');
    }else if(val=="0"){
        document.getElementById("followup").style.display="none";
        document.getElementById("info").style.display="block";
        document.getElementById("butinfo").innerHTML="<span class='fa fa-check-circle'> </span>Visit Information";  
        document.getElementById("valinfo").value="1";
        $('.modal-dialog').css('width', '90%');
            }
}

$(document).ready(function () {
    setDatePicker("#ffdate", {
            startDate: moment().add(0, 'days').format("DD-MM-YYYY")
        });
   // setTimePicker("#start_time, #end_time");
    $("#sstime").timepicker({
            'timeFormat': 'H:i:s'
        }); 

        $("#ffdate").datepicker().datepicker("setDate", new Date());
 });
//darini 15-2

 $(document).ready(function () {
        $("#lead-visit-form").appForm({
            onSuccess: function (result) {
                console.log("res"+result.message);
                appAlert.success(result.message, {duration: 10000});
               var reloadUrl = "<?php echo echo_uri("clients/view/" . $info->client_id); ?>";
              if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
            }
        });
 });
//end

</script>