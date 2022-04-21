<?php
include('../config/connect.php');
 if(!empty($_POST['alert_id']))
 {
   session_start();
   $parent_user_id = $_SESSION['cntrl_p']['UserId'];
   $alert_id = $_POST['alert_id'];
   
   $response = array();
   
   if(!empty($alert_id))
   {
    
    // query fetch alert list
    $sql_fetch_alerts = "select * from alert_configuration where alrt_config_id='$alert_id' and parent_id='$parent_user_id'";
  

   if($query_result = mysqli_query($conn2,$sql_fetch_alerts))
       {

        $response['data'] = mysqli_fetch_object($query_result);
        
       } 
     else {
         
           $response['error_msg'] = 'Someting went wrong try again!!!';
         }
   }

 } else {
    $response['error_msg'] = 'Invalid request';
 }
 

    echo json_encode($response);exit;
?>