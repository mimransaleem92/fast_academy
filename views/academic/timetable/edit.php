			<?php  
		    $form = $form[0];
		    echo form_open('timetable/update',array('id'=>'mainForm'));
			
			$name     = array(
						'name' => 'name',
						'id'   => 'name',
						'class' => 'field_big',
						'value' => $form->name);
			$arabic_name = array(
						'name' => 'arabic_name',
						'id'   => 'arabic_name',
						'class' => 'field_big arabic_input',
						'value' => $form->arabic_name);
			echo form_hidden("timetable_id",$form->timetable_id);
						
			?>
			<table width="670" height="325" border="0" cellspacing="0" cellpadding="0" align="center">
	            <tr>
	            	<td valign="top">
						<table width="670" border="0" cellspacing="3" cellpadding="0" align="center">
				            <tr>
			                  	<td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Company');?>:
					            </td>
			                  	<td width="170" align="<?php echo $class_left;?>" valign="middle">
				                  	<select name="company_id" class="select_big" id="company_id">
					                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
					                    <?php foreach($company_list as $comp){ 
					                    	$comp_id = $comp->company_id;
					                    	?> 
					                    	<option value="<?php echo $comp_id;?>" <?php if($comp_id ==  $form->company_id) echo 'selected'; ?> ><?php echo $comp->name;?></option>
					                    <?php } ?>
									</select>
			                  	</td>
			                  	<td width="*" align="<?php echo $class_left;?>" valign="middle"></td>
			                </tr>
				            <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Timetable Name');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($name);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('name');?></td>
			                </tr>
			                 <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Arabic Name');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($arabic_name);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle">&nbsp;</td>
			                </tr>          
			            </table>
			    	</td>
            	</tr>
            </table>
            
              <?php echo form_close();?> 
	                