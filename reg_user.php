<?php 
session_start();
include_once('header2.php');
include_once('config/connect.php'); // configuration file database

$parent_user_id = $_SESSION['cntrl_p']['UserId'];


 // echo  $vechile_no.'-----'.$alert_type.'-----'.$user_id;exit;
 if(isset($_POST['submit']))
 {
// echo "<pre>";
//print_r($_POST['mob_id']); die;
	$user_id='';
 

if(!empty($_POST['mob_id']) && !empty($_POST['email_id']) && !empty($parent_user_id) && !empty($_POST['name']))
	    {
			 $mob_id=$_POST['mob_id'];
			 $email_id=$_POST['email_id'];
			 $name=$_POST['name'];
			
	      $sql_alert_result = "select count(*) as total from alert_users_details a where a.parent_id='$parent_user_id' and a.mobile_number='$mob_id' and a.email_id='$email_id'";
	      
	      $query_chk_dup = mysqli_query($conn2,$sql_alert_result);

	      $total_data_count = mysqli_fetch_object($query_chk_dup); // fetching the duplicate data count
	      
	      if($total_data_count->total > 0)
	       {
	          //return true;  // if duplicate entry found
			 echo '<script>alert("duplicate entry found")</script>'; 
	       } else 
	          {
	             $qry_save_details = "insert into alert_users_details (parent_id,name,mobile_number,email_id,user_id) values('$parent_user_id','$name','$mob_id','$email_id','$user_id')";
	             mysqli_query($conn2,$qry_save_details); // inserting the users details into table
	             //return true; // return true from function
				 echo '<script>alert("User details saved successfully!")</script>';
	          }

	     }
		 else{
			 echo '<script>alert("Something went wrong")</script>';
		 }


 }


?>
<html>
<body>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title">Create Contact
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
                                       <span class="caption-subject bold uppercase">Create Contact</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                  <div class="row">
                  <form role="form" action="" method="post">
                     <!-- column start -->
                    <div class="col-md-6">
                         <!-- alert user list-->
                     
                        <!-- alert user list -->

						<div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required />
                        <!--<font style="color:red;"><span id="show_error_mobile"></span></font>-->
                        </div>

                         <!--  vendor vehcile list -->
                      <div class="form-group">
                      <label>Mobile</label>
                      <input type="text" class="form-control"  name="mob_id" id="mob_id" placeholder="Mobile number" maxlength="10" required />
                      <font style="color:red;"><span id="show_error_mobile"></span></font>
                      </div>
                        <!-- vendor vehicle list -->


                        <!--  vendor vehcile list -->
                        <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email_id" id="email_id" placeholder="Email id" required />
                        <font style="color:red;"><span id="show_error_email"></span></font>
                        </div>
						<div class="form-group">
						<input type="submit" class="btn green" name="submit"/>
						</div>
					
      </div>
	   
    <!-- first column end -->
                  

                  <!-- column start  -->
               
        <!-- column end -->
                     </form>
                </div>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                   
                </div>
                <!-- END CONTENT BODY -->
            </div>
			</body>
			</html>
            <!-- END CONTENT -->
        <!--</div>-->
        <!-- END CONTAINER -->
<?php 

include_once('footer2.php');

?>