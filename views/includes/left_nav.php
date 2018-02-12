<script>
function showHideMenu(menu_stat){
	if(menu_stat == 'close'){
		document.getElementById('leftnav_td').style.display = "none";
		document.getElementById('middle_td').style.display = "none";
		document.getElementById('rightnav_img').style.display = "";
	}
	else if(menu_stat == 'open'){
		document.getElementById('leftnav_td').style.display = "";
		document.getElementById('middle_td').style.display = "";
		document.getElementById('rightnav_img').style.display = "none";
		
	}
}
function toggleHead(count, prefix){
	ele = getElementsByClass(prefix);
	count = ele.length;
	
	toggleModules(prefix,count);	
}

function toggleMain(count, prefix){
	toggleModules(prefix,count);
	hideShowRows(prefix+'_d',"none");
	hideShowRows(prefix+'_s',"none");
	hideShowRows(prefix+'_t',"none");
	hideShowRows(prefix+'_r',"none");
	
}

function toggleModules(prefix,count){
	for(i=1;i<=count;i++){
		ele = document.getElementById(prefix+'_'+i);
		if(ele != null){
			if(document.getElementById(prefix+'_'+i).style.display=="")
				document.getElementById(prefix+'_'+i).style.display="none";
			else
				document.getElementById(prefix+'_'+i).style.display="";
		}
	}

	var curr_src = document.getElementById(prefix+'_image');
	if(curr_src!=null){
		curr_src = curr_src.src;
		src_arr = curr_src.split('/');
		var len = src_arr.length-1;
		if(src_arr[len] == "bullet_2a.jpg"){
			document.getElementById(prefix+'_image').src = "<?php echo base_url().'assets/images/'.$lang;?>/bullet_2b.jpg";
		}
		else {
			document.getElementById(prefix+'_image').src = "<?php echo base_url().'assets/images/'.$lang;?>/bullet_2a.jpg";
		}
	}
		
}
function hideShowRows(prefix,str) {
	ele = getElementsByClass(prefix);
	count = ele.length;

	for(i=0;i<count;i++){				
			ele[i].style.display=str;
	}
	document.getElementById(prefix+'_image').src = "<?php echo base_url().'assets/images/'.$lang;?>/bullet_2b.jpg";
	if(str == "none"){
		document.getElementById(prefix+'_image').src = "<?php echo base_url().'assets/images/'.$lang;?>/bullet_2a.jpg";
	}
}
function getElementsByClass(searchClass,node,tag) {
	var classElements = new Array();
	if ( node == null )
		node = document;
	if ( tag == null )
		tag = '*';
	var els = node.getElementsByTagName(tag);
	var elsLen = els.length;
	var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
	for (i = 0, j = 0; i < elsLen; i++) {
		if ( pattern.test(els[i].className) ) {
			classElements[j] = els[i];
			j++;
		}
	}
	return classElements;
}

</script>

<?php 

function getModule($menuList){
	$list = array();
	$pre_parent_id = -1;
	for($i=0;$i<sizeof($menuList);$i++){		          			
	    $menu = $menuList[$i];
	    $parent_id = $menu->parent_id;
	    
		if($pre_parent_id==-1 || $pre_parent_id!=$parent_id){
			array_push($list, $menu);	
		}
		$pre_parent_id = $parent_id;		
	}
	return $list;
}

function getMenuByType($menuList,$type,$parent_id){
	$list = array();
	for($i=0;$i<sizeof($menuList);$i++){		          			
	    $menu = $menuList[$i];
	    $t = $menu->type;
	    $p = $menu->parent_id;
	    
		if($t == $type && $parent_id == $p){
			array_push($list, $menu);	
		}
	}
	
	return $list;
}

function selectedModuleId($module,$url){
	
	for($i=0;$i<sizeof($module);$i++){		          			
          $menu = $module[$i];
          $menu_url = $menu->url;
          $parent_id = $menu->parent_id;
          
          	          	
          if($url == $menu_url){
          	return $menu;          
          }
	}
}
//print '==>'.$action.'==>'. $toggle;
?>
				<tr>
					<td id="leftnav_td" width="252" rowspan="3" align="left" valign="top">
					<form id="MenuFrom" method="post">
					<input type="hidden" name="toggle" id="toggle" value="<?php echo $toggle;?>" />
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					
					<tr>
						<td height="22" colspan="1" align="<?php echo $class_left;?>" valign="top" bgcolor="#FFFFFF">
						 	<table width="100%" border="0" align="<?php echo $class_left;?>" cellpadding="0" cellspacing="0">
					          <tr>
								<td width="100%" height="22" colspan="1" align="<?php echo $class_left;?>" valign="top"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/leftwhite_top.jpg" alt="" width="252" height="14" /></td>
							  </tr>
					          <tr>
					            <td align="<?php echo $class_left;?>"><span onclick="showHideMenu('close')" ><img id="leftnav_img" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/nav_toggle_open.png" title="<?php echo Base_Controller::ToggleLang('Close'); ?>" width="26" height="21" border="0" /></span></td>
					          </tr>
					        </table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							
							<?php 
								$modules = getModule($menuList);
								$sel_module = selectedModuleId($menuList,$action);
							    
								for($in=0;$in<sizeof($modules);$in++){
						    		$module = $modules[$in];
						    		$parent_id = $module->parent_id;
						    		$count = 34;
						    		if($sel_module!=null){
										$sel_p =$sel_module->parent_id;
										$sel_t =$sel_module->type;
									}else{
										$sel_p = $toggle;
										$sel_t = 0;
									
									}
							
							?>
					          <tr id="<?php echo $parent_id; ?>">
					            <td align="<?php echo $class_left;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/bullet_1.jpg" alt="" width="12" height="18" /></td>
					            <td align="<?php echo $class_left;?>" class="left_nav_part"><a href="#" onclick="toggleMain(4,'<?php echo $parent_id; ?>');" class="leftnav"><?php echo Base_Controller::ToggleLang($module->parent_name);?></a></td>
					          </tr>
						          <?php 
						          //if($this->session->userdata('dept_id') == '1')
						          {
						          ?>
						          <tr id="<?php echo $parent_id."_1"; ?>"  style="<?php if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
						                <td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_d_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/bullet_2a.jpg" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="<?php echo base_url();?>participant" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Participant');?></a></td>
						              </tr>
						              
						            </table></td>
						          </tr>
						          <?php 
								  }
						          ?>
						     	  <tr id="<?php echo $parent_id."_2"; ?>"  style="<?php if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
					                	<td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_s_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=1){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#"  onclick="toggleHead(<?php echo $count?>,'<?php echo $parent_id;?>_s');" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Settings');?></a>
						                </td>
						              </tr>
						            </table></td>
						          </tr>	          
						          <?php 
						          		$c = 0;
						          		$settings = getMenuByType($menuList, 1,$parent_id);    
						          		for($i=0;$i<sizeof($settings);$i++){
						          					          			
						          			$menu = $settings[$i];
						          			$t = $menu->type;
					          				$c++;
					          				$menu_url = $menu->url;
					          				$sele = false;
					          				if($action == $menu_url){
					          					$menu_name = $menu->name;
					          					$menu_type = "Settings";
					          					$selected_menu = $menu;
					          					$sele = true;
					          				}	          				
						          ?>
									          <tr style="<?php if($sel_p != $parent_id || $sel_t !=1) { echo "display:none";}?>" id="<?php echo $parent_id."_s_".$c; ?>" class="<?php echo $parent_id;?>_s">
									            <td align="<?php echo $class_left;?>">&nbsp;</td>
									            <td align="<?php echo $class_left;?>" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
									              <tr>
									              <?php if($sele){?>				                
										              <td width="3%" align="<?php echo $class_right;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/highlighted_left.jpg" alt="" width="6" height="28" /></td>
								                      <td width="7%" bgcolor="#2C3A5D">&nbsp;</td>
								                      <td width="8%" bgcolor="#2C3A5D"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/bullet_3.gif" alt="" width="4" height="6" /></td>
								                      <td width="79%" bgcolor="#2C3A5D"><a href="#"  onclick="goto_link('<?php echo base_url();?>', '<?php echo $menu->url;?>', '<?php echo $parent_id;?>')" class="leftnav_white"><?php echo Base_Controller::ToggleLang($menu->name);?></a></td>
								                      <td width="3%"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/highlighted_right.jpg" alt="" width="6" height="28" /></td>
									               <?php }else{?>
										            <td width="9%" align="<?php echo $class_left;?>">&nbsp;</td>
									                <td width="9%"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/bullet_3.gif" alt="" width="4" height="6" /></td>
									                <td width="82%"><a href="#" onclick="goto_link('<?php echo base_url();?>', '<?php echo $menu->url;?>', '<?php echo $parent_id;?>')" class="leftnav_sub"><?php echo Base_Controller::ToggleLang($menu->name);?></a></td>
										           <?php  }?>
									              </tr>
									            </table></td>
									          </tr>
								  <?php } ?>
					          <tr id="<?php echo $parent_id."_3"; ?>"  style="<?php if($sel_p != $parent_id){echo 'display: none'; }?>">
					            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
						                <td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_t_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=2){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#" onclick="toggleHead(<?php echo $count?>,'<?php echo $parent_id;?>_t');"  class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Transactions');?></a>
						                
						                </td>
						              </tr>
						            </table></td>
						          </tr>
								  <?php 
						          		$c = 0;
						          		$settings = getMenuByType($menuList, 2,$parent_id);         		
						          		for($i=0;$i<sizeof($settings);$i++){		          			
						          			$menu = $settings[$i];
						          			$t = $menu->type;
					          				$c++;
					          				$menu_url = $menu->url;
					          				$sele = false;
					          				if($action == $menu_url){
					          					$menu_name = $menu->name;
					          					$menu_type = "Transactions";
					          					$selected_menu = $menu;
					          					$sele = true;
					          				}	          				
						          ?>
									          <tr style="<?php if($sel_p != $parent_id || $sel_t !=2) { echo "display:none";}?>" id="<?php echo $parent_id."_t_".$c; ?>" class="<?php echo $parent_id;?>_t">
									            <td align="<?php echo $class_left;?>">&nbsp;</td>
									            <td align="<?php echo $class_left;?>" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
									              <tr>
									              <?php if($sele){?>				                
										              <td width="3%" align="<?php echo $class_right;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/highlighted_left.jpg" alt="" width="6" height="28" /></td>
								                      <td width="7%" bgcolor="#2C3A5D">&nbsp;</td>
								                      <td width="8%" bgcolor="#2C3A5D"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/bullet_3.gif" alt="" width="4" height="6" /></td>
								                      <td width="79%" bgcolor="#2C3A5D"><a href="#" onclick="goto_link('<?php echo base_url();?>', '<?php echo $menu->url;?>', '<?php echo $parent_id;?>')" class="leftnav_white"><?php echo Base_Controller::ToggleLang($menu->name);?></a></td>
								                      <td width="3%"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/highlighted_right.jpg" alt="" width="6" height="28" /></td>
									               <?php }else{?>
										            <td width="9%" align="<?php echo $class_left;?>">&nbsp;</td>
									                <td width="9%"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/bullet_3.gif" alt="" width="4" height="6" /></td>
									                <td width="82%"><a href="#" onclick="goto_link('<?php echo base_url();?>', '<?php echo $menu->url;?>', '<?php echo $parent_id;?>')" class="leftnav_sub"><?php echo Base_Controller::ToggleLang($menu->name);?></a></td>
										           <?php  }?>
									              </tr>
									            </table></td>
									          </tr>
								  <?php } ?>			  
								<tr id="<?php echo $parent_id."_4"; ?>"  style="<?php if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
							            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							              <tr>
							                <td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_r_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=3){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
							                <td width="91%"><a href="#" onclick="toggleHead(<?php echo $count?>,'<?php echo $parent_id;?>_r');"  class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Reports');?></a>
							                
							                </td>
							              </tr>
							            </table></td>
							          </tr>
							           <?php 
						          		$c = 0;
						          		$settings = getMenuByType($menuList, 3,$parent_id);         		
						          		for($i=0;$i<sizeof($settings);$i++){		          			
						          			$menu = $settings[$i];
						          			$t = $menu->type;
					          				$c++;
					          				$menu_url = $menu->url;
					          				$sele = false;
					          				if($action == $menu_url){
					          					$menu_name = $menu->name;
					          					$menu_type = "Reports";
					          					$selected_menu = $menu;
					          					$sele = true;
					          				}	          				
						       		   ?>
									          <tr style="<?php if($sel_p != $parent_id || $sel_t !=3) { echo "display:none";}?>" id="<?php echo $parent_id."_r_".$c; ?>" class="<?php echo $parent_id;?>_r">
									            <td align="<?php echo $class_left;?>">&nbsp;</td>
									            <td align="<?php echo $class_left;?>" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
									              <tr>
									              <?php if($sele){?>				                
										              <td width="3%" align="<?php echo $class_right;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/highlighted_left.jpg" alt="" width="6" height="28" /></td>
								                      <td width="7%" bgcolor="#2C3A5D">&nbsp;</td>
								                      <td width="8%" bgcolor="#2C3A5D"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/bullet_3.gif" alt="" width="4" height="6" /></td>
								                      <td width="79%" bgcolor="#2C3A5D"><a href="#" onclick="goto_link('<?php echo base_url();?>', '<?php echo $menu->url;?>', '<?php echo $parent_id;?>')" class="leftnav_white"><?php echo Base_Controller::ToggleLang($menu->name);?></a></td>
								                      <td width="3%"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/highlighted_right.jpg" alt="" width="6" height="28" /></td>
									               <?php }else{?>
										            <td width="9%" align="<?php echo $class_left;?>">&nbsp;</td>
									                <td width="9%"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/bullet_3.gif" alt="" width="4" height="6" /></td>
									                <td width="82%"><a href="#" onclick="goto_link('<?php echo base_url();?>', '<?php echo $menu->url;?>', '<?php echo $parent_id;?>')" class="leftnav_sub"><?php echo Base_Controller::ToggleLang($menu->name);?></a></td>
										           <?php  }?>
									              </tr>
									            </table></td>
									          </tr>
									  <?php }?>
					        <?php }?>
					          </table>
					     </td>
					</tr>
					<tr>
					     <td height="22" colspan="3" align="<?php echo $class_left;?>" valign="top"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/leftwhite_btm.jpg" alt="" width="252" height="14" /></td>
					</tr>
					</table>
					</form>
					</td>
					<td id="middle_td" rowspan="3">&nbsp;</td>
					<td width="100%" valign="bottom" height="14">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
						        <td width="14" align="<?php echo $class_left;?>" valign="bottom"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/right_white_top_2.jpg" alt="" width="14" height="14" /></td>
						        <td width="*" align="<?php echo $class_left;?>" valign="bottom" bgcolor="#FFFFFF"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/right_white_top_mid.jpg" alt="" width="7" height="14" /></td>
						        <td width="14" align="<?php echo $class_left;?>" valign="bottom"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/right_white_top_1.jpg" alt="" width="14" height="14" /></td>
					      	</tr>
						</table>
					</td>
				</tr>
  				<tr>
					
					<td align="center" valign="top" bgcolor="#FFFFFF">
						<table width="98%" border="0" align="<?php echo $class_left;?>" cellpadding="0" cellspacing="0">
				          <tr>
				            <td align="<?php echo $class_left;?>"><span onclick="showHideMenu('open')" ><img id="rightnav_img" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/nav_toggle.png" title="<?php echo Base_Controller::ToggleLang('Open'); ?>" width="26" height="21" border="0" <?php if($menu_show == 1) echo "style='display: none'";?> /></span></td>
				          </tr>
				        </table>
						<table width="98%" border="0" cellspacing="3" cellpadding="0">
				           <tr><td><?php include "link_nav.php";?></td></tr>
