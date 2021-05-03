<?php
    $work_order_type = array();

    $work_order_type[0]['id'] ='';
    $work_order_type[0]['text'] = 'Order Type (All)';

    $work_order_type[1]['id'] ='work_order';
    $work_order_type[1]['text'] = 'Sale Order';
    
    $work_order_type[2]['id'] ='job_order';
    $work_order_type[2]['text'] = 'Job Order';

    echo json_encode($work_order_type);
?>