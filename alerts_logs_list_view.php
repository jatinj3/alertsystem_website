<?php include_once('header2.php'); //page header
include('./config/connect.php');
 ?>
     <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Alerts Log list
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
                                        <span class="caption-subject bold uppercase">Alerts Log List</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                            <!--<th>
                                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>-->
												<th>Sr no.</th>
                                                <th>Username</th>
                                                <th>Vehicle</th>
                                                <th>Alert Type</th>
                                                <th>Sent On</th>
                                                <th>Content</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$query="select * from alerts_log";
										$query_result = mysqli_query($conn2,$query);
										if ($query_result) {
										while ($row =  mysqli_fetch_array($query_result)) {
											// echo "<pre>";
											// print_r($row);die;
											$counter=1;
										?>
											
                                            <tr class="odd gradeX">
                                                <!--<td>
                                                    <input type="checkbox" class="checkboxes" value="1" />
													</td>-->
												<td><?php echo $counter; ?></td>
                                                <td><?php echo $row["username"]; ?></td>
                                                <td><?php echo $row["vehicle_num"]; ?></td>
                                                <td><?php echo $row["alert_type"]; ?></td>
                                                <td><?php echo $row["sent_on"]; ?></td>
                                                <td><?php echo $row["content"]; ?></td>
                                                <td><?php echo $row["status"]; ?></td>
                                                <td>
<a href="javascript:;" class="btn red" onclick="delete_alert_log('<?php echo $row['alrt_log_id'];?>')"> Delete <i class="icon-trash"></i></a>
                                                </td>
                                            </tr>
											<?php 
											$counter++;
											}
										}
											?>
                                            <!--<tr class="odd gradeX">
                                                <td>
                                                    <input type="checkbox" class="checkboxes" value="1" /> </td>
                                                <td>test</td>
                                                <td>DL32A5540</td>
                                                <td>OverSpeed Alert</td>
                                                <td>2020-01-28</td>
                                                <td>this is testing notification</td>
                                                <td>Sent</td>
                                                <td>
                                                    <a href="javascript:;" class="btn red">Delete <i class="icon-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr class="odd gradeX">
                                                <td>
                                                    <input type="checkbox" class="checkboxes" value="1" /> </td>
                                                <td> test </td>
                                                <td>DL32A3642</td>
                                                <td>Ac Alert</td>
                                                <td>2020-02-01</td>
                                                <td>this is testing notification</td>
                                                <td>Sent</td>
                                                <td>
                                                    <a href="javascript:;" class="btn red">Delete <i class="icon-trash"></i></a>
                                                </td>
                                            </tr>-->
                                            
                                             
                                           
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
<script src="ajax/set_alert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>