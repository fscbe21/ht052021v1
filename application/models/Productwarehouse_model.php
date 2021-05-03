<?php

class Productwarehouse_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'product_warehouse';
        parent::__construct($this->table);
    }

    /* AG12032021 */
    function check_product($warehouse_id, $product_id){
        $sql = "SELECT * FROM product_warehouse 
                WHERE warehouse_id = $warehouse_id 
                AND 
                product_id = $product_id";

        return $this->db->query($sql);
    }

    /* AG12032021 */
    
    function updatewhdata($warehouse_id, $product_id, $qty, $operation){
       $sql = "UPDATE product_warehouse SET ";
       
       $product_qty = $this->Productwarehouse_model->checkwhqty($warehouse_id, $product_id);

       if($product_qty > 0){
           if($product_qty > $qty){
                if($operation == 1){
                    $sql .= " qty = (qty + $qty)";
                }else{
                    $sql .= " qty = (qty - $qty)";
                }
           }else{
                if($operation == 1){
                    $sql .= " qty = (qty + $qty)"; //AG2303Q
                }else{
                    $sql .= " qty = 0";
                }
           }
       }else{
            if($operation == 1){
                $sql .= " qty = $qty";
            }else{
                $sql .= " qty = 0";
            }
       }

       $sql .= " WHERE (warehouse_id = $warehouse_id) AND (product_id = $product_id)";

       return $this->db->query($sql);
    }

    /* AG12032021 */
    function checkwhqty($warehouse_id, $product_id){
        $sql = "SELECT * FROM product_warehouse WHERE warehouse_id = $warehouse_id AND product_id = $product_id";

        $sqldata = array();
        $sqldata =  $this->db->query($sql)->result();

        $product_qty = 0;

        if(count($sqldata) > 0){
            foreach($sqldata as $data){
                $product_qty = $data->qty;
            }
        }else{                                          //AG2403
            $data = array();                            //AG2403
            $data['warehouse_id'] = $warehouse_id;      //AG2403
            $data['product_id']   = $product_id;        //AG2403
            $data['qty']          = 0;                  //AG2403
            $this->Productwarehouse_model->save($data); //AG2403
        }                                               //AG2403
        
        return $product_qty;
    }

    //darini 15-3
    function updateqty($warehouse_id, $product_id, $qty){
        $sql = "UPDATE `product_warehouse` SET `qty`= $qty  WHERE warehouse_id = $warehouse_id AND product_id = $product_id";
        return $this->db->query($sql);
       // return $warehouse_id;
    }
    //darini 16-3
    function updateqtyps($warehouse_id, $product_id, $qty){
        $sql = "UPDATE `product_warehouse` SET `qty`=(qty + $qty)  WHERE warehouse_id = $warehouse_id AND product_id = $product_id";
        return $this->db->query($sql);
    // return $warehouse_id;
    }

    /* AG1803 */
    function get_details($options = array()) {
        $where = "id != 0";

        $product_id = get_array_value($options, "product_id");
        if ($product_id) {
            $where .= " AND product_id=$product_id ";
        }

        //AG2603
        $warehouse_id = get_array_value($options, "warehouse_id");
        if ($warehouse_id) {
            $where .= " AND warehouse_id=$warehouse_id ";
        }

        $sql = "SELECT * FROM product_warehouse WHERE $where";

        return $this->db->query($sql);
    }

    //darini 20-3
    function updateqtyminus($warehouse_id, $product_id, $qty){
        $sql = "UPDATE `product_warehouse` SET `qty`=(qty - $qty)  WHERE warehouse_id = $warehouse_id AND product_id = $product_id";
        return $this->db->query($sql);
    // return $warehouse_id;
    }
}
