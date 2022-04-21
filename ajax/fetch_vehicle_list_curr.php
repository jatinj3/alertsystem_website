<?php
include('../config/connect.php');
 if(!empty($_GET['user_id']))
 {
   session_start();
  
   $user_id = $_GET['user_id'];
   
   $response = array();
   
  if(!empty($user_id))
   {
	      $mysql = new mysqli('203.115.101.62','for124','123456','matrix');
    /*$result = $mysql->query("select * from countries");
    $rows = array();
    while($row = $result->fetch_array(MYSQL_ASSOC)) {
        $rows[] = array_map("utf8_encode", $row);
    }
    echo json_encode($rows);
    $result->close();
    $mysql->close();*/

 
    $sel_group_users = mysqli_query($conn,"select * from group_users  where  sys_user_id=$user_id");
    $result_group_user = mysqli_fetch_object($sel_group_users);

    $user_group_id = $result_group_user->sys_group_id; //user group id
    
    // query fetch alert list
    $sql_fetch_alerts = $sql_service_list = "select a.sys_service_id as id,b.veh_reg as name from group_services a,services b WHERE a.sys_service_id=b.id AND a.active=true AND a.sys_group_id='$user_group_id'";
	
	$result = $mysql->query($sql_fetch_alerts);


		$rows = array();

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
		$rows[] = array_map("utf8_encode", $row);
		}
		echo json_encode($rows); 
		 
		$result->close();
		$mysql->close();








  /* if($query_result = mysqli_query($conn,$sql_fetch_alerts))
       {
          $html ="";
		  
         while($data = mysqli_fetch_object($query_result))
         {
            // $html .="<option value='".$data->veh_reg."'>$data->veh_reg</option>";
             $html .="<option value='".$data->veh_reg."#".$data->sys_service_id."'>$data->veh_reg</option>";
         }
         echo $html;exit;
        
       }*/ 
    
   }

 
 
 
/*include_once('../config.php');
$mysql = new mysqli(__DB_HOST,__DB_USER,__DB_PASSWORD,__DB_DATABASE, __DB_PORT);
$mysql_staging = new mysqli(__DB_HOST_STAGING,__DB_USER_STAGING,__DB_PASSWORD_STAGING,__DB_DATABASE_STAGING, __DB_PORT);

$UserId = $_SESSION['UserId'];
     $Action = isset($_GET['action']) ? $_GET['action'] : "";
$groupId = $_SESSION['sys_group_id'];*/





// CONCAT('vehicle#',id) as id

 /*if (in_array($_SESSION['UserId'], $vehicle_route)) 
{
	
$result = $mysql->query("select   id ,CONCAT(veh_reg,' ',route_no)  as name from services where id in 
(select distinct sys_service_id from group_services where active=true and sys_group_id =".$groupId.")");
}
else
{
$result = $mysql->query("select   id ,veh_reg as name from services where id in 
(select distinct sys_service_id from group_services where active=true and sys_group_id =".$groupId.")");

}*/

//print_r($result);die;


 }
?>
 
 
 
 
 
 
 
 
 