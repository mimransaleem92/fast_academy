			<?php  
		
			echo form_open('timetable/add',array('id'=>'mainForm'));
			
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
						
			?>
			<table width="670" height="325" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	            	<td valign="top">
                  		<table width="670" border="0" cellspacing="3" cellpadding="0">
					    	<tr>
			                  	<td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Company');?>:
					            </td>
			                  	<td width="170" align="<?php echo $class_left;?>" valign="middle">
				                  	<select name="company_id" class="select_big" id="company_id">
					                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
					                    <?php foreach($company_list as $comp){ 
					                    	$comp_id = $comp->company_id;
					                    	?> 
					                    	<option value="<?php echo $comp_id;?>" <?php if($comp_id ==  $this->session->userdata('company_id')) echo 'selected'; ?> ><?php echo $comp->name;?></option>
					                    <?php } ?>
									</select>
			                  	</td>
			                  	<td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('name');?></td>
			                </tr>
				            <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Timetable Name');?>:</td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($name);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('name');?></td>
			                </tr>
			                 <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Arabic Name');?>:</td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($arabic_name);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
			                </tr>                
			            </table>
			    	</td>
            	</tr>
            </table>
                  
            <?php echo form_close();?> 
	                