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

function onchange_search_by(val)
{
	document.getElementById('search').value = '';
	document.getElementById('search').focus();	
}
function get_search(e){
	var search_by = document.getElementById('search_by').value;
	var search = document.getElementById('search').value;
	
	parms = 'search_by='+search_by+'&search='+search;
	var key = window.event ? window.event.keyCode : e.which;
	//get('users/search', '', 'result_tbl', false,'frmSearch');
	
	if(key == '0' || key == '1' || key == '13'){
		get('user/search', '', 'result_tbl', false,'frmSearch');
	}
}

function showSearchBar(){
	document.getElementById('search_tbl').style.display = 'block';
}

//-->
</script>
<div class="col-md-12">
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Users List');?></div>
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
							<th><?php echo Base_Controller::ToggleLang('Emp #');?></th>
							<th><?php echo Base_Controller::ToggleLang('Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Username');?></th>
							<!-- <th><?php //echo Base_Controller::ToggleLang('Role');?></th>-->
							<th><?php echo Base_Controller::ToggleLang('Status');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php 
                          if(isset($user_list) && sizeof($user_list) > 0){
                          	$i=0;
                          	foreach($user_list as $values){
                          		$i++;
                          		if($values->user_id == 99099) continue;
                          		
                          ?>
	                          <tr>
	                            <td ><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->user_id;?>" /></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');"  style="color:#888888;"><strong><?php echo $values->employee_id; ?></strong></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');" ><?php echo $values->name?></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');" ><?php echo $values->username?></td>
	                            <!--  <td onclick="onclick_row('<?php echo $i;?>');" ><?php echo $values->role_name;?></td>-->	                          
	                            <td onclick="onclick_row('<?php echo $i;?>');" >
	                            <?php $is_active = $values->is_active;
	                            if($is_active == 'Y')
	                            {
	                            	echo Base_Controller::ToggleLang('Active');
	                            }
	                            else {
	                            	echo Base_Controller::ToggleLang('Inactive');
	                            }
	                            ?></td>
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