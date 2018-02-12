<link type="text/css" href="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js"></script>
<style>
<!--
.noclose .ui-dialog-titlebar-close
{
    display:none;
}
-->
</style>
				<form id="marksheetForm" method="post" >
					<div class="form-body">
						<div class="row alert alert-success">
							<div class="col-md-6">
								<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name').' / '.Base_Controller::ToggleLang('Section');?></label>
								<?php 
								$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
								$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
								$admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false;
								?>
								<div class="col-md-7">
									<div class="form-group">
	    								<?php 
	    								if($admin_user){
	    									echo '<select name="course_id" class="form-control col-md-6" id="course_id" style="width: 150px" onchange="marksheetForm.submit();" >';
	    									foreach($courses_list as $course){
												$course_id = $course->course_id;
												$sel = ($course_id ==  $c) ?  'selected' : '' ;
												echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
											}
											echo '</select>';
											echo '<input type="text" name="section" class="form-control col-md-4" id="section" value="'.$sec.'" style="width: 50px">';
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
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-5" >
										<?php $term_name = 'First';?>
										<select name="term" class="form-control" id="term" style="width: 170px" onchange="marksheetForm.submit();">
						                	<?php 
												$arr_m = array('--','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
												for($m = 4; $m <= 12; $m++){
													$selected = (isset($_POST['term']) && ($_POST['term'] == $m)) ? 'selected' : '';
													echo '<option value="'.$m.'"  '.$selected.' > '.$arr_m[$m].' </option>';
												}
											?>
											
										</select>
									</div>
									<div class="col-md-5" >
										<!-- <input type="text" name="subject" class="form-control" id="subject" value="<?php //echo $subject; ?>"> -->
										<select name="subject_id" class="form-control" id="subject_id" onchange="marksheetForm.submit();">
						                    <?php foreach($subject_list as $sub){ 
				                    				$sid = $sub->subject_id;
				                    				$sel = (isset($_POST['subject_id']) && $_POST['subject_id'] == $sid) ? 'selected' : '';
						                    	?> 
						                    	<option value=<?php echo '"'.$sid.'" '.$sel;?> ><?php echo ' ' .$sub->subject_name;?></option>
						                    <?php } ?>
										</select>
									</div>
									<div class="col-md-2" >
										<?php $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id']: 1; 
										 	  $term_id = isset($_POST['term']) ? $_POST['term']: 1;?>
										<a class="btn green" href="<?php echo base_url().$model.'/print_view/?course_id='.$c."&section=".$sec."&term=". $term_id."&subject_id=".$subject_id;?>" target="_blank"><i class="fa fa-print"></i> Print</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row alert alert-info cl-md-12" id="tbl_marksheet" >
					 		<?php $day_name = array('S', 'M', 'T', 'W', 'Th', 'F', 'S'); ?>
						 		<!-- <table border="1" style="border:2px solid #000; width: 100%; background-color: #FFF; color: #000;">
					                <tr>
					                	<th width="50px"><?php echo Base_Controller::ToggleLang('Week');?></th>
					                	<th width="200px" style="text-align: center"><?php echo Base_Controller::ToggleLang('Date');?></th>
					                	<th><?php echo Base_Controller::ToggleLang('Plan');?></th>
					                </tr>
				                	<?php $week = 0;
				                	if(isset($week_list) && sizeof($week_list)>0){
				                	foreach ($week_list as $row){
				                		  $week = $row->week_number;
				                		  if($term != $row->term){ //$term = $row->term;		
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
			                	
			                	</table>&nbsp; -->
			                	
			                	<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
					 				<?php 
					 					$colspan = count($header_title);
					 					if($col_average == 'Y') $colspan++;
					 					if($col_total == 'Y') $colspan++;
					 				?>
					                <tr>
					                	<td rowspan="3"><?php echo Base_Controller::ToggleLang('No');?></td>
					                	<td style="padding-left: 4px" rowspan="3"><?php echo Base_Controller::ToggleLang('Admission #');?></td>
					                	<td style="padding-left: 4px" rowspan="3"><?php echo Base_Controller::ToggleLang('Student Name');?></td>
					                	<td style="text-align: center;" colspan="<?php echo $colspan?>"><?php echo $term_name;?></td>
					                </tr>	
					                <tr>
					                	<?php
					                	if(isset($header_title) && sizeof($header_title)>0){
				                    		foreach ($header_title as $i => $name)
				                    		{ 
				                    	?>
					                    	<td width="50px" style="text-align: center;vertical-align: top; <?php //echo $border;?>">
					                    	<span><?php echo $name;?></span>
					                    	</td>
				                    	<?php	
				                    		}
				                    		if($col_average == 'Y') echo '<td style="height: 10px;text-align: center; vertical-align: top;">'.Base_Controller::ToggleLang('Average').'</td>';
				                    		if($col_total == 'Y') echo '<td style="height: 10px;text-align: center; vertical-align: top;">'.Base_Controller::ToggleLang('Total').'</td>';
					                	} 
				                    	?>
				                    	
				                	</tr>
				                	<tr>
					                	<?php $average = $total = $n = 0;
					                	if(isset($header_score) && sizeof($header_score)>0){
				                    		foreach ($header_score as $i => $score)
				                    		{ 
				                    	?>
					                    	<td width="50px" style="text-align: center;vertical-align: top; <?php //echo $border;?>">
					                    	<span><?php echo $score;?></span>
					                    	</td>
				                    	<?php 
				                    			$total += $score;
				                    			if($score > 0) { $n++; }
				                    		}	if( $n > 0) $average = $total / $n;
					                	
				                    		if($col_average == 'Y') echo '<td style="height: 10px;text-align: center; vertical-align: top;">'.$average.'</td>';
				                    		if($col_total == 'Y') echo '<td style="height: 10px;text-align: center; vertical-align: top;">'.$total.'</td>';
					                	}
				                    	?>
				                	</tr>
				                	<?php $s=0;
				                		foreach ($student_list as $student){
				                			$student_id = $student->student_id;
				                			$s++;
				                			$title = "Mark Sheet";
				                			$param = 'student_id='.$student_id."&course_id=".$c."&section=".$sec."&sid=".$subject_id."&t=".$term;
				                			$url   = base_url().$model."/add_marks";
				                	?>
				                	<tr>
				                		<td><?php echo $s;?></td>
				                		<td style="padding-left: 4px"><?php echo $student->admission_number;?></td>
				                		<td style="padding-left: 4px; padding-right: 4px"><?php echo $student->student_name;?>
				                		<span style="float: right;" <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \'tbl_marksheet\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i></span>
				                		<span style="float: right; padding-right: 10px;"><?php echo $student->student_name_ar;?></span>
				                		</td>
				                    	<?php
				                            $today = $exam_date = date('Ymd'); $border ='';
				                            $average = $total = 0;
				                            if(isset($header_title) && sizeof($header_title)>0){
					                        	foreach ($header_title as $i=>$name){
					                        		$cell_id = $student_id.$i;
					                        		$tooltip = "";
					                        		$param .= "&field=".$i;
					                        		$url   = base_url().$model."/add_marks";
					                        		$att = (isset($marks[$student_id][$i])) ? ($marks[$student_id][$i]+0) : 0;
					                        		
					                        		if(isset($attendance[$exam_date][$student_id])){
														$tooltip = 'Reason: '.$attendance[$current_date][$student_id];
														$param .= '&absent=Y';
														echo '<td id="'.$cell_id.$student_id.'" valign="top" style="text-align: center; padding:4px; '.$border.'" title="'.$tooltip.'" ><span onclick="remove_attendance(\''.$param.'\', \''.$cell_id.$student_id.'\');">'.$att.'</span></td>';
													}
													else{
														echo '<td id="'.$cell_id.$student_id.'" valign="top" style="text-align: center; padding:4px; '.$border.'" nowrap="nowrap" ><span onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.$student_id.'\')">'. $att .'</span></td>';
	
													}
													
													$total += $att;
					                        	}
				                        		if($col_average == 'Y') echo '<td style="text-align: center; height: 10px">'.$average.'</td>';
					                        	if($col_total == 'Y') echo '<td style="text-align: center; height: 10px">'.$total.'</td>';
				                            }
				                        	?>
				                	</tr>
				                	<?php } ?>
				            	</table>
					 	</div>
				 	</div>
				<!-- <input type="hidden" id="term" name="term" value="<?php echo $term;?>"/> -->	 	
			</form>
	        <input type="hidden" id="count" value="0"/>
	        <div id="dialog-form"></div>
	        
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
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

	        function remove_attendance(val, id){
	        	get('<?php echo base_url().$model.'/add_attendance?';?>'+val, '', id, false,'');
	        }
	        
	        function get_back(){
	        	var w = document.getElementById('week').value;
	        	if(w > 2){
		        	document.getElementById('week').value = --w;
		        	attendanceForm.submit();
	        	}
	        }

	        function get_next(){
	        	var w = document.getElementById('week').value;
	        	if(w < 19){
	        		document.getElementById('week').value = ++w;
	        		attendanceForm.submit();
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
            	        	get(_url+'ave', '', cell_id, false, 'marksForm');
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
            
            function keyPressAllow(e, me, allowed){
            	if(keyPressAllowFloatOnly(e, me) && me.value <= allowed){
                	if(me.value <= allowed){
					return true;
                	}
                	else
                	{ me.value = allowed; }
            	}
            	else{
            		me.value = allowed;
            	}                	
            }
            </script>