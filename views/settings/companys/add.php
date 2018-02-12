			<?php  
		
			echo form_open('company/add',array('id'=>'mainForm'));
			
			$name     = array(
						'name' => 'name',
						'id'   => 'name',
						'class' => 'field_big',
						'value' => set_value('name'));
			$arabic_name = array(
						'name' => 'arabic_name',
						'id'   => 'arabic_name',
						'class' => 'field_big arabic_input',
						'value' => set_value('arabic_name'));
			$address     = array(
						'name' => 'address',
						'id'   => 'address',
						'class' => 'field_big',
						'value' => set_value('address'));
			$zip_code    = array(
						'name' => 'zip_code',
						'id'   => 'zip_code',
						'class' => 'field_big',
						'value' => set_value('zip_code'));
			$city     = array(
						'name' => 'city',
						'id'   => 'city',
						'class' => 'field_big',
						'value' => set_value('city'));
			$email     = array(
						'name' => 'email',
						'id'   => 'email',
						'class' => 'field_big',
						'value' => set_value('email'));
			$phone     = array(
						'name' => 'phone',
						'id'   => 'phone',
						'class' => 'field_big',
						'value' => set_value('phone'));
			?>
			<table width="670" height="325" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	            	<td valign="top">
                  		<table width="670" border="0" cellspacing="3" cellpadding="0">
				            <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Name');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($name);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('name');?></td>
			                </tr>
			                 <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Arabic Name');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($arabic_name);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
			                </tr>
			                 <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Address');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($address);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
			                </tr>
			                <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Zip Code');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($zip_code);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
			                </tr>
			                <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('City');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($city);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
			                </tr> 
			                <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Email');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($email);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
			                </tr>
			                <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Phone');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($phone);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
			                </tr>               
			            </table>
			    	</td>
            	</tr>
            </table>
                  
            <?php echo form_close();?> 
	                