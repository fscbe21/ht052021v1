<div class="table-responsive">
    <table id="petrol-bunk-table" class="display no-thead b-t b-b-only no-hover" cellspacing="0" width="100%">         
    </table>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#petrol-bunk-table").appTable({
            source: '<?php echo_uri("petrol_bunk/list_data") ?>',
            order: [[0, "asc"]],
            hideTools: true,
            displayLength: 100,
            columns: [
                {visible: false},
                {title: '<?php echo lang("title"); ?>'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            onInitComplete: function () {
                //apply sortable
                $("#petrol-bunk-table").find("tbody").attr("id", "custom-field-table-sortable-source");
                var $selector = $("#custom-field-table-sortable-source");

                Sortable.create($selector[0], {
                    animation: 150,
                    chosenClass: "sortable-chosen",
                    ghostClass: "sortable-ghost",
                    onUpdate: function (e) {
                        appLoader.show();
                        //prepare sort indexes 
                        var data = "";
                        $.each($selector.find(".field-row"), function (index, ele) {
                            if (data) {
                                data += ",";
                            }

                            data += $(ele).attr("data-id") + "-" + index;
                        });

                        //update sort indexes
                        $.ajax({
                            url: '<?php echo_uri("petrol_bunk/update_field_sort_values") ?>',
                            type: "POST",
                            data: {sort_values: data},
                            success: function () {
                                appLoader.hide();
                            }
                        });
                    }
                });

            }

        });
    });
</script>