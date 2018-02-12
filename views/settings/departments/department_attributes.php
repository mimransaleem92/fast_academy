<?php 
//echo $search_fields;
	if($search_fields != ''){
		$list = explode(',', $search_fields);
		for ($i=0; $i< sizeof($list); $i++){ ?>
		<div class="form-group">
			<label  class="col-md-3 control-label"><?php echo $list[$i]; ?><span class="required">*</span></label>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="search_field<?php echo $i+1;?>" data-required="1" class="form-control" placeholder="Enter Name" value="" >
					
				</div>
			</div>
		</div>
<?php }
	}
	else {
	 	echo '<div  class="form-group">';
	 	echo '<div  class="col-md-3"></div>';
		echo '<div class="alert alert-warning col-md-4"><i class="fa fa-warning"></i> No custom field is associate with this department</div>';
		echo '</div>';
	}
?>