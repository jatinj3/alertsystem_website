function submit_set_alert()
  {
      
      var user_id    = $("#user_id").val(); // user id
      var alert_type = $("#alert_type_id").val(); // alert type
      var email_id   = $("#email_id").val(); // email id
      var mobile_no  = $("#mob_id").val();//mob number
      var vehicle_id_with_svcid = $("#vehicle_id").val(); // vehicle id with svc id
	  var res = vehicle_id_with_svcid.split("#");
	  var vehicle_id=res[0];
	  var svc_id=res[1];
      var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var phoneno = /^\d{10}$/;

     if($("#set_all_veh").prop('checked') == true)
        {
            var set_all_veh = 'yes';
        } else {
        	 var set_all_veh = 'no';
        }

    // alert set type check
       
      if(alert_type=='Idle Alert')
       {
          var idle_hr_type = document.getElementsByName('idle_type');
          var idle_halting_hrs = $("#idle_halting_hrs").val();
          for(i = 0; i < idle_hr_type.length; i++) {
                if(idle_hr_type[i].checked)
                {
                  var idle_hr_para = idle_hr_type[i].value;
                  var set_type = 'custom';
                }  
            } 
       } 
      else if(alert_type=='OverSpeed')
       {
           var set_type  = 'custom';
           var over_speed_para  = $("#over_speed_para").val();

           if(isNaN(over_speed_para))
			    {
			          $("#show_error_speed_para").html('Only number allowed');
			          $("#over_speed_para").val('');
			          $("#over_speed_para").focus();
			          exit;
			    }
			     else 
			     {
			         if(over_speed_para < 40 || over_speed_para > 180)
			           {
			              $("#show_error_speed_para").html('Invalid speed value');
			              $("#over_speed_para").focus();
			              exit;
			           } else {
			              $("#show_error_speed_para").html('');
			           }
			           
			     }

       }

	   else {
       	    var set_type = 'default';
       }


  
 // alert set type check


   if(user_id=="")
	      {
	      	$("#user_id").focus();
	      	$("#show_error_user").html('User name is required');
	      	exit;
	      } else {
	      	$("#show_error_user").html('');
	      }

    if(mobile_no=="")
	      {
	      	$("#mob_id").focus();
	      	$("#show_error_mobile").html('Mobile no is required');
	      	$("#show_error_email").html('');
	      	exit;
	      } else {
	      	$("#show_error_mobile").html('');
	      }

        if(!mobile_no.match(phoneno))
          {
            $("#mob_id").focus();
	      	$("#show_error_mobile").html('Invalid Mobile no');
	      	$("#show_error_email").html('');
	      	exit;
          }



       if(email_id=="")
	      {
	       	  $("#email_id").focus();
	       	  $("#show_error_email").html('Email id is required');
	       	  $("#show_error_mobile").html(''); 
	       	  exit;
	      } else {
	      	 $("#show_error_email").html('');
	      }


		if(!email_id.match(mailformat))
		{
		   $("#email_id").focus();
		   $("#show_error_email").html('Invalid Email id');
		   $("#show_error_mobile").html('');
		   exit;
		}

// validate vehicle id
  if(vehicle_id=="")
      {
      	$("#vehicle_id").focus();
      	$("#show_error_vehicle").html('Vehicle no is required');
      	exit;
      } else {
      	$("#show_error_vehicle").html('');
      }
// end validate vehicle id


      

      // alert(user_id+ alert_type + email_id + mobile_no + is_set + vehicle_id);
      
   if(alert_type=='Idle Alert')
      {
      	var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id +'&svc_id=' + svc_id + '&idle_hr_para=' + idle_hr_para + '&idle_halting_hrs=' + idle_halting_hrs + '&set_all_veh=' + set_all_veh;
      }
   else if(alert_type=='OverSpeed')
      {
      	 var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id +'&svc_id=' + svc_id +'&over_speed_para=' + over_speed_para + '&set_all_veh=' + set_all_veh;
      }
   else {
      	 var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id +'&svc_id=' + svc_id + '&set_all_veh=' + set_all_veh;
        }
      
	  $.ajax({
	        type: "POST",
	        data:datastring,
	        dataType: 'JSON',
	        url:'ajax/save_set_alert.php',
	        success: function(data)
		      {
		      	 //alert(data);
			      if(data.hasOwnProperty('error_msg') && data.error_msg!="" && data.error_msg!=undefined)
			           {
			           	  alert(data.error_msg);  // alert error msg
			           }
			     else if(data.success_msg!="" && data.success_msg!=undefined)
			           {
		                 alert(data.success_msg); 
						  // success alert  mst
		                  location.reload(true);
			           }
			      else if(data.error_msg_dup!="" || data.error_msg_dup!=undefined)
			            {
			           	  alert(data.error_msg_dup); // success alert  mst
			            }
		      }
	      });
  }



// fetcing alert for editing
 function fetch_alert(alert_id)
  {

    if(alert_id!="" && alert_id!=undefined)
    {
    	datastring = 'alert_id='+ alert_id;
    	$.ajax({
	        type: "POST",
	        data:datastring,
	        dataType: 'JSON',
	        url:'ajax/fetch_set_alert.php',
	        success: function(response)
		        {

			       $("#user_id_edit").val(response.data.user_id).trigger("chosen:updated");
			       $("#mob_id_edit").val(response.data.mobile);
			       $("#email_id_edit").val(response.data.email_id);
			       $("#alert_type_id_edit").val(response.data.alrt_type).trigger("chosen:updated");
			       $("#vehicle_id_edit").val(response.data.vehicle_no).trigger("chosen:updated");
                   var type_alert =  response.data.alrt_type;
                   $("#hidden_alert_id").val(response.data.alrt_config_id);

			       if(type_alert=='Panic Alert' || type_alert=='POI Alert' || type_alert=='Night Drive'  || type_alert=='Fuel Alert' || type_alert=='Main power cut off' || type_alert=='Ac Alert' || type_alert=='Documentation Alert')
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
						        $("#over_speed_para_edit").val(response.data.parameter_over_speed);
						      } 
						    else if(type_alert=='Idle Alert')
						      {
						      	
						        $("#default_show_edit").hide();
						        $("#parameter_show_ovrspeed_edit").hide();
						        $("#parameter_show_idle_edit").show();
						        $("#idle_type_10_to_9_edit").prop("checked",true);
						        $("#idle_halting_hrs_edit").val(response.data.idle_hrs);
						        
						      }
		        }
	      });
    } else {
    	alert('Invalid request');
    }
  }




  // updated alerts


 function Update_alert() 
  {
 
      var user_id    = $("#user_id_edit").val();
      var alert_type = $("#alert_type_id_edit").val();
      var email_id   = $("#email_id_edit").val();
      var mobile_no  = $("#mob_id_edit").val();
      var vehicle_id = $("#vehicle_id_edit").val();
      var hidden_alert_id = $("#hidden_alert_id").val();
      var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var phoneno = /^\d{10}$/;
      var set_alert_val=$("#is_set_edit").val();

	  if(set_alert_val=='true')
	  {
		  set_alert_status='Active';
	  }
	  else{
		   set_alert_status='Inactive';
	  }
      if($("#set_all_veh_edit").prop('checked') == true)
        {
            var set_all_veh_edit = 'yes';
        } else {
        	 var set_all_veh_edit = 'no';
        }


    // alert set type check
       
       if(alert_type=='Idle Alert')
       {
          var idle_hr_type = document.getElementsByName('idle_type_edit');
          var idle_halting_hrs = $("#idle_halting_hrs_edit").val();
          for(i = 0; i < idle_hr_type.length; i++) {
                if(idle_hr_type[i].checked)
                {
                  var idle_hr_para = idle_hr_type[i].value;
                  var set_type = 'custom';
                }  
            } 
       } 
      else if(alert_type=='OverSpeed')
       {
           var set_type  = 'custom';
           var over_speed_para  = $("#over_speed_para_edit").val();


           if(isNaN(over_speed_para))
			    {
			          $("#show_error_speed_para_edit").html('Only number allowed');
			          $("#over_speed_para_edit").val('');
			          $("#over_speed_para_edit").focus();
			          exit;

			    }
			     else 
			     {
			         if(over_speed_para < 40 || over_speed_para > 180)
			           {
			              $("#show_error_speed_para_edit").html('Invalid speed value');
			              $("#over_speed_para_edit").focus();
			              exit;
			           } else {
			              $("#show_error_speed_para_edit").html('');
			           }
			           
			     }

       } else {
       	    var set_type = 'default';
       }

    // alert set type check


      if(mobile_no=="")
	      {
	      	$("#mob_id_edit").focus();
	      	$("#show_error_mobile_edit").html('Mobile no is required');
	      	$("#show_error_email_edit").html('');
	      	exit;
	      } else {
	      	$("#show_error_mobile_edit").html('');
	      }

        if(!mobile_no.match(phoneno))
          {
            $("#mob_id_edit").focus();
	      	$("#show_error_mobile_edit").html('Invalid Mobile no');
	      	$("#show_error_email_edit").html('');
	      	exit;
          }



       if(email_id=="")
	      {
	       	  $("#email_id_edit").focus();
	       	  $("#show_error_email_edit").html('Email id is required');
	       	  $("#show_error_mobile_edit").html(''); 
	       	  exit;
	      } else {
	      	 $("#show_error_email_edit").html('');
	      }


		if(!email_id.match(mailformat))
		{
		   $("#email_id_edit").focus();
		   $("#show_error_email_edit").html('Invalid Email id');
		   $("#show_error_mobile_edit").html('');
		   exit;
		}


      
    // alert(user_id+ alert_type + email_id + mobile_no + is_set + vehicle_id);
      
   if(alert_type=='Idle Alert')
      {
      	var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id + '&idle_hr_para=' + idle_hr_para + '&alert_id=' + hidden_alert_id + '&idle_halting_hrs=' + idle_halting_hrs+'&set_alert_status='+'Active';
      }
   else if(alert_type=='OverSpeed')
      {
      	 var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id + '&over_speed_para=' + over_speed_para + '&alert_id=' + hidden_alert_id+'&set_alert_status='+'Active';
      }
   else {
      	var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id + '&alert_id=' + hidden_alert_id + '&set_all_veh_edit=' + set_all_veh_edit+'&set_alert_status='+set_alert_status;
       }


	  $.ajax({
	        type: "POST",
	        data:datastring,
	        dataType: 'JSON',
	        url:'ajax/update_set_alert.php',
	        success: function(data)
		        {
		        	
			        if(data.error_msg!=="" && data.error_msg!==undefined)
			           {
			           	  alert(data.error_msg);  // alert error msg
			           }

			        if(data.success_msg!=="" && data.success_msg!==undefined)
			           {
		                  alert(data.success_msg); // success alert  mst
		                  location.reload(true);
			           }
		        }
	      });
  }


// fetch users details


function delete_alert(alert_id)
{
	Swal.fire({
  title: 'Are you sure?',
  text: "Your alert will be deleted",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {

  if (result.value) {

  var datastring = 'alert_id='+ alert_id;
  $.ajax({
	        type: "POST",
	        data:datastring,
	        dataType: 'JSON',
	        url:'ajax/delete_alert.php',
	        success: function(data)
		        {
		          if(data.success_msg)
		        	{
		        		Swal.fire(
					      'Deleted!',
					      'Your alert has been deleted.',
					      'success'
				        ).then((result) => {
				        	location.reload(true);
				        })
				        

		        	} else if(data.error_msg)
		        	{
		        		alert(data.error_msg);
		        	}
		        	
			   }
		});
    
     }
  });
}

function delete_alert_log(alert_id)
{
	Swal.fire({
  title: 'Are you sure?',
  text: "Your alert log will be deleted",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {

  if (result.value) {

  var datastring = 'alert_id='+ alert_id;
  $.ajax({
	        type: "POST",
	        data:datastring,
	        dataType: 'JSON',
	        url:'ajax/delete_alert_log.php',
	        success: function(data)
		        {
		          if(data.success_msg)
		        	{
		        		Swal.fire(
					      'Deleted!',
					      'Your alert log has been deleted.',
					      'success'
				        ).then((result) => {
				        	location.reload(true);
				        })
				        

		        	} else if(data.error_msg)
		        	{
		        		alert(data.error_msg);
		        	}
		        	
			   }
		});
    
     }
  });
}
 
