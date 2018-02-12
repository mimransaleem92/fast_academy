<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-multi-select/css/multi-select.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
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
<h3>Student Profile: <?php $form = $form[0]; echo $form->student_name; //echo $session_start; //$start = microtime(true); echo 'time_elapsed: '.$time_elapsed;?></h3>
<div class="tabbable tabbable-custom boxless">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs_0" data-toggle="tab">Profile</a></li>
		<li><a href="#tabs_1" data-toggle="tab">Assesments</a></li>
		<li><a href="#tabs_2" data-toggle="tab">Attendance</a></li>
		<?php if($admin_role >= 1 && ENABLE_FEE_MODULE == 1){?>
		<li><a href="#tabs_3" data-toggle="tab">Fees</a></li>
		<?php }?>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabs_0">			
		<?php $today = date('Y-m-d'); 
			echo form_open('students/add',array('id'=>'mainForm'));
		?>
			<input type="hidden" id="after_ajax" value="N"/>
			<input type="hidden" id="student_id" name="student_id" value="<?php echo $form->student_id?>"/>
			<input type="hidden" id="batch_id" name="batch_id" value="<?php echo $form->batch_id?>"/>
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Profile');?></div>
					<div class="actions">
					<?php 
						if(ENABLE_FEE_MODULE == 1){
							if (strpos($form->check_list, '10') !== false){ ?>
						<a class="btn green" href="#" target="_self"><i class="fa fa-success"></i> Verified </a>
						<?php }else{
							$verify_note = "Student information is not updated. You must update it before collect the fee";
							?>
						<a class="btn red  popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="<?php echo $verify_note;?>" data-original-title="Note" href="#" target="_self" ></i> Not Verified </a>
					<?php } 
						}	?>
						<a class="btn green" href="<?php echo base_url().$model.'/print_view/'.$form->student_id;?>" target="_blank"><i class="fa fa-print"></i> Print Form </a>
					</div>
				</div>
				<div class="portlet-body">
					<?php if(isset($_GET['e'])){
						$error_msg = ($_GET['e'] == '2') ? 'Student information is not updated. You must update it before collect the fee.' : 'You are not authorized to collect student fee payments.';
					?>
					<div class="alert alert-danger">
						<button class="close" data-close="alert"></button>
						<div id="error1"><i class="fa fa-warning"></i> <?php echo $error_msg;?></div>
					</div>
					<?php }?>
					<div class="panel-group accordion scrollable" id="accordion2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_1">
									Student Information
									</a>
								</h4>
							</div>
							<div id="collapse_2_1" class="panel-collapse in">
								<div class="panel-body">
									<table class="table">
						                <tbody><tr >
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Admission No');?>:</td>
											<td width='20%'  ><?php echo $form->admission_number;?></td>
											<td width='15%'  ><?php echo Base_Controller::ToggleLang('Date of Admission');?>:</td>
											<td width='20%'  ><?php echo !empty($form->enrollment_date) ? Util::dateDisplayFormate($form->enrollment_date) : Util::dateDisplayFormate($form->admission_date);?></td>
											
											<!-- <td width='15%' ><?php echo Base_Controller::ToggleLang('City');?>:</td>
											<td width='20%'  ><?php echo $form->city;?></td> -->
											<td width='260' rowspan="10" valign="middle" align="center" >
												<?php 
												$file_name = $form->student_id;
												$dir_path = 'assets/uploads/students/';
												$filetype_arr = array('.jpg', '.jpeg', '.png', '.gif');
												foreach($filetype_arr as $type){
													$filepath = $dir_path.$file_name.$type;
													if( file_exists($filepath)) {
														$file_name = $file_name.$type;
														break;
													}
													$filepath = '';
												}
												?>
												<ul class="list-unstyled">
													<li>
													<img class="img-responsive" alt="" style="height:270px; width:250px"  src="<?php echo base_url().$filepath;?>"> <br/>
													<a class="btn default btn-xs blue-stripe" href="<?php echo base_url().$model."/profilephoto/".$form->student_id;?>" target="_self">Edit Photo</a>
													<?php if($admin_role >= 2){?>
													<a href="<?php echo base_url(). $model . "/edit/".$form->student_id;?>" class="btn default btn-xs red-stripe"  >Update Student Info</a>
													<a href="<?php echo base_url(). $model . "/school_leaving/".$form->student_id;?>" class="btn default btn-xs red-stripe"  >Leaving School</a>
													<?php }?>
													</li>
												</ul>
												
											</td>
										</tr>
										<tr>
											<td width='15%'  ><?php echo Base_Controller::ToggleLang("Students Name");?>:</td>
											<td width='35%' colspan="2" ><?php echo ($form->student_name);?></td>
											
											<td width='20%' style='font-family: "DroidKufi Regular", Tahoma;' align="right"><?php  echo ($form->student_name_ar);?></td>
											
										</tr>
									
										<tr>
											<td width='15%'  ><?php echo Base_Controller::ToggleLang("Enrollment Grade Level");?>:</td>
											<td width='20%'  ><?php echo ($form->enrollment_grade_level);?></td>
											
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Previous School');?>:</td>
											<td width='20%'  ><?php echo ($form->previous_school)?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Present Grade');?>:</td>
											<td width='20%'  ><?php echo $form->course_name . ' ' . $form->section;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Academic Year');?>:</td>
											<td width='20%'  ><?php echo $form->batch_name;?></td>
										</tr>
										<?php if($form->iqama_id != ''){ ?>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('CNIC');?>:</td>
											<td width='20%'  ><?php echo $form->iqama_id;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Expiry');?>:</td>
											<td width='20%'  ><?php echo Util::dateDisplayFormate($form->iqama_expiry);?></td>
										</tr>
										<?php } if($form->passport_id != ''){ ?>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Passport Number');?>:</td>
											<td width='20%'  ><?php echo $form->passport_id;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Passport Expiry');?>:</td>
											<td width='20%'  ><?php echo Util::dateDisplayFormate($form->passport_expiry);?></td>
										</tr>
										<?php } ?>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Date of Birth');?>:</td>
											<td width='20%'  ><?php if(!is_null($form->date_of_birth) && $form->date_of_birth != '0000-00-00'){ echo Util::dateDisplayFormate($form->date_of_birth). ',  Age: '. Util::ageCalculator($form->date_of_birth);}?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Birth Place');?>:</td>
											<td width='20%'  ><?php echo $form->birth_place;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Gender');?>:</td>
											<td width='20%'  ><?php echo $form->gender;?></td>	
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Religion');?>:</td>
											<td width='20%'  ><?php echo $form->religion;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('City');?>:</td>
											<td width='20%'  ><?php echo $form->city;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('State');?>:</td>
											<td width='20%'  ><?php echo $form->state;?></td>
											
										</tr>	
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Country');?>:</td>
											<td width='20%'  ><?php //echo $form->country_id;?>
											<?php foreach($country_list as $country){ 
												$country_id = $country->id;
												if($country_id ==  $form->country_id) { if($lang == 'ar') echo $country->country_ar; else echo $country->country_name; }
												} ?>
											</td>
										
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Nationality');?>:</td>
											<td width='20%'  ><?php //echo $form->nationality;?>
											<?php foreach($country_list as $country){ 
												$country_id = $country->id;
												if($country_id ==  $form->nationality) { if($lang == 'ar') echo $country->country_ar; else echo $country->country_name; }
												} ?>
											</td>
											
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Transportation');?>:</td>
											<td width='20%'  ><?php 
													if($form->transportation == 'Yes'){
														echo ($form->transport_type == 'TRANSPORT_FEE') ? 'One Side' : 'Two Side';
													}
													else { echo 'No'; } ?>
											</td>
											<td width='15%' ></td>
											<td width='20%'  ></td>
											
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Address Line1');?>:</td>
											<td width='20%'  ><?php echo $form->address_line1;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Address Line 2');?>:</td>
											<td width='20%'  ><?php echo $form->address_line2;?></td>
											
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Phone 1');?>:</td>
											<td width='20%'  ><?php echo $form->cell_phone_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Phone 2');?>:</td>
											<td width='20%'  ><?php echo $form->cell_phone_mother;?></td>
											<td width='30%' >&nbsp;</td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Subjects');?>:</td>
											<td width='' colspan='3'  >
											<?php 
												for($s = 1; $s <= 8; $s++){
													$field = 'sub'.$s;
													if($form->$field != '') echo $form->$field .', ';
												}
												$sub_str = '';
												foreach($subjects as $ss){
													$sub_str .= ', '.$ss->subject_name;
												}
												echo '<br>'.substr($sub_str, 1, strlen($sub_str));
												$param_update = 'student_id='.$form->student_id;
												$update_url   = base_url().$model."/update_monthly_subjects";
											?>
											</td>
											<td width='15%' >
												<button type="button" class="btn btn-xs green" onclick="btn_update()"><i class="fa fa-edit"></i> Update </button>
											</td>	
										</tr>
										</tbody>
									</table>	
								</div>
							</div>
							<?php echo form_close();?>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_2">
									Update Subjects & Status
									</a>
								</h4>
							</div>
							<div id="collapse_2_2" class="panel-collapse collapse">
								<div class="panel-body">
									<?php echo form_open('students/update_monthly_subjects',array('id'=>'subForm', 'class'=>"form-horizontal")); ?>
									<input type="hidden" name="student_id" id="student_id" value="<?php if(isset($form->student_id)) echo $form->student_id;?>" />
									<input type="hidden" name="batch_id" id="batch_id" value="<?php if(isset($form->batch_id)) echo $form->batch_id;?>" />
									<input type="hidden" name="course_id" id="course_id" value="<?php if(isset($form->course_id)) echo $form->course_id;?>" />
									<input type="hidden" name="month" id="month" value="<?php echo (isset($form->month)) ? $form->month: date('m');?>" />
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Subjects</label>
												<div class="col-md-6">
													<select multiple="multiple" class="multi-select" id="availableSubjects" name="availableSubjects[]">
														<?php 
															foreach($subject_selected as $v){ $id = $v->subject_id; ?>
																<option value="<?php echo $id;?>" selected ><?php echo $v->subject_name;?></option>
															<?php } 	
															foreach($subject_list as $v){ $id = $v->subject_id; ?> 
															<option value="<?php echo $id;?>"  ><?php echo $v->subject_name;?></option>
															
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2 col-sm-2">Continue Study</label>
												<div class="col-md-1 col-sm-2">
													<div class="make-switch" data-on-label="Yes" data-off-label="No">
														<input type="checkbox" name="study_continue" id="study_continue" <?php if(isset($form->study_continue) && $form->study_continue == 'Y') echo 'checked';?> class="toggle"/>
													</div>
														
												</div>
												<label class="control-label col-md-2  col-sm-2">Fee Month</label>
												<div class="col-md-2 col-sm-2">
													<select name="fee" class="form-control" id="fee" >
														<option value='1'> Full Fee </option>
														<option value='0.5'> Half Fee</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="row">
											<div class="col-md-6">
												<div class="col-md-offset-3 col-md-9" id="submit_row">
													<button type="button" class="btn green" onclick="update_subjects()" ><i class="fa fa-check"></i> <?php echo Base_Controller::ToggleLang('Submit');?></button>
													<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" ><?php echo Base_Controller::ToggleLang('Cancel');?></button>                              
												</div>
											</div>
											<div class="col-md-6"></div>
										</div>
									</div>
									
								<?php echo form_close();?>
								</div>
							</div>
						</div>		
						
					</div>	
					<!--<div class="table-responsive">
						<table><tbody>
							 <tr>
			                	<td colspan="5" ><h3><?php echo Base_Controller::ToggleLang('Emergeny Contact');?></h3></td>
			                </tr>
							<tr>
								<td width='100%'  colspan="5" id="tblParentDetail">
								<?php if(sizeof($guardian) > 0){ $val = $guardian[0];?>
			                	In case of emergencies,<br>
								contact : <?php echo $val->first_name. ' ' .$val->last_name. ' ('. $val->mobile_phone . ')';
								$param = 'student_id='.$val->student_id;
								$url   = base_url().$model."/edit_parent_data";
								?>
								
								<a href="#" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'parentDetailForm\', \'tblParentDetail\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Update Parent Info\'})"'; ?> >Edit</a>
			                	
			                	<?php }else {
			                		$param = 'student_id='.$student_id;
			                		$url   = base_url().$model."/add_parent_data";
			                		echo '<a href="#" onclick="showInnerBox( [\''. $url .'\', \'_insert\', \'parentDetailForm\', \'tblParentDetail\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Add Parent Info\'})" >Add</a> Contact Detail'; }?>
								</td>
							</tr>
							  
						</table>
					</div>	-->				
				</div>
			</div>
			
			</div>
			<div class="tab-pane " id="tabs_1" style="height: 520px"><?php include "assesment_detail.php"?></div>
			<div class="tab-pane " id="tabs_2" style="height: 420px">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption"><?php echo Base_Controller::ToggleLang('Attendance');?></div>
					</div>
					<div class="portlet-body" style="height: 130px"><?php include "attendance_detail.php"?></div>
				</div>
			</div>			
			<?php if($admin_role >= 1 && ENABLE_FEE_MODULE == 1){?>
			<div class="tab-pane " id="tabs_3" style="height: auto"><?php include "fees_detail.php"?></div>
			<?php }?>
		</div>
</div>
<!-- <input type="checkbox" name="selected_id_1" id="selected_id_1" value="<?php echo $form->student_id;?>" />
<input type="hidden" id="count" value="1"/> -->
<div id="dialog-form"></div>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>
<script>
	jQuery(document).ready(function() {    
	   // initiate layout and plugins
	   App.init();
	  $('#availableSubjects').multiSelect();		 
	   if (jQuery().datepicker) {
           $('.date-picker').datepicker({
           	dateFormat: "dd-mm-yy",
               rtl: App.isRTL(),
               autoclose: true
           });
           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
       }
	});
		
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
	            	    get(_url+'ance', '', 'div_attendance', false, 'attendForm');
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

			function showInnerBox(_url, params, options){
            	options = options || {};
            	var tag = $("#dialog-form"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: _url[0] +'?'+params,
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
            	        		target_div = _url[3];
            	        		get(_url[0] + _url[1], '', target_div, false, _url[2]);
            	            	$( this ).dialog( "close" );
            	          	},
            	        	Cancel: function() {
            	            $( this ).dialog( "close" );
            	          	}
            	        }, title: options.title, width:700, height: 500, draggable: true }).dialog('open');
            	      }
            	      tag.dialog({ dialogClass: "noclose" });
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	      
            	    }
            	});
            }

			function showOutstandings(_url, params, options){
            	options = options || {};
            	var tag = $("#dialog-form"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: _url[0] +'?'+params,
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
            	        	Cancel: function() {
            	            $( this ).dialog( "close" );
            	          	}
            	        }, title: options.title, width:700, height: 500, draggable: true }).dialog('open');
            	      }

            	      tag.dialog({ dialogClass: "noclose" });
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	    }
            	});
            }

			function afterAjax(){
				if(document.getElementById('after_ajax').value == 'Y'){
					document.getElementById('after_ajax').value = 'N';
					var sid = document.getElementById('student_id').value;
					var val = document.getElementById('selected_batch').value;
				    get('<?php echo base_url().$model.'/get_fee_pending';?>', 'student_id='+sid+'&batch_id='+val, 'pending_fee_div',false, '');
				}
			}
			
			function update_subjects(){
            	
				subForm.submit();
			}
			
			function btn_update(){
				
				$('#collapse_2_2').collapse('toggle');
			}

			function getTermReport(val){
				document.getElementById('after_ajax').value = 'N';
                var sid = document.getElementById('student_id').value;
                get('<?php echo base_url().$model.'/get_student_term_marks';?>', 'student_id='+sid+'&term_id='+val, 'assesment_detail_div',false, '');
			}

			function print_report(num){
				var term   = document.getElementById('term').value;
				window.open( '<?php echo base_url();?>term_report/print_view/?admission_number='+num+'&t='+term,'_blank');
			}
			
	        function get_fee_detail(val){
            	document.getElementById('after_ajax').value = 'Y';
                var sid = document.getElementById('student_id').value;
                get('<?php echo base_url().$model.'/get_fee_paid';?>', 'student_id='+sid+'&batch_id='+val, 'paid_fee_div',false, '');
            }
            
			function close_payment(id){
                if(confirm('Are you sure to remove this transaction?')){
                	options = {error: function() { alert('Could not load form')} };
                	var tag = $("#paid_fee_div"); //This tag will hold the dialog content.
                	$.ajax({
                	    url: "<?php echo base_url().$model.'/close_payment/';?>"+id,
                	    type: (options.type || 'POST'),
                	    data: {
    	                    student_id: $('#student_id').val(),
    	                    batch_id: $('#batch_id').val()
    	                },
                	    beforeSend: options.beforeSend,
                	    complete: options.complete,
                	    success: function(data, textStatus, jqXHR) {
                	      if(typeof data == "object" && data.html) { //response is assumed to be JSON
                	        tag.html(data.html);
                	      } else { //response is assumed to be HTML
                	        tag.html(data);
                	      }                	      
                	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
                	    }
                	});	
                }
            }
			
            function cheque_return(id){
                if(confirm('Are you sure to return this cheque?')){
					
                }
            }
			get_fee_detail('<?php echo $form->batch_id;?>');
			</script>
			<?php //echo $time_elapsed_secs = microtime(true) - $start;?>
		