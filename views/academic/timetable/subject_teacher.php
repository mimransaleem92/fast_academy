									<select name="employee_id" class="form-control" id="employee_id" >
					                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
					                    <?php foreach($employee_list as $emp){
					                    	$emp_id = $emp->employee_id;
					                    	?> 
					                    	<option value="<?php echo $emp_id;?>" ><?php echo $emp->employee_name;?></option>
					                    <?php } ?>
									</select>