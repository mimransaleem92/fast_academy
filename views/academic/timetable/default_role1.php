<link type="text/css" href="<?php echo base_url();?>assets/css/redmond/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />	
				<form id="timetableForm" method="post" >
					<div class="form-body">
						<div class="row alert alert-success">
							<div class="col-md-6">
								<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name').' / '.Base_Controller::ToggleLang('Section');?></label>
								<?php 
								$b = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
								$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
								$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
								
								$admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false;
								?>
								<div class="col-md-7">
									<div class="form-group">
	    								<?php 
	    								if($admin_user){
	    									echo '<select name="course_id" class="form-control col-md-6" id="course_id" style="width: 150px" onchange="timetableForm.submit();" >';
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
									<label class="control-label col-md-3 right"><?php echo Base_Controller::ToggleLang('Session');?></label>
									<div class="col-md-6" id="td_batch">
										<?php if($admin_user){ ?>
										<select name="batch_id" class="form-control" id="batch_id" >
					                    	<?php 
					                    	foreach($batch_list as $batch){
					                    		$batch_id = $batch->batch_id;
					                    		$sel = ($batch_id ==  $b) ?  'selected' : '' ;
					                    		echo '<option value="'.$batch_id.'" '.$sel.'>'.$batch->batch_name.'</option>';
					                    	}
					                    	?>
										</select>
										<?php }else{
											$session_name = '';
											foreach($batch_list as $batch){
												$batch_id = $batch->batch_id;
												if($batch_id ==  $b){
													$session_name =  $batch->batch_name ; break;
												}
											}
											?>
										<input type="hidden" name="batch_id" value="<?php echo $batch_id;?>" />										
										<input type="text" name="session_name" readonly="readonly" class="form-control col-md-4" id="session_name" value="<?php echo $session_name; ?>" style="width: 120px">
										<?php }?>
									</div>
									<label class="control-label col-md-3">&nbsp;</label>
								</div>
							</div>
						</div>
						
						<div class="row alert alert-info" id="td_timetable">
							<table width="100%" border="0" cellspacing="3" cellpadding="0" align="center" style="background-color: white">
							    	<tr>
				                  		<td width="*" colspan="3" align="<?php echo $class_left;?>" valign="middle" >
				                  			<table width="100%" cellspacing="0" cellpadding="0" style="<?php if($admin_user) echo 'cursor:pointer;';?> border: 1px solid #000;">
						                        <?php 
						                        	$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
						                  			$i=0;
						                          	if(isset($weekday_list) && sizeof($weekday_list) > 0){
						                          		$subject_employee = array();
						                          		foreach ($subject_employee_list as $values){
						                          			$index = $values->weekday.$values->course_id.'-'.$values->batch_id.'-'.$values->id;
						                          			$subject_employee[$index] = '<u>'.$values->subject_name.'</u><br>'.$values->employee_name;
						                          		}
						                          		
						                          		$class = 'style="border-right:1px solid #000; border-bottom:1px solid #000; padding:4px; text-align:center; text-transform:uppercase;"';
						                          		echo '<tr><td '.$class.' width="140px"><b>Time</b></td>';
						                          		/* foreach($ct_list as $ctime){
						                          			$class_time_from = strftime('%I:%M %p', strtotime($ctime->start_time));
						                          			$class_time_to   = strftime('%I:%M %p', strtotime($ctime->end_time));
						                          			echo '<td '.$class.'><b>'.$class_time_from.'-'.$class_time_to.'</b></td>';
						                          		} */
						                          		$weekdays = $weekday_list[0]; $colspan = 0;
						                          		foreach($days as $d){
						                          			if($weekdays->$d == 'on'){
						                          				$colspan++;
						                          				echo '<td '.$class.' ><b>'.substr($d, 0, 3).'</b></td>';
						                          			}
						                          		}	
						                          		echo '</tr>';
						                          		
						                          		$title = "Timetable for the selected batch";
						                     					$i++;
											          			foreach($ct_list as $ctime){
							                          				$class_time_from = strftime('%I:%M %p', strtotime($ctime->start_time));
							                          				$class_time_to   = strftime('%I:%M %p', strtotime($ctime->end_time));
							                          				echo '<tr><td '.$class.'><b>'.$class_time_from.'-'.$class_time_to.'</b></td>';
							                          				if($ctime->is_break == 'Yes'){
							                          					$class_text = (!empty($ctime->break_text)) ? $ctime->break_text : 'Break';
							                          					echo '<td '.$class.' height=50px colspan="'.$colspan.'" >'.
							                          							$class_text.'</td>';
							                          					continue;
							                          				}
							                          				foreach($days as $d){
							                          					if($weekdays->$d == 'on'){
									                          				$cell_id = $ctime->course_id.'-'.$ctime->batch_id.'-'.$ctime->id;
									                          				$tooltip = "";
									                          				$param = 'weekday='.$d."&class_id=".$cell_id;
									                          				$url   = base_url().$model."/add_subject_teacher/".$ctime->course_id;
									                          				$class_text= '<span style="color: blue;">Assign</span>';//$ctime->start_time.'-'.$ctime->end_time;
									                          				
									                          				$curr_index = $d.$cell_id;
									                          				if($admin_user){
										                          				if(isset($subject_employee[$curr_index])){
																					$class_text = $subject_employee[$curr_index];
																					echo '<td '.$class.' height=50px onclick="onclick_remove_sub_emp(\''.$d.'-'.$cell_id.'\')" >'.
																							$class_text.'</td>';
																				}
																				else{
										                          					echo '<td '.$class.' height=50px onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.'\')" >'.
										                          					 	  $class_text.'</td>';
										                          				}
									                          				}
									                          				else{
									                          					if(isset($subject_employee[$curr_index])){
									                          						$class_text = $subject_employee[$curr_index];
									                          						echo '<td '.$class.' height=50px >'.
									                          								$class_text.'</td>';
									                          					}
									                          					else{
									                          						echo '<td '.$class.' height=50px  ></td>';
									                          					}
									                          				}
							                          					}
							                          				}	
																}
																echo '</tr>';
							                  			
						                          	}
						                          	else{
														echo '<tr><td style="border-right:1px solid #8CBAE8; border-bottom:1px solid #8CBAE8; padding:4px; text-align:center; text-transform:uppercase;">'.Base_Controller::ToggleLang('Please select course and batch').'!! </td></tr>';			
													}
						                          	?>
							                </table>
				                  		</td>
				                	</tr>    
				            </table>
				    	</form>
	        			<input type="hidden" id="count" value="<?php echo $i;?>"/>
        				<?php //echo Base_Controller::ToggleLang('Please select course and batch').'!!'; ?>
				 	</div>
			 	</div>
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
			        var arr = val.split('-');
			        document.getElementById('span_detail').innerHTML = arr[1] + ' Period Per Week';
	        		get('<?php echo base_url().'timetable/subject_employee/';?>'+arr[0], '', 'td_teacher','false','');
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