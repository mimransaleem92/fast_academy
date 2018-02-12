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
	$header_color = '#E46C0B';
	$header_text_color = '#CD2C1A';
	$tbl_head_bgcolor = '#FAC090';
?>
<body>
<div class="col-md-12" style="padding-left: 0px;">
	<div style="width:820px;  font-size: 10px;">
		<div style="height: 70px; padding-top: 20px; background-color: <?php echo $header_color;?> !important; text-align: center;" >
			
			<img src="<?php echo $logo_image;?>" alt="DIS Logo" style="width:70px"/>
			
		</div>
		<div style="height: 5px; background-color: #8E9088 !important" >&nbsp;</div>
		<div style="padding-top:14px; font-family: Calibri; width:820px;  text-align:center; font-size: 18px; vertical-align: bottom;"><?php echo 'Admission Form';?></div>
		
		<div style="font-family: Calibri; padding: 10px; border-radius: 25px; border: 2px solid <?php echo $header_text_color;?>; background-color: #EDE4E0 !important;" >
			<table width="800px" style="border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 12px;table-layout: fixed;">
				<thead>
					<tr style="5px; background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 16px; color:<?php echo $header_text_color;?>;" >
						<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('students information');?></th>
		            	<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('students information', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $header_text_color;?>; background-color: #FFF !important">
				<?php
	            	$i=0; 
	            	$fields_student = array('admission_number','student_name', 'father_name', 'age', 'gender', 'date_of_birth', 'nationality', 'iqama_id', 'iqama_expiry', 'passport_id', 'passport_expiry', 'enrollment_date', 'enrollment_grade_level', 'previous_school', 'batch_name', 'address_line1', 'emergency_contact');
	            	$fields_father  = array('father_name');
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
			                <td style="padding-left: 4px; border:1px solid <?php echo $header_text_color;?>;font-size: 13px; font-weight: bold;" width='25%' valign="top"><?php echo Base_Controller::ToggleLang($row);?></td>
							<td style="padding-left: 4px; border:1px solid <?php echo $header_text_color;?>;" width='25%'><?php echo $value;?></td>
							<td style="direction: rtl; border:1px solid <?php echo $header_text_color;?>; text-align: right;" width='20%' valign="top"><?php echo $value2;?></td>
							<td style="direction: rtl; border:1px solid <?php echo $header_text_color;?>; text-align: right;font-size: 14px; font-weight: bold;" width='30%' valign="top"><?php echo Base_Controller::ToggleLang($row, 'ar');?></td>
		                </tr>
	                <?php }
	            	} ?>
				</tbody>
			</table>
			<table width="800px" style="margin-top: 5px; border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 12px;">
				<thead>
					<tr style="5px; background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 16px; color:<?php echo $header_text_color;?>;" >
						<th style="text-align: center; width: 50%;"><?php echo Base_Controller::ToggleLang('parents details');?></th>
		            	<th style="text-align: center" ><?php echo Base_Controller::ToggleLang('parents details', 'ar');?></th>
					</tr>
				</thead>
			</table>
			
			<table width="800px" style="margin-top: 5px; border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 12px; table-layout: fixed;">
				<thead>
					<tr style="5px; background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 16px; color:<?php echo $header_text_color;?>;" >
						<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('father information');?></th>
		            	<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('father information', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $header_text_color;?>; background-color: #FFF !important">
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
			                <td style="padding-left: 4px; border:1px solid <?php echo $header_text_color;?>;font-size: 13px; font-weight: bold;" width='25%' valign="top"><?php echo Base_Controller::ToggleLang($row);?></td>
							<td style="padding-left: 4px; border:1px solid <?php echo $header_text_color;?>; max-width: 25%; overflow: hidden;" width='25%' ><?php echo $value;?></td>
							<td style="direction: rtl; border:1px solid <?php echo $header_text_color;?>; text-align: right;" width='20%' valign="top"><?php echo $value2;?></td>
							<td style="direction: rtl; padding-right: 4px; border:1px solid <?php echo $header_text_color;?>; text-align: right;font-size: 14px; font-weight: bold;" width='30%' valign="top"><?php echo Base_Controller::ToggleLang($row, 'ar');?></td>
		                </tr>
	                <?php }
	            	} ?>
				</tbody>
			</table>
			<table width="800px" style="margin-top: 5px; border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 12px;table-layout: fixed;">
				<thead>
					<tr style="5px; background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 16px; color:<?php echo $header_text_color;?>;" >
						<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('mother information');?></th>
		            	<th style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('mother information', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $header_text_color;?>; background-color: #FFF !important">
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
			                <td style="padding-left: 4px; border:1px solid <?php echo $header_text_color;?>;font-size: 13px; font-weight: bold;" width='25%' valign="top"><?php echo Base_Controller::ToggleLang($row);?></td>
							<td style="padding-left: 4px; border:1px solid <?php echo $header_text_color;?>;" width='25%'><?php echo $value;?></td>
							<td style="direction: rtl; border:1px solid <?php echo $header_text_color;?>; text-align: right;" width='20%' valign="top"><?php echo $value2;?></td>
							<td style="direction: rtl; border:1px solid <?php echo $header_text_color;?>; text-align: right; font-size: 14px; font-weight: bold;" width='30%' valign="top"><?php echo Base_Controller::ToggleLang($row, 'ar');?></td>
		                </tr>
	                <?php }
	            	} ?>
				</tbody>
			</table>
			
			<div style="height: 45px; padding-top: 5px; text-align: center; font-size: 13px; font-weight: bold;" >
				<?php echo Base_Controller::ToggleLang('confirmation note').'<br/>';?>
				<span style="font-size: 14px; font-weight: bold;"><?php echo Base_Controller::ToggleLang('confirmation note', 'ar');?></span>
			</div>
			
			<table width="800px" style="margin-top:10px; border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 12px;">
			  	<tr height="29px"> 
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo '';?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo '';?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo date('d M, Y');?></th>
		       	</tr>
			  	<tr height="20px"> 
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Parents Full Name');?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Signature');?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Date');?></th>
		       	</tr>
			</table>
		</div>
		<br>
		<div class="clearfix" style="page-break-after: always;"></div>
		<!-- Second Page start here -->
		<div style="height: 70px; padding-top: 20px; background-color: <?php echo $header_color;?> !important; text-align: center;" >
			<img src="<?php echo $logo_image;?>" alt="DIS Logo" style="width:70px"/>
			
		</div>
		<div style="height: 5px; background-color: #8E9088 !important" >&nbsp;</div>
		<div style="font-family: Calibri; padding-top:14px; width:820px; font-size: 18px; text-align: center; vertical-align: bottom;"><?php echo 'Admission Form';?></div>
		
		<div style="font-family: Calibri; font-weight: normal; padding: 10px; border-radius: 25px; border: 2px solid <?php echo $header_text_color;?>; background-color: #EDE4E0 !important;" >
			<table width="800px" style="border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 12px;table-layout: fixed;">
				<thead>
					<tr style="background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 14px; color:<?php echo $header_text_color;?>;" >
						<th style="text-align: left" colspan="2"><?php echo Base_Controller::ToggleLang('Admission Payment Policy');?></th>
		            	<th style="text-align: right; direction: rtl;" colspan="2"><?php echo Base_Controller::ToggleLang('Admission Payment Policy', 'ar');?></th>
					</tr>
				</thead>
			</table>
			
			<table width="800px" style="margin-top: 4px;border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 11px;table-layout: fixed;">
				<thead>
					<tr style="background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 14px; color:<?php echo $header_text_color;?>;" >
						<th style="text-align: center"><?php echo Base_Controller::ToggleLang('Tuition Fee Payment Policy');?></th>
		            	<th style="text-align: center"><?php echo Base_Controller::ToggleLang('Tuition Fee Payment Policy', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $header_text_color;?>; background-color: #FFF !important">
					<tr>
						<td style="border:1px solid <?php echo $header_text_color;?>; text-align: left; " ><?php echo Base_Controller::ToggleLang('tuition_fee_payment_policy_desc').Base_Controller::ToggleLang('tuition_fee_payment_policy_desc2');?></td>
		            	<td style="border:1px solid <?php echo $header_text_color;?>; text-align: right; direction: rtl; vertical-align: top; font-size: 12px" ><?php echo Base_Controller::ToggleLang('tuition_fee_payment_policy_desc', 'ar');?></td>
					</tr>
				</tbody>
			</table>
			
			<table width="800px" style="margin-top: 4px;border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 11px;table-layout: fixed;">
				<thead>
					<tr style="background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 14px; color:<?php echo $header_text_color;?>;" >
						<th style="text-align: center"><?php echo Base_Controller::ToggleLang('Transfer Policy');?></th>
		            	<th style="text-align: center"><?php echo Base_Controller::ToggleLang('Transfer Policy', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $header_text_color;?>; background-color: #FFF !important">
					<tr>
						<td style="border:1px solid <?php echo $header_text_color;?>; text-align: justify; " ><?php echo Base_Controller::ToggleLang('transfer_policy_desc').Base_Controller::ToggleLang('transfer_policy_desc2');?></td>
		            	<td style="border:1px solid <?php echo $header_text_color;?>; text-align: right; direction: rtl;" ><?php echo Base_Controller::ToggleLang('transfer_policy_desc', 'ar');?></td>
					</tr>
				</tbody>
			</table>
			
			<table width="800px" style="margin-top: 4px;border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 11px;table-layout: fixed;">
				<thead>
					<tr style="background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 14px; color:<?php echo $header_text_color;?>;" >
						<th style="text-align: center"><?php echo Base_Controller::ToggleLang('Discount Policy');?></th>
		            	<th style="text-align: center"><?php echo Base_Controller::ToggleLang('Discount Policy', 'ar');?></th>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $header_text_color;?>; background-color: #FFF !important">
					<tr>
						<td style="text-align: justify;" ><?php echo Base_Controller::ToggleLang('discount_policy_desc');?></td>
		            	<td style="text-align: right; direction: rtl;" ><?php echo Base_Controller::ToggleLang('discount_policy_desc', 'ar');?></td>
					</tr>
				</tbody>
			</table>
			
			<table width="800px" style="margin-top: 4px;border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 11px;">
				<thead>
					<tr style="height: 25px; background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 11px; font-weight: bold; color:<?php echo $header_text_color;?>;" >
						<td style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('Please tick the below box in completion of the mentioned documents');?></td>
		            	<td style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('Please tick the below box in completion of the mentioned documents', 'ar');?></td>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $header_text_color;?>; background-color: #FFF !important">
					<?php for($i = 1; $i <= 12; $i++){?>
					<tr>
						<td style="border:1px solid <?php echo $header_text_color;?>;" width="20px"> &nbsp; </td>
						<td style="border:1px solid <?php echo $header_text_color;?>; text-align: justify;" ><?php echo Base_Controller::ToggleLang('dis_option'.$i);?></td>
		            	<td style="border:1px solid <?php echo $header_text_color;?>; text-align: right; direction: rtl;" ><?php echo Base_Controller::ToggleLang('dis_option'.$i, 'ar');?></td>
		            	<td style="border:1px solid <?php echo $header_text_color;?>;" width="20px"> &nbsp; </td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			
			<table width="800px" style="margin-top: 4px;border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 11px;">
				<thead>
					<tr style="height: 25px; background-color: <?php echo $tbl_head_bgcolor;?> !important; font-size: 14px; font-weight: bold; color:<?php echo $header_text_color;?>;" >
						<td style="text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('Tuition Fee Criteria');?></td>
					</tr>
				</thead>
				<tbody style="border:1px solid <?php echo $header_text_color;?>; background-color: #FFF !important">
					<?php 
					$arr = array('GRADE'=>'TOTAL', 'KINDERGARTEN'=>'10,000', 'GRADE 1 - 2 - 3'=>'10,700', 'GRADE 4 - 5 - 6'=>'11,200', 'GRADE 7 - 8 - 9'=>'12,200', 'GRADE 10 - 11 - 12'=>'15,700');
					foreach($arr as $in=>$val){?>
					<tr>
						
						<td style="border:1px solid <?php echo $header_text_color;?>; text-align: center;" width="50%" ><?php echo $in;?></td>
		            	<td style="border:1px solid <?php echo $header_text_color;?>; text-align: center; direction: rtl;" ><?php echo $val;?></td>
		            	
					</tr>
					<?php }?>
					<tr>
						<td style="border:1px solid <?php echo $header_text_color;?>; text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('Textbooks and copybooks are not included in the tuition fee');?></td>
					</tr>
					<tr>
						<td style="border:1px solid <?php echo $header_text_color;?>; text-align: center" colspan="2"><?php echo Base_Controller::ToggleLang('Textbooks and copybooks are not included in the tuition fee', 'ar');?></td>
					</tr>
				</tbody>
			</table>
			
			<div style="height: 45px; padding-top: 5px; text-align: center; font-size: 13px; font-weight: bold;" >
				<?php echo Base_Controller::ToggleLang('confirmation note').'<br/>';?>
				<span style="font-size: 14px; font-weight: bold;"><?php echo Base_Controller::ToggleLang('confirmation note', 'ar');?></span>
			</div>
			
			<table width="800px" style="margin-top:10px; border:1px solid <?php echo $header_text_color;?>; border-collapse:collapse; font-size: 12px;">
			  	<tr height="29px"> 
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo '';?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo '';?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo date('d M, Y');?></th>
		       	</tr>
			  	<tr height="20px"> 
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Parents Full Name');?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Signature');?></th>
		       		<th style="border:1px solid <?php echo $header_text_color;?>; text-align: center" width="25%" valign="top"><?php echo Base_Controller::ToggleLang('Date');?></th>
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