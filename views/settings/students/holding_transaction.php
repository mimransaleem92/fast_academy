<?php  if(isset($previous_data[0])) $pre_data = $previous_data[0]; else $pre_data = null; ?>
<div class="portlet box default">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Transaction Detail');?></div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php $form1 = ( isset($form[0]) ) ? $form[0] : null;
			$due_amount1 = $due_amount2 = $due_amount3 = '';
			echo form_open('students/holding_trans',array('id'=>'holdingTransForm', 'class'=>"form-horizontal")); $today    = date('Y-m-d'); ?>
			<input type="hidden" id="id" name="id" value='<?php echo $payment_id;?>'  />
			
			<div class="form-body" style="height: 300px;">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Student #');?>:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" readonly="readonly" id="admission_number" value='<?php echo $form1->admission_number?>' placeholder="<?php echo Base_Controller::ToggleLang('Fee Description');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-2"></div>
					<!--/span-->
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Student Name');?>:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" readonly="readonly" id="student_name" value='<?php echo $form1->student_name?>' placeholder="<?php echo Base_Controller::ToggleLang('Fee Description');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-2"></div>
					<!--/span-->
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<table width="100%">
							<thead>
								<tr>
									<th class="col-md-3"></th>
									<th class="col-md-3"></th>
									<th class="col-md-4"></th>
									<th class="col-md-2"></th>
								</tr>
							</thead>
							<tbody>
								<?php $form = ( isset($values[0]) ) ? $values[0] : null;  
								?>
								<tr>
									<td><?php echo Util::displayFormat($form->payment_date);?></td>
									<td><?php echo $form->fee_desc;?></td>
									<td><?php echo $form->payment_mode;?></td>
									<td style="text-align: right;" ><?php echo $form->payment_amount;?></td>
								</tr>
								
								<tr>
									<td colspan="4"><hr></td>
								</tr>
								<tr>
									 
									<td colspan="4"><?php echo Base_Controller::ToggleLang('Reason');?><br/> 
										<textarea name="holding_comments" id="holding_comments" class="form-control col-md-6" rows="2" cols="25" placeholder="Please enter reason of holding this transaction."></textarea>
									</td>
									
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-2"></div>
				</div>
				<input type="hidden" id="fee_desc" name="fee_desc" value='<?php echo $form->fee_desc;?>' />
				<input type="hidden" id="student_id" name="student_id" value='<?php echo $form->student_id;?>' />	
			<?php echo form_close();?>
			<!-- END FORM-->                
		</div>
	</div>
</div>				