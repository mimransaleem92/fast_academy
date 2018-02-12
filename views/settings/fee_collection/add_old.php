<script type="text/javascript">
<!--
$(function() {
	$.datepicker.setDefaults({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
	$( "#start_date" ).datepicker();
	$( "#end_date" ).datepicker();
	$( "#due_date" ).datepicker();
});
//-->
</script>
	<?php  
		echo form_open('fee_collection/add',array('id'=>'mainForm'));
		$collection     = array( 'name' => 'collection_name', 'id'   => 'collection_name', 'class' => 'field_big', 'value' => set_value('collection_name'));
		$start_date     = array( 'name' => 'start_date', 'id'   => 'start_date', 'class' => 'field_big', 'value' => set_value('start_date'));
		$end_date     = array( 'name' => 'end_date', 'id'   => 'end_date', 'class' => 'field_big', 'value' => set_value('end_date'));
		$due_date     = array( 'name' => 'due_date', 'id'   => 'due_date', 'class' => 'field_big', 'value' => set_value('due_date'));
	?>
			<table width="670" height="325" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	            	<td valign="top">
                  		<table width="670" border="0" cellspacing="3" cellpadding="0">
				        	<tr>
			                  	<td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Course Name');?>:
					            </td>
			                  	<td width="170" align="<?php echo $class_left;?>" valign="middle">
				                  	<select name="course_id" class="select_big" id="course_id" onchange="onchange_courses(this.value)">
					                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
					                    <?php foreach($courses_list as $course){ 
					                    	$course_id = $course->course_id;
					                    	?> 
					                    	<option value="<?php echo $course_id;?>" ><?php echo $course->course_name;?></option>
					                    <?php } ?>
									</select>
			                  	</td>
			                  	<td width="*" align="<?php echo $class_left;?>" valign="middle"> <?php echo form_error('course_id');?> </td>
			                </tr>
			                <tr>
			                  	<td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Batch Name');?>:
					            </td>
			                  	<td width="170" align="<?php echo $class_left;?>" valign="middle" id="td_batch">
				                  	<select name="batch_id" class="select_big" id="batch_id" >
					                    <option value="">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
									</select>
			                  	</td>
			                  	<td width="*" align="<?php echo $class_left;?>" valign="middle"> <?php echo form_error('batch_id');?> </td>
			                </tr>
				        	<tr>
			                  <td width="86" align="<?php echo $class_left;?>" nowrap="nowrap"><?php echo Base_Controller::ToggleLang('Collection Name');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($collection);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('collection_name');?></td>
			                </tr>
			                <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Start Date');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($start_date);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('start_date');?></td>
			                </tr>
			                <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('End Date');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($end_date);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('end_date');?></td>
			                </tr>
			                <tr>
			                  <td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Due Date');?></td>
			                  <td width="170" align="<?php echo $class_left;?>" valign="middle"><?php echo form_input($due_date);?></td>
			                  <td width="*" align="<?php echo $class_left;?>" valign="middle"><?php echo form_error('due_date');?></td>
			                </tr>
			                <tr>
			                	<td></td>
			                	<td colspan="2" class="red" nowrap="nowrap">
			                		<?php 
			                		/* if(form_error('course_id')) echo '1- '.form_error('course_id');
			                		if(form_error('batch_name')) echo '2-'.form_error('batch_name');
			                		if(form_error('start_date')) echo '<br>3- '.form_error('start_date');
			                		if(form_error('end_date')) { echo '<br>4- '.form_error('end_date'); } */
			                		?>
			                	</td>
			                </tr>  
			            </table>
			    	</td>
            	</tr>
            </table>
                  
            <?php echo form_close();?> 
	        <script> 

	        function onchange_courses(val){
		        if(val != ''){
	        		get('<?php echo base_url().'fee_collection/batches/';?>'+val, '', 'td_batch','false','');
		        }
	        }
	        
	        </script>    