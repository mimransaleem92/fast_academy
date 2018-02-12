<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th class="col-md-1"></th>
			<th><?php echo Base_Controller::ToggleLang('ID');?></th>
			<th><?php echo Base_Controller::ToggleLang('Subject Name');?></th>
			<th><?php echo Base_Controller::ToggleLang('Grade Name');?></th>
			<th><?php echo Base_Controller::ToggleLang('Section');?></th>
			<th class="col-md-3"></th>
		</tr>
	</thead>
	<tbody>					
	<?php $i=0;
    	if(isset($assigned_subject_list) && sizeof($assigned_subject_list) > 0){                          	
        	foreach($assigned_subject_list as $values){ $i++; ?>
            <tr>
            	<td class="col-md-1"><a class="btn default btn-xs red-stripe" href="#" onclick="onclick_remove_subject('<?php echo $values->id;?>')">Remove</a></td>
                <td><?php echo $i;//$values->subject_id?></td>
                <td><?php echo $values->subject_name?></td>
                <td><?php echo $values->course_name;?></td>
                <td><?php echo $values->section;?></td>
                <td class="col-md-3"></td>
           	</tr>
    <?php 	}
    	}
    ?>
	</tbody>
</table>