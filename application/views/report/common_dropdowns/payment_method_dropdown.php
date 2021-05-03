<?php
    $payment_method_dropdown = array();
    $payment_list_data = $this->Payment_methods_model->get_details()->result();
    $payment_method_dropdown[0]['id'] ='';
    $payment_method_dropdown[0]['text'] = '-- Method --';

    $i = 1;
    foreach ($payment_list_data as $list)
    {
        $payment_method_dropdown[$i]['id'] = $list->id;
        $payment_method_dropdown[$i]['text'] = $list->title;
        $i++;
    }

    echo json_encode($payment_method_dropdown);
?>


   