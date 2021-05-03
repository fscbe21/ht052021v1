<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------
  | AUTO-LOADER
  | -------------------------------------------------------------------
  | This file specifies which systems should be loaded by default.
  |
  | In order to keep the framework as light-weight as possible only the
  | absolute minimal resources are loaded by default. For example,
  | the database is not connected to automatically since no assumption
  | is made regarding whether you intend to use it.  This file lets
  | you globally define which systems you would like loaded with every
  | request.
  |
  | -------------------------------------------------------------------
  | Instructions
  | -------------------------------------------------------------------
  |
  | These are the things you can load automatically:
  |
  | 1. Packages
  | 2. Libraries
  | 3. Drivers
  | 4. Helper files
  | 5. Custom config files
  | 6. Language files
  | 7. Models
  |
 */

/*
  | -------------------------------------------------------------------
  |  Auto-load Packages
  | -------------------------------------------------------------------
  | Prototype:
  |
  |  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
  |
 */
$autoload['packages'] = array();

/*
  | -------------------------------------------------------------------
  |  Auto-load Libraries
  | -------------------------------------------------------------------
  | These are the classes located in system/libraries/ or your
  | application/libraries/ directory, with the addition of the
  | 'database' library, which is somewhat of a special case.
  |
  | Prototype:
  |
  |	$autoload['libraries'] = array('database', 'email', 'session');
  |
  | You can also supply an alternative library name to be assigned
  | in the controller:
  |
  |	$autoload['libraries'] = array('user_agent' => 'ua');
 */
$autoload['libraries'] = array('database', 'session', 'form_validation', 'encryption', 'template', 'finediff', 'parser');

/*
  | -------------------------------------------------------------------
  |  Auto-load Drivers
  | -------------------------------------------------------------------
  | These classes are located in system/libraries/ or in your
  | application/libraries/ directory, but are also placed inside their
  | own subdirectory and they extend the CI_Driver_Library class. They
  | offer multiple interchangeable driver options.
  |
  | Prototype:
  |
  |	$autoload['drivers'] = array('cache');
 */
$autoload['drivers'] = array();

/*
  | -------------------------------------------------------------------
  |  Auto-load Helper Files
  | -------------------------------------------------------------------
  | Prototype:
  |
  |	$autoload['helper'] = array('url', 'file');
 */
$autoload['helper'] = array('url', 'file', 'form', 'language', 'general', 'date_time', 'app_files', 'widget', 'activity_logs', 'currency');

/*
  | -------------------------------------------------------------------
  |  Auto-load Config files
  | -------------------------------------------------------------------
  | Prototype:
  |
  |	$autoload['config'] = array('config1', 'config2');
  |
  | NOTE: This item is intended for use ONLY if you have created custom
  | config files.  Otherwise, leave it blank.
  |
 */
$autoload['config'] = array('app');

/*
  | -------------------------------------------------------------------
  |  Auto-load Language files
  | -------------------------------------------------------------------
  | Prototype:
  |
  |	$autoload['language'] = array('lang1', 'lang2');
  |
  | NOTE: Do not include the "_lang" part of your file.  For example
  | "codeigniter_lang.php" would be referenced as array('codeigniter');
  |
 */
$autoload['language'] = array('default', 'custom');

/*
  | -------------------------------------------------------------------
  |  Auto-load Models
  | -------------------------------------------------------------------
  | Prototype:
  |
  |	$autoload['model'] = array('first_model', 'second_model');
  |
  | You can also supply an alternative model name to be assigned
  | in the controller:
  |
  |	$autoload['model'] = array('first_model' => 'first');
 */
$autoload['model'] = array(
    'Crud_model',
    'Settings_model',
    'Users_model',
    'Team_model',
    'Attendance_model',
    'Leave_types_model',
    'Leave_applications_model',
    'Events_model',
    'Announcements_model',
    'Messages_model',
    'Clients_model',
    'Projects_model',
    'Milestones_model',
    'Task_status_model',
    'Tasks_model',
    'Project_comments_model',
    'Activity_logs_model',
    'Project_files_model',
    'Notes_model',
    'Project_members_model',
    'Ticket_types_model',
    'Tickets_model',
    'Ticket_comments_model',
    'Items_model',
    'Invoices_model',
    'Invoice_items_model',
    'Invoice_payments_model',
    'Payment_methods_model',
    'Email_templates_model',
    'Roles_model',
    'Posts_model',
    'Timesheets_model',
    'Expenses_model',
    'Expense_categories_model',
    'Taxes_model',
    'Social_links_model',
    'Notification_settings_model',
    'Notifications_model',
    'Custom_fields_model',
    'Estimate_forms_model',
    'Estimate_requests_model',
    'Custom_field_values_model',
    'Estimates_model',
    'Estimate_items_model',
    'General_files_model',
    'Todo_model',
    'Client_groups_model',
    'Dashboards_model',
    'Lead_status_model',
    'Lead_source_model',
    'Order_items_model',
    'Orders_model',
    'Order_status_model',
    'Labels_model',
    'Verification_model',
    'Item_categories_model',
    'Lead_visit_model',
    'Target_model',
    'Lead_approval_model',//darini 12-2
    'New_work_order_model',//darini 13-2
    'Client_lead_visit',//darini 13-2
    'Other_district_model',
    'Other_road_model',
    'Other_area_model',
    'Expenses_approval_model',
    'Mom_model',//darini 18-2
    'Payroll_model',//darini 23-2
    'Increment_model',//darini 24
    'Bonus_model',               /*AG2402*/
    'Deduction_model',           /*AG2402*/
    'Loan_model' ,               /*AG2402*/
	  'Noc_model', //R.V24_02
    'Ex_certificate_model',//R.V24_02
    'Tds_model',//R.V24_02
    'Salarypayments_model',
    'Salarypaymentdetails_model',
    'Warehouse_model',
    'Brand_model',
    'Unit_model',
    'Supplier_model',
    'Customergrp_model',
    'Biller_model',
    'Customer_model',
    'Barcodesymbology_model',
    'Producttype_model',
    'Products_model',
	  'Id_proof_model',//R.v01_03
    'Address_proof_model',//R.v01_03
    'Purchase_status_model',//R.v03_03
    'Sale_status_model',//R.v03_03
    'Payment_status_model',//R.v03_03
    'Purchase_model',
    'Productpurchase_model',
    'Productwarehouse_model',
    'Empgroup_model', /*AG040321*/
    'Department_model',/*AG050321*/
    'Holidays_model',
    'Logs_model',
    'Petrol_payments_model',
    'Bom_model',      /*AG10032021 */
    'Bomdetail_model', /*AG10032021 */
    'AccountingModel',//darini 10-3
    'MoneyTransferModel',//darini 10-3
	  'Dep_wise_model',//R.V10_03,
    'Work_order_model',
    'Work_order_details_model',
    'ProductSales',//darini 11-3
    'SalesModel',//darini11-3
    'Purchase_request_model',
    'Purchase_request_details_model',
    'Process_model',
    'Other_stage_model',
    'Set_process_model',  /* AG1703 */
	  'Quotations_model',/* AG1703 */
    'Grn_model',//Nandhini
    'Productgrn_model',//Nandhini
    'Grn_status_model', //Nandhini 18-3
    'Payments',//darini 18-3
    'Payment_cheque',//darini 18-3
    'TransferModel',//darini 19-3
    'ProductTransfer',//darini 19-3
    'Assignbom_model', //AG20-03
    'Purchase_order_model',//R.V17_03
    'Purchaseorder_details_model',//R.V17_03
    'Set_stages_model',
    'ReturnModel',//darini 20-3
    'ProductReturn',//darini 20-3
	  'Vechicle_model',//R.V20_03
    'Pickup_model',//R.V20_03
    'Tracking_model',//R.V20_03
    'Services_model',//R.V20_03
    'PurchaseReturnModel',//darini 21-3
    'ProductPurchaseReturn',//darini 21-3
    'Dc_outward_model',
    'Dc_outward_details_model',
    'Indent_model',
    'Indent_details_model',
    'SalesOrderModel',//darin 24-3
    'SalesQuotationModel',//darini 24-3
    'ProductSalesOrder',//darini 24-3
    'ProductSalesQuotation',
	  'Vechicle_services_model',//R.V24_03
    'Fuel_model',//R.V24_03
    'Fasttag_model',//R.V24_03
    'Logistic_users_model',//R.V24_03
    'Reuse_model',
    'Reuse_details_model',
    'Vendor_model',//R.V29_03
    'Advance_model',//darini10-4
    'Insurance_company_model',//R.V17_04
    'Petrol_bunk_model',//R.V17_04
    'Insurance_dates_model'//R.V20_04
  );