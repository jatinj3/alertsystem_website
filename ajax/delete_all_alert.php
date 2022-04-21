<?php
include('../config/connect.php');

 if(!empty($_POST['alert_id']))
 {
   session_start();
   $parent_user_id = $_SESSION['cntrl_p']['UserId'];
   $alert_id   = $_POST['alert_id'];
   
   	$sql_select_alert_table= "select * from alert_configuration where alrt_config_id in($alert_id) and parent_id='$parent_user_id' ";
	
	$query_select_alert_table_result=mysqli_query($conn2,$sql_select_alert_table);
	
	$data = mysqli_fetch_object($query_select_alert_table_result);
	
	 $user_id = $data->user_id;
	
	$query_gpid_userid = mysqli_query($conn,"select * from group_users a where a.sys_user_id='$user_id'");
	$obj=mysqli_fetch_object($query_gpid_userid);
	$gp_id_data=$obj->sys_group_id;
	
	
	 $alrt_type = $data->alrt_type;
	 //$alrt_type = 'Main power cut off';
	 $parameter_over_speed = $data->parameter_over_speed;
	 $mobile=$data->mobile;

	 $poi_id=$data->poi_id;
	 
	 
	 if($alrt_type=="OverSpeed")
	 {
		$delete_query_62_table = "delete from alert_userwise where sys_user_id='$user_id' and overspeed_value='$parameter_over_speed' and number in($mobile)"; 
		mysqli_query($conn2,$delete_query_62_table);
		
		// $delete_query_62_veh_table = "delete from vehicle_location_alert where user_id='$user_id' and phone_number in($mobile)"; 
		// mysqli_query($conn2,$delete_query_62_veh_table);
	 }
	 if($alrt_type=="Panic Alert"){
		 while($data_panic = mysqli_fetch_object($query_select_alert_table_result))
		 {
			$sys_service_id=$data_panic->sys_service_id;
			$mobile=$data_panic->mobile;

			$delete_query_62_table = "delete from alert_email where sys_service_id='$sys_service_id' and sms in($mobile) and sys_group_id=$gp_id_data ";  
			mysqli_query($conn2,$delete_query_62_table);
		 }
		 
		 // $delete_query_62_veh_table = "delete from vehicle_location_alert where user_id='$user_id' and phone_number in($mobile)"; 
		// mysqli_query($conn2,$delete_query_62_veh_table);
		
	 }
	 
	 if($alrt_type=="Ac Alert")
	 {
		 $delete_query_62_table = "delete from users_permissions where sys_user_id='$user_id' and sys_permission_id='179' ";  
		 
	     mysqli_query($conn2,$delete_query_62_table);
		 
		 // $delete_query_62_veh_table = "delete from vehicle_location_alert where user_id='$user_id' and phone_number in($mobile)"; 
		// mysqli_query($conn2,$delete_query_62_veh_table);
		 
		 
	 }	
		
	if($alrt_type=="Main power cut off")
	{
	$delete_query_62_table = "delete from users_permissions where sys_user_id='$user_id' and sys_permission_id='105' ";
	mysqli_query($conn2,$delete_query_62_table);


	// $delete_query_62_veh_table = "delete from vehicle_location_alert where user_id='$user_id' and phone_number in($mobile)"; 
	// mysqli_query($conn2,$delete_query_62_veh_table);
	
	}		
	if($alrt_type=="POI Alert")
	{
		if($poi_id!='')
		{
			 $delete_query_62_table = "delete from poi_alert_userwise where sys_user_id='$user_id' and poi_id in($poi_id) and number in($mobile)"; 
			mysqli_query($conn2,$delete_query_62_table);
		}
		else{
			 $delete_query_62_table = "delete from poi_alert_userwise where sys_user_id='$user_id' and is_all='1' and number in($mobile)"; 
			mysqli_query($conn2,$delete_query_62_table);
		}
		


	// $delete_query_62_veh_table = "delete from vehicle_location_alert where user_id='$user_id' and phone_number in($mobile)"; 
	// mysqli_query($conn2,$delete_query_62_veh_table);
	
	}		
	 
	 
	 
	 
	
	 
	 
	//$response['success_msg']=$delete_query_62_table;
	// $response=$delete_query_62_table;
	// echo json_encode($response);exit;
	
 
   
   
   
    $delete_query = "delete from  alert_configuration where alrt_config_id in($alert_id) and parent_id='$parent_user_id'";
	
	

if(mysqli_query($conn2,$delete_query))
     {
     	 $response['success_msg'] = 'Alert deleted successfully';
     } 
 else {
     	  $response['error_msg'] = 'Someting went wrong try again!!!';
      }

 } 
 else {
 	      $response['error_msg'] = 'All input fields are mandatory';
      }


    echo json_encode($response);exit;
?>