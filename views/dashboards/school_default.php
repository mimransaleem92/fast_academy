<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<div class="dashboard-stat blue">
						<div class="visual">
							<i class="fa fa-sign-in"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php echo $total_in = $total_students;?>
							</div>
							<div class="desc">                           
								<?php echo Base_Controller::ToggleLang('Students');?>
							</div>
						</div>
						<a class="more" href="<?php echo base_url();?>students">
						<?php echo Base_Controller::ToggleLang('View more');?> <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<div class="dashboard-stat red">
						<div class="visual">
							<i class="fa fa-clock-o"></i>
						</div>
						<div class="details">
							<div class="number"><?php echo $total_out = 15;?></div>
							<div class="desc"><?php echo Base_Controller::ToggleLang('Batch');?></div>
						</div>
						<a class="more" href="#">
						<?php echo Base_Controller::ToggleLang('View more');?> <i class="m-icon-swapright m-icon-white"></i>
						</a>                 
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<div class="dashboard-stat yellow">
						<div class="visual">
							<i class="fa fa-thumbs-o-down"></i>
						</div>
						<div class="details">
							<div class="number">
							<?php echo $total_absent = sizeof($absent_list); ?>
							</div>
							<div class="desc"><?php echo Base_Controller::ToggleLang('Total Absent');?></div>
						</div>
						<a class="more" href="<?php echo  ($total_absent > 0) ? base_url().'attendance_report' : '#';?>" >
						<?php echo Base_Controller::ToggleLang('View more');?> <i class="m-icon-swapright m-icon-white"></i>
						</a>                 
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-check-square-o"></i>
						</div>
						<div class="details">
							<div class="number"><?php echo '100%';?></div>
							<div class="desc"><?php echo Base_Controller::ToggleLang('Exam Results');?></div>
						</div>
						<a class="more" href="#">
						<?php echo Base_Controller::ToggleLang('View more');?> <i class="m-icon-swapright m-icon-white"></i>
						</a>                 
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS
			<div class="clearfix"></div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-calendar"></i><?php echo Base_Controller::ToggleLang('General Stats');?></div>
							<div class="actions">
								<a href="javascript:;" class="btn btn-sm yellow easy-pie-chart-reload"><i class="fa fa-repeat"></i> <?php echo Base_Controller::ToggleLang('Reload');?></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-4">
									<div class="easy-pie-chart">
										<div class="number transactions" data-percent="55"><span>+45</span>%</div>
										<a class="title" href="#"> <?php echo Base_Controller::ToggleLang('Pending');?> <i class="m-icon-swapright"></i></a>
									</div>
								</div>
								<div class="margin-bottom-10 visible-sm"></div>
								<div class="col-md-4">
									<div class="easy-pie-chart">
										<div class="number visits" data-percent="85"><span>+65</span>%</div>
										<a class="title" href="#"> <?php echo Base_Controller::ToggleLang('Approved');?> <i class="m-icon-swapright"></i></a>
									</div>
								</div>
								<div class="margin-bottom-10 visible-sm"></div>
								<div class="col-md-4">
									<div class="easy-pie-chart">
										<div class="number bounce" data-percent="46"><span> 44</span>%</div>
										<a class="title" href="#"> <?php echo Base_Controller::ToggleLang('Completed');?> <i class="m-icon-swapright"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-calendar"></i><?php echo Base_Controller::ToggleLang('Server Stats');?></div>
							<div class="tools">
								<a href="" class="collapse"></a>
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="" class="reload"></a>
								<a href="" class="remove"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-4">
									<div class="sparkline-chart">
										<div class="number" id="sparkline_bar"></div>
										<a class="title" href="#"><?php echo Base_Controller::ToggleLang('Network');?> <i class="m-icon-swapright"></i></a>
									</div>
								</div>
								<div class="margin-bottom-10 visible-sm"></div>
								<div class="col-md-4">
									<div class="sparkline-chart">
										<div class="number" id="sparkline_bar2"></div>
										<a class="title" href="#"><?php echo Base_Controller::ToggleLang('CPU Load');?> <i class="m-icon-swapright"></i></a>
									</div>
								</div>
								<div class="margin-bottom-10 visible-sm"></div>
								<div class="col-md-4">
									<div class="sparkline-chart">
										<div class="number" id="sparkline_line"></div>
										<a class="title" href="#"><?php echo Base_Controller::ToggleLang('Load Rate');?> <i class="m-icon-swapright"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<div class="clearfix"></div>
			<div class="row ">
				<?php if(ENABLE_FEE_MODULE == 1){ ?>
				<div class="col-md-6 col-sm-6">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-bell-o"></i><?php echo Base_Controller::ToggleLang('Fee Collection');?> </div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn btn-sm default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<?php echo Base_Controller::ToggleLang('Filter By');?>
									<i class="fa fa-angle-down"></i>
									</a>
									<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<label><input type="checkbox" checked="checked" /> All Section</label>
										<?php 
										/*foreach($collection_list as $values){
											$values_id = $values->payment_id; $selected='';
											if($values_id ==  1) { $selected = 'checked="checked"';}
											?>
											<label><input type="checkbox" <?php echo $selected; ?> /><?php echo substr($values->student_name, 0, 16);?></label>
										<?php } */ ?>
									</div>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								<?php $i=0; 
				            	if(isset($collection_list) && sizeof($collection_list) > 0){
				                	foreach($collection_list as $values){ $i++; 
				                		$st = explode(' ', $values->student_name);
				                		$st_name = $st[0].' '.$st[1];
				                	?>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">                        
														<i class="fa fa-check"></i>
													</div>
												</div>
												<div class="cont-col2">
													
													<div class="desc">
														<?php echo $st_name;?> <span class="label label-sm label-warning"><?php echo ' ('.$values->admission_number.') ';?>:</span> <?php echo $values->course_name;?> </span>
														
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												<?php echo $values->payment_amount;?>
											</div>
										</div>
									</li>
									<?php }
									}
									?>
								</ul>
							</div>
							<div class="scroller-footer">
								<div class="pull-right">
									<a href="<?php echo base_url().'daily_report';?>"><?php echo Base_Controller::ToggleLang('See All Records');?> <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-bell-o"></i><?php echo Base_Controller::ToggleLang('Absent Students');?> </div>
							<div class="actions">
								<a href="<?php echo base_url().$model.'/absent_students'?>" class="reload"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								<?php $i=0; 
				            	if(isset($absent_list) && sizeof($absent_list) > 0){
				                	foreach($absent_list as $values){ $i++; 
				                		$st = explode(' ', $values->student_name);
				                		$st_name = $st[0].' '.$st[1];
				                	?>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">                        
														<i class="fa fa-check"></i>
													</div>
												</div>
												<div class="cont-col2">
													
													<div class="desc">
														<span class="label label-sm label-danger"><?php echo $values->admission_number.'';?></span> &nbsp; <span style="text-transform: capitalize;"><?php echo $st_name.' ('.$values->course_name.'-'.$values->section .') ';?></span>
														
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="desc">
											<?php echo $values->attendance_comment;?>
											</div>
										</div>
										
									</li>
									<?php }
									}
									?>
								</ul>
							</div>
							<div class="scroller-footer">
								<div class="pull-right">
									<a href="<?php echo base_url().'#';?>"><?php echo Base_Controller::ToggleLang('See All Records');?> <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="portlet box green tasks-widget">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-check"></i><?php echo Base_Controller::ToggleLang('Upcoming Events');?></div>
							<div class="tools">
								
							</div>
							<div class="actions"></div>
						</div>
						<div class="portlet-body">
							<div class="task-content">
								<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1">
									<!-- START TASK LIST -->
									<ul class="task-list">
										<?php $i=0; 
						            	if(isset($outgoing_document) && sizeof($outgoing_document) > 0){
						                	foreach($outgoing_document as $values){ $i++; //$st =  ($values->document_type == 'IN' ? 'Incoming' : 'Outgoing'); ?>
											<li>
												<div class="task-checkbox">
													<input type="checkbox" class="liChild" value=""  />                                       
												</div>
												<div class="task-title">
													<span class="task-title-sp"><?php echo $values->document_id;?> <span class="label label-sm label-success"><?php echo ' ('.$values->department_name.') ';?>:</span> <?php echo $values->document_name;?>, </span> <span class="label label-sm label-success right">Created By: <?php echo $values->uploaded_by;?></span>
												</div>
												<!-- <div class="task-config">
													<div class="task-config-btn btn-group">
														<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
														<ul class="dropdown-menu pull-right">
															<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
															<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
															<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
														</ul>
													</div>
												</div> -->
											</li>
										<?php }
										}
										?>
									</ul>
									<!-- END START TASK LIST -->
								</div>
							</div>
							<div class="task-footer">
								<span class="pull-right">
								<a href="<?php echo base_url().'#';?>"><?php echo Base_Controller::ToggleLang('See All Records');?> <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- BEGIN PAGE LEVEL PLUGINS -->
			<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>     
			<script src="<?php echo base_url();?>assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
			<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
			<script src="<?php echo base_url();?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
			<!-- END PAGE LEVEL PLUGINS -->
			<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<script src="<?php echo base_url();?>assets/scripts/app.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/scripts/index.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/scripts/tasks.js" type="text/javascript"></script>        
			<!-- END PAGE LEVEL SCRIPTS -->  
			
			<script>
				jQuery(document).ready(function() {    
				   App.init(); // initlayout and core plugins
				   Index.init();
				   //Index.initJQVMAP(); // init index page's custom scripts
				   //Index.initCalendar(); // init index page's custom scripts
				   Index.initCharts(); // init index page's custom scripts
				   //Index.initChat();
				   Index.initMiniCharts();
				   Index.initDashboardDaterange();
				   Index.initIntro();
				   Tasks.initDashboardWidget();
				});
			</script>
			<!-- END JAVASCRIPTS -->