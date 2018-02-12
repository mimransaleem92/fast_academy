<select name="combine_id" id="combine_id" class="form-control" onchange="onchange_collection(this.value)">
	<option value="">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		<?php 
		if(isset($fee_collection_list) && sizeof($fee_collection_list)>0){
		foreach($fee_collection_list as $collect){ 
		$collect_id = $collect->id.'-'.$collect->fee_category_id;
		?> 
	<option value="<?php echo $collect_id;?>" ><?php echo $collect->collection_name;?></option>
		<?php }
		} ?>
</select>