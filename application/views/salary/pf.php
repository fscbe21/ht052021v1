<div id="page-content" class="m20 clearfix">
  

    <div class="panel">
        
            <div class="tab-title clearfix">
                <h4><?php echo lang("pf"); ?></h4>
               
            </div>
        
       <div class="tab-content">
            <div class="modal-body clearfix " >
                       <div style="padding-left: 20px;">
                       <button id="print" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print</button><br /><br />
                        <div id="printable_area" class="table-responsive" style="max-width: 770px">
                        <style>
            .firstTable {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 750px;
            }

            .firstTable td, #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            .firstTable tr:nth-child(even){background-color: #f2f2f2;}

            .firstTable tr:hover {background-color: #ddd;}

            .firstTable th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
            }
        </style>
                        <table class="table table-bordered table-striped firstTable">
                            <tr>
                                <th style="width: 5%">Sl#</th>
                                <th style="width: 10%">Employee Name</th>
                                <th style="width: 10%">ID</th>
                                <th style="width: 10%">Designation</th>
                                <th style="width: 10%">Subscription Amount</th>
                                <th style="width: 10%">Contribution Amount</th>
                                <th style="width: 10%">Total Provident Funds</th>
                            </tr>
                            <?php
                                $ci =&get_instance();
                                $payroll_data = $ci->Payroll_model->getpayroll_list();
                                $sl1 = 1;
                                $total_provident = 0;
                                foreach($payroll_data as $ph)
                                {
                                    $emp_data = $ci->Users_model->get_one($ph->user_id);
                                    $salary_data = $ci->Salarypayments_model->payments_history_all($ph->user_id);

                                    $total_provident_fund = 0;

                                    foreach($salary_data as $salary){
                                        $total_provident_fund += $salary->provident_fund;
                                    }

                                    $total_provident += $total_provident_fund;

                            ?>
                            <tr>
                                <td style="width: 5%"><?php echo $sl1; ?></td>
                                <td style="width: 10%"><?php echo $emp_data->first_name.' '.$emp_data->last_name; ?></td>
                                <td style="width: 10%"><?php echo $emp_data->id; ?></td>
                                <td style="width: 10%"><?php echo $emp_data->job_title; ?></td>
                                
                                <td style="width: 10%"><?php echo $ph->provident_fund_contribution; ?></td>
                                <td style="width: 10%"><?php echo $ph->provident_fund_deduction; ?></td>
                                <td style="width: 10%"><?php echo $total_provident_fund; ?></td>
                            </tr>
                                <?php
                                    $sl1 += 1;
                                }
                                ?> 
                                <tr style="background-color: #f5f6fa;">
                                <td style="width: 5%" colspan="7">&nbsp;</td>
                                <tr style="background-color: #dcdde1; color: #2f3640;">
                                <td style="width: 5%" colspan="5"></td>
                                <td style="width: 10%"><b>Total Amount </b></td>
                                <td style="width: 10%"><b><?php echo $total_provident; ?></b></td>
                            </tr>       
                            </table>
                            
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    </div>

<script type="text/javascript">
    $(document).on('click','#print', function(){
        var prtContent = document.getElementById("printable_area");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });
</script>