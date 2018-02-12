<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title><?php echo $title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE STYLES -->
	<link href="<?php echo base_url();?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="<?php echo base_url();?>assets/global/css/components.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/admin/layout2/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url();?>assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-boxed page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed-hide-logo">
	<?php echo $header?>
	<div class="clearfix"></div>
	<div class="container">
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<?php echo $sidebar?>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		    <div class="page-content-wrapper">
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
		    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		    <!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel">
				<div class="toggler tooltips" data-container="body" data-placement="left" data-html="true" data-original-title="Click to open advance theme customizer panel">
					<i class="icon-settings"></i>
				</div>
				<div class="toggler-close">
					<i class="icon-close"></i>
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
						THEME COLOR </span>
						<ul>
							<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default">
							</li>
							<li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey">
							</li>
							<li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue">
							</li>
							<li class="color-dark tooltips" data-style="dark" data-container="body" data-original-title="Dark">
							</li>
							<li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
						Layout </span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Header </span>
						<select class="page-header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Top Dropdown</span>
						<select class="page-header-top-dropdown-style-option form-control input-small">
							<option value="light" selected="selected">Light</option>
							<option value="dark">Dark</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Mode</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Style</span>
						<select class="sidebar-style-option form-control input-small">
							<option value="default" selected="selected">Default</option>
							<option value="compact">Compact</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Menu </span>
						<select class="sidebar-menu-option form-control input-small">
							<option value="accordion" selected="selected">Accordion</option>
							<option value="hover">Hover</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Position </span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Footer </span>
						<select class="page-footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
		    <!-- END STYLE CUSTOMIZER -->
		    
		    <!-- BEGIN PAGE HEADER-->
		    <?php 
				$partent = 'Home'; $sub_node = 'Dashboard';
				if($model == 'global_search'){ $partent = 'Home'; $sub_node = 'Global Search';}
						foreach ($menuList as $node){
							
							if($node->type == 2){
								if($node->url == $action){ $active_node = $node->parent_id; $partent = $node->parent_name; $sub_node = $node->name;}
							} 
							elseif($node->type == 1 && !is_null($node->url) ){
							 	$u = $action.'/'.$method_called;
								if ($node->url == $u){
									$active_node = $node->parent_id; $partent = 'Home'; $sub_node = $node->parent_name; //$sub_node = $node->name;
								}
							} 
						}
			?>
			<h3 class="page-title">
			<?php echo $sub_node;?>
			</h3>
		    <div class="page-bar">
			    <ul class="page-breadcrumb">
				    <li><i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>"><?php echo $partent;?></a> 
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url().$action;?>"><?php echo $sub_node;?></a>
					</li>
			    </ul>
			    <div class="page-toolbar">
				    <div class="btn-group pull-right" <?php if($sub_node == 'Dashboard') echo 'style="display:none;"'?>>
					    <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					    Actions <i class="fa fa-angle-down"></i>
					    </button>
					    <ul class="dropdown-menu pull-right" role="menu">
							<li><a href="#" onclick="add()">New Record</a></li>
							<li><a href="#" onclick="edit('<?php echo $action;?>?method=edit')" >Update</a></li>
							<li><a href="#" onclick="del()">Delete</a></li>
							<li class="divider"></li>
							<li><a href="#" onclick="submitForm()">Save</a></li>
						</ul>
				    </div>
			    </div>
		    </div>
		    <!-- END PAGE HEADER-->
		    <!-- BEGIN PAGE CONTENT-->
		    <div class="row">
			    
			    	<?php echo $content?>
			    
		    </div>
		    <!-- END PAGE CONTENT-->
		    </div>
		    </div>
		<!-- END CONTENT -->		
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
		<?php echo $footer?>
	<!-- END FOOTER -->
</div>	
		<?php echo $page_script?>
	<dir id="divMain" style="display: none;"></dir>
	</body>
	<?php //include_once 'includes/popup.php';?>
</html>