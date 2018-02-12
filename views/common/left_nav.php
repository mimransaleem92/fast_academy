<script>
function showHideMenu(menu_stat){
	if(menu_stat == 'close'){
		setCookie('vws_left_menu','open','31');
		document.getElementById('leftnav_td').style.display = "none";
		document.getElementById('middle_td').style.display = "none";
		document.getElementById('rightnav_img').style.display = "";
	}
	else if(menu_stat == 'open'){
		setCookie('vws_left_menu','close','31');
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
	hideShowRows(prefix+'_c',"none");
	hideShowRows(prefix+'_f',"none");
	hideShowRows(prefix+'_k',"none");
	hideShowRows(prefix+'_n',"none");
	hideShowRows(prefix+'_g',"none");
}

function toggleModules(prefix,count){
	for(i=0;i<=count;i++){
		ele = document.getElementById(prefix+'_'+i);
		if(ele){
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
			document.getElementById(prefix+'_image').src = "<?php echo base_url().'assets/images/'.$lang.'/bullet_2b.jpg';?>";
		}
		else {
			document.getElementById(prefix+'_image').src = "<?php echo base_url().'assets/images/'.$lang.'/bullet_2a.jpg';?>";
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
$show_left_menu = '';
$menu_show = 1;
if(isset($_COOKIE['vws_left_menu'])){
	//echo $_COOKIE['vws_left_menu'];
	if($_COOKIE['vws_left_menu'] == 'open'){
		$show_left_menu = 'style="display:none"';
		$menu_show = 0;
	}
}

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
  $menu_display = '';
  if($userrole == 3){  // 3 for End User
  	$menu_display = 'display: none;';
  }
  $tech_display = '';
  if($userrole == 5){  // 5 for Technician
  	$tech_display = 'display: none;';
  }
?>
				<tr>
					<td id="leftnav_td" <?php echo $show_left_menu;?> width="252" rowspan="3" align="left" valign="top" >
					<form id="MenuFrom" method="post">
					<input type="hidden" name="toggle" id="toggle" value="" />
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					
					<tr>
						<td align="<?php echo $class_left;?>" valign="top" bgcolor="#FFFFFF" height="525px">
						 	<table style="float: left" width="100%" border="0" align="<?php echo $class_left;?>" cellpadding="0" cellspacing="0">
					          <tr>
								<td width="100%" height="22" colspan="1" align="<?php echo $class_left;?>" valign="top"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/leftwhite_top.jpg" alt="" width="252" height="14" /></td>
							  </tr>
					          <tr>
					            <td align="<?php echo $class_left;?>"><span onclick="showHideMenu('close')" ><img id="leftnav_img" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/nav_toggle_open.png" title="<?php echo Base_Controller::ToggleLang('Close'); ?>" width="26" height="21" border="0" /></span></td>
					          </tr>
					        </table>
							<table style="float: right" width="100%"  border="0" cellspacing="0" cellpadding="0">
							
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
										$sel_t = 1;
									
									}
							
							?>
					          <tr id="<?php echo $parent_id; ?>">
					            <td align="<?php echo $class_left;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/bullet_1.jpg" alt="" width="12" height="18" /></td>
					            <td align="<?php echo $class_left;?>" class="left_nav_part"><a href="#" class="leftnav">Home</a></td>
					            <!-- <td align="<?php //echo $class_left;?>" class="left_nav_part"><a href="#" onclick="toggleMain(5,'<?php //echo $parent_id; ?>');" class="leftnav"><?php echo Base_Controller::ToggleLang($module->parent_name);?></a></td>-->
					          </tr>
						      
						     	  <tr id="<?php echo $parent_id."_2"; ?>"  style="<?php if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
					                	<td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_s_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=1){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#"  onclick="javascript:toggleHead('<?php echo $count?>','<?php echo $parent_id;?>_s');" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Service Desk');?></a>
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
					          				if($action == $menu_url || substr($action,-7) == $menu_url){ // second condition for request menu seleted 
					          					$menu_name = $menu->name;
					          					$menu_type = "Service Desk"; // Settings
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
							  <tr id="<?php echo $parent_id."_4"; ?>"  style="<?php echo $tech_display.$menu_display; if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
							            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							              <tr>
							                <td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_r_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=3){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
							                <td width="91%"><a href="#" onclick="window.open('http://localhost:49224/HelpDesk/Default.aspx','_blank');" onclick="javascript:toggleHead('<?php echo $count?>','<?php echo $parent_id;?>_r');"  class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Assets Management');?></a>
							                
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
					          					$menu_type = "Assets Management"; // Reports
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
									  <?php } ?>
					          <tr style="display:none" id="<?php echo $parent_id."_3"; ?>"  style="<?php echo $menu_display; if($sel_p != $parent_id){echo 'display: none'; }?>">
					            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
						                <td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_t_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=2){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#" onclick="window.open('<?php echo base_url();?>coming_soon','_self');" onclick="javascript:toggleHead('<?php echo $count?>','<?php echo $parent_id;?>_t');"  class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Inventory Managment');?></a>
						                
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
					          					$menu_type = "Inventory Managment"; // Transactions
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
								
					        	<tr id="<?php echo $parent_id."_6"; ?>"  style="<?php echo $tech_display.$menu_display;// if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
					                	<td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_n_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=5){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#"  onclick="javascript:toggleHead('<?php echo $count?>','<?php echo $parent_id;?>_n');" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Contract Management');?></a>
						                </td>
						              </tr>
						            </table></td>
						          </tr>
						          <?php 
						          		$cont = 0;
						          		$contract = getMenuByType($menuList, 5,$parent_id);    
						          		for($i=0;$i<sizeof($contract);$i++){
						          					          			
						          			$menu = $contract[$i];
						          			$t = $menu->type;
					          				$cont++;
					          				$menu_url = $menu->url;
					          				$sele = false;
					          				if($action == $menu_url){
					          					$menu_name = $menu->name;
					          					$menu_type = "Contract Management";
					          					$selected_menu = $menu;
					          					$sele = true;
					          				}	          				
						          ?>
									          <tr style="<?php if($sel_p != $parent_id || $sel_t !=5) { echo "display:none";}?>" id="<?php echo $parent_id."_n_".$cont; ?>" class="<?php echo $parent_id;?>_n">
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
								  <tr id="<?php echo $parent_id."_1"; ?>"  style="<?php echo $tech_display.$menu_display; if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
					                	<td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_d_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=0){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#"  onclick="javascript:toggleHead('<?php echo $count?>','<?php echo $parent_id;?>_d');" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Vendor Managment');?></a>
						                </td>
						              </tr>
						            </table></td>
						          </tr>
						          <?php 
						          		$c = 0;
						          		$hr = getMenuByType($menuList, 0,$parent_id);    
						          		for($i=0;$i<sizeof($hr);$i++){
						          					          			
						          			$menu = $hr[$i];
						          			$t = $menu->type;
					          				$c++;
					          				$menu_url = $menu->url;
					          				$sele = false;
					          				if($action == $menu_url){
					          					$menu_name = $menu->name;
					          					$menu_type = "Vendor Managment";
					          					$selected_menu = $menu;
					          					$sele = true;
					          				}	          				
						          ?>
									          <tr style="<?php if($sel_p != $parent_id || $sel_t !=0) { echo "display:none";}?>" id="<?php echo $parent_id."_d_".$c; ?>" class="<?php echo $parent_id;?>_d">
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
						          <tr style="display:none" id="<?php echo $parent_id."_7"; ?>"  style="<?php echo $menu_display;// if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
					                	<td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_y_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=6){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#"  onclick="window.open('<?php echo base_url();?>coming_soon','_self');" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Repairs');?></a>
						                </td>
						              </tr>
						            </table></td>
						          </tr>
						          
						          <tr style="display:none" id="<?php echo $parent_id."_8"; ?>"  style="<?php  if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
					                	<td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_f_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=7){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#"  onclick="window.open('<?php echo base_url();?>coming_soon','_self');" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('FAQs');?></a>
						                </td>
						              </tr>
						            </table></td>
						          </tr>
						          <?php 
						          		$f = 0;
						          		$faq = getMenuByType($menuList, 7,$parent_id);    
						          		for($i=0;$i<sizeof($faq);$i++){
						          					          			
						          			$menu = $faq[$i];
						          			$t = $menu->type;
					          				$f++;
					          				$menu_url = $menu->url;
					          				$sele = false;
					          				if($action == $menu_url){
					          					$menu_name = $menu->name;
					          					$menu_type = "FAQs";
					          					$selected_menu = $menu;
					          					$sele = true;
					          				}	          				
						          ?>
									          <tr style="<?php if($sel_p != $parent_id || $sel_t !=7) { echo "display:none";}?>" id="<?php echo $parent_id."_f_".$f; ?>" class="<?php echo $parent_id;?>_f">
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
						          <tr id="<?php echo $parent_id."_9"; ?>"  style="<?php echo $tech_display.$menu_display;// if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
					                	<td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_k_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=8){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#"  onclick="javascript:toggleHead('<?php echo $count?>','<?php echo $parent_id;?>_k');" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Knowledge Management');?></a>
						                </td>
						              </tr>
						            </table></td>
						          </tr>
						          <?php 
						          		$k = 0;
						          		$knowledge = getMenuByType($menuList, 8,$parent_id);    
						          		for($i=0;$i<sizeof($knowledge);$i++){
						          					          			
						          			$menu = $knowledge[$i];
						          			$t = $menu->type;
					          				$k++;
					          				$menu_url = $menu->url;
					          				$sele = false;
					          				if($action == $menu_url){
					          					$menu_name = $menu->name;
					          					$menu_type = "Knowledge Management";
					          					$selected_menu = $menu;
					          					$sele = true;
					          				}	          				
						          ?>
									          <tr style="<?php if($sel_p != $parent_id || $sel_t !=8) { echo "display:none";}?>" id="<?php echo $parent_id."_k_".$k; ?>" class="<?php echo $parent_id;?>_k">
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
						          <tr id="<?php echo $parent_id."_10"; ?>"  style="<?php  echo $tech_display.$menu_display; if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
					                	<td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_g_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=9){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#"  onclick="javascript:toggleHead('<?php echo $count?>','<?php echo $parent_id;?>_g');" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Reports');?></a>
						                </td>
						              </tr>
						            </table></td>
						          </tr>
						          
						          <?php 
						          		$g = 0;
						          		$reports = getMenuByType($menuList, 9,$parent_id);    
						          		for($i=0;$i<sizeof($reports);$i++){
						          					          			
						          			$menu = $reports[$i];
						          			$t = $menu->type;
					          				$g++;
					          				$menu_url = $menu->url;
					          				$sele = false;
					          				if($action.'/'.$model == $menu_url){
					          					$menu_name = $menu->name;
					          					$menu_type = "Reports";
					          					$selected_menu = $menu;
					          					$sele = true;
					          				}	          				
						          ?>
									          <tr style="<?php if($sel_p != $parent_id || $sel_t !=9) { echo "display:none";}?>" id="<?php echo $parent_id."_g_".$g; ?>" class="<?php echo $parent_id;?>_g">
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
								  <?php }?>
						          <tr id="<?php echo $parent_id."_5"; ?>"  style="<?php  echo $tech_display.$menu_display; if($sel_p != $parent_id){echo 'display: none'; }?>">
						            <td align="<?php echo $class_left;?>">&nbsp;</td>
						            <td align="<?php echo $class_left;?>" valign="middle" class="left_nav_part"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						              <tr>
					                	<td width="9%" align="<?php echo $class_left;?>"><img id="<?php echo $parent_id;?>_c_image" src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/<?php if($sel_p != $parent_id || $sel_t !=4){echo 'bullet_2a.jpg';}else{ echo 'bullet_2b.jpg';}?>" alt="" width="9" height="9" /></td>
						                <td width="91%"><a href="#"  onclick="javascript:toggleHead('<?php echo $count?>','<?php echo $parent_id;?>_c');" class="leftnav_sub"><?php echo Base_Controller::ToggleLang('Setup');?></a>
						                </td>
						              </tr>
						            </table></td>
						          </tr>
						          
						          <?php 
						          		$c = 0;
						          		$setup = getMenuByType($menuList, 4,$parent_id);    
						          		for($i=0;$i<sizeof($setup);$i++){
						          					          			
						          			$menu = $setup[$i];
						          			$t = $menu->type;
					          				$c++;
					          				$menu_url = $menu->url;
					          				$sele = false;
					          				if($action == $menu_url){
					          					$menu_name = $menu->name;
					          					$menu_type = "Setup";
					          					$selected_menu = $menu;
					          					$sele = true;
					          				}	          				
						          ?>
									          <tr style="<?php if($sel_p != $parent_id || $sel_t !=4) { echo "display:none";}?>" id="<?php echo $parent_id."_c_".$c; ?>" class="<?php echo $parent_id;?>_c">
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
								  <?php }
								  }
						          ?>
					          </table>
					     </td>
					</tr>
					<tr>
					     <td height="22" colspan="3" align="<?php echo $class_left;?>" valign="top"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/leftwhite_btm.jpg" alt="" width="252" height="14" /></td>
					</tr>
					</table>
					</form>
					</td>
					<td id="middle_td" <?php echo $show_left_menu;?> rowspan="3">&nbsp;</td>
					<td width="100%" valign="bottom" height="14">
						<table width="100%">
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
						<table style="float: left" width="98%" border="0" align="<?php echo $class_left;?>" cellpadding="0" cellspacing="0">
				          <tr>
				            <td align="<?php echo $class_left;?>"><span onclick="showHideMenu('open')" ><img id="rightnav_img"  src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/nav_toggle.png" title="<?php echo Base_Controller::ToggleLang('Open'); ?>" width="26" height="21" border="0" <?php if($menu_show == 1) echo "style='display: none'";?> /></span></td>
				          </tr>
				        </table>
				        <br/>
						<table style="float: right" width="98%" border="0" cellspacing="3" cellpadding="0" >
				           <tr><td><?php include "link_nav.php";?></td></tr>
