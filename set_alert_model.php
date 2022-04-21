 <html>
 <head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
	<!--<link href="assets/magicsuggest/magicsuggest.css" rel="stylesheet">
	<script src="assets/jquery/jquery-1.11.1.min.js"></script>
	<script src="assets/magicsuggest/magicsuggest.js"></script>-->
  <!--<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
  <link rel="stylesheet" type="text/css" href="css/timePicker.css">
 </head>
 <body>
 <script type="text/javascript" src="js/jquery-timepicker.js"></script>
 <script>
/*	$vhl().ready(function(e) {

		// $('#timePicker').hunterTimePicker({
		// 	callback: function(e){
		// 		alert(e.val());
		// 	}
		// });
		
		$vhl(".time-picker").hunterTimePicker();
	});*/
</script>
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
                          <label>Users</label>
                          <!-- <select class="form-control livesearch" id="user_id" onChange="filter_vehicles(this.value),filter_to_whom(this.value),filter_poi(this.value)"> -->
 <select class="form-control livesearch" id="user_id" onChange="filter_vehicles(this.value),filter_to_whom(this.value)"> 
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
                            <font style="color:red;"><span id="show_error_user"></span></font>
                        </div>
                        <!-- alert user list -->



                         <!--  vendor vehcile list -->
						 <div class="form-group">
						<label>To whom</label>
						  <!-- <select class="form-control livesearch" multiple id="to_whom" onchange="fetch_users_details_alert(this.value)">-->
						   <select class="form-control livesearch" multiple id="to_whom">
						   </select>
						
						</div>
                        <!--<div class="form-group">
                          <label>Mobile</label>
                              <input type="text" class="form-control"  id="mob_id" placeholder="Mobile number" disabled />
                              <font style="color:red;"><span id="show_error_mobile"></span></font>
                        </div>-->
                        <!-- vendor vehicle list -->


                        <!--  vendor vehcile list -->
                        <!--<div class="form-group">
                          <label>Email</label>
                            <input type="text" class="form-control"  id="email_id" placeholder="Email id" disabled />
                             <font style="color:red;"><span id="show_error_email"></span></font>
                        </div>-->
						<!--<div class="form-group">
						<label>To whom</label>
						   <select class="form-control livesearch"  id="to_whom">
						   
						   </select>
						
						</div>-->

            <div class="row">
              <div class="col-md-8">
                   <div class="form-group">
                    <label>Vehicle List</label>
                     <select class="form-control livesearch"  id="vehicle_id">
                  
                        <?php  
                        if($vehicle_list = getAll_vehicles_by_sys_groupID($sys_group_id))
                             {
								 // echo "<pre>";
								 // print_r($vehicle_list);
                              //for($vi=0;$vi<count($vehicle_list);$vi++)
                                  // {

                          ?>
                        <!-- <option value="<?php //echo $vehicle_list[$vi]->veh_reg; ?>"><?php //echo $vehicle_list[$vi]->veh_reg; ?></option> -->
                      <?php } //} ?>
                       
                     </select>
                     <font style="color:red;"><span id="show_error_vehicle"></span></font>
                  </div>

                <!-- vendor vehicle list -->
              </div>
                 <!-- <div class="col-md-4"> -->
                  <div class="form-group">
                    <div class="input-group">
                      <label><strong>All vehicles</strong></label>
                      <input type="checkbox" class="form-control"  name="set_all_veh" id="set_all_veh">
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
                          <select class="form-control chosen-select livesearch" id="alert_type_id" onChange="show_hide(this.value),filter_poi(<?php echo $parent_user_id;?>)"> 
                           <!-- <select class="form-control chosen-select livesearch" id="alert_type_id" onChange="show_hide(this.value)">  -->
								                <option value="">Select</option>
                                <option value="Panic Alert">Panic Alert</option>
                                <option value="POI Alert">POI Alert</option>
                               <!-- <option value="Fuel Alert">Fuel Alert</option>-->
                                <option value="Main power cut off">Main power cut off</option>
                                <!-- <option value="Service Alert">Service Alert</option> 
                                <option value="Night Drive">Night Drive</option>-->
                                <option value="Ac Alert">Ac Alert </option>
                                <!--<option value="Document Alert">Document Alert </option>-->
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
                   <input type="text" class="form-control input-small" placeholder=" > 40" id="over_speed_para" onKeyUp="validate_para_overspeed(this.value)" />
                  <font style="color:red;"><span id="show_error_speed_para"></span></font>
              </div>
			  <div class="form-group" id="parameter_show_poi" style="display:none;">

               
						 <div class="form-group">
                          <label>POI Name</label>
                            <select class="form-control chosen-select livesearchnew" multiple id="poi_id" > 
                           
                           </select>
                        </div>	
                   <!--<input type="text" class="form-control input-small" placeholder=" > 40" id="over_speed_para" onkeyup="validate_para_overspeed(this.value)" />
                  <font style="color:red;"><span id="show_error_speed_para"></span></font>-->
                  <div class="form-group">
                          <label>Option</label>
                            <select class="form-control chosen-select livesearchnew" id="entryexit" > 
                            <option value="">Select</option>
                                <option value="entry">entry</option>
                                <option value="exit">exit</option>
                                <option value="entryexitboth">entry and exit both</option>
                           </select>
                        </div>	





              </div>
            <!-- alert list according to alert type end -->


              <!-- alert idle hour parameter -->
                <div class="form-group" id="parameter_show_idle" style="display:none;">
                  <br/>
                  
               <div class="row" style="margin-bottom: 8px;">
               <div class="col-md-5"><strong>From Time</strong></div>
               <!-- <div class="col-md-2"> <input type="radio" name="idle_type" id="idle_type_24hrs" class="form-control" value="24 hrs" checked="true"></div> -->
                     <!-- <div class="col-md-10"><strong>SET TO 24 X 7 HRs</strong></div>
                       <div class="col-md-2"> <input type="radio" name="idle_type" id="idle_type_24hrs" class="form-control" value="24 hrs" checked="true"></div>-->
                       <div class="col-md-7"> <input type="text" name="idle_type" id="idle_type" class="time-picker form-control" readonly/></div>
                      </div>
                 
                <div class="row" style="margin-bottom: 8px;">
                  <!--<div class="col-md-10">
                    <strong>TIME BETWEEN 10 AM To 9 PM</strong>
                  </div>

                    <div class="col-md-2">
                      <input type="radio" name="idle_type" id="idle_type_10_to_9" value="10 to 9 pm" class="form-control" />
                    </div>-->
                    <div class="col-md-5">
                    <strong>To Time</strong>
                  </div>

                    <div class="col-md-7">
                      <input type="text" name="idle_type_2" id="idle_type_2" class="time-picker form-control" readonly/>
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
            <button type="button" class="btn green" onClick="submit_set_alert()">Set Alert</button>
        </div>
    </div>
    </div>
</div>
 </body>
 </html>


<script>
  
function show_hide(type_alert)
{
  
   if(type_alert=='Panic Alert' || type_alert=='Ac Alert' || type_alert=='Document Alert' || type_alert=='Fuel Alert' || type_alert=='Night Drive' || type_alert=='Main power cut off')
   {
      $("#parameter_show_ovrspeed").hide();
      $("#parameter_show_idle").hide();
      $("#default_show").show();
	  $("#parameter_show_poi").hide();
   } 
    else if(type_alert=='OverSpeed')
      {
		  $("#parameter_show_poi").hide();
        $("#default_show").hide();
        $("#parameter_show_idle").hide();
        $("#parameter_show_ovrspeed").show();
      } 
    else if(type_alert=='Idle Alert')
      {
		$("#parameter_show_poi").hide();
        $("#default_show").hide();
        $("#parameter_show_ovrspeed").hide();
        $("#parameter_show_idle").show();
      }
	  else if(type_alert=='POI Alert')
      {
		$("#parameter_show_idle").hide();
        $("#default_show").hide();
        $("#parameter_show_ovrspeed").hide();
        $("#parameter_show_poi").show();
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

function filter_poi(parent_id)
{
	  var datastring = 'parent_id='+ parent_id;
      
   $.ajax({
          type: "POST",
          data:datastring,
          url:'ajax/fetch_poi_list.php',
          success: function(data)
            {
				//appendToChosen(data);
		
	//console.log(window.value);
	// $vhl('.livesearch').filter('<option>j1</option><option>j2</option>');
	 // $vhl('.livesearch').trigger("chosen:updated");
	 
				$vhl("#poi_id").html(data);
                $vhl("#poi_id").trigger("chosen:updated");
               //$("#vehicle_id").html(data).trigger("chosen:updated");
               //$(".livesearch").append(data).trigger("chosen:updated");
			   //var newhtml=data;
			    // $('.livesearch').append('<option value="foo">Bar</option>');
				// $('.livesearch').trigger("chosen:updated");
				//doSomething(data);
            }
          });
}

// fetch vehicles userbies 
 var $vhl = jQuery.noConflict();
function filter_vehicles(user_id)
{

    var datastring = 'user_id='+ user_id;
   //   $myuser_id=$_SESSION['myuser_id'];
   $.ajax({
          type: "POST",
          data:datastring,
          url:'ajax/fetch_vehicle_list_alert.php',
          success: function(data)
            {
				$vhl("#vehicle_id").html(data);
                $vhl("#vehicle_id").trigger("chosen:updated");
            }
          });
}

// function end 


// fetch users details mobile and email id alert
function fetch_users_details_alert(user_id) 
{
	//alert(user_id[0]);
	var test=$("#to_whom").val('');
	alert(test[0]);
	var user_id_new = user_id; // vehicle id with svc id
	var res = user_id_new.split("~");
	alert(res);
    var datastring = 'user_id='+ res[1]; // query string
      
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

function filter_to_whom(user_id)
{
	if(user_id=='')
	{
		//var datastring = 'parent_id='+'';
	}
	else{
		var datastring = 'parent_id='+ <?php echo @$parent_user_id;?>;
	}
	 
      
   $.ajax({
          type: "POST",
          data:datastring,
          url:'ajax/fetch_towhom_list.php',
          success: function(data)
            {
				$vhl("#to_whom").html(data);
                $vhl("#to_whom").trigger("chosen:updated");
				
            }
          });
}

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
// var $vhl = jQuery.noConflict();
// $vhl(function() {
// $vhl('#vehicle_id').magicSuggest({
// data: 'ajax/fetch_vehicle_list.php?user_id=80972',
// valueField: 'id',
// displayField:'name' 
// });
 // });

 // function appendToChosen(data){
	 
  // $vhl(".livesearch").chosen({
        // width: '100%',
        // allow_single_deselect: true
     // });
	//console.log(window.value);
	// $vhl('.livesearch').append('<option>j1</option><option>j2</option>');
	 // $vhl('.livesearch').trigger("chosen:updated");
// }
 //$vhl(".livesearch").chosen();
	 //console.log(newhtml);
	 //$("#vehicle_id").val()
	// $("#vehicle_id").on('change',function(){
    // var getValue=$(this).val();
    // alert(getValue);
  // });
  // allow_single_deselect: false,
  $vhl(".livesearch").chosen({
        width: '100%',
		allow_single_deselect: true,
		search_contains:true,
		max_selected_options: 4
			});
			$vhl(".livesearchnew").chosen({
        width: '100%',
		allow_single_deselect: true,
		search_contains:true,
			});
$vhl(".livesearch").bind("chosen:maxselected",
            function() {
                alert('Maximum four selection are allowed');
        });


       // $vhl().ready(function(e) {

// $('#timePicker').hunterTimePicker({
// 	callback: function(e){
// 		alert(e.val());
// 	}
// });
//var $vhl = jQuery.noConflict();
$vhl(".time-picker").hunterTimePicker();
//});

</script>




