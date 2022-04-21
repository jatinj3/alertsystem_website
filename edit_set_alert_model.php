
<div id="edit_set_alert_model" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Edit Alert</h4>
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
                            <select class="form-control chzn-select" id="user_id_edit" onchange="filter_vehicles_edit(this.value)">
                              <option value="">Select User</option>
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
                        <!-- alert user list -->



                      <!--  vendor vehcile list -->
                        <div class="form-group">
                          <label>Mobile</label>
                              <input type="text" class="form-control" value="" id="mob_id_edit" />
                              <font style="color:red;"><span id="show_error_mobile_edit"></span></font>
                        </div>
                        <!-- vendor vehicle list -->


                        <!--  vendor vehcile list -->
                        <div class="form-group">
                          <label>Email</label>
                            <input type="text" class="form-control" value="" id="email_id_edit" />
                             <font style="color:red;"><span id="show_error_email_edit"></span></font>
                        </div>

                        <!-- <div class="col-md-9"> -->
                           <!--  vendor vehcile list -->
                          <div class="form-group">
                            <label>Vehicle List</label>
                              <select class="form-control chosen-select chzn-select" id="vehicle_id_edit"> 
                                <option value="">Select Vehicle</option>
                                  <?php  
                                  if($vehicle_list = getAll_vehicles_by_sys_groupID($sys_group_id))
                                       {
                                         for($vi=0;$vi<count($vehicle_list);$vi++)
                                             {

                                    ?>
                                  <option value="<?php echo $vehicle_list[$vi]->veh_reg; ?>"><?php echo $vehicle_list[$vi]->veh_reg; ?></option>
                                <?php } } ?>
                             </select>
                          </div>
                         <!-- vendor vehicle list -->
                      <!-- </div> -->

                    </div>
                  <!-- first column end -->
                  
                  <!-- column start  -->
                   <div class="col-md-6">
                       <div class="form-group">
                        <label>Alert Type</label>
                         <select class="form-control chosen-select chzn-select" id="alert_type_id_edit" onchange="show_hide_edit(this.value)"> 
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
                        <div class="form-group" id="default_show_edit">
                          <div class="input-group">
                            <!-- <input type="text" class="form-control input-xsmall">  -->
                            <br/><br/>
                            <label><strong>Set Alert</strong></label>
                            <input type="checkbox" class="form-control inline checkbox" id="is_set_edit" checked="true" value="true">
                          </div>
                        </div>
                      <!-- alert list according to alert type end -->

             <!-- alert list according to alert type start -->
              <div class="form-group" id="parameter_show_ovrspeed_edit" style="display:none;">

                <label class="mt-checkbox"><strong>SPEED > 40</strong></label>
                <input type="text" class="form-control input-small" placeholder=" > 40" id="over_speed_para_edit" onkeyup="validate_para_overspeed_edit(this.value)" />
                  <font style="color:red;"><span id="show_error_speed_para_edit"></span></font>
              </div>
            <!-- alert list according to alert type end -->


              <!-- alert idle hour parameter -->
                <div class="form-group" id="parameter_show_idle_edit" style="display:none;">
                  <br/>
                  <div class="row">
                      <div class="col-md-10"><strong>SET TO 24 X 7 HRs</strong></div>
                       <div class="col-md-2"> <input type="radio" name="idle_type_edit" id="idle_type_24hrs_edit" class="form-control" value="24 hrs" checked="true"></div>
                  </div>
                 
                   <div class="row" style="margin-bottom: 8px;">
                    <div class="col-md-10">
                      <strong>TIME BETWEEN 10 AM To 9 PM</strong>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" name="idle_type_edit" id="idle_type_10_to_9_edit" value="10 to 9 pm" class="form-control" />
                    </div>

                  </div>
                  <!-- idle hours section  -->
                  <div class="row" style="margin-bottom: 8px;"> 
                      <div class="col-md-5">
                         <strong>Idle Hours</strong>
                      </div>
                    <!-- idle hr value -->
                      <div class="col-md-7">
                         <input type="text" name="idle_halting_hrs_edit" id="idle_halting_hrs_edit"  class="form-control" placeholder="Idle Hours" />
                       </div>
                  <!-- idle hr value -->
                 </div>
                 <!-- idle hours section  -->


                </div>
              <!-- alert idle hour parameter-->
          </div>
        <!-- hidden value  -->
        <input type="hidden" id="hidden_alert_id" />
        <!-- hidden input value -->
                <!-- column end -->
                     </form>
                </div>
            <!-- </div> -->
           </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
            <button type="button" class="btn green" onclick="Update_alert()">Save changes</button>
        </div>
    </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>               

// function to show and hide the div 
function show_hide_edit(type_alert)
{
  
   if(type_alert=='Panic Alert' || type_alert=='POI Alert' || type_alert=='Ac Alert' || type_alert=='Document Alert' || type_alert=='Fuel Alert' || type_alert=='Night Drive' || type_alert=='Main power cut off')
   {
      $("#parameter_show_ovrspeed_edit").hide();
      $("#parameter_show_idle_edit").hide();
      $("#default_show_edit").show();
   } 
    else if(type_alert=='OverSpeed')
      {
        $("#default_show_edit").hide();
        $("#parameter_show_idle_edit").hide();
        $("#parameter_show_ovrspeed_edit").show();
      } 
    else if(type_alert=='Idle Alert')
      {
        $("#default_show_edit").hide();
        $("#parameter_show_ovrspeed_edit").hide();
        $("#parameter_show_idle_edit").show();
      }

}



// function for validate the overspeed parameter

function validate_para_overspeed_edit(ovr_speed_val)
{

    if(isNaN(ovr_speed_val))
    {
          $("#show_error_speed_para_edit").html('Only number allowed');
          $("#over_speed_para_edit").val('');
          $("#over_speed_para_edit").focus();

    }
     else 
     {
         if(ovr_speed_val < 40 || ovr_speed_val > 120)
           {
              $("#show_error_speed_para_edit").html('Invalid speed value');
           } else {
              $("#show_error_speed_para_edit").html('');
           }
     }
  
}


// filter vehcile on user select edit maodel form
function filter_vehicles_edit(user_id)
 {
   if(user_id!="" && user_id!=undefined)
   {
      var datastring = 'user_id='+ user_id;
      $.ajax({
            type: "POST",
            data:datastring,
            url:'ajax/fetch_vehicle_list.php',
            success: function(data)
              {
                 $("#vehicle_id_edit").html(data).trigger("chosen:updated");
              }
       });
   }
    
  }
  //--------------------------------------------
  function change_status_alert()
  {
	  
     var alert_id = $("#hidden_alert_id").val();
//alert(alert_id);
    if(alert_id!="" && alert_id!=undefined)
    {
    	datastring = 'alert_id='+ alert_id;
    	$.ajax({
	        type: "POST",
	        data:datastring,
	        dataType: 'JSON',
	        url:'ajax/change_status_alert.php',
	        success: function(response)
		        {

						   
		        }
	      });
    } else {
    	alert('Invalid request');
    }
  }
  
  $("#is_set_edit").on('change', function() {
  if ($(this).is(':checked')) {
    $(this).attr('value', 'true');
  } else {
    $(this).attr('value', 'false');
  }
 
  //$('#checkbox-value').text($('#is_set_edit').val());
});
  
// end of the function block 

</script>