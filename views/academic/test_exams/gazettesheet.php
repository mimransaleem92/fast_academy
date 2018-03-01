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
								<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name');?></label>
								<?php 
								$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : $this->session->userdata(SESSION_CONST_PRE.'subject_id');
								$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
								$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
								$admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false;
								?>
								<div class="col-md-7">
									<div class="form-group">
	    								<?php 
	    								if(true){
	    									echo '<select name="course_id" class="form-control col-md-6" id="course_id" style="width: 150px" onchange="marksheetForm.submit();" >';
	    									foreach($courses_list as $course){
												$course_id = $course->course_id;
												$sel = ($course_id ==  $c) ?  'selected' : '' ;
												echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
											}
											echo '</select>';
											echo '<input type="text" name="section" class="form-control col-md-4 hide" id="section" value="'.$sec.'" style="width: 50px">';
										}else{
											foreach($courses_list as $course){
												$course_id = $course->course_id;
												if($course_id ==  $c) { $course_name = $course->course_name; break;}
											}
										?>
    									<input type="hidden" name="course_id" id="course_id" value="<?php echo $c; ?>">
    									<input type="text" name="course_name" readonly="readonly" class="form-control col-md-6" id="course_name" value="<?php echo $course_name; ?>" style="width: 150px">
    									<input type="text" name="section" readonly="readonly" class="form-control col-md-4 hide" id="section" value="<?php echo $sec; ?>" style="width: 50px">
    									<?php }?>
    								</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-5 hide" >
										<?php $term_name = 'First';?>
										<select name="term" class="form-control" id="term" style="width: 170px" onchange="marksheetForm.submit();">
						                	<?php 
												$arr_m = array('--','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
												for($m = 4; $m <= 12; $m++){
													$selected =  ($term == $m) ? 'selected' : '';
													echo '<option value="'.$m.'"  '.$selected.' > '.$arr_m[$m].' </option>';
												}
											?>
										</select>
									</div>
									<div class="col-md-5 hide" >
										<!-- <input type="text" name="subject" class="form-control" id="subject" value="<?php //echo $subject; ?>"> -->
										<select name="subject_id" class="form-control" id="subject_id" onchange="marksheetForm.submit();">
						                    <?php foreach($subject_list as $sub){ 
				                    				$sid = $sub->subject_id;
				                    				$sel = ($subject_id == $sid) ? 'selected' : '';
						                    	?> 
						                    	<option value=<?php echo '"'.$sid.'" '.$sel;?> ><?php echo $sub->subject_name;?></option>
						                    <?php } ?>
										</select>
									</div>
									<div class="col-md-7" >
										<?php //$subject_id = isset($_POST['subject_id']) ? $_POST['subject_id']: 1; 
										 	  $term_id = isset($_POST['term']) ? $_POST['term']: 1;?>
										<a class="btn green" href="<?php echo base_url().$model.'/print_view/?course_id='.$c."&section=".$sec."&term=". $term;?>" target="_blank"><i class="fa fa-print"></i> Print</a>
										<a class="btn blue" href="<?php echo base_url().$model.'/excel/?course_id='.$c;?>" target="_blank"><i class="fa fa-print"></i> EXCEL </a>
										<button class="btn blue" type="button" onclick="send_sms();" ><i class="fa fa-mail"></i> Send SMS </button>
										
									</div>
								</div>
							</div>
						</div>
			
						<div class="row alert alert-info cl-md-12" id="tbl_marksheet" >
								<?php //$c = 68; echo chr($c++);?>
					 			<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
					 				
					                <tr >
										<th rowspan="2" class="hidden-xs hidden-sm text-center"><input type="checkbox" id="checkall" onclick="setAllCheckOptions()"></th>
					                	<th rowspan="2" class="text-center" ><?php echo Base_Controller::ToggleLang('No');?></th>
					                	<th rowspan="2" style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Admission #');?></th>
					                	<th rowspan="2" style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Student Name');?></th>
					                	<th colspan="<?php echo sizeof($subject_list)*2 + 2;?>" style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Obtain Marks');
											$title = "Update Subject Marks";
				                			$param = "course_id=".$c."&section=".$sec."&t=".$term;
				                			$url   = base_url().$model."/update_marks";
										?>
											<span style="float: right; display:none;" <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \'tbl_marksheet\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i></span>
										</th>
					                </tr>
									<tr style="border-bottom: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
										<?php foreach($subject_list as $sub){ 
				                    				$sid = $sub->subject_id;
				                    				$sel = ($subject_id == $sid) ? 'selected' : '';
						                    	?> 
						                    	<th style="text-align: center;" >Total</th>
												<th style="text-align: center;" title="<?php echo $sub->subject_name;?>" ><?php echo $sub->subject_code;?></th>
						                <?php } ?>
										<th style="text-align: center;" >Total</th>
										<th style="text-align: center;" >%age</th>
					                </tr>
				                	<?php $s=0; $marks_arr = array();
				                		foreach ($student_list as $student){
				                			$student_id = $student->student_id;
				                			$s++;
				                			$title = "Mark Sheet";
				                			$param = 'student_id='.$student_id."&course_id=".$c."&section=".$sec."&sid=".$subject_id."&t=".$term;
				                			$url   = base_url().$model."/add_marks";
											$row_total = $row_obtain = 0;
											$row_color = ($student->result_sms_sent > 0) ? 'background-color: green; color: #FFF' : '';
				                	?>
				                	<tr style="<?= $row_color ?>">
										<td class="hidden-xs hidden-sm text-center" ><input type="checkbox" name="selected_id_<?php echo $s;?>" id="selected_id_<?php echo $s;?>" <?php //if($values->status == 'Issued') echo 'disabled="disabled"';?> value="<?php echo $student->student_id;?>" /></td>
				                		<td class="text-center"><?php echo $s;?></td>
				                		<td style="padding-left: 4px"><?php echo $student->admission_number;?></td>
				                		<td style="padding-left: 4px; padding-right: 4px"><?php echo $student->student_name;?></td>
										<?php foreach($subject_list as $sub){ 
				                    				$sid = $sub->subject_id;
													if(isset($marks[$student->student_id][$sid]) && $marks[$student->student_id][$sid] !== 'a' ){
														$row_obtain += $marks[$student->student_id][$sid]['marks'];
														//$row_total += $totals[$sid];
														$row_total += $marks[$student->student_id][$sid]['subject_total'];
													}
						                    	?> 
						                    	<td style="text-align: center; text-transform: uppercase" ><?php echo isset($marks[$student->student_id][$sid]) ? $marks[$student->student_id][$sid]['subject_total'] : '--';?></td>
												<td style="text-align: center; text-transform: uppercase" ><?php echo isset($marks[$student->student_id][$sid]) ? $marks[$student->student_id][$sid]['marks'] : '--';?></td>
						                <?php } 
												$marks_arr[$student->student_id] = $tt = number_format(($row_obtain / $row_total) * 100, 2);
										?>
										<td style="text-align: center;"><?php echo $row_obtain. ' / ' .$row_total;?></td>
										<td style="text-align: center;" id="<?php echo 'res'.$s;?>"><?php echo $tt;?></td>
				                	</tr>
				                	<?php } 
									rsort($marks_arr); $position_arr = array(); $i = 0;
									foreach($marks_arr as $id => $marks){
										$position_arr[] = $marks; $i++;
										if($i == 3) break;
									}
									
									?>
				            	</table>
								<input type="hidden" id="count" value="<?php echo $s;?>"/>
					 	</div>
				 	</div>
				<!-- <input type="hidden" id="term" name="term" value="<?php echo $term;?>"/> -->	 	
			</form>
	        
	        <div id="dialog-form"></div>
	        
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>	
<script> 
		jQuery(document).ready(function() {    
		   // initiate layout and plugins
		   App.init();
		});

		var top_arr = [<?php echo implode(",",$position_arr);?>];
		count = document.getElementById('count').value;		
		for(i=1; i<=count; i++){
			console.log(document.getElementById('res'+i).innerHTML);
			
			if(document.getElementById('res'+i)){
				for(s=0; s<3; s++){
					
					if(document.getElementById('res'+i).innerHTML == top_arr[0]){
						
						document.getElementById('res'+i).innerHTML = '<b>'+top_arr[0]+' - Ist</b>';
					}
					else if(document.getElementById('res'+i).innerHTML == top_arr[1]){
						document.getElementById('res'+i).innerHTML = '<b>'+top_arr[1]+' - 2nd</b>';
					}
					else if(document.getElementById('res'+i).innerHTML == top_arr[2] && top_arr[2] != 0){
						document.getElementById('res'+i).innerHTML = '<b>'+top_arr[2]+' - 3rd</b>';
					}
				}
			}	
		}
		
	        function onchange_courses(val){
		        if(val != ''){
			        
	        		get('<?php echo base_url().'timetable/batches/';?>'+val, '', 'td_batch','false','');
		        }
	        }
			
	function send_sms(){
		var v = '';
		count = document.getElementById('count').value;		
		for(i=1; i<=count; i++){
			if(document.getElementById('selected_id_'+i)){
				c = document.getElementById('selected_id_'+i);
				if(c.checked){
					v += document.getElementById('selected_id_'+i).value;
					v+=",";
				}
			}
		}
		
		if(v!=''){
			v = v.substring(0, v.length-1);
			var str_loc = window.location;
			var arr = str_loc.toString();
			var start = arr.indexOf('display')-1;
			var end = arr.length;
			//alert(start+' , '+end);
			if(start > 0){
				arr = arr.substring(0,start);
			}
			var start1 = arr.indexOf('#');
			if(start1 > 0){
				arr = arr.substring(0,start1);
			}
			if(confirm("Are you sure to sms selected record?")){
				m = document.getElementById('term').value;
				window.location = arr + '/send_sms?selected_id=' + v + '&term='+m;
			}
		}else{
			alert('Please select a record to sms!');
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

            function setAllCheckOptions(){
				var obj = document.getElementById('checkall');
				var count = document.getElementById('count').value;
				if(obj.checked){
					for(a=1;a<=count;a++){
						document.getElementById('selected_id_'+a).checked = true;
						$('input#selected_id_'+a).closest('span').addClass('checked');
					}
				}
				else{
					for(a=1;a<=count;a++){
						document.getElementById('selected_id_'+a).checked = false;
						$('input#selected_id_'+a).closest('span').removeClass('checked');
					}
				}	
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