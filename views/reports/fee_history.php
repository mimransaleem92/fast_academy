						<?php 
						if (isset($_GET['file_type']) && $_GET['file_type'] == "excel") {
							$file = $model.date('Ymd');
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment; filename='.$file.'.xls');
						}
						
						?>
						<br><br><br>
						<table width="100%" border="0" cellspacing="3" cellpadding="0"  align="center">
				            <tr style="font-weight: bold">
	                            <td colspan="2" width="30%" ><?php echo '';?></td>
	                            <td colspan="3" width="40%" align="center" style="font-size: 1.2em;text-transform: Capitalize"><u>
	                            <?php
	                            $search_param = ""; $title = "by ";
	                            
								if(strlen($title)> 3)
								$title = substr($title, 0, strlen($title)-2);
	                            else 
	                            $title = '';
								echo Base_Controller::ToggleLang('Pending Fee Report');
	                            
	                            ?></u></td>
	                            <td  width="30%" ></td>
                          	</tr>
                          	
                          	<?php include_once 'report_header.php';?>
                        </table>
						<br />
						<table class="table-bordered table-striped table-condensed flip-content" width="100%" align="center">
                        <caption style="text-align: right; padding-right: 10px;" id="total_cap"><?php if(isset($form_detail) && sizeof($form_detail) > 0){ echo 'Total Students: 0'; }?></caption>
                        <thead class="flip-content"><tr >
                            <th>#</th>
							<th><?php echo Base_Controller::ToggleLang('Admission #');?></th>
							<th><?php echo Base_Controller::ToggleLang('Student Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Grade/Sec');?></th>
							<!-- <th><?php echo Base_Controller::ToggleLang('Contact');?></th>-->
							<th><?php echo Base_Controller::ToggleLang('Fee Outstanding');?></th>
							<th><?php echo Base_Controller::ToggleLang('Fee For the Year');?></th>
							<th><?php echo Base_Controller::ToggleLang('Total Due');?></th>
							<th><?php echo Base_Controller::ToggleLang('Received Outstanding');?></th>
							<th><?php echo Base_Controller::ToggleLang('Received For Fee of Year');?></th>
							<th><?php echo Base_Controller::ToggleLang('Discount');?></th>
							<th align="right" ><?php echo Base_Controller::ToggleLang('Balance');?></th>
                          </tr></thead>
                  		<?php
                  		  $b = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
                  		  $out_count = $i=0; $msg_flag = TRUE; 
                  		  $total_due = 0;
                  		  $total_payment = 0;
                  		  $total_discount = 0;
                  		  $total_pending = 0; $flag=0;
                  		  $total_outstanding_due  = $total_outstanding_due1  = 0;
                  		  $total_outstanding_payment = 0;
                          if(isset($form_detail) && sizeof($form_detail) > 0){
                          	foreach($form_detail as $values){
                          	//for($j=0; $j<sizeof($form_detail); $j++){ $values = $form_detail[$j];
                          		if($flag != $values->student_id){
                          			$flag = $values->student_id;
	                          		$outstanding_due = 0;
	                          		$outstanding_received = 0;
	                          		$outstanding_discount = 0;
	                          		$outstanding_pending = 0;
                          		}
                          		
                          		if($values->batch_id < $b ) {
                          			$out_count++;
                          			$outstanding_due += $values->total_due;
                          			$outstanding_received += $values->total_payment;
                          			$outstanding_discount += $values->total_discount;
                          			$outstanding_pending  += $values->pending_amount;
                          			//$total_outstanding_due1 += $values->total_due;
                          			// For difference in outstanding ammounts is becouse of 12 promoted and inactive students are not coming in this report
                          			/*$next = isset($form_detail[$j+1]) ? $form_detail[$j+1] : null;
                          			if( $next == null || ($flag != $next->student_id && $next->batch_id < 7)){
                          				
                          			}
                          			else {
                          				continue;
                          			}*/
                          			continue;
                          		}
                          		
                          		$i++; $msg_flag = FALSE;
                          		$total_due 		+= $values->total_due;
                          		$total_payment  += $values->total_payment;
                          		$total_discount += $values->total_discount + $outstanding_discount;
                          		$total_pending  += $values->pending_amount + $outstanding_pending;
                          		
                          		$total_outstanding_due 		+= $outstanding_due;
                          		$total_outstanding_payment  += $outstanding_received;
                          		
                          		//$tt = ($total_outstanding_due  != $total_outstanding_due1) ? ($total_outstanding_due1 - $total_outstanding_due).'-' : '';
                          		
                          		$pos = strpos($values->cell_phone_father, '/');
                          		$cell_father = $values->cell_phone_father;
                          		if($pos > 0){ $cell_father = substr($cell_father, 0, $pos); }
                          			
                          		$contact_title = $cell_father.', '.$values->cell_phone_mother;
                          ?>
	                          <tr>
	                            <td><? echo $i;?></td>
								<td><a href="<?php echo base_url().'students/student_profile/'.$values->student_id;?>#tabs_3" ><?php echo $values->admission_number; ?></a></td>
								<td title="<?php echo $contact_title;?>"><?php echo $values->student_name?></td>
								<td><?php echo $values->course_name.' - '.$values->section?></td>
								<!-- <td style="width: 80px">
								
								</td>-->
								<td align="right" ><?php echo number_format($outstanding_due, 2);?></td>
								<td align="right" ><?php echo number_format($values->total_due, 2);?></td>
								<td align="right" ><?php echo number_format(($values->total_due+$outstanding_due), 2)?></td>
								<td align="right" ><?php echo number_format($outstanding_received, 2);?></td>
								<td align="right" ><?php echo number_format($values->total_payment, 2);?></td>
								<td align="right" ><?php echo number_format($values->total_discount+$outstanding_discount, 2);?></td>
								<td align="right" ><?php echo number_format($values->pending_amount+$outstanding_pending, 2);?></td>
	                          </tr>
	                  <?php 	}
                          }
                          	?>
                      	<tr>
                            <td></td>
							<td colspan="3" align="right" ><b><?php echo Base_Controller::ToggleLang('Total'); ?>:</b></td>
							<td align="right" ><b><?php echo number_format($total_outstanding_due, 2);?></b></td>
							<td align="right" ><b><?php echo number_format($total_due, 2);?></b></td>
							<td align="right" ><b><?php echo number_format(($total_outstanding_due+$total_due), 2);?></b></td>
							<td align="right" ><b><?php echo number_format($total_outstanding_payment, 2);?></b></td>
							<td align="right" ><b><?php echo number_format($total_payment, 2);?></b></td>
							<td align="right" ><b><?php echo number_format($total_discount, 2);?></b></td>
							<td align="right" ><b><?php echo number_format($total_pending, 2);?></b></td>
                    	</tr>
	                </table>
					<?php if($msg_flag) {?>
	                <table width="100%" border="0" align="center" height="345px" style="cursor:pointer" >
                        <tr style="font-weight:bold">
                        	<td width="100%" align="center" valign="middle" >
                        	<div class="alert alert-danger">
								<?php if($msg_flag) echo 'No Record Found!'; ?>
							</div>
         					</td>
         				</tr>
         			</table>
					<? }?>
					<input type="hidden" id="total_record" value="<?php echo $i;?>" />