						<?php $border = 'border="0"';
						if (isset($_GET['file_type']) && $_GET['file_type'] == "excel") {
							$file = $model.date('Ymd');
							$border = 'border="1"';
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment; filename='.$file.'.xls');
							
							header("Pragma: no-cache");
							header("Expires: 0");
						}
						
						?>
						<br><br><br>
						<table width="100%" border="0" cellspacing="3" cellpadding="0"  align="center">
				            <tr style="font-weight: bold">
	                            <td colspan="2" width="30%" ><?php echo '';?></td>
	                            <td colspan="3" width="40%" align="center" style="font-size: 1.2em;text-transform: Capitalize; text-decoration: underline; ">
	                            <?php $search_param = ""; $title = "by ";
	                            	echo Base_Controller::ToggleLang('Fee Collection Report'); ?></td>
	                            <td  width="30%" ></td>
                          	</tr>
                          	<?php include_once 'report_header.php';?>
                        </table>
						<br />
						<table id="report_tbl"<?php echo $border;?> class="table-bordered table-striped table-condensed flip-content" width="100%" align="center">
                        <caption style="text-align: right; padding-right: 10px;"><?php if(isset($form_detail) && sizeof($form_detail) > 0){ echo 'Total Students: '. sizeof($form_detail); }?></caption>
                        <thead class="flip-content"><tr >
                            <th>#</th>
							<th><?php echo Base_Controller::ToggleLang('Admission #');?></th>
							<th><?php echo Base_Controller::ToggleLang('Student Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Grade/Sec');?></th>
							<th align="right" ><?php echo Base_Controller::ToggleLang('Amount');?></th>
							<th><?php echo Base_Controller::ToggleLang('Teacher');?></th>
							<th><?php echo Base_Controller::ToggleLang('Academy');?></th>
                          </tr></thead>
                  		<?php
                  		  $i=0; $msg_flag = TRUE; $total_payment = 0;
                  		  $total_mode1 = $total_mode2 = 0;
                          if(isset($form_detail) && sizeof($form_detail) > 0){
                          	foreach($form_detail as $values){
                          		$i++; $msg_flag = FALSE;
                          		//if ($values->payment_amount == 0) break;
                          		$total_payment += $values->payment_amount;
                          		$total_mode1 += ($values->payment_amount)*(0.75);
								$total_mode2 += ($values->payment_amount)*(0.25);
                          ?>
	                          <tr>
	                            <td><? echo $i;?></td>
								<td><?php echo $values->admission_number; ?></td>
								<td><?php echo $values->student_name?></td>
								<td><?php echo $values->course_name. ' - ' . $values->section;?></td>
								<td align="right" ><?php echo number_format($values->payment_amount, 2);?></td>
								<td align="right" ><?php echo number_format($values->payment_amount*(0.75), 2);?></td>
								<td align="right" ><?php echo number_format($values->payment_amount*(0.25), 2);?></td>
	                          </tr>
	                  <?php 	}
                          }
                       ?>
                      	<tr>
                            <td></td>
							<td colspan="3" align="right" ><b><?php echo Base_Controller::ToggleLang('Total'); ?>:</b></td>
							<td align="right" ><b><?php echo number_format($total_payment, 2);?></b></td>
							<td align="right" ><b><?php echo number_format($total_mode1, 2);?></b></td>
							<td align="right" ><b><?php echo number_format($total_mode2, 2);?></b></td>
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
					<script> var reportData = <?php  echo json_encode($form_detail);?>; </script>