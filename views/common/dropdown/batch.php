<?php if(!function_exists('ToggleLang')){
	//include_once 'assets/php/common_functions.php'; 
}?>
<select name="batch_id" id="batch_id" class="form-control" data-placeholder="Choose a Batch" tabindex="1" onchange="onchange_batch(this.value)">
	<option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		<?php 
		if(isset($batch_list) && sizeof($batch_list)>0){
		foreach($batch_list as $batch){ 
		$batch_id = $batch->batch_id;
		?> 
	<option value="<?php echo $batch_id;?>" ><?php echo $batch->batch_name;?></option>
		<?php }
		} ?>
</select>