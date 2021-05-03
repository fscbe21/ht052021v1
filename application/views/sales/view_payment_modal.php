
<div class="modal-body clearfix" >
    <div class="table-responsive" id="sale_details">  
        <div>
            <table class="table">
                <thead>
                    <th>Date</th>
                    <th>Reference </th>
                    <th>Account </th>
                    <th>Amount </th>
                    <th>Paid By </th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($payments_info as $info) {?>
                    <tr>
                        <td> <?php echo $info->created_at; ?> </td>
                        <td> <?php echo $info->payment_reference; ?> </td>
                        <?php $acc= $this->AccountingModel->get_one($info->account_id ); ?>
                        <td> <?php echo $acc->name; ?> </td>
                        <td> <?php echo $info->amount; ?> </td>
                        <?php $pay= $this->Payment_methods_model->get_one($info->paying_method ); ?>
                        <td> <?php echo $pay->title ;?> </td>
                        <td class="option text-center">
                        <?php                   
                            echo modal_anchor(get_uri("sales/edit_payment_modal_form/".$info->id."/".$info->sale_id), "<i class='fa fa-pencil'></i> " , array("class" => "btn btn-default", "title" => "Edit Payment"));                                                                      
                        ?>
                      
                           <!-- <a href="<?php echo  get_uri("sales/deletePayment/".$info->id )?>" title="Delete Payment" class="delete"  ><i class="fa fa-times fa-fw"></i> </a>-->
                           <a onclick="confirmPaymentDelete(<?php echo $info->id?>)" class="delete"><i class="fa fa-times fa-fw"></i></a>
                    </td>
                    </tr>
                    <?php }?>    
                </tbody>
            </table>
                                
        </div>
                                                            
  </div>
</div>

<script type="text/javascript">
function confirmPaymentDelete(id){
   if (confirm("Are you sure want to delete? If you delete this money will be refunded.")) {

    $.ajax({
            type: 'GET',
            url:  '<?php echo  get_uri("sales/deletePayment/" )?>'+id,                  
            success: function(data) 
            {
                var obj=JSON.parse(data);                
                appAlert.success(obj.message, {duration: 1000});               
                var reloadUrl = "<?php echo echo_uri("sales"); ?>";
               if (reloadUrl) {
                    setTimeout(function () {
                        window.location.href = reloadUrl;
                    }, 500);
                }
               
            }
        });
   }
   return false;
        
}
 
        

</script>    

  
  
