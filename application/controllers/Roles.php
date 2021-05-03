<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class roles extends MY_Controller {

    function __construct() {
        parent::__construct();
      //  $this->access_only_admin();
    }

    //load the role view
    function index() {
        $this->template->rander("roles/index");
    }


    //load the role add/edit modal
    function modal_form() {

        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $view_data['model_info'] = $this->Roles_model->get_one($this->input->post('id'));
        $view_data['roles_dropdown'] = array("" => "-") + $this->Roles_model->get_dropdown_list(array("title"), "id");
        $this->load->view('roles/modal_form', $view_data);
    }

    //get permisissions of a role
    function permissions($role_id) {
        if ($role_id) {
            $view_data['model_info'] = $this->Roles_model->get_one($role_id);

            $view_data['members_and_teams_dropdown'] = json_encode(get_team_members_and_teams_select2_data_list());
            $ticket_types_dropdown = array();
            $ticket_types = $this->Ticket_types_model->get_all_where(array("deleted" => 0))->result();
            foreach ($ticket_types as $type) {
                $ticket_types_dropdown[] = array("id" => $type->id, "text" => $type->title);
            }
            $view_data['ticket_types_dropdown'] = json_encode($ticket_types_dropdown);

            $permissions = unserialize($view_data['model_info']->permissions);

            if (!$permissions) {
                $permissions = array();
            }

            $view_data['leave'] = get_array_value($permissions, "leave");
            $view_data['leave_specific'] = get_array_value($permissions, "leave_specific");
            $view_data['attendance_specific'] = get_array_value($permissions, "attendance_specific");

            $view_data['attendance'] = get_array_value($permissions, "attendance");
            $view_data['invoice'] = get_array_value($permissions, "invoice");
            $view_data['estimate'] = get_array_value($permissions, "estimate");
            $view_data['expense'] = get_array_value($permissions, "expense");
            $view_data['order'] = get_array_value($permissions, "order");
            $view_data['client'] = get_array_value($permissions, "client");
            $view_data['lead'] = get_array_value($permissions, "lead");

            $view_data['ticket'] = get_array_value($permissions, "ticket");
            $view_data['ticket_specific'] = get_array_value($permissions, "ticket_specific");

            $view_data['announcement'] = get_array_value($permissions, "announcement");
            $view_data['help_and_knowledge_base'] = get_array_value($permissions, "help_and_knowledge_base");

            $view_data['can_manage_all_projects'] = get_array_value($permissions, "can_manage_all_projects");
            $view_data['can_create_projects'] = get_array_value($permissions, "can_create_projects");
            $view_data['can_edit_projects'] = get_array_value($permissions, "can_edit_projects");
            $view_data['can_delete_projects'] = get_array_value($permissions, "can_delete_projects");

            $view_data['can_add_remove_project_members'] = get_array_value($permissions, "can_add_remove_project_members");

            $view_data['can_create_tasks'] = get_array_value($permissions, "can_create_tasks");
            $view_data['can_edit_tasks'] = get_array_value($permissions, "can_edit_tasks");
            $view_data['can_delete_tasks'] = get_array_value($permissions, "can_delete_tasks");
            $view_data['can_comment_on_tasks'] = get_array_value($permissions, "can_comment_on_tasks");
            $view_data['show_assigned_tasks_only'] = get_array_value($permissions, "show_assigned_tasks_only");
            $view_data['can_update_only_assigned_tasks_status'] = get_array_value($permissions, "can_update_only_assigned_tasks_status");

            $view_data['can_create_milestones'] = get_array_value($permissions, "can_create_milestones");
            $view_data['can_edit_milestones'] = get_array_value($permissions, "can_edit_milestones");
            $view_data['can_delete_milestones'] = get_array_value($permissions, "can_delete_milestones");

            $view_data['can_delete_files'] = get_array_value($permissions, "can_delete_files");

            $view_data['can_view_team_members_contact_info'] = get_array_value($permissions, "can_view_team_members_contact_info");
            $view_data['can_view_team_members_social_links'] = get_array_value($permissions, "can_view_team_members_social_links");
            $view_data['team_member_update_permission'] = get_array_value($permissions, "team_member_update_permission");
            $view_data['team_member_update_permission_specific'] = get_array_value($permissions, "team_member_update_permission_specific");

            $view_data['timesheet_manage_permission'] = get_array_value($permissions, "timesheet_manage_permission");
            $view_data['timesheet_manage_permission_specific'] = get_array_value($permissions, "timesheet_manage_permission_specific");

            $view_data['disable_event_sharing'] = get_array_value($permissions, "disable_event_sharing");

            $view_data['hide_team_members_list'] = get_array_value($permissions, "hide_team_members_list");

            $view_data['can_delete_leave_application'] = get_array_value($permissions, "can_delete_leave_application");

            $view_data['message_permission'] = get_array_value($permissions, "message_permission");
            $view_data['message_permission_specific'] = get_array_value($permissions, "message_permission_specific");

            $view_data['client_approval'] = get_array_value($permissions, "client_approval");

            $view_data['access_products'] = get_array_value($permissions, "access_products");

            $view_data['add_purchase'] = get_array_value($permissions, "add_purchase");

            $view_data['purchase_list'] = get_array_value($permissions, "purchase_list");

            $view_data['grn_list'] = get_array_value($permissions, "grn_list");
            $view_data['purchase_requisition'] = get_array_value($permissions, "purchase_requisition");
            $view_data['purchase_quotation'] = get_array_value($permissions, "purchase_quotation");

            $view_data['purchase_order_list'] = get_array_value($permissions, "purchase_order_list");

            $view_data['add_purchase_order'] = get_array_value($permissions, "add_purchase_order");

            $view_data['add_sales'] = get_array_value($permissions, "add_sales");

            $view_data['sales_list'] = get_array_value($permissions, "sales_list");

            $view_data['add_transfer'] = get_array_value($permissions, "add_transfer");

            $view_data['transfer_list'] = get_array_value($permissions, "transfer_list");

            $view_data['work_order_list'] = get_array_value($permissions, "work_order_list");

            $view_data['bom_list'] = get_array_value($permissions, "bom_list");

            $view_data['lead_approval'] = get_array_value($permissions, "lead_approval");

            $view_data['warehouse_permission'] = get_array_value($permissions, "warehouse_permission");

            $view_data['account_permission'] = get_array_value($permissions, "account_permission");

            
            
            $view_data['payments_permission'] = get_array_value($permissions, "payments_permission");
            $view_data['petrol_permission'] = get_array_value($permissions, "petrol_permission");
            $view_data['expense_approval'] = get_array_value($permissions, "expense_approval");

            $view_data['hrm_permission']  = get_array_value($permissions, "hrm_permission");
/* AG2103Q */
           $view_data['indent_permission']  = get_array_value($permissions, "indent_permission");
/*R.V_29_03 */
            $view_data['view_production'] = get_array_value($permissions, "view_production");


            $view_data['add_sales_return'] = get_array_value($permissions, "add_sales_return");
            $view_data['sales_return_list'] = get_array_value($permissions, "sales_return_list");
            $view_data['add_purchase_return'] = get_array_value($permissions, "add_purchase_return");
            $view_data['purchase_return_list'] = get_array_value($permissions, "purchase_return_list");

            $view_data['quality_check'] = get_array_value($permissions, "quality_check");
            $view_data['download_proof'] = get_array_value($permissions, "download_proof");
            $view_data['sales_order'] = get_array_value($permissions, "sales_order");
            $view_data['sales_quotation'] = get_array_value($permissions, "sales_quotation");

            
          


            $this->load->view("roles/permissions", $view_data);
        }
    }


    //save a role
    function save() {
        validate_submitted_data(array(
            "id" => "numeric",
            "title" => "required"
        ));

        $id = $this->input->post('id');
        $copy_settings = $this->input->post('copy_settings');
        $data = array(
            "title" => $this->input->post('title'),
        );

        if ($copy_settings) {
            $role = $this->Roles_model->get_one($copy_settings);
            $data["permissions"] = $role->permissions;
        }

        $save_id = $this->Roles_model->save($data, $id);
        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
    }

    //save permissions of a role
    function save_permissions() {
        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');
        $leave = $this->input->post('leave_permission');
        $leave_specific = "";
        if ($leave === "specific") {
            $leave_specific = $this->input->post('leave_permission_specific');
        }

        $attendance = $this->input->post('attendance_permission');
        $attendance_specific = "";
        if ($attendance === "specific") {
            $attendance_specific = $this->input->post('attendance_permission_specific');
        }

        $invoice = $this->input->post('invoice_permission');
        $estimate = $this->input->post('estimate_permission');
        $expense = $this->input->post('expense_permission');
        $order = $this->input->post('order_permission');
        $client = $this->input->post('client_permission');
        $lead = $this->input->post('lead_permission');


        $ticket = $this->input->post('ticket_permission');

        $ticket_specific = "";
        if ($ticket === "specific") {
            $ticket_specific = $this->input->post('ticket_permission_specific');
        }


        $can_manage_all_projects = $this->input->post('can_manage_all_projects');
        $can_create_projects = $this->input->post('can_create_projects');
        $can_edit_projects = $this->input->post('can_edit_projects');
        $can_delete_projects = $this->input->post('can_delete_projects');

        $can_add_remove_project_members = $this->input->post('can_add_remove_project_members');

        $can_create_tasks = $this->input->post('can_create_tasks');
        $can_edit_tasks = $this->input->post('can_edit_tasks');
        $can_delete_tasks = $this->input->post('can_delete_tasks');
        $can_comment_on_tasks = $this->input->post('can_comment_on_tasks');
        $show_assigned_tasks_only = $this->input->post('show_assigned_tasks_only');
        $can_update_only_assigned_tasks_status = $this->input->post('can_update_only_assigned_tasks_status');

        $can_create_milestones = $this->input->post('can_create_milestones');
        $can_edit_milestones = $this->input->post('can_edit_milestones');
        $can_delete_milestones = $this->input->post('can_delete_milestones');

        $can_delete_files = $this->input->post('can_delete_files');

        $announcement = $this->input->post('announcement_permission');
        $help_and_knowledge_base = $this->input->post('help_and_knowledge_base');

        $can_view_team_members_contact_info = $this->input->post('can_view_team_members_contact_info');
        $can_view_team_members_social_links = $this->input->post('can_view_team_members_social_links');
        $team_member_update_permission = $this->input->post('team_member_update_permission');
        $team_member_update_permission_specific = $this->input->post('team_member_update_permission_specific');

        $timesheet_manage_permission = $this->input->post('timesheet_manage_permission');
        $timesheet_manage_permission_specific = $this->input->post('timesheet_manage_permission_specific');

        $disable_event_sharing = $this->input->post('disable_event_sharing');

        $hide_team_members_list = $this->input->post('hide_team_members_list');

        $can_delete_leave_application = $this->input->post('can_delete_leave_application');
        
        $message_permission = "";//client_approval
        $message_permission_specific = "";
        if ($this->input->post('message_permission_no')) {
            $message_permission = "no";
        } else if ($this->input->post('message_permission_specific_checkbox')) {
            $message_permission = "specific";
            $message_permission_specific = $this->input->post("message_permission_specific");
        }

        $client_approval  = $this->input->post('client_approval');


        $access_products  = $this->input->post('access_products');
        $add_purchase     = $this->input->post('add_purchase');

        $purchase_list    = $this->input->post('purchase_list');
        $grn_list         = $this->input->post('grn_list');
        $purchase_requisition  = $this->input->post('purchase_requisition');
        $purchase_quotation    = $this->input->post('purchase_quotation');
        $purchase_order_list   = $this->input->post('purchase_order_list');
        $add_purchase_order    = $this->input->post('add_purchase_order');

        $add_sales             = $this->input->post('add_sales');
        $sales_list            = $this->input->post('sales_list');

        $add_transfer          = $this->input->post('add_transfer');
        $transfer_list         = $this->input->post('transfer_list');
        
        $work_order_list       = $this->input->post('work_order_list');
        $bom_list              = $this->input->post('bom_list');

        $lead_approval              = $this->input->post('lead_approval');
        $warehouse_permission              = $this->input->post('warehouse_permission');

        $account_permission              = $this->input->post('account_permission');

        $payments_permission              = $this->input->post('payments_permission');
        $petrol_permission              = $this->input->post('petrol_permission');
        $expense_approval              = $this->input->post('expense_approval');

        //hrm_permission
        $hrm_permission              = $this->input->post('hrm_permission');
        
        /* AG2103Q */
        $view_production             = $this->input->post('view_production');

        $indent_permission              = $this->input->post('indent_permission');//R.V29_03
        $add_sales_return             = $this->input->post('add_sales_return');
        $sales_return_list             = $this->input->post('sales_return_list');
        $add_purchase_return             = $this->input->post('add_purchase_return');
        $purchase_return_list             = $this->input->post('purchase_return_list');
        $quality_check                 = $this->input->post('quality_check');
        $dc_outward                 = $this->input->post('dc_outward');
        $download_proof                = $this->input->post('download_proof');
        $sales_order                = $this->input->post('sales_order');
        $sales_quotation                = $this->input->post('sales_quotation');

//quality_check
        $permissions = array(
            "leave" => $leave,
            "leave_specific" => $leave_specific,
            "attendance" => $attendance,
            "attendance_specific" => $attendance_specific,
            "invoice" => $invoice,
            "estimate" => $estimate,
            "expense" => $expense,
            "order" => $order,
            "client" => $client,
            "lead" => $lead,
            "ticket" => $ticket,
            "ticket_specific" => $ticket_specific,
            "announcement" => $announcement,
            "help_and_knowledge_base" => $help_and_knowledge_base,
            "can_manage_all_projects" => $can_manage_all_projects,
            "can_create_projects" => $can_create_projects,
            "can_edit_projects" => $can_edit_projects,
            "can_delete_projects" => $can_delete_projects,
            "can_add_remove_project_members" => $can_add_remove_project_members,
            "can_create_tasks" => $can_create_tasks,
            "can_edit_tasks" => $can_edit_tasks,
            "can_delete_tasks" => $can_delete_tasks,
            "can_comment_on_tasks" => $can_comment_on_tasks,
            "show_assigned_tasks_only" => $show_assigned_tasks_only,
            "can_update_only_assigned_tasks_status" => $can_update_only_assigned_tasks_status,
            "can_create_milestones" => $can_create_milestones,
            "can_edit_milestones" => $can_edit_milestones,
            "can_delete_milestones" => $can_delete_milestones,
            "can_delete_files" => $can_delete_files,
            "can_view_team_members_contact_info" => $can_view_team_members_contact_info,
            "can_view_team_members_social_links" => $can_view_team_members_social_links,
            "team_member_update_permission" => $team_member_update_permission,
            "team_member_update_permission_specific" => $team_member_update_permission_specific,
            "timesheet_manage_permission" => $timesheet_manage_permission,
            "timesheet_manage_permission_specific" => $timesheet_manage_permission_specific,
            "disable_event_sharing" => $disable_event_sharing,
            "hide_team_members_list" => $hide_team_members_list,
            "can_delete_leave_application" => $can_delete_leave_application,
            "message_permission" => $message_permission,
            "message_permission_specific" => $message_permission_specific,
            "client_approval" => $client_approval,
            "access_products" => $access_products,
            "add_purchase" => $add_purchase,
            "purchase_list" => $purchase_list,
            "grn_list" => $grn_list,
            "purchase_requisition" => $purchase_requisition,
            "purchase_quotation" => $purchase_quotation,
            "purchase_order_list" => $purchase_order_list,
            "add_purchase_order" => $add_purchase_order,
            "add_sales" => $add_sales,
            "sales_list" => $sales_list,
            "add_transfer" => $add_transfer,
            "transfer_list" => $transfer_list,
            "work_order_list" => $work_order_list,
            "bom_list" => $bom_list,
            "lead_approval" => $lead_approval,
            "warehouse_permission" => $warehouse_permission,
            "account_permission" => $account_permission,
            "payments_permission" => $payments_permission,
            "petrol_permission" => $petrol_permission,
            "expense_approval" => $expense_approval,
            "hrm_permission"=> $hrm_permission,
            "view_production"=> $view_production , /* AG2103Q */
            "indent_permission"=> $indent_permission,//R.V29_03
            "add_sales_return"=> $add_sales_return ,
            "sales_return_list"=> $sales_return_list ,
            "add_purchase_return"=> $add_purchase_return ,
            "purchase_return_list"=> $purchase_return_list,
            "quality_check" => $quality_check,
            "dc_outward" => $dc_outward,
            "download_proof" => $download_proof,
            "sales_order" => $sales_order,
            "sales_quotation" => $sales_quotation
        );


        $data = array(
            "permissions" => serialize($permissions),
        );

        $save_id = $this->Roles_model->save($data, $id);
        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($id), 'id' => $save_id, 'message' => lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
    }

    //delete or undo a role
    function delete() {

        validate_submitted_data(array(
            "id" => "numeric|required"
        ));

        $id = $this->input->post('id');
        if ($this->input->post('undo')) {
            if ($this->Roles_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Roles_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
        
    }

    //get role list data
    function list_data() {
        $list_data = $this->Roles_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    //get a row of role list
    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Roles_model->get_details($options)->row();
        return $this->_make_row($data);
    }

    //make a row of role list table
    private function _make_row($data) {
        return array("<a href='#' data-id='$data->id' class='role-row link'>" . $data->title . "</a>",
            "<a class='edit'><i class='fa fa-check' ></i></a>" . modal_anchor(get_uri("roles/modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "", "title" => lang('edit_role'), "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('delete_role'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("roles/delete"), "data-action" => "delete"))
        );
    }

}

/* End of file roles.php */
/* Location: ./application/controllers/roles.php */