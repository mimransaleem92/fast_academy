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
                          		$param = 'student_id='.$_POST['student_id'].'&batch_id='.($_POST['batch_id']);
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
	                            	<span style="float: left;"><?php echo number_format( $outstanding->due_total - $outstanding->total_payment - $outstanding->total_discount, 2)?></span>
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