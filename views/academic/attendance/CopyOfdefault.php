<link type="text/css" href="<?php echo base_url();?>assets/css/redmond/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />	
				<form id="attendForm11" method="post" >
					<div class="form-body">
						<div class="row alert alert-success">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">&nbsp;</label>
									<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name');?></label>
									<div class="col-md-6">
										<!-- <select name="course_id" class="form-control" id="course_id" onchange="onchange_courses(this.value)">
    					                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
    					                    <?php $course_name = '';
    					                    	$c = $this->session->userdata(SESSION_CONST_PRE.'course_id');
    					                    	$s = $this->session->userdata(SESSION_CONST_PRE.'section');
    					                    	foreach($courses_list as $course){ 
    					                    		$course_id = $course->course_id;
    					                    		if($course_id ==  $c) { $course_name = $course->course_name; break;} 
    					                    	?> 
    					                    	<option value="<?php echo $course_id;?>" <?php if($course_id ==  $c) echo 'selected'; ?> ><?php echo $course->course_name;?></option>
    					                    <?php } ?>
    									</select> -->
    									<input type="text" name="course_id" class="form-control" id="course_id" value="<?php echo $course_name; ?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<label class="control-label col-md-3 right"><?php echo Base_Controller::ToggleLang('Section');?></label>
									<div class="col-md-6" >
										<input type="text" name="section" class="form-control" id="section" value="<?php echo $s; ?>">
									</div>
									<label class="control-label col-md-3">&nbsp;</label>
								</div>
							</div>
						</div>
						
						<div class="row alert alert-info cl-md-12" id="td_timetable">
					 		<?php //echo Base_Controller::ToggleLang('Please select course and batch'); 
					 			$day_name = array('S', 'M', 'T', 'W', 'Th', 'F', 'S');
					 		?>
						 		<table border="1" style="border: 1px solid #8CBAE8; width: 100%; background-color: #FFF; color: #000;">
					                <tr>
					                	<th width="50px"><?php echo Base_Controller::ToggleLang('Week');?></th>
					                	<th width="200px" style="text-align: center"><?php echo Base_Controller::ToggleLang('Date');?></th>
					                	<th><?php echo Base_Controller::ToggleLang('Plan');?></th>
					                </tr>
				                	<?php $term = 0; $w = 0;
				                	if(isset($week_list) && sizeof($week_list)>0){
				                	foreach ($week_list as $row){
				                		  $w = $row->week_number;
				                		  if($term != $row->term){ $term = $row->term;		
				                	?>
				                	<tr>
				                		<td colspan="3" align="center"><?php echo ($row->term == 1) ? 'First Term' : 'Second Term';?></td>
				                	</tr>
				                	<?php }?>
				                	<tr>
				                		<td style="padding-left: 12px"><?php echo $row->week_number;?></td>
				                		<td align="center"><?php echo $row->start_dt . ' - ' .$row->end_dt;?></td>
				                		<?php if($row->plan_num_week >= 1){?>
				                		<td rowspan="<?php echo $row->plan_num_week;?>"><?php echo $row->week_plan;?></td>
				                		<?php }?>
				                	</tr>
				                	<?php }
				                	}else{ echo 'No Week Selected!!';}?>
			                	
			                	</table>
					 			<table border="1" style="border: 1px solid #8CBAE8; width: 100%; background-color: #FFF; color: #000;">
					                <tr>
					                	<td><?php echo Base_Controller::ToggleLang('No');?></td>
					                	<td style="padding-left: 4px"><?php echo Base_Controller::ToggleLang('Admission #');?></td>
					                	<td style="padding-left: 4px"><?php echo Base_Controller::ToggleLang('Student Name');?></td>
				                    	<?php $w = $week_day_start;
				                    		for($days=1; $days<=$total_days; $days++)
				                    		{ 
				                    			if($w==7) $w=0;
				                    			$name=$day_name[$w];
				                    			$border = ($w==3) ? 'border-right:2px solid #000000;' : '';
				                    			$w++; 
				                    			if($w > 4) continue;
				                    	?>
					                    	<td width="33px" style="padding:4px; <?php echo $border;?>">
					                    	<span style="width:24px"><?php echo $name;?></span><br>
					                    	<span style="width:24px"><?php echo $days;?></span>
					                    	</td>
				                    	
				                    	<?php }?>
				                	</tr>
				                	<?php $s=0;
				                		foreach ($student_list as $student){ 
				                			$student_id = $student->student_id;
				                			$s++;
				                	?>
				                	<tr>
				                		<td><?php echo $s;?></td>
				                		<td style="padding-left: 4px"><?php echo $student->admission_number;?></td>
				                		<td style="padding-left: 4px"><?php echo $student->student_name;?></td>
				                    	<?php 
				                            $title = "Mark Attendance"; $w=$week_day_start;
				                            $today = date('Ymd');
				                        	for($days=1; $days<=$total_days; $days++){
												
				                        		if($w==7) $w=0;
				                        		$border = ($w==3) ? 'border-right:2px solid #000000;' : '';
				                        		$w++;
				                        		if($w > 4) continue;
				                        		
				                        		$cell_id = $year_month.'-'.$days;
												$tooltip = "";
												$param = 'student_id='.$student_id."&attendance_date=".$cell_id;
												$url   = base_url().$model."/add_attend";
												$curr_app = '&nbsp;'; $i = $days;
												if($days < 10 ) $i = '0'.$days;
												if(isset($attendance[$i])){
													
													$tooltip = 'Reason: '.$attendance[$i];
													$att = '<i class="fa fa-close"></i>';
												}
												$current_date = date('Ym').$days;
												
												$att = ($current_date <= $today) ? '<i class="fa fa-check"></i>' : '';
												
											echo '<td id="'.$cell_id.'" title="'.$tooltip.'" valign="top" style="padding:4px; '.$border.'" nowrap="nowrap" onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.'\')">'. $att .'</td>';?>
				                    		
				                    	<?php }?>
				                	</tr>
				                	<?php } ?>
				            	</table>
					 	</div>
				 	</div>
			</form>
	        <input type="hidden" id="count" value="0"/>
	        <div id="dialog-form"></div>
	        
<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>	
<script> 
		jQuery(document).ready(function() {    
		   // initiate layout and plugins
		   App.init();
		});

        function onchange_courses(val){
		        if(val != ''){
			        
	        		get('<?php echo base_url().'timetable/batches/';?>'+val, '', 'td_batch','false','');
		        }
	        }

	        function onchange_batch(val){
	        	document.getElementById('td_timetable').innerHTML = "";
		        if(val != ''){
	        		get('<?php echo base_url().'timetable/batch_timing/';?>'+val, '', 'td_timetable','false','');
		        }
	        }

	        function onchange_subject(val){
		        if(val != ''){
	        		get('<?php echo base_url().'timetable/subject_employee/';?>'+val, '', 'td_teacher','false','');
		        }
	        }

	        function onclick_remove_sub_emp(val){
		        if(val != ''){
		        	if(confirm('Are you sure? you want to delete this class timing!')){

		        		get('<?php echo base_url().'timetable/remove_subject_teacher';?>', 'param='+val, 'td_timetable','false','');
		        	}
		        }
	        }
	        
			function showUrlInDialog(_url, params, options, cell_id){
            	options = options || {};
            	var tag = $("#dialog-form"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: _url+'?'+params,
            	    type: (options.type || 'POST'),
            	    beforeSend: options.beforeSend,
            	    error: options.error,
            	    complete: options.complete,
            	    success: function(data, textStatus, jqXHR) {
            	      if(typeof data == "object" && data.html) { //response is assumed to be JSON
            	        tag.html(data.html).dialog({modal: options.modal, title: data.title, width:700, height: 500, draggable: true}).dialog('open');
            	      } else { //response is assumed to be HTML
            	        tag.html(data).dialog({modal: options.modal,  
                	        buttons: {
            	        	Save: function() {
            	        	get(_url+'?f=insert', '', 'td_timetable', false, 'attendForm');
            	            $( this ).dialog( "close" );
            	          	},
            	        	Cancel: function() {
            	            $( this ).dialog( "close" );
            	          	}
            	        }, title: options.title, width:600, height: 400, draggable: true }).dialog('open');
            	      }
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	      
            	    }
            	});
            }
            </script>