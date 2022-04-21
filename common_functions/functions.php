<?php


// get rows to qeury against the sql query
function getRows($query)
 {
  include('config/connect.php'); //connection files
  $return_data[]= array();
  $query_result = mysqli_query($conn,$query);
   if($query_result->num_rows)
   {
     while($data = mysqli_fetch_object($query_result))
       {
          $row[] = $data; // rows data
       }
     if(sizeof($row) > 0)
       {
         return $row;
       }
   } else {
     return false;
   }


}
// get rows query end

function getRows_local($query)
 {
  include('config/connect.php'); //connection files
  $return_data[]= array();
  $query_result = mysqli_query($conn2,$query);
   if($query_result->num_rows)
   {
     while($data = mysqli_fetch_object($query_result))
       {
          $row[] = $data; // rows data
       }
     if(sizeof($row) > 0)
       {
         return $row;
       }
   } else {
     return false;
   }


}
// get rows query end


//get all vehicles by sys group id
function getAll_vehicles_by_sys_groupID($user_group_id)
{
    if(!empty($user_group_id))
        {
          $sql_service_list = "select *  from group_services a,services b WHERE a.sys_service_id=b.id AND a.active=true AND a.sys_group_id='$user_group_id'";
          if($rows = getRows($sql_service_list))
              {
                return $rows;
              } else {
                  return false;
              }
         } else {
           return false;
         }
}



//get all  main user
function getAll_main_user($parent_user_id)
{
    if(!empty($parent_user_id))
        {
            $sql_user_list = "select a.sys_username as username,b.sys_username,a.email_address,a.mobile_number,a.id AS userid,b.sys_parent_user from users a,users b where a.sys_parent_user=b.id and b.id='$parent_user_id' and a.sys_active=1";


          if($rows = getRows($sql_user_list))
              {
                return $rows;
              } else {
                  return false;
              }
         } else {
           return false;
         }
}

function getAll_main_user_new($parent_user_id,$user_id)
{
    if(!empty($parent_user_id))
        {
           $sql_user_list = "select a.sys_username as username,b.sys_username,a.email_address,a.mobile_number,a.id AS userid,b.sys_parent_user from users a,users b where a.sys_parent_user=b.id and b.id='$parent_user_id' and a.id='$user_id' and a.sys_active=1";


          if($rows = getRows($sql_user_list))
              {
                return $rows;
              } else {
                  return false;
              }
         } else {
           return false;
         }
}

//get all  set alerts
function getAll_alerts($parent_user_id)
{
    if(!empty($parent_user_id))
        {
           $sql_alert_list = "select * from  alert_configuration where parent_id='$parent_user_id'";


          if($rows = getRows_local($sql_alert_list))
              {
                return $rows;
              } else {
                  return false;
              }
         } 
		 else {
           return false;
         }
}



//get all  set alerts
/*
function getAll_alerts_byfilter($user_id,$vehicle_no)
{
    if(!empty($user_id))
        {
           $sql_alert_list = "select * from  alert_configuration where user_id='$user_id' and vehicle_no='$vehicle_no'";


          if($rows = getRows_local($sql_alert_list))
              {
                return $rows;
              } else {
                  return false;
              }
         } else {
           return false;
         }
}
*/
function getAll_alerts_byfilter($user_id='',$parent_id,$vehicle_no='',$alert_type='')
{
	        //  echo $sql_alert_list = "select * from  alert_configuration where user_id='$user_id' and vehicle_no='$vehicle_no' and parent_id='$parent_id' and alrt_type='$alert_type' ";die;
    if(!empty($user_id) && !empty($parent_id) && !empty($vehicle_no) && !empty($alert_type))
        {
			//echo "hiqwe";
           $sql_alert_list = "select * from  alert_configuration where user_id='$user_id' and vehicle_no='$vehicle_no' and parent_id='$parent_id' and alrt_type='$alert_type' ";


          if($rows = getRows_local($sql_alert_list))
              {
                return $rows;
              } else {
                  return false;
              }
         } else if(empty($alert_type) && !empty($user_id) && !empty($parent_id) && !empty($vehicle_no) ) {
			 //echo "qwerty";
			   $sql_alert_list = "select * from  alert_configuration where user_id='$user_id' and vehicle_no='$vehicle_no' and parent_id='$parent_id' ";
			  if($rows = getRows_local($sql_alert_list))
              {
                return $rows;
              } else {
                  return false;
              }
           //return false;
         }
		 else if(empty($vehicle_no) && empty($alert_type)){
			  $sql_alert_list = "select * from  alert_configuration where user_id='$user_id' and  parent_id='$parent_id' ";
			  if($rows = getRows_local($sql_alert_list))
              {
                return $rows;
              } else {
                  return false;
              }
		 }
		 else{
			 return false;
		 }
}




?>