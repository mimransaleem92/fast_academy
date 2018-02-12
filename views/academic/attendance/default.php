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
<?php $admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false; ?>
				<form id="attendanceForm" method="post" >
					<div class="form-body">
						<div class="row alert alert-success">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name').' / '.Base_Controller::ToggleLang('Section');?></label>
									<div class="col-md-7">
										<?php 
										$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
										$s = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
	    								if($admin_user){
	    									echo '<select name="course_id" class="form-control col-md-6" id="course_id" style="width: 150px" onchange="timetableForm.submit();" >';
	    									foreach($courses_list as $course){
												$course_id = $course->course_id;
												$sel = ($course_id ==  $c) ?  'selected' : '' ;
												echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
											}
											echo '</select>';
											echo '<input type="text" name="section" class="form-control col-md-4" id="section" value="'.$s.'" style="width: 50px">';
										}else{
											foreach($courses_list as $course){
												$course_id = $course->course_id;
												if($course_id ==  $c) { $course_name = $course->course_name; break;}
											}
										?>
    									<input type="hidden" name="course_id" id="course_id" value="<?php echo $c; ?>">
    									<input type="text" name="course_name" readonly="readonly" class="form-control col-md-6" id="course_name" value="<?php echo $course_name; ?>" style="width: 150px">
    									<input type="text" name="section" readonly="readonly" class="form-control col-md-4" id="section" value="<?php echo $s;?>" style="width: 50px">
    									<?php }?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-6" >
									</div>
									<label class="control-label col-md-3">&nbsp;</label>
								</div>
							</div>
						</div>
						
						<div class="row alert alert-info cl-md-12" >
					 		<?php //echo Base_Controller::ToggleLang('Please select course and batch'); 
					 			$day_name = array('S', 'M', 'T', 'W', 'Th', 'F', 'S');
					 		?>
						 		<table border="1" style="border:2px solid #000; width: 100%; background-color: #FFF; color: #000;">
					                <tr>
					                	<th width="50px"><?php echo Base_Controller::ToggleLang('Week');?></th>
					                	<th width="200px" style="text-align: center"><?php echo Base_Controller::ToggleLang('Date');?></th>
					                	<th><?php echo Base_Controller::ToggleLang('Plan');?></th>
					                </tr>
				                	<?php $term = 0; $week = 0;
				                	if(isset($week_list) && sizeof($week_list)>0){
				                	foreach ($week_list as $row){
				                		  $week = $row->week_number;
				                		  if($term != $row->term){ $term = $row->term;
				                		  foreach ($term_list as $t){
				                		  	if($row->term == $t->id) {
				                		  		$term_name =  $t->name; break;
				                		  	}
				                		  }		
				                	?>
				                	<tr>
				                		<td colspan="3" align="center"><?php echo $term_name;?></td>
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
				                	}else{ echo '<tr height="35px"><td colspan="3">Academic session not started yet!!</td></tr>'; /* No Week Selected */}?>
			                	
			                	</table>&nbsp;
			                	
					 			<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
					                <tr>
					                	<td rowspan="2"><?php echo Base_Controller::ToggleLang('No');?></td>
					                	<td style="padding-left: 4px" rowspan="2"><?php echo Base_Controller::ToggleLang('Admission #');?></td>
					                	<td style="padding-left: 4px" rowspan="2"><?php echo Base_Controller::ToggleLang('Student Name');?></td>
					                	<td style="height: 10px">
					                		<a href="#" onclick="get_back();">Prev</a>	
					                	</td>
					                	<td style="text-align: center;border-right:2px solid #000000;" colspan="4"><?php echo Base_Controller::ToggleLang('Week').' '.($week-1);?></td>
					                	<td style="text-align: center;border-right:2px solid #000000;" colspan="5"><?php echo Base_Controller::ToggleLang('Week').' '.$week;?></td>
					                	<td style="text-align: center;" colspan="4"><?php echo Base_Controller::ToggleLang('Week').' '.($week+1);?></td>
					                	<td style="height: 10px">
					                		<a href="#" onclick="get_next();">Next</a>
					                	</td>
					                </tr>	
					                <tr>
					                	<?php 
				                    		$w = 0; 
				                    		$date = $week_day_start;
				                    		for($days=1; $days<=21; $days++)
				                    		{ 
				                    			if($w==7) $w=0;
				                    			$name=$day_name[$w];
				                    			$border = ($w==4) ? 'border-right:2px solid #000000;' : '';
				                    			$w++; 
				                    			if($w > 5) { 
				                    				//$date = ($date == $last_day) ? 1 : $date++;
				                    				if($date == $last_day) 
				                    				{ 
				                    					$date =  1;
				                    					//$curr_month++;
				                    				}
				                    				else {
				                    					$date++;
				                    				}
				                    				continue; 
				                    			}
				                    	?>
					                    	<td width="33px" style="padding:4px; <?php echo $border;?>">
					                    	<span style="width:24px"><?php echo $name;?></span><br>
					                    	<span style="width:24px"><?php echo $date;?></span>
					                    	</td>
				                    	
				                    	<?php	if($date == $last_day) $date =  1; else $date++;
				                    		}?>
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
				                            $title = "Mark Attendance"; 
				                            $w = 0;
				                            $date = $week_day_start;
				                            $today = date('Ymd');
				                            $month_flag=true; $month=$curr_month;
				                        	for($days=1; $days<=21; $days++){
				                        		
				                        		if($w==7) $w=0;
				                        		$name=$day_name[$w];
				                        		$border = ($w==4) ? 'border-right:2px solid #000000;' : '';
				                        		$w++;
				                        		if($w > 5) { 
				                        			if($date == $last_day) { 
				                        				$date =  1;
				                        				if($month_flag){
				                        					$month_flag=false; $month++;
				                        					$month = Util::leading_zeros(($month*1), 2);
				                        				} 
				                        			} else { $date++; }
				                        			continue;
				                        		}
				                        		if($date < 10) $date = Util::leading_zeros(($date*1), 2);	
				                        		$cell_id = $curr_year."-". $month .'-'.$date;
												$tooltip = "";
												$param = 'student_id='.$student_id."&attendance_date=".$cell_id;
												$url   = base_url().$model."/add_attend";
												$curr_app = '&nbsp;'; $i = $days;
												if($days < 10 ) $i = '0'.$days;
												
												$current_date = $curr_year.$month.$date;
												$att = ($current_date <= $today) ? '<i class="fa fa-check"></i>' : '';
												if(isset($attendance[$current_date][$student_id])){
													$tooltip = 'Reason: '.$attendance[$current_date][$student_id];
													$att = '<i class="fa fa-times"></i>';
													$param .= '&absent=Y';
													echo '<td id="'.$cell_id.$student_id.'" valign="top" style="padding:4px; '.$border.'" title="'.$tooltip.'" ><span onclick="remove_attendance(\''.$param.'\', \''.$cell_id.$student_id.'\');">'.$att.'</span></td>';
												}
												else{
													echo '<td id="'.$cell_id.$student_id.'" valign="top" style="padding:4px; '.$border.'" nowrap="nowrap" ><span onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.$student_id.'\')">'. $att .'</span></td>';
												}	

												if($date == $last_day) { 
													$date =  1;  
													if($month_flag){
														$month_flag=false; $month++;
														$month = Util::leading_zeros(($month*1), 2);
													}
												}else {
													$date++;
												}
				                        	}?>
				                	</tr>
				                	<?php } ?>
				            	</table>
				            	<?php //print_r($attendance);?>
					 	</div>
				 	</div>
				<input type="hidden" id="term" name="term" value="<?php echo $term;?>"/>
				<input type="hidden" id="week" name="week" value="<?php echo $week;?>"/>	 	
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
            	        	get(_url+'ance', '', cell_id, false, 'attendForm');
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