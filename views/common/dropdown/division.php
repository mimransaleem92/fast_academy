<?php if(!function_exists('ToggleLang')){
	//include_once 'assets/php/common_functions.php'; 
}?>
<select name="division_id" class="form-control" id="division_id" onchange="onchange_division(this.value)">
	<option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		<?php 
		if(isset($division_list) && sizeof($division_list)>0){
		foreach($division_list as $division){ 
		$division_id = $division->division_id;
		?> 
	<option value="<?php echo $division_id;?>" ><?php echo $division->name;?></option>
		<?php }
		} ?>
</select>