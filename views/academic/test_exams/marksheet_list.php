	<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
		
		<tr style="border-bottom: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
			<th ><?php echo Base_Controller::ToggleLang('No');?></th>
			<th style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Admission #');?></th>
			<th style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Student Name');?></th>
			<th style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Obtain Marks');?></th>
		</tr>	
		
		<?php $s=0;
			foreach ($student_list as $student){
				$student_id = $student->student_id;
				$s++;
				$title = "Mark Sheet";
				$param = 'student_id='.$student_id."&course_id=".$c."&section=".$sec."&sid=".$subject_id."&t=".$term;
				$url   = base_url().$model."/add_marks";
		?>
		<tr>
			<td><?php echo $s;?></td>
			<td style="padding-left: 4px"><?php echo $student->admission_number;?></td>
			<td style="padding-left: 4px; padding-right: 4px"><?php echo $student->student_name;?>
				<span style="float: right;" <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \'tbl_marksheet\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i></span>
				<span style="float: right; padding-right: 10px;"><?php echo $student->student_name_ar;?></span>
			</td>
			<td style="padding-left: 4px; padding-right: 4px; text-transform: uppercase"><?php echo $student->obtained_marks;?>
		</tr>
		<?php } ?>
	</table>