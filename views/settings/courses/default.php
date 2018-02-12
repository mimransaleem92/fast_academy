<div class="col-md-12">
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><?php echo Base_Controller::ToggleLang('Courses List');?></div>
			<div class="actions">
				<div class="btn-group">
					<a class="btn default" href="#" data-toggle="dropdown">
					Columns
					<i class="fa fa-angle-down"></i>
					</a>
					<div id="sample_2_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
						<label><input type="checkbox" checked data-column="2"><?php echo Base_Controller::ToggleLang('Course Name');?></label>
						<label><input type="checkbox" checked data-column="3"><?php echo Base_Controller::ToggleLang('Section Name');?></label>
						<label><input type="checkbox" checked data-column="4"><?php echo Base_Controller::ToggleLang('Tuition Fee');?></label>
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
						<th><?php echo Base_Controller::ToggleLang('Section Name');?></th>
						<?php if(ENABLE_FEE_MODULE == 1){?>
						<th><?php echo Base_Controller::ToggleLang('Tuition Fee');?></th>
						<?php }?>
					</tr>
				</thead>
				<tbody>
				<?php 
                	$i=0;
                    if(isset($course_list) && sizeof($course_list) > 0){                          	
                    	foreach($course_list as $values){ $i++; ?>
                        <tr>
                            <td><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->course_id;?>" /></td>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $values->course_name;?></td>
                            <td> <?php echo $values->section_name?></td>
                            <?php if(ENABLE_FEE_MODULE == 1){?>
                            <td><?php echo $values->FEE_PER_YEAR_DIS;?></td>
                            <?php }?>
                        </tr>
                <?php }
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