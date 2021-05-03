<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expenses_approval extends MY_Controller {

    function __construct() {

        parent::__construct();
        
        $this->init_permission_checker("expense");

        $this->access_only_allowed_members();
       
    }

 
    function index() {
        $this->check_module_availability("module_expense");

        $view_data["custom_field_headers"] = $this->Custom_fields_model->get_custom_field_headers_for_table("expenses", $this->login_user->is_admin, $this->login_user->user_type);

        $view_data['categories_dropdown'] = $this->_get_categories_dropdown();
        $view_data['members_dropdown'] = $this->_get_team_members_dropdown();
        $view_data["projects_dropdown"] = $this->_get_projects_dropdown_for_income_and_epxenses("expenses");

        $this->template->rander("expenses_approval/index", $view_data);
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

        $members_dropdown = array(array("id" => "", "text" => "- " . lang("member") . " -"));
        foreach ($team_members as $team_member) {
            $members_dropdown[] = array("id" => $team_member->id, "text" => $team_member->first_name . " " . $team_member->last_name);
        }


        return json_encode($members_dropdown);
    }



     //get the expnese list data
     function list_data($recurring = false) {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $category_id = $this->input->post('category_id');
        $project_id = $this->input->post('project_id');
        $user_id = $this->input->post('user_id');

        
        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("expenses_approval", $this->login_user->is_admin, $this->login_user->user_type);


        $options = array("start_date" => $start_date, "end_date" => $end_date, "category_id" => $category_id, "project_id" => $project_id, "user_id" => $user_id, "custom_fields" => $custom_fields, "recurring" => $recurring);
        $list_data = $this->Expenses_approval_model->get_details($options)->result();

        $result = array();
        foreach ($list_data as $data) {
            $user_name=$this->Users_model->get_one($data->user_id);//darini 18-2
            if ($this->login_user->is_admin) {    
                //$result[] = $this->_make_row($data, $custom_fields);
                if($user_name->role_id==1){
                    $result[] = $this->_make_row($data, $custom_fields);
                }
            }else if($this->login_user->role_id==1){

                if($user_name->role_id==4 || $user_name->role_id==2){
                    $result[] = $this->_make_row($data, $custom_fields);
                }
            }else if($this->login_user->role_id==2){
                if($user_name->role_id==3){
                    $result[] = $this->_make_row($data, $custom_fields);
                }
            }//end            
        }
        echo json_encode(array("data" => $result));
    }

    
    //prepare a row of expnese list
    private function _make_row($data, $custom_fields) {


        $user_name=$this->Users_model->get_one($data->user_id);//darini 18-2

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


            $data->title,
            $data->category_title,
            $data->from_km,
            $data->to_km,
            $data->amount_approval,//darini18-2
            $data->other_expense,
            $data->expense_date,
            $user_name->first_name,//darini18-2
            $data->status

        );

        foreach ($custom_fields as $field) {
            $cf_id = "cfv_" . $field->id;
            $row_data[] = $this->load->view("custom_fields/output_" . $field->field_type, array("value" => $data->$cf_id), true);
        }
        if($data->status!="Approved"){
         $row_data[] = modal_anchor(get_uri("expenses_approval/modal_form"), "<i class='fa fa-check'></i>", array("class" => "edit", "title" => "Approve", "data-post-id" => $data->expense_id,"data-post-apid"=>$data->id));//darini 18-2
        }else{
            $row_data[] =" ";
        }

        return $row_data;
    }


    //load the add/edit expense form
    function modal_form() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $client_id = $this->input->post('client_id');
        $approval_id=$this->input->post('apid');//darini 18-2

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
        $view_data['approval_id']=$approval_id;//darini 18-2

        $view_data["custom_fields"] = $this->Custom_fields_model->get_combined_details("expenses", $view_data['model_info']->id, $this->login_user->is_admin, $this->login_user->user_type)->result();
        $this->load->view('expenses_approval/modal_form', $view_data);
    }

    private function can_access_clients() {
        $permissions = $this->login_user->permissions;

        if (get_array_value($permissions, "client")) {
            return true;
        } else {
            return false;
        }
    }

    

}

