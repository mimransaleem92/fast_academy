<?php  if(isset($previous_data[0])) $pre_data = $previous_data[0]; else $pre_data = null; ?>
<div class="portlet box default">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Arrears Detail');?></div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php $form = (isset($outstanding[0])) ? $outstanding[0] : null; 
			$due_amount1 = $due_amount2 = $due_amount3 = '';
			echo form_open('students/outstanding_detail',array('id'=>'outstandingDetail', 'class'=>"form-horizontal")); $today    = date('Y-m-d'); ?>
			<input type="hidden" id="id" name="id" value='<?php echo $form->id;?>'  />
			<input type="hidden" id="student_id" name="student_id" value='<?php echo $_GET['student_id'];?>'  />
			<input type="hidden" id="batch_id" name="batch_id" value='<?php echo $_GET['batch_id'];?>'  />
			<div class="form-body" style="height: 300px;">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Student #');?>:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" readonly="readonly" id="admission_number" value='<?php echo $form->admission_number?>' placeholder="<?php echo Base_Controller::ToggleLang('Fee Description');?>" />
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
								<input type="text" class="form-control" readonly="readonly" id="student_name" value='<?php echo $form->student_name?>' placeholder="<?php echo Base_Controller::ToggleLang('Fee Description');?>" />
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
									<th class="col-md-1"></th>
									<th class="col-md-3"></th>
									<th class="col-md-2"></th>
									<th class="col-md-6"></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
								$total = 0;
								if($div_id == 2){
									$session = array();
									foreach ($batch_list as $val){
										$session[$val->batch_id] = $val->batch_name;
									}
									$i=0;
									foreach ($outstanding as $values){ $i++; 
										if ($values->due_amount > 0){
											$total += $values->due_amount;
								?>
								<tr>
									<td><?php echo Base_Controller::ToggleLang($i);?>.</td>
									<td><?php echo Base_Controller::ToggleLang('Tuition Fee');?></td>
									<td><?php echo $session[$values->batch_id];?></td>
									<td><input type="text" class="form-control" style="text-align: right;" id="due_amount<?php echo $i;?>" value='<?php echo $values->due_amount;?>' placeholder="0.00" /></td>
								</tr>
								<?php 	}
									}
								}else {
									$i=0;
									foreach ($outstanding as $values){ $i++;
									if ($values->due_amount > 0){
										$total += $values->due_amount;
									?>
								<tr>
									<td><?php echo Base_Controller::ToggleLang($i);?>.</td>
									<td colspan="2"><?php echo Base_Controller::ToggleLang($values->fee_desc);?></td>
									<td><input type="text" class="form-control" style="text-align: right;" id="due_amount<?php echo $i;?>" value='<?php echo $values->due_amount;?>' placeholder="0.00" /></td>
								</tr>
								<?php }
									}
								}?>
								<tr>
									<td colspan="4"><hr></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"><?php echo Base_Controller::ToggleLang('Total');?>: </td>
									<td style="text-align: right; padding-right: 15px;" > <?php echo number_format($total, 2, '.', '');?> </td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-2"></div>
				</div>
				<!-- <div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8 required">
						<br/>NOTE: Please enter data carefully after you save it, you can not modify it. 
					</div>
					<div class="col-md-2"></div>
				</div> -->
				<!--/row-->
				<?php if($not_popup){?>
				<div class="form-actions fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-offset-3 col-md-9">
								<button type="button" class="btn green" onclick="submitForm()" ><i class="fa fa-check"></i> <?php echo Base_Controller::ToggleLang('Submit');?></button>
								<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" ><?php echo Base_Controller::ToggleLang('Cancel');?></button>                              
							</div>
						</div>
						<div class="col-md-6"></div>
					</div>
				</div>
			<?php } echo form_close();?>
			<!-- END FORM-->                
		</div>
	</div>
</div>				