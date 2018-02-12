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
	<form id="student_search" action="" method="post"> 
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><?php echo Base_Controller::ToggleLang('Enrollment List');?></div>
			
		</div>
		<div class="portlet-body">
			<table class="table table-condensed table-hover" >
				<thead>
					<tr>
						<!-- <th></th> -->
						<th style="text-align:center"><?php echo Base_Controller::ToggleLang('SR #');?></th>
						<th><?php echo Base_Controller::ToggleLang('Enrollment #');?></th>
						<th><?php echo Base_Controller::ToggleLang('Name');?></th>
						<th><?php echo Base_Controller::ToggleLang('Father Name');?></th>
						<th><?php echo Base_Controller::ToggleLang('Course');?></th>
						<th><?php echo Base_Controller::ToggleLang('Contact #');?></th>
					</tr>
				</thead>
				<tbody>
				<?php $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id'); 
				if((isset($student_list) && sizeof($student_list) > 10) || isset($_POST['admission_number'])){
				?>
				<tr>
					<!-- <th></th> -->
					<th style="text-align:center"></th>
					<th><input type="text" autocomplete="off" value="<?php echo (isset($_POST['admission_number'])) ? $_POST['admission_number'] : '';?>" onkeyup="onkeyup_search(this, event);" placeholder="<?php if ($div_id == 1) echo Base_Controller::ToggleLang('DNS-15-0000'); else echo Base_Controller::ToggleLang('DIS-15-0000');?>" name="admission_number" style="width: 120px" class="form-control input-sm"/></th>
					<th><input type="text" autocomplete="off" value="<?php echo (isset($_POST['student_name'])) ? $_POST['student_name'] : '';?>" onkeyup="onkeyup_search(this, event);" placeholder="<?php echo Base_Controller::ToggleLang('Name');?>" id="student_name" name="student_name"  style="width: 180px; text-transform: uppercase;" class="form-control input-sm"/></th>
					<th><input type="text" autocomplete="off" value="<?php echo (isset($_POST['father_name'])) ? $_POST['father_name'] : '';?>" onkeyup="onkeyup_search(this, event);" placeholder="<?php echo Base_Controller::ToggleLang('Father Name');?>" id="father_name" name="father_name"  style="width: 180px; text-transform: uppercase;" class="form-control input-sm"/></th>
					<th colspan="2">
						<div class="input-group">
							<select name="course_id" class="form-control input-sm" id="course_id" tabindex="1" style="width: 110px" onchange="student_search.submit();"> 
			                    <option value="" selected>--<?php echo Base_Controller::ToggleLang('Class'); ?>--</option>
			                    <?php foreach($courses_list as $row){ 
			                    	$course_id = $row->course_id;
			                    	if($course_id > 15) continue;
			                    	$course[$course_id] = $row->course_name;
			                    	$sel = (isset($_POST['course_id']) && $_POST['course_id']==$course_id) ? 'selected' : '';
			                    	?> 
			                    	<option value="<?php echo $course_id;?>" <?php echo $sel; ?> ><?php echo $row->course_name;?></option>
			                    <?php } ?>
							</select>
							<!-- <input type="text" autocomplete="off" maxlength="1" value="<?php echo (isset($_POST['section'])) ? $_POST['section'] : '';?>" onkeyup="onkeyup_search(this, event);" placeholder="A" name="section" style="width: 32px" class="form-control input-sm"/> -->
						</div>
					</th>
					<th></th>
				</tr>
		        <?php
				} 
		        	$i=0;
		            if(isset($student_list) && sizeof($student_list) > 0){
		            foreach($student_list as $values){ $i++;
		            ?>
		            <tr>
		            	<!-- <td ><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" <?php //if($values->status == 'Issued') echo 'disabled="disabled"';?> value="<?php echo $values->enrollment_id;?>" /></td> -->
		             	<td style="color:#888888;text-align:center"><strong><?php echo $i; ?></strong></td>
		              	<td nowrap="nowrap"><?php echo $values->admission_number?></td>
		             	<td><?php echo $values->student_name?></td>
		             	<td><?php echo $values->father_name; ?></td>	                            
		             	<td><?php echo $values->course_name?></td>
		             	<td><?php echo $values->cell_phone_father;?></td>	                          
		        	</tr>
		            <?php 	}
		            }
		    	?></tbody>
			</table>
		</div></div>
	
	<input type="hidden" id="count" value="<?php echo $i;?>"/>
	<?php if(!isset($_POST['student_name'])){?>
	<ul id="pagination-digg" class="pagination"><?php if (isset($links)) echo $links;?></ul>
	<?php }?>
	</form>	
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
	function onkeyup_search(obj, e){
    	var student_name = document.getElementById('student_name').value;
    	
        if(e.keyCode == '13' || obj.value.length >= 11){
         	student_search.submit();   
        }
    }
</script>