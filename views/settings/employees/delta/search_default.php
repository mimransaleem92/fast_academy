<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th style="text-align:center">#</th>
							<th style="text-align:center"><?php echo Base_Controller::ToggleLang('ID');?></th>
							<th><?php echo Base_Controller::ToggleLang('Code');?></th>
							<th><?php echo Base_Controller::ToggleLang('Emp Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Iqama ID');?></th>
							<th><?php echo Base_Controller::ToggleLang('Expiry');?></th>
							<th><?php echo Base_Controller::ToggleLang('Contanct #');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php
                  		  $i=0;
                          if(isset($employee_list) && sizeof($employee_list) > 0){
                          	foreach($employee_list as $values){
                          		$i++;
                        ?>
	                          <tr>
	                            <td style="text-align:center"><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" <?php //if($values->status == 'Issued') echo 'disabled="disabled"';?> value="<?php echo $values->employee_id;?>" /></td>
	                            <td style="color:#888888;text-align:center"><strong><?php echo $i; ?></strong></td>
	                            <td nowrap="nowrap"><?php echo $values->employee_code;?></td>
	                            <td ><?php echo $values->surname.' '.$values->first_name?></td>
	                            <td ><?php echo $values->iqama_id; ?></td>	                            
	                            <td ><?php echo Util:: displayFormat($values->iqama_expiry);?></td>
	                            <td ><?php echo $values->mobile_no;?></td>	                          
	                          </tr>
	                    <?php 	}
                          	}
                        ?>
	                </tbody>
				</table>