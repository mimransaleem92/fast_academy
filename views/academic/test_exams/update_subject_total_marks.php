		<?php echo form_open('students/add_attendance', array('id'=>'marksForm')); ?>
			<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
				<?php $t = isset($_GET['t']) ? $_GET['t'] : '';
					  $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : '';
					  $section = isset($_GET['section']) ? $_GET['section'] : '';
				?>
				<tr >
					<td width='30%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Calss');?>:</td>
					<td width='30%'><input type="text" class="form-control input-sm" readonly="readonly" id="course_id" name="course_id" value='<?php echo $course_id;?>' /></td>
					<td width='8%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Test');?>:</td>
					<td width='32%'><input type="text" class="form-control input-sm" readonly="readonly" id="term_name" name="term_name" value='<?php  echo $t; ?>' /></td>
				</tr>
				<?php $total_marks =100; foreach($marks as $m){ ?>
				      <tr>	
				      	<td><?php echo $m->subject_name?>:</td>
				      	<td><input type="text" class="form-control input-sm"  style="text-align: right" id="total_marks<?php echo $m->subject_id?>" name="total_marks<?php echo $m->subject_id?>" value='<?php if(isset($m->total_marks)) echo $m->total_marks;?>' /></td>
				      	<td>&nbsp;</td>
				      </tr>
				<?php } ?>      
				<tr class="hide">
					<td align="<?php echo $class_left;?>"></td>
					<td width='30%'></td>
					<td width='50%' colspan=2>
						<input type="hidden" id="section" name="section" value="<?php echo $section;?>"/>
						<input type="hidden" id="term" name="term" value="<?php echo $t;?>"/>
					</td>
				</tr>
			</table>
		<?php echo form_close(); ?>