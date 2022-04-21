<?php 
include_once('header2.php'); //page header
include_once('common_functions/functions.php');

$user_id = !empty($_GET['user_id'])? $_GET['user_id']:'';// user id
$vehicle_no = !empty($_GET['vehicle_no'])? $_GET['vehicle_no']:''; // vehicle no

 ?>

     <!-- BEGIN CONTENT -->
     <div class="page-content-wrapper">
       <div class="page-content">
          <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title">Alerts List
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
                                        <span class="caption-subject bold uppercase">Alert List</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>Srl No</th>
                                                <th>Vehicle No</th>
                                                <th>Alert Type</th>
                                                <th>Speed Level</th>
                                                <th>Idle alert Time</th>
                                                <th>Idle Hours</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    $index =1;
                                    if($alert_list = getAll_alerts_byfilter($user_id,$vehicle_no))
                                        {
                                            
                                         for($al=0; $al <count($alert_list);$al++)
                                             {
                                                
                                             ?>
                                            <tr class="odd gradeX">
                                                    <td><?php echo $index;?></td>
                                                    <td><?php echo $alert_list[$al]->vehicle_no;?></td>
                                                    <td><?php echo $alert_list[$al]->alrt_type;?></td>
                                                    <td><?php echo $alert_list[$al]->parameter_over_speed;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_alert_time;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_hrs;?></td>
                                                    <td><?php echo $alert_list[$al]->mobile;?></td>
                                                    <td><?php echo $alert_list[$al]->email_id;?></td>
                                                    <td><?php echo $alert_list[$al]->status;?></td>
                                            </tr>
                                   
                                        <?php $index++; } } ?>
                                           
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

include_once('footer2.php'); // footer
?>