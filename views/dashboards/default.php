<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue">
						<div class="visual">
							<i class="fa fa-sign-in"></i>
						</div>
						<div class="details">
							<div class="number">
								1349
							</div>
							<div class="desc">                           
								<?php echo Base_Controller::ToggleLang('New Transaction');?>
							</div>
						</div>
						<a class="more" href="<?php echo base_url();?>trans">
						<?php echo Base_Controller::ToggleLang('View more');?> <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red">
						<div class="visual">
							<i class="fa fa-clock-o"></i>
						</div>
						<div class="details">
							<div class="number">549</div>
							<div class="desc"><?php echo Base_Controller::ToggleLang('Pending Transaction');?></div>
						</div>
						<a class="more" href="<?php echo base_url();?>trans?f=1">
						<?php echo Base_Controller::ToggleLang('View more');?> <i class="m-icon-swapright m-icon-white"></i>
						</a>                 
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat yellow">
						<div class="visual">
							<i class="fa fa-thumbs-o-up"></i>
						</div>
						<div class="details">
							<div class="number">+79%</div>
							<div class="desc"><?php echo Base_Controller::ToggleLang('Approved Transaction');?></div>
						</div>
						<a class="more" href="<?php echo base_url();?>trans?f=2">
						<?php echo Base_Controller::ToggleLang('View more');?> <i class="m-icon-swapright m-icon-white"></i>
						</a>                 
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-check-square-o"></i>
						</div>
						<div class="details">
							<div class="number">+21%</div>
							<div class="desc"><?php echo Base_Controller::ToggleLang('Completed Transaction');?></div>
						</div>
						<a class="more" href="<?php echo base_url();?>trans?f=3">
						<?php echo Base_Controller::ToggleLang('View more');?> <i class="m-icon-swapright m-icon-white"></i>
						</a>                 
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->
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
			</div>
			<div class="clearfix"></div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-bell-o"></i><?php echo Base_Controller::ToggleLang('Pending Transaction');?> </div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn btn-sm default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<?php echo Base_Controller::ToggleLang('Filter By');?>
									<i class="fa fa-angle-down"></i>
									</a>
									<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<label><input type="checkbox" /> Riyadh</label>
										<label><input type="checkbox" checked="checked" /> Jeddah</label>
										<label><input type="checkbox" /> Dammam </label>
									</div>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
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
														Ibraheem Abdulkareem Sulaiman	IQAMA ID:2147846667		0550123786
														<span class="label label-sm label-warning ">
														Take action 
														<i class="fa fa-share"></i>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												Just now
											</div>
										</div>
									</li>
									<li>
										<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-success">                        
															<i class="fa fa-bar-chart-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Saleh Ali Hasan Rajab Aal Rajab, IQAMA ID:2047042268	0550123796  
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													20 mins
												</div>
											</div>
										</a>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">                      
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Hamed Mohammed Seleem	IQAMA ID: 2068132519	0550123806                       
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												24 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">                        
														<i class="fa fa-shopping-cart"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 Abdulaziz Adbdulrahman, IQAMA ID: 2049367176	0550123816<span class="label label-sm label-success">Ref #: DR23923</span>             
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												30 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-success">                      
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Khalid Bin Ali Basareeh	IQAMA ID: 2148339621		0550123826                       
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												24 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-default">                        
														<i class="fa fa-bell-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Kamal Saleh Al Karny	IQAMA ID: 2105640748, Mob:0550123836          
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												2 hours
											</div>
										</div>
									</li>
									<li>
										<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-default">                        
															<i class="fa fa-briefcase"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Aly Mubarak Al Naseeb	IQAMA ID: 2198304046		0550123846  
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													20 mins
												</div>
											</div>
										</a>
									</li>
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
														Jasim Mohammad Saleh Almutairi	IQAMA ID: 2105675967, 		0550123856
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												Just now
											</div>
										</div>
									</li>
									<li>
										<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-danger">                        
															<i class="fa fa-bar-chart-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Fayed Shahi ZaAr Alshemari	IQAMA ID: 2198303279,		0550123866   
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													20 mins
												</div>
											</div>
										</a>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-default">                      
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Habeeb Mohd Yousef Alsoltan	IQAMA ID: 2061663650	0550123876                     
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												24 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">                        
														<i class="fa fa-shopping-cart"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Alaa Rizq Ali Sharaf	IQAMA ID: 2410482013		0550123926<span class="label label-sm label-success">Ref #: DR23923</span>             
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												30 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-success">                      
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Almetwaly Almetwaly Tolba	IQAMA ID: 2410481013   0550123916                      
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												24 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-warning">                        
														<i class="fa fa-bell-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 Mhamed Naseem Farmawi	IQAMA ID: 2294059140	0550123906
														<span class="label label-sm label-default ">Overdue</span>             
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												2 hours
											</div>
										</div>
									</li>
									<li>
										<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">                        
															<i class="fa fa-briefcase"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Mamdouh Ahmed Motawea	IQAMA ID: 2177637267		0550123896 
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													20 mins
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="scroller-footer">
								<div class="pull-right">
									<a href="#"><?php echo Base_Controller::ToggleLang('See All Records');?> <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="portlet box green tasks-widget">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-check"></i><?php echo Base_Controller::ToggleLang('Completed Transaction');?></div>
							<div class="tools">
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="" class="reload"></a>
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn default btn-xs" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<?php echo Base_Controller::ToggleLang('More');?>
									<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="#"><i class="i"></i> <?php echo Base_Controller::ToggleLang('All Transaction');?> </a></li>
										<li class="divider"></li>
										<li><a href="#"><?php echo Base_Controller::ToggleLang('Pending');?> <span class="badge badge-important">4</span></a></li>
										<li><a href="#"><?php echo Base_Controller::ToggleLang('Approved');?> <span class="badge badge-warning">9</span></a></li>
										<li><a href="#"><?php echo Base_Controller::ToggleLang('Completed');?> <span class="badge badge-success">12</span></a></li>
										
									</ul>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="task-content">
								<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1">
									<!-- START TASK LIST -->
									<ul class="task-list">
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""  />                                       
											</div>
											<div class="task-title">
												<span class="task-title-sp">45660 <span class="label label-sm label-success">IQAMA #:</span> 2410482013, <span class="label label-sm label-success">Customer Name:</span> Ibrahim Samir Ibrahim </span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
														<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>                                       
											</div>
											<div class="task-title">
												<span class="task-title-sp"> 65360 <span class="label label-sm label-success">IQAMA #:</span> 2410482013, <span class="label label-sm label-success">Customer Name:</span> Mohmad Mamuod</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
														<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>                                       
											</div>
											<div class="task-title">
												<span class="task-title-sp">35677 <span class="label label-sm label-success">IQAMA #:</span> 2410482013, <span class="label label-sm label-success">Customer Name:</span>   Ibraheem Abu Alkeer</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
														<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""  />                                       
											</div>
											<div class="task-title">
												<span class="task-title-sp">68660 <span class="label label-sm label-success">IQAMA #:</span> 2410482013, <span class="label label-sm label-success">Customer Name:</span> Alshafie Helal</span>
												
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
														<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""  />                                       
											</div>
											<div class="task-title">
												<span class="task-title-sp">43460 <span class="label label-sm label-success">IQAMA #:</span> 2410482013, <span class="label label-sm label-success">Customer Name:</span> Mohamed Ashraf</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
														<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""  />                                       
											</div>
											<div class="task-title">
												<span class="task-title-sp">
												45662 <span class="label label-sm label-success">IQAMA #:</span> 2410482013, <span class="label label-sm label-success">Customer Name:</span>  
												Abdulraziq</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
														<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""  />                                       
											</div>
											<div class="task-title">
												<span class="task-title-sp">49960 <span class="label label-sm label-success">IQAMA #:</span> 2410482013, <span class="label label-sm label-success">Customer Name:</span> Mohmad Albalshi</span>
												
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
														<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""  />                                       
											</div>
											<div class="task-title">
												<span class="task-title-sp">45645 <span class="label label-sm label-success">IQAMA #:</span> 2410482013, <span class="label label-sm label-success">Customer Name:</span> Mohmed Jamal </span>
												
												
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
														<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
													</ul>
												</div>
											</div>
										</li>
										<li class="last-line">
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""  />                                       
											</div>
											<div class="task-title">
												<span class="task-title-sp">45762 <span class="label label-sm label-success">IQAMA #:</span> 2410482013, <span class="label label-sm label-success">Customer Name:</span> Abdhameed </span>
												
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><i class="fa fa-cog"></i><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#"><i class="fa fa-check"></i> Complete</a></li>
														<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
														<li><a href="#"><i class="fa fa-trash-o"></i> Cancel</a></li>
													</ul>
												</div>
											</div>
										</li>
									</ul>
									<!-- END START TASK LIST -->
								</div>
							</div>
							<div class="task-footer">
								<span class="pull-right">
								<a href="#"><?php echo Base_Controller::ToggleLang('See All Records');?> <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
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