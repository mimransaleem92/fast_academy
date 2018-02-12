<?php if(!function_exists('ToggleLang')){
	//include_once 'assets/php/common_functions.php'; 
}?>
<select name="department_id" class="form-control" id="department_id">
	<option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		<?php 
		if(isset($department_list) && sizeof($department_list)>0){
		foreach($department_list as $department){ 
		$department_id = $department->department_id;
		?> 
	<option value="<?php echo $department_id;?>" ><?php echo $department->name;?></option>
		<?php }
		} ?>
</select>