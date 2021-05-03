<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-check-circle"></i>&nbsp; Sales Target
    </div>
    <style>
        .customcs{
            padding: 16px;
            font-weight: bold;
        }
    </style>
    <div id="upcoming-event-container8">
        <div class="panel-body">
            <div style="max-height: 150px !important;">
               <div class="row">
                    <div class="col-md-6 customcs">
                        Total : 123504
                    </div>
                    <div class="col-md-6 customcs">
                        No of days left : 29
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-6 customcs">
                        Achieved : 100250
                    </div>
                    <div class="col-md-6 customcs">
                        Balance : 23254
                    </div>
               </div>
            </div>
           
        </div>
    </div>
</div>
<?php 
    if($this->login_user->role_id == 3)
    {
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-plus-square-o"></i>&nbsp; Type of material
    </div>
    <div id="upcoming-event-container1">
        <div class="panel-body">
            <div style="max-height: 180px !important;">
<?php 
    $mat_data = $this->Clients_model->materials_info($this->login_user->id);
    foreach($mat_data as $md)
    {
?>
               <div class="row">
                    <div class="col-md-12"><strong><?php echo $md->product; ?>&nbsp;:&nbsp;<?php echo $md->qty." ".$md->unit."<br />"; ?></strong></div>
               </div>
<?php
    }
?><br />
            </div>
           
        </div>
    </div>
</div>
<?php
    }
?>