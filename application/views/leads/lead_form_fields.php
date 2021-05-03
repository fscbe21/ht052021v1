<!--darini 12-2-->
<?php if(isset($leadapp)){
    $edid=$model_info->client_id;
} else{
    $edid= $model_info->id;
}?>

<input type="hidden" name="id" value="<?php echo $edid; ?>" /><!--end-->
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />


<div class="form-group">
    <label for="company_name" class="<?php echo $label_column; ?>"><?php echo lang('company_name'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "company_name",
            "name" => "company_name",
            "value" => $model_info->company_name,
            "class" => "form-control",
            "placeholder" => lang('company_name'),
            "autofocus" => true,
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
        <span class="show-lead-available" style="display:none;color:red"></span>
    </div>
    
</div>


<!---darini 11-2-->
<div class="form-group">
    <label for="branch" class="<?php echo $label_column; ?>"><?php echo "Company Branch"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "branch",
            "name" => "branch",
            "value" => $model_info->branch,
            "class" => "form-control",
            "placeholder" => "Company Branch",
            "autofocus" => true,
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
        <span class="show-lead-available" style="display:none;color:red"></span>
    </div>
    
</div>


<div class="form-group">
    <label for="company_unit" class="<?php echo $label_column; ?>"><?php echo "Company Unit"; ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "company_unit",
            "name" => "company_unit",
            "value" => $model_info->company_unit,
            "class" => "form-control",
            "placeholder" => "Company Unit"
        ));
        ?>
       
    </div>
    
</div>
<!--end-->

<div class="form-group">
    <label for="contact_person" class="<?php echo $label_column; ?>"><?php echo lang('contact_person'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "contact_person",
            "name" => "contact_person",
            "value" => $model_info->contact_person,
            "class" => "form-control",
            "placeholder" => lang('contact_person'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="phone" class="<?php echo $label_column; ?>"><?php echo lang('contact_number'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "phone",
            "name" => "phone",
            "value" => $model_info->phone,
            "class" => "form-control",
            "placeholder" => lang('contact_number')
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="person_role" class="<?php echo $label_column; ?>"><?php echo lang('person_role'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "person_role",
            "name" => "person_role",
            "value" => $model_info->person_role,
            "class" => "form-control",
            "placeholder" => lang('person_role'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">

    <label for="lead_source_id" class="<?php echo $label_column; ?>"><?php echo lang('source'); ?></label>

    <div class="<?php echo $field_column; ?>">
        <?php
        $lead_source = array();

        foreach ($sources as $source) {
            $lead_source[$source->id] = $source->title;
        }

        echo form_dropdown("lead_source_id", $lead_source, array($model_info->lead_source_id), "class='select2'");
        
        ?>
    </div>

</div>

<div class="form-group">
    <label for="product_category" class="<?php echo $label_column; ?>"><?php echo lang('product_category'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "product_category",
            "name" => "product_category",
            "value" => $model_info->product_category,
            "class" => "form-control",
            "placeholder" => lang('product_category'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group" style="display:none"><!--darini 11-2-->
    <label for="product" class="<?php echo $label_column; ?>"><?php echo lang('product'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "product",
            "name" => "product",
            "value" => $model_info->product,
            "class" => "form-control",
            "placeholder" => lang('product'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group" style="display:none"><!--darini 11-2-->
    <label for="unit" class="<?php echo $label_column; ?>"><?php echo lang('unit'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "unit",
            "name" => "unit",
            "value" => $model_info->unit,
            "class" => "form-control",
            "placeholder" => lang('unit'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group" style="display:none">
    <label for="quantity" class="<?php echo $label_column; ?>"><?php echo lang('quantity'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "quantity",
            "name" => "quantity",
            "value" => $model_info->quantity,
            "class" => "form-control",
            "placeholder" => lang('quantity'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group" style="display:none"><!--darini 11-2-->
    <label for="total_value" class="<?php echo $label_column; ?>"><?php echo lang('total_value'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "total_valu",
            "name" => "total_value",
            "value" => $model_info->total_value,
            "class" => "form-control",
            "placeholder" => lang('total_value'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="lead_status_id" class="<?php echo $label_column; ?>"><?php echo lang('status'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        foreach ($statuses as $status) {
            $lead_status[$status->id] = $status->title;
        }

        echo form_dropdown("lead_status_id", $lead_status, array($model_info->lead_status_id), "class='select2'");
        ?>
    </div>
</div>

<div class="form-group">
    <label for="followup_date" class="<?php echo $label_column; ?>"><?php echo lang('followup_date'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "followup_date",
            "name" => "followup_date",
            "value" => $model_info->followup_date ? $model_info->followup_date : "",
            "class" => "form-control",
            "placeholder" => lang('followup_date'),
            "data-rule-required" => true,
            "data-msg-required" => lang("field_required"),
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="time" class="<?php echo $label_column; ?>"><?php echo "Followup Time"; ?></label><!--darini 11-2-->
    <div class="<?php echo $field_column; ?>">

        <?php
            $start_time = is_date_exists($model_info->time) ? (convert_time_to_12hours_format($model_info->time)) : "";
            echo form_input(array(
                "id" => "start_time",
                "name" => "time",
                "value" => $start_time,
                "class" => "form-control",
                "placeholder" => lang('time'),
            ));
            ?>
    </div>
</div>
<!--darini 11-2-->
<div class="form-group">
    <label for="assigned_to" class="<?php echo $label_column; ?>"><?php echo lang('assigned_to'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        if($this->login_user->role_id!=3){
         $team = array();
         foreach ($team_members as $tm) {
             $team[$tm->id] = $tm->first_name;
         }
         echo form_dropdown("assigned_to", $team, array($this->login_user->id), "class='select2'");
        }else{
        ?>
         <input type="hidden" id="assigned_to" name="assigned_to" value="<?php echo $this->login_user->id ?>" class="form-control"  />
            <input type="text"  value="<?php echo $this->login_user->first_name ?>" class="form-control" readonly />
        <?php }
        ?>
    </div>
</div>

<!-- end -->
<div class="form-group" style="display: none">
    <label for="owner_id" class="<?php echo $label_column; ?>"><?php echo lang('owner'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "owner_id",
            "name" => "owner_id",
            "value" => $model_info->owner_id ? $model_info->owner_id : $this->login_user->id,
            "class" => "form-control",
            "placeholder" => lang('owner')
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <label for="comments" class="<?php echo $label_column; ?>"><?php echo lang('comments'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "comments",
            "name" => "comments",
            "value" => $model_info->comments ? $model_info->comments : "",
            "class" => "form-control",
            "placeholder" => lang('comments')
        ));
        ?>

    </div>
</div>

<!-- start -->


<!-- <div class="form-group">
    <label for="address" class="<?php echo $label_column; ?>"><?php echo lang('address'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_textarea(array(
            "id" => "address",
            "name" => "address",
            "value" => $model_info->address ? $model_info->address : "",
            "class" => "form-control",
            "placeholder" => lang('address')
        ));
        ?>

    </div>
</div> -->
<!-- <div class="form-group">
    <label for="city" class="<?php echo $label_column; ?>"><?php echo lang('city'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "city",
            "name" => "city",
            "value" => $model_info->city,
            "class" => "form-control",
            "placeholder" => lang('city')
        ));
        ?>
    </div>
</div> -->
<!-- <div class="form-group">
    <label for="state" class="<?php echo $label_column; ?>"><?php echo lang('state'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "state",
            "name" => "state",
            "value" => $model_info->state,
            "class" => "form-control",
            "placeholder" => lang('state')
        ));
        ?>
    </div>
</div> -->
<!-- <div class="form-group">
    <label for="zip" class="<?php echo $label_column; ?>"><?php echo lang('zip'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "zip",
            "name" => "zip",
            "value" => $model_info->zip,
            "class" => "form-control",
            "placeholder" => lang('zip')
        ));
        ?>
    </div>
</div> -->
<!-- <div class="form-group">
    <label for="country" class="<?php echo $label_column; ?>"><?php echo lang('country'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "country",
            "name" => "country",
            "value" => $model_info->country,
            "class" => "form-control",
            "placeholder" => lang('country')
        ));
        ?>
    </div>
</div> -->

<!-- <div class="form-group">
    <label for="website" class="<?php echo $label_column; ?>"><?php echo lang('website'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "website",
            "name" => "website",
            "value" => $model_info->website,
            "class" => "form-control",
            "placeholder" => lang('website')
        ));
        ?>
    </div>
</div> -->
<!-- <div class="form-group">
    <label for="vat_number" class="<?php echo $label_column; ?>"><?php echo lang('vat_number'); ?></label>
    <div class="<?php echo $field_column; ?>">
        <?php
        echo form_input(array(
            "id" => "vat_number",
            "name" => "vat_number",
            "value" => $model_info->vat_number,
            "class" => "form-control",
            "placeholder" => lang('vat_number')
        ));
        ?>
    </div>
</div> -->

<!-- <?php if ($this->login_user->is_admin && get_setting("module_invoice")) { ?>
    <div class="form-group">
        <label for="currency" class="<?php echo $label_column; ?>"><?php echo lang('currency'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "currency",
                "name" => "currency",
                "value" => $model_info->currency,
                "class" => "form-control",
                "placeholder" => lang('keep_it_blank_to_use_default') . " (" . get_setting("default_currency") . ")"
            ));
            ?>
        </div>
    </div>    
    <div class="form-group">
        <label for="currency_symbol" class="<?php echo $label_column; ?>"><?php echo lang('currency_symbol'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "currency_symbol",
                "name" => "currency_symbol",
                "value" => $model_info->currency_symbol,
                "class" => "form-control",
                "placeholder" => lang('keep_it_blank_to_use_default') . " (" . get_setting("currency_symbol") . ")"
            ));
            ?>
        </div>
    </div>
<?php } ?> -->
<!-- end -->
<?php $this->load->view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => $label_column, "field_column" => $field_column)); ?> 

<!--start dsk 1feb2021-->
<div class="form-group">
       <div class="location-iframe"></div>
</div>

<div class="form-group" style="display:none;">
        <label for="currency"><?php echo lang('Latitude'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "latitude",
                "name" => "latitude",
                "value" => $model_info->latitude,
                "class" => "form-control",
                "placeholder" => "latitude"
            ));
            ?>
        </div>
    </div> 



    <div class="form-group" style="display:none;">
        <label for="currency"><?php echo lang('Longitude'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "longitude",
                "name" => "longitude",
                "value" => $model_info->longitude,
                "class" => "form-control",
                "placeholder" => "longitude"
            ));
            ?>
        </div>
    </div> 

<!--end dsk 1feb2021-->

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $(".select2").select2();

<?php if (isset($currency_dropdown)) { ?>
            if ($('#currency').length) {
                $('#currency').select2({data: <?php echo json_encode($currency_dropdown); ?>});
            }
<?php } ?>

        setDatePicker("#followup_date", {
            startDate: moment().add(0, 'days').format("DD-MM-YYYY")
        });

        //setTimePicker("#start_time");

        $("#start_time").timepicker({
            'timeFormat': 'H:i:s',
            'step': '10',
            'forceRoundTime': true,
            'scrollDefault': '10:00:00',

        });
        

        $('#owner_id').select2({data: <?php echo json_encode($owners_dropdown); ?>});
         //start dsk 1feb2021 add geolocation

         if('geolocation' in navigator){

//console.log('-Available');


 navigator.geolocation.getCurrentPosition(

     position => {

       if(!$("#latitude").val() && !$("#longitude").val()){

        $(".location-iframe").append('<iframe width="100%" height="250" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q='+position.coords.latitude+','+position.coords.longitude+'&amp;key=AIzaSyCQH8ghrziXzGJx8gQJqbsWht08I7eb_K4"></iframe>');

            $("#latitude").val(position.coords.latitude);

            $("#longitude").val(position.coords.longitude);



       }else{

        $(".location-iframe").append('<iframe width="100%" height="250" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q='+$("#latitude").val()+','+$("#longitude").val()+'&amp;key=AIzaSyCQH8ghrziXzGJx8gQJqbsWht08I7eb_K4"></iframe>');

        

       }

//alert("latitude:"+position.coords.latitude+" longitude:"+position.coords.longitude);

    //console.log(position);

});

}else{

     
//console.log('Not Available');
}
        //end dsk 1feb2021 add geolocation

         //start dsk 3feb2021






         [document.querySelector('#company_name'), document.querySelector('#branch'), document.querySelector('#company_unit')].forEach(item => {
  item.addEventListener('keyup', event => {

    let companyName = document.getElementById("company_name").value;
let companyBranch = document.getElementById("branch").value;
let companyUnit = document.getElementById("company_unit").value;
//console.log(companyName);
companyName.replace(/\s/g,'');
companyBranch.replace(/\s/g,'');
companyUnit.replace(/\s/g,'');

if( companyName.replace(/\s/g,'')){
   fetch('<?php echo get_uri("leads/check_company_name/"); ?>'+ companyName.replace(/\s/g,''))
 .then(response => response.json())
 .then(
     
   data => {
       
       if(data.length){
          
           document.getElementsByClassName('show-lead-available')[0].style.display='block';
       document.getElementsByClassName('lead-add-button')[0].disabled = true;

       
           return fetch('<?php echo get_uri("team_members/get_user_details/"); ?>'+data[0].assigned_to);
       
   
   }
       else{
           document.getElementsByClassName('show-lead-available')[0].style.display='none';
           document.getElementsByClassName('lead-add-button')[0].disabled = false;
           
          
}

}
 
 )
 .then(response => response.json())
 .then(assignedTo => {

//console.log(assignedTo);

document.getElementsByClassName('show-lead-available')[0].innerHTML='Sorry, This lead has already been taken by '+assignedTo.first_name+' '+assignedTo.last_name;
       

return fetch(    '<?php echo get_uri("leads/get_branch_details/"); ?>'+companyBranch.replace(/\s/g,'')+'/'+companyName.replace(/\s/g,'') );



 })
 .then(response => response.json())
 .then(

    data => {
       
       if(data.length){
          
           document.getElementsByClassName('show-lead-available')[0].style.display='block';
       document.getElementsByClassName('lead-add-button')[0].disabled = true;

       
           return fetch('<?php echo get_uri("team_members/get_user_details/"); ?>'+data[0].assigned_to);
       
   
   }
       else{
           document.getElementsByClassName('show-lead-available')[0].style.display='none';
           document.getElementsByClassName('lead-add-button')[0].disabled = false;
           
          
}

}



 )
 .then(response => response.json())
 .then(assignedTo => {

//console.log(assignedTo);

document.getElementsByClassName('show-lead-available')[0].innerHTML='Sorry, This lead Company-branch has already been taken by '+assignedTo.first_name+' '+assignedTo.last_name;
       

return fetch(    '<?php echo get_uri("leads/get_unit_details/"); ?>'+companyUnit.replace(/\s/g,'')+'/'+companyBranch.replace(/\s/g,'')+'/'+companyName.replace(/\s/g,'') );



 })
 .then(response => response.json())

 .then(

data => {
   
   if(data.length){
      
       document.getElementsByClassName('show-lead-available')[0].style.display='block';
   document.getElementsByClassName('lead-add-button')[0].disabled = true;

   
       return fetch('<?php echo get_uri("team_members/get_user_details/"); ?>'+data[0].assigned_to);
   

}
   else{
       document.getElementsByClassName('show-lead-available')[0].style.display='none';
       document.getElementsByClassName('lead-add-button')[0].disabled = false;
       
      
}

}



)


.then(response => response.json())
 .then(assignedTo => {

//console.log(assignedTo);

document.getElementsByClassName('show-lead-available')[0].innerHTML='Sorry, This lead Company-branch-unit has already been taken by '+assignedTo.first_name+' '+assignedTo.last_name;
       

 })

 .catch(err => console.log("Company name or User Not found error desc: ",err))
}


    
  })
})





/*
        
         document.getElementById("company_name").addEventListener("keyup", event => {

let companyName = document.getElementById("company_name").value;
let companyBranch = document.getElementById("branch").value;
let companyUnit = document.getElementById("company_unit").value;
//console.log(companyName);
companyName.replace(/\s/g,'');
companyBranch.replace(/\s/g,'');
companyUnit.replace(/\s/g,'');

if( companyName.replace(/\s/g,'')){
   fetch('<?php echo get_uri("leads/check_company_name/"); ?>'+ companyName.replace(/\s/g,''))
 .then(response => response.json())
 .then(
     
   data => {
       
       if(data.length){
          
           document.getElementsByClassName('show-lead-available')[0].style.display='block';
       document.getElementsByClassName('lead-add-button')[0].disabled = true;

       
           return fetch('<?php echo get_uri("team_members/get_user_details/"); ?>'+data[0].assigned_to);
       
   
   }
       else{
           document.getElementsByClassName('show-lead-available')[0].style.display='none';
           document.getElementsByClassName('lead-add-button')[0].disabled = false;
           
          
}

}
 
 )
 .then(response => response.json())
 .then(assignedTo => {

//console.log(assignedTo);

document.getElementsByClassName('show-lead-available')[0].innerHTML='Sorry, This lead has already been taken by '+assignedTo.first_name+' '+assignedTo.last_name;
       

return fetch('<?php echo get_uri("leads/get_branch_details/"); ?>'+companyBranch.replace(/\s/g,''))+'/'+companyName.replace(/\s/g,'');

 })
 .then(response => response.json())
 .then(branchName => {

console.log(branchName);

 })
 .catch(err => console.log("Company name or User Not found error desc: ",err))
}


 // do something
});

*/
       //end dsk 3feb2021

    });
</script>