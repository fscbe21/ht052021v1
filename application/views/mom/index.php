
<div id="page-content" class="p20 clearfix">
    <div class="p-1">
            
    
        <div class="">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('mom_list'); ?></h4>
                    <br>
                    <div class="title-button-group" >

                    
                            <?php echo modal_anchor(get_uri("mom/modal_form"), lang('add_mom'), array("class" => "list-group-item","title" => lang('add_mom'))); ?> 
                        
                    </div>
                
                    
                </div>
                <div class="table-responsive">
                    <table id="moms-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#moms-table").appTable({
            source: '<?php echo_uri("mom/list_data_test") ?>',
            columns: [
                {title: 'ID'},
                {title: 'Title'},
                {title: 'Conduct By'},
                {title: 'Person Present'},
                
                {title: 'Venue'},
                {title: 'Start Time'},
                {title: 'End Time'},
                {title: 'Content'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center dropdown-option "}
            ]
        });
    });

   

</script>