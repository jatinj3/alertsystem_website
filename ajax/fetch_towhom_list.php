<?php
include('../config/connect.php');
 if(!empty($_POST['parent_id']))
 {
   session_start();
  
    $parent_id = $_POST['parent_id'];
   
   $response = array();
   
  if(!empty($parent_id))
   {

   $poi_users ="select * from alert_users_details where parent_id=$parent_id";

  

   if($query_result = mysqli_query($conn2,$poi_users))
       {
          $html ="<option value=''>Select</option>";
         while($data = mysqli_fetch_object($query_result))
         {
			 $namedata=$data->name."-".$data->mobile_number;
			// print_r($data);
            //$html .="<option value='".$data->veh_reg."'>$data->veh_reg</option>";
             $html .="<option value='".$data->name."~".$data->srl_id."'>$namedata</option>";
         }
         echo $html;exit;
        
       } 
    
   }

 }
 
?>