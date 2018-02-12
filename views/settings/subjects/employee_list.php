<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th></th>
			<th><?php echo Base_Controller::ToggleLang('ID');?></th>
			<th><?php echo Base_Controller::ToggleLang('Employee Name');?></th>
		</tr>
	</thead>
	<tbody>					
	<?php $i=0;
          if(isset($associated_employee_list) && sizeof($associated_employee_list) > 0){                          	
          	foreach($associated_employee_list as $values){ $i++; ?>
            	<tr>
                	<td><a class="btn default btn-xs red-stripe" href="#" onclick="onclick_remove_employee('<?php echo $values->employee_id;?>')">Remove</a></td>
                 	<td><strong><?php echo $values->employee_id; ?></strong></td>
                 	<td><?php echo $values->employee_name?></td>
        		</tr>
	<?php 	}
	}
	?>
    </tbody>
</table>