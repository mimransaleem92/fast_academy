<div class="col-md-12">
	<!-- On change this dropdown will show the fee of the selected session if any, but need to work -->
	<div class="row">
		<div class="col-md-4" >
			<div class="form-group">
				<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Session');?>:<span class="required">*</span></label>
				<div class="col-md-8 " id="td_batch">
					<select id="selected_batch" name="selected_batch" class="form-control" data-placeholder="Choose a Session" tabindex="1" onkeyup="get_fee_detail(this.value);" onchange="get_fee_detail(this.value);">
						<option value="">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
						<?php 
							if(isset($batch_list) && sizeof($batch_list)>0){
							foreach($batch_list as $batch){ 
							$batch_id = $batch->batch_id;
							?> 
								<option value="<?php echo $batch_id;?>" <?php if((isset($_POST['batch_id']) && $_POST['batch_id'] == $batch_id) || (isset($form->batch_id) && $form->batch_id == $batch_id) ) echo 'selected'; ?> ><?php echo $batch->batch_name;?></option>
							<?php }
							} ?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-8"></div>
	</div>
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Pending Fees');?></div>
			<div class="actions">
				<a href="javascript:;" class="collapse"></a>
				<?php
				if($form->cdel == '0'){	 
					$super_admin = $this->session->userdata(SESSION_CONST_PRE.'super_admin');
					if($super_admin == 'Y'){
						$discount_url   = base_url().$model."/add_discount";
						$param_discount = 'student_id='.$form->student_id;
				?>
				<a href="javascript:;" class="btn default btn-xs green" <?php echo 'onclick="showInnerBox( [\''. $discount_url .'\', \'_update\', \'addDiscountForm\', \'pending_fee_div\'], \''.$param_discount.'\', {error: function() { alert(\'Could not load form\')}, title: \'Add Discount\'})"'; ?>><i class="fa fa-plus"></i> Discount </a>
				<?php }?>
				<a class="btn green" href="<?php echo base_url().$model.'/payment/?student_id='.$form->student_id;?>"><i class="fa fa-cash"></i> Receive Payment </a>
				<?php } ?>
			</div>
		</div>
		<div class="portlet-body" id="pending_fee_div">
			<?php  
			//echo form_open('students/add_emergency_detail',array('id'=>'emergencyDetailForm')); $today    = date('Y-m-d');
			?>
			<div class="table-responsive">
				<input type="hidden" name="student_id" id="student_id" value="<?php // echo $form->student_id;?>" />
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th width="*"><?php echo Base_Controller::ToggleLang('Fee Description');?></th>
							<th width="150px"><?php echo Base_Controller::ToggleLang('Fee Amount');?></th>
							<th width="150px"><?php echo Base_Controller::ToggleLang('Paid');?></th>
							<th width="150px"><?php echo Base_Controller::ToggleLang('Discount');?></th>
							<th width="150px"><?php echo Base_Controller::ToggleLang('Balance');?></th>
							<th width="20px"></th>
						</tr>
					</thead>
					<tbody>
						<?php $pending_due = 0; $pending_payment = 0; $total_discount=0;
                          if(isset($outstanding) && sizeof($outstanding) > 0){ $outstanding = $outstanding[0];
                          		$url_edit   = base_url().$model."/edit_outstanding_data";
                          		$param = 'student_id='.$form->student_id.'&batch_id='.($form->batch_id);
                          		$title_edit = "Update Arrears / Outstanding";
                          		$pending_due = $outstanding->due_total; $pending_payment = $outstanding->total_payment;
                          		$total_discount = $outstanding->total_discount;
                           ?>
                           	<tr  id="tdDueAmount">
	                            <td><?php echo 'Fee Outstanding'; ?></td>
	                            <td style="text-align: right; padding-right: 60px;"><?php echo $outstanding->due_total?></td>
	                            <td style="text-align: right; padding-right: 110px;"><?php echo $outstanding->total_payment?></td>
	                            <td style="text-align: right; padding-right: 80px;"><?php echo $outstanding->total_discount?></td>
	                            <td style="text-align: right; padding-right: 90px;" nowrap="nowrap">
	                            	<span style="float: left;"><?php echo number_format( $outstanding->due_total - $outstanding->total_payment, 2)?></span>
	                            </td>
	                            <td width="100px">
	                            	<?php if($outstanding->row_count > 1){ 
	                            		$title = "Arrears / Outstandings Detail";
	                            		$url   = base_url().$model."/outstanding_detail"; ?>
	                            	<a href="javascript:;" class="btn default btn-xs green-stripe" <?php echo 'onclick="showOutstandings( [\''. $url .'\', \'_update\', \'outstandingDetailForm\', \'tdDueAmount\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'})"'; ?> > Detail </a>
									<?php }?>
									
	                            	<a href="javascript:;" class="btn default btn-xs red-stripe <?php if($admin_role == 0) echo 'disabled';?>" <?php echo 'onclick="showInnerBox( [\''. $url_edit .'\', \'_update\', \'outstandingDetailForm\', \'tdDueAmount\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title_edit.'\'})"'; ?>  >Edit</a>
	                            </td>
	                       	</tr>
                           <?php }
                           if(isset($pending_fee_list) && sizeof($pending_fee_list) > 0){ $i=0;
                           	//$pending_due = 0; $pending_payment = 0;
                           	foreach($pending_fee_list as $values){ $i++;
                          	   $pending_due += $values->due_total;
                          	   $pending_payment += $values->total_payment;
                          	   $total_discount += $values->total_discount;
                      	?>
	                          <tr>
	                          	<td><?php echo $values->fee_desc; ?></td>
                  	            <td style="text-align: right; padding-right: 60px;"><?php echo $values->due_total?></td>
                  	            
                  	            <td style="text-align: right; padding-right: 110px;"><?php echo number_format($values->total_payment, 2, '.', '');?></td>
                  	            <td style="text-align: right; padding-right: 80px;"><?php echo $values->total_discount?></td>
                  	            <td style="text-align: right; padding-right: 90px;"><?php //echo number_format( $values->due_total - $values->total_payment, 2)?></td>
	                            <td></td>
	                            
	                          </tr>
	                  <?php	  } ?>
                  	  		<tr>                  	        	
	                            <td style="text-align: right; padding-right: 4px; font-weight: bold;"><?php echo Base_Controller::ToggleLang('Total'); ?>:</td>
	                            <td style="text-align: right; padding-right: 60px;"><?php echo number_format($pending_due, 2, '.', '');?></td>
	                            <td><?php echo number_format($pending_payment, 2, '.', '');?></td>
	                            <td style="text-align: right; padding-right: 80px;"><?php echo number_format($total_discount, 2, '.', '');?></td>
	                            <td><?php echo number_format( $pending_due - $pending_payment - $total_discount, 2, '.', '');?></td>
                  	            <td></td>
                  	       </tr>
                  	   <?php
                          }
                          else{
								echo '<tr><td colspan="6" align="center" style="height:100px; vertical-align:middle">No Pending Fees</td></tr>';
						  }	
                       ?>
	                </tbody>
				</table>
			</div>
			<?php //echo form_close();?>
		</div>
	</div>
	<!-- END CONDENSED TABLE PORTLET-->
	<br />
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Paid Fees');?></div>
			<div class="actions">
				<?php 
				if($form->cdel == '0'){
					$title = "Guarantee Cheque";
					$param = 'student_id='.$form->student_id.'&batch_id='.$form->batch_id;
					$url   = base_url().$model."/add_guarantee_cheque";
				?>
				<a href="javascript:;" class="btn default btn-xs green" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'guaranteeChequeForm\', \'paid_fee_div\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'})"'; ?>><i class="fa fa-plus"></i> Guarantee Cheque </a>
				<?php } ?>
			</div>
		</div>
		<div class="portlet-body">
			<?php  
			//echo form_open('students/add_emergency_detail',array('id'=>'emergencyDetailForm')); $today    = date('Y-m-d');
			?>
			<div class="table-responsive" id="paid_fee_div">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th><?php echo Base_Controller::ToggleLang('Receipt #');?></th>
							<th><?php echo Base_Controller::ToggleLang('Date');?></th>
							<th><?php echo Base_Controller::ToggleLang('Fee Desc');?></th>
							<th><?php echo Base_Controller::ToggleLang('Paid Amount + Discount');?></th>
							<th><?php echo Base_Controller::ToggleLang('Payment Mode');?></th>
							<th><?php echo Base_Controller::ToggleLang('Remarks');?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>					
						<?php 
                          if(isset($fee_paid_list) && sizeof($fee_paid_list) > 0){
                          	$i=0;
                          	foreach($fee_paid_list as $values){ if($values->mark_delete == 9) continue;
                          		$i++;
	                          	$time_diff = explode(':', $values->diff);
	                          	$payment_data_content = "";
	                          	$payment_mode = $values->payment_mode;
	                          	if($values->cheque_amount_second > 0) {
	                          		$payment_mode .= ", ". $values->payment_mode_second;
	                          		$payment_data_content  = $values->payment_mode.":".$values->cheque_amount;
	                          		$payment_data_content .= ", ".$values->payment_mode_second.":".$values->cheque_amount_second;
	                          	}
                          ?>
	                          <tr>
	                          	<td><?php echo $values->receipt_number; ?></td>
	                         	<td><?php echo Util::displayFormat($values->payment_date); ?></td>
	                            <td><?php echo $values->fee_desc; ?></td>
	                            
	                            <td><?php echo $values->payment_amount.' + '. $values->discount_amount?></td>
	                            <td <?php if($payment_data_content != "") echo 'class="popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="'.$payment_data_content.'" data-original-title="Payment Detail"';?> ><?php echo $payment_mode; ?></td>
	                            <td><?php echo $values->comments?></td>
	                            <td <?php if($values->holding_comments !='') echo 'class="popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="'.$values->holding_comments.'" data-original-title="Reason"';?> > 
	                            <?php if($values->mark_delete == '0' && $time_diff[0] == 0 && $time_diff[1] <= 5)
	                            	 { 
	                            		$title = "Hold Transaction";
	                            		$param = 'student_id='.$form->student_id.'&batch_id='.($form->batch_id)."&id=".$values->payment_id;
	                            		$url   = base_url().$model."/holding_trans"; 
	                            		$span_id = 'me'.$i;
	                            		?>
	                            	<span id="<?php echo $span_id;?>" ><a href="javascript:;" class="btn default btn-xs green-stripe" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'holdingTransForm\', \''.$span_id.'\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'})"'; ?> > Hold </a></span>
								<?php } else {
									if($admin_role == 3){
										if($values->mark_delete == 3){
											echo '<a href="javascript:;" class="btn default btn-xs red-stripe" onclick="cheque_return(\''.$values->payment_id.'\');" > Return </a>';
										}
										elseif($values->mark_delete == 9){ // Hold Enteries deleted	
											echo '<a href="javascript:;" class="btn default btn-xs red-stripe disabled" onclick="" >Deleted</a>';
										}else{	
											$onclick = 'close_payment(\''.$values->payment_id.'\')'; $close_disable = ($values->mark_delete != '2')? 'disabled': '';
											echo '<a href="javascript:;" class="btn default btn-xs red-stripe '.$close_disable.'" onclick="'.$onclick.'" >Close</a>';
										}
									}else{ ?>
									<a href="javascript:;" class="btn default btn-xs <?php echo ($values->mark_delete == '2') ? 'red' : 'green';?>-stripe disabled " >Hold</a>
									<?php }
									}
									
									  if($values->mark_delete <= 1){	 
							?>
	                            <a href="javascript:;" class="btn default btn-xs blue-stripe <?php if($values->mark_delete > 1) echo 'disabled';?>" onclick="window.open('<?php echo base_url().$model.'/payment_receipt/'. $values->payment_id.'/?student_id='.$values->student_id;?>', '_blank')" href="#">Print</a>
	                            <?php } ?>
	                            </td>
	                          </tr>
	           	<?php		}
	           				
	           				if(isset($voucher_list) && sizeof($voucher_list) > 0){
	           					foreach ($voucher_list as $row){
	           					?>
	           					<tr>
		                          	<td><?php echo $row->voucher_reference; ?></td>
		                         	<td><?php echo Util::displayFormat($row->voucher_date); ?></td>
		                            <td><?php echo $row->voucher_desc; ?></td>
		                            <td>(<?php echo number_format($row->credit_total, 2); ?>)</td>
		                            <td><?php echo $row->voucher_type; ?></td>
		                            <td><?php echo $row->description; ?></td>
		                            <td>
		                            	<a href="javascript:;" class="btn default btn-xs blue-stripe" onclick="window.open('<?php echo base_url().'vouchers/print_voucher/'. $row->voucher_id;?>', '_blank')" href="#">Print</a>
		                            </td>
		                        </tr>    
	           					<?php
	           					} 
	           				}
	           		
                        }
                        else{
								echo '<tr><td colspan="6" align="center" style="height:100px; vertical-align:middle">No details of the fees paid available.</td></tr>';
						}	
                ?>
	                </tbody>
				</table>
			</div>
			<?php //echo form_close();?>
		</div>
	</div>
	<!-- END CONDENSED TABLE PORTLET-->
</div>