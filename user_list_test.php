<?php 
session_start();
include_once('header2.php');
include_once('common_functions/functions.php');
include_once('config/connect.php'); // configuration file database
$parent_user_id = $_SESSION['cntrl_p']['UserId'];
if(isset($_POST['submit']))
 {
//echo "<pre>";
//print_r($_POST); die;
$user_id=$_POST['user_id'];
if(@$_POST['vehicle_id']!='')
{
$vehicle_num_id=$_POST['vehicle_id'];

$vehicle_num_id_temp=explode("#",$vehicle_num_id);

$vehicle_num=$vehicle_num_id_temp[0];

$vehicle_id=$vehicle_num_id_temp[1];
}
else{
	$vehicle_num='';
}

//if($_POST['alert_type_id']!='')
 $alert_type=$_POST['alert_type_id'];
 }
 //}
 // else{
	 // $alert_type=''; 
 // }
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Manage Alerts
                       <!--  <small>managed datatable samples</small> -->
                    </h3>
                    <!-- END PAGE TITLE-->
               
                    <div class="row">
					
                        <div class="col-md-12">
						
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
							<div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Manage Alerts</span>
                                    </div>
                                </div>
						<form role="form" action="" method="post">
							<div class="row">
							 <div class="col-md-3">
							 
							 <select class="form-control livesearch" id="user_id" onchange="filter_vehicles(this.value)" name="user_id">
                              <option value="">Select User</option>
                              <option value="<?php echo $parent_user_id ?>">Parent User</option>
                             <?php 

                             if($user_result = getAll_main_user($parent_user_id))
                                 {
                                    for($ui=0;$ui<count($user_result);$ui++)
                                            { 
                                             
 
                             ?>
 <option value="<?php echo $user_result[$ui]->userid; ?>"><?php echo $user_result[$ui]->username; ?></option>

                             <?php } } ?>
                           </select>
						   </div>
						    <div class="col-md-3">
						   <select class="form-control livesearch" id="vehicle_id" name="vehicle_id" >
                              <option value="">Select Vehicle</option>
							  
                           </select>
						    </div>
							<div class="col-md-3">
						   <select class="form-control livesearch" id="alert_type_id" name="alert_type_id">
								<option value="">Select alert type</option>
                                <option value="Panic Alert">Panic Alert</option>
                                <option value="POI Alert">POI Alert</option>
                                <option value="Fuel Alert">Fuel Alert</option>
                                <option value="Main power cut off">Main power cut off</option>
                                <!-- <option value="Service Alert">Service Alert</option> -->
                                <option value="Night Drive">Night Drive</option>
                                <option value="Ac Alert">Ac Alert </option>
                                <option value="Document Alert">Document Alert </option>
                                <option value="Idle Alert">Idle Alert</option>
                                <option value="OverSpeed">OverSpeed Alert</option>
                           </select>
						   </div>
						   <div class="col-md-1">
							<input type="submit" class="btn green" name="submit"/>
							
							</div>
							<div class="col-md-2">
<button onclick="testhello()" name="delete" type="button" class="btn btn-success text-uppercase">Delete</button>
							</div>
						   </div>
                               </form>
                                <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th>
        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
												<th>Srl No</th>
												<th>Username</th>
												<th>To whom</th>
                                                <th>Vehicle No</th>
                                                <th>Alert Type</th>
                                                <th>POI Alert On Entry/Exit</th>
                                                <!-- <th>Set Type</th> -->
                                                <th>Speed Level</th>
                                                <th>Idle Alert From Time</th>
                                                <th>Idle Alert To Time</th>
                                                <th>Idle Hours</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <!--<th>Action</th>-->
                                            <!--<th>Username</th>
                                            <!--<th>Email</th>
                                            <th>Mobile</th>-->
                                            <!--<th>Actions</th>-->
                                        </tr>
                                        </thead>
                                        <tbody>
									<?php 
	if(!empty($user_id)  && !empty($parent_user_id) && !empty($vehicle_num))
											{
												//echo $alert_type;
												//echo "inif";
											//$alert_list=getAll_alerts();
				$alert_list=getAll_alerts_byfilter($user_id,$parent_user_id,$vehicle_num,$alert_type);
											}
											else if(!empty($user_id))
											{
											//echo "inif_userid";	
				$alert_list=getAll_alerts_byfilter($user_id,$parent_user_id,$vehicle_num,$alert_type);
											}
											else{
											$alert_list=getAll_alerts($parent_user_id);	
											}
											
											
                                    $index =1;
                                    //if($alert_list = getAll_alerts($parent_user_id))
                                    if($alert_list)
                                        {
                                           // echo "<pre>";
										// print_r($alert_list);										   
                                         for($al=0; $al <count($alert_list);$al++)
                                             {
                                                
                                             ?>
                               <tr class="odd gradeX">
									<td><input type="checkbox" class="checkboxes" name="newcheck" value="<?php echo $alert_list[$al]->alrt_config_id;?>" /> </td>
                                                    <td><?php echo $index;?></td>
                                                    <td><?php 
													$user_id_temp=$alert_list[$al]->user_id;
													if($user_id_temp==$parent_user_id)
													{
														echo $qwe='Parent User';
													}
													else{
														$getuser=getAll_main_user_new($parent_user_id,$user_id_temp);
														echo $getuser[0]->username;
													}
													
													
													
													?></td>
													<td><?php echo $alert_list[$al]->towhom;?></td>
                                                    <td><?php echo $alert_list[$al]->vehicle_no;?></td>
                                                    <td><?php echo $alert_list[$al]->alrt_type;?></td>
                                                    <td><?php echo $alert_list[$al]->poientryexit;?></td>
                                                    <!-- <td><?php //echo $alert_list[$al]->alert_set_type;?></td> -->
                                                    <td><?php echo $alert_list[$al]->parameter_over_speed;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_alert_from_time;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_alert_to_time;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_hrs;?></td>
                                                    <td><?php echo $alert_list[$al]->mobile;?></td>
                                                    <td><?php echo $alert_list[$al]->email_id;?></td>
                                                    <td><?php echo $alert_list[$al]->status;?></td>
                                                    <!--<td>
                                                    <a class="btn blue" data-toggle="modal" href="#edit_set_alert_model" onclick="fetch_alert('<?php echo $alert_list[$al]->alrt_config_id;?>')"><i class="fa fa-edit"></i></a>
                                                    <a href="javascript:;" class="btn red" onclick="delete_alert('<?php echo $alert_list[$al]->alrt_config_id;?>')"><i class="icon-trash"></i></a>
                                                </td>-->
                                            </tr>
                                   
                                        <?php $index++; } } ?>
                               <!--other-->             

                            <?php 
/*
 $sql_sub_users = "select a.sys_username as username,b.sys_username,a.email_address,a.mobile_number,a.id AS userid,b.sys_parent_user from users a,users b where a.sys_parent_user=b.id and b.id='$parent_user_id' and a.sys_active=1";

                                    if($qry_result = mysqli_query($conn,$sql_sub_users))
                                         {
                                            
                                          if($qry_result->num_rows > 0)
                                              {
                                                while($result_data = mysqli_fetch_object($qry_result))
                                                    {
                                               
                                     ?>
                                            <tr class="odd gradeX">
                                                <td>
                                                    <input type="checkbox" class="checkboxes" value="1" /> </td>
                                                <td><?php echo $result_data->username;?> </td>
                                                <!--<td><?php echo $result_data->email_address;?> </td>-->
                                               <!-- <td><?php echo $result_data->mobile_number;?> </td>-->
                                                <td class="right"><a href="vendor_vehicle_list_view.php?u_id=<?php echo $result_data->userid; ?>" class="btn sbold green">Vehicles</a>
                                                    <!-- <a href="#" class="btn sbold green">User Details</a> -->
                                                </td>
                                            </tr>
                                           
                                       <?php } }}*/ ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                   
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
		
		<script>
		var $vhl = jQuery.noConflict();
		
		function testhello()
		{
			
			
			/*var data = '';
			$vhl("#sample_1 .checkboxes").each(function() {
				 data += $vhl(this).val()+',';  
			});
				
			console.log(data);*/
			if(confirm('Are You Sure Want To Delete?'))
			{

            var favorite = [];
            $vhl.each($("input[name='newcheck']:checked"), function(){            
                favorite.push($(this).val());
            });
			
			var data_temp=favorite.toString();
			//var data= 'alert_id='+ data_temp;
			//console.log(data);
			if(data_temp!='')
			 {
				 var data= 'alert_id='+ data_temp;
		     $vhl.ajax({
			    type:'post',
			    url:'ajax/delete_all_alert.php',			    
				data:data,	             
	             success:function(response)
	              {
					  console.log(response);
				   obj = JSON.parse(response);
				   if(obj.success_msg)
				   {
					 alert(obj.success_msg); 
					 window.location.reload();
				   }
				   else{
					 alert(obj.error_msg);   
				   }   
		           
				   
	              }
		        });
			 }
			 else{
				 alert('Please Select Atleast One Row For Delete');
			 }
            //alert("My favourite sports are: " + favorite.join(", "));
			}
			
		}
		 //var $vhl = jQuery.noConflict();
function filter_vehicles(user_id)
{

    var datastring = 'user_id='+ user_id;
      
   $.ajax({
          type: "POST",
          data:datastring,
          url:'ajax/fetch_vehicle_list.php',
          success: function(data)
            {
				$vhl("#vehicle_id").html(data);
                $vhl("#vehicle_id").trigger("chosen:updated");
            }
          });
}

		$vhl(".livesearch").chosen({
        width: '100%',
		allow_single_deselect: true,
		search_contains:true,
		max_selected_options: 4
			});
			// $vhl(".livesearchnew").chosen({
        // width: '100%',
		// allow_single_deselect: true,
		// search_contains:true,
			// });
		</script>
<?php 

include_once('footer2.php');

?>