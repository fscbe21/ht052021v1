


<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class New_work_order extends MY_Controller {

   function __construct() {
        parent::__construct();

        //check permission to access this module
        //$this->init_permission_checker("leaddataapproval");
    }

    function modal_form() {
        $project_id = $this->input->post('id');
        $client_id = $this->input->post('client_id');

      /*  if ($project_id) {
            if (!$this->can_edit_projects()) {
                redirect("forbidden");
            }
        } else {
            if (!$this->can_create_projects()) {
                redirect("forbidden");
            }
        }*/
        $resu=($this->New_work_order_model->get_order($client_id))+2;
        $view_data["order_data"]= $resu?$resu:"2";
        $view_data["client_id"] = $client_id;
        $view_data['model_info'] = $this->New_work_order_model->get_one($project_id);
        $view_data['client_info']= $this->Clients_model->get_one($client_id);
        if ($client_id) {
            $view_data['model_info']->client_id = $client_id;
        }

        //check if it's from estimate. if so, then prepare for project
        $estimate_id = $this->input->post('estimate_id');
        if ($estimate_id) {
            $view_data['model_info']->estimate_id = $estimate_id;
        }

        $view_data["custom_fields"] = $this->Custom_fields_model->get_combined_details("projects", $view_data['model_info']->id, $this->login_user->is_admin, $this->login_user->user_type)->result();

        $view_data['clients_dropdown'] = $this->Clients_model->get_dropdown_list(array("company_name"), "id", array("is_lead" => 0));

        $view_data['label_suggestions'] = $this->make_labels_dropdown("project", $view_data['model_info']->labels);
        $view_data['statuses'] = $this->Lead_status_model->get_details()->result();
         $view_data['sources'] = $this->Lead_source_model->get_details()->result();
         $view_data['team_members'] = $this->Users_model->team_members();
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-9";
        $this->load->view('clients/new_work_order_modal_form', $view_data);
    }

    function save() {
        $id=$this->input->post('id');
        $client_id = $this->input->post('client_id');
        //$this->can_access_this_lead($client_id);

       // $this->access_only_allowed_members();

         validate_submitted_data(array(
            "id" => "numeric",
            "company_name" => "required"
        ));

        /* $data = array(
            "company_name" => $this->input->post('company_name'),
            "address" => $this->input->post('address'),
            "city" => $this->input->post('city'),
            "state" => $this->input->post('state'),
            "zip" => $this->input->post('zip'),
            "country" => $this->input->post('country'),
            "phone" => $this->input->post('phone'),
            "website" => $this->input->post('website'),
            "vat_number" => $this->input->post('vat_number'),
            "currency_symbol" => $this->input->post('currency_symbol') ? $this->input->post('currency_symbol') : "",
            "currency" => $this->input->post('currency') ? $this->input->post('currency') : "",
            "is_lead" => 1,
            "lead_status_id" => $this->input->post('lead_status_id'),
            "lead_source_id" => $this->input->post('lead_source_id'),
            "owner_id" => $this->input->post('owner_id') ? $this->input->post('owner_id') : $this->login_user->id
        ); */

        $data = array(
            "client_id"=>$this->input->post('client_id'),
            "company_name" => $this->input->post('company_name'),
            "phone" => $this->input->post('phone'),
            "contact_person" => $this->input->post('contact_person'),            
            "person_role" => $this->input->post('person_role'),
            "lead_source_id" => $this->input->post('lead_source_id'),
            "product" => $this->input->post('product'),
            "product_category" => $this->input->post('product_category'),           
            "orders" => $this->input->post('orders'),
            "quantity" => $this->input->post('quantity'),
            "total_value" => $this->input->post('total_value'),
            "status_id" => $this->input->post('status_id'),
            "follow_date" => $this->input->post('follow_date'),
            "time" => convert_time_to_24hours_format($this->input->post('time')),
            "assigned_to" => $this->input->post('assigned_to'),
            "comments" => $this->input->post('comments')                       
           
               
        ); 

       

        $data = clean_data($data);
      
       
            $save_id = $this->New_work_order_model->save($data, $id);
        
    
        if ($save_id) {           
            echo json_encode(array("success" => true,  'id' => $save_id, 'message' => lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
    }

    /* delete or undo a lead */


    function list_data_of_client($client_id) {

       // $this->access_only_team_members_or_client_contact($client_id);

       $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("leads", $this->login_user->is_admin, $this->login_user->user_type);

       // $statuses = $this->input->post('status') ? implode(",", $this->input->post('status')) : "";

        $options = array(                       
            "custom_fields" => $custom_fields
        );

        $list_data = $this->New_work_order_model->get_client_lead($client_id)->result();//darini 19-2
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $custom_fields);
        }
        echo json_encode(array("data" => $result));
    }

    /* return a row of project list  table */

        /* prepare a row of project list table */

    private function _make_row($data, $custom_fields) {
       
        
        $lead_source = $this->Lead_source_model->get_one($data->lead_source_id);
        $lead_status = $this->Lead_status_model->get_one($data->status_id);
        $owner_data = $this->Users_model->get_one($data->assigned_to);
      
        $row_data = array(
            $data->orders,
            modal_anchor(get_uri("new_work_order/modal_form_info/".$data->id), "<span class='companyname'>".$data->company_name."</span>", array("class" => "leadTimeline", "title" => lang('lead_timeline'), "data-id" => $data->id, "data-companyname" => $data->company_name)),
            "<small style='padding: 4px;background-color: ".$lead_status->color."'>".$lead_status->title."</small>",
            $owner_data->first_name." ".$owner_data->last_name,
            $lead_source->title,
            dateFormatChange($data->follow_date),
            modal_anchor(get_uri("new_work_order/modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => "Edit New work", "data-post-id" => $data->id,"data-post-client_id" =>$data->client_id))                
        );

        foreach ($custom_fields as $field) {
            $cf_id = "cfv_" . $field->id;
            $row_data[] = $this->load->view("custom_fields/output_" . $field->field_type, array("value" => $data->$cf_id), true);
        }

        $row_data[] = $optoins;

        return $row_data;
    }

    function modal_form_info($lead_id) {
        $client=$this->New_work_order_model->get_one($lead_id);
        $data['info'] = $this->New_work_order_model->get_one($lead_id);
        $data['visit_info'] = $this->Client_lead_visit->get_details(array("new_lead_id"=>$lead_id))->result();
        //darini 9-2-21
        $data['team_members'] = $this->Users_model->team_members();
       /*  foreach($visit as $v){
                $lead_source = $this->Lead_source_model->get_one($v->lead_source_id);
               // $lead_status = $this->Lead_status_model->get_one($v->lead_status_id);
        } */

       // $data['visit_info'] = $lead_source->title;

       
       $data['label_column'] = "col-md-2";
       $data['field_column'] = "col-md-10";
       $data['statuses'] = $this->Lead_status_model->get_details()->result();
       $data['sources'] = $this->Lead_source_model->get_details()->result();
        $this->load->view('clients/new_work_order_info', $data);
    }
//darini 15-2
    function save_lead_visit(){
        $data=array(
            'new_lead_id'        => $this->input->post('lead_id'),
            'lead_source_id'    => $this->input->post('lead_source_id'),
            'lead_status_id'    => $this->input->post('lead_status_id'),
            'followup_date'     => $this->input->post('followup_date'),
            'time'              => convert_time_to_24hours_format($this->input->post('time')),
            'total_value'       => $this->input->post('total_value'),
            'description'       => $this->input->post('description'),
            'owner_id'          => $this->input->post('owner_id')
        );

        $update_lead = array(
            'lead_source_id'    => $this->input->post('lead_source_id'),
            'status_id'    => $this->input->post('lead_status_id'),
            'follow_date'     => $this->input->post('followup_date'),
            'time'              => convert_time_to_24hours_format($this->input->post('time')),
            'total_value'       => $this->input->post('total_value')
            
        );
        
        $leadId = $this->input->post('lead_id');

        $savedata = $this->New_work_order_model->save($update_lead, $leadId);

        $lead_visit_info_id =  $this->Client_lead_visit->save($data);

        if($lead_visit_info_id){
            echo json_encode(array("success" => true, 'message' => lang('record_saved')));  
        }else{
            echo json_encode(array("success" => false, 'message' => "Some Error occured !"));
        }  
    }
   
    
   
   
}

