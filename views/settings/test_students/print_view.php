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
	$background_image = base_url()."assets/images/dis_form.jpg";
	$logo_image = base_url()."assets/images/logo_left.png";
?>
<body>
<div class="col-md-12" style="padding-left: 0px;">
	<div style="width:820px;  font-size: 10px;">
		<div style="height: 70px; padding-top: 20px; background-color: #E36E21 !important; text-align: center;" >
			<img src="<?php echo $logo_image;?>" alt="DIS Logo" style="width:70px"/>
			
		</div>
		<div style="height: 5px; background-color: #8E9088 !important" >&nbsp;</div>
		<div style="padding-top:14px; width:820px;  text-align:center; font-size: 18px; vertical-align: bottom;"><?php echo 'Admission Form';?></div>
		
		<div style="padding: 10px; border-radius: 25px; border: 2px solid #CC7926; background-color: #EDE4E0 !important;" >
			<table width="800px" style="border:1px solid #CC7926; border-collapse:collapse; font-size: 12px;table-layout: fixed;">
				<thead>
					<tr style="5px; background-color: #EFCA82 !important; font-size: 16px; color:#CC7926;" >
						<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('students information');?></th>
		            	<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('students information', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid #CC7926; background-color: #FFF !important">
				<?php
	            	$i=0; 
	            	$fields_student = array('admission_number','student_name', 'age', 'gender', 'date_of_birth', 'nationality', 'iqama_id', 'iqama_expiry', 'passport_id', 'passport_expiry', 'enrollment_date', 'enrollment_grade_level', 'previous_school', 'batch_name', 'address_line1', 'emergency_contact');
	            	$fields_father  = array('father_name', 'occupation_father', 'work_place_father', 'cell_phone_father', 'email_father', 'id_number_father', 'iqama_expiry_father', 'passport_father', 'passport_expiry_father');
	            	$fields_mother  = array('mother_name', 'occupation_mother', 'work_place_mother', 'cell_phone_mother', 'email_mother', 'id_number_mother', 'iqama_expiry_mother', 'passport_mother', 'passport_expiry_mother');
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
			                <td style="padding-left: 4px; border:1px solid #CC7926;font-size: 13px; font-weight: bold;" width='25%' valign="top"><?php echo Base_Controller::ToggleLang($row);?></td>
							<td style="padding-left: 4px; border:1px solid #CC7926;" width='25%'><?php echo $value;?></td>
							<td style="direction: rtl; border:1px solid #CC7926; text-align: right;" width='20%' valign="top"><?php echo $value2;?></td>
							<td style="direction: rtl; border:1px solid #CC7926; text-align: right;font-size: 14px; font-weight: bold;" width='30%' valign="top"><?php echo Base_Controller::ToggleLang($row, 'ar');?></td>
		                </tr>
	                <?php }
	            	} ?>
				</tbody>
			</table>
			<table width="800px" style="margin-top: 5px; border:1px solid #CC7926; border-collapse:collapse; font-size: 12px;">
				<thead>
					<tr style="5px; background-color: #EFCA82 !important; font-size: 16px; color:#CC7926;" >
						<th style="text-align: center; width: 50%;"><?php echo Base_Controller::ToggleLang('parents details');?></th>
		            	<th style="text-align: center" ><?php echo Base_Controller::ToggleLang('parents details', 'ar');?></th>
					</tr>
				</thead>
			</table>
			
			<table width="800px" style="margin-top: 5px; border:1px solid #CC7926; border-collapse:collapse; font-size: 12px; table-layout: fixed;">
				<thead>
					<tr style="5px; background-color: #EFCA82 !important; font-size: 16px; color:#CC7926;" >
						<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('father information');?></th>
		            	<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('father information', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid #CC7926; background-color: #FFF !important">
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
			                <td style="padding-left: 4px; border:1px solid #CC7926;font-size: 13px; font-weight: bold;" width='25%' valign="top"><?php echo Base_Controller::ToggleLang($row);?></td>
							<td style="padding-left: 4px; border:1px solid #CC7926; max-width: 25%; overflow: hidden;" width='25%' ><?php echo $value;?></td>
							<td style="direction: rtl; border:1px solid #CC7926; text-align: right;" width='20%' valign="top"><?php echo $value2;?></td>
							<td style="direction: rtl; padding-right: 4px; border:1px solid #CC7926; text-align: right;font-size: 14px; font-weight: bold;" width='30%' valign="top"><?php echo Base_Controller::ToggleLang($row, 'ar');?></td>
		                </tr>
	                <?php }
	            	} ?>
				</tbody>
			</table>
			<table width="800px" style="margin-top: 5px; border:1px solid #CC7926; border-collapse:collapse; font-size: 12px;table-layout: fixed;">
				<thead>
					<tr style="5px; background-color: #EFCA82 !important; font-size: 16px; color:#CC7926;" >
						<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('mother information');?></th>
		            	<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('mother information', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid #CC7926; background-color: #FFF !important">
				<?php
	            	$i=0; 
	            	if(isset($form) && sizeof($form)>0){
	            		foreach ($fields_mother as $row){ $i++;
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
			                <td style="padding-left: 4px; border:1px solid #CC7926;font-size: 13px; font-weight: bold;" width='25%' valign="top"><?php echo Base_Controller::ToggleLang($row);?></td>
							<td style="padding-left: 4px; border:1px solid #CC7926;" width='25%'><?php echo $value;?></td>
							<td style="direction: rtl; border:1px solid #CC7926; text-align: right;" width='20%' valign="top"><?php echo $value2;?></td>
							<td style="direction: rtl; border:1px solid #CC7926; text-align: right; font-size: 14px; font-weight: bold;" width='30%' valign="top"><?php echo Base_Controller::ToggleLang($row, 'ar');?></td>
		                </tr>
	                <?php }
	            	} ?>
				</tbody>
			</table>
			
			<div style="height: 45px; padding-top: 5px; text-align: center; font-size: 13px; font-weight: bold;" >
				<?php echo Base_Controller::ToggleLang('confirmation note').'<br/>';?>
				<span style="font-size: 14px; font-weight: bold;"><?php echo Base_Controller::ToggleLang('confirmation note', 'ar');?></span>
			</div>
			
			<table width="800px" style="margin-top:10px; border:1px solid #CC7926; border-collapse:collapse; font-size: 12px;">
			  	<tr height="29px"> 
		       		<th style="border:1px solid #CC7926; text-align: center" width="25%" valign="top"><?php echo '';?></th>
		       		<th style="border:1px solid #CC7926; text-align: center" width="25%" valign="top"><?php echo '';?></th>
		       		<th style="border:1px solid #CC7926; text-align: center" width="25%" valign="top"><?php echo date('d M, Y');?></th>
		       	</tr>
			  	<tr height="20px"> 
		       		<th style="border:1px solid #CC7926; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Parents Full Name');?></th>
		       		<th style="border:1px solid #CC7926; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Signature');?></th>
		       		<th style="border:1px solid #CC7926; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Date');?></th>
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