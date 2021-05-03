<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mom extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->init_permission_checker("message_permission");
        //$this->access_only_admin();
    }

    private function is_my_message($message_info) {
        if ($message_info->from_user_id == $this->login_user->id || $message_info->to_user_id == $this->login_user->id) {
            return true;
        }
    }

    private function check_message_user_permission() {
        if (!$this->check_access_on_messages_for_this_user()) {
            redirect("forbidden");
        }
    }

    private function check_validate_sending_message($to_user_id) {
        if (!$this->validate_sending_message($to_user_id)) {
            echo json_encode(array("success" => false, 'message' => lang("message_sending_error_message")));
            exit;
        }
    }

    

    function index() {
        $this->template->rander("mom/index");
    }

   
    /* show new message modal */

    function modal_form($user_id = 0) {
        $this->check_message_user_permission();
        $view_data['users_dropdown'] = array("" => "-");
        $cc_contacts_dropdown = array();

        if ($user_id) {
            $view_data['message_user_info'] = $this->Users_model->get_one($user_id);
        } else {
            $users = $this->Mom_model->get_users_for_messaging($this->get_user_options_for_query())->result();

            foreach ($users as $user) {
                $user_name = $user->first_name . " " . $user->last_name;

                if ($user->user_type === "client" && $user->company_name) { //user is a client contact
                    if ($this->login_user->user_type == "staff") {
                        $user_name .= " - " . lang("client") . ": " . $user->company_name . "";
                    } else {
                        $user_name = lang("contact") . ": " . $user_name;
                    }
                }
                $view_data['users_dropdown'][$user->id] = $user_name;
                $cc_contacts_dropdown[] = array("id" => $user->id, "text" => $user_name);
               
            }
        }
        $view_data['cc_users_dropdown']= $cc_contacts_dropdown;
        $this->load->view('mom/modal_form', $view_data);
    }

    /* show inbox */

    function inbox($auto_select_index = "") {
        $this->check_message_user_permission();
        $this->check_module_availability("module_message");

        $view_data['mode'] = "inbox";
        $view_data['auto_select_index'] = $auto_select_index;
        $this->template->rander("mom/index", $view_data);
    }

    /* show sent items */

    function sent_items($auto_select_index = "") {
        $this->check_message_user_permission();
        $this->check_module_availability("module_message");

        $view_data['mode'] = "sent_items";
        $view_data['auto_select_index'] = $auto_select_index;
        $this->template->rander("mom/index", $view_data);
    }

    private function get_allowed_user_ids() {
        $users = $this->Mom_model->get_users_for_messaging($this->get_user_options_for_query())->result();
        $users = json_decode(json_encode($users), true); //convert to array
        return implode(',', array_column($users, "id"));
    }

    function view($message_id = 0, $mode = "", $reply = 0) {
        $this->check_message_user_permission();

        $message_mode = $mode;
        if ($reply == 1 && $mode == "inbox") {
            $message_mode = "sent_items";
        } else if ($reply == 1 && $mode == "sent_items") {
            $message_mode = "inbox";
        }

        $options = array("id" => $message_id, "user_id" => $this->login_user->id, "mode" => $message_mode);
        $view_data["message_info"] = $this->Mom_model->get_details($options)->row;

        if (!$this->is_my_message($view_data["message_info"])) {
            redirect("forbidden");
        }

        //change message status to read
        $this->Mom_model->set_message_status_as_read($view_data["message_info"]->id, $this->login_user->id);

        $replies_options = array("message_id" => $message_id, "user_id" => $this->login_user->id, "limit" => 4);
        $messages = $this->Mom_model->get_details($replies_options);

        $view_data["replies"] = $messages->result;
        $view_data["found_rows"] = $messages->found_rows;

        $view_data["mode"] = $mode;
        $view_data["is_reply"] = $reply;
        echo json_encode(array("success" => true, "data" => $this->load->view("mom/view", $view_data, true), "message_id" => $message_id));
    }


 

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Mom_model->get_details($options)->row();
        return $this->_make_row_test($data);
    }

    function list_data() {
        $list_data = $this->Purchase_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }

        echo json_encode(array("data" => $result));
    }
    function list_data_test() {
        $list1_data = $this->Mom_model->get_details_test()->result();
        $result = array();
        foreach ($list1_data as $data) {
            $result[] = $this->_make_row_test($data);
        }

        echo json_encode(array("data" => $result));
    }
    private function _make_row_test($data) {
        $person_present = array();
        $person_present = explode(",",$data->to_user_id);
        $person_names = "";
        $delete='<li role="presentation" >' .js_anchor("<i class='fa fa-times fa-fw'></i> Delete", array('title' => "Delete MOM", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("mom/delete"), "data-action" => "delete")). '</li>';

        foreach($person_present as $pp){
            $user_data = array();
            $user_data = $this->Users_model->get_one($pp);

            $person_names .= $user_data->first_name." ".$user_data->last_name.", ";
        }

        $user_data = $this->Users_model->get_one($data->from_user_id);
        //$staff_data = $this->Users_model->get_one($data->to_user_id);
        if(($data->deleted_by_users) == 0){
        return array(
            $data->id,
            $data->title,
            $user_data->first_name." ".$user_data->last_name." ",
            rtrim($person_names, ", "),
            $data->subject,
            $data->start_time,
            $data->end_time,           
            $data->message,
        //     ($data->grand_total - $data->paid_amount),
            
            
        //    //darini 19-3
            ' <span class="dropdown inline-block">
            <button class="btn btn-default dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-cogs"></i>&nbsp;
                <span class="caret"></span>
            </button>
         
            <ul class="dropdown-menu pull-right" role="menu">'  .$delete . '</ul>'  //end
        );
    }}


    private function _make_row($data) {
        $supplier_data = $this->Supplier_model->get_one($data->supplier_id);
        $purchase_status = $this->Purchase_status_model->get_one($data->status);
        $payment_status  = $this->Payment_status_model->get_one($data->payment_status);
         //darini 19-3
         $edit= '<li role="presentation">' .'<a class="edit" href="purchase/edit/'.$data->id.'"><i class="fa fa-pencil"></i>Edit</a>'. '</li>';
         $view='<li role="presentation">' .modal_anchor(get_uri("purchase/modal_form/".$data->id), "<i class='fa fa-eye'></i>View Purchase", array("class" => "edit", "title" => "View purchase detail", "data-post-id" => $data->id)). '</li>';
         $delete='<li role="presentation" style="display:none">' .js_anchor("<i class='fa fa-times fa-fw'></i> Delete", array('title' => "Delete BOM", "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("purchase/delete"), "data-action" => "delete")). '</li>';
         $add_payment='<li role="presentation">' . modal_anchor(get_uri("purchase/add_payment_form/".$data->id), "<i class='fa fa-plus-circle'></i> " . lang('add_payment'), array("title" => lang('add_payment'))) . '</li>';
         $view_payment='<li role="presentation">' . modal_anchor(get_uri("purchase/view_payment_modal_form/".$data->id), "<i class='fa fa-eye'></i> View Payment" , array("title" => "View Payment")) . '</li>';
//end 
        return array(
            $data->created_at,
            $data->reference_no,
            $supplier_data->name.' ( '.$supplier_data->company_name.' )',
            $purchase_status->title,
            $data->grand_total,
            $data->paid_amount,
            ($data->grand_total - $data->paid_amount),
            
            
           //darini 19-3
           ' <span class="dropdown inline-block">
           <button class="btn btn-default dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
               <i class="fa fa-cogs"></i>&nbsp;
               <span class="caret"></span>
           </button>
           
           <ul class="dropdown-menu pull-right" role="menu">' . $edit . $view .$delete .$add_payment. $view_payment. '</ul>'  //end
        );
    }

   

    function search($search_text){
        $data = array();
        $data = $this->Products_model->search($search_text)->result();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

function deletePayment($payment_id){
    $payments_info=$this->Payments->get_one($payment_id);
    $purchase= $this->Purchase_model->get_one( $payments_info->purchase_id);     
    $purchase_data=array();
    $purchase_data['paid_amount']= $purchase->paid_amount-$payments_info->amount;
    $balance= $purchase->grand_total- $purchase_data['paid_amount'];
     if($balance > 0 || $balance < 0){
             $purchase_data['payment_status']=2;
     }else if($balance == 0){
             $purchase_data['payment_status']=4;
     }
   
     $save_id_purchase = $this->Purchase_model->save($purchase_data,$payments_info->purchase_id);

     if($payments_info->paying_method==5){
         $cheque_data=$this->Payment_cheque->getPaymentdetails($payment_id);
         $this->Payment_cheque->deletepaymentCheque($cheque_data[0]->id);

     }
     if($this->Payments->deletepayment($payment_id)){
        echo json_encode(array("success" => true,   'message' => lang('record_deleted')));
         
     } else {
        echo json_encode(array("success" => true,   'message' => lang('record_cannot_be_deleted')));
      
     }



 }
 //end

 function send_message() {

    $this->check_message_user_permission();

    validate_submitted_data(array(
        "message" => "required",
        "to_user_id" => "required"
    ));

    $to_user_id = $this->input->post('to_user_id');
 
        $spilt=explode(",", $to_user_id);

    //$data = array();
    //$data['to_user_id'] = $to_user_id;
    

     foreach($spilt as $user_id){
    //team member can send message to any team member
    //client can send messages to only allowed members

   $this->check_validate_sending_message($user_id);

    $target_path = get_setting("timeline_file_path");
    $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "message");

    
    $message_data = array(
        "from_user_id" => $this->login_user->id,
        "to_user_id" => $user_id,
        "subject" => $this->input->post('subject'),
        "message" => $this->input->post('message'),
        "title" =>$this->input->post('title'),
        "start_time" =>$this->input->post('start_time'),
        "end_time" =>$this->input->post('end_time'),
        "created_at" => get_current_utc_time(),
        "deleted_by_users" => "",
    );
    
 
   
    $message_data = clean_data($message_data);

    $message_data["files"] = $files_data; //don't clean serilized data 


    $save_id = $this->Messages_model->save($message_data);
    //$save_id=$user_id;

 }
 
 $mom_data = array(
    "from_user_id" => $this->input->post('from_user_id'),
    "to_user_id" =>$this->input->post('to_user_id'),
    "subject" => $this->input->post('subject'),
    "message" => $this->input->post('message'),
    "title" =>$this->input->post('title'),
    "start_time" =>$this->input->post('start_time'),
    "end_time" =>$this->input->post('end_time'),
    "created_at" => get_current_utc_time(),
    "deleted_by_users" => "",
);

$save_id = $this->Mom_model->save($mom_data);

    if ($save_id) {
        log_notification("new_message_sent", array("actual_message_id" => $save_id));
        echo json_encode(array("success" => true, 'message' => lang('message_sent'), "id" => $save_id));
        
    } else {
        echo json_encode(array("success" => false, 'message' =>  lang('error_occurred')));
    }
}

function get_times ($default = '19:00', $interval = '+30 minutes') {

    $output = '';

    $current = strtotime('00:00');
    $end = strtotime('23:59');

    while ($current <= $end) {
        $time = date('H:i', $current);
        $sel = ($time == $default) ? ' selected' : '';

        $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) .'</option>';
        $current = strtotime($interval, $current);
    }

    return $output;
}

/* reply to an existing message */

function reply($is_chat = 0) {
    $this->check_message_user_permission();
    $message_id = $this->input->post('message_id');

    validate_submitted_data(array(
        "reply_message" => "required",
        "message_id" => "required|numeric"
    ));


    $message_info = $this->Mom_model->get_one($message_id);

    if (!$this->is_my_message($message_info)) {
        redirect("forbidden");
    }


    if ($message_info->id) {
        //check, where we have to send this message
        $to_user_id = 0;
        if ($message_info->from_user_id === $this->login_user->id) {
            $to_user_id = $message_info->to_user_id;
        } else {
            $to_user_id = $message_info->from_user_id;
        }

        $this->check_validate_sending_message($to_user_id);

        $target_path = get_setting("timeline_file_path");
        $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "message");

        $message = $this->input->post('reply_message');

        $message_data = array(
            "from_user_id" => $this->login_user->id,
            "to_user_id" => $to_user_id,
            "message_id" => $message_id,
            "subject" => "",
            "message" => $message,
            "created_at" => get_current_utc_time(),
            "deleted_by_users" => "",
        );

        $message_data = clean_data($message_data);
        $message_data["files"] = $files_data; //don't clean serilized data


        $save_id = $this->Mom_model->save($message_data);

        if ($save_id) {

            //if chat via pusher is enabled, then send message data to pusher
            if (get_setting('enable_chat_via_pusher') && get_setting("enable_push_notification")) {
                send_message_via_pusher($to_user_id, $message_data, $message_id);
            }

            //we'll not send notification, if the user is online

            if ($this->input->post("is_user_online") !== "1") {
                log_notification("message_reply_sent", array("actual_message_id" => $save_id, "parent_message_id" => $message_id));
            }

            //clear the delete status, if the mail deleted
            $this->Mom_model->clear_deleted_status($message_id);

            if ($is_chat) {
                echo json_encode(array("success" => true, 'data' => $this->_load_messages($message_id, $this->input->post("last_message_id"), 0, true, $to_user_id)));
            } else {
                $options = array("id" => $save_id, "user_id" => $this->login_user->id);
                $view_data['reply_info'] = $this->Mom_model->get_details($options)->row;
                echo json_encode(array("success" => true, 'message' => lang('message_sent'), 'data' => $this->load->view("mom/reply_row", $view_data, true)));
            }

            return;
        }
    }
    echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
}

//load messages right panel when clicking load more button
function view_messages() {

    $this->check_message_user_permission();
    validate_submitted_data(array(
        "message_id" => "required|numeric",
        "last_message_id" => "numeric",
        "top_message_id" => "numeric"
    ));

    $message_id = $this->input->post("message_id");

    $this->_load_more_messages($message_id, $this->input->post("last_message_id"), $this->input->post("top_message_id"));
}

//prepare the chat box messages 
private function _load_more_messages($message_id, $last_message_id, $top_message_id, $load_as_data = false) {

    $replies_options = array("message_id" => $message_id, "last_message_id" => $last_message_id, "top_message_id" => $top_message_id, "user_id" => $this->login_user->id, "limit" => 10);

    $view_data["replies"] = $this->Mom_model->get_details($replies_options)->result;
    $view_data["message_id"] = $message_id;

    $this->Mom_model->set_message_status_as_read($message_id, $this->login_user->id);

    return $this->load->view("mom/reply_rows", $view_data, $load_as_data);
}

/* prepare notifications */

function get_notifications() {
    validate_submitted_data(array(
        "active_message_id" => "numeric"
    ));


    $notifiations = $this->Mom_model->get_notifications($this->login_user->id, $this->login_user->message_checked_at, $this->input->post("active_message_id"));
    $view_data['notifications'] = $notifiations->result();
    echo json_encode(array("success" => true, "active_message_id" => $this->input->post("active_message_id"), 'total_notifications' => $notifiations->num_rows(), 'notification_list' => $this->load->view("mom/notifications", $view_data, true)));
}

function update_notification_checking_status() {
    $now = get_current_utc_time();
    $user_data = array("message_checked_at" => $now);
    $this->Users_model->save($user_data, $this->login_user->id);
}

/* upload a file */

function upload_file() {
    upload_file_to_temp();
}
/* check valid file for message */

function validate_message_file() {
    return validate_post_file($this->input->post("file_name"));
}

/* download files by zip */

function download_message_files($message_id = "") {
    $model_info = $this->Mom_model->get_one($message_id);
    if (!$this->is_my_message($model_info)) {
        redirect("forbidden");
    }

    $files = $model_info->files;


    $timeline_file_path = get_setting("timeline_file_path");
    download_app_files($timeline_file_path, $files);
}

function delete_my_messages($id = 0) {

    if (!$id) {
        exit();
    }

    //delete messages for current user.
    $this->Mom_model->delete_messages_for_user($id, $this->login_user->id);
}

//prepare chat inbox list
function chat_list() {
    $this->check_message_user_permission();

    $view_data['show_users_list'] = false;
    $view_data['show_clients_list'] = false;

    $client_message_users = get_setting("client_message_users");
    if ($this->login_user->user_type === "staff") {
        //user is team member
        $client_message_users_array = explode(",", $client_message_users);
        if (in_array($this->login_user->id, $client_message_users_array)) {
            //user can send message to clients
            $view_data['show_clients_list'] = true;
        }

        if (get_array_value($this->login_user->permissions, "message_permission") !== "no") {
            //user can send message to team members
            $view_data['show_users_list'] = true;
        }
    } else {
        //user is a client contact and can send messages
        if ($client_message_users) {
            $view_data['show_users_list'] = true;
        }

        //user can send message to own client contacts
        if (get_setting("client_message_own_contacts")) {
            $view_data['show_clients_list'] = true;
        }
    }

    $options = array("login_user_id" => $this->login_user->id, "user_ids" => $this->get_allowed_user_ids());

    $view_data['messages'] = $this->Mom_model->get_chat_list($options)->result();

    $this->load->view("mom/chat/tabs", $view_data);
}
function users_list($type) {
    $view_data["users"] = $this->Mom_model->get_users_for_messaging($this->get_user_options_for_query($type))->result();

    $page_type = "";
    if ($type === "staff") {
        $page_type = "team-members-tab";
    } else {
        $page_type = "clients-tab";
    }

    $view_data["page_type"] = $page_type;

    $this->load->view("mom/chat/team_members", $view_data);
}

//load messages in chat view
function view_chat() {

    $this->check_message_user_permission();

    validate_submitted_data(array(
        "message_id" => "required|numeric",
        "last_message_id" => "numeric",
        "top_message_id" => "numeric",
        "another_user_id" => "numeric"
    ));

    $message_id = $this->input->post("message_id");

    $another_user_id = $this->input->post("another_user_id");

    if ($this->input->post("is_first_load") == "1") {
        $view_data["first_message"] = $this->Mom_model->get_details(array("id" => $message_id, "user_id" => $this->login_user->id))->row;
        $this->load->view("mom/chat/message_title", $view_data);
    }

    $this->_load_messages($message_id, $this->input->post("last_message_id"), $this->input->post("top_message_id"), false, $another_user_id);
}

//prepare the chat box messages 
private function _load_messages($message_id, $last_message_id, $top_message_id, $load_as_data = false, $another_user_id = "") {

    $replies_options = array("message_id" => $message_id, "last_message_id" => $last_message_id, "top_message_id" => $top_message_id, "user_id" => $this->login_user->id);

    $view_data["replies"] = $this->Mom_model->get_details($replies_options)->result;
    $view_data["message_id"] = $message_id;

    $this->Mom_model->set_message_status_as_read($message_id, $this->login_user->id);

    $is_online = false;
    if ($another_user_id) {
        $last_online = $this->Users_model->get_one($another_user_id)->last_online;
        if ($last_online) {
            $is_online = is_online_user($last_online);
        }
    }

    $view_data['is_online'] = $is_online;

    return $this->load->view("mom/chat/message_items", $view_data, $load_as_data);
}

function get_active_chat() {

    validate_submitted_data(array(
        "message_id" => "required|numeric"
    ));

    $message_id = $this->input->post("message_id");

    $options = array("id" => $message_id, "user_id" => $this->login_user->id);
    $view_data["message_info"] = $this->Mom_model->get_details($options)->row;

    if (!$this->is_my_message($view_data["message_info"])) {
        redirect("forbidden");
    }

    //$this->Mom_model->set_message_status_as_read($view_data["message_info"]->id, $this->login_user->id);

    $view_data["message_id"] = $message_id;
    $this->load->view("mom/chat/active_chat", $view_data);
}

function get_chatlist_of_user() {

    $this->check_message_user_permission();

    validate_submitted_data(array(
        "user_id" => "required|numeric"
    ));

    $user_id = $this->input->post("user_id");

    $options = array("user_id" => $user_id, "login_user_id" => $this->login_user->id);
    $view_data["messages"] = $this->Mom_model->get_chat_list($options)->result();


    $user_info = $this->Users_model->get_one_where(array("id" => $user_id, "status" => "active", "deleted" => "0"));
    $view_data["user_name"] = $user_info->first_name . " " . $user_info->last_name;

    $view_data["user_id"] = $user_id;
    $view_data["tab_type"] = $this->input->post("tab_type");

    $this->load->view("mom/chat/get_chatlist_of_user", $view_data);
}
function send_typing_indicator_to_pusher() {
        $message_id = $this->input->post("message_id");
        if (!$message_id) {
            show_404();
        }

        $message_info = $this->Mom_model->get_one($message_id);
        if (!$this->is_my_message($message_info)) {
            redirect("forbidden");
        }

        if ($message_info->id) {
            //check, where we have to send this message
            $to_user_id = 0;
            if ($message_info->from_user_id === $this->login_user->id) {
                $to_user_id = $message_info->to_user_id;
            } else {
                $to_user_id = $message_info->from_user_id;
            }

            $this->check_validate_sending_message($to_user_id);

            if (get_setting('enable_chat_via_pusher') && get_setting("enable_push_notification")) {
                send_message_via_pusher($to_user_id, "", $message_id, "typing");
            }
        } else {
            show_404();
        }
    }

 //darini 22-3
 function getprdt($purchase_id){

    $purchaseorder=$this->Purchase_order_model->get_one($purchase_id);
    $view_data['supplier_id']=$purchaseorder->supplier_id;
    $options = array();
    $options['purchase_order_id'] = $purchase_id;
    $product_purchase_data = $this->Purchaseorder_details_model->get_details($options)->result();
    $result=array();
    foreach($product_purchase_data as $prd){
        $prdts=$this->Products_model->get_one($prd->product_id);
        $unit_data    = $this->Unit_model->get_one($prdts->unit_id);
        $unit_name    = $unit_data->name;
       // echo json_encode(  $prd);
        $data=array();
        $data["id"]=$prdts->id;
        $data["name"]=$prdts->name;
        $data["code"]=$prdts->code;
        $data["cost"]=$prd->net_unit_cost; 
        $data["unit"]= $unit_name;
        $data["tax"]=$prd->tax;
        $data["tax_rate"]=$prd->tax_rate;
        $data["discount"]=$prd->discount;
        $data["recieved"]=$prd->recieved;
        $data["qty"]=$prd->qty;
        $data["total"]=$prd->total;
        $data["remaining_qty"]=$prd->remaining_qty;
        $result[]=  $data;
    }
    $view_data['data_array']=$result;
    echo json_encode( $view_data);
   //echo json_encode($product_purchase_data);
 }
 function delete() {
    validate_submitted_data(array(
        "id" => "numeric|required"
    ));

    $id = $this->input->post('id');
    if ($this->input->post('undo')) { //changes 22-3
        if ($this->Mom_model->delete($id, true)) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
        } else {
            echo json_encode(array("success" => false, lang('error_occurred')));
        }
    } else {
        if ($this->Mom_model->delete($id)) {//changes 22-3
            echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }
    }
}
}
