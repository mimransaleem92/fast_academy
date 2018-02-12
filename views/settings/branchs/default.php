<script type="text/javascript">
	function add_new(){
		document.getElementById('branch_id').value = '0';
		document.getElementById('name').value = "";
		document.getElementById('btnBranch').style.display = 'inline';
		document.getElementById('btnUpdate').style.display = 'none';
		document.getElementById('new_branch_row').style.display = 'table-row';
	}
	function edit_row(item_id, item_name){
		document.getElementById('branch_id').value = item_id;
		document.getElementById('name').value = item_name;
		document.getElementById('btnBranch').style.display = 'none';
		document.getElementById('btnUpdate').style.display = 'inline';
		document.getElementById('new_branch_row').style.display = 'table-row';
		document.getElementById('name').focus();
	}
	function update_fee_process(){
		if(confirm("Are you sure to process fee for the selected month?")){
			
			var m = document.getElementById('month').value;
			get('<?php echo base_url()."setup/save_item/";?>','', 'branch_list', false, 'frmSetup');
		}
	}

	function update_item(){
		var item_id = document.getElementById('branch_id').value;
		var item_name = document.getElementById('name').value;
		var val = document.getElementById('company_id').value;
		item_name = item_name.trim();
		if(item_name == ''){
			alert("Please enter branch name!");
		}
		else {
			get('<?php echo base_url()."branch/update_item/";?>','branch_id='+item_id+'&name='+item_name+'&company_id='+val,'branch_list',false, false);
		}
	}
	
	function afterAjax(){
		document.getElementById('name').value = '';
	}

	function onchangeCompany(val){

		get('<?php echo base_url()."branch/get_company_list/";?>','company_id='+val,'branch_list',false, false);
	}
	
	function onclickDeleteItem(item_id, count){
		if(confirm("Are you sure to delete Branch ID: "+item_id+". All Records associated with this branch will be deleted too!")){
			//document.getElementById('row'+count).style.display = 'none';
			get('<?php echo base_url()."branch/delete_item/";?>','branch_id='+item_id,'branch_list',false, false);
		}
	}
</script>
		
<div class="col-md-12">
<div class="alert alert-success <?php if($userrole != 1) echo 'hide';?>" >
	<div class="row">
		<form id="frmSetup" action="<?php echo base_url(); ?>" method="post" >
			<div class="form-group">
				<div class="col-md-3 col-md-offset-4">
					<div class="form-group">
						<select name="fee" class="form-control" id="fee" >
							<option value='1'> Full Fee </option>
							<option value='0.5'> Half Fee</option>
						</select>
						
						<select name="class" class="form-control" id="class" >
							<option value='0'> ALL Classes </option>
							<option value='9'> 9th </option>
							<option value='10'> 10th </option>
							<option value='11'> Ist Year </option>
							<option value='12'> 2nd Year </option>
						</select>
						
					</div>
					<div class="form-group">					
						<select name="month" class="form-control" id="month" >
							<?php // value of fee term is made by concate first digit from the division of the student like DIS=2 or DNS=1 
									$arr_m = array('--','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
									for($m = 1; $m <= 12; $m++){
										echo '<option value="'.$m.'" > '.$arr_m[$m].' </option>';
									}
							?>
						</select>
						
						<span class="help-block">Fee Process for the selected month</span>
					</div>
					
				</div>
				<button type="button" style="display:none;" onclick="return false;" id="asb" />
				<button type="button" class="btn green" onclick="update_fee_process()" ><i class="fa fa-check"></i> <?php echo Base_Controller::ToggleLang('Process');?></button>
			</div>
		</form>
	</div>
</div>
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	
	
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Monthly Fee Processes');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
		<div id="branch_list">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="20%" style="padding-left:4px;"> ID </th>
						<th width="15%" nowrap="nowrap"> Class </th>
						<th width="15%" nowrap="nowrap"> Fee Month </th>
				       	<th width="*" nowrap="nowrap"> Date Time </th>
						<th width="20%" nowrap="nowrap"> Students </th>
				       	<!--<th width="120px" >
				       		<a href="javascript:;" onclick="add_new();" class="btn btn-xs blue-steel">Students <i class="fa fa-plus"></i></a>
				       	</th>-->
					</tr>
				</thead>
				<tbody>
				<?php 
					$colorCounter = 0;
			        if(isset($branchs_list) && sizeof($branchs_list) > 0){
			          	foreach ($branchs_list as $value){
			          		
						?>
						<tr>
					       	<td width="20%" valign="middle" style="padding-left:4px;"><?php echo $value->id;?></td>
					       	<td valign="middle" nowrap="nowrap"><?php echo ($value->course_id == 0) ? 'All' : $value->course_id;?></td>
							<td valign="middle" nowrap="nowrap"><?php echo $value->month;?></td>
					       	<td width="115px" valign="middle" ><?php echo $value->created_at;?></td>
							<td width="20%" valign="middle" style="padding-left:4px;"><?php echo $value->total_students;?></td>
							<!--
					       	<a href="javascript:;" onclick="edit_row(<?php echo $value->branch_id.', \''.$value->name;?>');" class="btn btn-xs green-haze">Edit <i class="fa fa-edit"></i></a>
					       	
					       	<a href="javascript:;" onclick="onclickDeleteItem(<?php echo $value->branch_id.', '.$colorCounter;?>);" class="btn btn-xs red-flamingo">Del <i class="fa fa-trash"></i></a>
					       	 -->
					    </tr>
			          	<?php
			          	 $colorCounter++;
			          }
			       }
			       ?>
			</tbody></table>
		</div>
		<br/>
		<table width="670" cellspacing="0" cellpadding="0" border="0" >
			<tbody>
				<tr id="new_branch_row" style="cursor:pointer; display:none" >
					<td width="20%" style="padding-left:4px; font-weight: bold"> Branch Name: </td>
				    <td width="*" nowrap="nowrap"> <input type="text" name="name" id="name" style="width: 99%" value="" /> </td>
				    <td width="20%" > <input type="button" id="btnBranch" style="display:none" value="Submit" onclick="save_item();"/>
					    <input type="button" id="btnUpdate"  style="display:none" value="Update" onclick="update_item();"/>
					    <input type="hidden" id="branch_id" value="0"/>
				    </td>
				</tr>
			</tbody>
		</table>
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/table-advanced.js"></script>     
<script>
	jQuery(document).ready(function() {       
	   App.init();
	   TableAdvanced.init();
	});
</script>	