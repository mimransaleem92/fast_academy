<?php if(sizeof($guardian) > 0){ $val = $guardian[0];?>
	In case of emergencies,<br>
	contact : <?php echo $val->first_name. ' ' .$val->last_name. ' ('. $val->mobile_phone . ')';
	$param = 'student_id='.$val->student_id;
	$url   = base_url().$model."/edit_parent_data";
	?>
	
	<a href="#" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'parentDetailForm\', \'tblParentDetail\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Update Parent Info\'})"'; ?> >Edit</a>
	                	
	<?php }else {
	$param = 'student_id='.$student_id;
	$url   = base_url().$model."/add_parent_data";
	echo '<a href="#" onclick="showInnerBox( [\''. $url .'\', \'_insert\', \'parentDetailForm\', \'tblParentDetail\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Add Parent Info\'})" >Add</a> Contact Detail'; }
?>