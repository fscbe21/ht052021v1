<?php echo form_open(get_uri("vechicle_services/save"), array("id" => "services-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <div class="form-group">
    
    </div>
            <div class="form-group">
                <label for="title" class=" col-md-3"><?php echo "Types of services"; ?></label>
                <div class=" col-md-4">
                <select id="servicetype" name="service_type" class="form-control" required>   
                    <option value="">Select Service Type</option>
                    <option value="1">Fuel</option>
                    <option value="2">Service</option>
                    <option value="3">Insurance</option>                                  
                </select>
            </div>
            
            <label for="title" class=" col-md-2"><?php echo "Date And Time"; ?></label>
    <div class=" col-md-3">
    <input type="text" id="currentDateTime" name="datetime" class="form-control" readonly>
    </div>

            </div>
        
            <div class="form-group" id="bill_no">
        <label for="title" class=" col-md-3"><?php echo "Bill No"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                //"id" => "bill_no",
                "name" => "bill_no",
                "value" => $model_info->bill_no,
                "class" => "form-control",
                
                "placeholder" => "Bill No",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
                
                
            ));
            ?>
        </div>
    </div>
        
    <div class="form-group" id="vechiclenumber">
        <label for="title" class=" col-md-3"><?php echo "Vehicle Number"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "search",
                "autocomplete" => "off",
                "name" => "v_number",
                "value" => $model_info->v_number,
                "class" => "form-control",
                "placeholder" => "Vehicle Number",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
                
            ));
            ?>
             <div id="product-list"></div>
           
 </div>

    </div>


    <div class="form-group" id="spm_open_reading_view">
        <label for="title" class=" col-md-3"><?php echo "Speedometer Opening Reading"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "spm_open_reading",
                "name" => "spm_open_reading",
                "value" => $model_info->spm_open_reading,
                "class" => "form-control",
                "onload" => "multiply()",
                "placeholder" => "Speedometer Opening Reading",

               
                
                
            ));
            ?>
        </div>
    </div>


    <div class="form-group" id="closing_reading_view">
        <label for="title" class=" col-md-3"><?php echo "Closing Reading"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
               "id" => "closing_reading",
                "name" => "closing_reading",
                "value" => $model_info->closing_reading,
                "class" => "form-control",
                "oninput" => "multiply()",
                "type" => "number",
                "placeholder" => "Closing Reading",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
                
                
            ));
            ?>
        </div>
    </div>



    <div class="form-group" id="running_km_view">
        <label for="title" class=" col-md-3"><?php echo "Total Km"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "running_km",
                "name" => "running_km",
                "value" => $model_info->running_km,
                "class" => "form-control",
                "type" => "number",

                "oninput" => "multiply()",
                "placeholder" => "Running Km",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
                
               
            ));
            ?>
        </div>
    </div>



    <div class="form-group" id="driver_name_view">
        <label for="title" class=" col-md-3"><?php echo "Driver Name"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "driver_name",
                "name" => "driver_name",
                
                "value" => $model_info->driver_name,
                "class" => "form-control",
                "placeholder" => "Driver Name",
                
               
            ));
            ?>
        </div>
    </div>



    <div class="form-group" id="bunk_name">
        <label for="title" class=" col-md-3"><?php echo "Petrol Bunk Name"; ?></label>
        <div class=" col-md-9">

       
                <select id="" name="petrol_bunk_name" class="form-control" required>   
                    <option value="" >Select Petrol Bunk</option> 
                    <?php foreach($bunk_data as $bunk){?>
                    <option
                    
                    <?php echo ($bunk->id == $model_info->petrol_bunk_name) ? ' selected' : ''; ?>
                    
                     value="<?php echo $bunk->title; ?>"><?php echo $bunk->title; ?> </option>
                    <?php }  ?>                                                    
                </select>
            
            <?php
           /* echo form_input(array(
                //"id" => "bunk_name",
                "name" => "petrol_bunk_name",
                "value" => $model_info->Petrol_bunk_name,
                "class" => "form-control",
                "placeholder" =>  "Petrol Bunk Name",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));*/
            ?>
        </div>
    </div>


    <div class="form-group" id="litter">
        <label for="title" class=" col-md-3"><?php echo "Liter"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                //"id" => "litter",
                "name" => "litter",
                "value" => $model_info->litter,
                "class" => "form-control",
                "placeholder" => "Liter",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
               
                
            ));
            ?>
        </div>
    </div>


    <div class="form-group" id="price">
        <label for="title" class=" col-md-3"><?php echo "Price"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
               // "id" => "price",
                "name" => "price",
                "value" => $model_info->price,
                "class" => "form-control",
                "placeholder" => "Price",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
               
                
            ));
            ?>
        </div>
    </div>



    <!------->


    <div class="form-group" id="amount" >
        <label for="title" class=" col-md-3"><?php echo "Amount"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                //"id" => "amount",
                "name" => "amount",
               
                "value" => $model_info->amount,
                "class" => "form-control",
                "type" => "number",
                "placeholder" => "Amount",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
                
                
            ));
            ?>
        </div>
    </div>


    <div class="form-group" id="from">
        <label for="title" class=" col-md-3"><?php echo "From"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                //"id" => "from",
                "name" => "from",
                "value" => $model_info->from,
                "class" => "form-control",
               
                "placeholder" => "From",
               
               
            ));
            ?>
        </div>
    </div>



    <div class="form-group" id="to">
        <label for="title" class=" col-md-3"><?php echo "To"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                //"id" => "to",
                "name" => "to",
                "value" => $model_info->to,
                "class" => "form-control",
              
                "placeholder" => "To",
               
               
            ));
            ?>
        </div>
    </div>



    <div class="form-group" id="km">
        <label for="title" class=" col-md-3"><?php echo "KM"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
               // "id" => "km",
                "name" => "km",
                "type" => "number",
                "value" => $model_info->km,
                "class" => "form-control",
                "placeholder" => "KM",
               
               
            ));
            ?>
        </div>
    </div>



    <div class="form-group" id="company_name">
        <label for="title" class=" col-md-3"><?php echo "Company Name"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                //"id" => "company_name",
                "name" => "company_name",
                "value" => $model_info->company_name,
                "class" => "form-control",
                "placeholder" =>  "Company Name",
               
               
            ));
            ?>
        </div>
    </div>


    <div class="form-group" id="notes">
        <label for="title" class=" col-md-3"><?php echo "Notes"; ?></label>
        <div class=" col-md-9">

        <textarea id="" name="notes" value="", class="form-control" rows="4" cols="50">

</textarea>
            <?php
           /* echo form_input(array(
               // "id" => "notes",
                "name" => "notes",
                "type" => "textarea",
                "value" => $model_info->notes,
                "class" => "form-control",
                "placeholder" => "Notes",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));*/
            ?>
        </div>
    </div>

    
    <div class="form-group" id="service_type">
        <label for="title" class=" col-md-3"><?php echo "Service Type"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                //"id" => "servicetype",
                "name" => "typeof_service",
                "value" => $model_info->service_type,
                "class" => "form-control",
                "placeholder" => "Service type",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required")
            ));
            ?>
        </div>
    </div>


    


    <div class="form-group" id="insurance_company">
        <label for="title" class=" col-md-3"><?php echo "Insurance Company"; ?></label>
        <div class=" col-md-9">

        <select id="" name="insurance_company" class="form-control" required>   
                    <option value="" >Select Insurance Company</option> 
                    <?php foreach($insurance_cmpdata as $inscmp){?>
                    <option
                    
                    <?php echo ($inscmp->id == $model_info->insurance_company) ? ' selected' : ''; ?>
                    
                    value="<?php echo $inscmp->id; ?>"><?php echo $inscmp->title; ?> </option>
                   <?php }  ?>                                                      
                </select>
            <?php
           /* echo form_input(array(
                //"id" => "insurance_company",
                "name" => "noteinsurance_company",
                "value" => $model_info->insurance_company,
                "class" => "form-control",
                "placeholder" => "Insurance Company",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));*/
            ?>
        </div>
    </div>




    <div class="form-group" id="insurance_type">
        <label for="title" class=" col-md-3"><?php echo "Insurance Type"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                //"id" => "insurance_type",
                "name" => "insurance_type",
                "value" => $model_info->insurance_type,
                "class" => "form-control",
                "placeholder" => "Insurance Type",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
               
            ));
            ?>
        </div>
       
    </div>
   
        <div class="form-group" id="insurance_dates">
        <label for="title" class=" col-md-3"><?php echo "Insurance  From Date"; ?></label>
        <div class=" col-md-4">
            <?php
            echo form_input(array(
                "id" =>   "insurance-from-date",
                "name" => "insurance_from_date",
                "value" => $model_info->insurance_from_date,
                "class" => "form-control",
                "type" => "date",
               
            ));
            ?>
        </div>
        <label for="title" class=" col-md-2"><?php echo "Insurance Expiry Date"; ?></label>
        <div class=" col-md-3">
            <?php
            echo form_input(array(
                "id" => "insurance-to-date",
                "name" => "insurance_exp_date",
                "value" => $model_info->insurance_exp_date,
                "class" => "form-control",
                "type" => "date",
                "placeholder" => "",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
               
            ));
            ?>
        </div>
    </div>
   



    
    <div class="form-group"  id="pay_mode">
                <label for="title" class=" col-md-3"><?php echo "Pay Mode"; ?></label>
                <div class=" col-md-4">
                <select name="pay_mode" class="form-control" required>   
                    <option value="">Select Pay Mode</option>
                    <option value="1">Credit</option>
                    <option value="2">Cash</option>
                                                
                </select>
</div>



                <label for="title" class=" col-md-2"><?php echo "Tax Mode"; ?></label>
                <div class=" col-md-3">
                <select name="tax_mode" class="form-control" required>   
                    <option value="">Select Tax Mode</option>
                    <option value="1">With Tax</option>
                    <option value="2">Without Tax</option>
                                                
                </select>
</div>

<!--<div id="">
<label for="title" class=" col-md-1"><?php echo "With Tax"; ?></label>
    <div class=" col-md-1" >
    <input type="checkbox" value="1"  name="with_tax" class="" readonly>
    </div>

    <label for="title" class=" col-md-1"><?php echo "With Out Tax"; ?></label>
    <div class=" col-md-1">
    <input type="checkbox" value="1" id="without_tax" name="without_tax" class="" readonly>
    </div>
</div>-->

</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
$(document).ready(function () {
        $("#services-form").appForm({
            onSuccess: function (result) {
                $("#other-area-table").appTable({newData: result.data, dataId: result.id});
                location.reload();
            }
        });

        $("#title").focus();
    });


hide_all_fields();
    var ServiceType   = 0;

    $(document).on('change', '#servicetype', function()
    {
        hide_all_fields();
        ServiceType = $(this).val();
        if(ServiceType == 1){
            show_fuel_fields();
        }else if(ServiceType == 2){
            show_service_fields();
        }else if(ServiceType == 3){
            show_insurance_fields();
        }else{
            hide_all_fields();
        }
    });

    function multiply() {
  a = Number(document.getElementById('spm_open_reading').value);
  b = Number(document.getElementById('closing_reading').value);
  c = b - a;
  document.getElementById('running_km').value = c;
  d = Number(document.getElementById('totalWithoutVat').value);
  e = Number(document.getElementById('TOTALGST').value);
  f = d+e;
  document.getElementById('grandtotalvalue').value = f;

  //document.getElementById('words').innerHTML = inWords(document.getElementById('grandtotalvalue').value);
}	  

document.getElementById("spm_open_reading").readOnly = true;
//document.getElementById("driver_name").readOnly = true;
document.getElementById("running_km").readOnly = true;

    


    $(document).on('keyup', '#search', function(){
        var searchContent = $(this).val();
        if(searchContent.length != 0){
            $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>index.php/services/search/'+searchContent,
            dataType: 'json',
            success: function(data) 
            {
                $('#product-list').empty();
                if(data.length > 0)
                {
                    $.each(data, function (index, value) 
                    {
                        var namex = data[index].v_number;
                        var namep = namex.replace(/"/g, '');
                        var expireDate = data[index].insurance_t_date;
                        // data-dirvername='+data[index].driver_name+' 
                        $('#product-list').append('<option data-expiredate="'+expireDate+'" data-name="'+namep+'" data-spmopenreading='+data[index].spm_open_reading+' class="form-control selected" style="width: 100%">'+data[index].v_number+'</option>');
                    }); 
                }
                else
                {
                    $('#product-list').append('<option class="form-control" style="width: 80%">No Vehicle Found</option>');
                }
                                     
            }                   
        });
        }
        else
        {
            $('#product-list').empty();
        }
    });

    $(document).on('click', '.selected', function(){
        var supplierId;
        var spmOpenReading;
        var expireDate;
        expireDate = $(this).data('expiredate');

        supplierId = $(this).val();
        $('#search').val(supplierId);
        spmOpenReading = $(this).data('spmopenreading');
        $('#spm_open_reading').val(spmOpenReading);

        var todaysDate = '<?php echo date('Y-m-d'); ?>';

        if(expireDate <= todaysDate){

            var res  = todaysDate.substring(0, 4);
            res = parseInt(res);
            var res2 = res+1;
            var printdate = todaysDate.replace(res, res2);

            $('#insurance-from-date').val(todaysDate);
            $('#insurance-to-date').val(printdate);

        }else{

            var res  = expireDate.substring(0, 4);
            res = parseInt(res);
            var res2 = res+1;
            var printdate = expireDate.replace(res, res2);

            $('#insurance-from-date').val(expireDate);
            $('#insurance-to-date').val(printdate); 
        }

        $('#product-list').empty();
    });

    
  var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;
  document.getElementById("currentDateTime").value = dateTime;

  $(function() {
        $('#typeofservice').change(function(){
            $('.overallpage').hide();
            $('#' + $(this).val()).show();
        });
    });

    function hide_all_fields(){
        make_all_fields_not_required();
        $('#bill_no').hide();
        $('#vechiclenumber').hide();
        $('#spm_open_reading_view').hide();
        $('#closing_reading_view').hide();
        $('#running_km_view').hide();
        $('#driver_name_view').hide();
        $('#bunk_name').hide();
        $('#litter').hide();
        $('#price').hide();
        $('#amount').hide();
        $('#from').hide();
        $('#to').hide();
        $('#km').hide();
        $('#company_name').hide();
        $('#notes').hide();
        $('#service_type').hide();
        $('#insurance_company').hide();
        $('#insurance_type').hide();
        $('#pay_mode').hide();
        $('#tax').hide();
        $('#insurance_dates').hide();
        
        }

    function show_fuel_fields(){
        $('#bill_no').show();
        $('#bill_no').prop('required', true);
        $('#vechiclenumber').show();
        $('#vechiclenumber').prop('required', true);
        $('#spm_open_reading_view').show();
        $('#spm_open_reading_view').prop('required', true);
        $('#closing_reading_view').show();
        $('#closing_reading_view').prop('required', true);
        $('#running_km_view').show();
        $('#running_km_view').prop('required', true);
        $('#driver_name_view').show();
        $('#driver_name_view').prop('required', true);
        $('#bunk_name').show();
        $('#bunk_name').prop('required', true);
        $('#litter').show();
        $('#litter').prop('required', true);
        $('#price').show();
        $('#price').prop('required', true);
        $('#amount').show();
        $('#amount').prop('required', true);
        $('#from').show();
        $('#from').prop('required', true);
        $('#to').show();
        $('#to').prop('required', true);
        $('#km').show();
        $('#km').prop('required', true);
        $('#company_name').show();
        $('#company_name').prop('required', true);
        $('#notes').show();
        $('#notes').prop('required', true);
        $('#pay_mode').show();
        $('#pay_mode').prop('required', true);
        $('#tax').show();
         
    }

    function show_service_fields(){    
        $('#bill_no').show();
        $('#bill_no').prop('required', true);
        $('#vechiclenumber').show();
        $('#vechiclenumber').prop('required', true);
        $('#service_type').show();
        $('#service_type').prop('required', true);
        $('#driver_name_view').show();
        $('#driver_name_view').prop('required', true);
        $('#amount').show();
        $('#amount').prop('required', true);
        $('#pay_mode').show();
        $('#pay_mode').prop('required', true);
        $('#tax').show();
        $('#tax').prop('required', true);
      
        $('#notes').show();
        $('#notes').prop('required', true);
       
    }

    function show_insurance_fields(){
        $('#bill_no').show();
        $('#bill_no').prop('required', true);
        $('#vechiclenumber').show();
        $('#vechiclenumber').prop('required', true);
        $('#insurance_company').show();
        $('#insurance_company').prop('required', true);
        $('#insurance_type').show();
        $('#insurance_type').prop('required', true);
        $('#amount').show();
        $('#amount').prop('required', true);
        $('#pay_mode').show();
        $('#pay_mode').prop('required', true);
        $('#tax').show();
        $('#tax').prop('required', true);
        $('#insurance_dates').show();
        $('#insurance_dates').prop('required', true);
    }

    function make_all_fields_not_required(){
        $('#bill_no').prop('required', false);
        $('#vechiclenumber').prop('required', false);
        $('#spm_open_reading_view').prop('required', false);
        $('#closing_reading_view').prop('required', false);
        $('#running_km_view').prop('required', false);
        $('#driver_name_view').prop('required', false);
        $('#bunk_name').prop('required', false);
        $('#litter').prop('required', false);
        $('#price').prop('required', false);
        $('#amount').prop('required', false);
        $('#from').prop('required', false);
        $('#to').prop('required', false);
        $('#km').prop('required', false);
        $('#company_name').prop('required', false);
        $('#notes').prop('required', false);
        $('#service_type').prop('required', false);
        $('#insurance_company').prop('required', false);
        $('#insurance_type').prop('required', false);
        $('#pay_mode').prop('required', false);
        $('#tax').prop('required', false);
        $('#insurance_dates').prop('required', false);
       
         }
</script>   

