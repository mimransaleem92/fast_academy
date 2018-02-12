<?php 
 $module_arr = array('36'=>'main', '37'=>'Project Management', '38'=>'Finance', '46'=>'Purchasing');
// echo $toggle;
?>
<!--
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="1%" align="<?php echo $class_right;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/h1_left.jpg" alt="" width="8" height="38" /></td>
	<td width="98%" align="<?php echo $class_left;?>" class="h1_top"><table border="0" cellspacing="0" cellpadding="5">
	  <tr>
		<td nowrap="nowrap"><a href="#" class="h1_sub"> <?php echo Base_Controller::ToggleLang($module_arr[$toggle]);?></a></td>
		<?php if(isset($menu_name) && $menu_name != ""){?>
			<?php if($menu_type != ""){?>
				<td><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/breadcrum_arrow.jpg" alt="" width="7" height="5" /></td>
				<td><a href="#" class="h1_sub"><?php echo Base_Controller::ToggleLang($menu_type); ?></a></td>
			<?php }?>
			<td><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/breadcrum_arrow.jpg" alt="" width="7" height="5" /></td>
			<td><a href="#" onclick="goto_link('<?php echo base_url();?>', '<?php echo $action;?>')" class="h1_sub"><?php echo Base_Controller::ToggleLang($menu_name); ?></a></td>
		<?php }else 
		{
			?>
			<td><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/breadcrum_arrow.jpg" alt="" width="7" height="5" /></td>
			<td><a href="#" class="h1_sub"><?php echo Base_Controller::ToggleLang($model);?></a></td>
			<?php 
		}?>
	  </tr>
	</table></td>
	<td width="1%" align="<?php echo $class_left;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/h1_right.jpg" alt="" width="8" height="38" /></td>
  </tr>
</table>
-->