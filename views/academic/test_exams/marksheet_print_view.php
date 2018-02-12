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
							<td style="text-align: center; font-size: 14px;"> <?php echo 'Subject: '.$subject->subject_name.' & Total Marks:'.$subject_total;?> </td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="height: 130px; margin-top: 0px;" >
								<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
					 				<?php 
					 					$colspan = count($header_title);
					 					if($col_average == 'Y') $colspan++;
					 					if($col_total == 'Y') $colspan++;
					 					
					 					foreach ($term_list as $t){ 
					 						if(isset($_GET['term']) && ($_GET['term'] == $t->id)) { 
					 							$term_name =  $t->name;
					 						}
					 					}						                	
					 				?>
					                <tr style="border-bottom: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
										<th ><?php echo Base_Controller::ToggleLang('No');?></th>
										<th style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Admission #');?></th>
										<th style="padding-left: 4px" ><?php echo Base_Controller::ToggleLang('Student Name');?></th>
										<th style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Obtain Marks');?></th>
									</tr>	
									
									<?php $s=0;
										foreach ($student_list as $student){
											$student_id = $student->student_id;
											$s++;
											$title = "Mark Sheet";
											$param = 'student_id='.$student_id."&course_id=".$c."&section=".$sec."&sid=".$subject_id."&t=".$term;
											$url   = base_url().$model."/add_marks";
									?>
									<tr>
										<td><?php echo $s;?></td>
										<td style="padding-left: 4px"><?php echo $student->admission_number;?></td>
										<td style="padding-left: 4px; padding-right: 4px"><?php echo $student->student_name;?>
											<span style="float: right; padding-right: 10px;"><?php echo $student->student_name_ar;?></span>
										</td>
										<td class="text-center" style="text-transform: uppercase"><?php echo $student->obtained_marks;?>
									</tr>
									<?php } ?>
				            	</table>
		</div>				            	
	</div>
</body>
</html>
<script>
window.print();
</script>