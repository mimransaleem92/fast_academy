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
					<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Payment Detail');?></div>
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
						<div class="form-body">
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								No pending dues available for collection.
							</div>
							<div class="alert alert-warning display-hide">
								<button class="close" data-close="alert"></button>
								Allowed discount amount is upto 10% of Payment amount!
							</div>
							<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Student Details');?></h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Admission No');?>:</label>
										<div class="col-md-8">
											<input type="text" class="form-control" readonly="readonly" id="admission_number" name="admission_number" value='<?php echo $form->admission_number;?>' placeholder="<?php echo Base_Controller::ToggleLang('Admission No');?>">
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Admission Date');?>:</label>
										<div class="col-md-8">
											<input type="text"  readonly="readonly" class="form-control form-control-inline"  data-date-format="dd-mm-yyyy" size="16" id="admission_date" name="admission_date" value='<?php echo Util::dateDisplayFormate( $form->admission_date);?>' />
											<!-- <span class="help-block">This field has error.</span> -->
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Course').' / '. Base_Controller::ToggleLang('Section');?>:</label>
										<div class="col-md-5">
											<select name="course_id" class="form-control" disabled="disabled" id="course_id" data-placeholder="Choose a Course" tabindex="1" > <!-- onchange="onchange_courses(this.value)"> -->
							                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
							                    <?php foreach($courses_list as $course){ 
							                    	$course_id = $course->course_id;
							                    	?> 
							                    	<option value="<?php echo $course_id;?>" <?php if($course_id ==  $form->course_id) echo 'selected'; ?> ><?php echo $course->course_name;?></option>
							                    <?php } ?>
											</select>
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
										<div class="col-md-3">
											<select name="section" class="form-control" disabled="disabled" id="section" data-placeholder="Choose a section" tabindex="1" >
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
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Session');?>:</label>
										<div class="col-md-8" id="td_batch">
											<select id="batch_id" name="batch_id" class="form-control" readonly="readonly" data-placeholder="Choose a Session" tabindex="1">
												<option value="">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
												<?php 
													if(isset($batch_list) && sizeof($batch_list)>0){
													foreach($batch_list as $batch){ 
													$batch_id = $batch->batch_id;
													?> 
														<option value="<?php echo $batch_id;?>" <?php if($batch_id ==  $form->batch_id) echo 'selected'; ?> ><?php echo $batch->batch_name;?></option>
													<?php }
													} ?>
											</select>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Student Name');?>:</label>
										<div class="col-md-8">
											<input type="text" class="form-control" readonly="readonly" id="first_name" name="first_name" value='<?php echo $form->student_name;?>' />
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4" title="Fee Outstanding"><?php echo Base_Controller::ToggleLang('Arrears');?>:</label>
										<div class="col-md-8">
											<?php $ariars = 0; $title_ariars = '';
				                          	if(isset($outstanding) && sizeof($outstanding) > 0){ 
				                          		$due_amount = 0; $paid_fee = 0; $discount_amount = 0;
				                          		foreach ($outstanding as $row){
				                          			$title_ariars .= $row->fee_desc . ": " . $row->due_amount ." & ";
				                          			$paid_fee += $row->payment_amount;
				                          			$due_amount += $row->due_amount;
				                          			$discount_amount += $row->discount_amount;
				                          		}
				                          		$ariars = $due_amount - $paid_fee - $discount_amount;
				                          		if($title_ariars != '') $title_ariars = substr($title_ariars, 0, strlen($title_ariars)-2);
				                          		$title_ariars .= $paid_fee; 
				                          	} ?>
					                       	<input type="text" class="form-control popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="<?php echo $title_ariars;?>" data-original-title="Arrear detail" readonly="readonly" id="arrear_amount" value='<?php echo number_format($ariars , 2, '.', '');?>' />							
										</div>
										
									</div>	
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Fee Details');?></h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group" >
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Due Fee');?>:</label>
										<div class="col-md-6" >
											<?php $due_fee = 0; $title = ''; $cheque = ''; $cheque_date = ''; $cheque_amount = 0.00;
												$total_payment = 0; $total_discount = 0;
												$due_total = 0; $num = 0;
											//$title = ($ariars > 0) ? 'Arrears: ' . $ariars . ' and ' : '';
											/*  Tuition Fee" selected > Tuition Fee </option>
							                    <option value="Education Plus Fee" > Education Plus Fee </option>
							                    <option value="Transportation Fee*/
				                          	if(isset($pending_fee_list) && sizeof($pending_fee_list) > 0){  
				                          		foreach($pending_fee_list as $values){
				                          			if( in_array($values->fee_desc, array('Tuition Fee', 'Education Plus Fee', 'Transportation Fee', 'Payment'))){
				                          				if($values->fee_desc != 'Payment')
				                          				$title .= $values->fee_desc . ": " . $values->due_total." & ";
				                          			
					                          			$due_fee += ($values->due_total - $values->total_payment - $values->total_discount);
					                          			$total_payment += $values->total_payment;
					                          			$total_discount += $values->total_discount;
					                          			$due_total += $values->due_total ;
				                          			}
				                          			if($values->fee_desc == 'Tuition Fee'){
				                          				$num = $values->fee_count-1;
				                          				//-get cheque values if 1st term pay 25% with 3 cheques : for DIS 
				                          				//-get cheque values if 1st term pay 50% with 1 cheques : for DNS
				                          				if($num == 1){
						                          			$cheque = $values->garantee_cheque1;
						                          			$cheque_date = $values->cheque_date1 ;
						                          			$cheque_amount = $values->cheque_amount1;
				                          				}elseif($num == 2){
						                          			$cheque = $values->garantee_cheque2;
						                          			$cheque_date = $values->cheque_date2 ;
						                          			$cheque_amount = $values->cheque_amount2;
				                          				}elseif($num == 3){
						                          			$cheque = $values->garantee_cheque3;
						                          			$cheque_date = $values->cheque_date3 ;
						                          			$cheque_amount = $values->cheque_amount3;
				                          				}
				                          				//-get cheque values if 1st term pay 50% with no cheques 3rd term remaining 50% ( 50% + 50% 1 cheque) : for DIS -- See out of this loop
				                          			}
												}
												//$title .= " Paid Amount: ".$total_payment." and Balance: ".$due_fee;
												//if($title != '') $title = substr($title, 0, strlen($title)-2);
												$title .= " Paid Amount: ".$total_payment." and Discount:".$total_discount." and Balance: ".$due_fee;
												//--get cheque values if 1st term pay 50% with no cheques 3rd term remaining 50% ( 50% + 50% 1 cheque) : for DIS
												if(isset($last_payment[0])){
													$values = $last_payment[0];
													if($num == 1){
					                          			$cheque = $values->garantee_cheque1;
					                          			$cheque_date = $values->cheque_date1 ;
					                          			$cheque_amount = $values->cheque_amount1;
			                          				}elseif($num == 2){
					                          			$cheque = $values->garantee_cheque2;
					                          			$cheque_date = $values->cheque_date2 ;
					                          			$cheque_amount = $values->cheque_amount2;
			                          				}elseif($num == 3){
					                          			$cheque = $values->garantee_cheque3;
					                          			$cheque_date = $values->cheque_date3 ;
					                          			$cheque_amount = $values->cheque_amount3;
			                          				}
												}
												//echo $num;
												?>
				                          		<input type="text" readonly="readonly" class="form-control popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="<?php echo $title;?>" data-original-title="Fee detail" id=due_fee value='<?php echo number_format($due_fee, 2, '.', '');?>' />
				                          		<?php 
					                       	} ?>							
										</div>
									</div>	
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Payment Date');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="payment_date" name="payment_date" value='<?php echo date('d-m-Y');?>' />
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<?php $student_division = substr($form->admission_number, 0, 3);?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Fee Term');?>:</label>
										<div class="col-md-6">
											<select name="fee_term" class="form-control" id="fee_term" data-placeholder="Choose a fee term" tabindex="1" >
							                    <option value="0" disabled="disabled" selected > Full Paid </option>
							                    <?php $ratio = (($total_payment + $total_discount) / $due_total)  * 100 ; // remaining due amount ratio 
							                    	// value of fee term is made by concate first digit from the division of the student like DIS or DNS
							                    	if( $student_division == 'DIS' ){ ?>
							                    <option value="20" <?php if($ariars > 0) echo 'selected'; else echo 'disabled="disabled"';?> > Arrears </option>	
							                    <option value="21" <?php if($ariars == 0 && $due_fee > 0 && $ratio < 25) echo 'selected'; else echo 'disabled="disabled"';?>> 1st Term </option>
							                    <option value="22" <?php if($ariars == 0 && $due_fee > 0 && $ratio >= 25 && $ratio < 50) echo 'selected'; else echo 'disabled="disabled"';?>> 2nd Term </option>
							                    <option value="23" <?php if($ariars == 0 && $due_fee > 0 && $ratio >= 50 && $ratio < 75) echo 'selected'; else echo 'disabled="disabled"';?>> 3rd Term </option>
							                    <option value="24" <?php if($ariars == 0 && $due_fee > 0 && $ratio >= 75 && $ratio < 100) echo 'selected'; else echo 'disabled="disabled"';?>> 4th Term </option>
							                    <?php } else {?>
							                    <option value="10" <?php if($ariars > 0) echo 'selected'; else echo 'disabled="disabled"';?> > Arrears </option>
							                    <option value="11" <?php if($ariars == 0 && $due_fee > 0 && $ratio < 50) echo 'selected'; else echo 'disabled="disabled"';?>> 1st Term </option>
							                    <option value="12" <?php if($ariars == 0 && $due_fee > 0 && $ratio >= 50 && $ratio < 100) echo 'selected'; else echo 'disabled="disabled"';?>> 2nd Term </option>
							                    <?php }?>
											</select>
											<span class="help-block">
											<?php //echo 'ratio:'.$ratio.', ariars:'.$ariars.', due_fee:'.$due_fee;?></span>
										</div>
									</div>
								</div>
								<?php 
								$hide_payment_button = '';
								if( $student_division == 'DNS' ){
									// on 2nd term don't dispaly this row
									if($ariars > 0 || $due_fee == 0 || ($ariars == 0 && $due_fee > 0 && ($cheque !='' || $ratio >= 50) ) ){
										$hide_payment_button = 'display: none;';
									}
								}
								else {
									// on 2nd and 4th term don't dispaly this row
									if($ariars > 0 || $due_fee == 0 || ($ariars == 0 && $due_fee > 0 && ($cheque !='' || $ratio == 25 || $ratio >= 75))){
										$hide_payment_button = 'display: none;';
									}
								}	
								?>
								<div class="col-md-6">
									<div class="form-group" style="<?php echo $hide_payment_button;?>">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Payment');?>:</label>
										<div class="col-md-6">
											<div class="clearfix">
												<!-- <div class="btn-group btn-group-sm btn-group-solid" name="payment_amt" data-toggle="buttons">
													<label class="btn btn-default active" onclick="onclick_payment();" title="25% of due fee + arrears">
													<input type="radio" class="toggle" id="payment_amt25" checked> 25%
													</label>
													<label class="btn btn-default" onclick="onclick_payment();" data-off-label="1" title="25% of due fee + arrears">
													<input type="radio" class="toggle" id="payment_amt50"> 50%
													</label>
													<label class="btn btn-default" onclick="onclick_payment();" data-off-label="2" title="due fee + arrears">
													<input type="radio" class="toggle" id="payment_amt100"> Full
													</label>
												</div> -->
												
												<div class="radio-list" >
													<?php if($student_division == 'DIS' && $ratio <= 25) { ?>
													<label class="radio-inline" onclick="onclick_payment();" title="25% of due fee">
													<input type="radio" name="payment_amt" id="payment_amt25" value="25" <?php if($ariars == 0 && $ratio <= 25)  echo 'checked';?> > 25%
													</label>
													<?php }?>
													<label class="radio-inline" onclick="onclick_payment();" title="50% of due fee">
													<input type="radio" name="payment_amt" id="payment_amt50" value="50" 
														<?php if( $ariars == 0 ) { 
																	if( $student_division == 'DIS' && $ratio >= 25 && $ratio <= 50 ) 
																	{
																		echo 'checked';  
																	}
																	else if($student_division == 'DNS' && $ratio <= 50) 
																	{
																		echo 'checked'; 
																	}
															  }
														?> > 50%
													</label>
													<label class="radio-inline" onclick="onclick_payment();" title="due fee">
													<input type="radio" name="payment_amt" id="payment_amt100" value="100" 
														<?php if($ariars > 0 || $due_fee == 0 || $hide_payment_button != '' ||($ariars == 0 && $due_fee > 0 && $ratio > 50))  echo 'checked'; ?> > Full
													</label>
													<label class="radio-inline" onclick="onclick_payment();" title="due fee">
													<input type="radio" name="payment_amt" id="payment_amt999" value="999" > Manually
													</label> 
												</div> 
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Fee Type');?>:</label>
										<div class="col-md-6">
											<select name="fee_desc" class="form-control" id="fee_desc" data-placeholder="Choose a fee type" onchange="set_payment_amount(this);" tabindex="1" >
							                    <!--<option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>-->
							                    <!-- by default payment of these fee type will genrated -->
							                     <!-- array('1'=>'Tuition Fee', '2'=>'Education Plus Fee', '3'=>'Transportation Fee'); --> 
							                    <option value="1" selected > Tuition Fee </option>
							                    <?php  if($student_division == 'DNS'){?>
							                    <option value="2" > Education Plus Fee </option>
							                    <option value="3" > Transportation Fee </option>
							                    <?php }?>
							                    <!-- <option value="1" > Default </option> --> 
							                    <option value="Nursery Fee" > Nursery Fee </option>
							                    <option value="Copy Book Fee" > Copy Book Fee </option>
							                    <option value="Picnic Party Fee" > Picnic Party Fee </option>
							                    <option value="Photograph Fee" > Photograph Fee </option>
											</select>
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Payment Amount');?>:</label>
										<div class="col-md-6">
											<?php  $payment_amount = 0;
												if($ariars>0) {
													$payment_amount = $ariars; 
												}
												elseif($due_fee>0) 
												{ 
													$payment_amount = (($student_division == 'DIS') ? 0.25*($due_total) : 0.5*($due_total));
												}
												?>
											<input type="hidden" id="payment_amount_hidden" value='<?php echo $payment_amount;?>' />
											<input type="text" class="form-control" disabled="disabled" style="text-align: right; padding-right: 4px" id="payment_amount" name="payment_amount" value='<?php echo $payment_amount;?>' />
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row" >
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Discount');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="10% discount allowed on Payment amount." data-original-title="Info" style="text-align: right; padding-right: 4px" id="discount_amount" name="discount_amount" onkeyup="onkeyup_discount(this, event);" value="0" />
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('After Discount');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" readonly="readonly" style="text-align: right; padding-right: 4px" id="discounted_amount" name="discounted_amount" value="<?php echo $payment_amount;?>" />
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Payment Mode');?>:</label>
										<div class="col-md-6">
											<select name="payment_mode" class="form-control" id="payment_mode" onchange="onchange_mode(this.value);" data-placeholder="Choose a Payment Mode" tabindex="1" >
							                    <!--<option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>-->
							                    <?php if($form->enable_cash_payment == 'Y'){?>
							                    <option value="Cash"  > Cash </option>
							                    <?php }?>
							                    <option value="Cheque" selected > Cheque </option>
							                    <option value="Span" > Span </option>
							                    <option value="Credit Card" > Credit Card </option>
							                    <option value="Master Card" > Master Card </option>
							                    <option value="American Express" > American Express </option>
							                    <option value="Account // Bank Transfer" > Account / Bank Transfer </option>
							                    <option value="Employee Salary" > Employee Salary </option>
											</select>
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
										
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Card / Cheque No');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="card_number" name="card_number" value="<?php if($due_fee>0) echo $cheque;?>" />
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row" id="cheque_option_row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Cheque Amount');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" style="text-align: right; padding-right: 4px" id="cheque_amount" name="cheque_amount" value='<?php if($due_fee>0) echo $cheque_amount;?>' />
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Cheque Date');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="cheque_date" name="cheque_date" value='<?php if($due_fee>0) echo util::displayFormat($cheque_date);?>' />
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row" style="display:none" id="cc_option_row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Transaction No');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="card_transaction_no" name="card_transaction_no" value='' />
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Auth. Code');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="auth_code" name="auth_code" value='' />
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<?php 
								$display_row = ''; $first_row = '';
								if( $ariars > 0 || ($student_division == 'DNS')) 
								{
									$display_row = 'display:none'; 
								}
								else if( ($ariars == 0 && ($student_division == 'DIS') && $due_fee > 0 && $ratio >= 25) || $due_fee == 0) 
								{
									$display_row = 'display:none'; 
								}
								
								if(($student_division == 'DNS')){
									if($ariars > 0 || ($ariars == 0 && $due_fee > 0 && $ratio >= 50) || $due_fee == 0){
										$first_row = 'display:none';
									}
								}
								else { // $ariars == 0 && $ratio <= 50
									
									if($ariars > 0 || ($ariars == 0 && $due_fee > 0  && ($ratio == 25 || ($ratio == 50 && $cheque != '') || $ratio == 75) ) || $due_fee == 0){
										$first_row = 'display:none';
									}
								}
							?>
							<div class="row" id="garantee_row1" style="<?php echo $first_row;?>" >
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-2"><?php echo Base_Controller::ToggleLang('Guarantee Cheque 1');?>:</label>
										<div class="col-md-3">
											<input type="text" class="form-control" id="garantee_cheque1" name="garantee_cheque1" value="" placeholder="Cheque No"/>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" id="cheque_amount1" name="cheque_amount1" style="text-align: right" value="<?php if($ratio == 0 || $ratio == 50) echo $payment_amount;?>" placeholder="0.00"/>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="cheque_date1" name="cheque_date1" 
												   value="<?php if($student_division == 'DNS') { echo '05-02-'.date('Y'); } 
												   				elseif( $ratio == '50'){ echo '05-04-'.date('Y'); }
												   				else { echo '05-11-'.date('Y'); }?>" placeholder="D-M-Y"/>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="present_date1" name="present_date1" value="" placeholder="Present Date"/>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row" id="garantee_row2" style="<?php echo $display_row;?>">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-2"><?php echo Base_Controller::ToggleLang('Guarantee Cheque 2');?>:</label>
										<div class="col-md-3">
											<input type="text" class="form-control" id="garantee_cheque2" name="garantee_cheque2" value="" placeholder="Cheque No"/>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" id="cheque_amount2" name="cheque_amount2" style="text-align: right" value="<?php if($ratio == 0) echo $payment_amount;?>" placeholder="0.00" />
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="cheque_date2" name="cheque_date2" value="05-02-<?php echo date('Y')+1;?>" placeholder="D-M-Y"/>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="present_date2" name="present_date2" value="" placeholder="Present Date"/>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row" id="garantee_row3" style="<?php echo $display_row;?>">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-2"><?php echo Base_Controller::ToggleLang('Guarantee Cheque 3');?>:</label>
										<div class="col-md-3">
											<input type="text" class="form-control" id="garantee_cheque3" name="garantee_cheque3" value="" placeholder="Cheque No"/>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" id="cheque_amount3" name="cheque_amount3" value="<?php if($ratio == 0) echo $payment_amount;?>" style="text-align: right" placeholder="0.00" />
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="cheque_date3" name="cheque_date3" value="05-04-<?php echo date('Y')+1;?>" placeholder="D-M-Y"/>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="present_date3" name="present_date3" value="" placeholder="Present Date"/>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row">
								<label class="control-label col-md-2"><?php echo Base_Controller::ToggleLang('Comments');?>:</label>
								<div class="col-md-9">
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
			
	        function onchange_sibling(obj){
	        	document.getElementById('deduct_block').style.display = "none";
		        if(obj.checked){
		        	document.getElementById('sibling_amount').selectedIndex = 0;
		        	document.getElementById('deduct_block').style.display = "block";
		        }
	        }

	        function submitForm(){
	        	var arrears = document.getElementById('arrear_amount').value;
				var due_fee = document.getElementById('due_fee').value;
				
	        	if(document.getElementById('payment_amt25') && document.getElementById('payment_amt25').checked){
	        		
	        		if(document.getElementById('garantee_cheque1').value == '' || document.getElementById('cheque_amount1').value == '' || document.getElementById('cheque_date1').value == '' || document.getElementById('present_date1').value == ''){
	        			$('#garantee_cheque1').closest('.form-group').addClass('has-error');
		    	        return false;
	        		}
	        		else if(document.getElementById('garantee_cheque2').value == '' || document.getElementById('cheque_amount2').value == '' || document.getElementById('cheque_date2').value == '' || document.getElementById('present_date2').value == ''){
	        			$('#garantee_cheque1').closest('.form-group').removeClass('has-error');
	        			$('#garantee_cheque2').closest('.form-group').addClass('has-error');
		    	           return false;
	        		}
	        		else if(document.getElementById('garantee_cheque3').value == '' || document.getElementById('cheque_amount3').value == '' || document.getElementById('cheque_date3').value == '' || document.getElementById('present_date3').value == ''){
	        			$('#garantee_cheque1').closest('.form-group').removeClass('has-error');
	        			$('#garantee_cheque2').closest('.form-group').removeClass('has-error');
	        			$('#garantee_cheque3').closest('.form-group').addClass('has-error');
		    	        return false;
	        		}
	        		else
	        		{
	        			$('#garantee_cheque1').closest('.form-group').removeClass('has-error');
	        			$('#garantee_cheque2').closest('.form-group').removeClass('has-error');
	        			$('#garantee_cheque3').closest('.form-group').removeClass('has-error');
	        		}
	        		
	        	}
	        	else if(document.getElementById('payment_amt50').checked){
	        		document.getElementById('payment_amount').value = parseFloat(0.50*due_fee);
	        		<?php if(($student_division == 'DNS')){ ?>
	        		
		        		if(document.getElementById('garantee_cheque1').value == '' || document.getElementById('cheque_amount1').value == '' || document.getElementById('cheque_date1').value == '' || document.getElementById('present_date1').value == ''){
		        			$('#garantee_cheque1').closest('.form-group').addClass('has-error');
			    	    	return false;
		        		}
		        		else{
		        			$('#garantee_cheque1').closest('.form-group').removeClass('has-error');
		        		}
	        		
	        		<?php } 
	        		if(($student_division == 'DIS')){ ?>
	        		if(fee_term == '23'){
		        		if(document.getElementById('garantee_cheque1').value == '' || document.getElementById('cheque_amount1').value == '' || document.getElementById('cheque_date1').value == '' || document.getElementById('present_date1').value == ''){
		        			$('#garantee_cheque1').closest('.form-group').addClass('has-error');
			    	    	return false;
		        		}
		        		else{
		        			$('#garantee_cheque1').closest('.form-group').removeClass('has-error');
		        		}
	        		}
	        		<?php }?>
	        	}
	        	else if(document.getElementById('payment_amt100').checked){
	        		
	        	}
	        	var terms = document.getElementById('fee_term').value;
	        	var fee_desc = document.getElementById('fee_desc').value;
	        	var payment_amt = document.getElementById('payment_amount').value;
	        	var discount_amt = document.getElementById('discount_amount').value;
	        	var payment_mode = document.getElementById('payment_mode').value;
	        	var card_num = document.getElementById('card_number').value;
	        	var card_trans = document.getElementById('card_transaction_no').value;
	        	var auth_code = document.getElementById('auth_code').value;
	        	var allowed_discount = parseFloat(0.10*payment_amt);
	        	
	        	//alert('Clear Cheque row');
	        	if(terms == '0' && fee_desc == '1'){
	        		error1.show();
                    App.scrollTo(error1, -200);
	    	    	return false;
				}
				else if(payment_amt == '' || payment_amt <= 0){
					error1.hide();
					$('#payment_amount').closest('.form-group').addClass('has-error');
					
	    	    	return false;
				}
				else if(payment_mode == 'Cheque' && card_num == ''){
					$('#payment_amount').closest('.form-group').removeClass('has-error');
					$('#card_number').closest('.form-group').addClass('has-error');
					
	    	    	return false;
				}
				else if((payment_mode == 'Span' || payment_mode == 'Credit Card' || payment_mode == 'Master Card') && (card_trans == '' || auth_code == '')){
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
					date_params = ['cheque_date1', 'present_date1', 'cheque_date2', 'present_date2', 'cheque_date3', 'present_date3'];
		        	change_date_format(date_params);
		        	document.getElementById('mainForm').submit();
				}
	        }

	        function onclick_payment(){
	        	var fee_term = document.getElementById('fee_term').value;
				var arrears = document.getElementById('arrear_amount').value;
				var due_fee = document.getElementById('due_fee').value;
				var discount_amt = document.getElementById('discount_amount').value;
				if(arrears > 0){
					document.getElementById('payment_amount').value = arrears;
				}
				else if(document.getElementById('payment_amt25') && document.getElementById('payment_amt25').checked){
	        		document.getElementById('payment_amount').value = 0.25*due_fee;
	        		document.getElementById('garantee_row1').style.display = "block";
	        		document.getElementById('garantee_row2').style.display = "block";
	        		document.getElementById('garantee_row3').style.display = "block";
	        	}
	        	else if(document.getElementById('payment_amt50').checked){
	        		document.getElementById('payment_amount').value = parseFloat(0.50*due_fee);
	        		<?php if(($student_division == 'DNS')){ ?>
	        			document.getElementById('garantee_row1').style.display = "block";
	        		<?php }elseif($student_division == 'DIS') { ?>
							if(fee_term == '23'){
		        				document.getElementById('garantee_row1').style.display = "block";
							}
							else{
				        		document.getElementById('garantee_row1').style.display = "none";
		        			}
							document.getElementById('garantee_row2').style.display = "none";
	        				document.getElementById('garantee_row3').style.display = "none";
	        		<?php } ?>
	        	}
	        	else if(document.getElementById('payment_amt100').checked){
	        		document.getElementById('payment_amount').value = parseFloat(due_fee);
	        		document.getElementById('garantee_row1').style.display = "none";
	        		document.getElementById('garantee_row2').style.display = "none";
	        		document.getElementById('garantee_row3').style.display = "none";
	        	}
	        	else if(document.getElementById('payment_amt999').checked){
	        		document.getElementById('payment_amount').value = parseFloat(due_fee);
	        		document.getElementById('garantee_row1').style.display = "none";
	        		document.getElementById('garantee_row2').style.display = "none";
	        		document.getElementById('garantee_row3').style.display = "none";
	        		document.getElementById('payment_amount').disabled = false;
	        		document.getElementById('payment_amount').select();
	        	}
				document.getElementById('discounted_amount').value = parseFloat(document.getElementById('payment_amount').value) + parseFloat(discount_amt);
	        	document.getElementById('payment_amount').style.readonly = true;
	        }

	        function onkeyup_discount(obj, e){
	        	var payment_amount = parseFloat(document.getElementById('payment_amount').value);
	        	var amt = parseFloat(0.10*payment_amount)
		        if(obj.value <= amt){
		        	//alert(obj.value + " and "  + amt);
		        	error2.hide();
		        	$('#discount_amount').closest('.form-group').removeClass('has-error');
	        		document.getElementById('discounted_amount').value = payment_amount - parseFloat(obj.value);
		        }
		        else{
		        	error2.show();
	        	 	App.scrollTo(error1, -200);
	        	 	$('#discount_amount').closest('.form-group').addClass('has-error');
	        	 	//document.getElementById('discounted_amount').value = '0';
	        	 	return false;
		        }
	        	
	        }

	        function set_payment_amount(obj){
	        	var x = obj.value;
	        	if(x == '1'){
	        		var payment_hidden = document.getElementById('payment_amount_hidden').value;
	        		document.getElementById('payment_amount').value = payment_hidden;
					document.getElementById('payment_amount').disabled = true;
				}
				else{
					document.getElementById('payment_amount').disabled = false;
				}
	        }
	        
	        function onchange_mode(val){
	        	document.getElementById('cc_option_row').style.display = "none";
	        	document.getElementById('cheque_option_row').style.display = "block";
	        	if(val == 'Span' || val == 'Credit Card' || val == 'Master Card'){
	        		document.getElementById('cc_option_row').style.display = "block";
	        		document.getElementById('cheque_option_row').style.display = "none";
	        		document.getElementById('card_number').select();
	        		document.getElementById('card_number').focus();
	        	}
	        }
        </script> 
		