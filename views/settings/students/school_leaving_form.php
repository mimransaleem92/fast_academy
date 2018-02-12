<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
<style>
 .datemask { }
</style>
<script type="text/javascript">
<!--
//-->
</script>
<div class="tabbable tabbable-custom boxless">
				
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('School Leaving Form');?></div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<?php 
						$form = $form[0]; 
						echo form_open('students/payment_receive',array('id'=>'mainForm', 'class'=>"form-horizontal")); 
						echo form_hidden("student_id", $form->student_id);					
					?>
						<input type="hidden" name="second_source" id="second_source_hidden" value="N">
						<div class="form-body">
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								<div id="error1">No pending dues available for collection.</div>
							</div>
							<div class="alert alert-warning display-hide">
								<button class="close" data-close="alert"></button>
								Allowed discount amount is upto 10% of Payment amount. If payment is full then upto 15%!
							</div>
							<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Student Details');?></h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Admission #');?>:</label>
										<div class="col-md-3">
											<input type="text" readonly="readonly" class="form-control" id="admission_number" name="admission_number" value='<?php echo $form->admission_number;?>' placeholder="<?php echo Base_Controller::ToggleLang('Admission No');?>">
										</div>
										<div class="col-md-3">
											<input type="text" readonly="readonly" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" style='text-align: center;' id="leaving_date" name="leaving_date" value='<?php echo date('d-m-Y');?>' placeholder="<?php echo Base_Controller::ToggleLang('Leaving Date', 'ar');?>">
										</div>
										<label class="control-label arabic col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Admission #', 'ar').' / '.Base_Controller::ToggleLang('Leaving Date', 'ar');?></label>
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Student Name');?>:</label>
										<div class="col-md-3">
											<input type="text" class="form-control" id="student_name" name="student_name" value='<?php echo $form->student_name;?>' placeholder="<?php echo Base_Controller::ToggleLang('Student Name');?>">
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" style='font-family: "DroidKufi Regular", Tahoma; text-align: right;' id="student_name_ar" name="student_name_ar" value='<?php echo $form->student_name_ar;?>' placeholder="<?php echo Base_Controller::ToggleLang('Student Name', 'ar');?>">
										</div>
										<label class="control-label arabic col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Student Name', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Grade').' / '.Base_Controller::ToggleLang('Section');?>:</label>
										<div class="col-md-4">
											<select name="course_id" class="form-control" id="course_id" data-placeholder="Choose a Course" tabindex="1" onchange="onchange_courses(this)">
							                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
							                    <?php foreach($courses_list as $course){ 
							                    	$course_id = $course->course_id; 
							                    	if($course_id > 15) continue;
							                    	?> 
							                    	<option value="<?php echo $course_id;?>" <?php if($course_id ==  $form->course_id) echo 'selected'; ?> ><?php echo $course->course_name;?></option>
							                    <?php } ?>
											</select>
										</div>
										<div class="col-md-2">
											<select name="section" class="form-control" id="section" data-placeholder="Choose a section" tabindex="1" >
							                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
							                    <option value="A" <?php if($form->section == 'A') echo 'selected';?>> A </option>
							                    <option value="B" <?php if($form->section == 'B') echo 'selected';?>> B </option>
							                    <option value="C" <?php if($form->section == 'C') echo 'selected';?>> C </option>
							                    <option value="D" <?php if($form->section == 'D') echo 'selected';?>> D </option>
							                    <option value="E" <?php if($form->section == 'E') echo 'selected';?>> E </option>
							                    <option value="F" <?php if($form->section == 'F') echo 'selected';?>> F </option>
							                    <option value="G" <?php if($form->section == 'G') echo 'selected';?>> G </option>
							                    <option value="H" <?php if($form->section == 'H') echo 'selected';?>> H </option>
							                    <option value="I" <?php if($form->section == 'I') echo 'selected';?>> I </option>
											</select>	
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Grade', 'ar').' / '.Base_Controller::ToggleLang('Section', 'ar');?></label>
									</div>
								</div>
							</div>
							<!--/row-->
							<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Required Documents');?></h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Reason of Leaving');?></label>
										<div class="col-md-6" >
											<div class="radio-list">
												<label onclick="onclick_reason(1)"><input type="radio" name="reason" id="reason1" checked="checked">Transferring</label>
												<label onclick="onclick_reason(2)"><input type="radio" name="reason" id="reason2" >Leaving the Country (Exit)</label>
											</div>
											<br>
										</div>
									</div>
								</div>			
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Check List');?></label>
										<div class="col-md-6" >			
											<!-- Students Transferring Policy
												Acceptance letter from other school
												Financial Clearance letter from Accounting Office
												Clearance Letter from Admin
											
											Student's Leaving Policy (for exit)
												Request letter from parents
												Exit Visa from the parents
												Financial Clearance letter from Accounting Office
												Clearance letter for Admin -->
											<span id="span_transfer">
												<label><input type="checkbox" name="option1" id="option1">
												Acceptance letter from other school</label><br>
												<label><input type="checkbox" name="option2" id="option2">
												Financial Clearance letter from Accounting Office</label><br>
												<label><input type="checkbox" name="option3" id="option3">
												Clearance Letter from Admin</label><br>
											</span>
											<span id="span_exit" style="display: none">
												<label><input type="checkbox" name="option4" id="option4">
												Request letter from parents</label><br>
												<label><input type="checkbox" name="option5" id="option5">
												Exit Visa from the parents</label><br>
												<label><input type="checkbox" name="option6" id="option6">
												Financial Clearance letter from Accounting Office</label><br>
												<label><input type="checkbox" name="option7" id="option7">
												Clearance Letter from Admin</label><br>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Comments');?>:</label>
								<div class="col-md-6">
									<textarea class="form-control" id="comments" name="comments" rows="2" cols="20"></textarea>
									<!-- <span class="help-block">This is inline help</span> -->
								</div>
							</div>
							<div class="form-actions fluid">
								<div class="row">
									<div class="col-md-6">
										<div class="col-md-offset-3 col-md-9">
											<button type="button" class="btn green" onclick="submitForm()" >  <?php echo Base_Controller::ToggleLang('Save');?> </button>
											<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model.'/student_profile/'.$form->student_id;?>#tabs_3', '_self')" ><?php echo Base_Controller::ToggleLang('Cancel');?></button>                              
										</div>
									</div>
									<div class="col-md-6"></div>
								</div>
							</div>
						<?php echo form_close();?>
					<!-- END FORM-->                
				</div>
			</div>
	</div>
</div>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>	
		<script> 
			jQuery(document).ready(function() {    
			   // initiate layout and plugins
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

			var form1 = $('#mainForm');
			var error1 = $('.alert-danger', form1);
			var error2 = $('.alert-warning', form1);
			
			function onclick_reason(val){
				if(val == '1'){
					document.getElementById('span_transfer').style.display = 'block';
					document.getElementById('span_exit').style.display = 'none';
				}else if(val == '2'){
					document.getElementById('span_transfer').style.display = 'none';
					document.getElementById('span_exit').style.display = 'block';
				}

				for(a=1;a<=7;a++){
					if(val == '1' && a > 3){
						document.getElementById('option'+a).checked = false;
						$('input#option'+a).closest('span').removeClass('checked');
					}
					if(val == '2' && a <= 3){
						document.getElementById('option'+a).checked = false;
						$('input#option'+a).closest('span').removeClass('checked');
					}
					
				}
			}
				
		    function submitForm(){
	        	if((payment_mode == 'Span' ||  payment_mode == 'VISA' || payment_mode == 'Credit Card' || payment_mode == 'Master Card' || payment_mode == 'American Express') && (card_trans == '' || auth_code == '')){
					$('#payment_amount').closest('.form-group').removeClass('has-error');
					if(card_trans == '') {
						$('#card_transaction_no').closest('.form-group').addClass('has-error');
						return false;
					}
					else {
						$('#auth_code').closest('.form-group').addClass('has-error');
						return false;
					}
				}
				else if(discount_amt > allowed_discount){
					error2.show();
	        	 	App.scrollTo(error1, -200);
	        	 	$('#discount_amount').closest('.form-group').addClass('has-error');
				}
				else{
					error2.hide();
					document.getElementById('payment_amount').disabled = false;
		        	$('#discount_amount').closest('.form-group').removeClass('has-error');
					date_params = ['cheque_date', 'cheque_present_date', 'cheque_date1', 'present_date1', 'cheque_date'];
		        	change_date_format(date_params);
		        	document.getElementById('mainForm').submit();
				}
	        }
        </script> 
		