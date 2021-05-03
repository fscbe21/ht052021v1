<style>
#search{
    min-height: 50px;
    border: 1px solid #2c3e50;
}
</style>
<div class="p20 panel panel-default">
 

     <div class="page-title clearfix">
        <h4> <?php echo 'Processing'; ?></h4>

       
      
    </div>

    <?php 
    if(count($details) > 0 ){
        $work_order_data=$this->Work_order_model->get_one($details[0]->work_order_id);

        $customer_details=$this->Clients_model->get_one($work_order_data->customer_id);
    }

    
    ?>
   
    <?php echo form_open(get_uri("#"), array("id" => "start-process-form", "class" => "general-form", "role" => "form")); ?>
    <div class="row">
     

        <div class="col-md-3">
            <div class="form-group">
                <label for="work_order_number"><?php echo lang('work_order_number'); ?></label>
                   <input type="text" readonly name="work_order_number" class="form-control" value="<?php echo $work_order_data->id ?>">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="date"><?php echo lang('date'); ?></label>
                <input type="date" readonly name="date" class="form-control"  value="<?php echo $work_order_data->date; ?>">
            </div>           
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="customer" ><?php echo lang('customer'); ?></label>
                <input type="text" readonly name="customer" class="form-control" value="<?php echo $customer_details->company_name; ?>">
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="form-group">
                <label for="notes" ><?php echo lang('notes'); ?></label>
                <input type="text" readonly name="notes" class="form-control" value="<?php echo $work_order_data->notes; ?>">
            </div>
        </div>

 


      
        



    </div>

  
         
    <div class="row">                   
     
        <div class="col-md-12"> 
            <div class="table-responsive">
                <table id="myTable" class="table table-hover order-list" >
                    <thead>
                        <tr>
                            <th>Qty</th>
                            <th>End Product</th>
                            <th>Process</th>
                            <th>Stages</th>

                            <th>Stage Name</th>
                            <th>Process Action</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            
                            <th>Duration(in Mintues)</th>


                            <!-- <th>QC Pass</th>
                            <th>DC</th>

                            <th>QC Fail</th>
                            <th>Rejection</th>
                            <th>Re-Use</th>
                            <th>Wastage</th> -->
                          
                        </tr>
                    </thead>
                    <tbody id="order-table">
                    
                    <?php 
                    
                    $last_end_button='';
                    
                    foreach ($details as $detail) {


                        $process_id_variable=$detail->process_id;


$product_details=$this->Products_model->get_one($detail->end_product_id);
$process_details=$this->Process_model->get_one($detail->process_id);

$work_order_details=$this->Work_order_details_model->get_details(array("work_order_id"=>$detail->work_order_id ,"product_id"=>$end_product_id))->result();
foreach($work_order_details as $work_order_detail){
    $qty=$work_order_detail->qty;
}

?>
                    <tr>

                            <td><?php echo $qty;?></td>
                            <td><?php echo $product_details->name;?></td>
                            <td><?php echo $process_details->title;?></td>
                            <td><?php echo $detail->stage?></td>
                            <td><?php echo $detail->stage_name?></td>
                            <td 
                            
                            data-workorderid="<?php echo $detail->work_order_id;?>"
                            data-endproductid="<?php echo $detail->end_product_id;?>"
                            data-processid="<?php echo $detail->process_id;?>"
                            data-stageid="<?php echo $detail->stage;?>"  

                            data-start="<?php echo $detail->start_date_time ?  'disabled' : '';?>"  
                            data-end="<?php echo $detail->end_date_time ?  'disabled' : '';?>"                     
                            
                            
                            >

                            <button type="button" class="btn btn-success btn-sm start-class" disabled>Start</button>
                            <button type="button" class="btn btn-danger btn-sm end-class" disabled>End</button>

                            </td>
                            <td class="start-time-class"></td>
                            <td class="end-time-class"></td>
                            <td class="duration-class"></td>


                            <!-- <td>QC Pass</td>
                            <td>DC</td>

                            <td>QC Fail</td>
                            <td>Rejection</td>
                            <td>Re-Use</td>
                            <td>Wastage</td> -->
                          
                        </tr>

                        
<?php

$last_end_button=$detail->end_date_time;
}?>

                    </tbody>
                </table>
            </div>
        </div>
<?php if ($this->login_user->is_admin || get_array_value($this->login_user->permissions, "quality_check") == "all") { ?>
        <div class="col-md-12">          
            <!-- <input type="submit" value="Submit" name="submit" class="btn btn-md btn-primary"/>  -->
            <button type="button" class="btn btn-warning btn"  
            
            
            data-woid="<?php echo $work_order_id?>"
            data-epid="<?php echo $end_product_id?>" 
            data-pid="<?php echo $product_id?>"
            data-bomid="<?php echo $bom_id?>" 
            data-qty="<?php echo $qty;?>"

            data-processid="<?php echo $process_id_variable;?>"


            id="qc-id" <?php echo $last_end_button ?  '' : 'disabled';?>>Quality Check</button>
        </div>   
<?php } ?> 
           
    </div>
            
    <?php echo form_close(); ?>                          
</div>


<script>

document.addEventListener("DOMContentLoaded", function(){


    document.getElementById("qc-id").addEventListener("click", function() {

       window.location="<?php echo get_uri()?>"+'qc_process/show/'+this.dataset.woid+'/'+this.dataset.epid+'/'+this.dataset.pid+'/'+this.dataset.bomid+'/'+this.dataset.qty+'/'+this.dataset.processid;

});

    

    let startElements = document.getElementsByClassName("start-class");


    Array.from(startElements).forEach(function(startElement,index) {

       
if(index > 0){
    if(document.getElementsByClassName("start-class")[index-1].disabled === true){
    //startElement.disabled=false;
}
}else{
    startElement.disabled=false;
}



let workOrderId=startElement.parentNode.dataset.workorderid;

let endProductId=startElement.parentNode.dataset.endproductid;

let processId=startElement.parentNode.dataset.processid;

let stageId=startElement.parentNode.dataset.stageid;

stageId=stageId.replace(/ /g,'');

fetch('<?php echo get_uri();?>'+'production_processing/fetch_production_set_stages_start_time/'+workOrderId+'/'+endProductId+'/'+processId+'/'+stageId)
  .then(response => response.json())
  .then(data => {

  if(data[0]){     
    
   
      
    if(data[0].start_date_time){        
        startElement.parentNode.childNodes[1].disabled=true;
        startElement.parentNode.childNodes[3].disabled=false;
      }         

    if(data[0].end_date_time){       
        startElement.parentNode.childNodes[3].disabled=true;

        
         

        if(index !== startElement.length-1 ){ 
            
         if(document.getElementsByClassName("start-class")[index+1]){
            if(document.getElementsByClassName("start-class")[index+1].parentNode.dataset.start !== "disabled"){

document.getElementsByClassName("start-class")[index+1].disabled = false;  

}

         }
           
                
           
        
        }
      }
    
  }
  });



    startElement.addEventListener('click', (event) => {

//console.log(event.target.parentNode.dataset);

let workOrderId=event.target.parentNode.dataset.workorderid;

let endProductId=event.target.parentNode.dataset.endproductid;

let processId=event.target.parentNode.dataset.processid;

let stageId=event.target.parentNode.dataset.stageid;

stageId=stageId.replace(/ /g,'');


fetch('<?php echo get_uri();?>'+'production_processing/update_production_set_stages_start_time/'+workOrderId+'/'+endProductId+'/'+processId+'/'+stageId)
  .then(response => response.json())
  .then(data => {
    if(data === 1){
        event.target.disabled = true;

        event.target.parentNode.childNodes[3].disabled = false;

    return fetch('<?php echo get_uri();?>'+'production_processing/fetch_production_set_stages_start_time/'+workOrderId+'/'+endProductId+'/'+processId+'/'+stageId);
 


    }else{
        alert("Unable to perform the action")
    }
  }).then(response => response.json())
  .then(data => {

    if(data[0]){
        document.getElementsByClassName('start-time-class')[index].innerHTML = data[0].start_date_time;
    }
    
  });



        });
    });



    let endElements = document.getElementsByClassName("end-class");

Array.from(endElements).forEach(function(endElement,index) {


let workOrderId=endElement.parentNode.dataset.workorderid;

let endProductId=endElement.parentNode.dataset.endproductid;

let processId=endElement.parentNode.dataset.processid;

let stageId=endElement.parentNode.dataset.stageid;

stageId=stageId.replace(/ /g,'');

fetch('<?php echo get_uri();?>'+'production_processing/fetch_production_set_stages_end_time/'+workOrderId+'/'+endProductId+'/'+processId+'/'+stageId)
  .then(response => response.json())
  .then(data => {
if(data[0]){
    if(data[0].start_date_time && data[0].end_date_time){


        let date2 = new Date(data[0].end_date_time);
 let date1 = new Date(data[0].start_date_time);

        document.getElementsByClassName('duration-class')[index].innerHTML = parseFloat(((date2-date1)/1000)/60).toFixed(2);
        document.getElementsByClassName('start-time-class')[index].innerHTML = data[0].start_date_time;
        document.getElementsByClassName('end-time-class')[index].innerHTML = data[0].end_date_time;

    }else if(data[0].start_date_time){
        document.getElementsByClassName('start-time-class')[index].innerHTML = data[0].start_date_time;
    }else if(data[0].end_date_time){
        document.getElementsByClassName('end-time-class')[index].innerHTML = data[0].end_date_time;
    }
}

  });

    



    endElement.addEventListener('click', (event) => {

//console.log(event.target.parentNode.dataset);

let workOrderId=event.target.parentNode.dataset.workorderid;

let endProductId=event.target.parentNode.dataset.endproductid;

let processId=event.target.parentNode.dataset.processid;

let stageId=event.target.parentNode.dataset.stageid;

stageId=stageId.replace(/ /g,'');


fetch('<?php echo get_uri();?>'+'production_processing/update_production_set_stages_end_time/'+workOrderId+'/'+endProductId+'/'+processId+'/'+stageId)
.then(response => response.json())
.then(data => {
    
    if(data === 1){

        event.target.disabled = "true";

        if(index !== (endElements.length-1)){

            document.getElementsByClassName('start-class')[index+1].disabled = false;

        }else{          

            document.getElementById("qc-id").disabled= false;
        }


        return fetch('<?php echo get_uri();?>'+'production_processing/fetch_production_set_stages_end_time/'+workOrderId+'/'+endProductId+'/'+processId+'/'+stageId);
 
        

    }else{

        alert("Unable to perform the action");

    }
    

}).then(response => response.json())
.then(data => {
    if(data[0]){
        document.getElementsByClassName('end-time-class')[index].innerHTML = data[0].end_date_time;
        
        if(data[0].start_date_time && data[0].end_date_time){


let date2 = new Date(data[0].end_date_time);
let date1 = new Date(data[0].start_date_time);

document.getElementsByClassName('duration-class')[index].innerHTML = parseFloat(((date2-date1)/1000)/60).toFixed(2);
}
       
    }

});



    });
});

});

</script>

 