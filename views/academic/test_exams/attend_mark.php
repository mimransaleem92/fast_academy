		<?php echo form_open('students/add_attendance', array('id'=>'marksForm')); ?>
			<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
				
				<tr >
					<td width='20%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Student #');?>:</td>
					<td width='30%'><input type="text" class="form-control input-sm" readonly="readonly" id="admission_number" name="admission_number" value='<?php echo $student->admission_number;?>' /></td>
					<td width='8%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Name');?>:</td>
					<td width='42%'><input type="text" class="form-control input-sm" readonly="readonly" id="student_name" name="student_name" value='<?php  echo $student->student_name; ?>' /></td>
				</tr>
				<?php $total_marks =100; ?>
				      <tr>	
				      	<td><?php echo 'Obtained Marks'?>:</td>
				      	<td><input type="text" class="form-control input-sm"  style="text-align: right" id="obtained_marks" name="obtained_marks" value='' /></td>
				      	<td><?php echo '/'.$total_marks?></td>
				      </tr>
				<?php ?>      
				<tr>
					<td align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Total');?>:</td>
					<td width='30%'><input type="text" class="form-control input-sm" id="total" style="text-align: right;" readonly="readonly" value='<?php  echo $total; ?>' /></td>
					<td width='50%' colspan=2>
						<input type="hidden" id="student_id" name="student_id" value='<?php if (isset($_GET['student_id'])) echo $_GET['student_id'];?>'  />
						<input type="hidden" id="course_id" name="course_id" value="<?php echo $student->course_id;?>"/>
						<input type="hidden" id="section" name="section" value="<?php echo $student->section;?>"/>
						<input type="hidden" id="subject_id" name="subject_id" value="<?php if (isset($_GET['sid'])) echo $_GET['sid'];?>"/>
						<input type="hidden" id="term" name="term" value="<?php if (isset($_GET['t'])) echo $_GET['t'];?>"/>
						<input type="hidden" id="division_id" name="division_id" value="<?php echo $student->division_id;?>"/>
						<input type="hidden" id="batch_id" name="batch_id" value="<?php echo $student->batch_id;?>"/>
						
						<input type="hidden" id="count" name="count" value="<?php echo count($header_title);?>"/>
						<input type="hidden" id="f" name="f" value="<?php echo ($flag) ? 'up' : 'in' ;?>"/>
					</td>
				</tr>
			</table>
		<?php echo form_close(); ?>