    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
	    <!-- BEGIN SIDEBAR MENU -->
	    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
		<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
		<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
		<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
		    <li class="start active ">
				<a href="index.html">
				<i class="icon-home"></i>
				<span class="title">Dashboard</span>
				<span class="selected"></span>
				</a>
			</li>
			<li>
				<a href="javascript:;">
				<i class="icon-basket"></i>
				<span class="title">eCommerce</span>
				<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="ecommerce_index.html">
						<i class="icon-home"></i>
						Dashboard</a>
					</li>
					<li>
						<a href="ecommerce_orders.html">
						<i class="icon-basket"></i>
						Orders</a>
					</li>
					<li>
						<a href="ecommerce_orders_view.html">
						<i class="icon-tag"></i>
						Order View</a>
					</li>
					<li>
						<a href="ecommerce_products.html">
						<i class="icon-handbag"></i>
						Products</a>
					</li>
					<li>
						<a href="ecommerce_products_edit.html">
						<i class="icon-pencil"></i>
						Product Edit</a>
					</li>
				</ul>
			</li>
		    
		    <?php $non_menu = array('dashboard', 'global_search');?>
			<li class="start <?php if($action == 'dashboard') echo 'active';?>" >
				<a href="<?php echo base_url();?>dashboard">
					<i class="fa fa-dashboard"></i> 
					<span class="title"><?php echo Base_Controller::ToggleLang('Dashboard');?></span>
					<?php if($action == 'dashboard') echo '<span class="selected"></span>';?> 
				</a>
			</li>
			<?php 
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
				$flag = 'N';
				if(!is_null($val->url)){
					$u = $action.'/'.$method_called;
					if ($val->url == $u){
						$flag = 'Y';
					}
				}
					
				?>
				<li class="<?php if($val->screen_id == 40) echo 'last '; if(!in_array($action, $non_menu) && $active_node == $val->parent_id ) echo 'active open'; if($flag=='Y') echo ' active';?>">
					<a href="<?php if(!is_null($val->url))echo base_url().$val->url; else echo 'javascript:;';?>">
						<i class="<?php echo $val->icon_class;?>"></i>
						<span class="title"><?php echo Base_Controller::ToggleLang($val->name);?></span>
						
						<?php if(isset($sub_menu[$val->parent_id]) && sizeof($sub_menu[$val->parent_id])>0){?>
							<span class="arrow <?php if(!in_array($action, $non_menu) && $active_node == $val->parent_id) echo 'open';?>"></span>
						<?php }
						if($flag=='Y') echo '<span class="selected"></span>';
						?>
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
	    <!-- END SIDEBAR MENU -->
    </div>
    </div>
    <!-- END SIDEBAR -->  