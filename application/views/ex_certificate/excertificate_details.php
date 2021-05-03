<div class="modal-body">

<div id="printable_area">

    <div class="row">
    <div class="p10 clearfix">
            <div class="media m0 bg-white">
                <div class="media-center">
    <div class="table-responsive mb15">
            <table class="table dataTable display b-t">
<tr><td> <?php echo
                (date("d/m/y H:i:s A", strtotime($model_info->created_at))); ?>
                 </td>
                 <td style="width: 45%; vertical-align: top;"> <?php $this->load->view('invoices/invoice_parts/company_logo'); ?></td>
</tr>
</table>

</div>
               
            </div>
        </div>
        </div>
    <!--<div class="p10 clearfix">
            <div class="media m0 bg-white">
                <div class="media-center">
              
                <?php $this->load->view('invoices/invoice_parts/company_logo'); ?>
               <?php echo
                (date("d/m/y H:i:s A", strtotime($model_info->created_at))); ?>
                 
 
                </div>
               
            </div>
        </div>-->
       

        

        <div class="p10 clearfix">
            <div class="media m0 bg-white">
                <div class="media-center">
                <center><h1> <?php echo lang('concern');?></h1></center>
                    
                </div>
                
            </div>
        </div>

       

        <div class="table-responsive mb15">
            <table class="table dataTable display b-t">
                
            <tr>
                    <td> <?php echo "Mr"; ?></td>


                    <td><?php echo $user_info->first_name,$last_name; ?></td>
                  <!--  <td><?php //echo $model_info->employee; ?></td>
                    <td><?php //echo $model_info->created_by_user; ?></td>-->
                </tr>
                <tr>
                    <td> <?php echo lang('description'); ?></td>
                    <td><?php echo $model_info->description; ?></td>
                </tr>
                <tr>
                    <td> <?php echo lang('botom_description'); ?></td>
                    <td><?php echo ($model_info->bottom_description); ?></td>
                </tr>
                
                
                <?php if ($leave_info->status === "rejected") { ?>
                    <tr>
                        <td> <?php echo lang('rejected_by'); ?></td>
                        <td><?php
                            $image_url = get_avatar($leave_info->checker_avatar);
                            echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $leave_info->checker_name . "</span>";
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php if ($leave_info->status === "approved") { ?>
                    <tr>
                        <td> <?php echo lang('approved_by'); ?></td>
                        <td><?php
                            $image_url = get_avatar($leave_info->checker_avatar);
                            echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $approval . "</span>";
                            //darini 22-2?>
                        </td>
                    </tr>
                <?php } ?>
            </table>

           
        <div class="p10 clearfix">
            <div class="media m0 bg-white">
                <div class="media">

                <p> </p></br>
                <p> </p></br>
                <p> </p></br>

                <p style="align:right">
                Authorize Signature</p>

   <!--<table border="0">  
   <tr>          
   <td cellspacing="500">
                <p style="text-align:right;">
                Administration Signature</p>
</td><td></td><td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>


<td align:right>
                <p >
                Authorize Signature</p>

                </td>
                </tr>
                </table> -->
                </div>
              
            </div>
        </div>



        </div>
    </div>
</div>


</div>
<?php echo form_open(get_uri("leaves/update_status"), array("id" => "leave-status-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="id" value="<?php echo $leave_info->id; ?>" />
<input id="leave_status_input" type="hidden" name="status" value="" />
<div class="modal-footer">
<button class="btn btn-primary" id="printdemo"><i class="fa fa-print"></i> Print</button>
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <?php if ($leave_info->status === "pending" && $this->login_user->id === $leave_info->applicant_id) { ?>
        <button data-status="canceled" type="submit" class="btn btn-danger btn-sm update-leave-status"><span class="fa fa-times-circle-o"></span> <?php echo lang('cancel'); ?></button>
    <?php } ?>   
    <?php if ($leave_info->status === "pending" && $show_approve_reject) { 
        if($show==1){
          ?>
        <button data-status="rejected" type="submit" class="btn btn-danger btn-sm update-leave-status"><span class="fa fa-times-circle-o"></span> <?php echo lang('reject'); ?></button>
        <button data-status="approved" type="submit" class="btn btn-success btn-sm update-leave-status"><span class="fa fa-check-circle-o"></span> <?php echo lang('approve'); ?></button>
    <?php }} ?>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function() {

        $(".update-leave-status").click(function() {
            $("#leave_status_input").val($(this).attr("data-status"));
        });

        $("#leave-status-form").appForm({
            onSuccess: function() {
                location.reload();
            }
        });

    });


    $(document).on('click','#printdemo', function(){
            var prtContent = document.getElementById("printable_area");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        });
</script>    



