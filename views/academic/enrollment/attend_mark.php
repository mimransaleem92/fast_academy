		<?php echo form_open('students/add_attendance', array('id'=>'attendForm')); ?>
			<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
				<tr>
					<td align="<?php echo $class_left;?>" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1"><?php echo Base_Controller::ToggleLang('Enter Required Information');?></span></td>
				</tr>
				<tr style="display: none;">
					<td width='20%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Student ID');?>:</td>
					<td width='30%'><input type="text" id="student_id" name="student_id" value='<?php if (isset($_GET['student_id'])) echo $_GET['student_id'];?>'  /></td>
					<td width='20%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Date');?>:</td>
					<td width='30%'><input type="text" id="attendance_date" name="attendance_date" value='<?php if(isset($_GET['attendance_date'])) echo $_GET['attendance_date']; ?>' /></td>
				</tr>
				<tr>
					<td align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Reason');?><br>
					<textarea name="attendance_comment" id="attendance_comment" rows="3" cols="40" placeholder="Enter Reason Here!!!"></textarea></td>
				</tr>
			</table>
			<?php /* print_r($_REQUEST); 
				print_r($_GET); */
			?>
		<?php echo form_close();?>