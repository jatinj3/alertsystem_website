<?php
include_once('header2.php');


?>
       <!-- BEGIN CONTENT -->
         <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
             <div class="page-content">
                <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Vendor Vehicle List
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
                                        <span class="caption-subject bold uppercase">Vendor Vehcile list</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                               <th>
                                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                                                <th>Srl No.</th>
                                                <th>Vehicle No</th>
                                                <th>View Alerts</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 

                                         if(!empty($_GET['u_id']))
                                         {
                                             $user_id = $_GET['u_id'];// user id 
                                             $index = 1;

                                            include_once('config/connect.php'); // configuration file database
                                            $sql_select_vehicles = "select a.alrt_config_id,a.user_id,a.vehicle_no from alert_configuration a WHERE a.user_id='$user_id' group by a.vehicle_no";
                                            if($query_result = mysqli_query($conn2,$sql_select_vehicles))
                                            {
                                                while($vehicle_rows = mysqli_fetch_object($query_result))
                                                {
                                                  
                                            ?>
                                            <tr class="odd gradeX">
                                                <td>
                                                   <input type="checkbox" class="checkboxes" value="1" /> </td>
                                                <td><?php echo $index;?></td>
                                                <td> <?php echo $vehicle_rows->vehicle_no; ?></td>
                                                <td>
                                                    <a href="view_alerts_userbies.php?vehicle_no=<?php echo $vehicle_rows->vehicle_no ?>&user_id=<?php echo $vehicle_rows->user_id;?>" class="btn sbold green">View Alerts</a>
                                                </td>
                                            </tr>

                                            
                                <?php  
                                    }  } }  // end of the loop and if block

                                ?>
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

