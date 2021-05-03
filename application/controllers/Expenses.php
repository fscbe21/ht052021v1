<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expenses extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->init_permission_checker("expense");

        $this->access_only_allowed_members();
    }
    
    //load the expenses list view.
    function index() {
        $this->check_module_availability("module_expense");

        $view_data["custom_field_headers"] = $this->Custom_fields_model->get_custom_field_headers_for_table("expenses", $this->login_user->is_admin, $this->login_user->user_type);

        $view_data['categories_dropdown'] = $this->_get_categories_dropdown_n();
        $view_data['members_dropdown'] = $this->_get_team_members_dropdown();
        $view_data["projects_dropdown"] = $this->_get_projects_dropdown_for_income_and_epxenses("expenses");

        $this->template->rander("expenses/index", $view_data);
    }

    public function _get_categories_dropdown_n(){
        $data = array();
        $data = [
            ["id"=>"", "text" => "- Expense Category -"],
            ["id"=>"petty_cash", "text" => "Petty Cash"],
            ["id"=>"payroll", "text" => "Payroll"],
            ["id"=>"allowance", "text" => "Allowance"]
        ];
            return json_encode($data);
    }

    //get categories dropdown
    private function _get_categories_dropdown() {
        $categories = $this->Expense_categories_model->get_all_where(array("deleted" => 0), 0, 0, "title")->result();

        $categories_dropdown = array(array("id" => "", "text" => "- " . lang("category") . " -"));
        foreach ($categories as $category) {
            $categories_dropdown[] = array("id" => $category->id, "text" => $category->title);
        }

        return json_encode($categories_dropdown);
    }

    //get team members dropdown
    private function _get_team_members_dropdown() {
        $team_members = $this->Users_model->get_all_where(array("deleted" => 0, "user_type" => "staff"), 0, 0, "first_name")->result();
        if ($this->login_user->is_admin) {   //darini 18-2       
             $members_dropdown = array(array("id" => "", "text" => "- " . lang("member") . " -"));
             foreach ($team_members as $team_member) {            
                $members_dropdown[] = array("id" => $team_member->id, "text" => $team_member->first_name . " " . $team_member->last_name);           
            }
        }else{
            $members_dropdown = array(array("id" =>$this->login_user->id, "text" =>$this->login_user->first_name." ".$this->login_user->last_name));
        }        //end
        return json_encode($members_dropdown);
    }

    //load the expenses list yearly view
    function yearly() {
        $this->load->view("expenses/yearly_expenses");
    }

    //load custom expenses list
    function custom() {
        $this->load->view("expenses/custom_expenses");
    }

    //load the recurring view of expense list 
    function recurring() {
        $this->load->view("expenses/recurring_expenses_list");
    }

    //load the add/edit expense form
    function modal_form() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $client_id = $this->input->post('client_id');

        $model_info = $this->Expenses_model->get_one($this->input->post('id'));
        $view_data['categories_dropdown'] = $this->Expense_categories_model->get_dropdown_list(array("title"));

        $team_members = $this->Users_model->get_all_where(array("deleted" => 0, "user_type" => "staff"))->result();
        $members_dropdown = array();

        foreach ($team_members as $team_member) {
            $members_dropdown[$team_member->id] = $team_member->first_name . " " . $team_member->last_name;
        }

        $view_data['members_dropdown'] = array("0" => "-") + $members_dropdown;
        $view_data['clients_dropdown'] = array("" => "-") + $this->Clients_model->get_dropdown_list(array("company_name"), "id", array("is_lead" => 0));
        $view_data['projects_dropdown'] = array("0" => "-") + $this->Projects_model->get_dropdown_list(array("title"));
        $view_data['taxes_dropdown'] = array("" => "-") + $this->Taxes_model->get_dropdown_list(array("title"));

        $model_info->project_id = $model_info->project_id ? $model_info->project_id : $this->input->post('project_id');
        $model_info->user_id = $model_info->user_id ? $model_info->user_id : $this->input->post('user_id');

        $view_data['model_info'] = $model_info;
        $view_data['client_id'] = $client_id;

        $view_data['can_access_expenses'] = $this->can_access_expenses();
        $view_data['can_access_clients'] = $this->can_access_clients();

        $view_data["custom_fields"] = $this->Custom_fields_model->get_combined_details("expenses", $view_data['model_info']->id, $this->login_user->is_admin, $this->login_user->user_type)->result();
        $this->load->view('expenses/modal_form', $view_data);
    }

    function modal_form_new() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $view_data['employee_list'] = $this->Users_model->get_all_where(array("deleted" => 0, "user_type" => "staff"))->result();
        $view_data['account_list'] = $this->AccountingModel->get_account_list();
        $view_data['payment_methods'] = $this->Payment_methods_model->get_details()->result();
        $view_data['model_info'] = $this->Expenses_model->get_one($this->input->post('id'));

        $this->load->view('expenses/modal_form_new', $view_data);
    }

    function save_new(){
        $id = $this->input->post('id');
        $data = array();
        $data['expense_date']   = $this->input->post('expense_date');
        $data['time']           = $this->input->post('expense_time');
        $data['expense_category'] = $this->input->post('expense_category');
        $data['expense_name']   = $this->input->post('expense_name');
        $data['employee_id']    = $this->input->post('employee_id');
        $data['account_id']     = $this->input->post('account_id');
        $data['amount']         = $this->input->post('amount');
        $data['payment_method'] = $this->input->post('payment_method');
        $data['notes']          = $this->input->post('notes');
        $data['user_id']        = $this->input->post('employee_id');
        
        if($id){
            $save_id = $this->Expenses_model->save($data, $id);
            $save_id = $id;
        }else{
            $save_id = $this->Expenses_model->save($data);
        }
        
        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }

    }

    //save an expense
    function save() {
        validate_submitted_data(array(
            "id" => "numeric",
            "expense_date" => "required",
            "category_id" => "required",
            "amount" => "required"
        ));

        $id = $this->input->post('id');
        $apid=$this->input->post('apid');//darini 18-2
        $status=$this->input->post('status');
        if( isset($status ) ){
            $status=$status;
        }else{
            $status="Pending";
        }
        //darini 18-2
        if($id){
            $amount=$this->input->post('amount');
        }else{
            $amount=0;
        }//end
        $target_path = get_setting("timeline_file_path");
        $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "expense");
        $new_files = unserialize($files_data);

        $recurring = $this->input->post('recurring') ? 1 : 0;
        $expense_date = $this->input->post('expense_date');
        $repeat_every = $this->input->post('repeat_every');
        $repeat_type = $this->input->post('repeat_type');
        $no_of_cycles = $this->input->post('no_of_cycles');

        $data = array(
            "expense_date" => $expense_date,
            "title" => $this->input->post('title'),
            "description" => $this->input->post('description'),
            "category_id" => $this->input->post('category_id'),
            "amount" =>unformat_currency($amount) ,//darini 18-2
            "client_id" => $this->input->post('expense_client_id')? $this->input->post('expense_client_id'): 0,
            "project_id" => $this->input->post('expense_project_id'),
            "user_id" => $this->input->post('expense_user_id'),
            "tax_id" => $this->input->post('tax_id') ? $this->input->post('tax_id') : 0,
            "tax_id2" => $this->input->post('tax_id2') ? $this->input->post('tax_id2') : 0,
            "recurring" => $recurring,
            "repeat_every" => $repeat_every ? $repeat_every : 0,
            "repeat_type" => $repeat_type ? $repeat_type : NULL,
            "no_of_cycles" => $no_of_cycles ? $no_of_cycles : 0,
            "from_km" => $this->input->post('from_km'),
            "to_km" => $this->input->post('to_km'),
            "time" => $this->input->post('time'),
            "other_expense" => $this->input->post('other_expense'),
            "vehicle_type" => $this->input->post('vehicle_type'),
            "vehicle_no" => $this->input->post('vehicle_no'),
            "amount_approval" => unformat_currency($this->input->post('amount')),//darini 18-2
            "status"=>$status//darini 18-2
        );

        $expense_info = $this->Expenses_model->get_one($id);

        //is editing? update the files if required
        if ($id) {
            $timeline_file_path = get_setting("timeline_file_path");
            $new_files = update_saved_files($timeline_file_path, $expense_info->files, $new_files);
        }

        $data["files"] = serialize($new_files);

        if ($recurring) {
            //set next recurring date for recurring expenses

            if ($id) {
                //update
                if ($this->input->post('next_recurring_date')) { //submitted any recurring date? set it.
                    $data['next_recurring_date'] = $this->input->post('next_recurring_date');
                } else {
                    //re-calculate the next recurring date, if any recurring fields has changed.
                    if ($expense_info->recurring != $data['recurring'] || $expense_info->repeat_every != $data['repeat_every'] || $expense_info->repeat_type != $data['repeat_type'] || $expense_info->expense_date != $data['expense_date']) {
                        $data['next_recurring_date'] = add_period_to_date($expense_date, $repeat_every, $repeat_type);
                    }
                }
            } else {
                //insert new
                $data['next_recurring_date'] = add_period_to_date($expense_date, $repeat_every, $repeat_type);
            }


            //recurring date must have to set a future date
            if (get_array_value($data, "next_recurring_date") && get_today_date() >= $data['next_recurring_date']) {
                echo json_encode(array("success" => false, 'message' => lang('past_recurring_date_error_message_title'), 'next_recurring_date_error' => lang('past_recurring_date_error_message'), "next_recurring_date_value" => $data['next_recurring_date']));
                return false;
            }
        }

        $save_id = $this->Expenses_model->save($data, $id);
        if ($save_id) {
            save_custom_fields("expenses", $save_id, $this->login_user->is_admin, $this->login_user->user_type);

            $data['expense_id']=$save_id;
            $save_id_approval = $this->Expenses_approval_model->save($data, $apid);//darini 18-2

            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => lang('record_saved')));



        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
    }


    //delete/undo an expense
    function delete() {
        validate_submitted_data(array(
            "id" => "required|numeric"
        ));

        $id = $this->input->post('id');
        $expense_info = $this->Expenses_model->get_one($id);


        if ($this->Expenses_model->delete($id)) {
            //delete the files
            $file_path = get_setting("timeline_file_path");
            if ($expense_info->files) {
                $files = unserialize($expense_info->files);

                foreach ($files as $file) {
                    delete_app_files($file_path, array($file));
                }
            }

            echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }
    }

    //get the expnese list data
    function list_data_old($recurring = false) {

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $category_id = $this->input->post('category_id');
        $project_id = $this->input->post('project_id');
        if ($this->login_user->is_admin) {  //darini 
            $user_id = $this->input->post('user_id');
        }else{
            $user_id =$this->login_user->id;
        }            //end

        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("expenses", $this->login_user->is_admin, $this->login_user->user_type);

        $options = array("start_date" => $start_date, "end_date" => $end_date, "category_id" => $category_id, "project_id" => $project_id, "user_id" => $user_id, "custom_fields" => $custom_fields, "recurring" => $recurring);
        $list_data = $this->Expenses_model->get_details($options)->result();

        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row_old($data, $custom_fields);
        }
        
        echo json_encode(array("data" => $result));

    }

    //get a row of expnese list
    private function _row_data($id) {
        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("expenses", $this->login_user->is_admin, $this->login_user->user_type);
        $options = array("id" => $id, "custom_fields" => $custom_fields);
        $data = $this->Expenses_model->get_details($options)->row();
        return $this->_make_row_old($data, $custom_fields);
    }

    //prepare a row of expnese list
    private function _make_row_old($data, $custom_fields) {
        $user_name=$this->Users_model->get_one($data->user_id);//darini 18-2

        $categorydata = $this->Expense_categories_model->get_one($data->category_id);

        $description = $data->description;
        if ($data->linked_client_name) {
            if ($description) {
                $description .= "<br />";
            }
            $description .= lang("client") . ": " . $data->linked_client_name;
        }

        if ($data->project_title) {
            if ($description) {
                $description .= "<br /> ";
            }
            $description .= lang("project") . ": " . $data->project_title;
        }

        if ($data->linked_user_name) {
            if ($description) {
                $description .= "<br /> ";
            }
            $description .= lang("team_member") . ": " . $data->linked_user_name;
        }

        if ($data->recurring) {
            //show recurring information
            $recurring_stopped = false;
            $recurring_cycle_class = "";
            if ($data->no_of_cycles_completed > 0 && $data->no_of_cycles_completed == $data->no_of_cycles) {
                $recurring_cycle_class = "text-danger";
                $recurring_stopped = true;
            }

            $cycles = $data->no_of_cycles_completed . "/" . $data->no_of_cycles;
            if (!$data->no_of_cycles) { //if not no of cycles, so it's infinity
                $cycles = $data->no_of_cycles_completed . "/&#8734;";
            }

            if ($description) {
                $description .= "<br /> ";
            }

            $description .= lang("repeat_every") . ": " . $data->repeat_every . " " . lang("interval_" . $data->repeat_type);
            $description .= "<br /> ";
            $description .= "<span class='$recurring_cycle_class'>" . lang("cycles") . ": " . $cycles . "</span>";

            if (!$recurring_stopped && (int) $data->next_recurring_date) {
                $description .= "<br /> ";
                $description .= lang("next_recurring_date") . ": " . format_to_date($data->next_recurring_date, false);
            }
        }

        if ($data->recurring_expense_id) {
            if ($description) {
                $description .= "<br /> ";
            }
            $description .= modal_anchor(get_uri("expenses/expense_details"), lang("original_expense"), array("title" => lang("expense_details"), "data-post-id" => $data->recurring_expense_id));
        }

        $files_link = "";
        if ($data->files) {
            $files = unserialize($data->files);
            if (count($files)) {
                foreach ($files as $key => $value) {
                    $file_name = get_array_value($value, "file_name");
                    $link = " fa fa-" . get_file_icon(strtolower(pathinfo($file_name, PATHINFO_EXTENSION)));
                    $files_link .= js_anchor(" ", array('title' => "", "data-toggle" => "app-modal", "data-sidebar" => "0", "class" => "pull-left font-22 mr10 $link", "title" => remove_file_prefix($file_name), "data-url" => get_uri("expenses/file_preview/" . $data->id . "/" . $key)));
                }
            }
        }

        $tax = 0;
        $tax2 = 0;
        if ($data->tax_percentage) {
            $tax = $data->amount * ($data->tax_percentage / 100);
        }
        if ($data->tax_percentage2) {
            $tax2 = $data->amount * ($data->tax_percentage2 / 100);
        }

        $row_data = array(
            // $data->expense_date,
            // modal_anchor(get_uri("expenses/expense_details"), format_to_date($data->expense_date, false), array("title" => lang("expense_details"), "data-post-id" => $data->id)),
            // $data->category_title,
            // $data->title,
            // $description,
            // $files_link,
            // to_currency($data->amount),
            // to_currency($tax),
            // to_currency($tax2),
            // to_currency($data->amount + $tax + $tax2)
            $data->expense_date,
            $data->title,
            $categorydata->title,
            $data->from_km,
            $data->to_km,
            $data->to_km - $data->from_km,
            $data->amount_approval,//darini 18-2
            $data->other_expense,
            "",//darini18-2
            $data->status

        );

        foreach ($custom_fields as $field) {
            $cf_id = "cfv_" . $field->id;
            $row_data[] = $this->load->view("custom_fields/output_" . $field->field_type, array("value" => $data->$cf_id), true);
        }

        $row_data[] = modal_anchor(get_uri("expenses/modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => lang('edit_expense'), "data-post-id" => $data->id))
                . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('delete_expense'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("expenses/delete"), "data-action" => "delete-confirmation"));

        return $row_data;
    }

    function file_preview($id = "", $key = "") {
        if ($id) {
            $expense_info = $this->Expenses_model->get_one($id);
            $files = unserialize($expense_info->files);
            $file = get_array_value($files, $key);

            $file_name = get_array_value($file, "file_name");
            $file_id = get_array_value($file, "file_id");
            $service_type = get_array_value($file, "service_type");

            $view_data["file_url"] = get_source_url_of_file($file, get_setting("timeline_file_path"));
            $view_data["is_image_file"] = is_image_file($file_name);
            $view_data["is_google_preview_available"] = is_google_preview_available($file_name);
            $view_data["is_viewable_video_file"] = is_viewable_video_file($file_name);
            $view_data["is_google_drive_file"] = ($file_id && $service_type == "google") ? true : false;

            $this->load->view("expenses/file_preview", $view_data);
        } else {
            show_404();
        }
    }

    /* upload a file */

    function upload_file() {
        upload_file_to_temp();
    }

    /* check valid file for ticket */

    function validate_expense_file() {
        return validate_post_file($this->input->post("file_name"));
    }

    //load the expenses yearly chart view
    function yearly_chart() {
        $this->load->view("expenses/yearly_chart");
    }

    function yearly_chart_data() {

        $months = array("january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december");
        $result = array();

        $year = $this->input->post("year");
        if ($year) {
            $expenses = $this->Expenses_model->get_yearly_expenses_chart($year);
            $values = array();
            foreach ($expenses as $value) {
                $values[$value->month - 1] = $value->total; //in array the month january(1) = index(0)
            }

            foreach ($months as $key => $month) {
                $value = get_array_value($values, $key);
                $result[] = array(lang("short_" . $month), $value ? $value : 0);
            }

            echo json_encode(array("data" => $result));
        }
    }

    function income_vs_expenses() {
        $view_data["projects_dropdown"] = $this->_get_projects_dropdown_for_income_and_epxenses();
        $this->template->rander("expenses/income_vs_expenses_chart", $view_data);
    }

    function income_vs_expenses_chart_data() {

        $year = $this->input->post("year");
        $project_id = $this->input->post("project_id");

        if ($year) {
            $expenses_data = $this->Expenses_model->get_yearly_expenses_chart($year, $project_id);
            $payments_data = $this->Invoice_payments_model->get_yearly_payments_chart($year, "", $project_id);

            $payments = array();
            $payments_array = array();

            $expenses = array();
            $expenses_array = array();

            for ($i = 1; $i <= 12; $i++) {
                $payments[$i] = 0;
                $expenses[$i] = 0;
            }

            foreach ($payments_data as $payment) {
                $payments[$payment->month] = $payment->total;
            }
            foreach ($expenses_data as $expense) {
                $expenses[$expense->month] = $expense->total;
            }

            foreach ($payments as $key => $payment) {
                $payments_array[] = array($key, $payment);
            }

            foreach ($expenses as $key => $expense) {
                $expenses_array[] = array($key, $expense);
            }

            echo json_encode(array("income" => $payments_array, "expenses" => $expenses_array));
        }
    }

    function income_vs_expenses_summary() {
        $view_data["projects_dropdown"] = $this->_get_projects_dropdown_for_income_and_epxenses();
        $this->load->view("expenses/income_vs_expenses_summary", $view_data);
    }

    function income_vs_expenses_summary_list_data() {

        $year = explode("-", $this->input->post("start_date"));
        $project_id = $this->input->post("project_id");

        if ($year) {
            $expenses_data = $this->Expenses_model->get_yearly_expenses_chart($year[0], $project_id);
            $payments_data = $this->Invoice_payments_model->get_yearly_payments_chart($year[0], "", $project_id);

            $payments = array();
            $expenses = array();

            for ($i = 1; $i <= 12; $i++) {
                $payments[$i] = 0;
                $expenses[$i] = 0;
            }

            foreach ($payments_data as $payment) {
                $payments[$payment->month] = $payment->total;
            }
            foreach ($expenses_data as $expense) {
                $expenses[$expense->month] = $expense->total;
            }

            //get the list of summary
            $result = array();
            for ($i = 1; $i <= 12; $i++) {
                $result[] = $this->_row_data_of_summary($i, $payments[$i], $expenses[$i]);
            }

            echo json_encode(array("data" => $result));
        }
    }

    //get the row of summary
    private function _row_data_of_summary($month_index, $payments, $expenses) {
        //get the month name
        $month_array = array(" ", "january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december");

        $month = get_array_value($month_array, $month_index);

        $month_name = lang($month);
        $profit = $payments - $expenses;

        return array(
            $month_index,
            $month_name,
            to_currency($payments),
            to_currency($expenses),
            to_currency($profit)
        );
    }

    /* list of expense of a specific client, prepared for datatable  */

    function expense_list_data_of_client($client_id) {
        $this->access_only_team_members();

        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("expenses", $this->login_user->is_admin, $this->login_user->user_type);

        $options = array("client_id" => $client_id);

        $list_data = $this->Expenses_model->get_details($options)->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $custom_fields);
        }
        echo json_encode(array("data" => $result));
    }

    private function can_access_clients() {
        $permissions = $this->login_user->permissions;

        if (get_array_value($permissions, "client")) {
            return true;
        } else {
            return false;
        }
    }

    function expense_details() {
        validate_submitted_data(array(
            "id" => "required|numeric"
        ));

        $expense_id = $this->input->post('id');
        $options = array("id" => $expense_id);
        $info = $this->Expenses_model->get_details($options)->row();
        if (!$info) {
            show_404();
        }

        $view_data["expense_info"] = $info;
        $view_data['custom_fields_list'] = $this->Custom_fields_model->get_combined_details("expenses", $expense_id, $this->login_user->is_admin, $this->login_user->user_type)->result();

        $this->load->view("expenses/expense_details", $view_data);
    }

    function petrol_allowance(){
        $this->template->rander("expenses/petrol/petrol_allowance_list");
    }

    function modal_form_petrol(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $options = array();
        $options['user_type'] = 'staff';
        $view_data['employee_list']=$this->Users_model->get_details($options)->result();
                
        $this->load->view('expenses/petrol/modal_form', $view_data); 
    }

    function modal_form_petrol_update($id){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $options = array();
        $options['user_type'] = 'staff';
        $view_data['employee_list']=$this->Users_model->get_details($options)->result();
        if($id) 
        {
            $petrol_data = array();
            $petrol_data = $this->Petrol_payments_model->get_one($id);
            $view_data['employee_id'] = $petrol_data->user_id;
            $view_data['petrol_amount'] = $petrol_data->amount;
            $view_data['id'] = $petrol_data->id;
        }
        
        $this->load->view('expenses/petrol/modal_form', $view_data); 
    }

    function petrol_payments() {
        $options = array();
        $options['order_by'] = 'DESC';
        if(! $this->login_user->is_admin){
            $options['user_id'] = $this->login_user->id;
        }
        $list_data = $this->Petrol_payments_model->get_details($options)->result();
        $result = array();
        $sl = 1;
        foreach ($list_data as $data) {
            $result[] = $this->petrol_make_row($data, $sl++);
        }
    
        echo json_encode(array("data" => $result));
    }
    
    function petrol_make_row($data, $sl) {

        $employee    =  $this->Users_model->get_one($data->user_id);
        $created_by  =  $this->Users_model->get_one($data->created_by);
        $empname     = $employee->first_name.' '.$employee->last_name;
        $creator     = $created_by->firstname.' '.$created_by->last_name;
        $row_data    = array( 
            $sl,
            $empname,
            $data->amount,
            $creator,
            $data->created_at
        );

        if($this->login_user->is_admin){
            $row_data[] = modal_anchor(get_uri("expenses/modal_form_petrol_update/".$data->id), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Petrol Payment", "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => 'Delete Petrol Payment', "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("expenses/delete_petrol_payment/".$data->id), "data-action" => "delete-confirmation"));
        }
        else{
            $row_data[] = '';
        }
        

        return $row_data;
    }

    function save_petrol_allowance(){
        $id = $this->input->post('id');
        $user_id=$this->input->post('user_id');
        $petrol_amount=$this->input->post('petrol_amount');

        $data = array();
        $data['user_id']        = $user_id;
        $data['amount']         = $petrol_amount;

        if(! $id){
            $data['created_at'] = get_my_local_time();
            $data['created_by'] =  $this->login_user->id;
            $save_id = $this->Petrol_payments_model->save($data);
        }else{
            $save_id = $this->Petrol_payments_model->save($data, $id);
        }

        if ($save_id) {
            echo json_encode(array("success" => true, 'id' => $save_id, 'view' => $this->input->post('view'), 'message' => lang('record_saved')));
        }else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
    }

    function delete_petrol_payment($id){

        if ($this->Petrol_payments_model->delete($id)) {
            echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
        }
    }

    function petrol_payments_in_hand(){
        $options = array();
        $result = array();
        $sl = 1;

        if(! $this->login_user->is_admin){
            $user_id = $this->login_user->id;
            $employee_list = $this->Users_model->getuserdetail($user_id);
        }else{
            $options['user_type'] = 'staff';
            $employee_list=$this->Users_model->get_details($options)->result();
        }

        foreach ($employee_list as $data) {
            $result[] = $this->petrol_make_row_in_hand($data, $sl++);
        }

        $resultt = array();

        for($i=0; $i<count($result); $i++){
            if($result[$i][2] != 0){
                $resultt[]= $result[$i];
            }
        }

        $sno = 1;
        for($j=0;$j<count($resultt); $j++){
            $resultt[$j][0] = $sno;
            $sno += 1;
        }

        echo json_encode(array("data" => $resultt));
    }

    function petrol_make_row_in_hand($data, $sl){
        $options2 = array();
        $options2['user_id'] = $data->id;
        $issued = array();
        $expenses = array();
        $issued   = $this->Petrol_payments_model->get_details($options2)->result();
        $expenses = $this->Expenses_approval_model->get_expenses_approval_detail($data->id);
        $approved_amount = 0;
        $pending_amount  = 0;
        $total_expense_amount = 0;

        foreach($issued as $is){
            $total_expense_amount += $is->amount;
        }

        foreach($expenses as $ex){
            if($ex->status == "Pending"){
                $pending_amount   += $ex->amount_approval;
            }else{
                $approved_amount  += $ex->amount_approval;
            }
        }

        $empname     = $data->first_name.' '.$data->last_name;
        $row_data    = array( 
            $sl,
            $empname,
            number_format($total_expense_amount, 2),
            number_format($total_expense_amount - $approved_amount, 2)
        );
        
        return $row_data;
    }

    function list_data() {

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $expense_category = $this->input->post('expense_category');

        if ($this->login_user->is_admin) {
            $user_id = $this->input->post('user_id');
        }else{
            $user_id =$this->login_user->id;
        }

        $options = array("start_date" => $start_date, "end_date" => $end_date, "expense_category" => $expense_category, "user_id" => $user_id,);

        $list_data = $this->Expenses_model->get_details($options)->result();

        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        
        echo json_encode(array("data" => $result));
    }

    private function _make_row($data) {

        if($data->expense_category == "petty_cash"){
            $expense_category = "Petty Cash";
        }else if($data->expense_category == "payroll"){
            $expense_category = "Payroll";
        }else if($data->expense_category == "allowance"){
            $expense_category = "Allowance";
        }else{
            $expense_category = "";
        }

        $account_data = $this->AccountingModel->get_one($data->account_id);
        $account_info = $account_data->name." [ ".$account_data->account_no." ]";

        $payment_method_info = $this->Payment_methods_model->get_one($data->payment_method);
        $payment_info = $payment_method_info->title;


        $row_data = array();
        $row_data[] = $data->expense_date;
        $row_data[] = $expense_category;
        $row_data[] = $data->expense_name;
        $row_data[] = $account_info;
        $row_data[] = $data->amount;
        $row_data[] = $payment_info;
        $row_data[] = $data->notes;

        if($this->login_user->is_admin){
            $row_data[] = modal_anchor(get_uri("expenses/modal_form_new/".$data->id), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit Expense", "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => 'Delete Expense', "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("expenses/delete_perol_payment/".$data->id), "data-action" => "delete-confirmation"));
        }
        else{
            $row_data[] = '';
        }

        return $row_data;
    }


}
