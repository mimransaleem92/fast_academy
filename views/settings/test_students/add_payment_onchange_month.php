				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Subjects');?>:</label>
							<div class="col-md-8">
								<input type="hidden" id="subjects_id" name="subjects_id" value="<?php echo $subjects_id;?>"/>
								<input type="text" class="form-control" readonly="readonly" id="subject_name" 
									   value='<?php echo $subject_name;?>' placeholder="<?php echo Base_Controller::ToggleLang('No Subject');?>" />
								
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
								<input type="text" class="form-control text-right" readonly="readonly" id="total_pending" name="total_pending" value='<?php echo number_format($pending_amount,2);?>' placeholder="" />
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