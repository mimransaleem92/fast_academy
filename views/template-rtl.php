<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>HET | <?php echo $title ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="MobileOptimized" content="320">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="<?php echo base_url();?>assets/plugins/gritter/css/jquery.gritter-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="<?php echo base_url();?>assets/plugins/select2/select2_metro_rtl.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap_rtl.css" rel="stylesheet" />
	
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN THEME STYLES --> 
	<link href="<?php echo base_url();?>assets/css/style-metronic-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style-responsive-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/plugins-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/pages/tasks-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/themes/default-rtl.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url();?>assets/css/custom-rtl.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<?php echo $header?>
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        
			<?php echo $sidebar?>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<div class="modal fade" id="ajax" tabindex="-1" role="basic" aria-hidden="true">
				<img src="<?php echo base_url();?>assets/img/ajax-modal-loading.gif" alt="" class="loading">
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler"></div>
				<div class="toggler-close"></div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>THEME COLOR</span>
						<ul>
							<li class="color-black current color-default" data-style="default"></li>
							<li class="color-blue" data-style="blue"></li>
							<li class="color-brown" data-style="brown"></li>
							<li class="color-purple" data-style="purple"></li>
							<li class="color-grey" data-style="grey"></li>
							<li class="color-white color-light" data-style="light"></li>
						</ul>
					</div>
					<div class="theme-option">
						<span>Layout</span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>Header</span>
						<select class="header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>Sidebar</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>Footer</span>
						<select class="footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END BEGIN STYLE CUSTOMIZER -->            
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<?php $partent = 'Home'; $sub_node = 'Dashboard';
							foreach ($menuList as $node){
								if($node->type == 2){
									if($node->url == $action){ $active_node = $node->parent_id; $partent = $node->parent_name; $sub_node = $node->name;}
								} 
							}
						?>
					<h3 class="page-title">
						<?php echo Base_Controller::ToggleLang( $sub_node );?> <small></small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
							<span>Actions</span> <i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>dashboard"><?php echo Base_Controller::ToggleLang('main');?></a> 
							<i class="fa fa-angle-left"></i>
						</li>
						<li>
							<a href="<?php echo base_url().$action;?>">
							<?php
							$node = '';
							if($action == 'trans'){
								echo Base_Controller::ToggleLang('Transactions');
							}elseif($action == 'user'){
								echo Base_Controller::ToggleLang('Settings'); $node = 'Users';
							}else {
								echo Base_Controller::ToggleLang($action);
							}
							?></a>
							
						</li>
						<?php
							
							if($action == 'trans' && isset($_GET['f']) && $_GET['f'] == '1'){
								$node = 'Pending';
							}else if($action == 'trans' && isset($_GET['f']) && $_GET['f'] == '3'){
								$node = 'Completed';
							}else if($action == 'trans' && isset($_GET['f']) && $_GET['f'] == '2'){
								$node = 'Approved';
							}else if($action == 'trans' && !isset($_GET['f'])){
								$node = "New";
							}
							
							if($node != ''){
						?>
						<li>
							<i class="fa fa-angle-left"></i>
							<a href="<?php echo base_url().$action;?>">
								<?php echo Base_Controller::ToggleLang($node);?>
							</a>
						</li>
						<?php }?>
						
					</ul>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<?php echo $content?>
				</div>
			</div>	
		</div>
		<!-- END PAGE -->
			
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
		<?php echo $footer?>
	<!-- END FOOTER -->
	</body>
</html>