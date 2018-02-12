<script type="text/javascript">
<!--
function onchange_search_by(val)
{
	document.getElementById('search').value = '';
	document.getElementById('search').focus();	
}

function get_search(e){
	var search = document.getElementById('search').value;
	
	parms = 'search='+search;
	var key = window.event ? window.event.keyCode : e.which;
	
	if(key == '0' || key == '1' || key == '13'){
		get('global_search/search', parms, 'result_tbl', false,'');
	}
}

function get_advance_search(e){
	
	var search = document.getElementById('search').value;
	
	parms = 'search='+search;
	var key = window.event ? window.event.keyCode : e.which;
	//get('in_documents/search', '', 'result_tbl', false,'frmSearch');
	
	if(key == '0' || key == '1' || key == '13'){
		get('global_search/advance_search', '', 'result_tbl', false,'frmSearch');
	}	
}

function showSearchBar(){
	document.getElementById('search_tbl').style.display = 'block';
}
//-->
</script>
<style>
<!--
btn_toggle{}
-->
</style>
<form class="form-horizontal" action="#" id="frmSearch">
<div class="row search-form-default" id="form_search">
	<div class="col-md-9">
		
			<div class="input-group">
				<div class="input-cont">
					<input type="text" name="search" id="search" placeholder="Search by <?php echo Base_Controller::ToggleLang('Student Name');?>" value="<?php if (isset($_REQUEST['search_text'])) echo $_REQUEST['search_text'];?>" class="form-control" />
				</div>
				<span class="input-group-btn">
				<button type="button" class="btn green" onclick="get_search(event)">
				Search &nbsp; 
				<i class="m-icon-swapright m-icon-white"></i>
				</button>
				</span>&nbsp; 
				<span class="input-group-btn">
				<button type="button" class="btn blue btn_toggle">
				Advance Search &nbsp; 
				<i class="m-icon-swapright m-icon-white"></i>
				</button>
				</span>    
			</div>
		
	</div>
</div>
<div class="row search-form-advance display-hide" id="form_advance">
	<div class="col-md-12">
		
			<div class="form-body">						
				<div class="form-group">
					<div class="col-md-3"> 
						<?php 
							$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
							$division = ($div_id == '1') ? 'DNS' : 'DIS';
						?>
						<input class="form-control" type="text" value="" name="admission_number" placeholder="<?php echo $division.'-99-9999';?>">
					</div>
					<div class="col-md-3">
						<input class="form-control" type="text" value="" name="student_name" placeholder="<?php echo Base_Controller::ToggleLang('Student Name');?>">
						<!-- <span class="help-block">This is inline help</span> -->
					</div>
					<div class="input-group col-md-3">
					<span class="input-group-btn">
					<button type="button" class="btn green" onclick="get_advance_search(event)">
					Advance Search &nbsp; 
					<i class="m-icon-swapright m-icon-white"></i>
					</button>
					</span>&nbsp;
					<span class="input-group-btn">
						<button type="button" class="btn blue btn_toggle">Cancel</button>
					</span></div>
					
				</div>
				<div class="form-group">
					<div class="col-md-3">
						<select name="course_id" class="form-control" id="course_id" tabindex="1" > <!-- onchange="onchange_courses(this.value)"> -->
		                    <option value="" selected>- - <?php echo Base_Controller::ToggleLang('SELECT').' '.Base_Controller::ToggleLang('Class'); ?> - -</option>
		                    <?php foreach($courses_list as $row){ 
		                    	$course_id = $row->course_id;
		                    	$course[$course_id] = $row->course_name;
		                    	?> 
		                    	<option value="<?php echo $course_id;?>" ><?php echo $row->course_name;?></option>
		                    <?php } ?>
						</select>
					</div>
					<div class="col-md-3">
						<select name="section" class="form-control" id="section" tabindex="1" >
		                    <option value="" selected><?php echo Base_Controller::ToggleLang('Section'); ?></option>
		                    <option value="A" > A </option>
		                    <option value="B" > B </option>
		                    <option value="C" > C </option>
		                    <option value="D" > D </option>
		                    <option value="E" > E </option>
		                    <option value="F" > F </option>
		                    <option value="G" > G </option>
							<option value="H" > H </option>
		                    <option value="I" > I </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						<input class="form-control" type="text" value="" name="cell_phone_mother" placeholder="<?php echo Base_Controller::ToggleLang('Mother Mobile #');?>">
					</div>
					<div class="col-md-3">
						<input class="form-control" type="text" value="" name="cell_phone_father" placeholder="<?php echo Base_Controller::ToggleLang('Father Mobile #');?>">
					</div>
				</div>
			</div>
		
	</div>
</div>
</form>
<div class="clearfix"></div>
<br>
<div class="table-responsive" id="result_tbl">
	
	<table class="table table-striped table-bordered table-advance table-hover" >
		<caption style="text-align: right; padding-right: 10px;"><?php if(isset($student_list) && sizeof($student_list) > 0){ echo 'Total Students: '. sizeof($student_list); }?></caption>
		<thead>
			<tr>
				<th><?php echo Base_Controller::ToggleLang('SR #');?></th>
				<th><?php echo Base_Controller::ToggleLang('Admintion #');?></th>
				<th><?php echo Base_Controller::ToggleLang('Name');?></th>
				<th><?php echo Base_Controller::ToggleLang('Father Name');?></th>
				<th><?php echo Base_Controller::ToggleLang('Grade/Sec');?></th>
				<th><?php echo Base_Controller::ToggleLang('Mother Mobile #');?></th>
				<th><?php echo Base_Controller::ToggleLang('Father Mobile #');?></th>
				<th></th>
			</tr>
		</thead>
		<tbody>	
        <?php
        	$i=0;
            if(isset($student_list) && sizeof($student_list) > 0){
            foreach($student_list as $values){ $i++;
	            $row_color = "";
				$url = base_url().'students/student_profile/'.$values->student_id;
	            if($values->cdel == '9'){
					$url = base_url().'test_students/student_profile/'.$values->student_id;
					$row_color = "style='color: blue;'";
				}
	            if($values->cdel == '1'){
	            	$url = '#';
	            	$row_color = "style='color: red;'";
	            }
            ?>
            <tr <?php echo $row_color;?>>
            	<td style="color:#888888;text-align:center"><strong><?php echo $i; ?></strong></td>
              	<td nowrap="nowrap">
              		<?php if($url=="#") { echo $values->admission_number; } else {?>
              		<a href="<?php echo $url;?>"><?php echo $values->admission_number?></a>
              		<?php } ?>
              	</td>
             	<td ><?php echo empty($values->student_name) ? '<span style="font-family:tahoma">'.$values->student_name_ar.'</span>' : $values->student_name?></td>
             	<td ><?php echo $values->father_name; ?></td>
             	<td ><?php echo $values->course_name. ' - ' . $values->section;?></td>                          
             	<td ><?php echo $values->cell_phone_mother;?></td>
              	<td ><?php echo $values->cell_phone_father;?></td>
              	<td>
              		<?php if($row_color == ""){ 
              					if($admin_role >= 2){?>
              		<a href="javascript:;" class="btn default btn-xs blue-stripe" onclick="window.open('<?php echo base_url().'students/edit/'.$values->student_id;?>', '_self')" >Update</a>
              		<?php } }else{?>
              		<a href="javascript:;" class="btn default btn-xs red-stripe disabled" >Deleted</a>
              			<?php if($admin_role >= 3) {?>
              			<a href="javascript:;" class="btn default btn-xs green-stripe" onclick="window.open('<?php echo base_url().'students/enable_student/'.$values->student_id;?>', '_self')" >Activate</a>
              		<?php }
            			}?>
              	</td>	                          
        	</tr>
            <?php 	}
            }
            ?></tbody>
	</table>
	<input type="hidden" id="count" value="<?php echo $i;?>"/>
</div>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script>
	
	jQuery(document).ready(function() {       
	   App.init();
	   
	   if (jQuery().datepicker) {
           $('.date-picker').datepicker({
           	dateFormat: "dd-mm-yy",
               rtl: App.isRTL(),
               autoclose: true
           });
           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
       }
	   
	});
	$( ".btn_toggle" ).click(function() {
		  $( "#form_search" ).slideToggle();
		  $( "#form_advance" ).slideToggle( "slow" );
	    });
	
</script>