<script language="JavaScript" src="<?php echo base_url();?>assets/js/AddRemoveMutipleSelectionUtils.js"></script>
	<?php $do = $action;?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="1%">&nbsp;</td>
					<td width="95%" colspan="7" align="right"><table border="0" cellspacing="0" cellpadding="0">
						<tr>
			
						  <?php					    
						    $btn = $action_bar['confirm'];
						    if($btn == 1){
						  		echo '<td><div > <span  id="btn_confirm" title="'. Base_Controller::ToggleLang('Confirm') .'" style="cursor:pointer;" onclick="confirm_msg()"> </span> </div></td>';
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_confirm_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Confirm is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	
						  	$btn = $action_bar['save'];						  	
						    if($btn == 1){
						  		echo '<td><div > <a href="#"  id="btn_save" onclick="submitForm()" title="'. Base_Controller::ToggleLang('Save') .'" style="cursor:pointer;" > </a> </div></td>';
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_save_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Save is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	
						  	//$btn = $action_btn['add'];//$action_bar['add'];						  	
						    if(isset($action_btn['add']) && $action_btn['add'] == 1){
						  		?><td><div > <a href="#" onclick="add()"  id="btn_add" title="<?php echo Base_Controller::ToggleLang('Add');?>" style="cursor:pointer;" > </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_add_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Add is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	
						  	//$btn = $action_btn['edit'];//$action_bar['edit'];						  	
						    if(isset($action_btn['edit']) && $action_btn['edit'] == 1){
						  		?><td><div > <a href="#"  id="btn_edit" onclick="edit('<?php echo $do;?>?method=edit')" title="<?php echo Base_Controller::ToggleLang('Edit');?>" style="cursor:pointer;" > </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_edit_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Edit is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	
						  	//$btn = $action_btn['delete'];//$action_bar['delete'];						  	
						    if(isset($action_btn['delete']) && $action_btn['delete'] == 1){
						  		?><td><div > <a href="#"  id="btn_del" onclick="del()" title="<?php echo Base_Controller::ToggleLang('Delete');?>" style="cursor:pointer;"> </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_del_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Delete is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" width="13" height="31" /></td>';
						  	
						  	$btn = $action_bar['print'];						  	
						    if($btn == 1){
						  		?><td><div > <a href="#" onclick="edit('<?php echo $do;?>','htmlprint');"  id="btn_print" title="<?php echo Base_Controller::ToggleLang('Print');?>" style="cursor:pointer;"> </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_print_disable.png" width="22" height="25" title="'. Base_Controller::ToggleLang('Print is Disabled') .'" style="cursor:pointer;"  /></td>';
						  	}
						  	
						  	echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" width="13" height="31" /></td>';
						  	
						  	$btn = $action_bar['view'];						  	
						    if($btn == 1){
						  		?><td><div > <a href="#"  id="btn_view" onclick="edit('<?php echo $do;?>')" title="<?php echo Base_Controller::ToggleLang('View');?>" style="cursor:pointer;"> </a> </div></td><?php 
						  	}else if($btn == 2){
						  		?><td><div > <a href="#"  id="btn_view" onclick="search_view()" title="<?php echo Base_Controller::ToggleLang('View');?>" style="cursor:pointer;"> </a> </div></td><?php 
						  	}else{
						  		echo '<td><img src="'.base_url().'assets/images/'.$lang.'/btn_view_disable.png" width="22" height="25"  title="'. Base_Controller::ToggleLang('View is Disabled') .'" style="cursor:pointer;" /></td>';
						  	}
						  	
						  	//echo '<td><img src="'.base_url().'assets/images/'.$lang.'/f_partition.png" alt="" width="13" height="31" /></td>';
						  	//echo '<td><a id="myAnchor" href="#"><img src="'.base_url().'assets/images/'.$lang.'/icon_q1.jpg" alt="" width="20" height="22" border="0" /></a></td>';
						  ?>
						  
						</tr>
					</table>
					</td>
					<td width="1%">&nbsp;</td>
				  </tr>
				</table>
  <!-- 				
  <div id="myPanel">
    
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                <tr>
                  <td style="border:1px solid #b6c4df;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" class="frame_blue">Icon</td>
                      <td width="9%" class="frame_blue">Description</td>
                      
                    </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="9%" class="help_light"><div > <a href="#"  id="btn_confirm"> </a> </div></td>
                        <td width="9%" class="help_light"><?php echo Base_Controller::ToggleLang('Confirm');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_dark"><div > <a href="#"  id="btn_add"> </a> </div></td>
                        <td width="9%" class="help_dark"><?php echo Base_Controller::ToggleLang('Add');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_light"><div > <a href="#"  id="btn_save"> </a> </div></td>
                        <td width="9%" class="help_light"><?php echo Base_Controller::ToggleLang('Save');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_dark"><div > <a href="#"  id="btn_edit"> </a> </div></td>
                        <td width="9%" class="help_dark"><?php echo Base_Controller::ToggleLang('Edit');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_light"><div > <a href="#"  id="btn_del"> </a> </div></td>
                        <td width="9%" class="help_light"><?php echo Base_Controller::ToggleLang('Delete');?></td>
                      </tr>
                       <tr>
                        <td width="9%" class="help_dark"><div > <a href="#"  id="btn_print"> </a> </div></td>
                        <td width="9%" class="help_dark"><?php echo Base_Controller::ToggleLang('Print');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_light"><div > <a href="#"  id="btn_view"> </a> </div></td>
                        <td width="9%" class="help_light"><?php echo Base_Controller::ToggleLang('View');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_dark"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/btn_confirm_disable.png" alt="" width="22" height="25" /></td>
                        <td width="9%" class="help_dark"><?php echo Base_Controller::ToggleLang('Confirm is disabled');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_dark"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/btn_add_disable.png" alt="" width="22" height="25" /></td>
                        <td width="9%" class="help_dark"><?php echo Base_Controller::ToggleLang('Add is disabled');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_light"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/btn_save_disable.png" alt="" width="22" height="25" /></td>
                        <td width="9%" class="help_light"><?php echo Base_Controller::ToggleLang('Save is disabled');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_dark"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/btn_edit_disable.png" alt="" width="22" height="25" /></td>
                        <td width="9%" class="help_dark"><?php echo Base_Controller::ToggleLang('Edit is disabled');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_light"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/btn_del_disable.png" alt="" width="22" height="25" /></td>
                        <td width="9%" class="help_light"><?php echo Base_Controller::ToggleLang('Delete is disabled');?></td>
                      </tr>
                       <tr>
                        <td width="9%" class="help_dark"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/btn_print_disable.png" alt="" width="22" height="25" /></td>
                        <td width="9%" class="help_dark"><?php echo Base_Controller::ToggleLang('Print is disabled');?></td>
                      </tr>
                      <tr>
                        <td width="9%" class="help_light"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/btn_view_disable.png" alt="" width="22" height="25" /></td>
                        <td width="9%" class="help_light"><?php echo Base_Controller::ToggleLang('View is disabled');?></td>
                      </tr>
					</table>
					</td>
                </tr>               
              </table>
           </div>
		 -->		