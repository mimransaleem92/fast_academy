<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php echo APP_TITLE.' Quarterly'; ?></title>

	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
	<style type="text/css">
		#delta_back_header {
    		font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
			font-size: 16px; color: #FFF; text-align: center;
			font-style: italic;
			text-transform: uppercase; padding-top: 18px;
			background-color:#042378;
		  	border-radius: 8px;
			width:350px;height:60px; border:2px solid #040029;
		}

		@media print {
        	#delta_back_header {
	        	color: #FFF;
	            background-color: #042378 !important;
	            -webkit-print-color-adjust: exact;

	        }
	    }
	</style>
</head>
<body>
	<div class="col-md-12">
		<!-- BEGIN CONDENSED TABLE PORTLET-->
		<?php $form = null;
			if (!is_null($student_list) ){
				$form = isset($student_list[0]) ? $student_list[0] : $student_list;
			}

			if($form->division_id == '1'){
				$background_image = base_url()."assets/images/report_header_nis.png";
				$school_title = APP_TITLE;
				$address_line1 = "american_curriculum";
				$address_line2 = ( $form->course_id < 12 ) ? "license_no_117s" : 'license_no_4350140114';
			}else {
				$background_image = base_url()."assets/images/report_header_nis.png";
				$school_title = APP_TITLE;
				$address_line1 = "american_curriculum";
				$address_line2 = ( $form->course_id < 12 ) ? "license_no_117s" : 'license_no_4350140114';

				//$address_line3 = "Ministry of Education <br>General Directorate of Education/ Riyadh Zone <br>Private and Foreign Education";
				//$address_line4 = "";
			}
			$background_image = base_url()."assets/images/report_header_vis_final.jpg";
			/* --------------------------------------------------------------------------------------------- */
			// position code
			$marks_arr =array();
			foreach ($position as $row)
			{
				$marks_arr[$row->student_id] = $row->obtain_marks+150;
			}
			rsort($marks_arr); $position_arr = array();
			foreach($marks_arr as $id => $m){
				$position_arr[$m] = ++$id;
			}
		?>

		<div style="width:820px;  font-size: 11px;">
			<div style="height: 130px; padding-top: 10px; font-family: 'Bodoni MT', Didot, 'Didot LT STD', 'Hoefler Text', Garamond, 'Times New Roman', serif;" >
				<img src="<?php echo $background_image;?>" alt="<?php echo $school_title;?>"/>
				<table border="0" width="100%" style="margin-top: -70px;" >
					<thead>
						<tr>
							<th width="35%" style="text-align: left; font-size: 14px;"><?php echo Base_Controller::ToggleLang($school_title);?> </th>
							<th width="30%"></th>
							<th width="35%" style="text-align: right; font-size: 14px;"><?php echo Base_Controller::ToggleLang($school_title, 'ar');?></th>
						</tr>

						<tr>
							<th style="text-align: left; font-size: 14px;"><?php echo Base_Controller::ToggleLang($address_line1);?></th>
							<th></th>
							<th style="text-align: right; font-size: 14px;"><?php echo Base_Controller::ToggleLang($address_line1, 'ar');?></th>
						</tr>
						<tr>
							<th style="text-align: left; font-size: 14px;"><?php echo Base_Controller::ToggleLang($address_line2);?></th>
							<th></th>
							<th style="text-align: right; font-size: 14px;"><?php echo Base_Controller::ToggleLang($address_line2, 'ar');?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo Base_Controller::ToggleLang('report_header');?></td>
							<td style="text-align: center;">
								<?php $term_arr = array('1'=>'First', '2'=>'Second', '3'=>'Third', '4'=>'Fourth');
									  $term_name = (isset($_GET['term']) && $_GET['term'] != '' ) ? $term_arr[$_GET['term']] : 'First';
								
									  //echo 'Certificate <br>'.Base_Controller::ToggleLang('Certificate', 'ar').'<br>';
									  echo $term_name.' Quarter Report<br>'.Base_Controller::ToggleLang($term_name.' Quarter Report', 'ar').'<br>';
									  //echo 'First Semester Report<br>'.Base_Controller::ToggleLang('First Semester Report', 'ar').'<br>';
									  
									  echo  $course[$form->course_id]['course_name'] . ' ' .
											$form->section; ?>
							</td>
							<td style="text-align: right;"><?php echo Base_Controller::ToggleLang('report_header', 'ar');?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="width:820px; margin-top: 0px;" >
				<div class="row cl-md-12" id="tbl_marksheet" style="padding: 8px" >
			 		<?php $student = $student_list[0];
			 			$header_fields = array('student_name'=>'Student Name', 'nationality_en'=>'Nationality', 'date_of_birth'=>'Date of Birth', 'passport_id'=>'Passport No', 'iqama_id'=>'I D No', 'admission_date'=>'Admission Date', 'previous_school'=>'Previous School');
			 		?>
					<div class="row">
							<div class="col-md-5 col-sm-5 col-xs-5" >
									<div style="font-family: Calibri; padding: 5px; width:100%; border-radius: 15px; border: 2px solid #000; background-color: #eaffea !important;">
										<table border="0" style="width: 100%; background-color: #eaffea; color: #000;">
											<?php foreach ($header_fields as $field=>$caption){ ?>
													<tr>
														<td width="75px"><?php echo Base_Controller::ToggleLang($caption);?>:</td>
														<td width="220px" style="text-align: left"><?php echo $student->$field;?></td>
														<?php
														if(in_array($field, array('student_name', 'previous_school')) ) {
															$field = $field.'_ar';
															$value = $student->$field;
														}
														elseif($field == 'nationality_en') $value = $student->nationality_ar;
														else{
															$value = Util::num($student->$field, 'ar');
														}
														?>
													</tr>
												<?php } ?>
											</table>
									</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-2">
							    <div style="font-family: Calibri; font-weight: bold; padding: 4px; width:100%; height:100px; background-color: #FFF !important;">
											<table border="0" style="width: 100%; background-color: #FFF; color: #000;">
												<tr>
													<td width="100%" style="text-align: center">
														<?php echo $course[$form->course_id]['course_name_ar'] . '<br>' .
													    				$form->batch_name.' (G)<br>' .
																			$form->batch_name_hijri.' (H)<br>'; ?>
													</td>
												</tr>

												<tr>
													<td width="100%" height="50px" style="text-align: right">&nbsp;</td>
												</tr>
												<tr>
													<td width="100%" style="text-align: center"><?php echo Base_Controller::ToggleLang('Student Grades').'<br/>'.Base_Controller::ToggleLang('Student Grades', 'ar');?></td>
												</tr>
											</table>
									</div>
							</div>
							<div class="col-md-5 col-sm-5 col-xs-5">

									<div style="font-family: Calibri; padding: 5px; width:100%; border-radius: 15px; border: 2px solid #000; background-color: #eaffea !important;">
										<table border="0" style="width: 100%; background-color: #eaffea; color: #000;">
											<?php foreach ($header_fields as $field=>$caption){ ?>
													<tr>
														<?php
														if(in_array($field, array('student_name', 'previous_school')) ) {
															$field = $field.'_ar';
															$value = $student->$field;
														}
														elseif($field == 'nationality_en') $value = $student->nationality_ar;
														else{
															$value = Util::num($student->$field, 'ar');
														}
														?>
														<td width="200px" style="text-align: right"><?php echo $value;?></td>
					                	<td width="120px" style="text-align: right">:<?php echo Base_Controller::ToggleLang($caption, 'ar');?></td>
													</tr>
												<?php } ?>
											</table>
									</div>
							</div>
				 	</div>

			 		<div class="row" style="padding-top: 21px">
			 			<div class="col-lg-12 col-md-12 col-sm-12" style="">
				 			<table border="1" style="border: 2px solid #000; width: 100%; background-color: #eaffea; color: #000;">
				 				<tr>
				                	<td style="text-align: center; width: 170px;" rowspan="2"><?php echo Base_Controller::ToggleLang('Subject');?></td>
				                	<td style="text-align: center;" rowspan="2"><?php echo Base_Controller::ToggleLang('Subject', 'ar');?></td>
				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Max');?></td>
													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Activities');?></td>
													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Quiz');?></td>
													<td align="center" width="65px">
				                		<?php echo Base_Controller::ToggleLang('Quarter Exam'); ?>
				                	</td>
				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Total');?></td>
				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Credit Hours');?></td>
				                	<td style="text-align: center;" rowspan="2" width="65px"><?php echo Base_Controller::ToggleLang('GPA');?></td>
				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Grading');?></td>
				                </tr>
				                <tr>
													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Max', 'ar');?></td>
													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Activities', 'ar');?></td>
													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Quiz', 'ar');?></td>
				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Quarter Exam', 'ar');?></td>
				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Total', 'ar');?></td>
				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Credit Hours', 'ar');?></td>
				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Grading', 'ar');?></td>
				                </tr>
				                <?php $total = $total_obtained = $credit_hours = 0;
				                	  $gpa_subject_total = $gpa_subject_count = 0;
				                	if(isset($subject_list) && sizeof($subject_list)>0){
				                		foreach ($subject_list as $row){
					                		$title = explode(', ', $row->marksheet_title);
					                		$score = explode(', ', $row->marksheet_score);
					                		$total_from = $exams = $row_total = 0;
					                		$activity_total = $exams = $quiz = 0;
					                		for ($i=0; $i<count($title); $i++){
																$total_from += $score[$i];
					                			if($row->subject_id >= 25){
					                				$activity_total = $quiz = '-';
					                				$row_total += $score[$i];
					                				$total += $score[$i];
																	$exams += $score[$i];
					                			}else{
						                			if(isset($marks[$student->student_id][$row->subject_id][$i])){

																		if(in_array($title[$i],array('Quarter'))){
						                					$exams = $marks[$student->student_id][$row->subject_id][$i];
						                				}
						                				elseif(in_array($title[$i],array('Quiz'))){
						                					$quiz = $marks[$student->student_id][$row->subject_id][$i];
						                				}
																		else
																		{
						                					$activity_total += $marks[$student->student_id][$row->subject_id][$i];
						                				}

						                				$row_total += $marks[$student->student_id][$row->subject_id][$i];
						                				$total += $score[$i];
					                				}
					                			}
				                			}
											$weighted_average = ($row_total/$total_from)*100;
											$row_gpa = Util::gpa($weighted_average);
											if($row->subject_id <=23){
				                				$gpa_subject_count++;
				                				// $gpa_subject_total += $row_total;
												$gpa_subject_total += $row_gpa*$row->credit_hours;
				                				$credit_hours += $row->credit_hours;


				                			}
				                			$total_obtained += $row_total;
				                	?>
				                <tr style="background-color: #FFF">
				                	<td align="left" style="padding-left: 4px"><?php echo $row->subject_name;?></td>
				                	<td align="right" style="padding-right: 4px"><?php echo $row->subject_name_arabic;?></td>
													<td align="center"><?php echo $total_from;?></td>
				                	<td align="center"><?php echo $activity_total;?></td>
				                	<td align="center"><?php echo $quiz;?></td>
													<td align="center"><?php echo $exams;?></td>

				                	<td align="center"><?php echo $row_total;?></td>
				                	<td align="center"><?php echo ($row->subject_id > 25) ? '-' : $row->credit_hours;?></td>
				                	<td align="center"><?php echo ($row->subject_id > 25) ? '-' : Util::gpa($weighted_average);?></td>
				                	<td align="center"><?php echo Util::get_grade($weighted_average);?></td>
				                </tr>
				                <?php }
				                	}
				                	$total_gpa = 0;
				                	if($gpa_subject_count > 0) {
				                		$total_gpa = $gpa_subject_total / $credit_hours;
				                	}
									$total_average = ($total > 150) ? ($total_obtained)*100 / $total : '0';
									//$total_average = ($total_obtained -150)/$gpa_subject_count;
				                ?>
				                <tr style="font-weight: bold;">

				                	<td colspan="3"></td>
				                	<td align="center" colspan="2">
														<?php if($total_obtained > 150) { echo 'Position: '.$position_arr[$total_obtained];
														switch($position_arr[$total_obtained]){
															case '1': echo 'st'; break;
															case '2': echo 'nd'; break;
															case '3': echo 'rd'; break;

															default: echo 'th';
														}  } ?>
													</td>
													<td align="right"><?php echo Base_Controller::ToggleLang('Total');?>:</td>
				                	<td align="center"><?php echo number_format($total_obtained, 2);?></td>
				                	<td align="center"><?php echo number_format($credit_hours, 2);?></td>
				                	<td align="center" rowspan="2"><?php echo 'GPA';?></td>
				                	<td align="center"><?php echo number_format($total_gpa, 2);?></td>
				                </tr>
				                <tr style="font-weight: bold;">
													<td align="center" colspan="5"></td>
													<td align="right"><?php echo Base_Controller::ToggleLang('Out of');?>:</td>
				                	<td align="center"><?php echo $total;?></td>
				                	<td align="center"><?php echo number_format($total_average, 2).'%';?></td>
				                	<!-- <td align="center" rowspan="2"> GPA</td> -->
				                	<td align="center"><?php echo Util::get_grade($total_average);?></td>
				                </tr>
			            	</table>
						</div>
		      </div>
			 	</div>
		 	</div>
		 </div>

		 <div style="font-weight: bold; width:820px; padding-top: 10px; font-size: 13px; font-family: 'Bodoni MT', Didot, 'Didot LT STD', 'Hoefler Text', Garamond, 'Times New Roman', serif;" >
			<table border="0" width="100%" style="font-size: 16px;">
				<tr>
					<td width="30%"></td>
					<td width="40%"></td>
					<td width="30%"></td>
				</tr>
				<tr>
					<td width="30%"><?php echo Base_Controller::ToggleLang('School Principal');?> </td>
					<td width="40%" style="text-align: center;"><?php echo Base_Controller::ToggleLang('exam_controller');?></td>
					<td width="30%" style="text-align: center;"><?php echo Base_Controller::ToggleLang('Private Education Office');?></td>
				</tr>
				<tr>
					<td width="30%"><?php echo Base_Controller::ToggleLang('School Principal', 'ar');?> </td>
					<td width="40%" style="text-align: center;"><?php echo Base_Controller::ToggleLang('exam_controller', 'ar');?></td>
					<td width="30%" style="text-align: center;"><?php echo Base_Controller::ToggleLang('Private Education Office', 'ar');?></td>
				</tr>
				<tr height="30px">
					<td>________________: <?php echo Base_Controller::ToggleLang('name', 'ar');?></td>
					<td style="text-align: center;" >________________: <?php echo Base_Controller::ToggleLang('name', 'ar');?></td>
					<td rowspan="2" style="border: 1px solid; height: 60px"></td>
				</tr>
				<tr>
					<td>________________: <?php echo Base_Controller::ToggleLang('stamp_date', 'ar').'<br>&nbsp;<br>&nbsp;';?></td>
					<td style="text-align: center;" >________________: <?php echo Base_Controller::ToggleLang('stamp_date', 'ar').'<br>'.Base_Controller::ToggleLang('School Stamp')
												.'<br>'.Base_Controller::ToggleLang('School Stamp', 'ar');?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="clearfix" style="page-break-after: always;"></div>
	<div class="col-md-12">
		<div style="width:820px; text-align: center;">
			<div style="text-align: center; margin: 10px;">
				<img src="<?php echo base_url();?>assets/images/nis_logo_left.png" alt="<?php echo $school_title;?>"/>
				<img src="<?php echo base_url();?>assets/images/vis_logo_right_final.png" alt="Advanced"/>
			</div>

			<div style=" font-size: 18px; font-family: 'Bodoni MT', Didot, 'Didot LT STD', 'Hoefler Text', Garamond, 'Times New Roman', serif;"> <?php echo $form->batch_name;?> </div>

			<div style="padding-left: 235px; text-align: center; margin-top: 10px;">
				<div id="delta_back_header" style="">
					<?php echo $school_title;?>
				</div>
			</div>
			<!-- [0,60,63,66,69,73,76,79,83,86,89,93,96],["F","D-","D","D+","C-","C","C+","B-","B","B+","A-","A","A+"] -->
			<?php
				$grading_system = array("A+"=>"Outstanding, 100-98, 4.00","A"=>"Excellent, 97-90, 3.50","B+"=>"Very Good, 89-85, 3.00","B"=>"Very Good, 84-80, 2.50","C+"=>"Good, 79-73, 2.00","C"=>"Good, 72-65, 1.50","D+"=>"Pass, 64-50, 1.00");
			?>
			<div style="padding-left: 125px; text-align: center; margin-top: 30px;">
				<div style="font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
					font-size: 16px; text-align: center; font-style: normal;
					width:570px">
					<table border="1"  style="border: 2px solid #000;" width="100%" >

						<tr style="border: 2px solid #000;">
							<th width="25%" style="text-align: center;"><?php echo Base_Controller::ToggleLang('Rank');?> </th>
							<th width="25%" style="text-align: center;"><?php echo Base_Controller::ToggleLang('Marks %');?> </th>
							<th width="25%" style="text-align: center;"><?php echo Base_Controller::ToggleLang('G.P.A.');?></th>
							<th width="25%" style="text-align: center;"><?php echo Base_Controller::ToggleLang('Comments');?> </th>
						</tr>
						<?php
							foreach ($grading_system as  $i=>$val){
									$g = explode(', ', $val);
								?>
								<tr>
									<td width="25%"><?php echo $i;?> </td>
									<td width="25%" style="text-align: center;"><?php echo $g[1];?></td>
									<td width="25%"><?php echo $g[2];?> </td>
									<td width="25%"><?php echo $g[0];?> </td>
								</tr>
								<?php
							}
						?>
					</table>
				</div>

				<br>
				<div style="font-family: Bodoni MT', Didot, 'Didot LT STD', 'Hoefler Text', Garamond, 'Times New Roman', serif;
							font-size: 16px; text-align: center; font-style: normal; width:570px;">
					<table border="1"  style="border: 2px solid #000;" width="100%" >
						<tr>
							<th width="50%"  style="text-align: center;"><?php echo Base_Controller::ToggleLang('Number of Weeks');?> </th>
							<th width="50%"  style="text-align: center;"><?php echo '';?> </th>
						</tr>
						<tr>
							<th width="50%"  style="text-align: center;"><?php echo Base_Controller::ToggleLang('Issuance Date');?> </th>
							<th width="50%"  style="text-align: center;"><?php echo ''.date('d-M-Y');?> </th>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
