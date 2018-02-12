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
	
	var key = window.event ? window.event.keyCode : e.which;
	
	if(key == '0' || key == '1' || key == '13'){
		get('employee/search', '', 'result_tbl', false,'frmSearch');
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
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang("Employee List");?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<form id=frmSearch onsubmit="return false;">
					<input type="submit" style="display:none" onclick="return false;" id=btnSubmit value="search" />
					<table id=search_tbl width="99%" border="0" cellspacing="0" cellpadding="0" style="cursor:pointer; ">
                        <tr>
                        	<td>
                        		<div class="input-group col-md-6">
									<div class="input-cont">
										<input type="text" name="search" id="search" maxlength="15" placeholder="Search by <?php echo Base_Controller::ToggleLang('Employee Code / Name');?>" value="" class="form-control" onkeyup="return get_search(event);" />
									</div>
									<span class="input-group-btn">
									<button type="button" class="btn green" onkeyup="return get_search(event);" onclick="return get_search(event);" >
									Search &nbsp; 
									<i class="m-icon-swapright m-icon-white"></i>
									</button>
									</span>    
								</div>
								<!-- <div class="col-md-2">
									<button type="button" class="btn "  onclick="window.open('<?php echo base_url().$model;?>/printhtml', '_blank')" > Print Payroll </button>
								</div> -->
                        	</td>
                        </tr>
                    </table>
             	</form>
             	<br/>
                <span id="result_tbl">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th style="text-align:center">#</th>
							<th style="text-align:center"><?php echo Base_Controller::ToggleLang('ID');?></th>
							<th><?php echo Base_Controller::ToggleLang('Code');?></th>
							<th><?php echo Base_Controller::ToggleLang('Emp Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Subject');?></th>
							<th><?php echo Base_Controller::ToggleLang('Iqama ID');?></th>
							<th><?php echo Base_Controller::ToggleLang('Expiry');?></th>
							<th><?php echo Base_Controller::ToggleLang('Contanct #');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php
                  		  $i=0;
                          if(isset($employee_list) && sizeof($employee_list) > 0){
                          	foreach($employee_list as $values){
                          		$i++;
                        ?>
	                          <tr>
	                            <td style="text-align:center"><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" <?php //if($values->status == 'Issued') echo 'disabled="disabled"';?> value="<?php echo $values->employee_id;?>" /></td>
	                            <td style="color:#888888;text-align:center"><strong><?php echo $i; ?></strong></td>
	                            <td nowrap="nowrap"><?php echo $values->employee_id;?></td>
	                            <td ><?php echo $values->employee_name?></td>
	                            <td ><?php echo $values->subject_name?></td>
	                            <td ><?php echo $values->iqama_id; ?></td>	                            
	                            <td ><?php echo Util:: displayFormat($values->iqama_expiry);?></td>
	                            <td ><?php echo $values->mobile_no;?></td>	                          
	                          </tr>
	                    <?php 	}
                          	}
                        ?>
	                </tbody>
				</table></span>
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
