<div id="page-content" class="clearfix p20">
    <div class="panel clearfix">
         <h4 class="pl15 pt10 pr15">Salary Detail</h4>
         <hr>
         <div style="padding-left: 20px;">
         <a href="make_payment">
        <button class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i>&nbsp;Back</button></a>
        <button id="print" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print</button>
        <br />
        <br />
        
    </div>
    <div class="container">
    <div id="printable_area" class="table-responsive">
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
        <table class="table table-bordered table-striped firstTable" style="max-width: 750px">
        <tr>
            <td>
                <p>
                    <?php echo 'Employee Id : '.$emp_data->id; ?>
                    <br>
                    <?php echo 'Name : '.$emp_data->first_name.' '.$emp_data->last_name; ?>
                    <br>
                    <?php echo 'Position : '.$emp_data->job_title; ?>
                    <br>
                    <?php echo 'Department : '.$emp_data->department; ?>
                    <br>
                    <?php echo 'Joining Date : '.$job_info[0]->date_of_hire; ?>
                </p>
            </td>
            <td style="width: 45%; vertical-align: top;">
            <?php $this->load->view('invoices/invoice_parts/company_logo'); ?>
        </td>
        </tr>
        </table>
        <table class="table table-bordered table-striped firstTable">
            <tr>
                <th style="width: 5%">sl#</th>
                <th style="width: 50%">Description</th>
                <th style="width: 10%">Debits</th>
                <th style="width: 10%">Credits</th>
            </tr>
    <?php
            $sl = 1;
            foreach($salarydetail as $detail){
                ?>
                <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $detail->item_name; ?></td>
                    <td><?php echo ($detail->status == 'Debit') ? $detail->amount : ''; ?></td>
                    <td><?php echo ($detail->status == 'Credit') ? $detail->amount : ''; ?></td>
                </tr>
                <?php
                $sl += 1;
            }
    ?>           
        
        </table>
        <br />
        <b>
        <table class="table table-bordered firstTable" width='100%'>
        <tr>
                  <td align="right">Gross Salary</td>
                  <td><?php echo $salaryData[0]->gross_salary; ?></td>
        </tr>
        <tr>
                  <td align="right">Total Deduction</td>
                  <td><?php echo $salaryData[0]->total_deduction; ?></td>
        </tr>
        <tr>
                  <td align="right">Net Salary</td>
                  <td><?php echo $salaryData[0]->net_salary; ?></td>
        </tr>
        <tr>
                  <td align="right">Provident Fund</td>
                  <td><?php echo $salaryData[0]->provident_fund; ?></td>
        </tr>
        
        </table>


        <table class="table table-bordered firstTable" width='100%'>
        <tr>
                  <td align="right">Present Days</td>
                  <td><?php echo $salaryData[0]->present_days; ?></td>
        </tr>
        <tr>
                  <td align="right">Absent Days</td>
                  <td><?php echo $salaryData[0]->absent_days; ?></td>
        </tr>
        <tr>
                  <td align="right">Rest Leave</td>
                  <td><?php echo $salaryData[0]->rest_leave; ?></td>
        </tr>
        <tr>
                  <td align="right">Sunday</td>
                  <td><?php echo $salaryData[0]->sunday; ?></td>
        </tr>

        <tr>
                  <td align="right">Holiday</td>
                  <td><?php echo $salaryData[0]->holidays; ?></td>
        </tr>

        <tr>
                  <td align="right">Total Working Hours</td>
                  <td><?php echo $salaryData[0]->total_work_hours; ?></td>
        </tr>

        <tr>
                  <td align="right">Leave Deduction</td>
                  <td><?php echo $salaryData[0]->leave_deduction; ?></td>
        </tr>
        
        </table>


</b>
        
    </div>
    </div>
    <br />
    <br />
    
</div>
<div class="panel clearfix">
         <h4 class="pl15 pt10 pr15">Payment History</h4>
         <hr>
         <div style="padding-left: 20px;">
       <div class="table-responsive" style="max-width: 750px">
       <table class="table table-bordered table-striped firstTable">
            <tr>
                <th style="width: 5%">sl#</th>
                <th style="width: 10%">Salary Month</th>
                <th style="width: 10%">Gross Salary</th>
                <th style="width: 10%">Total Deduction</th>
                <th style="width: 10%">Net Salary</th>
                <th style="width: 10%">Provident Fund</th>
                <th style="width: 10%">Payment Amount</th>
                <th style="width: 10%">Payment Type</th>
                <th style="width: 10%">Note</th>
            </tr>

            <?php
                if(count($paymentHistory) > 0){
                    $sl1 = 1;
                    foreach($paymentHistory as $ph){
                        ?>
                        <tr>
                <td style="width: 5%"><?php echo $sl1; ?></td>
                <td style="width: 10%"><?php echo $ph->payment_month; ?></td>
                <td style="width: 10%"><?php echo $ph->gross_salary; ?></td>
                <td style="width: 10%"><?php echo $ph->total_deduction; ?></td>
                <td style="width: 10%"><?php echo $ph->net_salary; ?></td>
                <td style="width: 10%"><?php echo $ph->provident_fund; ?></td>
                <td style="width: 10%"><?php echo $ph->payment_amount; ?></td>
                <td style="width: 10%"><?php 

                if($ph->payment_type == 1){
                    echo " Cash ";
                }else if($ph->payment_type == 2){
                    echo " Cheque ";
                }else{
                    echo " Bank Account";
                }
                
                ?></td>
                <td style="width: 10%"><?php echo $ph->note; ?></td>
            </tr>
                        <?php
                        $sl1 += 1;
                    }
                }
            ?>        
        </table>
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


   

