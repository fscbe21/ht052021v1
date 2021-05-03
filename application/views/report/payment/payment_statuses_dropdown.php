<?php
    $payment_statuses_dropdown = array();
    $payment_list_data = $this->Payment_methods_model->get_details()->result();
    $payment_statuses_dropdown[0]['id'] ='';
    $payment_statuses_dropdown[0]['text'] = '-- Method --';

    $i = 1;
    foreach ($payment_list_data as $list)
    {
        $payment_statuses_dropdown[$i]['id'] = $list->id;
        $payment_statuses_dropdown[$i]['text'] = $list->title;
        $i++;
    }

    echo json_encode($payment_statuses_dropdown);
?>


   