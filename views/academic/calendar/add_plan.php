		<?php echo form_open('academic_calendar/add_plan', array('id'=>'calendarForm')); ?>
			<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
				<tr>
					<td align="<?php echo $class_left;?>" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1"><?php echo Base_Controller::ToggleLang('Enter Required Information');?></span></td>
				</tr>
				<tr style="display: none;">
					<td width='20%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Batch #');?>:</td>
					<td width='30%'><input type="text" id="batch_id" name="batch_id" value='<?php if (isset($_GET['batch_id'])) echo $_GET['batch_id'];?>'  /></td>
					<td width='20%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Week #');?>:</td>
					<td width='30%'><input type="text" id="week_number" name="week_number" value='<?php if(isset($_GET['week_number'])) echo $_GET['week_number']; ?>' /></td>
				</tr>
				<tr>
					<td colspan="2" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Week Plan');?><br>
					<textarea name="week_plan" id="week_plan" rows="3" cols="50" placeholder="Enter Week Plan Here!!!"><?php if(isset($_GET['week_plan'])) echo $_GET['week_plan'];?></textarea></td>
					<input type="hidden" id="action" name="action" value="save"/>
					<input type="hidden" id="division_id" name="division_id" value="<?php echo $division_id;?>"/>
					<input type="hidden" id="term" name="term" value="<?php if(isset($_GET['term'])) echo $_GET['term'];?>"/>
				</tr>
				<tr>
					<td width="50%" >Number of weeks:
						<select name="plan_num_week">
							<option value='1' <?php if(isset($_GET['num']) && $_GET['num'] == '1') echo 'selected';?>> One  </option>
							<option value='2' <?php if(isset($_GET['num']) && $_GET['num'] == '2') echo 'selected';?>> Two </option>
							<option value='3' <?php if(isset($_GET['num']) && $_GET['num'] == '3') echo 'selected';?>> Three </option>
						</select>
					</td>
					<td>Break:
						<select name="week_break">
							<option value='0' <?php if(isset($_GET['break']) && $_GET['break'] == '0') echo 'selected';?>> NO  </option>
							<option value='1' <?php if(isset($_GET['break']) && $_GET['break'] == '1') echo 'selected';?>> YES </option>
						</select>
					</td>
				</tr>
			</table>
		<?php /* print_r($_REQUEST); 
				print_r($_GET); */
			echo form_close();
		?>