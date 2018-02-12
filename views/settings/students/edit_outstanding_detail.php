<?php  if(isset($previous_data[0])) $pre_data = $previous_data[0]; else $pre_data = null; ?>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Arrears Detail');?></div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php $form = (isset($outstanding[0])) ? $outstanding[0] : null; 
			
			$due_amount1 = $due_amount2 = $due_amount3 = '';
			if(isset($outstanding[0])){
				$due_amount1 = $outstanding[0]->due_amount;
			}
			if(isset($outstanding[1])){
				$due_amount2 = $outstanding[1]->due_amount;
			}
			if(isset($outstanding[2])){
				$due_amount3 = $outstanding[2]->due_amount;
			}
			
			echo form_open('students/edit_outstanding_detail',array('id'=>'outstandingDetailForm', 'class'=>"form-horizontal")); $today    = date('Y-m-d'); ?>
			<input type="hidden" id="id" name="id" value='<?php echo $form->id;?>'  />
			<input type="hidden" id="student_id" name="student_id" value='<?php echo (isset($_GET['student_id'])) ? $_GET['student_id'] : $_POST['student_id'];?>'  />
			<input type="hidden" id="batch_id" name="batch_id" value='<?php echo (isset($_GET['batch_id'])) ? $_GET['batch_id'] : $_POST['batch_id'];?>'  />
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
								if($div_id == 2){
									$session = array();
									foreach ($batch_list as $val){
										$session[$val->batch_id] = $val->batch_name;
									}
								?>
								<tr>
									<td><?php echo Base_Controller::ToggleLang('1');?>.</td>
									<td><?php echo Base_Controller::ToggleLang('Tuition Fee');?></td>
									<td><?php echo $session[$batch_id -1];?></td>
									<td><input type="text" class="form-control" style="text-align: right;" name="due_amount1" id="due_amount1" value='<?php echo $due_amount1;?>' placeholder="0.00" /></td>
								</tr>
								<tr>
									<td><?php echo Base_Controller::ToggleLang('2');?>.</td>
									<td><?php echo Base_Controller::ToggleLang('Tuition Fee');?></td>
									<td><?php echo $session[$batch_id -2];?></td>
									<td><input type="text" class="form-control" style="text-align: right;" name="due_amount2" id="due_amount2" value='<?php echo $due_amount2;?>' placeholder="0.00" /></td>
								</tr>
								<tr>
									<td><?php echo Base_Controller::ToggleLang('3');?>.</td>
									<td><?php echo Base_Controller::ToggleLang('Tuition Fee');?></td>
									<td><?php echo $session[$batch_id -3];?></td>
									<td><input type="text" class="form-control col-md-4" style="text-align: right;" name="due_amount3" id="due_amount3" value='<?php echo $due_amount3;?>' placeholder="0.00" /></td>
								</tr>
								<?php }else {?>
								<tr>
									<td><?php echo Base_Controller::ToggleLang('1');?>.</td>
									<td colspan="2"><?php echo Base_Controller::ToggleLang('Tuition Fee');?></td>
									<td><input type="text" class="form-control" style="text-align: right;" name="due_amount1" id="due_amount1" value='<?php echo $due_amount1;?>' placeholder="0.00" /></td>
								</tr>
								<tr>
									<td><?php echo Base_Controller::ToggleLang('2');?>.</td>
									<td colspan="2"><?php echo Base_Controller::ToggleLang('Transportation Fee');?></td>
									<td><input type="text" class="form-control" style="text-align: right;" name="due_amount2" id="due_amount2" value='<?php echo $due_amount2;?>' placeholder="0.00" /></td>
								</tr>
								<tr>
									<td><?php echo Base_Controller::ToggleLang('3');?>.</td>
									<td colspan="2"><?php echo Base_Controller::ToggleLang('Education Plus Fee');?></td>
									<td><input type="text" class="form-control col-md-4" style="text-align: right;" name="due_amount3" id="due_amount3" value='<?php echo $due_amount3;?>' placeholder="0.00" /></td>
								</tr>
								<?php }?>
								
							</tbody>
						</table>
					</div>
					<div class="col-md-2"></div>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8 required">
						<br/>NOTE: Please enter data carefully after you save it, you can not modify it. 
					</div>
					<div class="col-md-2"></div>
				</div>
				<!-- <div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Fee Description');?>:</label>
							<div class="col-md-8">
								<select id="fee_desc" name="fee_desc" class="form-control" id="fee_desc" tabindex="1" >
				                    <option value="Tuition Fee" selected > Tuition Fee </option>
				                    <option value="Education Plus Fee" > Education Plus Fee </option>
				                    <option value="Transportation Fee" > Transportation Fee </option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-2"></div> 
				</div> 
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Amount');?>:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" style="text-align: right;" name="due_amount" id="due_amount" value='<?php echo $form->due_total;?>' placeholder="<?php echo Base_Controller::ToggleLang('Amount');?>" />
								
							</div>
						</div>
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