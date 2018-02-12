<script language="JavaScript" src="<?php echo base_url();?>assets/js/AddRemoveMutipleSelectionUtils.js"></script>
	<?php $do = $action;?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="1%">&nbsp;</td>
					<td width="95%" colspan="7" align="right"><table border="0" cellspacing="0" cellpadding="0">
						<tr>
			
						  <?php					    
						    $btn = $custom_bar['confirm'];						  	
						    if($btn == 1){
						  		echo '<td><div > <a href="#"  id="btn_confirm" title="'. Base_Controller::ToggleLang('Confirm') .'" style="cursor:pointer;" onclick="confirmCustom()"> </a> </div></td>';
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_confirm_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Confirm is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	
						  	$btn = $custom_bar['save'];						  	
						    if($btn == 1){
						  		echo '<td><div > <a href="#"  id="btn_save" onclick="submitFormCustom()" title="'. Base_Controller::ToggleLang('Save') .'" style="cursor:pointer;" > </a> </div></td>';
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_save_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Save is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	
						  	$btn = $custom_bar['add'];						  	
						    if($btn == 1){
						  		?><td><div > <a href="#" onclick="addCustom()"  id="btn_add" title="<?php echo Base_Controller::ToggleLang('Add');?>" style="cursor:pointer;" > </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_add_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Add is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	
						  	$btn = $custom_bar['edit'];						  	
						    if($btn == 1){
						  		?><td><div > <a href="#"  id="btn_edit" onclick="editCustom('<?php echo $do;?>?method=edit')" title="<?php echo Base_Controller::ToggleLang('Edit');?>" style="cursor:pointer;" > </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_edit_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Edit is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	
						  	$btn = $custom_bar['delete'];						  	
						    if($btn == 1){
						  		?><td><div > <a href="#"  id="btn_del" onclick="delCustom()" title="<?php echo Base_Controller::ToggleLang('Delete');?>" style="cursor:pointer;"> </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_del_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Delete is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" width="13" height="31" /></td>';
						  	
						  	$btn = $custom_bar['print'];						  	
						    if($btn == 1){
						  		?><td><div > <a href="#" onclick="printCustom('<?php echo $do;?>');"  id="btn_print" title="<?php echo Base_Controller::ToggleLang('Print');?>" style="cursor:pointer;"> </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_print_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Print is Disabled') .'" style="cursor:pointer;"  /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" width="13" height="31" /></td>';
						  	
						  	$btn = $custom_bar['view'];						  	
						    if($btn == 1){
						  		?><td><div > <a href="#"  id="btn_view" onclick="editCustom('<?php echo $do;?>')" title="<?php echo Base_Controller::ToggleLang('View');?>" style="cursor:pointer;"> </a> </div></td><?php 
						  	}else if($btn == 2){
						  		?><td><div > <a href="#"  id="btn_view" onclick="search_viewCustom()" title="<?php echo Base_Controller::ToggleLang('View');?>" style="cursor:pointer;"> </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_view_disable.png" width="22" height="25"  title="'. Base_Controller::ToggleLang('View is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	//echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	//echo '<td><a href="#"><img src="'.base_url().'assets/images/'.$lang.'/icon_q1.jpg" alt="" width="20" height="22" border="0" /></a></td>';
						  ?>
						  
						</tr>
					</table>
					</td>
					<td width="1%">&nbsp;</td>
				  </tr>
				</table>