									<table width="100%" cellspacing="0" cellpadding="0" style="cursor:pointer; border: 1px solid #8CBAE8; background-color: #FFFFFF">
				                        <?php 
				                  			if(isset($ct_list) && sizeof($ct_list)==0){
				                  				echo '<tr><td style="border-right:1px solid #8CBAE8; border-bottom:1px solid #8CBAE8; padding:4px; text-align:center; text-transform:uppercase;"> Class timing not defined!! </td></tr>';
				                  			}
				                  			else
				                  			{
					                        	$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
					                  			$i=0;
					                  			if(isset($weekday_list) && sizeof($weekday_list) > 0){
					                  				$subject_employee = array();
					                  				foreach ($subject_employee_list as $values){
					                  					$index = $values->weekday.$values->course_id.'-'.$values->batch_id.'-'.$values->id;
					                  					$subject_employee[$index] = '<u>'.$values->subject_name.'</u><br>'.$values->employee_name;
					                  				}
					                  			
					                  				$class = 'style="border-right:1px solid #000; border-bottom:1px solid #000; padding:4px; text-align:center; text-transform:uppercase;"';
					                  				echo '<tr><td '.$class.' width="140px"><b>Time</b></td>';
					                  				/* foreach($ct_list as $ctime){
					                  				 $class_time_from = strftime('%I:%M %p', strtotime($ctime->start_time));
					                  				 $class_time_to   = strftime('%I:%M %p', strtotime($ctime->end_time));
					                  				 echo '<td '.$class.'><b>'.$class_time_from.'-'.$class_time_to.'</b></td>';
					                  				 } */
					                  				$weekdays = $weekday_list[0]; $colspan = 0;
					                  				foreach($days as $d){
					                  					if($weekdays->$d == 'on'){
					                  						$colspan++;
					                  						echo '<td '.$class.' ><b>'.substr($d, 0, 3).'</b></td>';
					                  					}
					                  				}
					                  				echo '</tr>';
					                  			
					                  				$title = "Timetable for the selected batch";
					                  				$i++;
					                  				foreach($ct_list as $ctime){
					                  					$class_time_from = strftime('%I:%M %p', strtotime($ctime->start_time));
					                  					$class_time_to   = strftime('%I:%M %p', strtotime($ctime->end_time));
					                  					echo '<tr><td '.$class.'><b>'.$class_time_from.'-'.$class_time_to.'</b></td>';
					                  					if($ctime->is_break == 'Yes'){
					                  						$class_text = (!empty($ctime->break_text)) ? $ctime->break_text : 'Break';
					                  						echo '<td '.$class.' height=50px colspan="'.$colspan.'" >'.
					                  								$class_text.'</td>';
					                  						continue;
					                  					}
					                  					foreach($days as $d){
					                  						if($weekdays->$d == 'on'){
					                  							$cell_id = $ctime->course_id.'-'.$ctime->batch_id.'-'.$ctime->id;
					                  							$tooltip = "";
					                  							$param = 'weekday='.$d."&class_id=".$cell_id;
					                  							$url   = base_url().$model."/add_subject_teacher/".$ctime->course_id;
					                  							$class_text= '<span style="color: blue;">Assign</span>';//$ctime->start_time.'-'.$ctime->end_time;
					                  							 
					                  							$curr_index = $d.$cell_id;
					                  							if(isset($subject_employee[$curr_index])){
					                  								$class_text = $subject_employee[$curr_index];
					                  								echo '<td '.$class.' height=50px onclick="onclick_remove_sub_emp(\''.$d.'-'.$cell_id.'\')" >'.
					                  										$class_text.'</td>';
					                  							}
					                  							else{
					                  								echo '<td '.$class.' height=50px onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.'\')" >'.
					                  										$class_text.'</td>';
					                  							}
					                  						}
					                  					}
					                  				}
					                  				echo '</tr>';
					                  			
					                  			}
					                  			else{
					                  				echo '<tr><td style="border-right:1px solid #8CBAE8; border-bottom:1px solid #8CBAE8; padding:4px; text-align:center; text-transform:uppercase;">'.Base_Controller::ToggleLang('Please select course and batch').'!! </td></tr>';
					                  			}
				                  			}
				                          	?>
					                </table>
