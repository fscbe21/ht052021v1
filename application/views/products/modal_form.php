<?php echo form_open(get_uri("products/save"), array("id" => "products-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
    <div class="form-group">
      <label for="title" class=" col-md-3">Product Type *</label>
      <div class="<?php echo $field_column; ?>">
         <div class=" col-md-9">
           <select name="type" class="form-control" required>   
              <option value="" ></option> 
                <?php 
                    $prodtype = $model_info->type ? $model_info->type : 0;
                ?>
                <?php foreach($product_type as $pt){?>
                    <option 
                    
                    <?php
                        if($prodtype != 0){
                            echo ($prodtype == $pt->id) ? ' selected' : '';
                        }
                    ?>
                    value="<?php echo $pt->id; ?>"><?php echo $pt->name; ?>
        </option>
       <?php }  ?>                                                      
        </select>
    </div>
    </div>
</div>

    <div class="form-group">
        <label for="title" class=" col-md-3"><?php echo lang('product').' '.lang('name'); ?>*</label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "name",
                "name" => "name",
                "value" => $model_info->name ? $model_info->name : "",
                "class" => "form-control",
                "placeholder" => 'Enter '.lang('product').' '.lang('name'),
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="percentage" class=" col-md-3">Product Code *</label>
        <div class=" col-md-9">
            <input type="text" name="code" class="form-control" id="code" value="<?php echo $model_info->code ? $model_info->code : get_random_number() ?>" placeholder="Enter product code"/>
        </div>
    </div>

    <div class="form-group">
      <label for="title" class=" col-md-3">Barcode Symbology *</label>
      <div class="<?php echo $field_column; ?>">
         <div class=" col-md-9">
           <select name="barcode_symbology" class="form-control" required>   
              <!-- <option value="" ></option> --> <!--  AG2703QQQ -->
                <?php 
                    $barcode_symbology = $model_info->barcode_symbology ? $model_info->barcode_symbology : 0;
                ?>
                <?php foreach($barcode_symbology_all as $bs){?>
                    <option 
                    
                    <?php
                        if($barcode_symbology != 0){
                            echo ($barcode_symbology == $bs->id) ? ' selected' : '';
                        }
                    ?>
                    value="<?php echo $bs->id; ?>"><?php echo $bs->name; ?>
        </option>
       <?php }  ?>                                                      
        </select>
    </div>
    </div>
</div>

<div class="form-group">
      <label for="title" class=" col-md-3">Brand</label>
      <div class="<?php echo $field_column; ?>">
         <div class=" col-md-9">
           <select name="brand" class="form-control">   
              <option value="" ></option> 
                <?php 
                    $brand = $model_info->brand_id ? $model_info->brand_id : 0;
                ?>
                <?php foreach($brand_all as $bt){?>
                    <option 
                    
                    <?php
                        if($brand != 0){
                            echo ($brand == $bt->id) ? ' selected' : '';
                        }
                    ?>
                    value="<?php echo $bt->id; ?>"><?php echo $bt->name; ?>
        </option>
       <?php }  ?>                                                      
        </select>
    </div>
    </div>
</div>

<div class="form-group">
      <label for="title" class=" col-md-3">Category *</label>
      <div class="<?php echo $field_column; ?>">
         <div class=" col-md-9">
           <select name="category" class="form-control" required>   
              <option value="" ></option> 
                <?php 
                    $category = $model_info->category_id ? $model_info->category_id : 0;
                ?>
                <?php foreach($category_all as $cat){?>
                    <option 
                    
                    <?php
                        if($category != 0){
                            echo ($category == $cat->id) ? ' selected' : '';
                        }
                    ?>
                    value="<?php echo $cat->id; ?>"><?php echo $cat->title; ?>
        </option>
       <?php }  ?>                                                      
        </select>
    </div>
    </div>
</div>

<div class="form-group">
      <label for="title" class=" col-md-3">Warehouse</label>
      <div class="<?php echo $field_column; ?>">
         <div class=" col-md-9">
           <select name="warehouse_id" class="form-control">   
              <option value="0">* No need to assign particular warehouse *</option> 
                <?php 
                    $warehouse = $model_info->warehouse_id ? $model_info->warehouse_id : 0;
                ?>
                <?php foreach($warehouse_all as $wh){?>
                    <option 
                    
                    <?php
                        if($warehouse != 0){
                            echo ($warehouse == $wh->id) ? ' selected' : '';
                        }
                    ?>
                    value="<?php echo $wh->id; ?>"><?php echo $wh->name; ?>
        </option>
       <?php }  ?>                                                      
        </select>
    </div>
    </div>
</div>

<div class="form-group">
      <label for="title" class=" col-md-3">Unit *</label>
      <div class="<?php echo $field_column; ?>">
         <div class="col-md-9">

         <div class="row">
              <div class="col-md-4">
                    <select id="unit-id" name="unit_id" class="form-control" required>   
                    <option value="" >Select Product Unit</option><!--  AG2703QQQ -->
                        <?php 
                            $product_unit = $model_info->unit_id ? $model_info->unit_id : 0;
                        ?>
                        <?php foreach($unit_all as $ut1){?>
                            <option 
                                <?php
                                    if($product_unit != 0){
                                        echo ($product_unit == $ut1->id) ? ' selected' : '';
                                    }
                                ?>
                                value="<?php echo $ut1->id; ?>"><?php echo $ut1->name; ?>
                            </option>
                         <?php }  ?>                                                      
                    </select>
              </div>

              <div class="col-md-4">
                    <select id="purchase-unit-id" name="purchase_unit_id" class="form-control" required>   <!--  AG2703QQQ -->
                    <option value="" >Select Purchase Unit</option> 
                        <?php 
                            $purchase_unit = $model_info->purchase_unit_id ? $model_info->purchase_unit_id : 0;
                        ?>
                        <?php foreach($unit_all as $ut2){?>
                            <option 
                                <?php
                                    if($purchase_unit != 0){
                                        echo ($purchase_unit == $ut2->id) ? ' selected' : '';
                                    }
                                ?>
                                value="<?php echo $ut2->id; ?>"><?php echo $ut2->name; ?>
                            </option>
                         <?php }  ?>                                                      
                    </select>
              </div>

              <div class="col-md-4">
                    <select id="sale-unit-id" name="sale_unit_id" class="form-control" required>   <!--  AG2703QQQ -->
                    <option value="" >Select Sales Unit</option> 
                        <?php 
                            $sales_unit = $model_info->sale_unit_id ? $model_info->sale_unit_id : 0;
                        ?>
                        <?php foreach($unit_all as $ut3){?>
                            <option 
                                <?php
                                    if($sales_unit != 0){
                                        echo ($sales_unit == $ut3->id) ? ' selected' : '';
                                    }
                                ?>
                                value="<?php echo $ut3->id; ?>"><?php echo $ut3->name; ?>
                            </option>
                         <?php }  ?>                                                      
                    </select>
              </div>
         </div>
       </div>
    </div>
</div>

<div class="form-group">
        <label for="percentage" class=" col-md-3">Product Cost *</label>
        <div class=" col-md-9">
            <input type="text" name="cost" class="form-control" id="cost" value="<?php echo $model_info->cost ? $model_info->cost : '' ?>" placeholder="Enter product cost" required/>
        </div>
</div>

<div class="form-group">
        <label for="percentage" class=" col-md-3">Product Price *</label>
        <div class=" col-md-9">
            <input type="text" name="price" class="form-control" id="price" value="<?php echo $model_info->price ? $model_info->price : '' ?>" placeholder="Enter product price" required/>
        </div>
</div>

<div class="form-group">
        <label for="percentage" class=" col-md-3">Alert Quantity</label>
        <div class=" col-md-9">
            <input type="number" name="alert_quantity" class="form-control" id="alert_quantity" value="<?php echo $model_info->alert_quantity ? $model_info->alert_quantity : '' ?>" placeholder="Enter alert quantity"/>
        </div>
</div>



<div class="form-group">
        <label for="percentage" class=" col-md-3">Tax *</label>
        <div class=" col-md-9">
            <div class="row">
                 <div class="col-md-6">
                    <select name="tax_id" class="form-control" required>   
                        <option value="" ></option> 
                            <?php 
                                $tax = $model_info->tax_id ? $model_info->tax_id : 0;
                            ?>
                            <?php foreach($tax_all as $tx){?>
                                <option 
                                    <?php
                                        if($tax != 0){
                                            echo ($tax == $tx->id) ? ' selected' : '';
                                        }
                                    ?>
                                    value="<?php echo $tx->id; ?>"><?php echo $tx->title; ?>
                                </option>
                            <?php }  ?>                                                      
                        </select>
                 </div>
                 <div class="col-md-6">
                    <select name="tax_method" class="form-control">   
                        <option value="" >Select Tax Method</option> 
                            <?php 
                                $tax_method = $model_info->tax_method ? $model_info->tax_method : 0;
                            ?>
                            
                                <option <?php echo ($tax_method == 1) ? ' selected' : ''; ?> value="1">Exclusive</option>

                                <option <?php echo ($tax_method == 2) ? ' selected' : ''; ?> value="2">Inclusive</option>
                                                                               
                        </select>
                 </div>
            </div>
        </div>
</div>


<input type="hidden" name="oldimage" value="<?php echo $model_info->image ? $model_info->image : NULL; 
?>"/>

<div class="modal-footer">
                                        
        <div id="post-dropzone" class="post-dropzone box-content form-group">
            <?php $this->load->view("includes/dropzone_preview"); ?>

            <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> Upload product image</button>
            
        </div>

    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#products-form").appForm({
            onSuccess: function(result) {
                $("#products-table").appTable({newData: result.data, dataId: result.id});
            }
        });
        $("#product_name").focus();
    });
    $(document).ready(function () {

var uploadUrl = "<?php echo get_uri("products/upload_file"); ?>";
var validationUrl = "<?php echo get_uri("products/validate_post_file"); ?>";
var dropzone = attachDropzoneWithForm("#post-dropzone", uploadUrl, validationUrl);

$("#post-form").appForm({
    isModal: false,
    onSuccess: function (result) {
        if ($("body").hasClass("dropzone-disabled")) {
            location.reload();
        } else {
            $("#post_description").val("");
            $("#product").prepend(result.data);
            dropzone.removeAllFiles();
        }
    }
});

});

//AG2703QQQ
$(document).on('change', '#unit-id', function(){
    var unitId = $(this).val();
    $('#purchase-unit-id').val(unitId);
    $('#sale-unit-id').val(unitId);
});

</script>    