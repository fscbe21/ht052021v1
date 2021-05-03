<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounting extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->init_permission_checker("message_permission");
    }
    function index(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";        
        $this->template->rander("accounting/account_list",$view_data);
    }
    function money_transfer(){
       $this->template->rander("accounting/money_transfer");
    }
    function balance_sheet(){
        $this->template->rander("accounting/balance_sheet");
     }


     function statement_model(){
     $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
     
       $view_data['accounts']=$this->AccountingModel->get_account_list();
        $this->template->rander('accounting/account_statement_model_form', $view_data);

       
     }
 
     function account_statement(){
        $this->template->rander("accounting/balance_sheet");
     }
    function delete_account(){
        validate_submitted_data(array(
            "id" => "required|numeric"
        ));
        $id = $this->input->post('id');
        $details=array(
                       
            "is_active"=>0
        );
        
         $save_id=$this->AccountingModel->save($details,$id);
     
         if ($save_id) {           
            echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }                  
    }
    function delete_moneytransfer(){
        validate_submitted_data(array(
            "id" => "required|numeric"
        ));
       
        $id = $this->input->post('id');
      

        $save_id=$this->MoneyTransferModel->deleteone($id);
     
         if ($save_id) {           
            echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }  
                    
       }
    

    function list_data_moneytransfer(){
        $list_data=$this->MoneyTransferModel->get_money_transfer_list();
        $result = array();
       foreach ($list_data as $data) {
            $result[] = $this->_make_row_money($data);
        }
        echo json_encode(array("data" => $result));
    }

    function list_data_accounting(){
        $list_data = $this->AccountingModel->get_account_list();
        $result = array();
       foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }
    function list_data_balance_sheet(){
        $list_data = $this->AccountingModel->get_account_list();
        $result = array();
       foreach ($list_data as $data) {
            $result[] = $this->_make_row_balancesheet($data);
       }
        echo json_encode(array("data" => $result));
    }

    function _make_row_balancesheet($data){
        
        $sales_total=$this->AccountingModel->payment_statement_sales( $data->id);
        $purchase_total=$this->AccountingModel->payment_statement_purchase( $data->id);
        $sent_money=$this->AccountingModel->money_transfer_statement_from( $data->id);
        $received_money=$this->AccountingModel->money_transfer_statement_to( $data->id);
        $sales_return=$this->AccountingModel->sales_return_payment( $data->id);
        $purchase_return=$this->AccountingModel->purchase_return_payment( $data->id);

        $credit=floatval($sales_total->amount)+floatval($data->initial_balance)+floatval($received_money->amount)+floatval($purchase_return->amount);
        $debit=floatval($purchase_total->amount)+floatval($sent_money->amount)+floatval( $sales_return->amount);
        $balance=$credit-$debit;

        $row_data = array(
            $data->name,
            $data->account_no,
            $credit,
            $debit,
           $balance          
           
        );
       
        return $row_data;
    }
    function _make_row($data){

        
        $row_data = array(
            $data->account_no,
            $data->name	,
            $data->initial_balance,
            " ",
            $data->note,
            modal_anchor(get_uri("accounting/add_account_modal"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => 'Edit Account', "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete Account", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("accounting/delete_account"), "data-action" => "delete-confirmation"))
          
        );
       
        return $row_data;
     }

     function _make_row_money($data){
        $list_from=$this->AccountingModel->get_account_list_one($data->from_account_id);
        $list_to=$this->AccountingModel->get_account_list_one($data->to_account_id);
        $row_data = array(
            $data->created_at,
            $data->reference_no	,
            $list_from[0]->name,
            $list_to[0]->name,
            $data->amount,
            modal_anchor(get_uri("accounting/money_transfer_modal"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => 'Edit Money Transfer', "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => "Delete Money Transfer", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("accounting/delete_moneytransfer"), "data-action" => "delete-confirmation"))
          
        );

        

        return $row_data;
     }
    function add_account_modal(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $id = $this->input->post('id');
        $view_data['info']=$this->AccountingModel->get_one($id);
        $this->load->view('accounting/add_account_modal_form', $view_data);
    }

    function money_transfer_modal(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $id = $this->input->post('id');
        $view_data['accounts']=$this->AccountingModel->get_account_list();
        $view_data['info']=$this->MoneyTransferModel->get_one($id);
        $this->load->view('accounting/money_transfer_model_form', $view_data);
    }

    function save_account(){
        $id=$this->input->post("id");
        
        $details=array(
               "account_no"=>$this->input->post("account_no"),
               "name"=>$this->input->post("name"),
               "initial_balance"=>$this->input->post("initial_balance"),
               "total_balance"=>$this->input->post("initial_balance"),
               "note"=>$this->input->post("note"),               
               "is_active"=>1
           );
            $now = get_current_utc_time();
           if(!$id){
               $details['created_at']=$now ;           
           }
            $details['updated_at']=$now;
            $save_id=$this->AccountingModel->save($details,$id);
        
            if ($save_id) {           
               echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_saved')));
           } else {
               echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
           }                  
    }

    function save_money_transfer(){
        $id=$this->input->post("id");
        $now = get_current_utc_time();
        $details=array(
               "from_account_id"=>$this->input->post("from_account_id"),
               "to_account_id"=>$this->input->post("to_account_id"),
               "amount"=>$this->input->post("amount"),
               'reference_no' => 'mtr-' . $now
           );
           
           if(!$id){
               $details['created_at']=$now ;           
           }
            $details['updated_at']=$now;
            $save_id=$this->MoneyTransferModel->save($details,$id);
        
            if ($save_id) {           
               echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_saved')));
           } else {
               echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
           }               
    }

    //1-4
    function view_statement(){
        $account_id=$this->input->post('account_id');
        $type=$this->input->post('type');
        $from_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
       
        if($type=='2' || $type=='0'){
            $data['sales_total']=$this->AccountingModel->payment_statement_sales_date( $account_id,date('Y-m-d',strtotime($from_date)),date('Y-m-d',strtotime($to_date)));           
            $data['received_money']=$this->AccountingModel->money_transfer_statement_to_date(  $account_id,date('Y-m-d',strtotime($from_date)),date('Y-m-d',strtotime($to_date)));

        }
         if($type=='1' || $type=='0'){
            $data['purchase_total']=$this->AccountingModel->payment_statement_purchase_date($account_id,date('Y-m-d',strtotime($from_date)),date('Y-m-d',strtotime($to_date)));
            $data['sent_money']=$this->AccountingModel->money_transfer_statement_from_date(  $account_id,date('Y-m-d',strtotime($from_date)),date('Y-m-d',strtotime($to_date)));
        }
       
        $data['accdet']=$this->AccountingModel->get_one($account_id);
        
        //echo json_encode($data);
        $this->template->rander("accounting/account_statement",$data);
        
    }




    function sample(){
        $data['sales_total']=$this->AccountingModel->payment_statement_sales_date(1,date('Y-m-d',strtotime("01-04-2021")),date('Y-m-d',strtotime("02-04-2021")));           
        echo json_encode($data);
    }


    

   
}

?>