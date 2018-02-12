						<?php 
						$border = 0;
						if (isset($_GET['file_type']) && $_GET['file_type'] == "excel") {
							$file = $model.'_'.date('ymdhm');
							$border = 1;
							header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
							header('Content-Disposition: attachment; filename='.$file.'.xls');
						}
						
						?>
						<br><br><br>
						<table width="100%" border="0" cellspacing="3" cellpadding="0"  align="center">
				            <tr style="font-weight: bold">
	                            <td colspan="2" width="30%" ><?php echo '';?></td>
	                            <td colspan="4" width="40%" align="center" style="font-size: 1.2em;text-transform: Capitalize"><u>
	                            <?php
	                            $search_param = ""; $title = "by ";
	                           
								if(strlen($title)> 3)
								$title = substr($title, 0, strlen($title)-2);
	                            else 
	                            $title = '';
								echo Base_Controller::ToggleLang('Attendance Report (Absent Student)');
	                            
	                            ?></u></td>
	                            <td  width="30%" ></td>
                          	</tr>
                          	
                          	<?php include_once 'report_header.php';?>
                        </table>
						<br />
						<table id="report_tbl" border="<?php echo $border;?>" class="table-bordered table-striped table-condensed flip-content" width="100%" align="center">
                        <caption style="text-align: right; padding-right: 10px;"><?php if(isset($form_detail) && sizeof($form_detail) > 0){ echo 'Total Students: '. sizeof($form_detail); }?></caption>
                        <thead class="flip-content"><tr >
                            <th>#</th>
							<th><?php echo Base_Controller::ToggleLang('Admission #');?></th>
							<th><?php echo Base_Controller::ToggleLang('Student Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Date');?></th>
							<th><?php echo Base_Controller::ToggleLang('Grade/Sec');?></th>
							<th><?php echo Base_Controller::ToggleLang('Father Mobile #');?></th>
							<th><?php echo Base_Controller::ToggleLang('Mother Mobile #');?></th>
                          </tr></thead>
                  		<?php
                  		  $i=0; $msg_flag = TRUE;
                          if(isset($form_detail) && sizeof($form_detail) > 0){
                          	foreach($form_detail as $values){
                          		$i++; $msg_flag = FALSE;
                          		
                          ?>
	                          <tr>
	                            <td><? echo $i;?></td>
								<td><?php echo $values->admission_number; ?></td>
								<td><?php echo $values->student_name?></td>
								<td><?php echo Util::displayFormat($values->attendance_date)?></td>
								<td><?php echo $values->course_name. ' - ' . $values->section;?></td>
								<td><?php echo $values->cell_phone_mother?></td>
								<td><?php echo $values->cell_phone_mother;?></td>
	                          </tr>
	                  <?php 	}
                          }
                          	?>
                      	
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