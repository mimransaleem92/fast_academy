<?php  if(isset($previous_data[0])) $pre_data = $previous_data[0]; else $pre_data = null; ?>
<div class="portlet box default">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Guarantee Cheque Detail');?></div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php $form1 = ( isset($form[0]) ) ? $form[0] : null;
			$due_amount1 = $due_amount2 = $due_amount3 = '';
			echo form_open('students/add_guarantee_cheque',array('id'=>'guaranteeChequeForm', 'class'=>"form-horizontal")); $today    = date('Y-m-d'); ?>
			<input type="hidden" id="student_id" name="student_id" value='<?php echo $student_id;?>'  />
			<input type="hidden" id="batch_id" name="batch_id" value='<?php echo $form1->batch_id;?>'  />
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
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Chq Amount / Number');?>:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" autocomplete="off" style="text-align: right;" id="cheque_amount" name="cheque_amount" value='' placeholder="<?php echo Base_Controller::ToggleLang('0.00');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" autocomplete="off" id="card_number" name="card_number" value='' placeholder="<?php echo Base_Controller::ToggleLang('00000');?>" />
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
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Cheque / Present Date');?>:</label>
							<div class="col-md-4">
								<input type="text" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" readonly="readonly" id="cheque_date" name="cheque_date" value='' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" readonly="readonly" id="cheque_present_date" name="cheque_present_date" value='' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>" />
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