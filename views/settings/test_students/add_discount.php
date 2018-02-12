<?php  if(isset($previous_data[0])) $pre_data = $previous_data[0]; else $pre_data = null; ?>
<div class="portlet box default">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Discount Detail');?></div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php $form1 = ( isset($form[0]) ) ? $form[0] : null;
			$due_amount1 = $due_amount2 = $due_amount3 = '';
			echo form_open('students/add_guarantee_cheque',array('id'=>'addDiscountForm', 'class'=>"form-horizontal")); $today    = date('Y-m-d'); ?>
			<input type="hidden" id="student_id" name="student_id" value='<?php echo $student_id;?>'  />
			<div class="form-body" style="height: 320px;">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Student #');?>:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" readonly="readonly" id="admission_number" value='<?php echo $form1->admission_number?>' placeholder="<?php echo Base_Controller::ToggleLang('Fee Description');?>" />
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
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Student Name');?>:</label>
							<div class="col-md-8">
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
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Session');?>:</label>
							<div class="col-md-8">
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
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Discount Amount');?>:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="discount_amount" name="discount_amount" value='0' placeholder="" />
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
										<textarea name="remarks" id="remarks" class="form-control col-md-6" rows="2" cols="25" placeholder="Please enter remarks about this cheque (if any)."></textarea>
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
</script>							