<?php
include('../config/connect.php');
 if(!empty($_POST['user_id']))
 {
   session_start();
  
    $user_id = $_POST['user_id'];
   
   $response = array();
   
  if(!empty($user_id))
   {

    $sel_group_users = mysqli_query($conn,"select * from group_users  where  sys_user_id=$user_id");
    $result_group_user = mysqli_fetch_object($sel_group_users);

    $user_group_id = $result_group_user->sys_group_id; //user group id
    
    // query fetch alert list
    $sql_fetch_alerts = $sql_service_list = "select a.sys_service_id,b.veh_reg  from group_services a,services b WHERE a.sys_service_id=b.id AND a.active=true AND a.sys_group_id='$user_group_id'";
  

   if($query_result = mysqli_query($conn,$sql_fetch_alerts))
       {
         //$html ="<option value=''>Select Vehicle no.</option>";
         $html ="";
         while($data = mysqli_fetch_object($query_result))
         {
            // $html .="<option value='".$data->veh_reg."'>$data->veh_reg</option>";
      $html .="<option value='".$data->veh_reg."#".$data->sys_service_id."'>$data->veh_reg</option>";
         }
         echo $html;exit;
        
       } 
    
   }

 }
 
?>