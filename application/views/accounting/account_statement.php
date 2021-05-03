<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo "Account Statement"; ?></h4>
                <br>
              
                
            </div>
            <div  style="padding:10px">
            <h4> <strong>Account:</strong><?php echo $accdet->name?>[<?php echo $accdet->account_no?> ]</h4>
            </div>

        <div class="table-responsive" id="new_work_list" class="display dataTable " role="grid" style="padding:20px">
            
            <table id="balance-table"  class="display" width="100%"> 
            <thead>
                <th>Date</th>
                <th>Referenece</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Balance</th>
            </thead>
            <tbody>
               
                <?php 
                foreach($sales_total as $sal){
                    $balance=$balance+$sal->amount ;
                    ?>

                    <tr>

              
                <td><?php echo $sal->created_at ?></td>
                <td><?php echo $sal->payment_reference ?></td>
                <td><?php echo $sal->amount ?></td>
                <td>0</td>
                <td><?php echo  $balance?></td>
                </tr>
                <?php } ?>

                <?php 
                foreach($received_money as $sal){
                    $balance=$balance+$sal->amount ;
                    ?>

                    <tr>

              
                <td><?php echo $sal->created_at ?></td>
                <td><?php echo $sal->reference_no ?></td>
                <td><?php echo $sal->amount ?></td>
                <td>0</td>
                <td><?php echo  $balance?></td>
                </tr>
                <?php } ?>

                <?php 
                foreach($purchase_total as $sal){
                    $balance=$balance-$sal->amount ;
                    ?>

                    <tr>

              
                <td><?php echo $sal->created_at ?></td>
                <td><?php echo $sal->payment_reference ?></td>
                <td>0</td>
                <td><?php echo $sal->amount ?></td>
                <td><?php echo  $balance?></td>
                </tr>
                <?php } ?>

                


                <?php 
                foreach($sent_money as $sal){
                    $balance=$balance-$sal->amount ;
                    ?>

                    <tr>

              
                <td><?php echo $sal->created_at ?></td>
                <td><?php echo $sal->reference_no ?></td>
                <td>0</td>
                <td><?php echo $sal->amount ?></td>
                <td><?php echo  $balance?></td>
                </tr>
                <?php } ?>

                
            </tbody>
          
            </table>
        </div>
    </div>
    
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $("#balance-table").DataTable({                       
           
        });
    });
 
        </script>