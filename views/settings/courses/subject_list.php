<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th></th>
			<th><?php echo Base_Controller::ToggleLang('ID');?></th>
			<th><?php echo Base_Controller::ToggleLang('Subject Code');?></th>
			<th><?php echo Base_Controller::ToggleLang('Subject Name');?></th>
			<th><?php echo Base_Controller::ToggleLang('Period per week');?></th>
			<th><?php echo Base_Controller::ToggleLang('Credit hours');?></th>
		</tr>
	</thead>
	<tbody>					
	<?php $i=0;
          if(isset($assigned_subject_list) && sizeof($assigned_subject_list) > 0){                          	
          	foreach($assigned_subject_list as $values){ $i++; ?>
            	<tr>
                	<td><a class="btn default btn-xs red-stripe" href="#" onclick="onclick_remove_subject('<?php echo $values->subject_id;?>')">Remove</a></td>
                 	<td><?php echo $values->subject_id?></td>
                 	<td><strong><?php echo $values->subject_code; ?></strong></td>
                 	<td><?php echo $values->subject_name?></td>
                 	<td><?php echo $values->period_per_week;?></td>
	                <td><?php echo $values->credit_hours;?></td>
        		</tr>
	<?php 	}
	}
	?>
    </tbody>
</table>