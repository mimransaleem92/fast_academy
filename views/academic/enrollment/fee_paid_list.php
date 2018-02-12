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
                          	foreach($fee_paid_list as $values){ $i++;
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
									if($admin_role == 1){
										$onclick = ''; $close_disable = ($values->mark_delete != '2')? 'disabled': '';
										echo '<a href="javascript:;" class="btn default btn-xs red-stripe '.$close_disable.'" onclick="'.$onclick.'" >Close</a>';
									}else{ ?>
									<a href="javascript:;" class="btn default btn-xs <?php echo ($values->mark_delete == '2') ? 'red' : 'green';?>-stripe disabled " >Hold</a>
									<?php }
									} 
							?>
	                            <a href="javascript:;" class="btn default btn-xs blue-stripe <?php if($values->mark_delete != '0') echo 'disabled';?>" onclick="window.open('<?php echo base_url().$model.'/payment_receipt/'. $values->payment_id.'/?student_id='.$values->student_id;?>', '_blank')" href="#">Print</a>
	                            </td>
	                          </tr>
	           	<?php		}
	           				
	           				if(isset($voucher_list) && sizeof($voucher_list) > 0){
	           					foreach ($voucher_list as $row){
	           					?>
	           					<tr>
		                          	<td><?php echo $row->voucher_reference; ?></td>
		                         	<td><?php echo Util::displayFormat($row->voucher_date); ?></td>
		                            <td>Refund Fee</td>
		                            <td>(<?php echo number_format($row->credit_total, 2); ?>)</td>
		                            <td>Cheque</td>
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