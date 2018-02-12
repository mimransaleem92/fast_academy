<select name="location_id" class="select_big" id="location_id">
	<option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		<?php 
		if(isset($location_list) && sizeof($location_list)>0){
		foreach($location_list as $location){ 
		$location_id = $location->location_id;
		?> 
	<option value="<?php echo $location_id;?>" ><?php echo $location->name;?></option>
		<?php }
		} ?>
</select>