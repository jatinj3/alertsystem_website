<?php 
include_once('header2.php'); //page header
include_once('common_functions/functions.php');

 $parent_user_id = $_SESSION['cntrl_p']['UserId'];

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
                                                <th>Srl No</th>
                                                <th>Username</th>
												<th>To whom</th>
                                                <th>Vehicle No</th>
                                                <th>Alert Type</th>
                                                <th>POI Alert On Entry/Exit</th>
                                                <!-- <th>Set Type</th> -->
                                                <th>Speed Level</th>
                                                <th>Idle Alert From Time</th>
                                                <th>Idle Alert To Time</th>
                                                <th>Idle Hours</th>
                                                
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                               <!--<th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                           
                                    if($alert_list = getAll_alerts($parent_user_id))
                                        {
                                             $index_test =1;
                                         for($al=0; $al <count($alert_list);$al++)
                                             {
                                                
                                             ?>
                                            <tr class="odd gradeX">
                                                    <td><?php echo $index_test;?></td>
													<td><?php 
													$user_id_temp=$alert_list[$al]->user_id;
													if($user_id_temp==$parent_user_id)
													{
														echo $qwe='Parent User';
													}
													else{
										$getuser=getAll_main_user_new($parent_user_id,$user_id_temp);
										echo $getuser[0]->username;
													}
													
													
													
													?></td>
													<td><?php echo $alert_list[$al]->towhom;?></td>
                                                    <td><?php echo $alert_list[$al]->vehicle_no;?></td>
                                                    <td><?php echo $alert_list[$al]->alrt_type;?></td>
                                                   
                                                    <td><?php echo $alert_list[$al]->poientryexit;?></td>
                                                    <!-- <td><?php //echo $alert_list[$al]->alert_set_type;?></td> -->
                                                    <td><?php echo $alert_list[$al]->parameter_over_speed;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_alert_from_time;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_alert_to_time;?></td>
                                                    <td><?php echo $alert_list[$al]->idle_hrs;?></td>
                                                    <td><?php echo $alert_list[$al]->mobile;?></td>
                                                    <td><?php echo $alert_list[$al]->email_id;?></td>
                                                    <td><?php echo $alert_list[$al]->status;?></td>
                                                    <!--<td>
                                                    <a class="btn blue" data-toggle="modal" href="#edit_set_alert_model" onclick="fetch_alert('<?php echo $alert_list[$al]->alrt_config_id;?>')"><i class="fa fa-edit"></i></a>
                                                    <a href="javascript:;" class="btn red" onclick="delete_alert('<?php echo $alert_list[$al]->alrt_config_id;?>')"><i class="icon-trash"></i></a>
													</td>-->
                                            </tr>
                                   
                                        <?php $index_test++ ; 
										
										} } ?>
                                            
                                            
                                           
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