<!-- ag -->
<div class="panel">
    <div class="tab-title clearfix">
        <h4><?php echo lang('expenses'); ?></h4>
        <div class="title-button-group">
            
            <?php echo modal_anchor(get_uri("expenses/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_expense'), array("class" => "btn btn-default mb0", "title" => lang('add_expense'), "data-post-user_id" => $user_id)); ?>
        </div>
    </div>
    <br />
    <?php 
        $total_amount = 0;
        $waiting_amount = 0;
        $net_amount = 0;
        $approved_amount = 0;
        foreach($expenses as $ex){
            $total_amount += $ex->amount;

            if($ex->status == 'Pending'){
                $waiting_amount += $ex->amount_approval;
            }else if($ex->status == 'Approved'){
                $approved_amount += $ex->amount_approval;
            }

        }

        $net_amount =  $total_amount - $approved_amount;
        
    ?>
   <!--  <div class="text-center" style="padding-left: 60px;">
    <div class="row" style="padding: 20px; background-color: #2874a6;color: #dfe6e9; width:90%">
    <h5>
        <div class="col-md-4">
            <b>TOTAL EXPENSE AMOUNT : <?php echo number_format($total_amount,2); ?></b>
        </div>
        <div class="col-md-4">
            <b>WAITING FOR APPROVAL : <?php echo number_format($waiting_amount,2);?></b>
        </div>
        <div class="col-md-4">
            <b>BALANCE IN HAND :  <?php echo number_format($net_amount,2); ?></b>
        </div>
       </h5> 
    </div>
    </div>
   <hr /> -->
    <div class="container table-responsive">
        <table id="expense-table" class="display" cellspacing="0" width="100%">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $EXPENSE_TABLE = $("#expense-table");

        $EXPENSE_TABLE.appTable({
            source: '<?php echo_uri("expenses/list_data") ?>',
            filterParams: {user_id: "<?php echo $user_id; ?>"},
            order: [[0, "asc"]],
            columns: [
                {visible: false, searchable: false},
                {title: 'Company Name', "iDataSort": 0},
                {title: '<?php echo lang("category") ?>'},
                {title: 'From km'},
                {title: 'To km'},
                {title: 'Difference'},
                {title: '<?php echo lang("amount") ?>', "class": "text-right"},
                {title: '<?php echo lang("tax") ?>', "class": "text-right"},
                {title: '<?php echo lang("second_tax") ?>', "class": "text-right"},
                {title: 'Status', "class": "text-right"},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: [1, 2, 3, 4, 6, 7, 8, 9],
            xlsColumns: [1, 2, 3, 4, 6, 7, 8, 9],
            summation: [{column: 6, dataType: 'currency'}, {column: 7, dataType: 'currency'}, {column: 8, dataType: 'currency'}, {column: 9, dataType: 'currency'}]
        });
    });
</script>