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
		    $form = $form[0];
		    echo form_open('fee_collection/update',array('id'=>'mainForm'));
		    echo form_hidden("batch_id",$form->batch_id);
		   
		    $start_date     = array( 'name' => 'start_date', 'id'   => 'start_date', 'class' => 'field_big', 'value' => $form->start_date);
		    $end_date     = array( 'name' => 'end_date', 'id'   => 'end_date', 'class' => 'field_big', 'value' => $form->end_date);
		    $due_date     = array( 'name' => 'due_date', 'id'   => 'due_date', 'class' => 'field_big', 'value' => $form->due_date);
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
    					                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
    					                    <?php foreach($courses_list as $course){ 
    					                    	$course_id = $course->course_id;
    					                    	?> 
    					                    	<option value="<?php echo $course_id;?>" <?php if($course_id ==  $form->course_id) echo 'selected'; ?> ><?php echo $course->course_name;?></option>
    					                    <?php } ?>
    									</select>
    			                  	</td>
    			                  	<td width="*" align="<?php echo $class_left;?>" valign="middle"> </td>
    			                </tr>
    			                <tr>
			                  	<td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Batch Name');?>:
						            </td>
				                  	<td width="170" align="<?php echo $class_left;?>" valign="middle" id="td_batch">
					                  	<select name="batch_id" class="select_big" id="batch_id" >
											<option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
												<?php 
												if(isset($batch_list) && sizeof($batch_list)>0){
												foreach($batch_list as $batch){ 
												$batch_id = $batch->batch_id;
												?> 
											<option value="<?php echo $batch_id;?>" <?php if($batch_id ==  $form->batch_id) echo 'selected'; ?> ><?php echo $batch->batch_name;?></option>
												<?php }
												} ?>
										</select>
				                  	</td>
				                  	<td width="*" align="<?php echo $class_left;?>" valign="middle"> <?php echo form_error('batch_id');?> </td>
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