<script type="text/javascript">

	function update_fee_process(){
		if(confirm("Are you sure to process fee for the selected month?")){
			
			var m = document.getElementById('month').value;
			get('<?php echo base_url()."setup/save_item/";?>','month='+m, 'branch_list', false, false);
		}
	}
	
	function send_sms(){
		var c = document.getElementById('course_id').value;
		var cell = document.getElementById('cell_number').value;
		document.getElementById('err_msg').innerHTML = "";
		if(c == -1 && cell.length <= 11){
			document.getElementById('err_msg').innerHTML = "Please enter valid cell number!!";
			document.getElementById('cell_number').focus();
		}
		
		if(confirm("Are you sure to send below sms to the selected group/individual?")){
			messageForm.submit();
		}
	}

	
	function afterAjax(){
		document.getElementById('name').value = '';
	}

	function onchangeCompany(val){

		get('<?php echo base_url()."branch/get_company_list/";?>','company_id='+val,'branch_list',false, false);
	}

</script>
		
<div class="col-md-12">
	<form id="messageForm" method="post" action="<?php echo base_url().$model.'/send_message'?>" >
	<div class="alert alert-success" >
		<div class="col-md-6">
			<?php 
			$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
			$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
			$admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false;
			?>
				<div class="form-group">
					<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Course Name').' / '.Base_Controller::ToggleLang('Section');?></label>
					<?php 
					if(true){
						echo '<select name="course_id" class="form-control col-md-6" id="course_id" style="width: 150px" >';
						echo '<option value="-1" >  Single Number</option>';
						echo '<option value="0" >  All Students</option>';
						foreach($courses_list as $course){
							$course_id = $course->course_id;
							$sel = ($course_id ==  $c) ?  'selected' : '' ;
							echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
						}
						echo '</select>';
						echo '<input type="text" name="section" class="form-control col-md-2" id="section" value="'.$sec.'" style="width: 50px">';
					}else{
						foreach($courses_list as $course){
							$course_id = $course->course_id;
							if($course_id ==  $c) { $course_name = $course->course_name; break;}
						}
					?>
					<input type="hidden" name="course_id" id="course_id" value="<?php echo $c; ?>">
					<input type="text" name="course_name" readonly="readonly" class="form-control col-md-6" id="course_name" value="<?php echo $course_name; ?>" style="width: 150px">
					<input type="text" name="section" readonly="readonly" class="form-control col-md-4" id="section" value="<?php echo $sec; ?>" style="width: 50px">
					<?php }?>
				</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<div class="col-md-12" >
					<input type="text" name="cell_number" class="form-control col-md-2 text-center" id="cell_number" value="" style="width: 150px" placeholder="92333XXXXXXXX" />
					<?php $term_id = isset($_POST['term']) ? $_POST['term']: 1;?>
					<button class="btn blue" type="button" onclick="send_sms();" ><i class="fa fa-mail"></i> Send SMS </button>
					<span class="require" id="err_msg"></span>
				</div>
			</div>
		</div>
		<div class="clearfix" ></div>
	</div>	
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	
	
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Message Detail');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="form-group">
				<label class="control-label col-md-2 text-right">Message Text</label>
				<div class="col-md-9">
					<textarea id="maxlength_textarea" name="message_text" class="form-control" maxlength="612" rows="11" placeholder="This text has a limit of 612 chars.">
Dear Students/Parents,
Welcome to Fast Science Academy SMS Service.
It is to inform all of you that the academy will remain closed on 30-09-2017 to 01-10-2017 in connection with Yom-e-Aashoor (9 & 10 Moharram). 
.
Thanks
.
REGARDS:
Principal
Fast Science Academy, Haroonabad
0333-6318287</textarea>
					<span class="help-block">
					Maxlength supports text as well as inputs.
					</span>
				</div>
			</div>
		</form>	
		<div id="branch_list">
			<table class="table table-bordered table-striped hide">
				<thead>
					<tr>
						<th width="20%" style="padding-left:4px;"> ID </th>
						<th width="20%" nowrap="nowrap"> Fee Month </th>
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
					       	<td width="*" valign="middle" nowrap="nowrap"><?php echo $value->month;?></td>
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
<script src="<?php echo base_url();?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript" ></script>
<script>
	jQuery(document).ready(function() {       
	   App.init();
	   TableAdvanced.init();
	   
	   $('#maxlength_textarea').maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow: true
        });
	});
</script>	