<style>
    .modal-body{
        min-width: 100%;
    }
    .table-responsive{
        font-weight: 600;
    }

    .w30{
        width: 30%;
    }

    .w60{
        width: 60%;
    }
</style>
<div class="modal-body clearfix">
    <div class="table-responsive">  
     Quotation Detail<br /> <br />        
       <table class="table table-striped table-bordered">
       <tr>
          <td class="w30">Quotation_No</td><td class="w60">&nbsp;<?php echo $model_info->quotation_no; ?></td>
       </tr>
       <tr>
         
          <td class="w30">Date</td><td class="w60">&nbsp;<?php echo $model_info->date; ?></td>
       </tr>
       <tr>
        
          <td class="w30">Purchase Request No</td><td class="w60">&nbsp;<?php echo $model_info->purchase_req_no; ?></td>
       </tr>
       <tr>
       
          <td class="w30">file_name</td><td class="w60">&nbsp;<?php echo $model_info->file_name; ?></td>
       </tr>
       
       </table>
      


  </div>
</div>

<div class="modal-footer">

    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>

    <a href="quotations/edit/<?php echo $model_info->id; ?>">
        <button type="button" class="btn btn-primary"><span class="fa fa-pencil"></span>&nbsp;Edit</button>
    </a>
</div>   