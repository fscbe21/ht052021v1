<?php
    $production_status = array();

    $production_status[0]['id']   = '';
    $production_status[0]['text'] = 'Status (All)';

    $production_status[1]['id']   ='completed';
    $production_status[1]['text'] = 'Completed';
    
    $production_status[2]['id']   ='processing';
    $production_status[2]['text'] = 'Processing';

    $production_status[3]['id']   ='not_started';
    $production_status[3]['text'] = 'Not Started';

    $production_status[4]['id']   ='pending';
    $production_status[4]['text'] = 'Pending';

    echo json_encode($production_status);
    
?>