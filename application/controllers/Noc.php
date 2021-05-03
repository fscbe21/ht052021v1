<?php
/*RV2302 - INITIAL CREATION*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Noc extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->access_only_team_members();
    
       // $this->init_permission_checker("message_permission");
    }

    function index(){
       

        $this->template->rander("noc/noc_list");
    }

    function salaray_list(){
        $this->template->rander('salary/salary_list');
    }



    function modal_form() {
   

        validate_submitted_data(array(
            "id" => "numeric"
        ));

        $view_data['model_info'] = $this->Noc_model->get_one($this->input->post('id'));
        $view_data['model_info'] = $this->Noc_model->get_one();
        $view_data["team_members_dropdown"] = $this->get_team_members_dropdown();
      
        $this->load->view('noc/modal_form', $view_data);
    }


    function modal_form_client() {
        validate_submitted_data(array(
            "id" => "numeric"
        ));


       
        //$view_data['team_members_info'] = $this->Users_model->get_one();
     //  $view_data['model_info'] = $this->Other_district_model->get_one($this->input->post('id'));
        $this->load->view('noc/modal_for_client', $view_data);
    }

    function save() {
        validate_submitted_data(array(
            "id" => "numeric",
            "employee" => "required|numeric",
            "description" => "required"
        ));
       

        $id = $this->input->post('id');
        $data["employee"] = $this->input->post('employee');
        $data["description"] = $this->input->post('description');
        $data["bottom_description"] = $this->input->post('bottom_description');
        $data["created_at"] = $this->input->post('bottom_description');
        $data["created_at"] = get_current_utc_time();
        $data["updated_at"] = get_current_utc_time();
        $data["type"] = "1";
        $data["created_by"] = $this->input->post('created_by') ? $this->input->post('created_by') : $this->login_user->id;
        $save_id = $this->Noc_model->save($data, $id);
        $data["updated_by"] = $this->input->post('updated_by') ? $this->input->post('updated_by') : $this->login_user->id;

        
       


        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
        }
    }


// reaturn a row of leave application list table
function application_details() {
   // validate_submitted_data(array(
      //  "id" => "required|numeric"
    //));

    $id = $this->input->post('id');
    $info = $this->Noc_model->get_details($id);

    
   
  /*  if (!$info) {
        show_404();
    }*/


    //checking the user permissiton to show/hide reject and approve button

    /*
    $can_manage_application = false;
    if ($this->access_type === "all") {
        $can_manage_application = true;
    } else if (array_search($info->applicant_id, $this->allowed_members) && $info->applicant_id !== $this->login_user->id) {
        $can_manage_application = true;
    }
    $view_data['show_approve_reject'] = $can_manage_application;

    //has permission to manage the appliation? or is it own application?
    if (!$can_manage_application && $info->applicant_id !== $this->login_user->id) {
        redirect("forbidden");
    }
    //darini 20-2
    $applicatoin_info = $this->Leave_applications_model->get_one($applicaiton_id);
     //darini 22-2       
     $approval=array();              
     $to_user_id=$applicatoin_info->last_approved;
     $spilt=explode(",", $to_user_id);
     foreach($spilt as $user_id){
         if($user_id){
         $role=$this->Users_model->get_one( $user_id);
         $approval[]=$role->first_name." ".$role->last_name;
         }
     }//end

    if ($this->login_user->is_admin) { 
        if($applicatoin_info->is_md_approved==1){
            $show=0;
        }else{
            $show=1;
        }   
               
    }else if($this->login_user->role_id==1){
        if($applicatoin_info->is_gm_approved==1){
            $show=0;
        }else{
            $show=1;
        } 
    }else if($this->login_user->role_id==2){
        if($applicatoin_info->is_sm_approved==1){
            $show=0;
        }else{
            $show=1;
        } 
    }else if($this->login_user->role_id==4){
        if($applicatoin_info->is_hr_approved==1){
            $show=0;
        }else{
            $show=1;
        } 
    }   */     
   //end
    /*$view_data['show']=$show;
    $view_data['approval']=implode(", ",$approval);*/
   // $view_data['leave_info'] = $this->_prepare_leave_info($info);

    //$view_data['model_info'] = $this->Noc_model->get_one();
    $view_data['model_info'] = $this->Noc_model->get_one($this->input->post('id'));
    $view_data['user_info'] = $this->Users_model->get_one($this->input->post('id'));

    
    $this->Users_model->get_one($this->input->post('employee'));
    $this->load->view("noc/noc_details", $view_data);
}




    function list_data() {
        $list_data = $this->Noc_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Noc_model->get_details($options)->row();
        return $this->_make_row($data);
        $data2 = $this->Users_model->get_details($options)->row();
        return $this->_make_row($data2);
    }
    

    private function _make_row($data) {
      //  $print = modal_anchor(get_uri("noc/modal_form"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => lang('print'), "data-post-id" => $data->id));


         $print2 = modal_anchor(get_uri("noc/application_details"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => lang('noc_details'), "data-post-id" => $data->id));


        //$print2 = modal_anchor(get_uri("noc/application_details"), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => lang('noc_details'), "data-post-id" => $data->id));
      //  $delete = js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('other_area'), "class" => "delete", "data-id" => $data2->id, "data-action-url" => get_uri("other_area/delete"), "data-action" => "delete-confirmation"));
        $image_url = get_avatar($data->created_by_avatar);
        $user = "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span> $data->created_by_user";
        $out_time = $data->out_time;
       
       
       
        return array(
            $data->id,
            get_team_member_profile_link($data->employee, $user),
            (date("d/m/y H:i:s A", strtotime($data->created_at))),
            
            $print .  $print2 //. $delete
        );
    }


    private function _get_team_members_dropdown() {
        $team_members = $this->Users_model->get_all_where(array("deleted" => 0, "user_type" => "staff"), 0, 0, "first_name")->result();

        $members_dropdown = array(array("id" => "", "text" => "- " . lang("member") . " -"));
        foreach ($team_members as $team_member) {
            $members_dropdown[] = array("id" => $team_member->id, "text" => $team_member->first_name . " " . $team_member->last_name);
        }


        return json_encode($members_dropdown);
    }


     function make_payment(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-6";
        $this->template->rander('salary/make_payment',$view_data);
     }

     function generate_slip(){
        $view_data['label_column'] = "col-md-3";
        $view_data['field_column'] = "col-md-6";
        $this->template->rander('salary/generate_slip',$view_data);
     }
     function pf(){
        $this->template->rander('salary/pf'); 
     }
     function pf_list_data(){
        $custom_fields = $this->Custom_fields_model->get_available_fields_for_table("leads", $this->login_user->is_admin, $this->login_user->user_type);
 
 
        $options = array(                       
            "custom_fields" => $custom_fields
        );

        //$list_data = $this->New_work_order_model->get_client_lead()->result();
        $result = array();
       /* foreach ($list_data as $data) {
            $result[] = $this->_make_row($data, $custom_fields);
        }*/
        echo json_encode(array("data" => $result));

     }

     
 
}

?>