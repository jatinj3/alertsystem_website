function submit_set_alert()
  {
	  //alert('hello');
	  if($("#user_id").val()!='' && $("#user_id").val()!=undefined)
	  {
		var user_id = $("#user_id").val();
	  }
	  else{
		  alert('Please select user');
	  }
	   // user id
	 
		var alert_type = $("#alert_type_id").val(); // alert type
	  
		var poientryexit;
      var email_id   = 'test'; // email id
     // var email_id   = $("#email_id").val(); // email id
     // var mobile_no  = $("#mob_id").val();//mob number
     var mobile_no  = '1111';//mob number
	 
		var vehicle_id_with_svcid = $("#vehicle_id").val(); // vehicle id with svc id
		var res = vehicle_id_with_svcid.split("#");
		var vehicle_id=res[0];
		var svc_id=res[1];
	   
   
	 
	//   if($("#to_whom").val()!=undefined)
	//   {
		var towhom_split=$("#to_whom").val();
	
	  //console.log(towhom_split);
	  var arr = [];
	  var newarr=[];
	 // var towhom_temp='';
	  //var towhomid_temp='';
	  
	  for (i = 0; i < towhom_split.length; i++) {
			var temp = towhom_split[i];
			
			var resnew=temp.split("~");
			var towhom_temp=resnew[0];
			arr.push(towhom_temp);
			var towhomid_temp=resnew[1];
			newarr.push(towhomid_temp);
		}
		//console.log(arr);
		var towhom=arr.toString();
		var towhomid=newarr.toString();
	// }
	// else{
	// 	alert('Please fill to whom field');
	// }
	
		//alert(towhomid);
		//console.log(towhom);
		//console.log(towhomid);
		
	//  var resnew=towhom_split.split("~");
	  // var towhom=resnew[0];
	  // var towhomid=resnew[1];
	  
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
		  //var idle_hr_type = document.getElementsByName('idle_type');
		  var idle_hr_type=$("#idle_type").val();
		 console.log(idle_hr_type);
		  var idle_hr_type_2=$("#idle_type_2").val();
		  console.log(idle_hr_type_2);
		  var idle_halting_hrs = $("#idle_halting_hrs").val();
		  var idle_hr_para1=idle_hr_type;
		  var idle_hr_para2=idle_hr_type_2;
		  var set_type = 'custom';
          /*for(i = 0; i < idle_hr_type.length; i++) {
                if(idle_hr_type[i].checked)
                {
                  var idle_hr_para = idle_hr_type[i].value;
                  var set_type = 'custom';
                }  
            }*/ 
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
		else if(alert_type=='POI Alert'){
			
			//var poi_arr=[];
			var set_type  = 'custom';
			 var arrpoi = [];
	  var newarrpoi=[];
	 // var towhom_temp='';
	  //var towhomid_temp='';
	  if($("#poi_id").val())
	  {
		var poi_name_temp  = $("#poi_id").val();  
		  for (j = 0; j < poi_name_temp.length; j++) {
			var tempqwe = poi_name_temp[j];
			var resqwe=tempqwe.split("@");
			var name_temp=resqwe[0];
			arrpoi.push(name_temp);
			var poiid_temp=resqwe[1];
			newarrpoi.push(poiid_temp);
		}
		console.log(arrpoi);
		var poi_name=arrpoi.toString();
		if(arrpoi.includes("") && arrpoi.length>1)
		{
			alert('Please Select All option once at a time');
		}
		else{
			var poi_name=arrpoi.toString();
		}
		var poiid=newarrpoi.toString();
		var poientryexit=$("#entryexit").val();
		//var poiexit=$("#entryexit").val();
	  }
	  else{
		var poi_name=''; 
		var poiid='';
		var poientryexit='';
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

   /* if(mobile_no=="")
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
		}*/

// validate vehicle id
 /* if(vehicle_id=="")
      {
      	$("#vehicle_id").focus();
      	$("#show_error_vehicle").html('Vehicle no is required');
      	exit;
      } else {
      	$("#show_error_vehicle").html('');
      }*/
// end validate vehicle id


      

      // alert(user_id+ alert_type + email_id + mobile_no + is_set + vehicle_id);
      
   if(alert_type=='Idle Alert')
      {
      	var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id +'&svc_id=' + svc_id + '&towhom=' + towhom + '&towhomid=' + towhomid + '&idle_hr_para1=' + idle_hr_para1 + '&idle_hr_para2=' + idle_hr_para2 + '&idle_halting_hrs=' + idle_halting_hrs + '&set_all_veh=' + set_all_veh;
      }
   else if(alert_type=='OverSpeed')
      {
      	 var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id +'&svc_id=' + svc_id + '&towhom=' + towhom + '&towhomid=' + towhomid +'&over_speed_para=' + over_speed_para + '&set_all_veh=' + set_all_veh;
      }
	  else if(alert_type=='POI Alert')
      {
      	 var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id +'&svc_id=' + svc_id + '&towhom=' + towhom + '&towhomid=' + towhomid +'&poi_name=' + poi_name +'&poiid=' + poiid +'&poientryexit=' + poientryexit+ '&set_all_veh=' + set_all_veh;
      }
	    else {
      	 var datastring = 'user_id='+ user_id + '&alert_type=' + alert_type + '&email_id=' + email_id + '&mobile_no=' + mobile_no + '&set_type=' + set_type + '&vehicle_id=' + vehicle_id +'&svc_id=' + svc_id + '&towhom=' + towhom + '&towhomid=' + towhomid + '&set_all_veh=' + set_all_veh;
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
 
