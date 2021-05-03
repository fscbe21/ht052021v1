ALTER TABLE `accounts` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `activity_logs` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `address_proof` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `announcements` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `attendance` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `barcodesymbology` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `billers` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `bom_creation` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `bom_creation_detail` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `bonus` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `brand` MODIFY COLUMN id INT auto_increment;
ALTER TABLE `checklist_items` MODIFY COLUMN id INT auto_increment;

ALTER TABLE `clients`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `client_groups`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `client_lead`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `client_lead_visit`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `customer`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `customer_groups`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `custom_fields`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `custom_field_values`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `custom_widgets`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `dashboards`
MODIFY COLUMN id INT auto_increment;


ALTER TABLE `dc_outward`
	MODIFY COLUMN id INT auto_increment;


ALTER TABLE `dc_outward_details`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `deduction`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `department`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `department_wise_salary`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `email_templates`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `empgroup`
MODIFY COLUMN id INT auto_increment;


ALTER TABLE `estimates`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `estimate_forms`
	MODIFY COLUMN id INT auto_increment;

ALTER TABLE `estimate_items`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `estimate_requests`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `events`
 MODIFY COLUMN id INT auto_increment;
 


ALTER TABLE `excertificate`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `expenses`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `expenses_approval`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `expense_categories`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `general_files`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `grns`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `grn_status`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `help_articles`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `help_categories`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `holidays`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `id_proof`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `increment`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `indent`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `indent_details`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `invoices`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `invoice_items`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `invoice_payments`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `items`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `item_categories`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `labels`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `leads`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `lead_data_approval`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `lead_source`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `lead_status`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `lead_visit_info`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `leave_applications`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `leave_types`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `likes`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `loan`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `logs`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `messages`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `milestones`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `mom`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `money_transfer`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `noc`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `notes`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `notifications`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `notification_settings`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `orders`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `order_items`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `order_status`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `other_area`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `other_district`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `other_road`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `other_stage`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `pages`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `payments`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `payment_methods`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `payment_status`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `payment_with_cheque`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `paypal_ipn`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `payroll`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `petrol_payments`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `pickup`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `posts`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `process`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `production_assign_bom`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `production_set_process`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `production_set_stages`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `products`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `producttype`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `product_grns`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `product_purchases`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `product_returns`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `product_sales`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `product_sales_order`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `product_sales_quotation`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `product_transfer`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `product_warehouse`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `projects`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `project_comments`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `project_files`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `project_members`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `project_time`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `purchases`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `purchase_orders`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `purchase_order_details`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `purchase_product_return`
  MODIFY COLUMN id INT auto_increment;

ALTER TABLE `purchase_request`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `purchase_request_details`
 MODIFY COLUMN id INT auto_increment;



ALTER TABLE `purchase_status`
  MODIFY COLUMN id INT auto_increment;

ALTER TABLE `quotations`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `returns`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `return_purchases`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `roles`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `salary_payments`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `salary_payment_details`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `sales`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `sales_order`
   MODIFY COLUMN id INT auto_increment;


ALTER TABLE `sales_quotation`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `sale_status`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `services`
 MODIFY COLUMN id INT auto_increment;





ALTER TABLE `stripe_ipn`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `supplier`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `target`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `tasks`
  MODIFY COLUMN id INT auto_increment;

ALTER TABLE `task_status`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `taxes`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `tds`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `team`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `team_member_job_info`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `tickets`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `ticket_comments`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `ticket_templates`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `ticket_types`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `to_do`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `tracking`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `transfers`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `unit`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `users`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `vechicle`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `verification`
 MODIFY COLUMN id INT auto_increment;


ALTER TABLE `warehouse`
	MODIFY COLUMN id INT auto_increment;


ALTER TABLE `work_order`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `work_order_details`
  MODIFY COLUMN id INT auto_increment;



ALTER TABLE `vechicle_details`
  MODIFY COLUMN id INT auto_increment;

ALTER TABLE `vechicle_services`
  MODIFY COLUMN id INT auto_increment;

ALTER TABLE `fuel_consumptions`
  MODIFY COLUMN id INT auto_increment;


ALTER TABLE `fasttag`
  MODIFY COLUMN id INT auto_increment;

ALTER TABLE `reuse`
  MODIFY COLUMN id INT auto_increment;

ALTER TABLE `reuse_details`
  MODIFY COLUMN id INT auto_increment;

ALTER TABLE `vendor`
  MODIFY COLUMN id INT auto_increment;
  
  
  ALTER TABLE `advance`
  MODIFY COLUMN id INT auto_increment;

  ALTER TABLE `petrol_bunks`
  MODIFY COLUMN id INT auto_increment;
 
 
 ALTER TABLE `insurance_company`
  MODIFY COLUMN id INT auto_increment;

ALTER TABLE `insurance_renewdates`
  MODIFY COLUMN id INT auto_increment;