<select name="selected_screens[]" id="selected_screens" multiple="multiple" onchange="onchange_screen(this)" style="width: 170px; font: 12px 'Lucida Sans Unicode','Lucida Grande','sans-serif';">
<?php foreach($rolescreen_list as $v){ 
	$id = $v->screen_id;
	?> 
	<option value="<?php echo $id;?>" ><?php echo $v->name;?></option>
<?php } ?>
</select>
