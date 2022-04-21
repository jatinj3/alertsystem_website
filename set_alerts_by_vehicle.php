<?php 
include_once('header2.php'); //page header
include_once('common_functions/functions.php');

$parent_user_id = $_SESSION['cntrl_p']['UserId'];
$veh_id = $_GET[''];//vehicle id
$user_id = $_GET[''];
 ?>

     <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title">  All Set Alerts List
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
                                        <span class="caption-subject bold uppercase">All Set Alert List</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                   <button id="sample_editable_1_new" class="btn sbold green" data-toggle="modal" href="#set_alert_model">Set New
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                            
                                                <th>Vehicle No</th>
                                                <th>Alert Type</th>
                                                <!-- <th>Set Type</th> -->
                                                <th>Speed Level</th>
                                                <th>Idle alert Time</th>
                                                <th>Idle Hours</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                    if($alert_list = getAll_alerts($parent_user_id))
                                        {
                                            
                                         for($al=0; $al <count($alert_list);$al++)
                                             {
                                                
                                             ?>
                                            <tr class="odd gradeX">
                                                
                                                    <td><?php echo $alert_list[$al]->vehicle_no;?></td>
                                                    <td><?php echo $alert_list[$al]->alrt_type;?></td>
                                                    <!-- <td><?php //echo $alert_list[$al]->alert_set_type;?></td> -->
                                                    <td><?php echo $alert_list[$al]->parameter_over_speed;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_alert_time;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_hrs;?></td>
                                                    <td><?php echo $alert_list[$al]->mobile;?></td>
                                                    <td><?php echo $alert_list[$al]->email_id;?></td>
                                                    <td><?php echo $alert_list[$al]->status;?></td>
                                                    <td>
                                                    <a class="btn blue" data-toggle="modal" href="#edit_set_alert_model" onclick="fetch_alert('<?php echo $alert_list[$al]->alrt_config_id;?>')"><i class="fa fa-edit"></i></a>
                                                    <a href="javascript:;" class="btn red" onclick="delete_alert('<?php echo $alert_list[$al]->alrt_config_id;?>')"><i class="icon-trash"></i></a>
                                                </td>
                                            </tr>
                                   
                                        <?php  }} ?>
                                            
                                            
                                           
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

include_once('set_alert_model.php'); // set alert modal box
include_once('edit_set_alert_model.php'); // set alert modal box

include_once('footer2.php'); // footer
?>

<script src="ajax/set_alert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>