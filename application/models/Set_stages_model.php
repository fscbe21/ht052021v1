<?php

class Set_stages_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'production_set_stages';
        parent::__construct($this->table);
    }

    /* AG2203 */
    function get_details($options = array()) {
        $production_set_stages_table = $this->db->dbprefix('production_set_stages');

        $where = "";

        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $production_set_stages_table.id=$id";
        }

        $work_order_id = get_array_value($options, "work_order_id");
        if ($work_order_id) {
            $where .= " AND $production_set_stages_table.work_order_id=$work_order_id";
        }

        $end_product_id = get_array_value($options, "end_product_id");
        if ($end_product_id) {
            $where .= " AND $production_set_stages_table.end_product_id=$end_product_id";
        }

        $wo_product_id = get_array_value($options, "wo_product_id");
        if ($wo_product_id) {
            $where .= " AND $production_set_stages_table.wo_product_id=$wo_product_id";
        }

        $process_id = get_array_value($options, "process_id");
        if ($process_id) {
            $where .= " AND $production_set_stages_table.process_id=$process_id";
        }

        $stage = get_array_value($options, "stage");
        if ($stage) {
            $where .= " AND $production_set_stages_table.stage='$stage'";
        }

        $sql = "SELECT $production_set_stages_table.*
        FROM $production_set_stages_table
        WHERE $production_set_stages_table.deleted=0 $where";
        
        return $this->db->query($sql);
    }

    /* AG2203 */
    function deleteEntries($work_order_id, $wo_product_id, $process_id, $stage){
        $sql = "DELETE FROM production_set_stages WHERE work_order_id=$work_order_id AND wo_product_id=$wo_product_id AND process_id=$process_id AND stage='$stage'";

        $this->db->query($sql);

        return TRUE;
    }


    
    //start dsk

    function update_start_time($work_order_id,$end_product_id,$process_id,$stage){

        $sql="UPDATE production_set_stages SET start_date_time = now() WHERE work_order_id = '$work_order_id' AND end_product_id='$end_product_id' AND process_id='$process_id' AND REPLACE(`stage`, ' ', '')= '$stage' ";

if( $this->db->query($sql)){

    return 1;

}
else{
    return 0;
}

    }



    function fetch_start_time($work_order_id,$end_product_id,$process_id,$stage){

        $sql="SELECT start_date_time,end_date_time FROM production_set_stages  WHERE work_order_id = '$work_order_id' AND end_product_id='$end_product_id' AND process_id='$process_id' AND REPLACE(`stage`, ' ', '')= '$stage' ";

        return $this->db->query($sql);

    }


    function update_end_time($work_order_id,$end_product_id,$process_id,$stage){

        $sql="UPDATE production_set_stages SET end_date_time = now() WHERE work_order_id = '$work_order_id' AND end_product_id='$end_product_id' AND process_id='$process_id' AND REPLACE(`stage`, ' ', '')= '$stage' ";

if( $this->db->query($sql)){

    return 1;

}
else{
    return 0;
}

    }



    function fetch_end_time($work_order_id,$end_product_id,$process_id,$stage){

        $sql="SELECT start_date_time,end_date_time FROM production_set_stages  WHERE work_order_id = '$work_order_id' AND end_product_id='$end_product_id' AND process_id='$process_id' AND REPLACE(`stage`, ' ', '')= '$stage' ";

        return $this->db->query($sql);

    }

    //end dsk

 function get_work_order_start_time($work_order_id,$process_product_id){

        $sql="SELECT start_date_time FROM production_set_stages WHERE work_order_id='$work_order_id'AND end_product_id='$process_product_id' ORDER BY id ASC LIMIT 1 ";

        return $this->db->query($sql);

    }

}
