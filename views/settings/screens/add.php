			<?php  
		
			echo form_open('user/add',array('id'=>'mainForm'));
			
			$username = array(
						'name' => 'username',
						'id'   => 'username',
						'class' => 'field_big',
						'value' => set_value('username'));
			$name     = array(
						'name' => 'name',
						'id'   => 'name',
						'class' => 'field_big',
						'value' => set_value('name'));
			$password = array(
						'class' => 'field_big',
						'name'  => 'password', 'id'  => 'password', 'value'=> set_value('password')
						);
						
			?>
			<table width="670" border="0" cellspacing="3" cellpadding="0">
	            <tr>
                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Name');?></td>
                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($name);?></td>
                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('name');?></td>
                </tr>
                 <tr>
                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Arabic Name');?></td>
                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><input type="text" name="arabic_name" class="field_big" id="arabic_name" value="" /></td>
                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Username');?></td>
                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($username);?></td>
                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('username');?></td>
                </tr>
                <tr>
                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Password');?></td>
                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_password($password);?></td>
                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('password');?></td>
                </tr>
                <tr>
                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Department');?></td>
                  <td width="170" align="<?php echo $class_left;?>" valign="middle">
						 <select name="department_id" class="field_big" id="department_id">
		                    <option value="0"><?php echo Base_Controller::ToggleLang('SELECT'); ?></option>
		                    <?php foreach($dept_list as $dept){ 
		                    	$dept_id = $dept->department_id;
		                    	?> 
		                    	<option value="<?php echo $dept_id;?>" <?php if($dept_id ==  $this->session->userdata('dept_id')) echo 'selected'; ?> ><?php echo $dept->name;?></option>
		                    <?php } ?>
						  </select>
						
				  </td>
                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Active');?></td>
                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><input type="checkbox" name="is_active" class="field_big" id="is_active" checked="checked" /></td>
                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
                </tr>
                
                <tr>
                  <td width="86" valign="top" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('User Role');?></td>
                  <td colspan="2" align="<?php echo $class_left;?>" valign="middle">
						<select name="role_id" id="role_id" class="field_big" >									
		                    <?php foreach($roles as $r){ 
	                    	$id = $r->role_id;
	                    	?> 
		                    	<option value="<?php echo $id;?>"><?php echo Base_Controller::ToggleLang($r->name);?></option>
		                    <?php } ?>	
								
						</select>
				  </td>
                  <td nowrap="nowrap" valign="top"></td>
                </tr>
                
                <tr valign="top">
					<td  align="<?php echo $class_left;?>" ><?php echo Base_Controller::ToggleLang('Select Screen(s)');?> :</td>
					<td  align="<?php echo $class_left;?>" colspan="2"> 
					<table border="0">
						<tr>
							<td width="70" nowrap="nowrap"><?php echo Base_Controller::ToggleLang('Available');?></td>
							<td align="center" valign="middle" width="70" nowrap="nowrap"></td>
							<td width="70" nowrap="nowrap">Selected</td>
							<td nowrap="nowrap">&nbsp;</td>
						</tr>
						<tr>
							<td width="70" nowrap="nowrap">
								<select name="availableScreens" id="availableScreens" size="5" multiple="multiple">									
				                    <?php foreach($screen_list as $v){ 
				                    	$id = $v->screen_id;
				                    	?> 
				                    	<option value="<?php echo $id;?>"><?php echo Base_Controller::ToggleLang($v->name);?></option>
				                    <?php } ?>	
										
								</select>
							</td>
							<td align="center" valign="middle" width="70" nowrap="nowrap">
								<input type="button" value="--&gt;"
								 onclick="moveOptions(this.form.availableScreens, this.form.selected_screens);" /><br />
								<input type="button" value="&lt;--"
								 onclick="moveOptions(this.form.selected_screens, this.form.availableScreens);" />
							</td>
							<td width="70" nowrap="nowrap">
								<select name="selected_screens[]" id="selected_screens" size="5" multiple="multiple" >
								</select>
							</td>
							<td nowrap="nowrap" valign="top"></td>
						</tr>
					</table>
					</td>
				</tr>
				
                <tr>
                  <td  style="padding: 5px" width="86" valign="top" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Screen Actions');?></td>
                  <td colspan="2" align="<?php echo $class_left;?>" valign="middle">
						 <?php foreach($actions as $r){ 
	                    	$id = $r->action_id;
	                    	?> 
	                    	<input type="checkbox" name="screen_action_<?php echo $id;?>" id="screen_action_<?php echo $id;?>" value="<?php echo $id;?>"> <?php echo Base_Controller::ToggleLang($r->name);?> <br /> 
	                    <?php } ?>
	                    
				  </td>
                  <td nowrap="nowrap" valign="top"></td>
                </tr> 
				<tr>
                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Home Page');?></td>
                  <td width="170" align="<?php echo $class_left;?>" valign="middle">
					 <select name="default_screen" class="field_big" id="default_screen">									
		                <option value="dashboard" selected>Dashboard</option>    
                    	<?php foreach($screen_list as $v){?> 
		                    	<option value="<?php echo $v->url;?>"><?php echo Base_Controller::ToggleLang($v->name);?></option>
		                    <?php } ?>
					  </select>
				  </td>
                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
                </tr>                
              </table>
              <?php echo form_close();?> 
	                