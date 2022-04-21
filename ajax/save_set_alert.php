<?php
include('../config/connect.php');
date_default_timezone_set('Asia/Kolkata');

if(!empty($_POST['user_id']) && !empty($_POST['towhom']) && !empty($_POST['vehicle_id']))
 {
   session_start();
   $parent_user_id = $_SESSION['cntrl_p']['UserId']; // user session id

   // take out the group id of selected user
   $sys_group_id = $_SESSION['cntrl_p']['sys_group_id']; // user session id

   $user_id    = $_POST['user_id']; // user id
   $vehicle_id = $_POST['vehicle_id']; // vehicle reg no
   $svc_id = $_POST['svc_id']; // service id of veh
   $towhom = $_POST['towhom']; // service id of veh
   
   $towhomid = $_POST['towhomid']; // service id of veh
   
   $set_type   = $_POST['set_type']; // alet set type degault or cutom
   $alert_type = $_POST['alert_type']; // alert type
   //$mobile_no  = $_POST['mobile_no']; // mobile number
   //$mobile_no  =  '';// mobile number
   //$email_id   =  '';// email id
   //$email_id   = $_POST['email_id']; // email id
   $add_time   = date('Y-m-d H:i:s'); // add date and time
   $set_all_veh = $_POST['set_all_veh']; // set all vehicle option
   $status     = 'Active'; // alert status
   $response = array();
   
   
  // echo "select * from alert_users_details a where a.srl_id in(".$towhomid.")";
   //exit;
	$query_mobile_email = mysqli_query($conn2,"select * from alert_users_details a where a.srl_id in(".$towhomid.")");
	$obj_email='';
	$obj_mob='';
	
	while($obj_mob_email=mysqli_fetch_assoc($query_mobile_email))
	{
		$obj_email.=$obj_mob_email['email_id'].",";
		$obj_mob.=$obj_mob_email['mobile_number'].",";
		// echo$obj_mob_email['email_id'];
		// echo $obj_mob_email['mobile_number'];
	}
	// echo $obj_email."<br/>";
	// echo $obj_mob;
	$email_id=substr($obj_email,0,-1);
	$mobile_no=substr($obj_mob,0,-1);

	//echo $gp_id_data=$obj_mob_email->email_id;
	//exit;
	
	
	$query_gpid_userid = mysqli_query($conn,"select * from group_users a where a.sys_user_id='$user_id'");
	$obj=mysqli_fetch_object($query_gpid_userid);
	$gp_id_data=$obj->sys_group_id;
	

	$query_new_result = mysqli_query($conn,"select *  from group_services a,services b WHERE a.sys_service_id=b.id AND a.active=true AND a.sys_group_id='".$gp_id_data."' ");
	// echo "select *  from group_services a,services b WHERE a.sys_service_id=b.id AND a.active=true AND a.sys_group_id='".$gp_id_data."'"; die;

   // chek if it is duplicate  

	if(check_duplicate_entry($vehicle_id,$alert_type,$user_id))
	{
		// if case starts for all vehicles  case
		if($set_all_veh=='yes')
	   {
           //get all vehicles by sys group id
		 
		 if(!empty($user_id))
			{
               // fetching all the vehices 

			// echo "select *  from group_services a,services b WHERE a.sys_service_id=b.id AND a.active=true AND a.sys_group_id='$sys_group_id'";die;
			
	         // $query_result = mysqli_query($conn,"select *  from group_services a,services b WHERE a.sys_service_id=b.id AND a.active=true AND a.sys_group_id='$sys_group_id'");
	          // fetching all vehices query 

	       if($query_new_result->num_rows)
			  {

              //SaveUserDetails($mobile_no,$email_id,$user_id,$parent_user_id); // saving the users details
             
		      
		      if($alert_type=='Idle Alert')
			     {
					// $idle_hr_para = $_POST['idle_hr_para'];
					$idle_hr_para1 = $_POST['idle_hr_para1'];
				$idle_hr_para2 = $_POST['idle_hr_para2'];
			   	  //$idle_hrs = !empty($_POST['idle_halting_hrs']) ? $_POST['idle_halting_hrs']: '30'; // default value is 30 min
					 $idle_hrs = !empty($_POST['idle_halting_hrs']) ? $_POST['idle_halting_hrs']: ''; 
			   	   //  loop on the vehicle data to set the alerts
				   while($data = mysqli_fetch_object($query_new_result))
				       {
				            $vehicle_id = $data->veh_reg;
				            $actual_vehicle_id = $data->sys_service_id;
				            $sql_insert_setalert = "insert into alert_configuration (user_id,parent_id,towhom,towhomid,vehicle_no,sys_service_id,alrt_type,alert_set_type,idle_alert_from_time,idle_alert_to_time,idle_hrs,mobile,email_id,status,added_on)  values ('$user_id','$parent_user_id','$towhom','$towhomid','$vehicle_id','$actual_vehicle_id','$alert_type','$set_type','$idle_hr_para1','$idle_hr_para2','$idle_hrs','$mobile_no','$email_id','$status','$add_time')";
				             mysqli_query($conn2,$sql_insert_setalert); // inserting vehile alert check all
				             $response['success_msg'] = 'Alert set successfully';
				        }

			   } 
			 else if($alert_type=='OverSpeed')
			   {
			   	   $over_speed_para = $_POST['over_speed_para'];

			   	    while($data = mysqli_fetch_object($query_new_result))
				        {
				           $vehicle_id = $data->veh_reg;
						   $actual_vehicle_id = $data->sys_service_id;
                           $sql_insert_setalert = "insert into alert_configuration (user_id,parent_id,towhom,towhomid,vehicle_no,sys_service_id,alrt_type,alert_set_type,parameter_over_speed,mobile,email_id,status,added_on)  values ('$user_id','$parent_user_id','$towhom','$towhomid','$vehicle_id','$actual_vehicle_id','$alert_type','$set_type','$over_speed_para','$mobile_no','$email_id','$status','$add_time')";

                            mysqli_query($conn2,$sql_insert_setalert); // inserting vehile alert  cehck all
							 
				                             
				        }
						
						
					$sql_select_over_table= "select * from alert_userwise where sys_user_id='$user_id' and number='$mobile_no' and overspeed_value='$over_speed_para'";
					
					$query_select_over_result=mysqli_query($conn2,$sql_select_over_table);
			
					// echo "<pre>";
					// print_r($query_select_over_result);
					
					  $row_over=$query_select_over_result->num_rows;
					
						if($row_over>0)
						{
							
						}
						else{
							
						 $curr_date=date('Y-m-d H:i:s');
						 $sql_insert_setalert_alert_email_tbl= "INSERT INTO `alert_userwise` ( `sys_user_id`, `sys_group_id`, `email`, `number`, `overspeed`, `nonjourney`, `ac`, `mainpower`, `poi`, `other`, `lastupdate`, `overspeed_value`, `limit_speed`, `nonjourney_hour`, `status`, `is_controlroom`, `alert_type_2`) VALUES ('$user_id', '$gp_id_data', '$email_id', '$mobile_no', b'1', b'0', b'0', b'0', b'0', b'0', '$curr_date', '$over_speed_para', 0, 0, 1, 0, 0);";
					
					
						mysqli_query($conn2,$sql_insert_setalert_alert_email_tbl);
						}
						
												
						$response['success_msg'] = 'Alert set successfully';
						
						
						
			   }
			   else if($alert_type=='POI Alert')
			   {
			   	   $poi_name = $_POST['poi_name'];
					  $poi_id = $_POST['poiid'];
						if($poi_id=='' && $poi_name=='')
						{
							$is_all='1';
						}
						else{
							$is_all='0';
						}

					  $poientryexit=$_POST['poientryexit'];
					  if($poientryexit!='')
					  {

					  
						if($poientryexit=="entry")
						{
							$poientry_new=1;
							$poiexit_new=0;
						}
						else if($poientryexit=="exit"){
							$poientry_new=0;
							$poiexit_new=1;
						}
						else if($poientryexit=="entryexitboth"){
							$poientry_new=1;
							$poiexit_new=1;
						}
					}
					else{
						$response['error_msg'] = 'Please Select POI Option field';
						echo json_encode($response);exit;
					}


					  $searchForValue = ',';

				//	echo "<script>alert(".$poi_name.")</script>";
				if(strpos($poi_name, $searchForValue) !== false ) {
						// echo "Found";
						 $myarray= explode(",",$poi_name);
					 if (in_array("", $myarray))
					 {
					 exit;
					 }
					 else{
						$poi_name = $_POST['poi_name'];
					 }
					}
					 

			   	    while($data = mysqli_fetch_object($query_new_result))
				        {
				           $vehicle_id = $data->veh_reg;
						   $actual_vehicle_id = $data->sys_service_id;
                           $sql_insert_setalert = "insert into alert_configuration (user_id,parent_id,towhom,towhomid,vehicle_no,sys_service_id,alrt_type,alert_set_type,poi_name,poi_id,mobile,email_id,status,poientryexit,added_on)  values ('$user_id','$parent_user_id','$towhom','$towhomid','$vehicle_id','$actual_vehicle_id','$alert_type','$set_type','$poi_name','$poi_id','$mobile_no','$email_id','$status','$poientryexit','$add_time')";

                             mysqli_query($conn2,$sql_insert_setalert); // inserting vehile alert  cehck all
                             $response['success_msg'] = 'Alert set successfully';
						}
						




//------change-----
						$sql_select_poi_alert_userwise= "select * from poi_alert_userwise where sys_user_id='$user_id' and number='$mobile_no' and poi_id='$poi_id'";
					
						$query_select_over_result_poi_alert_userwise=mysqli_query($conn2,$sql_select_poi_alert_userwise);
				
						// echo "<pre>";
						// print_r($query_select_over_result);
						
						  $row_poi_alert_userwise=$query_select_over_result_poi_alert_userwise->num_rows;
						
							if($row_poi_alert_userwise>0)
							{
								
							}
							else{
								
							 $curr_date=date('Y-m-d H:i:s');
							 $sql_insert_poi_alert_userwise_tbl= "INSERT INTO `poi_alert_userwise` ( `sys_user_id`, `sys_group_id`, `email`, `number`,`is_all`, `poi_id`, `poi_name`, `alert_on_entry`, `alert_on_exit`, `status`,`added_on`) VALUES ('$user_id', '$gp_id_data', '$email_id', '$mobile_no','$is_all','$poi_id','$poi_name','$poientry_new','$poiexit_new','1','$curr_date');";
						
						
							mysqli_query($conn2,$sql_insert_poi_alert_userwise_tbl);
							}
							
													
							$response['success_msg'] = 'Alert set successfully';









			   }
			   else 
			     {

			     	while($data = mysqli_fetch_object($query_new_result))
					{
						$vehicle_id = $data->veh_reg;
						$actual_vehicle_id = $data->sys_service_id;
						 $sql_insert_setalert = "insert into alert_configuration (user_id,parent_id,towhom,towhomid,vehicle_no,sys_service_id,alrt_type,alert_set_type,mobile,email_id,status,added_on)  values ('$user_id','$parent_user_id','$towhom','$towhomid','$vehicle_id','$actual_vehicle_id','$alert_type','$set_type','$mobile_no','$email_id','$status','$add_time')"; 

						 mysqli_query($conn2,$sql_insert_setalert); // inserting vehicle alert check all
						 
						 if($alert_type=='Panic Alert')
						 {
							$curr_date=date('Y-m-d H:i:s');
							$sql_insert_setalert_alert_email_tbl= "INSERT INTO `alert_email` ( `sys_service_id`, `sys_group_id`, `email`, `sms`, `tamper_flag`, `theft_flag`, `shield_flag`, `poi_flag`, `panic_flag`, `accident_flag`, `mandown_flag`, `bunnet_flag`, `overspeed`, `ign_after_imb`, `lastupdate`, `overspeed_value`, `fuel_cap`, `status`, `extrainfoname`, `extrainfonum`) VALUES ('$actual_vehicle_id', '$gp_id_data', '$email_id','$mobile_no', b'0', b'0', b'0', b'0', b'1', b'0', b'0', b'0', b'0', b'0', '$curr_date', NULL, b'0', 0, NULL, NULL);";
							//echo $sql_insert_setalert_alert_email_tbl;
							
							mysqli_query($conn2,$sql_insert_setalert_alert_email_tbl);
						 }
				 				 
			                 
				}
				
						
						
						
						
				if($alert_type=='Ac Alert')
				{
					/*$curr_date=date('Y-m-d H:i:s');
					$sql_insert_setalert_alert_email_tbl= "INSERT INTO `alert_userwise` ( `sys_user_id`, `sys_group_id`, `email`, `number`, `overspeed`, `nonjourney`, `ac`, `mainpower`, `poi`, `other`, `lastupdate`, `overspeed_value`, `limit_speed`, `nonjourney_hour`, `status`, `is_controlroom`, `alert_type_2`) VALUES ('$user_id', '$gp_id_data', '$email_id', '$mobile_no', b'0', b'0', b'1', b'0', b'0', b'0', '$curr_date', NULL, 0, 0, 1, 0, 0);";
					
					
					
					//echo $sql_insert_setalert_alert_email_tbl;
					
					mysqli_query($conn2,$sql_insert_setalert_alert_email_tbl);*/
					
					
					$sql_insert_user_permission="INSERT INTO `users_permissions` (`sys_user_id`, `sys_permission_id`) VALUES ('$user_id', 179)";
					
					mysqli_query($conn2,$sql_insert_user_permission);
					
		
					
					
					/*$sql_update_user_permission="update `users_permissions` set sys_permission_id=179 where sys_user_id='$sys_user_id' ";

					mysqli_query($conn2,$sql_update_user_permission);*/

					/*$sql_select_users_table= "select * from users where id='$user_id' ";
					
					$query_select_users_result=mysqli_query($conn2,$sql_select_users_table);
					
					
						while($data = mysqli_fetch_object($query_select_users_result))
				        {
				           echo $mobile_number = $data->mobile_number."mymobif";
				        }*/
						
						
					}
					
					if($alert_type=='Main power cut off')
					{
							/*$curr_date=date('Y-m-d H:i:s');
					$sql_insert_setalert_alert_email_tbl= "INSERT INTO `alert_userwise` ( `sys_user_id`, `sys_group_id`, `email`, `number`, `overspeed`, `nonjourney`, `ac`, `mainpower`, `poi`, `other`, `lastupdate`, `overspeed_value`, `limit_speed`, `nonjourney_hour`, `status`, `is_controlroom`, `alert_type_2`) VALUES ('$user_id', '$gp_id_data', '$email_id', '$mobile_no', b'0', b'0', b'0', b'1', b'0', b'0', '$curr_date', NULL, 0, 0, 1, 0, 0);";
					*/
					
					
					//echo $sql_insert_setalert_alert_email_tbl;
					
					//mysqli_query($conn2,$sql_insert_setalert_alert_email_tbl);
					
					
					$sql_insert_user_permission="INSERT INTO `users_permissions` (`sys_user_id`, `sys_permission_id`) VALUES ('$user_id', 105)";
					
					mysqli_query($conn2,$sql_insert_user_permission);
					
					
					
					
					/*$sql_select_users_table= "select * from users where id='$user_id' ";
					
					$query_select_users_result=mysqli_query($conn2,$sql_select_users_table);
					
					
						while($data = mysqli_fetch_object($query_select_users_result))
				        {
				           echo $mobile_number = $data->mobile_number."mymobif";
				        }*/
					
					/*$sql_update_user_permission="update `users_permissions` set sys_permission_id=105 where sys_user_id='$sys_user_id' ";

					mysqli_query($conn2,$sql_update_user_permission);*/

						
						
						}
						
					
						
						$response['success_msg'] = 'Alert set successfully';
						
						
						
						
			      }
				  
				$sql_select_veh_table= "select * from vehicle_location_alert where userid='$user_id' and phone_number='$mobile_no'";
					
				$query_select_veh_result=mysqli_query($conn2,$sql_select_veh_table);
		
				
				
				 $row=$query_select_veh_result->num_rows;
				
					if($row>0)
					{
						
					}
					else{
						$sql_veh_loc_table="INSERT INTO `vehicle_location_alert` ( `userid`, `phone_number`, `email_id`, `sent_time`, `sent_type`, `status`, `active`) VALUES ('$user_id','$mobile_no', NULL, NULL, 9, 1, 1);";
				
						mysqli_query($conn2,$sql_veh_loc_table);
					}
				  	/*$sql_veh_loc_table="INSERT INTO `vehicle_location_alert` ( `userid`, `phone_number`, `email_id`, `sent_time`, `sent_type`, `status`, `active`) VALUES ('$user_id','$mobile_no', NULL, NULL, 9, 1, 1);";
					
					mysqli_query($conn2,$sql_veh_loc_table);*/

			   }
	         
		    }
				
	   }
	 else {
             // parameter_idle_hour
         //SaveUserDetails($mobile_no,$email_id,$user_id,$parent_user_id); // saving users details
         
		  if($alert_type=='Idle Alert')
			   {
				$idle_hr_para1 = $_POST['idle_hr_para1'];
				$idle_hr_para2 = $_POST['idle_hr_para2'];
			   	   //$idle_hr_para = $_POST['idle_hr_para'];
			   	  // $idle_hrs = !empty($_POST['idle_halting_hrs']) ? $_POST['idle_halting_hrs']: '30'; // default value is 30 min
					 $idle_hrs = !empty($_POST['idle_halting_hrs']) ? $_POST['idle_halting_hrs']: '';
			       $sql_insert_setalert = "insert into alert_configuration (user_id,parent_id,towhom,towhomid,vehicle_no,sys_service_id,alrt_type,alert_set_type,idle_alert_from_time,idle_alert_to_time,idle_hrs,mobile,email_id,status,added_on)  values ('$user_id','$parent_user_id','$towhom','$towhomid','$vehicle_id','$svc_id','$alert_type','$set_type','$idle_hr_para1','$idle_hr_para2','$idle_hrs','$mobile_no','$email_id','$status','$add_time')";
			   } 
			   else if($alert_type=='OverSpeed')
			   {
			   	   $over_speed_para = $_POST['over_speed_para'];
			       $sql_insert_setalert = "insert into alert_configuration (user_id,parent_id,towhom,towhomid,vehicle_no,sys_service_id,alrt_type,alert_set_type,parameter_over_speed,mobile,email_id,status,added_on)  values ('$user_id','$parent_user_id','$towhom','$towhomid','$vehicle_id','$svc_id','$alert_type','$set_type','$over_speed_para','$mobile_no','$email_id','$status','$add_time')";
				   
				   
				    $sql_select_over_table= "select * from alert_userwise where sys_user_id='$user_id' and number='$mobile_no' and overspeed_value='$over_speed_para'";
					
					$query_select_over_result=mysqli_query($conn2,$sql_select_over_table);
			
					
					
					  $row_over=$query_select_over_result->num_rows;
					
						if($row_over>0)
						{
							
						}
						else{
					$curr_date=date('Y-m-d H:i:s');
				
					$sql_insert_setalert_alert_email_tbl= "INSERT INTO `alert_userwise` ( `sys_user_id`, `sys_group_id`, `email`, `number`, `overspeed`, `nonjourney`, `ac`, `mainpower`, `poi`, `other`, `lastupdate`, `overspeed_value`, `limit_speed`, `nonjourney_hour`, `status`, `is_controlroom`, `alert_type_2`) VALUES ('$user_id', '$gp_id_data', '$email_id', '$mobile_no', b'1', b'0', b'0', b'0', b'0', b'0', '$curr_date', '$over_speed_para', 0, 0, 1, 0, 0);";
					
					mysqli_query($conn2,$sql_insert_setalert_alert_email_tbl);
			
						}
						
						
				   
				    /*$curr_date=date('Y-m-d H:i:s');
					$sql_insert_setalert_alert_email_tbl= "INSERT INTO `alert_userwise` ( `sys_user_id`, `sys_group_id`, `email`, `number`, `overspeed`, `nonjourney`, `ac`, `mainpower`, `poi`, `other`, `lastupdate`, `overspeed_value`, `limit_speed`, `nonjourney_hour`, `status`, `is_controlroom`, `alert_type_2`) VALUES ('$user_id', '$gp_id_data', '$email_id', '$mobile_no', b'1', b'0', b'0', b'0', b'0', b'0', '$curr_date', '$over_speed_para', 0, 0, 1, 0, 0);";
					
					mysqli_query($conn2,$sql_insert_setalert_alert_email_tbl);*/
					
				
					
					
					
					
			   }
			    else if($alert_type=='POI Alert')
			   {
			   	   $poi_name = $_POST['poi_name'];
				   
				   $poi_id = $_POST['poiid'];
				   if($poi_id=='' && $poi_name=='')
				   {
					   $is_all='1';
				   }
				   else{
					   $is_all='0';
				   }




				   $poientryexit=$_POST['poientryexit'];
				    if($poientryexit!='')
					  {

					  
						if($poientryexit=="entry")
						{
							$poientry_new=1;
							$poiexit_new=0;
						}
						else if($poientryexit=="exit"){
							$poientry_new=0;
							$poiexit_new=1;
						}
						else if($poientryexit=="entryexitboth"){
							$poientry_new=1;
							$poiexit_new=1;
						}
					}
					else{
						//echo "<script>alert('Please Select POI Option field');</script>"; 
						$response['error_msg'] = 'Please Select POI Option field';
						echo json_encode($response);exit;
					}
				   $searchForValue = ',';


				   if(strpos($poi_name, $searchForValue) !== false ) {
						   // echo "Found";
							$myarray= explode(",",$poi_name);
						if (in_array("", $myarray))
						{
						exit;
						}
						else{
						   $poi_name = $_POST['poi_name'];
						}
					   }
				   
					   $sql_insert_setalert = "insert into alert_configuration (user_id,parent_id,towhom,towhomid,vehicle_no,sys_service_id,alrt_type,alert_set_type,poi_name,poi_id,mobile,email_id,status,poientryexit,added_on)  values ('$user_id','$parent_user_id','$towhom','$towhomid','$vehicle_id','$svc_id','$alert_type','$set_type','$poi_name','$poi_id','$mobile_no','$email_id','$status','$poientryexit','$add_time')";
			 // echo $sql_insert_setalert;die;
				
					   $sql_select_poi_alert_userwise= "select * from poi_alert_userwise where sys_user_id='$user_id' and number='$mobile_no' and poi_id='$poi_id' ";
					
					   $query_select_over_result_poi_alert_userwise=mysqli_query($conn2,$sql_select_poi_alert_userwise);
			   
					   // echo "<pre>";
					   // print_r($query_select_over_result);
					   
						 $row_poi_alert_userwise=$query_select_over_result_poi_alert_userwise->num_rows;
					   
						   if($row_poi_alert_userwise>0)
						   {
							   
						   }
						   else{
							   
							$curr_date=date('Y-m-d H:i:s');
							$sql_insert_poi_alert_userwise_tbl= "INSERT INTO `poi_alert_userwise` ( `sys_user_id`, `sys_group_id`, `email`, `number`,`is_all`, `poi_id`, `poi_name`, `alert_on_entry`, `alert_on_exit`, `status`,`added_on`) VALUES ('$user_id', '$gp_id_data', '$email_id', '$mobile_no','$is_all','$poi_id','$poi_name','$poientry_new','$poiexit_new','1','$curr_date');";
					   
					   
						   mysqli_query($conn2,$sql_insert_poi_alert_userwise_tbl);
						   }
						   
				
				
				
				
				
				
				
				
					}
			   else 
			   {
			     $sql_insert_setalert = "insert into alert_configuration (user_id,parent_id,towhom,towhomid,vehicle_no,sys_service_id,alrt_type,alert_set_type,mobile,email_id,status,added_on)  values ('$user_id','$parent_user_id','$towhom','$towhomid','$vehicle_id','$svc_id','$alert_type','$set_type','$mobile_no','$email_id','$status','$add_time')";
				 
				 
				if($alert_type=='Panic Alert')
				 {
					$curr_date=date('Y-m-d H:i:s');
					
					$sql_insert_setalert_alert_email_tbl= "INSERT INTO `alert_email` ( `sys_service_id`, `sys_group_id`, `email`, `sms`, `tamper_flag`, `theft_flag`, `shield_flag`, `poi_flag`, `panic_flag`, `accident_flag`, `mandown_flag`, `bunnet_flag`, `overspeed`, `ign_after_imb`, `lastupdate`, `overspeed_value`, `fuel_cap`, `status`, `extrainfoname`, `extrainfonum`) VALUES ('$svc_id', '$gp_id_data', '$email_id','$mobile_no', b'0', b'0', b'0', b'0', b'1', b'0', b'0', b'0', b'0', b'0', '$curr_date', NULL, b'0', 0, NULL, NULL);";
					//echo $sql_insert_setalert_alert_email_tbl;
					
					mysqli_query($conn2,$sql_insert_setalert_alert_email_tbl);
					
				
				 }
				 
				 if($alert_type=='Ac Alert')
						{
							/*$curr_date=date('Y-m-d H:i:s');
					$sql_insert_setalert_alert_email_tbl= "INSERT INTO `alert_userwise` ( `sys_user_id`, `sys_group_id`, `email`, `number`, `overspeed`, `nonjourney`, `ac`, `mainpower`, `poi`, `other`, `lastupdate`, `overspeed_value`, `limit_speed`, `nonjourney_hour`, `status`, `is_controlroom`, `alert_type_2`) VALUES ('$user_id', '$gp_id_data', '$email_id', '$mobile_no', b'0', b'0', b'1', b'0', b'0', b'0', '$curr_date', NULL, 0, 0, 1, 0, 0);";
					
					
					
					//echo $sql_insert_setalert_alert_email_tbl;
					
					mysqli_query($conn2,$sql_insert_setalert_alert_email_tbl);*/
					
					
					$sql_insert_user_permission="INSERT INTO `users_permissions` (`sys_user_id`, `sys_permission_id`) VALUES ('$user_id', 179)";
					
					mysqli_query($conn2,$sql_insert_user_permission);
					
					/*$sql_update_user_permission="update `users_permissions` set sys_permission_id=179 where sys_user_id='$sys_user_id' ";

					mysqli_query($conn2,$sql_update_user_permission);*/
					/*$sql_select_users_table= "select * from users where id='$user_id' ";
					
					$query_select_users_result=mysqli_query($conn2,$sql_select_users_table);
					
					
						while($data = mysqli_fetch_object($query_select_users_result))
				        {
				           echo $mobile_number = $data->mobile_number."mymobelse";
				        }*/
						
						
						}
				 
				 if($alert_type=='Main power cut off')
						{
							/*$curr_date=date('Y-m-d H:i:s');
					$sql_insert_setalert_alert_email_tbl= "INSERT INTO `alert_userwise` ( `sys_user_id`, `sys_group_id`, `email`, `number`, `overspeed`, `nonjourney`, `ac`, `mainpower`, `poi`, `other`, `lastupdate`, `overspeed_value`, `limit_speed`, `nonjourney_hour`, `status`, `is_controlroom`, `alert_type_2`) VALUES ('$user_id', '$gp_id_data', '$email_id', '$mobile_no', b'0', b'0', b'0', b'1', b'0', b'0', '$curr_date', NULL, 0, 0, 1, 0, 0);";*/
					
					
					//check from  users table whether current mobile_number is same as $mobile_no 
					
					//if there is change then update that mobile number
					
					
					
					//echo $sql_insert_setalert_alert_email_tbl;
					
					//mysqli_query($conn2,$sql_insert_setalert_alert_email_tbl);
					
					
					$sql_insert_user_permission="INSERT INTO `users_permissions` (`sys_user_id`, `sys_permission_id`) VALUES ('$user_id', 105)";
					
					mysqli_query($conn2,$sql_insert_user_permission);
					
					
					
					/*$sql_select_users_table= "select * from users where id='$user_id' ";
					
					$query_select_users_result=mysqli_query($conn2,$sql_select_users_table);
					
					
						while($data = mysqli_fetch_object($query_select_users_result))
				        {
				           echo $mobile_number = $data->mobile_number."mymobelse";
				        }
						*/
						
						
					
					/*$sql_update_user_permission="update `users_permissions` set sys_permission_id=105 where sys_user_id='$sys_user_id' ";

					mysqli_query($conn2,$sql_update_user_permission);*/

						
						
						}
				 
				 
				 
				 
			   }
			   
			$sql_select_veh_table= "select * from vehicle_location_alert where userid='$user_id' and phone_number='$mobile_no'";
					
					$query_select_veh_result=mysqli_query($conn2,$sql_select_veh_table);
					
					$row=$query_select_veh_result->num_rows;
						if($row>0)
						{
							
						}
						else{
							$sql_veh_loc_table="INSERT INTO `vehicle_location_alert` ( `userid`, `phone_number`, `email_id`, `sent_time`, `sent_type`, `status`, `active`) VALUES ('$user_id','$mobile_no', NULL, NULL, 9, 1, 1);";
					
					mysqli_query($conn2,$sql_veh_loc_table);
						}
			   
			   
			   
			   
			   
	
					
					
		 if(mysqli_query($conn2,$sql_insert_setalert))
			  {
				  $response['success_msg'] = 'Alert set successfully';
			  } 
			 else {
			     	$response['error_msg'] = 'Someting went wrong try again!!!';
			      }

	      }
	  } else {

	          // resonse duplicate alert entry 
	  	      $response['error_msg_dup'] = 'Duplicate entry not allowed !!!';
	  }


  } 
   else {
 	     $response['error_msg'] = 'All input fields are mandatory';
        }


    echo json_encode($response);exit;



// chek if the alert is alery set

function check_duplicate_entry($vechile_no,$alert_type,$user_id)
 {
 	 // echo  $vechile_no.'-----'.$alert_type.'-----'.$user_id;exit;

	include('../config/connect.php'); //  db connection file
	if(!empty($alert_type) && !empty($vechile_no) && !empty($user_id))
	    {
	    $sql_alert_result = "select count(*) as total from alert_configuration a where a.user_id='$user_id' and a.alrt_type='$alert_type' and a.vehicle_no='$vechile_no'";
	     $query_chk_dup = mysqli_query($conn2,$sql_alert_result);

	     $total_data_count = mysqli_fetch_object($query_chk_dup);
	      if($total_data_count->total > 0)
	      {
	          return false;  // if duplicate entry found
	      } else 
	          {
	            return true; // return true if no duplicate record found
	          }

	     } 
 }


// saving the user details when setting the alert for vehicles
function SaveUserDetails($mobile_number,$email_id,$user_id,$parent_user_id)
{
 // echo  $vechile_no.'-----'.$alert_type.'-----'.$user_id;exit;

	include('../config/connect.php'); //  db connection file
	if(!empty($mobile_number) && !empty($email_id) && !empty($user_id))
	    {
	      $sql_alert_result = "select count(*) as total from alert_users_details a where a.user_id='$user_id' and a.mobile_number='$mobile_number' and a.email_id='$email_id'";
	      
	      $query_chk_dup = mysqli_query($conn2,$sql_alert_result);

	      $total_data_count = mysqli_fetch_object($query_chk_dup); // fetching the duplicate data count
	      
	      if($total_data_count->total > 0)
	       {
	          return true;  // if duplicate entry found
	       } else 
	          {
 
	            $qry_save_details = "insert into alert_users_details (parent_id,mobile_number,email_id,user_id) values('$parent_user_id','$mobile_number','$email_id','$user_id')";
	             mysqli_query($conn2,$qry_save_details); // inserting the users details into table
	             return true; // return true from function
	          }

	     }
}




// feeding the alert data to priya table data



function setAlertToServiceTable()
{
   include('../config/connect.php'); //  db connection file

    echo "in the confign able";exit;
}


?>