<?php echo form_open(get_uri("vechicle_services/save"), array("id" => "other-area-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <input type="hidden" name="service_type" value="<?php echo $model_info->service_type; ?>" />

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Bill No"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "bill_no",
                "value" => $model_info->bill_no,
                "class" => "form-control",
                "placeholder" => "Bill No",
               
            ));
            ?>
        </div>
    </div>


    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Vechicle Number"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "v_number",
                "name" => "v_number",
                "value" => $model_info->v_number,
                "class" => "form-control",
                "placeholder" => "Vechicle Number",
               
            ));
            ?>
        </div>
    </div>




    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Speedometer Opening Reading"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "spm_open_reading",
                "name" => "spm_open_reading",
                
                "value" => $model_info->spm_open_reading,
                "class" => "form-control",
                "placeholder" => "Speedometer Opening Reading",
                "onload" => "multiply()",
            ));
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Closing Reading"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "closing_reading",
                "autocomplete" => "off",
                "name" => "closing_reading",
                "value" => $model_info->closing_reading,
                "class" => "form-control",
                "placeholder" => "Closing Reading",
                "oninput" => "multiply()",
            ));
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Total Km"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "running_km",
                "name" => "running_km",
                "value" => $model_info->running_km,
                "class" => "form-control",
                "placeholder" => "Total Km",
                "oninput" => "multiply()",
                
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Driver Name"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "driver_name",
                "name" => "driver_name",
                "value" => $model_info->driver_name,
                "class" => "form-control",
                "placeholder" => "Driver Name",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>


    <!----->

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Petrol Bunk Name"; ?></label>
        <div class=" col-md-9">

        <select id="" name="petrol_bunk_name" class="form-control">   
                    <option value="" >Select Petrol Bunk</option> 
                    <?php foreach($bunk_data as $bunk){?>
                    <option
                    
                    <?php echo ($bunk->title == $model_info->petrol_bunk_name) ? ' selected' : ''; ?>
                    
                     value="<?php echo $bunk->title; ?>"><?php echo $bunk->title; ?> </option>
                    <?php }  ?>                                                    
                </select>
            <?php
          /* echo form_input(array(
                "id" => "title",
                "name" => "petrol_bunk_name",
                "value" => $model_info->petrol_bunk_name,
                "class" => "form-control",
                "placeholder" => "Petrol Bunk Name",
               
            ));*/
            ?>
        </div>
    </div>


    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Litter"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "litter",
                "value" => $model_info->litter,
                "class" => "form-control",
                "placeholder" => "Litter",
               
            ));
            ?>
        </div>
    </div>




    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Price"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
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



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Amount"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "amount",
                "value" => $model_info->amount,
                "class" => "form-control",
                "placeholder" => "Amount",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "From"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "from",
                "value" => $model_info->from,
                "class" => "form-control",
                "placeholder" => "From",
                
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "To"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "to",
                "value" => $model_info->to,
                "class" => "form-control",
                "placeholder" => "To",
               
            ));
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "KM"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "km",
                "value" => $model_info->km,
                "class" => "form-control",
                "placeholder" => "KM",
                
            ));
            ?>
        </div>
    </div>



    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Companay Name"; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "company_name",
                "value" => $model_info->company_name,
                "class" => "form-control",
                "placeholder" => "Companay Name",
                
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo "Notes"; ?></label>
        <div class=" col-md-9">
        
            <?php
            echo form_textarea(array(
                "id" => "",
                "name" => "notes",
                "value" => $model_info->notes,
                "class" => "form-control",
                "placeholder" => "Notes",
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
        <option value="1" <?php echo ($model_info->pay_mode == 1) ? ' selected' : ''; ?>>Credit</option>
        <option value="2" <?php echo ($model_info->pay_mode == 2) ? ' selected' : ''; ?>>Cash</option>
                                    
    </select>
</div>



    <label for="title" class=" col-md-1"><?php echo "Tax Mode"; ?></label>
    <div class=" col-md-3">
    <select name="tax_mode" class="form-control" required>   
        <option value="">Select Tax Mode</option>
        <option value="1" <?php echo ($model_info->tax_mode == 1) ? ' selected' : ''; ?> >With Tax</option>
        <option value="2" <?php echo ($model_info->tax_mode == 2) ? ' selected' : ''; ?>>Without Tax</option>
                                    
    </select>
</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">

document.getElementById("spm_open_reading").readOnly = true;
document.getElementById("driver_name").readOnly = true;
document.getElementById("running_km").readOnly = true;
document.getElementById("v_number").readOnly = true;

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

    $(document).ready(function () {
        $("#other-area-form").appForm({
            onSuccess: function (result) {
                $("#other-area-table").appTable({newData: result.data, dataId: result.id});
            }
        });

        $("#title").focus();
    });
</script>    