<?php 
session_start();
include_once('header2.php');
include_once('config/connect.php'); // configuration file database
$parent_user_id = $_SESSION['cntrl_p']['UserId'];

?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Users List
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
                                        <span class="caption-subject bold uppercase">Users List</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th>
        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                            <?php 

                                $sql_sub_users = "select a.sys_username as username,b.sys_username,a.email_address,a.mobile_number,a.id AS userid,b.sys_parent_user from users a,users b 
                                    where a.sys_parent_user=b.id and b.id='$parent_user_id' and a.sys_active=1";

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
                                                <td><?php echo $result_data->email_address;?> </td>
                                                <td><?php echo $result_data->mobile_number;?> </td>
                                                <td class="right"><a href="vendor_vehicle_list_view.php?u_id=<?php echo $result_data->userid; ?>" class="btn sbold green">Vehicles</a>
                                                    <!-- <a href="#" class="btn sbold green">User Details</a> -->
                                                </td>
                                            </tr>
                                           
                                       <?php } }} ?>
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
<?php 

include_once('footer2.php');

?>