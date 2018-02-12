	<table width="100%">
       	<?php if(sizeof($previous_data) > 0){ 
			$title = "::Update Previous Data::";
			foreach ($previous_data as $val) {
				$cell_id = $val->id;
				$tooltip = "";
				$param = 'id='. $val->id .'&student_id='.$val->student_id;
				$url   = base_url().$model."/edit_previous_data";
		?>
		<tr>
			<td width='20%' style="border-bottom: 1px solid #8CBAE8; vertical-align: top;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Institution');?>:</td>
			<td width='30%' style="border-bottom: 1px solid #8CBAE8; vertical-align: top;" ><?php echo $val->institute;?></td>
			<td width='20%' style="border-bottom: 1px solid #8CBAE8; vertical-align: top;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Year');?>:</td>
			<td width='30%' style="border-bottom: 1px solid #8CBAE8; vertical-align: top;" > <span style="float: left;"><?php echo $val->year;?></span> <span style="float: right;"><a href="#" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'previousDetailForm\', \'tblPrevData\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.'\')"'; ?>  >Edit</a></span></td>
		</tr>
		<tr>
			<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Course');?>:</td>
			<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $val->course;?></td>
			<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Total Mark');?>:</td>
			<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $val->total_marks;?></td>
			
		</tr>
		<?php } 
		} ?>
	</table>