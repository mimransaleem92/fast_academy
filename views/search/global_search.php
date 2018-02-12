	<table class="table table-striped table-bordered table-advance table-hover">
		<tbody><thead>
			<tr>
				<th>#</th>
				<th><?php echo Base_Controller::ToggleLang('No');?></th>
				<th><?php echo Base_Controller::ToggleLang('Category / Detartment');?></th>
				<th><?php echo Base_Controller::ToggleLang('Document Name');?></th>
				<th><?php echo Base_Controller::ToggleLang('Type');?></th>
				<th><?php echo Base_Controller::ToggleLang('');?></th>
			</tr>
		</thead>
		<tbody>					
			<?php $i=0; 
            	if(isset($document_list) && sizeof($document_list) > 0){
                	foreach($document_list as $values){ $i++; ?>
                    	<tr>
                            <td><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->document_id;?>" /></td>
                            <td><?php echo $values->document_id; ?></td>
                            <td><?php echo $values->department_name?></td>
                            <td><?php echo $values->document_name?></td>	                          
                            <td>
                            <?php 
                            	$is_active = $values->document_type; 
                            	$st =  ($is_active == 'IN' ? 'Incoming' : 'Outgoing');
	                            echo Base_Controller::ToggleLang($st);
                            ?></td>
                            <td><a class="btn default btn-xs red-stripe" href="<?php echo base_url().$model.'/view?id='.$values->document_id;?>">View</a></td>
                    	</tr>
			<?php 	}
				}	?>
    	</tbody>
	</table>
	<input type="hidden" id="count" value="<?php echo $i;?>"/>