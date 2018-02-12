<div class="col-md-12">
	<div class="row">
		<div class="col-md-4" >
			<div class="form-group">
				<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Term');?>:<span class="required">*</span></label>
				<div class="col-md-8" style="padding-bottom: 5px">
					<?php $student = $form; $term_name = 'First'; $t = isset($_POST['term']) ? $_POST['term'] : '1'; ?>
					<select name="term" class="form-control" id="term" onchange="getTermReport(this.value);">
	                	<?php foreach ($term_list as $tr){ ?>
	                		<option value="<?php echo $tr->id;?>" <?php  if(isset($_POST['term']) && ($_POST['term'] == $tr->id)) { echo 'selected'; $term_name = $tr->name;}?>> <?php echo $tr->name;?> </option>
	                	<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-8"></div>
	</div>
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Assesments');?></div>
			<div class="actions">
				<a href="javascript:;" class="collapse"></a>
				<a class="btn green" href="#" onclick="print_report('<?php echo $form->admission_number;?>')"><i class="fa fa-print"></i> Print</a>
			</div>
		</div>
		<div class="portlet-body">
			<?php  
			echo form_open('students/add_emergency_detail',array('id'=>'emergencyDetailForm')); $today    = date('Y-m-d');
			?>
			<div class="table-responsive" id="assesment_detail_div">
				<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
	 				<tr>
	                	<td style="text-align: center; width: 200px;" rowspan="2"><?php echo Base_Controller::ToggleLang('Subject');?></td>
	                	<td style="text-align: center;" rowspan="2"><?php echo Base_Controller::ToggleLang('Subject', 'ar');?></td>
	                	<td align="center">
	                		<?php echo Base_Controller::ToggleLang($term_name.' Term').'<br/>';
	                			  echo Base_Controller::ToggleLang('Exam'); ?>
	                	</td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Homework');?></td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Classwork');?></td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Total');?></td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Credit Hours');?></td>
	                	<td style="text-align: center;" rowspan="2"><?php echo Base_Controller::ToggleLang('GPA');?></td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Grading');?></td>
	                </tr>
	                <tr>
	                	<td align="center"><?php echo Base_Controller::ToggleLang($term_name.' Term', 'ar');?></td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Homework', 'ar');?></td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Classwork', 'ar');?></td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Total', 'ar');?></td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Credit Hours', 'ar');?></td>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Grading', 'ar');?></td>
	                </tr>
	                <?php $total = $total_obtained = $credit_hours = 0;
	                	  $gpa_subject_total = $gpa_subject_count = 0; 
	                	if(isset($subject_list) && sizeof($subject_list)>0){
	                		foreach ($subject_list as $row){
		                		$title = explode(', ', $row->marksheet_title);
		                		$score = explode(', ', $row->marksheet_score);
		                		$subject_total = $row_total = 0;
		                		$homework = 0;
		                		$classwork = 0;
		                		for ($i=0; $i<count($title); $i++){
		                			if(isset($marks[$student->student_id][$row->subject_id][$i])){
		                				
		                				if(!in_array($title[$i],array('HW', 'CW', 'H.W', 'C.W', 'C.W Evaluation'))){
		                					$subject_total += $marks[$student->student_id][$row->subject_id][$i];
		                				}
		                				elseif(in_array($title[$i],array('HW', 'H.W'))){
		                					$homework = $marks[$student->student_id][$row->subject_id][$i];
		                				}
		                				elseif(in_array($title[$i],array('CW', 'C.W', 'C.W Evaluation'))){
		                					$classwork += $marks[$student->student_id][$row->subject_id][$i];
		                				}
		                				
		                				$row_total += $marks[$student->student_id][$row->subject_id][$i];
		                				$total += $score[$i];
	                				}
	                			}
	                			if($row->subject_id <=23){
	                				$gpa_subject_count++;
	                				$gpa_subject_total += $row_total;  
	                			}
	                			$credit_hours += $row->credit_hours;
	                			$total_obtained += $row_total;
	                	?>
	                <tr>
	                	<td align="left" style="padding-left: 4px"><?php echo $row->subject_name;?></td>
	                	<td align="right" style="padding-right: 4px"><?php echo $row->subject_name_arabic;?></td>
	                	
	                	<td align="center"><?php echo $subject_total;?></td>
	                	<td align="center"><?php echo $homework;?></td>
	                	<td align="center"><?php echo $classwork;?></td>
	                	
	                	<td align="center"><?php echo $row_total;?></td>
	                	<td align="center"><?php echo $row->credit_hours;?></td>
	                	<td align="center"><?php echo Util::gpa($row_total);?></td>
	                	<td align="center"><?php echo Util::get_grade($row_total);?></td>
	                </tr>
	                <?php }
	                	} 
	                	$total_gpa = 0;
	                	if($gpa_subject_count > 0) {
	                		$total_gpa = $gpa_subject_total / $gpa_subject_count;
	                	}
	                ?>
	                <tr>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Obtained Marks');?></td>
	                	<td></td>
	                	
	                	<td align="center"></td>
	                	<td align="center"></td>
	                	<td align="center"></td>
	                	
	                	<td align="center"><?php echo number_format($total_obtained, 2);?></td>
	                	<td align="center"><?php echo number_format($credit_hours, 2);?></td>
	                	<td align="center" rowspan="2"><?php echo 'GPA';?></td>
	                	<td align="center"><?php echo Util::gpa($total_gpa);?></td>
	                </tr>
	                <tr>
	                	<td align="center"><?php echo Base_Controller::ToggleLang('Total');?></td>
	                	<td></td>
	                	
	                	<td align="center"></td>
	                	<td align="center"></td>
	                	<td align="center"></td>
	                	
	                	<td align="center"><?php echo $total;?></td>
	                	<td align="center"><?php echo number_format($total_gpa, 2);?></td>
	                	<!-- <td align="center" rowspan="2"> GPA</td> -->
	                	<td align="center"><?php echo Util::get_grade($total_gpa);?></td>
	                </tr>	
            	</table>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
	<!-- END CONDENSED TABLE PORTLET-->
</div>