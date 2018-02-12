<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php echo APP_TITLE; ?></title>
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
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
		<div style="width:820px;">
			<?php $address_line1 = $address_line2 = '';
			$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			if($div_id == '1'){
				$background_image = base_url()."assets/images/dns_header.png";
				$school_title = APP_TITLE.' Boys';
			}	
			else {
				$background_image = base_url()."assets/images/dis_header.png";
				$school_title = APP_TITLE.' Girls';
			}
			
			$c = isset($_GET['course_id']) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
			$sec = isset($_GET['section']) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
			
			foreach($courses_list as $course){
				$course_id = $course->course_id;
				if($course_id ==  $c) { $course_name = $course->course_name; break;}
			}
			
			foreach($subject_list as $sub){
				$sid = $sub->subject_id;
				if(isset($_GET['subject_id']) && $_GET['subject_id'] == $sid){ $subject_name = $sub->subject_name; break;}
			}
			$arr_m = array('--','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
			?>
			<div style="height: 100px; padding-top: 10px;" >
				<img src="<?php echo $background_image;?>" alt="Web Serve"/>
				<table border="0" width="100%" style="margin-top: -70px; font-family: 'Times New Roman', Times, serif;" >
					<thead>
						<tr>
							<th width="8%"></th>
							<th width="80%" style="text-align: center;"> <?php echo $school_title;?> </th>
							<th width="12%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td style="text-align: center; font-size: 14px;"> <?php echo $course_name. ' '. $sec;?> </td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align: center; font-size: 14px;"> <?php echo 'Test for the month: '.$arr_m[$_GET['term']];?> </td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="height: 130px; margin-top: 0px;" >
			<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
				<tr style="border-bottom: 2px solid #000; width: 100%; background-color: #FFF; color: #000;" >
					<th rowspan="2" class="text-center" ><?php echo Base_Controller::ToggleLang('No');?></th>
					<th rowspan="2" style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Admission #');?></th>
					<th rowspan="2" style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Student Name');?></th>
					<th colspan="<?php echo sizeof($subject_list)+2;?>" style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Obtain Marks');?></th>
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
					<?php } $marks_arr[$student->student_id] = $tt = number_format(($row_obtain / $row_total) * 100, 2);?>
					<td style="text-align: center;"><?php echo $row_obtain. ' / ' .$row_total;?></td>
					<td style="text-align: center;" id="<?php echo 'res'.$s;?>"><?php echo $tt;?></td>
				</tr>
				<?php }
					rsort($marks_arr); $position_arr = array(); $i = 0;
					foreach($marks_arr as $id => $marks){
						$position_arr[] = $marks; $i++;
						if($i == 3) break;
					}
					?>
			</table>
			<input type="hidden" id="count" value="<?php echo $s;?>"/>
		</div>				            	
	</div>
</body>
</html>
<script>
var top_arr = [<?php echo implode(",",$position_arr);?>];
count = document.getElementById('count').value;		
for(i=1; i<=count; i++){
	
	if(document.getElementById('res'+i))
	for(s=0; s<3; s++){
		if(document.getElementById('res'+i).innerHTML == top_arr[0]){
			
			document.getElementById('res'+i).innerHTML = '<b>'+top_arr[0]+'</b>';
		}
		else if(document.getElementById('res'+i).innerHTML == top_arr[1]){
			document.getElementById('res'+i).innerHTML = '<b>'+top_arr[1]+'</b>';
		}
		else if(document.getElementById('res'+i).innerHTML == top_arr[2]){
			document.getElementById('res'+i).innerHTML = '<b>'+top_arr[2]+'</b>';
		}
	}
}
window.print();
</script>