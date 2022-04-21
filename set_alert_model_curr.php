 <?php
 function getRows_new($query)
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
 function getAll_main_user_new($parent_user_id)
{
    if(!empty($parent_user_id))
        {
           $sql_user_list = "select a.sys_username as username,b.sys_username,a.email_address,a.mobile_number,a.id AS userid,b.sys_parent_user from users a,users b where a.sys_parent_user=b.id and b.id='$parent_user_id' and a.sys_active=1";


          if($rows = getRows_new($sql_user_list))
              {
                return $rows;
              } else {
                  return false;
              }
         } else {
           return false;
         }
}
 ?>
 <html>
 <head>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>-->
	<link href="assets/magicsuggest/magicsuggest.css" rel="stylesheet">
	<script src="assets/jquery/jquery-1.11.1.min.js"></script>
	<script src="assets/magicsuggest/magicsuggest.js"></script>
	<!--<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
 </head>
 <body>
 <div id="set_alert_model" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Add New Alert</h4>
        </div>
        <div class="modal-body">
            <!-- <div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1"> -->
             <div class="row">
                  <form role="form">
                     <!-- column start -->
                    <div class="col-md-6">
                         <!-- alert user list-->
                        <div class="form-group">
						<input type=hidden id="abcId" name="abcName"/>
                          <label>Users</label>
                            <select class="form-control chzn-select" id="user_id" onchange="filter_vehicles(this.value),fetch_users_details_alert(this.value)"> 
                              <option value="">Select User</option>
                              <option value="<?php 
							  if(!empty($parent_user_id))
							  {
								 echo $parent_user_id; 
							  }
							  else{
								  echo $parent_user_id=$_REQUEST['parent_user_id'];
							  }
							   ?>">Parent User</option>
                             <?php 
								if(isset($_REQUEST['parent_user_id']))
								{
								$user_result = getAll_main_user_new($parent_user_id);	
								}
								else{
								$user_result = getAll_main_user($parent_user_id);
								}
									
                             if($user_result)
                                 {
                                    for($ui=0;$ui<count($user_result);$ui++)
                                            { 
                                             
 
                             ?>
                           <option value="<?php echo $user_result[$ui]->userid; ?>"><?php echo $user_result[$ui]->username; ?></option>

                             <?php } } ?>
                           </select>
                            <font style="color:red;"><span id="show_error_user"></span></font>
                        </div>
                        <!-- alert user list -->



                         <!--  vendor vehcile list -->
                        <div class="form-group">
                          <label>Mobile</label>
                              <input type="text" class="form-control"  id="mob_id" placeholder="Mobile number" />
                              <font style="color:red;"><span id="show_error_mobile"></span></font>
                        </div>
                        <!-- vendor vehicle list -->


                        <!--  vendor vehcile list -->
                        <div class="form-group">
                          <label>Email</label>
                            <input type="text" class="form-control"  id="email_id" placeholder="Email id" />
                             <font style="color:red;"><span id="show_error_email"></span></font>
                        </div>

            <div class="row">
              <div class="col-md-8">
                   <div class="form-group">
                    <label>Vehicle List</label>
                     <input class="form-control" id="vehicle_id" name="vehicle_names[]">
                    <!-- <option value="">Select Vehicle</option>
                     <option value="abc">abc</option>
                     <option value="def">def</option>
                     <option value="ghi">ghi</option>
                     <option value="jkl">jkl</option>-->
                        <?php  
                        // if($vehicle_list = getAll_vehicles_by_sys_groupID($sys_group_id))
                             // {
								 // echo "<pre>";
								 // print_r($vehicle_list);
                              //for($vi=0;$vi<count($vehicle_list);$vi++)
                                  // {

                          ?>
                        <!-- <option value="<?php //echo $vehicle_list[$vi]->veh_reg; ?>"><?php //echo $vehicle_list[$vi]->veh_reg; ?></option> -->
                      <?php //} //} ?>
                       
                     <!--</select>-->
                     <font style="color:red;"><span id="show_error_vehicle"></span></font>
                  </div>

                <!-- vendor vehicle list -->
              </div>
                 <!-- <div class="col-md-4"> -->
                  <div class="form-group">
                    <div class="input-group">
                      <label><strong>All vehicles</strong></label>
                      <input type="checkbox" class="form-control"  name="set_all_veh" id="set_all_veh">
					  <!--<input type="text" class="form-control" value="<?php echo @$_REQUEST['passval'];?>">-->
                    </div>
                  </div>
                 <!-- </div> -->
          </div>
              <!--  vendor vehcile list -->
      </div>
    <!-- first column end -->
                  

                  <!-- column start  -->
                     <div class="col-md-6">
                        <div class="form-group">
                          <label>Alert Type</label>
                            <select class="form-control chosen-select chzn-select" id="alert_type_id" onchange="show_hide(this.value)"> 
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

                      
                      <!-- alert list according to alert type start -->
                        <div class="form-group" id="default_show">
                          <div class="input-group">
                            <!-- <input type="text" class="form-control input-xsmall">  -->
                            <br/><br/>
                            <label><strong>Set Alert</strong></label>
                            <input type="checkbox" class="form-control" id="is_set" checked="true">
                          </div>
                        </div>
                      <!-- alert list according to alert type end -->

             <!-- alert list according to alert type start -->
              <div class="form-group" id="parameter_show_ovrspeed" style="display:none;">

                <label class="mt-checkbox"><strong>SPEED > 40 </strong></label>
                   <input type="text" class="form-control input-small" placeholder=" > 40" id="over_speed_para" onkeyup="validate_para_overspeed(this.value)" />
                  <font style="color:red;"><span id="show_error_speed_para"></span></font>
              </div>
            <!-- alert list according to alert type end -->


              <!-- alert idle hour parameter -->
                <div class="form-group" id="parameter_show_idle" style="display:none;">
                  <br/>
                  
               <div class="row" style="margin-bottom: 8px;">
                      <div class="col-md-10"><strong>SET TO 24 X 7 HRs</strong></div>
                       <div class="col-md-2"> <input type="radio" name="idle_type" id="idle_type_24hrs" class="form-control" value="24 hrs" checked="true"></div>
               </div>
                 
                <div class="row" style="margin-bottom: 8px;">
                  <div class="col-md-10">
                    <strong>TIME BETWEEN 10 AM To 9 PM</strong>
                  </div>

                    <div class="col-md-2">
                      <input type="radio" name="idle_type" id="idle_type_10_to_9" value="10 to 9 pm" class="form-control" />
                    </div>

               </div>
                  
                  <!-- idle hours section  -->
                  <div class="row"> 
                      <div class="col-md-5">
                         <strong>Idle Hours</strong>
                      </div>
                    <!-- idle hr value -->
                     <div class="col-md-7">
                         <input type="text" name="idle_halting_hrs" id="idle_halting_hrs"  class="form-control" placeholder="Idle Hours" />
                     </div>
                  <!-- idle hr value -->
                 </div>
                 <!-- idle hours section  -->

                </div>

                 


              <!-- alert idle hour parameter-->

                     
                          
             </div>
        <!-- column end -->
                     </form>
                </div>
            <!-- </div> -->
           </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
            <button type="button" class="btn green" onclick="submit_set_alert()">Save changes</button>
        </div>
    </div>
    </div>
</div>
 </body>
 </html>


<script>
  
function show_hide(type_alert)
{
  
   if(type_alert=='Panic Alert' || type_alert=='POI Alert' || type_alert=='Ac Alert' || type_alert=='Document Alert' || type_alert=='Fuel Alert' || type_alert=='Night Drive' || type_alert=='Main power cut off')
   {
      $("#parameter_show_ovrspeed").hide();
      $("#parameter_show_idle").hide();
      $("#default_show").show();
   } 
    else if(type_alert=='OverSpeed')
      {
        $("#default_show").hide();
        $("#parameter_show_idle").hide();
        $("#parameter_show_ovrspeed").show();
      } 
    else if(type_alert=='Idle Alert')
      {
        $("#default_show").hide();
        $("#parameter_show_ovrspeed").hide();
        $("#parameter_show_idle").show();
      }

}



function validate_para_overspeed(ovr_speed_val)
 {

    if(isNaN(ovr_speed_val))
    {
          $("#show_error_speed_para").html('Only number allowed');
          $("#over_speed_para").val('');
          $("#over_speed_para").focus();

    }
     else 
      {
         if(ovr_speed_val < 40 || ovr_speed_val > 180)
           {
              $("#show_error_speed_para").html('Invalid speed value');
           } else {
              $("#show_error_speed_para").html('');
           }
      }
  
}

// fetch vehicles userbies 





function passdata(data)
{
	alert(data+"pass_data");
var da = data;

	$.ajax({
                    type: 'GET',
                    url: 'set_alert_model.php',
                    data: {passval: da,parent_user_id:<?=$parent_user_id;?> },
                    success: function(getreturn)
                    {
                     // alert("success!:" + getreturn);
					 
                    }

        });
		
}
// function end 


// fetch users details mobile and email id alert
function fetch_users_details_alert(user_id) 
{
    var datastring = 'user_id='+ user_id; // query string
      
    $.ajax({
            type: "POST",
            data:datastring,
            dataType: 'JSON',
            url:'ajax/fetch_users_details_alert.php',
            success: function(data)
              {
                $("#email_id").val(''); // email id
                $("#mob_id").val(''); // mobile number
                
              if(data.mobile_number!="" && data.mobile_number!=undefined)
                {
                   $("#mob_id").val(data.mobile_number); // mobile number
                } 

               if(data.email_id!="" && data.email_id!=undefined)
                  {
                     $("#email_id").val(data.email_id); // email id
                  } 
                  

              }
          });
}

//var jqr = jQuery.noConflict();
var user_id;
function filter_vehicles(user_id)
	 {
		//alert(user_id);
		var datastring = 'user_id='+ user_id;
		var $jq = jQuery.noConflict();
		$jq("#vehicle_id").magicSuggest();
		
		
		$jq('#vehicle_id').magicSuggest({
		data: 'ajax/fetch_vehicle_list.php?user_id='+user_id,
		valueField: 'id',
		displayField:'name' 
		});
		
	  }
 
 



		
	   
 



//alert(datastring);
//filter_vehicles()
//alert(document.getElementById('abcId').value);



//var $vhl = jQuery.noConflict();



/*function doSomething(param) {
     
    //do something with your parameter
    //console.log(param);
	 window.value=param;
	console.log(window.value);
	 // jQuery(".livesearch").chosen({
        // width: '100%',
        // allow_single_deselect: true
     // });
	// console.log(window.value);
	 jQuery('.livesearch').append(window.value);
	 jQuery('.livesearch').trigger("chosen:updated");

}*/
// fetch users details mobile and email alerts

 //var datastring='user_id='+ '80972';
 //console.log(datastring)

 // $(".livesearch").chosen({
        // width: '100%',
        // allow_single_deselect: true
     // });
	// console.log(window.value);
	// $('.livesearch').append(window.value);
	 //$('.livesearch').trigger("chosen:updated");
	 //console.log(newhtml);
	 //$("#vehicle_id").val()
	// $("#vehicle_id").on('change',function(){
    // var getValue=$(this).val();
    // alert(getValue);
  // });
</script>




