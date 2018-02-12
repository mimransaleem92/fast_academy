<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php echo $title ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="MobileOptimized" content="320">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
	
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN THEME STYLES --> 
	<link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url();?>assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed" oncontextmenu="return ture;">
	<?php echo $header?>
	<div class="clearfix"></div>
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
				<div class="modal-dialog modal-wide">
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
			<div class="theme-panel hidden-xs hidden-sm text-right">
				<?php $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id'); 
				if($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1 || $this->session->userdata(SESSION_CONST_PRE.'both_division') == 'Y'){
				?>
				<div style="float: right; color: #FFF; padding-top: 23px; font-size: 1.3em; ">
					<div class="input-group">
						<div data-toggle="buttons" class="btn-group" >
							<label class="btn btn-sm green <?php if($div_id == '1') echo 'active';?>">
							<input type="radio" class="toggle" name="selected_division" id="selected_division_b" <?php if($div_id == '1') echo 'checked="checked"';?> value="1" onchange="change_division(this.value)"> <?php echo Base_Controller::ToggleLang('VIB');?>
							</label>
							<label class="btn btn-sm green <?php if($div_id == '2') echo 'active';?>">
							<input type="radio" class="toggle" name="selected_division" id="selected_division_g" <?php if($div_id == '2') echo 'checked="checked"';?> value="2" onchange="change_division(this.value)"> <?php echo Base_Controller::ToggleLang('VIG');?>
							</label>
						</div>
					</div>
				 </div>
				 <?php } ?>
			</div>
			<!-- END BEGIN STYLE CUSTOMIZER -->            
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<?php 
					$m = $this->uri->segment(2);
					$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
					$admin_role = $this->session->userdata(SESSION_CONST_PRE.'admin_role');
					$partent = 'Home'; $sub_node = (false) ? 'Student' : 'Dashboard'; 
					if($model == 'global_search'){ $partent = 'Home'; $sub_node = 'Global Search';}
							foreach ($menuList as $node){
								if($node->type == 2){
									if($node->url == $action){ $active_node = $node->parent_id; $partent = $node->parent_name; $sub_node = $node->name;}
								} 
							}
							
							$hide_for_controllers = array('dashboard', 'global_search','daily_report', 'defaulter_report','summary_report', 'student_report');
						?>
					<h3 class="page-title">
						<?php echo $sub_node;?> <small><?php echo str_replace('_', " ", $m);?></small>
					</h3>
					
					<ul class="page-breadcrumb breadcrumb">
						<?php if($action_menu && $admin_role >= 1){?>
						<li class="btn-group" <?php if( in_array($model, $hide_for_controllers) ) echo 'style="display:none;"'?>>
							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
							<span>Actions</span> <i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<?php if($admin_role >= 1 ){?>
								<li><a href="#" onclick="add()">New Record</a></li>
								<?php } if($admin_role >= 2){?>
								<li><a href="#" onclick="edit('<?php echo $action;?>?method=edit')" >Update</a></li>
								<?php } if($admin_role >= 3){?>
								<li><a href="#" onclick="del()">Delete</a></li>
								<?php } if($admin_role >= 1 ){?>
								<li class="divider"></li>
								<li><a href="#" onclick="submitForm()">Save</a></li>
								<?php }?>
							</ul>
						</li>
						<?php }?>
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>"><?php echo $partent;?></a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url().$action;?>"><?php echo $sub_node;?></a>
						</li>
						
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
		<?php echo $page_script?>
	<div class="modal fade" id="ajax" tabindex="-1" role="basic" aria-hidden="true">
		<img src="<?php echo base_url();?>assets/img/ajax-modal-loading.gif" alt="" class="loading">
	</div>
	</body>
	<?php //include_once 'includes/popup.php';?>
</html>