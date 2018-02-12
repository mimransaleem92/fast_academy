<script type="text/javascript">
<!--
function onclick_row(count){
	var obj = document.getElementById('selected_id_'+count);
	if(obj.checked){
		obj.checked = false;
	}
	else
	{
		obj.checked = true;
	}
}
//-->
</script>
<div class="col-md-12">
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><?php echo Base_Controller::ToggleLang('Batch');?> List</div>
			<div class="actions">
				<div class="btn-group">
					<a class="btn default" href="#" data-toggle="dropdown">
					Columns
					<i class="fa fa-angle-down"></i>
					</a>
					<div id="sample_2_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
						<label><input type="checkbox" checked data-column="2"><?php echo Base_Controller::ToggleLang('Course Name');?></label>
						<label><input type="checkbox" checked data-column="3"><?php echo Base_Controller::ToggleLang('Batch');?> Name</label>
						<label><input type="checkbox" checked data-column="4"><?php echo Base_Controller::ToggleLang('Start Date');?></label>
						<label><input type="checkbox" checked data-column="5"><?php echo Base_Controller::ToggleLang('End Date');?></label>
					</div>
				</div>
			</div>
		</div>
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover table-full-width" id="sample_2" >
				<thead>
					<tr>
						<th></th>
						<th><?php echo Base_Controller::ToggleLang('No');?></th>
						<th><?php echo Base_Controller::ToggleLang('Course Name');?></th>
						<th><?php echo Base_Controller::ToggleLang('Batch');?> Name</th>
						<th><?php echo Base_Controller::ToggleLang('Start Date');?></th>
						<th><?php echo Base_Controller::ToggleLang('End Date');?></th>
					</tr>
				</thead>
				<tbody>					
                	<?php 
                  		  $i=0;
                          if(isset($batch_list) && sizeof($batch_list) > 0){                          	
                          	foreach($batch_list as $values){ $i++; ?>
	                          <tr>
	                            <td ><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->batch_id;?>" /></td>
	                            <td ><?php echo $i; ?></td>
	                            <td ><?php echo $values->course_name;?></td>
	                            <td > <?php echo $values->batch_name?></td>
	                            <td ><?php echo $values->start_date?></td>
	                           	<td > <?php echo $values->end_date?></td>
	                          </tr>
	               	<?php 	}
                    	} ?>
            	</tbody>
			</table>
		</div></div>
	<input type="hidden" id="count" value="<?php echo $i;?>"/>
	<!-- END CONDENSED TABLE PORTLET-->
</div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/table-advanced.js"></script>     
<script>
	jQuery(document).ready(function() {       
	   App.init();
	   TableAdvanced.init();
	});	
</script>