<?php
include('../config/connect.php');
 if(!empty($_POST['parent_id']))
 {
   session_start();
  
    $parent_id = $_POST['parent_id'];
   
   $response = array();
   
  if(!empty($parent_id))
   {

    $poi_users ="select * from pois where sys_user_id=$parent_id";

  

   if($query_result = mysqli_query($conn,$poi_users))
       {
          //$html ="<option value=''>Select</option>";
          $html ="<option value=''>All</option>";
         while($data = mysqli_fetch_object($query_result))
         {
            //$html .="<option value='".$data->veh_reg."'>$data->veh_reg</option>";
             $html .="<option value='".$data->name."@".$data->id."'>$data->name</option>";
             //$html .="<option value='".$data->name."'>$data->name</option>";
         }
		 //$html .="<option value=''>All</option>";
         echo $html;exit;
        
       } 
    
   }

 }
 
?>