<script type="text/javascript">
<!--
$(function() {

	$('#tabs').tabs();
});
//-->
</script>
<span style="font-weight:bolder; font-size:1.3em; font-family:sans-serif;" >Student Profile : <?php $form = $form[0]; echo $form->student_name?></span>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Profile</a></li>
		<li><a href="#tabs-2">Assesments</a></li>
		<li><a href="#tabs-3">Attendance</a></li>
		<li><a href="#tabs-4">Fees</a></li>
	</ul>
	<div id="tabs-1">			
			<?php 
			
			echo form_open('students/add',array('id'=>'mainForm'));
			$today    = date('Y-m-d');
			?>
			
			<table width="700" border="0" cellspacing="3" cellpadding="0">
				<tr>
					<td align="center">
						
						<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
			                <tbody><tr>
			                	<td align="<?php echo $class_left;?>" colspan="4" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1"><?php echo Base_Controller::ToggleLang('General');?></span></td>
			                </tr>
							<tr >
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>" ><?php echo Base_Controller::ToggleLang('Admission Date');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" style="border-bottom: 1px solid #8CBAE8;"><?php echo Util::dateDisplayFormate($form->admission_date);?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('City');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" style="border-bottom: 1px solid #8CBAE8;"><?php echo $form->city;?></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Class Roll No');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->student_id;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Date of Birth');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo Util::dateDisplayFormate($form->date_of_birth);?></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Iqama ID');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->iqama_id;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Iqama Expiry');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo Util::dateDisplayFormate($form->iqama_expiry);?></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Birth Place');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->birth_place;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Blood Group');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->blood_group;?></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('State');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->state;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Country');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->country_id;?></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Nationality');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->nationality;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Gender');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->gender;?></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Pin Code');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->pin_code;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"></td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Address Line1');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->address_line1;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Address Line 2');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->address_line2;?></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Phone 1');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->phone1;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Phone 2');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->phone2;?></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Language');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->language;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Email');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->email;?></td>
							</tr>
							<tr>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Category');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->category;?></td>
								<td width='20%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Religion');?>:</td>
								<td width='30%' style="border-bottom: 1px solid #8CBAE8;" ><?php echo $form->religion;?></td>
							</tr>
							<tr>
			                	<td align="<?php echo $class_left;?>" colspan="4" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1"><?php echo Base_Controller::ToggleLang('Emergeny Contact');?></span></td>
			                </tr>
							<tr>
								<td width='100%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>" colspan="4" id="tblParentDetail">
								<?php if(sizeof($guardian) > 0){ $val = $guardian[0];?>
			                	In case of emergencies,<br>
								contact : <?php echo $val->first_name. ' ' .$val->last_name. ' ('. $val->mobile_phone . ')';
								$param = 'student_id='.$val->student_id;
								$url   = base_url().$model."/edit_parent_data";
								?>
								
								<a href="#" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'parentDetailForm\', \'tblParentDetail\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Add Previous Data\'})"'; ?> >Edit</a>
			                	
			                	<?php }else {
			                		$param = 'student_id='.$student_id;
			                		$url   = base_url().$model."/add_parent_data";
			                		echo '<a href="#" onclick="showInnerBox( [\''. $url .'\', \'_insert\', \'parentDetailForm\', \'tblPrevData\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Add Previous Data\'})" >Add</a> Contact Detail'; }?>
								</td>
							</tr>
							<tr>
			                	<td align="<?php echo $class_left;?>" colspan="4" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1"><?php echo Base_Controller::ToggleLang('Student Previous Data');?></span></td>
			                </tr>
			                <tr>
			                	<td align="<?php echo $class_left;?>" colspan="4" id="tblPrevData">
			                		<table width="100%">
			                		<?php if(sizeof($previous_data) > 0){
										$title = "::Update Previous Data::";
										foreach ($previous_data as $val) {
											$cell_id = $val->id; 
											$param = 'id='. $val->id .'&student_id='.$val->student_id;
											$url   = base_url().$model."/edit_previous_data";
									?>
									
									<tr>
										<td width='20%' style="border-bottom: 1px solid #8CBAE8; vertical-align: top;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Institution');?>:</td>
										<td width='30%' style="border-bottom: 1px solid #8CBAE8; vertical-align: top;" ><?php echo $val->institute;?></td>
										<td width='20%' style="border-bottom: 1px solid #8CBAE8; vertical-align: top;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Year');?>:</td>
										<td width='30%' style="border-bottom: 1px solid #8CBAE8; vertical-align: top;" > <span style="float: left;"><?php echo $val->year;?></span> <span style="float: right;"><a href="#" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'previousDetailForm\', \'tblPrevData\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'})"'; ?>  >Edit</a></span></td>
									</tr>
									<tr>
										<td width='20%' style="border-bottom: 2px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Course');?>:</td>
										<td width='30%' style="border-bottom: 2px solid #8CBAE8;" ><?php echo $val->course;?></td>
										<td width='20%' style="border-bottom: 2px solid #8CBAE8;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Total Mark');?>:</td>
										<td width='30%' style="border-bottom: 2px solid #8CBAE8;" ><?php echo $val->total_marks;?></td>
										
									</tr>
									<?php } 
									} ?>
									</table>
								</td>
			                </tr>
							<tr>
								<?php 
								$param = 'student_id='.$student_id;
								$url   = base_url().$model."/add_previous_data";
								?>
								<td width='100%' style="border-bottom: 1px solid #8CBAE8;" align="<?php echo $class_left;?>" colspan="4">
								<a href="#" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_insert\', \'previousDetailForm\', \'tblPrevData\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Add Previous Data\'})"'; ?> >Add another Previous Data</a></td>
							</tr>
						</table>
					</td>
				</tr>		
			</table>
			<?php echo form_close();?>
			</div>
			<div id="tabs-2" style="height: 420px"><?php include "assesment_detail.php"?></div>
			<div id="tabs-3" style="height: 420px"><?php include "attendance_detail.php"?></div>
			<div id="tabs-4" style="height: 420px"><?php include "fees_detail.php"?></div>
		</div>
		<div id="dialog-form"></div>
		<style type="text/css">
			  .dateCss{
				background:#FFFFFF none repeat scroll 0 0 !important;
				border-color:#FFFFFF #666633 #666633 #CCCC99 !important;
				border-style:solid !important;
				border-width:0px !important;
				color:#000000 !important;
				font-size: 11px;
				font-weight:bold !important;
				min-width:85px;
				width: 110px;
				text-align:center;
				cursor: default;
			}
        </style>
		<script>
			function showUrlInDialog(_url, params, options, cell_id){
            	options = options || {};
            	var tag = $("#dialog-form"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: _url+'?'+params,
            	    type: (options.type || 'POST'),
            	    beforeSend: options.beforeSend,
            	    error: options.error,
            	    complete: options.complete,
            	    success: function(data, textStatus, jqXHR) {
            	      if(typeof data == "object" && data.html) { //response is assumed to be JSON
            	        tag.html(data.html).dialog({modal: options.modal, title: data.title, width:700, height: 500, draggable: true}).dialog('open');
            	      } else { //response is assumed to be HTML
            	        tag.html(data).dialog({modal: options.modal,  
                	        buttons: {
            	        	Save: function() {
            	        	get(_url+'ance', '', 'div_attendance', false, 'attendForm');
            	            $( this ).dialog( "close" );
            	          	},
            	        	Cancel: function() {
            	            $( this ).dialog( "close" );
            	          	}
            	        }, title: options.title, width:600, height: 400, draggable: true }).dialog('open');
            	      }
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	      
            	    }
            	});
            }

			function showInnerBox(_url, params, options){
            	options = options || {};
            	var tag = $("#dialog-form"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: _url[0] +'?'+params,
            	    type: (options.type || 'POST'),
            	    beforeSend: options.beforeSend,
            	    error: options.error,
            	    complete: options.complete,
            	    success: function(data, textStatus, jqXHR) {
            	      if(typeof data == "object" && data.html) { //response is assumed to be JSON
            	        tag.html(data.html).dialog({modal: options.modal, title: data.title, width:700, height: 500, draggable: true}).dialog('open');
            	      } else { //response is assumed to be HTML
            	        tag.html(data).dialog({modal: options.modal,  
                	        buttons: {
            	        	Save: function() {
            	        		target_div = _url[3];
            	        		get(_url[0] + _url[1], '', target_div, false, _url[2]);
            	            	$( this ).dialog( "close" );
            	          	},
            	        	Cancel: function() {
            	            $( this ).dialog( "close" );
            	          	}
            	        }, title: options.title, width:700, height: 500, draggable: true }).dialog('open');
            	      }
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	      
            	    }
            	});
            }
			</script>
		