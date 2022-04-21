<?php
include('../config/connect.php');
 if(!empty($_POST['user_id']))
 {
   session_start();
  
   $user_id = $_POST['user_id']; // sub user id
   $parent_user_id = $_SESSION['cntrl_p']['UserId']; // session user id
   
   $response = array();
   
  if(!empty($user_id))
   {
    
    // query fetch alert list
    $sql_getUsersDetails= "select mobile_number,email_id from alert_users_details where parent_id='$parent_user_id' and srl_id='$user_id' LIMIT 1";

   if($query_result = mysqli_query($conn2,$sql_getUsersDetails))
       {
         $data = mysqli_fetch_object($query_result); // fetch the data fo t
         echo json_encode($data);exit;
       } 
    
   }

 }
 
?>