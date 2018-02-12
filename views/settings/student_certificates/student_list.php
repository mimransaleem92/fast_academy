<div class="table-responsive">
	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<th></th>
				<th><?php echo Base_Controller::ToggleLang('Admission No');?></th>
				<th><?php echo Base_Controller::ToggleLang('Student Name');?></th>
				<th><?php echo Base_Controller::ToggleLang('Printed Date');?></th>
				<th><?php echo Base_Controller::ToggleLang('Action');?></th>
			</tr>
		</thead>
		<tbody>					
			<?php $i=0; 
	            if(isset($student_list) && sizeof($student_list) > 0){ 
					foreach($student_list as $values){ $i++; 
						$url   = base_url().$model."/print_view/"; 
						$param = $values->student_id;
				?>
	            <tr>
	                <td><?php echo $i;?></td>
	                <td><?php echo $values->student_id?></td>
	                <td><?php echo $values->student_name;?></td>
	                <td><?php echo $values->printed_date;?></td>
	                <td>
	                <?php if(isset($values->printed_date) && !is_null($values->printed_date) &&  $values->printed_date != '0000-00-00 00:00:00'){ ?>
	                <a class="btn default btn-xs green-stripe" href="#" onclick="onclink_print('<?php echo base_url().$model.'/reprint_card/'.$param.'?course_id='.$values->course_id.'&batch_id='.$values->batch_id;?>', this)" target="_self">Reprint</a>
	                <?php }else {?>
	                <a class="btn default btn-xs blue-stripe" href="#" onclick="onclink_print('<?php echo base_url().$model.'/print_card/'.$param.'?course_id='.$values->course_id.'&batch_id='.$values->batch_id;?>', this)" target="_self">Print</a>
	                <?php }?>
	                <!-- 
	                <a class="btn default btn-xs green-stripe" <?php //if($balance > 0){ echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Full Payment\'}, \''.$cell_id.'\')"'; }?> href="#">Full</a> | 
	                <a class="btn default btn-xs blue-stripe" <?php //if($balance > 0){ echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Partial Payment\'}, \''.$cell_id.'\')"'; }?> href="#">Partial</a></td>
	                 -->
	        	</tr>
	        <?php 	}
				}
				else{
					echo "<tr><td colspan='7'> No Student Enrolled!! </td></tr>";
			  	}
	    	?>
		</tbody>
	</table>
</div>