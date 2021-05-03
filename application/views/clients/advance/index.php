
    <div class="panel">
        <div class="tab-title clearfix">
            <h4><?php echo "Advance"; ?></h4>
            <div class="title-button-group">
                <?php
              
                   

                    echo modal_anchor(get_uri("clients/add_advance"), "<i class='fa fa-plus-circle'></i> " . "Add Advance", array("class" => "btn btn-default", "title" => "Add Advance", "data-post-client_id" => $client_id));
             
                ?>
            </div>
        </div>

        <div class="table-responsive">
            <table id="advance" class="display" width="100%">            
            </table>
        </div>
    </div>




<script type="text/javascript">
    $(document).ready(function () {

       

        $("#advance").appTable({
            source: '<?php echo_uri("clients/advance_list/" . $client_id) ?>',
            order: [[1, "asc"]],
            columns: [
                {title: '', "class": "w50 text-center"},
                {title: "<?php echo lang("name") ?>", "class": "w150"},
                { title: "Advance Amount", "class": "w150"},
                {title: "Advance Date", "class": "w15p"},
                {title: "Advance Notes", "class": "w20p"},
                
              

                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w50"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 2, 3, 4, 5]),
            xlsColumns: combineCustomFieldsColumns([0, 1, 2, 3, 4, 5])
        });
    });
</script>