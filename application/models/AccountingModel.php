

<?php

class AccountingModel extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'accounts';
        parent::__construct($this->table);
    }
    function get_account_list(){
        $sql  = "SELECT * FROM  accounts where is_active=1";
        return $this->db->query($sql)->result();            
      }

      function get_account_list_one($id){
        $sql  = "SELECT * FROM `accounts` WHERE `id` = $id ";
        return $this->db->query($sql)->result();    
      }

        //30-3
     function payment_statement_sales($id){
      $sql1  = "SELECT SUM(`amount`) as amount FROM `payments` WHERE `account_id`=$id AND `sale_id` IS NOT NULL";
      return $this->db->query($sql1)->row();   
     }

     function payment_statement_purchase($id){
        $sql1  = "SELECT SUM(`amount`) as amount FROM `payments` WHERE `account_id`=$id AND `purchase_id` IS NOT NULL";
        return $this->db->query($sql1)->row();   
     }
     function money_transfer_statement_from($id){
      $sql1  = "SELECT SUM(`amount`) as amount FROM `money_transfer` WHERE `from_account_id`= $id";
      return $this->db->query($sql1)->row();   
   }

   function money_transfer_statement_to($id){
    $sql1  = "SELECT SUM(`amount`) as amount FROM `money_transfer` WHERE `to_account_id`= $id";
    return $this->db->query($sql1)->row();   
   }


   function payment_statement_sales_date($id,$fromdate,$todate){
  
      $this->db->select();
      $this->db->from('payments');
      $this->db->where('created_at >=', $fromdate) ;
      $this->db->where('created_at  <=', $todate ) ;
      $this->db->where('account_id',$id);
      $this->db->where('sale_id !=',NULL);
      $re=$this->db->get();
      return $re->result();
     }
  
     function payment_statement_purchase_date($id,$fromdate,$todate){
     
  
        $this->db->select();
        $this->db->from('payments');
        $this->db->where('created_at >=', $fromdate) ;
        $this->db->where('created_at  <=', $todate ) ;
        $this->db->where('account_id',$id);
        $this->db->where('purchase_id !=',NULL);
        $re=$this->db->get();
        return $re->result();
     }
     function money_transfer_statement_from_date($id,$fromdate,$todate){
     
      $this->db->select();
      $this->db->from('money_transfer');
      $this->db->where('created_at >=', $fromdate) ;
      $this->db->where('created_at  <=', $todate ) ;
      $this->db->where('from_account_id',$id);    
      $re=$this->db->get();
      return $re->result();
  
   }
  
   function money_transfer_statement_to_date($id,$fromdate,$todate){
   /* $sql1  = "SELECT * FROM `money_transfer` WHERE `to_account_id`= $id AND `created_at` >= $fromdate AND  `created_at` <= $todate";
    return $this->db->query($sql1)->result();   */
    $this->db->select();
      $this->db->from('money_transfer');
      $this->db->where('created_at >=', $fromdate) ;
      $this->db->where('created_at  <=', $todate ) ;
      $this->db->where('to_account_id',$id);    
      $re=$this->db->get();
      return $re->result();
   }


   function sales_return_payment($id){
      $sql1  = "SELECT SUM(`grand_total`) as amount FROM `returns` WHERE `account_id`=$id ";
      return $this->db->query($sql1)->row();   
   }

 function purchase_return_payment($id){
   $sql1  = "SELECT SUM(`grand_total`) as amount FROM `return_purchases` WHERE `account_id`=$id ";
   return $this->db->query($sql1)->row();   
   
 }

 function sales_return_date($id,$fromdate,$todate){
   $this->db->select();
   $this->db->from('returns');
   $this->db->where('created_at >=', $fromdate) ;
   $this->db->where('created_at  <=', $todate ) ;
   $this->db->where('account_id',$id);    
   $re=$this->db->get();
   return $re->result();
 }


 function purchase_return_date($id,$fromdate,$todate){
   $this->db->select();
   $this->db->from('return_purchases');
   $this->db->where('created_at >=', $fromdate) ;
   $this->db->where('created_at  <=', $todate ) ;
   $this->db->where('account_id',$id);    
   $re=$this->db->get();
   return $re->result();
 }

}
?>