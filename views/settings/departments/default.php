<div class="col-md-12">
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Departments List');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo Base_Controller::ToggleLang('ID');?></th>
							<th><?php echo Base_Controller::ToggleLang('Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Arabic Name');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php 
                          if(isset($department_list) && sizeof($department_list) > 0){
                          	$i=0;
                          	foreach($department_list as $values){
                          		$i++;
                          		$class = "frame_blue_light";
                          		if($i%2==0){
                          			$class = "frame_blue_dark";
                          		}
                          ?>
	                          <tr>
	                            <td><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->department_id;?>" /></td>
	                            <td><strong><?php echo $values->department_id; ?></strong></td>
	                            <td><?php echo $values->name?></td>
	                            <td><?php echo $values->arabic_name?></td>
	                          </tr>
	                  <?php 	}
                          }
                          	?>
	                </tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- END CONDENSED TABLE PORTLET-->
</div>
<input type="hidden" id="count" value="<?php echo $i;?>"/>
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