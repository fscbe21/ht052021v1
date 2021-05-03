<div class="row">
    <div class="col-md-4">
        <div class="p-2">


        <?php
            $CI =& get_instance();
            $st = $CI->Lead_status_model->get_one($info->lead_status_id);
            $status = '<span style="padding: 4px;background-color: '.$st->color.'">'.$st->title.'</span>'; 
            
            $userinfo = $CI->Users_model->get_one($info->owner_id);
            $visitinfo = $CI->Lead_visit_model->before_transfer_info($info->owner_id, $info->id);
            $ownerid = $visitinfo[0]->owner_id;
            if($ownerid != ''){
                $userinfoo  = $CI->Users_model->get_one($ownerid);
                $first_name =  $userinfoo->first_name." ".$userinfoo->last_name;
            }else{
                $first_name = "-";
            }
               ?>
               
            <?php
                foreach($visit_info as $vi){
                    $last_visit = $vi->timestamp;
                }
            ?>
          
        <table class="table table-striped">
    
    <tbody>

      <tr>
        <td>Company Name:</td>
        <td><?php echo $info->company_name; ?></td>        
      </tr>


      <tr>
        <td>Contact Person:</td>
        <td><?php echo $info->contact_person; ?></td>        
      </tr>

      <tr>
        <td>Contact phone number:</td>
        <td><?php echo $info->phone; ?></td>        
      </tr>
  

      <tr>
        <td>Status:</td>
        <td><?php echo $status; ?></td>        
      </tr>


      <tr>
        <td>Product:</td>
        <td><?php echo $userinfo->first_name." ".$userinfo->last_name; ?></td>        
      </tr>


      <tr>
        <td>Assign:</td>
        <td><?php echo $info->phone; ?></td>        
      </tr>


      <tr>
        <td>From:</td>
        <td><?php echo $first_name; ?></td>        
      </tr>

      <tr>
        <td>Opening Date:</td>
        <td><?php echo dateFormatChange($info->created_date); ?></td>        
      </tr>

      <tr>
        <td>Followup Date:</td>
        <td><?php echo dateFormatChange($info->followup_date); ?></td>        
      </tr>

      <tr>
        <td>Followup Date:</td>
        <td><?php echo dateFormatChange($info->followup_date); ?></td>        
      </tr>

      <tr>
        <td>Time:</td>
        <td><?php echo convert_time_to_12hours_format($info->time); ?></td>        
      </tr>
<?php

      if($CI->login_user->is_admin) {  ?>
      <tr>
        <td>Sales Value:</td>
        <td><?php echo $info->total_value; ?></td>        
      </tr>
      <?php } ?>
      <tr>
        <td>Last update:</td>
        <td><?php echo $last_visit; ?></td>        
      </tr>

    </tbody>
  </table>
       
          
         
        </div>
    </div>

    <style>
        .visit-info{
            padding: 5px;
            background-color: #dfe6e9;
        }

        #dinfo{
            position: absolute; 
            height: 300px;
            width: 100%;
            overflow-y: scroll; 
        }

        .space{
            padding: 3px;
        }
       </style>

    <div class="col-md-6">
        <div class="p-2">
      
            <?php 
            
            if($visit_info){
                if(count($visit_info) > 3)
                {
                    ?>
                    <div id="dinfo">
                    <?php
                }
                else
                {
                    ?>
                    <div>
                    <?php
                }
                ?>
                
                <?php
               
                foreach($visit_info as $e){
                    $source = $CI->Lead_source_model->get_one($e->lead_source_id);
                    $status = $CI->Lead_status_model->get_one($e->lead_status_id); 
                     //darini 10-2
                    foreach ($team_members as $tm) {
                        if($e->owner_id==$tm->id){
                            $name=$tm->first_name;
                        }
                    }
                    echo "<div class='visit-info'><small>".$source->title." - ".$e->timestamp.", ".$status->title.".<br />".$name."<br />".$e->description."<br />"."Follow up date: ".dateFormatChange($e->followup_date).",".convert_time_to_12hours_format($e->time)."</small></div><div class='space'></div>";
                }
                //end
                ?>
                </div>
                <?php
            }
            else{
                echo "<small class='text-danger'>No visit information found.</small>";

            }
            
            
            ?>
        </div>
    </div>
</div>