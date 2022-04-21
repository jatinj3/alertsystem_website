<?php 
 
include_once('config/connect.php'); // configuration file database

if(isset($_POST['login']))
 {
   
   $user_name = addslashes($_POST['username']);//login username
   $login_password = addslashes($_POST['password']);//login password
   $err_msg = '';



if(!empty($user_name) && !empty($login_password))
   {
      // login query for fetching the user d
        $login_query = "select * from users left join group_users on users.id=group_users.sys_user_id where
         group_users.active =true and users.sys_username='".$user_name."'
         and users.sys_password='".$login_password."'
         and users.sys_active=true  and different_site=0";

         if($qry_result = mysqli_query($conn,$login_query))
             {
               
               if($qry_result->num_rows > 0)
                {

                  // fetch the login result
                   if($result_data = mysqli_fetch_object($qry_result))
                   {
                        if($result_data->sys_payment_status_off=="1")
                           {
                              $err_msg = 'Your Payment is due';
                              header("Location: index.php?msg=2");
                           } else {


                             // create user session on login
                                  session_start();
                                  $_SESSION['cntrl_p']['lang']=$result_data->sys_culture;
                                  $_SESSION['cntrl_p']['UserName']=$result_data->sys_username; // username
                                  $_SESSION['cntrl_p']['UserName2']=$result_data->sys_username; // user name
                                  $_SESSION['cntrl_p']['sys_password']=$result_data->sys_password; // passowrd
                                  $_SESSION['cntrl_p']['UserId']=$result_data->id; // user id
                                  $_SESSION['cntrl_p']['domain']=$result_data->affable_domain;
                                  $_SESSION['cntrl_p']['ParentId']=$result_data->sys_parent_user; // parent id
                                  $_SESSION['cntrl_p']['login_ParentId']=$result_data->sys_parent_user; //login parent id
                                  $_SESSION['cntrl_p']['only_dashboard']=$result_data->only_dashboard;
                                  $_SESSION['cntrl_p']['fullname']=$result_data->fullname; // full name
                                  $_SESSION['cntrl_p']['sys_group_id']=$result_data->sys_group_id;
                                  $_SESSION['cntrl_p']['TimeZone']=$result_data->sys_timezone;
                                  $_SESSION['cntrl_p']['vehId']="";
                                  $_SESSION['cntrl_p']['poiId']="";
                                  $_SESSION['cntrl_p']['poiDetails']="";
                                  $_SESSION['cntrl_p']['vehDetails']="";
                                  $_SESSION['cntrl_p']['Journey_status']=$result_data->create_journey;
                                  $_SESSION['cntrl_p']['KM_for']=$result_data->KM_for;
                                  $_SESSION['cntrl_p']['vendor']=$result_data->vendor;
                                  $_SESSION['cntrl_p']['Show_alert']=$result_data->show_notification;
                                  $_SESSION['cntrl_p']['TimeZoneDiff'] = $result_data->timezone_minute;
                                  $_SESSION['cntrl_p']['Vehicle_type']=$result_data->default_vehicle_type;
                                  $_SESSION['cntrl_p']['sys_group_id_parent']="";
                                  $_SESSION['cntrl_p']['login_UserId']=$result_data->id; //userid
                                 
                                  //header('Location:dashboard.php'); // redirecting to defualt dashboard
                                  header('Location:set_alerts.php');
                           }
                       }
                   }
                else {
                      $err_msg = "Login Credentails did not match any accounts";
                }
             }
              else {
                   $err_msg = 'Try Again';
              }
         }
      }
?>

<!DOCTYPE html>


<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Tracking Experts: Alert Management System</title>
<link href="images/ic.png" rel="shortcut icon">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://gtrac.in/newtracking/reports/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="http://gtrac.in/newtracking/reports/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="http://gtrac.in/newtracking/reports/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<!--<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2-metronic.css"/>-->
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->
<!--<link href="../assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>-->
<link href="http://gtrac.in/newtracking/reports/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="http://gtrac.in/newtracking/reports/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="http://gtrac.in/newtracking/reports/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="http://gtrac.in/newtracking/reports/assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
<link href="http://gtrac.in/newtracking/reports/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<script src="http://gtrac.in/newtracking/reports/assets/js/jquery-1.9.1.js"></script>
   <!-- END HEAD -->
   <!-- BEGIN BODY -->
   <body class="login">
      <p style="color: #fff;font-size: 18px;padding: 2% 15%;text-align: center;font-family: arial;">
         <!-- It's that time of year again, when we get ourself ready for a stress buster day sport event on Saturday i.e 24th Dec. Its more of a team building exercise for all GTrac staff to know each other better and work as a team. To wrap up this year and ring in the next, this day was planned for all of us. In case of urgent requirement, service or support do let us know so we can plan before hand. thanks for all your love, co-operation and support and a coming happy new year. -->
         <!-- Due to our Telecom partner GPRS problem our service is down in some location of india. We apologize for inconvenience caused  -->
         <!--Mobile internet services have been suspended in Haryana's Rohtak district which may cause our service down. we apologize for inconvenience caused -->
         <!--Dear Partners
            We are in process of updating our servers, you might find some downtime (few minutes) at different time intervals till 11:30 pm today..
            Thanks for your co-operation.
            
            In case of emergency, you can call your RM or SM.
            
             Due to Telecom GPRS problem our service may down in some location of india. we apologize for inconvenience caused.
             -->
         <!--Due to server upgradation, services may not be available today (23 April ) from 7:30 PM to 8:30 PM.-->
         <!--Due to Bharat Bandh Protests, Mobile internet services may down in some location of india. We apologize for inconvenience caused.-->
         <!--Due to google MAP update maps may not be avaible for tracking website. However you can track your vehicle on MAP by using our Gtrac mobile Application. We apologize for inconvenience caused.
            -->
         <!--The internet services have been suspended in many parts of the country, as part of security measures in the lead-up to the Ayodhya land dispute verdict by the Supreme Court-->
         <!--Due to server upgradation, services may not be available today (1st Sept ) from 11:30 AM to 12:30 AM.-->
         <!--The internet has been suspended in many parts of Bengal,Assam,Kolkata as violent protests over the Citizenship (Amendment) Act-->
      </p>
      <div id="example-popup" class="popup">
         <div class="popup-body">
            <div class="popup-content">
               <img src="http://gtrac.in/newtracking/reports/assets/img/loading.gif"/>
            </div>
         </div>
      </div>
      <div class="popup-overlay"></div>
      <!-- BEGIN LOGO -->
      <div class="logo">
         <a href="index.php">
         <img src="http://gtrac.in/newtracking/reports/assets/img/gtrac_logo.png" alt=""/>
         </a>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN LOGIN -->
      <div class="content">
         <!-- BEGIN LOGIN FORM -->
         <!--  <p>
            Dear Partners
            We are in process of updating our servers, you might find some downtime (few minutes) at different time intervals till Sunday (30th april 2017).
            Thanks for your co-operation.
            
            In case of emergency, you can call your RM or SM.
            </p>   -->
         <form class="login-form" action="" method="post">
            <h3 class="form-title">Login to your account</h3>
            <!-- <div class="alert alert-danger">
               This is to inform you that there will be a data service outage from AIRTEL tonight for around 1 - 2 hours between 00:00 am to 06:00 am  due to a planned activity by our GPRS partner.</div> -->
            <div class="alert alert-danger display-hide">
               <button class="close" data-close="alert"></button>
               <span>
               Enter username and password.
               </span>
            </div>


            <div class="form-group">
               <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
               <label class="control-label visible-ie8 visible-ie9">Username</label>
               <div class="input-icon">
                  <i class="fa fa-user"></i>
                  <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username_id"/>
               </div>
            </div>


            <div class="form-group">
               <label class="control-label visible-ie8 visible-ie9">Password</label>
               <div class="input-icon">
                  <i class="fa fa-lock"></i>
                  <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password_id"/>
               </div>
            </div>

            <div class="form-actions">
               <label class="checkbox">
               <input type="checkbox" name="remember" value="1"/> Remember me </label>
              
               <button type="submit"  name="login" class="btn blue pull-right" value="login">Login <i class="m-icon-swapright m-icon-white"></i></button>
            </div>

         </form>
         <!-- END LOGIN FORM -->
      </div>
      <!-- END LOGIN -->
      <!-- BEGIN COPYRIGHT -->
      <div class="copyright">
         2015 &copy; by G-Trac.
      </div>
      <!-- END COPYRIGHT -->
      <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
      <!-- BEGIN CORE PLUGINS -->
      <script src="http://gtrac.in/newtracking/reports/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="http://gtrac.in/newtracking/reports/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="http://gtrac.in/newtracking/reports/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="http://gtrac.in/newtracking/reports/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!--<script src="../assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>-->    
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="http://gtrac.in/newtracking/reports/assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="http://gtrac.in/newtracking/reports/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://gtrac.in/newtracking/reports/assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="http://gtrac.in/newtracking/reports/assets/scripts/core/app.js" type="text/javascript"></script>
<script src="http://gtrac.in/newtracking/reports/assets/scripts/custom/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- <div class="adpop"> <img src="images/fastag-fina2.png" class="img-responsive img " > <a href="#"><img src="http://gtrac.in/newtracking/images/canc.png" class="cancel"></a> </div> -->
<style>
.adpop{position:absolute;top:0;left:0;background:rgba(0, 0, 0, 0.50);width:100%;height:100%;z-index: 99999;display:none;}
.adpop .cancel{position:absolute;top:20px;right:20px;width:50px;}
.adpop .img{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);}
</style>
<script>
                jQuery(document).ready(function() {
                  App.init();
                  Login.init();
                });
        </script>

   </body>
   <!-- END BODY -->
   
</html>