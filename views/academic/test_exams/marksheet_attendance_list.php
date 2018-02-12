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
	<div class="col-md-12" style="width:820px;">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div style="width:380px; height: 80px; margin-top: 0px;" >
				<?php $address_line1 = $address_line2 = '';
				$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
				$c = $course ;
				$sec = isset($_GET['section']) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
				$background_image = base_url()."assets/images/fast_logo.png";
				$school_title = ($div_id == '1') ? APP_TITLE.' Boys' : APP_TITLE.' Girls';
				
				foreach($courses_list as $course){
					$course_id = $course->course_id;
					$course_name[$course_id] = $course->course_name;
				}
				
				foreach($subject_list as $sub){
					$sid = $sub->subject_id;
					if(isset($_GET['subject_id']) && $_GET['subject_id'] == $sid){ $subject_name = $sub->subject_name; break;}
				}
				?>
				<img src="<?php echo $background_image;?>" width="100px" alt="Web Serve"/>
				<table border="0" width="100%" style="margin-top: -55px; font-family: 'Times New Roman', Times, serif;" >
					<thead>
						<tr>
							<td width="27%"></td>
							<td width="73%" style="text-align: center; font-weight: bold; text-transform: uppercase; font-size: 11px;"> <?php //echo $school_title;?> </td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="27%"></td>
							<td width="73%" style="text-align: center; font-weight: bold; text-transform: uppercase; font-size: 11px;"> <?php echo $school_title;?> </td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align: center; font-size: 14px;"> <?php echo 'Attendance / Marksheet - Class: '.$course_name[$c];?> </td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align: center; font-size: 14px;"> <?php echo 'Subject: '.$subject->subject_name.' & Total Marks:_____';?> </td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="width:380px; margin-top: 0px;" >
				<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000; font-size: 13px;">
					<tr style="border-bottom: 2px solid #000; width: 100%; height: 28px; background-color: #FFF; color: #000;">
						<th ><?php echo Base_Controller::ToggleLang('No');?></th>
						<th style="padding-left: 4px; width: 90px" ><?php echo Base_Controller::ToggleLang('Admission #');?></th>
						<th style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Student Name');?></th>
						<th style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Signature');?></th>
						<th style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Marks');?></th>
					</tr>	
					<?php 
						for ($s=0; $s < 30 ;$s++){
							$student = $student_list[$s];
							$student_id = $student->student_id;
					?>
					<tr style="height: 28px;">
						<td style="text-align: center;"><?php echo $s+1;?></td>
						<td style="padding-left: 4px;"><?php echo $student->admission_number;?></td>
						<td style="padding-left: 4px; padding-right: 4px"><?php echo $student->student_name?></td>
						<td></td>
						<td></td>
					</tr>
					<?php } ?>
				</table>
				<br><br>
				<table border="0" style="width: 100%; background-color: #FFF; color: #000; font-size: 13px;">
					<tr style="width: 100%; height: 28px; background-color: #FFF; color: #000;">
						<th ><?php echo Base_Controller::ToggleLang('Date');?>:</th>
						<th style="padding-left: 4px; width: 90px" ><?php echo date('d/m/Y');?></th>
						<th style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Teacher');?>:</th>
						<th style="text-align: center;" >______________________</th>
						<th style="text-align: center;" ><?php echo 'PRINCIPAL';?></th>
					</tr>
				</table>
				<br>
			</div>
		</div>	
		<div class="col-md-6 col-sm-6 col-xs-6">	
			<div style="width:380px; height: 80px; margin-top: 0px; " >
				<img src="<?php echo $background_image;?>" width="100px" alt="Web Serve"/>
				<table border="0" width="100%" style="margin-top: -55px; font-family: 'Times New Roman', Times, serif;" >
					<thead>
						<tr>
							<th width="20%"></th>
							<th width="80%" style="text-align: center;"> <?php //echo $school_title;?> </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="27%"></td>
							<td width="73%" style="text-align: center; font-weight: bold; text-transform: uppercase; font-size: 11px;"> <?php echo $school_title;?> </td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align: center; font-size: 14px;"> <?php echo 'Attendance / Marksheet - Class: '.$course_name[$course10];?> </td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align: center; font-size: 14px;"> <?php echo 'Subject: '.$subject->subject_name.' & Total Marks:_____';?> </td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="width:380px; margin-top: 0px;" >
			<?php if(sizeof($student_list) > 30){ ?>
				<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000; font-size: 13px;">
					
					<tr style="border-bottom: 2px solid #000; width: 100%; height: 28px; background-color: #FFF; color: #000;">
						<th ><?php echo Base_Controller::ToggleLang('No');?></th>
						<th style="padding-left: 4px; width: 90px" ><?php echo Base_Controller::ToggleLang('Admission #');?></th>
						<th style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Student Name');?></th>
						<th style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Signature');?></th>
						<th style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Marks');?></th>
					</tr>	
					
					<?php 
						for ($s=30; $s < sizeof($student_list) ;$s++){
							$student = $student_list[$s];
							$student_id = $student->student_id;
							
					?>
					<tr style="height: 28px;">
						<td style="text-align: center;"><?php echo $s+1;?></td>
						<td style="padding-left: 4px;"><?php echo $student->admission_number;?></td>
						<td style="padding-left: 4px; padding-right: 4px"><?php echo $student->student_name;?></td>
						<td></td>
						<td></td>
					</tr>
					<?php }?>
				</table>
				<?php }else if(sizeof($student_list10) > 0 && sizeof($student_list10) <= 30){?>			
				<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000; font-size: 13px;">
					
					<tr style="border-bottom: 2px solid #000; width: 100%; height: 28px; background-color: #FFF; color: #000;">
						<th ><?php echo Base_Controller::ToggleLang('No');?></th>
						<th style="padding-left: 4px; width: 90px" ><?php echo Base_Controller::ToggleLang('Admission #');?></th>
						<th style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Student Name');?></th>
						<th style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Signature');?></th>
						<th style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Marks');?></th>
					</tr>	
					
					<?php 
						for ($s=0; $s < 30 ;$s++){
							$student = $student_list10[$s];
							$student_id = $student->student_id;
					?>
					<tr style="height: 28px;">
						<td style="text-align: center;"><?php echo $s+1;?></td>
						<td style="padding-left: 4px;"><?php echo $student->admission_number;?></td>
						<td style="padding-left: 4px; padding-right: 4px"><?php echo $student->student_name;?></td>
						<td></td>
						<td></td>
					</tr>
					<?php }?>
				</table>
				<?php }?>
			</div>
		</div>
	</div>
</body>
</html>
<script>
//window.print();
</script>