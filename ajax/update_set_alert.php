<?php
include('../config/connect.php');
date_default_timezone_set('Asia/Kolkata');
 if(!empty($_POST['user_id']) && !empty($_POST['email_id']) && !empty($_POST['mobile_no']) && !empty($_POST['vehicle_id']))
 {
  
   session_start();
   $parent_user_id = $_SESSION['cntrl_p']['UserId']; // session paent id id
   $user_id    = $_POST['user_id']; // user id form
   $vehicle_id = $_POST['vehicle_id']; // vehicle id form 
   $set_type   = $_POST['set_type']; // alert set type custom or default
   $alert_type = $_POST['alert_type']; // alert type
   $mobile_no  = $_POST['mobile_no']; // mobile number
   $email_id   = $_POST['email_id']; // alert email id
   $add_time   = date('Y-m-d H:i:s'); // add date and time
   $alert_id   = $_POST['alert_id']; // edit alert id
   if(!empty($_POST['set_all_veh_edit']))
   {
	 $set_all_veh_edit =  $_POST['set_all_veh_edit'];  
	 if($set_all_veh_edit=='yes')
	 {
       echo "yes alert set to all vehciles";exit;
	 }
   
   }
   
   $status     = $_POST['set_alert_status']; // alert status
   $response = array(); // response array


   
   

   if($alert_type=='Idle Alert')
   {
   	   $idle_hr_para = $_POST['idle_hr_para'];
       $idle_hrs = !empty($_POST['idle_halting_hrs']) ? $_POST['idle_halting_hrs']: '30'; // default value is 30 min

      $sql_update_setalert = "update alert_configuration set user_id='$user_id',parent_id='$parent_user_id',vehicle_no='$vehicle_id',alrt_type='$alert_type',alert_set_type='$set_type',idle_alert_time='$idle_hr_para',idle_hrs='$idle_hrs',parameter_over_speed='',mobile='$mobile_no',email_id='$email_id',status='$status',updated_on='$add_time' where parent_id='$parent_user_id' and alrt_config_id='$alert_id'";
   } 
   else if($alert_type=='OverSpeed')
   {
   	   $over_speed_para = $_POST['over_speed_para'];
       $sql_update_setalert = "update alert_configuration set user_id='$user_id',vehicle_no='$vehicle_id',alrt_type='$alert_type',alert_set_type='$set_type',parameter_over_speed='$over_speed_para',idle_hrs='',idle_alert_time='',mobile='$mobile_no',email_id='$email_id',status='$status',updated_on='$add_time'  where parent_id='$parent_user_id' and alrt_config_id='$alert_id'";
   }
   else 
   {
     $sql_update_setalert = "update alert_configuration set user_id='$user_id',vehicle_no='$vehicle_id',alrt_type='$alert_type',alert_set_type='$set_type',parameter_over_speed='',idle_hrs='',idle_alert_time='',mobile='$mobile_no',email_id='$email_id',status='$status',updated_on='$add_time'  where parent_id='$parent_user_id' and alrt_config_id='$alert_id'";
   }



 if(mysqli_query($conn2,$sql_update_setalert))
     {
     	 $response['success_msg'] = 'Alert set successfully';
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