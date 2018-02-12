<div class="col-md-12">
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Assesments');?></div>
			<div class="actions">
				<a href="javascript:;" class="collapse"></a>
				<a class="btn green" href="<?php echo base_url().$model.'/assesment_slip/?student_id='.$form->student_id;?>"><i class="fa fa-print"></i> Print</a>
			</div>
		</div>
		<div class="portlet-body">
			<?php  
			echo form_open('students/add_emergency_detail',array('id'=>'emergencyDetailForm')); $today    = date('Y-m-d');
			?>
			<div class="table-responsive">
				<input type="hidden" name="student_id" id="student_id" value="<?php // echo $form->student_id;?>" />
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th><?php echo Base_Controller::ToggleLang('Exam Group Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Subject');?></th>
							<th><?php echo Base_Controller::ToggleLang('Total Marks');?></th>
							<th><?php echo Base_Controller::ToggleLang('Obtained Marks');?></th>
							<th><?php echo Base_Controller::ToggleLang('Result');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php 
                          if(isset($assesment_list) && sizeof($assesment_list) > 0){
                          	$i=0;
                          	foreach($assesment_list as $values){
                          		$i++;
                          		$class = "frame_blue_light";
                          		if($i%2==0){
                          			$class = "frame_blue_dark";
                          		}
                          		$min_marks = 40;
                          ?>
	                          <tr>
	                            <td><strong><?php echo $values->exam_name; ?></strong></td>
	                            <td><?php echo $values->subject_name; ?></td>
	                            <td><?php echo $values->max_marks; ?></td>
	                            <td class="popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="Total Marks: <?php echo $values->max_marks;?>! and Pass Marks: <?php echo $values->min_marks;?> " data-original-title="Marks Description"><?php echo $values->score_obtained?></td>
	                            <td><?php echo ($values->score_obtained < $values->min_marks) ? 'Failed': 'Passed'?></td>
	                          </tr>
	                  <?php 	}
                          }
                          else{
								echo '<tr><td colspan="5" align="center" style="height:100px; vertical-align:middle">No Exam Details Available!</td></tr>';
						  }	
                          	?>
	                </tbody>
				</table>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
	<!-- END CONDENSED TABLE PORTLET-->
</div>