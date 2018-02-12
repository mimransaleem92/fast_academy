				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th></th>
							<th><?php echo Base_Controller::ToggleLang('ID');?></th>
							<th><?php echo Base_Controller::ToggleLang('Course');?></th>
							<th><?php echo Base_Controller::ToggleLang('Report Title');?></th>
							<th><?php echo Base_Controller::ToggleLang('Marks');?></th>
							<th title='<?php echo Base_Controller::ToggleLang('Period per Week');?>' >P/W</th>
							<th title='<?php echo Base_Controller::ToggleLang('Credit Hours');?>' > C.H</th>
						</tr>
					</thead>
					<tbody>					
						<?php $i=0;
                          if(isset($headers_list) && sizeof($headers_list) > 0){                          	
                          	foreach($headers_list as $values){ $i++; 
	                          	$title = "Update Header info";
	                          	$param = "course_id=".$values->course_id."&sid=".$values->subject_id;
	                          	if(isset($subject_name)) $param .= "&subject_name=". $subject_name;
	                          	$url   = base_url().$model."/edit_header";
                          	?>
	                          <tr>
	                            <!--  <td><a class="btn default btn-xs red-stripe" href="#" onclick="onclick_remove_course_subject('<?php echo $values->course_id."', '".$values->subject_id;?>')">Remove</a></td>-->
	                            <td>
	                            	<span <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \'tbl_subdetail\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i></span>
	                            </td>
	                            <td><?php echo $values->course_id?></td>
	                            <td><strong><?php echo $values->course_name; ?></strong></td>
	                            <td><?php echo $values->marksheet_title?></td>
	                            <td><?php echo $values->marksheet_score?></td>
	                            <td><?php echo $values->period_per_week;?></td>
	                            <td><?php echo $values->credit_hours;?></td>
	                          </tr>
	                  <?php 	}
                          }
                          	?>
	                </tbody>
				</table>