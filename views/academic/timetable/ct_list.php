					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="cursor:pointer; background-color:#FFFFFF">
                        <tr>
                            <td width="4%"><label></label></td>
                            <td width="30%"><?php echo Base_Controller::ToggleLang('Name');?></td>
                            <td width="20%"><?php echo Base_Controller::ToggleLang('Start');?></td>
                            <td width="20%"><?php echo Base_Controller::ToggleLang('End');?></td>
                            <td width="10%"><?php echo Base_Controller::ToggleLang('is Break');?></td>
                          </tr>
                  		<?php $i=0; $start_time = '06:45';
                          if(isset($ct_list) && sizeof($ct_list) > 0){
                          	
                          	foreach($ct_list as $values){ $i++;
                          		$start_time = $values->end_time;
                          ?>
	                          <tr>
	                            <td><?php echo '';?><!-- <input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->id;?>" /> --></td>
	                            <td><?php echo "Period ". $i?></td>
	                            <td><?php echo $values->start_time;?></td>
	                            <td><?php echo $values->end_time;?></td>
	                            <td><?php echo $values->is_break;?></td>	                          
	                          </tr>
	                  <?php 	}
                          }
                          	?>
                          	
	                </table>
	                <br />
	                <table width="80%" border="0" cellspacing="0" cellpadding="2" style="background-color:#FFFFFF">
	                	<tr>
                            <td align="right" width="50%">&nbsp;School Start Time:</td>
                            <td width="40%" colspan="2"><input type="text" class="form-control input-sm" name="start_time" id="start_time" value="<?php echo $start_time;?>" /></td>
                            <td></td>	                          
                     	</tr>
                     	<tr>
                            <td align="right">&nbsp;Time Slot (Period Duration):</td>
                            <td colspan="2">
                            	<select name="time_slot" class="form-control input-sm" id="time_slot" >
                            		<option value='15' >15 min</option>
                            		<option value='20' >20 min</option>
                            		<option value='25' >25 min</option>
                            		<option value='30' >30 min</option>
                            		<option value='35' >35 min</option>
                            		<option value='40' selected="selected" >40 min</option>
                            		<option value='45' >45 min</option>
                            		<option value='50' >50 min</opction>
                            		<option value='60' >1 hour</option>
                            	</select>
                            </td>        
                            <td></td>                 
                     	</tr>
                     	<tr>
                            <td align="right">&nbsp;Daily Period:</td>
                            <td><input type="text" class="form-control input-sm" style="width: 120px" name="number_of_period" id="number_of_period" value="1" /></td>
	                        <td><label><input type="checkbox" name="delete_existing" id="delete_existing" value="Y" /> Delete Existing</label></td>
                            <td></td>	                          
                     	</tr>
                     	<tr>
                            <td align="right">&nbsp;Break Text:</td>
                            <td><input type="text" class="form-control input-sm" style="width: 120px" name="break_text" id="break_text" value="" /></td>
	                        <td><label><input type="checkbox" name="is_break" id="is_break" value="on" /> Break </label></td>
                            <td></td>	                          
                     	</tr>
                     	<tr>
                            <td align="right">&nbsp;</td>
                            <td colspan="2"><input type="button" class="btn btn-sm" name="btnsave" id="btnsave" value="Save" onclick="onclick_saveclasstiming();" /></td>
                            <td></td>                          
                     	</tr>
	                </table>
	                <!-- <input type="hidden" id="count" value="<?php echo $i;?>"/> -->
	                <input type="hidden" name="db_check" value="<?php echo '1';?>" />