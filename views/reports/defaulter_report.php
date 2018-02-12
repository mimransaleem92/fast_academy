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
	                            /*
	                            if(isset($_REQUEST['company_name']) && !empty($_REQUEST['company_name'])){
									$title .= "Company, ";
	                            	$search_param .= "<b>Company:</b> ".$_REQUEST['company_name'];
								}
								if(isset($_REQUEST['priority']) && !empty($_REQUEST['priority'])){
									$title .= "Priority, ";
									$search_param .= "<br/><b>Priority:</b> ".$_REQUEST['priority'];
								}
								if(isset($_REQUEST['status']) && !empty($_REQUEST['status'])){
									$title .= "Status, ";
									$search_param .= "<br/><b>Status:</b> ".$_REQUEST['status'];
								}
								if(isset($_REQUEST['problem_type']) && !empty($_REQUEST['problem_type'])){
									$title .= "Problem Type, ";
									$search_param .= "<br/><b>Problem Type:</b> ".$_REQUEST['problem_type'];
								}
								if(isset($_REQUEST['technology']) && !empty($_REQUEST['technology'])){
									$title .= "Technology, ";
									$search_param .= "<br/><b>Technology:</b> ".$_REQUEST['technology'];
								}*/
								if(strlen($title)> 3)
								$title = substr($title, 0, strlen($title)-2);
	                            else 
	                            $title = '';
								echo Base_Controller::ToggleLang('Defaulter Report');
	                            
	                            ?></u></td>
	                            <td  width="30%" ></td>
                          	</tr>
                          	
                          	<?php include_once 'report_header.php';?>
                        </table>
						<br />
						<table class="table-bordered table-striped table-condensed flip-content" width="100%" align="center">
                        <caption style="text-align: right; padding-right: 10px;"><span id="total_cap"><?php if(isset($form_detail) && sizeof($form_detail) > 0){ echo 'Total Students: '. sizeof($form_detail); }?></span></caption>
                        <thead class="flip-content"><tr >
                            <th>#</th>
							<th><?php echo Base_Controller::ToggleLang('Admission #');?></th>
							<th><?php echo Base_Controller::ToggleLang('Student Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Grade/Sec');?></th>
							<th><?php echo Base_Controller::ToggleLang('Contact');?></th>
							<th><?php echo Base_Controller::ToggleLang('Total Due');?></th>
							<th><?php echo Base_Controller::ToggleLang('Received');?></th>
							<th><?php echo Base_Controller::ToggleLang('Discount');?></th>
							<th align="right" ><?php echo Base_Controller::ToggleLang('Balance');?></th>
                          </tr></thead>
                  		<?php
                  		  $i=0; $msg_flag = TRUE; 
                  		  $total_due = 0;
                  		  $total_payment = 0;
                  		  $total_discount = 0;
                  		  $total_pending = 0;
                          if(isset($form_detail) && sizeof($form_detail) > 0){
							$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
							$fee_term = (isset($_POST['fee_term']) && !empty($_POST['fee_term'])) ? $_POST['fee_term'] : (($div_id == 2 ) ? '2' : '2.4');
							if(isset($_GET['fee_term']) && !empty($_GET['fee_term'])){
								$fee_term = $_GET['fee_term'];
							}
							//echo $fee_term;
							foreach($form_detail as $values){
                          		//if($values->pending_amount == 0) break;
                          		$row_total_due = $values->total_due;
                          		if($values->batch_id != 7) {
                          			//continue;
                          		}
                          		else{
                          			$row_total_due = ($values->total_due)*(0.25)*($fee_term);
                          		}
                          		$row_pending = $row_total_due - $values->total_payment - $values->total_discount;
                          		//if($row_pending > $row_total_due*(0.15)){ // old check
                          		if($row_pending != 0){	
                          		$i++; $msg_flag = FALSE;
                          		$total_due 		+= $row_total_due;
                          		$total_payment  += $values->total_payment;
                          		$total_discount += $values->total_discount;
                          		$total_pending  += $row_pending;//$values->pending_amount;
                          ?>
	                          <tr>
	                            <td><? echo $i;?></td>
								<?php if($print){ ?>
									<td nowrap="nowrap"><?php echo $values->admission_number; ?></td>
								<?php }else{?>
									<td><a href="<?php echo base_url().'students/student_profile/'.$values->student_id;?>#tabs_3" ><?php echo $values->admission_number; ?></a></td>	
								<?php }?>
								
								<td><?php echo $values->student_name?></td>
								<td><?php echo $values->course_name.' - '.$values->section?></td>
								<td><?php echo $values->cell_phone_father.'<br>'.$values->cell_phone_mother?></td>
								<td align="right" ><?php echo number_format($row_total_due, 2);?></td>
								<td align="right" ><?php echo number_format($values->total_payment, 2);?></td>
								<td align="right" ><?php echo number_format($values->total_discount, 2);?></td>
								<td align="right" ><?php echo number_format($row_pending, 2);?></td>
	                          </tr>
	                  <?php  	}
                          	}
                          }
                          	?>
                      	<tr>
                            <td></td>
							<td colspan="4" align="right" ><b><?php echo Base_Controller::ToggleLang('Total'); ?>:</b></td>
							<td align="right" ><b><?php echo number_format($total_due, 2);?></b></td>
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
					<script>$('#total_cap').html( 'Total Students: ' + $('#total_record').val() );</script>