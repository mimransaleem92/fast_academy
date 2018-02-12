							<table border="1" style="border: 1px solid #8CBAE8; width: 100%; background-color: #FFF; color: #000;">
				                <tr>
				                	<th width="50px"><?php echo Base_Controller::ToggleLang('Week');?></th>
				                	<th width="130px" style="text-align: center"><?php echo Base_Controller::ToggleLang('Date');?></th>
				                	<th><?php echo Base_Controller::ToggleLang('Chapter');?></th>
				                	<th><?php echo Base_Controller::ToggleLang('Class Work (text book pages)');?></th>
				                	<th><?php echo Base_Controller::ToggleLang('Home Work (text book pages)');?></th>
				                	<th><?php echo Base_Controller::ToggleLang('Weekend HW');?></th>
				                	<th></th>
				                </tr>
			                	<?php 
			                	$i = $term = 0; $week_count = 0;
			                	if(isset($term_plan_list) && sizeof($term_plan_list)>0){
			                		$week_count = sizeof($term_plan_list); 
			                		foreach ($term_plan_list as $row)
			                		{   $i++;
			                			if($term != $row->term)
			                			{
			                				$term = $row->term;
			                	?>
			                	<tr>
			                		<td colspan="7" style="text-align: center; font-weight: bold"><?php echo ($row->term == 1) ? 'First Term' : 'Second Term';?></td>
			                	</tr>
			                	<?php }?>
			                	<tr>
			                		<td style="padding-left: 12px">
			                			<?php if($row->week >= 1){ echo $row->week;} else { ?>
			                			<a href="#" class="btn btn-xs red" onclick="deleteRow(<?php echo $row->term_plan_id;?>)"><i class="fa fa-times"></i></a>
			                			<?php }?>
			                		</td>
			                		<td align="center"><?php echo $row->plan_date;?></td>
			                		<td align="center"><?php echo $row->chapter;?></td>
			                		<td align="center"><?php echo $row->classwork;?></td>
			                		<td align="center"><?php echo $row->homework;?></td>
			                		<td align="center"><?php echo $row->weekend_hw;?></td>
			                		
			                		<?php if($row->week >= 1){
			                			
			                			$title = "TERM PLAN INFO";
			                			$url   = base_url().$model."/add_week_plan";
										$param = 'week='.$row->week."&batch_id=".$row->batch_id."&term=".$row->term."&course_id=".$row->course_id."&subject_id=".$row->subject_id;
										$param .= '&id='.$row->term_plan_id.'&plan_date='.$row->date.'&chapter='.$row->chapter.'&classwork='.$row->classwork.'&homework='.$row->homework.'&weekend_hw='.$row->weekend_hw;
			                			$cell_id = $row->week.$row->term.$row->batch_id.$row->subject_id.$row->course_id;
			                			
			                			?>
			                		<td id="<?php echo $cell_id;?>" ><span style="float: left"></span>
			                			<span style="float: right"><a <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.'\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i> Edit</a></span>
			                		</td>
			                		<?php } else { echo '<td></td>'; } ?>
			                	</tr>
			                	<?php }
			                	} 
			                	$chapter='CH '.$i;
			                	$hw='HW '.$i;
			                	$cw='CW '.$i;
			                	$weekend_hw='NO';
			                	if($week_count < 40){
				                	if(isset($row->end_date)){
				                		$curr_date = $row->end_date;
				                	}
			                	?>
			                	<tr>
			                		<td></td>
			                		<td><input type="text" class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy" size="16" id="plan_date" name="plan_date" value='<?php echo Util::displayFormat( $curr_date );?>' style="width: 120px"/></td>
			                		<td><input type="text" class="form-control input-sm" id="chapter" name="chapter" value='<?php echo $chapter;?>' style="width: 150px"/></td>
			                		<td><input type="text" class="form-control input-sm" id="classwork" name="classwork" value='<?php echo $cw;?>' style="width: 250px"/></td>
			                		<td><input type="text" class="form-control input-sm" id="homework" name="homework" value='<?php echo $hw;?>' style="width: 250px"/></td>
			                		<td><input type="text" class="form-control input-sm" id="weekend_hw" name="weekend_hw" value='<?php echo $weekend_hw;?>' style="width: 150px"/></td>
			                		<td><input type="button" class="btn btn-sm" value="Add" onclick="onclick_add_plan()"></td>
			                	</tr>
			                	<?php }?>
			            	</table>