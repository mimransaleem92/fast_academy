<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php echo Base_Controller::ToggleLang('Admission Form');?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="MobileOptimized" content="320">
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>

	<link rel="shortcut icon" href="favicon.ico" />
	<style media="print" type="text/css">
		body {
		  -webkit-print-color-adjust: exact;
		}
	</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<?php 
	$background_image = base_url()."assets/images/dns_form.jpg";
	$logo_image = base_url()."assets/images/logo_dns.png";
	$tbl_header = '#E46C0B';
	$tbl_header_text = '#CD2C1A';

	
	$header_color = '#E46C0B';
	$header_text_color = '#CD2C1A';
	$tbl_head_bgcolor = '#FAC090';
?>
<body>
<div class="col-md-12" style="padding-left: 0px;">
	<div style="width:820px;  font-size: 10px;">
		<div style="height: 70px; padding-top: 3px; background-color: #CDC6B6 !important; text-align: center;" >
			<!--  <img src="<?php echo $background_image;?>" alt="DIS Logo" style="width:800px"/>-->
			<img src="<?php echo $logo_image;?>" alt="Site Logo" style="width:70px"/>
			<table border="0" width="100%" style="margin-top: -70px; font-family: 'Sans serif', Tahoma; color: #FFF;" >
				<thead>
					<tr>
						<td width="20%"> </td>
						<td width="40%"style="text-align: center; font-size: 22px"> <?php echo Base_Controller::ToggleLang(APP_TITLE);?></td>
						<td width="40%"style="text-align: center; font-size: 18px"> <?php //echo Base_Controller::ToggleLang(APP_TITLE, 'ar');?></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align: center; font-size: 11px"> <?php echo Base_Controller::ToggleLang('International Curriculums');?></td>
						<td width="20%"> </td>
						<td style="text-align: center; font-size: 12px"> <?php echo Base_Controller::ToggleLang('International Curriculums', 'ar');?></td>
					</tr>
				</tbody>	
			</table>
		</div>
		<div style="margin-top:5px ;height: 5px; background-color: #F9ED10 !important" >&nbsp;</div>
		<div style="padding-top:14px; width:820px;  text-align:center; font-size: 18px; vertical-align: bottom;"><?php echo Base_Controller::ToggleLang('Admission Form').'/'.Base_Controller::ToggleLang('Admission Form','ar');?></div>
		
		<div style="font-family: Calibri; padding: 10px; border-radius: 25px; border: 2px solid <?php echo $tbl_header;?>; background-color: #DBDBDB !important;" >
			<table width="800px" style="border:1px solid <?php echo $tbl_header;?>; border-collapse:collapse; font-size: 12px;table-layout: fixed;">
				<thead>
					<tr style="background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 16px; color: <?php echo $tbl_header_text;?>;" >
						<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('students information');?></th>
		            	<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('students information', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $tbl_header;?>; background-color: #FFF !important">
				<?php
	            	$i=0; 
	            	$fields_student = array('admission_number','student_name', 'father_name', 'age', 'gender', 'date_of_birth', 'nationality', 'iqama_id', 'iqama_expiry', 'passport_id', 'passport_expiry', 'enrollment_date', 'enrollment_grade_level', 'previous_school', 'batch_name', 'address_line1', 'emergency_contact');
	            	$fields_father  = array();
	            	$fields_mother  = array('mother_name');
	            	if(isset($form) && sizeof($form)>0){
	            		$form = $form[0];
	            		foreach ($fields_student as $row){ $i++;
	            			$value = $value2 = '';
	            			if($row == 'age' && !is_null($form->date_of_birth) && $form->date_of_birth != '0000-00-00'){
	            				$value = Util::ageCalculator($form->date_of_birth);
							}else if($row != 'age'){
								$value = $form->$row;
								if (strpos($row, 'date') !== false || strpos($row, 'expiry') !== false){
									$value = Util::displayFormat($value);
								}elseif($row == 'student_name'){
									$value2 = $form->student_name_ar;
								}elseif($row == 'nationality'){
									$value = $country_list[$form->nationality];
								}elseif($row == 'enrollment_grade_level'){
									$value = (empty($value)) ? $form->course_name . ' ' . $form->section : $value;
								}
							}
							//$value = !empty($value) ? $value : $row;
							?>
		            	<tr id="row_<?php echo $i;?>" height='20px'>
			                <td style="padding-left: 4px; border:1px solid <?php echo $tbl_header;?>;font-size: 13px; font-weight: bold;" width='25%' valign="top"><?php echo Base_Controller::ToggleLang($row);?></td>
							<td style="padding-left: 4px; border:1px solid <?php echo $tbl_header;?>;" width='25%'><?php echo $value;?></td>
							<td style="direction: rtl;border:1px solid <?php echo $tbl_header;?>; text-align: right;" width='20%' valign="top"><?php echo $value2;?></td>
							<td style="direction: rtl;border:1px solid <?php echo $tbl_header;?>; text-align: right;font-size: 14px; font-weight: bold;" width='30%' valign="top"><?php echo Base_Controller::ToggleLang($row, 'ar');?></td>
		                </tr>
	                <?php }
	            	} ?>
				</tbody>
			</table>
			
			<table width="800px" style="margin-top: 5px; border:1px solid <?php echo $tbl_header;?>; border-collapse:collapse; font-size: 12px; table-layout: fixed;">
				<thead>
					<tr style="5px; background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 16px; color:<?php echo $tbl_header_text;?>;" >
						<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('Guardian Information');?></th>
		            	<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('Guardian Information', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $tbl_header;?>; background-color: #FFF !important">
				<?php
	            	$i=0; 
	            	if(isset($form) && sizeof($form)>0){
	            		foreach ($fields_father as $row){ $i++;
	            			$value = $value2 = '';
	            			if($row == 'age' && !is_null($form->date_of_birth) && $form->date_of_birth != '0000-00-00'){
	            				$value = Util::ageCalculator($form->date_of_birth);
							}else if($row != 'age'){
								$value = $form->$row;
								if (strpos($row, 'date') !== false || strpos($row, 'expiry') !== false){
									$value = Util::displayFormat($value);
								}elseif($row == 'student_name'){
									$value2 = $form->student_name_ar;
								}
							}
							//$value = !empty($value) ? $value : $row;
							?>
		            	<tr id="row_<?php echo $i;?>" height='20px'>
			                <td style="padding-left: 4px; border:1px solid <?php echo $tbl_header;?>;font-size: 13px; font-weight: bold;" width='25%' valign="top"><?php echo Base_Controller::ToggleLang($row);?></td>
							<td style="padding-left: 4px; border:1px solid <?php echo $tbl_header;?>; max-width: 25%; overflow: hidden;" width='25%' ><?php echo $value;?></td>
							<td style="direction: rtl;border:1px solid <?php echo $tbl_header;?>; text-align: right;" width='20%' valign="top"><?php echo $value2;?></td>
							<td style="direction: rtl;padding-right: 4px; border:1px solid <?php echo $tbl_header;?>; text-align: right;font-size: 14px; font-weight: bold;" width='30%' valign="top"><?php echo Base_Controller::ToggleLang($row, 'ar');?></td>
		                </tr>
	                <?php }
	            	} ?>
				</tbody>
			</table>
			<!-- <table width="800px" style="margin-top: 5px; border:1px solid <?php echo $tbl_header;?>; border-collapse:collapse; font-size: 12px;table-layout: fixed;">
				<thead>
					<tr style="background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 16px; color:<?php echo $tbl_header_text;?>;" >
						<th style="padding-left: 4px;" ><?php echo Base_Controller::ToggleLang('school policy');?></th>
		            	<th style="padding-right: 4px; text-align: right" ><?php echo Base_Controller::ToggleLang('school policy', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $tbl_header;?>; background-color: #FFF !important">
					<tr height='50px'>
			        	<td style="padding-left: 4px; border:1px solid <?php echo $tbl_header;?>;font-size: 11px;" width='25%' valign="top"><?php echo Base_Controller::ToggleLang('policy_text').Base_Controller::ToggleLang('school policy2');?><br><br><br></td>
						<td style="direction: rtl;border:1px solid <?php echo $tbl_header;?>; text-align: right; font-size: 11px; " width='30%' valign="top"><?php echo Base_Controller::ToggleLang('policy_text', 'ar').Base_Controller::ToggleLang('school policy2', 'ar');?><br><br><br></td>
	                </tr>
				</tbody>
			</table> -->
			
			<table width="800px" style="margin-top:10px; border:1px solid <?php echo $tbl_header;?>; border-collapse:collapse; font-size: 12px;">
			  	<tr height="29px"> 
		       		<th style="border:1px solid <?php echo $tbl_header;?>; font-weight: bold; text-align: center; color: red;" colspan="3" valign="top"><?php echo '';?>
		       			<span style="font-size: 14px;"><?php echo Base_Controller::ToggleLang('confirmation note', 'ar').'<br/>';?></span>
						<span style="font-size: 13px;"><?php echo Base_Controller::ToggleLang('confirmation note');?></span>
		       		</th>
		       	</tr>	
			  	<tr height="29px" style="background-color: #FFF !important"> 
		       		<th style="border:1px solid <?php echo $tbl_header;?>; text-align: center" width="25%" valign="top"><?php echo date('d M, Y');?></th>
		       		<th style="border:1px solid <?php echo $tbl_header;?>; text-align: center" width="25%" valign="top"><?php echo '';?></th>
		       		<th style="border:1px solid <?php echo $tbl_header;?>; text-align: center" width="25%" valign="top"><?php echo '';?></th>
		       	</tr>
			  	<tr height="20px" style="background-color: #FFF !important"> 
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Parents Full Name').' '.Base_Controller::ToggleLang('Parents Full Name', 'ar');?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Signature').' '.Base_Controller::ToggleLang('Signature', 'ar');?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Date').' '.Base_Controller::ToggleLang('Date', 'ar');?></th>
		       	</tr>
			</table>
		</div>
	</div>
</div>
<script>
 window.print(); 
</script>
</body>
</html>