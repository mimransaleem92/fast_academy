<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<div class="col-md-12">
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue" style="width:80%">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Marks Sheet');?></div>
			
		</div>
		<div class="portlet-body" >
			<div class="table-responsive" >
			<?php $form = $student[0]; ?>
			    
				<table class="table table-condensed">
					<tbody>
						<tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Student Name').": ".$form->student_name;?></td>
					       	<td>	<?php echo '';?></td>
				       		
				       		
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Exam Name').": ";?></td>
				       		<td align="right" style="padding-right: 100"><?php echo 'Print Date: '. date('d, M Y H:i');?></td>
				       		
				       </tr>
				       <tr> 
				       		<td colspan="2" style="padding-left: 100; padding-right: 100">
				       			Marks Detail
				       			<table class="table table-condensed col-md-9">
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
				                          	$i=0;$total = 0;$total_max = 0;
				                          	foreach($assesment_list as $values){
				                          		$i++;
				                          		$class = "frame_blue_light";
				                          		if($i%2==0){
				                          			$class = "frame_blue_dark";
				                          		}
				                          		$min_marks = 40;
				                          		$total_max += $values->max_marks;
				                          ?>
					                          <tr>
					                            <td><strong><?php echo $values->exam_name; ?></strong></td>
					                            <td><?php echo $values->subject_name; ?></td>
					                            <td><?php echo $values->max_marks; ?></td>
					                            <td class="popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="Total Marks: <?php echo $values->max_marks;?>! and Pass Marks: <?php echo $values->min_marks;?> " data-original-title="Marks Description"><?php $total += $values->score_obtained; echo $values->score_obtained;?></td>
					                            <td><?php echo ($values->score_obtained < $values->min_marks) ? 'Failed': 'Passed'?></td>
					                          </tr>
					                  	<?php } ?>
					        			  <tr>				                          	
				                          	<td colspan="2" ><?php echo Base_Controller::ToggleLang('Total Marks ').': ';?></td>
								       		<td><?php echo number_format($total_max, 2);?></td>
								       		<td ><span id="payment_amount" ><?php echo number_format($total, 2);?></span>
								       			<input type="hidden" class="form-control right" id="print_date" name="print_date" value='<?php echo date('Y-m-d');?>' />
							       				<input type="hidden" class="form-control" id="student_id" name="student_id" value='<?php echo $_GET['student_id'];?>' />
								       		</td>
								       		<td><?php $percent = $total/$total_max; echo number_format($percent, 2) * 100 . "%";?></td>
				                          </tr>          
					                  	<?php }
				                          else{
												echo '<tr><td colspan="5" align="center" style="height:100px; vertical-align:middle">No Exam Details Available!</td></tr>';
										  }	
				                          	?>
				                          
					                </tbody>
								</table>
				       		</td>
				       </tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>window.print();</script>