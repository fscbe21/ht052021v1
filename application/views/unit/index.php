<div id="page-content" class="p20 clearfix">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <?php
            $tab_view['active_tab'] = "unit";
            $this->load->view("settings/tabs", $tab_view);
            ?>
        </div>

        <div class="col-sm-9 col-lg-10">
            <div class="panel panel-default">
                <div class="page-title clearfix">
                    <h4> <?php echo lang('unit'); ?></h4>
                    <div class="title-button-group">
                        
                        <?php echo modal_anchor(get_uri("unit/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_unit'), array("class" => "btn btn-default", "title" => lang('add_unit'))); ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="unit-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#unit-table").appTable({
            source: '<?php echo_uri("unit/list_data") ?>',
            columns: [
                {title: '<?php echo lang("unit").' '.lang("name"); ?>'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ]
        });
    });
</script>