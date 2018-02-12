		<?php echo form_open($model.'/add_plan', array('id'=>'addPlanForm')); ?>
			<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
				<tr>
					<td colspan="2" align="<?php echo $class_left;?>" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1"><?php echo Base_Controller::ToggleLang('Enter Required Information');?></span></td>
				</tr>
				<tr style="display: none;">
					<td width='20%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Batch #');?>:</td>
					<td width='30%'><input type="text" id="batch_id" name="batch_id" value='<?php if (isset($_POST['batch_id'])) echo $_POST['batch_id'];?>'  /></td>
					<td width='20%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Week #');?>:</td>
					<td width='30%'><input type="text" id="week" name="week" value='<?php if(isset($_POST['week'])) echo $_POST['week']; ?>' /></td>
				</tr>
				<tr>
					<td width="25%" >Date:
						<input type="text" class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy" size="16" id="plan_date" name="plan_date" value='<?php echo Util::displayFormat($_POST['plan_date']);?>'/>
					</td>
					<td>Chapter:
						<input type="text" class="form-control input-sm" id="chapter" name="chapter" value='<?php echo $_POST['chapter'];?>' />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('ClassWork');?><br>
						<input type="text" class="form-control input-sm" id="classwork" name="classwork" value='<?php if(isset($_POST['classwork'])) echo $_POST['classwork']; ?>' />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('HomeWork');?><br>
						<input type="text" class="form-control input-sm" id="homework" name="homework" value='<?php if(isset($_POST['homework'])) echo $_POST['homework']; ?>' />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Weekend HW');?><br>
						<input type="text" class="form-control input-sm" id="weekend_hw" name="weekend_hw" value='<?php if(isset($_POST['weekend_hw'])) echo $_POST['weekend_hw']; ?>' />
					</td>		
					<input type="hidden" id="action" name="action" value="save"/>
					<input type="hidden" id="division_id" name="division_id" value="<?php echo $division_id;?>"/>
					<input type="hidden" id="id" name="id" value="<?php if(isset($_POST['id'])) echo $_POST['id'];?>"/>
					<input type="hidden" id="course_id" name="course_id" value="<?php if(isset($_POST['course_id'])) echo $_POST['course_id'];?>"/>
					<input type="hidden" id="subject_id" name="subject_id" value="<?php if(isset($_POST['subject_id'])) echo $_POST['subject_id'];?>"/>
					<input type="hidden" id="term" name="term" value="<?php if(isset($_POST['term'])) echo $_POST['term'];?>"/>
				</tr>
				
			</table>
		<?php /* print_r($_REQUEST); 
				print_r($_POST); */
			echo form_close();
		?>