<?php 
//echo $search_fields;
	if($search_fields != ''){
		$list = explode(',', $search_fields);
		for ($i=0; $i< sizeof($list); $i++){ ?>
		<div class="form-group">
			<div class="col-md-3">
				<input class="form-control" type="text" value="" name="search_field<?php echo $i+1;?>" placeholder="<?php echo $list[$i];  $i++;?>">
			</div>
			<?php if(isset($list[$i])){?>
			<div class="col-md-3">
				<input class="form-control" type="text" value="" name="search_field<?php echo $i+1;?>" placeholder="<?php echo $list[$i]; ?>">
			</div>
			<?php }?>
		</div>
<?php }
	}
	else {
	 	echo '<div  class="form-group">';
	 	//echo '<div  class="col-md-3"></div>';
		echo '<div class="alert alert-warning col-md-6"><i class="fa fa-warning"></i> No custom field is associate with this department</div>';
		echo '</div>';
	}
?>