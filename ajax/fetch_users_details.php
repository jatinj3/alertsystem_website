<?php
include('../config/connect.php');
 if(!empty($_POST['user_id']))
 {
   session_start();
   $parent_user_id = $_SESSION['cntrl_p']['UserId'];
   $user_id = $_POST['user_id'];
   
   $response = array();
   
   if(!empty($alert_id))
   {
    
    // query fetch alert list
    echo $sql_fetch_details = "select * from alert_users_details where user_id='$user_id' and parent_id='$parent_user_id'";
  

   if($query_result = mysqli_query($conn2,$sql_fetch_details))
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