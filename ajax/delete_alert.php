<?php
include('../config/connect.php');

 if(!empty($_POST['alert_id']))
 {
   session_start();
   $parent_user_id = $_SESSION['cntrl_p']['UserId'];
   $alert_id   = $_POST['alert_id'];
   
   $delete_query = "delete from  alert_configuration where alrt_config_id='$alert_id' and parent_id='$parent_user_id'";

 if(mysqli_query($conn2,$delete_query))
     {
     	 $response['success_msg'] = 'Alert deleted successfully';
     } 
 else {
     	  $response['error_msg'] = 'Something went wrong try again!!!';
      }

 } 
 else {
 	      $response['error_msg'] = 'All input fields are mandatory';
      }


    echo json_encode($response);exit;
?>