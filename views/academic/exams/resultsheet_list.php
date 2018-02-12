
				<?php 
				$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : $this->session->userdata(SESSION_CONST_PRE.'subject_id');
				$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
				$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
				$admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false;
				?>
				
				<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
					<tr >
						<th rowspan="2" class="hidden-xs hidden-sm text-center"><input type="checkbox" id="checkall" onclick="setAllCheckOptions()"></th>
						<th rowspan="2" class="text-center" ><?php echo Base_Controller::ToggleLang('No');?></th>
						<th rowspan="2" style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Admission #');?></th>
						<th rowspan="2" style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Student Name');?></th>
						<th colspan="<?php echo sizeof($subject_list)+2;?>" style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Obtain Marks');
							$title = "Update Subject Marks";
							$param = "course_id=".$c."&section=".$sec."&t=".$term;
							$url   = base_url().$model."/update_marks";
						?>
							<span style="float: right;" <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \'tbl_marksheet\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i></span>
						</th>
					</tr>
					<tr style="border-bottom: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
						<?php foreach($subject_list as $sub){ 
									$sid = $sub->subject_id;
									$sel = ($subject_id == $sid) ? 'selected' : '';
								?> 
								<th style="text-align: center;" title="<?php echo $sub->subject_name;?>" ><?php echo $sub->subject_code.'['.$sub->total_marks.']';?></th>
						<?php } ?>
						<th style="text-align: center;" >Total</th>
						<th style="text-align: center;" >%age</th>
					</tr>
					<?php $s=0; $marks_arr = array();
						foreach ($student_list as $student){
							$student_id = $student->student_id;
							$s++;
							$title = "Mark Sheet";
							$param = 'student_id='.$student_id."&course_id=".$c."&section=".$sec."&sid=".$subject_id."&t=".$term;
							$url   = base_url().$model."/add_marks";
							$row_total = $row_obtain = 0;
					?>
					<tr>
						<td class="hidden-xs hidden-sm text-center" ><input type="checkbox" name="selected_id_<?php echo $s;?>" id="selected_id_<?php echo $s;?>" <?php //if($values->status == 'Issued') echo 'disabled="disabled"';?> value="<?php echo $student->student_id;?>" /></td>
						<td class="text-center"><?php echo $s;?></td>
						<td style="padding-left: 4px"><?php echo $student->admission_number;?></td>
						<td style="padding-left: 4px; padding-right: 4px"><?php echo $student->student_name;?></td>
						<?php foreach($subject_list as $sub){ 
									$sid = $sub->subject_id;
									if(isset($marks[$student->student_id][$sid]) && $marks[$student->student_id][$sid] !== 'a' ){
										$row_obtain += $marks[$student->student_id][$sid];
										$row_total += $totals[$sid];
									}
								?> 
								<td style="text-align: center; text-transform: uppercase" ><?php echo isset($marks[$student->student_id][$sid]) ? $marks[$student->student_id][$sid] : '--';?></td>
						<?php } 
							$marks_arr[$student->student_id] = $tt = number_format(($row_obtain / $row_total) * 100, 2);
						?>
						<td style="text-align: center;"><?php echo $row_obtain. ' / ' .$row_total;?></td>
						<td style="text-align: center;"><?php echo $tt;?></td>
					</tr>
					<?php } 
					rsort($marks_arr); $position_arr = array();
					foreach($marks_arr as $id => $marks){
						$position_arr[$marks] = ++$id;
					}
					?>
				</table>
				<input type="hidden" id="count" value="<?php echo $s;?>"/>	 	