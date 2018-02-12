<?php  if(isset($previous_data[0])) $pre_data = $previous_data[0]; else $pre_data = null; ?>
<div class="portlet box default">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Monthly Fee Detail');?></div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php $form1 = ( isset($form[0]) ) ? $form[0] : null;
			echo form_open('test_students/add_payment',array('id'=>'addPaymentForm', 'class'=>"form-horizontal")); $today    = date('Y-m-d'); ?>
			<input type="hidden" id="student_id" name="student_id" value='<?php echo $student_id;?>'  />
			<div class="form-body" style="height: 350px;">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Student ID').'/'.Base_Controller::ToggleLang('Name');?>:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" readonly="readonly" id="admission_number" value='<?php echo $form1->admission_number?>' placeholder="<?php echo Base_Controller::ToggleLang('Fee Description');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control" readonly="readonly" id="student_name" value='<?php echo $form1->student_name?>' placeholder="<?php echo Base_Controller::ToggleLang('Fee Description');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-1"></div>
					<!--/span-->
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Payment Date');?>:</label>
							<div class="col-md-4">
								<input type="text" class="form-control text-right" id="payment_date" name="payment_date" value='<?php echo date('d-m-Y');;?>'  />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
							<div class="col-md-4"></div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-2"></div>
					<!--/span-->
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Session');?>:</label>
							<div class="col-md-4">
								<select class="form-control" id="batch_id" name="batch_id" >
									<?php 
									if(isset($batch_list) && sizeof($batch_list)>0){
									foreach($batch_list as $batch){ 
									$batch_id = $batch->batch_id;
									?> 
										<option value="<?php echo $batch_id;?>" <?php if((isset($_POST['batch_id']) && $_POST['batch_id'] == $batch_id) || (isset($form1->batch_id) && $form1->batch_id == $batch_id) ) echo 'selected'; ?> ><?php echo $batch->batch_name;?></option>
									<?php }
									} ?>
								</select>
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
							<div class="col-md-4">
								<select name="month" class="form-control" <?php if($super_admin == 'N') echo 'disabled'?> id="month" data-placeholder="Choose a fee term" tabindex="1" onchange="onchangeMonth(this.value)">
									<?php 
									$arr_m = array('--','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
									for($m = 1; $m <= 12; $m++){
										$selected = ($m == $form1->month) ? 'selected' : '';
										echo '<option value="'.$m.'"  '.$selected.' > '.$arr_m[$m].' </option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-2"></div>
					<!--/span-->
				</div>
			<div id="subjects_div">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Subjects');?>:</label>
							<div class="col-md-8">
								<?php   $sub_str = ''; $subjects_id = '';
									if(isset($subjects)){
										foreach($subjects as $ss){ $subject_count++;
											$sub_str .= ', '.$ss->subject_name;
											$subjects_id .= ','.$ss->subject_id;
										}
									}
									$total_due = $pending_amount->due_total;
									$total_pending = $total_due - $pending_amount->total_payment - $pending_amount->total_discount;
									
								?>
								<input type="hidden" id="subjects_id" name="subjects_id" value="<?php echo substr($subjects_id, 1, strlen($subjects_id));?>"/>
								<input type="text" class="form-control" readonly="readonly" id="subject_name" 
									   value='<?php echo substr($sub_str, 1, strlen($sub_str));?>' placeholder="<?php echo Base_Controller::ToggleLang('No Subject');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-1"></div>
					<!--/span-->
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Due & Receive Amount');?>:</label>
							<div class="col-md-4">
								<input type="text" class="form-control text-right" readonly="readonly" id="total_pending" name="total_pending" value='<?php echo number_format($total_pending,2);?>' placeholder="" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control text-right" id="payment_amount" name="payment_amount" value='' placeholder="" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-2"></div>
					<!--/span-->
				</div>
			</div>	
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Fee Type / Receipt #');?>:</label>
							<div class="col-md-4">
								<select class="form-control" id="fee_desc" name="fee_desc" >
									<option value="Tuition Fee"> Tuition Fee </option>
									<option value="Fund Fee"> Fund Fee </option>
								</select>
								
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control text-center" id="receipt_number" name="receipt_number" value='' placeholder="00000" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-2"></div>
					<!--/span-->
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<table width="100%">
							<tbody>
								<tr>
									<td colspan="4"><?php echo Base_Controller::ToggleLang('Remarks');?><br/> 
										<textarea name="remarks" id="remarks" class="form-control col-md-6" rows="1" cols="25" placeholder="Please enter remarks about this payment (if any)."></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-1"></div>
				</div>
				
			<?php echo form_close();?>
			<!-- END FORM-->                
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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
	
	function onchangeMonth(id){
		options = {error: function() { alert('Could not load form')} };
		var tag = $("#subjects_div"); //This tag will hold the dialog content.
		$.ajax({
			url: "<?php echo base_url().$model.'/get_subjects_fee/';?>"+id,
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
</script>							