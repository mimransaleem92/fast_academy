<link type="text/css" href="<?php echo base_url();?>assets/css/redmond/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />	
				<form id="attendForm11" method="post" >
					<div class="form-body">
						<div class="row alert alert-success">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">&nbsp;</label>
									<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name');?></label>
									<div class="col-md-6">
										<?php   $course_name = '';
    					                    	$c = $this->session->userdata(SESSION_CONST_PRE.'course_id');
    					                    	$s = $this->session->userdata(SESSION_CONST_PRE.'section');
    					                    	foreach($courses_list as $course){ 
    					                    		$course_id = $course->course_id;
    					                    		if($course_id ==  $c) { $course_name = $course->course_name; break;}
    					                    	}	 
    					                ?>
    					                <input type="text" name="course_id" readonly="readonly" class="form-control" id="course_id" value="<?php echo $course_name; ?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<label class="control-label col-md-3 right"><?php echo Base_Controller::ToggleLang('Section');?></label>
									<div class="col-md-6" id="td_batch">
										<input type="text" name="batch_id" readonly="readonly" class="form-control" id="batch_id" value="<?php echo $s; ?>">
									</div>
									<label class="control-label col-md-3">&nbsp;</label>
								</div>
							</div>
						</div>
						
						<div class="row alert alert-info" id="td_timetable">
					 		<?php echo Base_Controller::ToggleLang('Please select course and batch'); ?>!!
					 	</div>
				 	</div>
				 	
				 				
					<!-- <table width="100%" border="0" cellspacing="3" cellpadding="0" align="center">
					    	<tr>
		                  		<td width="*" colspan="3" align="<?php echo $class_left;?>" valign="middle" >
		                  			<table width="100%" cellspacing="0" cellpadding="0" style="cursor:pointer; border: 1px solid #8CBAE8;">
				                        <?php 
				                        	$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
				                  			$i=0;
				                          	if(isset($weekday_list) && sizeof($weekday_list) > 0){
				                          		$subject_employee = array();
				                          		foreach ($subject_employee_list as $values){
				                          			$index = $values->weekday.$values->course_id.'-'.$values->batch_id.'-'.$values->id;
				                          			$subject_employee[$index] = '<u>'.$values->subject_name.'</u><br>'.$values->employee_name;
				                          		}
				                          		
				                          		$class = 'style="border-right:1px solid #8CBAE8; border-bottom:1px solid #8CBAE8; padding:4px; text-align:center; text-transform:uppercase;"';
				                          		echo '<tr><td '.$class.'></td>';
				                          		foreach($ct_list as $ctime){
				                          			$class_time_from = strftime('%I:%M %p', strtotime($ctime->start_time));
				                          			$class_time_to   = strftime('%I:%M %p', strtotime($ctime->end_time));
				                          			echo '<td '.$class.'><b>'.$class_time_from.'-'.$class_time_to.'</b></td>';
				                          		}
				                          		echo '</tr>';
				                          		$weekdays = $weekday_list[0];
				                          		$title = "Timetable for the selected batch";
				                          		foreach($days as $d){
													if($weekdays->$d == 'on'){
														$i++;
														
						                          		echo '<tr><td '.$class.' ><b>'.substr($d, 0, 3).'</b></td>';
					                          			foreach($ct_list as $ctime){
					                          				$cell_id = $ctime->course_id.'-'.$ctime->batch_id.'-'.$ctime->id;
					                          				$tooltip = "";
					                          				$param = 'weekday='.$d."&class_id=".$cell_id;
					                          				$url   = base_url().$model."/add_subject_teacher/".$ctime->course_id;
					                          				$class_text= '<span style="color: blue;">Assign</span>';//$ctime->start_time.'-'.$ctime->end_time;
					                          				if($ctime->is_break == 'Yes'){
					                          					$class_text = 'Break';
					                          				}
					                          				$curr_index = $d.$cell_id;
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
														echo '</tr>';
					                  				}
												}
				                          	}
				                          	else{
												echo '<tr><td style="border-right:1px solid #8CBAE8; border-bottom:1px solid #8CBAE8; padding:4px; text-align:center; text-transform:uppercase;">'.Base_Controller::ToggleLang('Please select course and batch').'!! </td></tr>';			
											}
				                          	?>
					                </table>
		                  		</td>
		                	</tr>    
		            </table> -->
					</form>
	        <input type="hidden" id="count" value="<?php echo $i;?>"/>
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