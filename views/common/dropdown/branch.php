<?php if(!function_exists('ToggleLang')){
	//include_once 'assets/php/common_functions.php'; 
}?>
<select name="branch_id" class="form-control" id="branch_id" onchange="onchange_branch(this.value)">
	<option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		<?php 
		if(isset($branch_list) && sizeof($branch_list)>0){
		foreach($branch_list as $branch){ 
		$branch_id = $branch->branch_id;
		?> 
	<option value="<?php echo $branch_id;?>" <?php //if($branch_id ==  $this->session->userdata('branch_id')) echo 'selected'; ?> ><?php echo $branch->name;?></option>
		<?php }
		} ?>
</select>