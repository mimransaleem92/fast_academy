<?php 
$d = 0;
$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
if(isset($weekday_list) && sizeof($weekday_list)>0){
	$values = $weekday_list[0];
	foreach ($days as $day_name){
		$curr_val = $values->$day_name;
	?> 
		<input type="checkbox" name='<?php echo $day_name;?>' id='<?php echo $day_name;?>' value="<?php echo $curr_val;?>" <?php  if($curr_val == 'on') echo 'checked'; ?> > <label for='<?php echo $day_name;?>'> <?php echo ucfirst($day_name);?> </label> <br />
<?php 
	} 
}else{
	foreach ($days as $day_name){ $d++;
	?>
		<input type="checkbox" name='<?php echo $day_name;?>' id='<?php echo $day_name;?>' <?php  if($d <= 5) echo 'checked'; ?> > <label for='<?php echo $day_name;?>'> <?php echo ucfirst($day_name);?> </label>  <br />
	<?php
	}
}?>
<input type="hidden" name="db_check" value="<?php echo $d;?>" />
<input type="button" id="btnSave" value="Save Changes" onclick="onclick_saveweekday();"/> <span id="td_success" class="alert alert-error"></span>