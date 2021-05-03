<?php
    $warehouse_dropdown = array();
    $warehouse_list_data = $this->Warehouse_model->get_details()->result();
    $warehouse_dropdown[0]['id'] ='';
    $warehouse_dropdown[0]['text'] = '-- Warehouse --';

    $i = 1;
    foreach ($warehouse_list_data as $list)
    {
        $warehouse_dropdown[$i]['id'] = $list->id;
        $warehouse_dropdown[$i]['text'] = $list->name;
        $i++;
    }

    echo json_encode($warehouse_dropdown);
?>