<!-- BEGIN SIDEBAR MENU --> 
<ul class="page-sidebar-menu">
	<li>
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		<div class="sidebar-toggler hidden-phone"></div>
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
	</li>
	<li>
		<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
		<form class="sidebar-search" action="<?php echo base_url();?>global_search" method="POST">
			<div class="form-container">
				<div class="input-box">
					<a href="#" class="remove"></a>
					<input type="text" name="search_text" placeholder="<?php echo Base_Controller::ToggleLang('Search');?>..."/>
					<input type="button" class="submit" value=" "/>
				</div>
			</div>
		</form>
		<!-- END RESPONSIVE QUICK SEARCH FORM -->
	</li>
	<?php $non_menu = array('dashboard', 'global_search');
	if($admin_role >= 1){?>
	<li class="start <?php if($action == 'dashboard') echo 'active open';?>" >
		<a href="<?php echo base_url();?>dashboard">
		<i class="fa fa-dashboard"></i> 
		<span class="title"><?php echo Base_Controller::ToggleLang('Dashboard');?></span>
		</a>
	</li>
	<?php } 
	$main_menu = array();
	$sub_menu  = array();
	$active_node = 36;
	
	foreach ($menuList as $node){
		if($node->type == 1){ 
			$main_menu[] = $node;
		}
		else{
			$sub_menu[$node->parent_id][] = $node;
			if($node->url == $action){ $active_node = $node->parent_id; }
		} 
	}
	$flag = 0;
	foreach ($main_menu as $val){
		?>
		<li class="<?php if($val->screen_id == 40) echo 'last '; if(!in_array($action, $non_menu) && $active_node == $val->parent_id ) echo 'active open';?>">
			<a href="javascript:;">
				<i class="<?php echo $val->icon_class;?>"></i>
				<span class="title"><?php echo Base_Controller::ToggleLang($val->name);?></span>
				<span class="arrow <?php if(!in_array($action, $non_menu) && $active_node == $val->parent_id) echo 'open';?>"></span>
			</a>
		<?php 
		
		if(isset($sub_menu[$val->parent_id]) && sizeof($sub_menu[$val->parent_id])>0){?>
		<ul class="sub-menu">
			<?php 
			$sub_arr = $sub_menu[$val->parent_id];
			foreach ($sub_arr as $sub){ ?>
				<li class="<?php if($action == $sub->url) { print 'active'; } ?>"> 
					<a href="<?php echo base_url().$sub->url;?>"><?php echo Base_Controller::ToggleLang($sub->name);?></a>
				</li>
			<?php } ?>
		</ul>
		<?php }?>
		</li>	
	<?php } ?>
	
</ul>