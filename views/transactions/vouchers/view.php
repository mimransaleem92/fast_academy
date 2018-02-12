<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      	<title>Request Form</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<link href="<?php echo base_url();?>favicon.ico" rel="shortcut icon" type="image/ico" />
		<link href="<?php echo base_url().'assets/css/sheet_'.$lang.'.css';?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url().'assets/css/base.css';?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url().'assets/css/custom_style.css';?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url().'assets/css/sdStyle.css';?>" rel="stylesheet" type="text/css" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo base_url().'assets/js/tiny_mce/tiny_mce.js';?>"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

	function getSelectedOptions(oList,optionText) {
		for(var i = 0; i < oList.options.length; i++) {
			//alert(oList.options[i].value);
			if(oList.options[i].value == optionText) {
			oList.options[i].selected = true;
			}
		}
	}
	
	function changeTamplate(val){
		document.getElementById('request_title').value = val;
		document.getElementById('resolution_block').style.display  = 'table-row';
		if(val == 'Default Template'){
			getSelectedOptions(document.getElementById('priority'), '0');
			getSelectedOptions(document.getElementById('category'), '0');
			getSelectedOptions(document.getElementById('subcategory'), '0');
			tinyMCE.get('request_description').setContent('');
		}
		else if(val == 'Mail fetching'){
			document.getElementById('resolution_block').style.display  = 'none';
			tinyMCE.get('request_description').setContent('I am unable to fetch mails from the mail server');
		}
		else if(val == 'New Joinee'){
			tinyMCE.get('request_description').setContent('');
		}
		else if(val == 'Printer problem'){
			document.getElementById('resolution_block').style.display  = 'none';
			getSelectedOptions(document.getElementById('priority'), '0');
			getSelectedOptions(document.getElementById('category'), '6');
			getSelectedOptions(document.getElementById('subcategory'), '0');
			tinyMCE.get('request_description').setContent('I am unable to take print out from the printer');
		}
		else if(val == 'Unable to browse'){
			tinyMCE.get('request_description').setContent('');
		}
	}	
	function toggleResolution(){
		var display_check = document.getElementById('res_tr1').style.display;
		if(display_check == 'none'){
			document.getElementById('res_tr1').style.display = 'table-row';
			document.getElementById('res_tr2').style.display = 'table-row';
		}
		else
		{
			document.getElementById('res_tr1').style.display = 'none';
			document.getElementById('res_tr2').style.display = 'none';
		}
	}
</script>
<!-- /TinyMCE -->
</head>
<?php $form = $form[0];?>
<body class="yui-skin-sam">
	<?php echo form_open('requestform/add',array('id'=>'mainForm', 'enctype'=>'multipart/form-data'));?>
		<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<?php include 'assets/php/header.php';?>
				</td>
			</tr>
			<tr>
				<td colspan="4" align="center" class="fontBlack">
					Change Template &nbsp;
					<select class="formStyle" id="requseted_template" name="requseted_template" onchange="changeTamplate(this.value);">
						<option value='Default Template' <?php if($form->requseted_template == 'Default Template')echo 'selected="selected"';?> > Default Template </option>
						<option value='Mail fetching' <?php if($form->requseted_template == 'Mail fetching')echo 'selected="selected"';?>>  Mail fetching</option>
						<option value='New Joinee' <?php if($form->requseted_template == 'New Joinee')echo 'selected="selected"';?>>  New Joinee</option>
						<option value='Printer problem' <?php if($form->requseted_template == 'Printer problem')echo 'selected="selected"';?>>  Printer problem</option>
						<option value='Unable to browse' <?php if($form->requseted_template == 'Unable to browse')echo 'selected="selected"';?>>  Unable to browse</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder">
                            <tr>
                              <td colspan="4" align="left" valign="middle" class="listViewTableHeader tableHead">
                                    Incident #: <?php echo $reference_number;?>
                              </td>
                            </tr>
                            <tr>
                                <td width="15%" class="fontBlack alignRight">
                                	Priority </td>
                                <td width="35%" class="fontBlack" align="left">
                                	<select id="priority" class="formStyle" style="width: 300px;" name="priority">
                                	<option value="0" <?php if($form->priority == '0')echo 'selected="selected"';?>>-- Select Priority --</option> 
		                            <option value="4" <?php if($form->priority == '4')echo 'selected="selected"';?>>High</option> 
		                            <option value="1" <?php if($form->priority == '1')echo 'selected="selected"';?>>Low</option> 
		                            <option value="3" <?php if($form->priority == '3')echo 'selected="selected"';?>>Medium</option> 
		                            <option value="2" <?php if($form->priority == '2')echo 'selected="selected"';?>>Normal</option></select>
                                </td>
                                <td width="15%" class="fontBlack alignRight">&nbsp;</td>
						        <td width="35%" align="right"> 
						        	<input type="button" style="WIDTH: auto" class=formStylebutton onclick="javascript:window.close()" id=btnBack value=Close />
						        </td>
                            </tr>
                            <tr>
                            	<td colspan="4">
                            	<table id="tblInner1" width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  <tbody><tr>
					                    <td id="header1" align="left" colspan="4" class="reqFormsubHead"><span id=headerSpan1 class="fontBlackBold FontColorStyle1"> Requester Details </span></td>
					                  </tr>
					                  <tr>
					                    <td width="15%" valign="top" class="fontBlack alignRight">Name  <span class="mandatory">*</span>
					                    </td>
					                    <td width="35%" valign="top" class="fontBlack">
					                      <span class="fontBlack">
					                          <input type="hidden" id="requseter_id" class="formStyle" style="width:86%;" readonly="readonly" value="<?php echo $form->requseter_id;?>" name="requseter_id" />
						                      <input type="text" id="requseter_name" class="formStyle" style="width:86%;" readonly="readonly" value="<?php echo $form->requseter_name;?>" name="requseter_name" autocomplete="off" />
					                      </span> 
					                    </td>
					                    <td width="15%" class="fontBlack alignRight">Asset </td>
										<td valign="top"> 
					                          <!-- No workstation Available. Requester's login only-->
					                          <select id="workstation_id" class="formStyle" style="width:85%" name="workstation_id">
					                          	<option value="0">No Asset Available</option>
					                          </select>
					                          <span class="fontBlackBold"><a href="#">
											  </a></span> 
					                    </td> 
					                  </tr>
									  <tr>
						                  <td height="21" class="fontBlack alignRight">Contact number</td>
					                      <td>
					                      	<input type="text" id="contact_number" class="formStyle mleft-4" style="width:86%;" readonly="readonly" value="<?php echo $form->contact_number;?>" name="contact_number" />
					                      </td>
					                      <td width="15%" height="21" class="fontBlack alignRight"> Department </td>
					                      <td>
					                       <input type="text" id="department_name" class="formStyle" style="width:84%" readonly="readonly" value="<?php echo $form->department_name;?>" name="department_name" />
					                      </td>
					                  </tr>
					                  <tr>
					                    <td height="21" class="fontBlack alignRight">Job Title</td>
					                    <td>
					                      <input type="text" id="job_title" class="formStyle mleft-4" style="width:86%;" readonly="readonly" value="<?php echo $form->job_title;?>" name="job_title" />
					                    </td>
					                    <td width="15%" height="21" class="fontBlack alignRight"> Mode </td>
					                      <td>
					                       <select id="mode_of_request" class="formStyle" style="width:85%" name="mode_of_request">
					                          	<option value="1" <?php if($form->mode_of_request == '1')echo 'selected="selected"';?>>Phone</option>
					                          	<option value="3" <?php if($form->mode_of_request == '3')echo 'selected="selected"';?>>Web Form</option>
					                          	<option value="2" <?php if($form->mode_of_request == '2')echo 'selected="selected"';?>>Email</option>
					                          </select>
					                      </td>
					                  </tr>
					                </tbody></table>
                            	</td>
                            </tr>
                            <tr>
                            	<td colspan=4>
                            	<table id="tblInner2" width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  <tbody>
					                  	   <tr>
							                	<td id="header2" align="left" colspan="4" class="reqFormsubHead"><span id=headerSpan2 class="fontBlackBold FontColorStyle1"> Incident Details </span></td>
							               </tr>
										   <tr>
									            <td width="15%" class="fontBlack alignRight"></td> 
									            <td colspan=3 width="85%">
									            	<table id="tblCategory" width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
						                  				<tbody><tr>
										                    	<td align="left" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1">Category</span>
										                    	
										                    	</td>
										                    	<td align="left" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1">Subcategory</span></td>
										                    	<td align="left" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1">Item</span></td>
										                    	<td align="left" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1" style="cursor: pointer;" title="add new" onclick="addCategoryRow();">+</span> <span class="fontBlackBold FontColorStyle1" style="cursor: pointer;" onclick="deleteRow()" title="delete selected">x</span></td>
										                  </tr>
										                  <?php 
										                  $i = 0;
										                  foreach ($form_detail as $values) {?>
						                  				  <tr id="tr_<?php echo $i;?>">
						                  						<td width="32%">
												            	<select style="WIDTH: 95%" id='category_<?php echo $i;?>' class=formStyle name=category[] onchange="onchangeCategory(this.value, <?php echo $i;?>);">
																	<option value=0>-- Select Category --</option> 
																	<?php 
																	foreach ($category_list as $value) {
																		$s = '';
																		if($value->category_id == $values->category_id) $s = 'selected';
																		echo "<option value=$value->category_id $s> $value->name </option> ";
																	}
																	?>
																</select>
																</td>
																<td width="32%" id="sc_<?php echo $i;?>">
													            	<select style="width: 95%" id="subcategory_<?php echo $i;?>" name="subcategory[]" class="formStyle" >
																		<option value="0">-- Select Subcategory --</option>
																		<?php 
																		foreach ($subcategory_list as $value) {
																			$s = '';
																			if($value->subcategory_id == $values->subcategory_id) $s = 'selected';
																			if($value->category_id == $values->category_id){
																				echo "<option value=$value->subcategory_id $s> $value->name </option> ";
																			}
																		}
																		?>
																	</select>
												            	</td>
												            	<td width="32%">
													            	<input type="text" style="width:95%;" class="formStyle" value="<?php echo $values->item_name;?>" onfocus="if(this.value=='Item Description') this.value='';" onblur=" if(this.value=='') this.value='Item Description'; " id="item_name_<?php echo $i;?>" name="item_name[]" />
												            	</td>
												            	<td width="10%"></td>
															</tr>
															<?php 
										                   	$i++;
										                  }?>
														</tbody>
													</table>
													<span style="display: none;">
								                    	<input type="hidden" id="row_added" name="row_added" value="<?php echo --$i;?>" />
														<input type="hidden" id="chk_del" value="0" />
														<input type="hidden" id="edit_row" value="0" />
														<input type="hidden" id="tr_color" value="_light" />
							                    	</span>
								            	</td>
										  </tr>
										   <tr>
									            <td width="15%" class="fontBlack alignRight"> 
									            	Subject
									            </td> 
									            <td width="85%" colspan="3">
													<input type="text" value="<?php echo $form->request_title;?>" class="formStyle FullWidth" id="request_title" name="request_title" />
								            	</td>
										   </tr>
										   <tr>
									            <td width="15%" valign="top" class="fontBlack alignRight"> 
									            	Description
									            </td> 
									            <td width="85%" colspan="3">
									            	<textarea name="request_description" id="request_description" class="formStyleTextarea FullWidth" rows="25" ><?php echo $form->request_description;?></textarea>
									            	
												</td>
										   </tr>
										   <tr>
									            <td width="15%" class="fontBlack alignRight"> 
									            	E-mail Id(s) To Notify
									            </td> 
									            <td width="35%">
									                <input type="text" style="width:85%;" readonly="readonly" class="formStyle" value="<?php echo $form->email_notification;?>" id="email_notification" name="email_notification" />
								            	</td>
										        <td width="15%" class="fontBlack alignRight">Urgency</td>
										        <td width="35%">
										        	<select id="urgency" class="formStyle" style="width: 85%;" name="urgency">
				                                	<option value="0" <?php if($form->urgency == '0')echo 'selected="selected"';?>>-- Select Urgency --</option> 
						                            <option value="2" <?php if($form->urgency == '2')echo 'selected="selected"';?>>High</option> 
						                            <option value="4" <?php if($form->urgency == '4')echo 'selected="selected"';?>>Low</option> 
						                            <option value="3" <?php if($form->urgency == '3')echo 'selected="selected"';?>>Normal</option> 
						                            <option value="1" <?php if($form->urgency == '1')echo 'selected="selected"';?>>Urgent</option></select>
										        </td>
										   </tr>
								   </tbody></table>
                            	</td>
                            </tr>
						   <tr>
                            	<td colspan="4">
                            	<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  <tbody>
									   <tr>
								            <td align="left" colspan="4" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1"> Attachments: </span> </td>
								       </tr>
								       <tr>
								        <td width="15%"></td>
								       	<td width="85%" class="fontBlack" colspan=4>
								       	<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
								       	<?php 
								       	   if(isset($uploaded_list) && sizeof($uploaded_list) > 0){
									          foreach ($uploaded_list as $value){
									          	?>
									          	<tr>
									          		<td width="33%" valign="top" class="fontBlack"><a href="#" onclick="window.open('<?php echo base_url().'viewer/display/'.$value->file_name;?>', '_new');"><?php echo $value->raw_name;?></a></td>
											       	<td width="33%" valign="top" class="fontBlack" nowrap="nowrap"><?php echo $value->name;?></td>
											        <td width="34%" valign="top" class="fontBlack"><?php echo $value->date;?></td>
											    </tr>
									          	<?php 
									          }
									       }
								       	?>
								       	</table>
								       	</td>
								       </tr>
								       <tr>
								       	<td width="15%"></td>
								        <td width="35%" class="fontBlack">
								        	<input type="file" name="attached_file" id="attached_file" class="formStyle" style="width: 85%;"/>
								        </td>
								        <td width="50%" colspan="2" class="fontBlack"> <span class=fontgray> You can attach related docs here</span></td>
						        	   </tr>
								      </tbody>
								</table>
								</td>
						   </tr>
						   <tr id="resolution_block">
                            	<td colspan="4">
                            	<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  <tbody>
									   <tr>
								            <td align="left" colspan="4" class="reqFormsubHead" onclick="toggleResolution();"  style="cursor: pointer;"><span class="fontBlackBold FontColorStyle1"> Resolution </span></td>
								       </tr>
								       <tr id="res_tr1">
								       	<td width="15%" valign="top" class="fontBlack alignRight">Resolution :</td>
								        <td width="85%" colspan="3">
								        	<textarea name="resolution" id="resolution" class="formStyleTextarea FullWidth" rows="25" ><?php echo $form->resolution;?></textarea>
								        </td>
								       </tr>
								       <tr id="res_tr2">
								       	<td width="15%"></td>
								        <td width="85%" colspan="3" class="fontBlack">
								        	<span class=fontgray> You can quickly add Resolution here</span>
								        </td>
								       </tr>
								      </tbody>
								</table>
								</td>
						   </tr>
						   <tr>
						   		<td width="15%" align="right">Note</td>
                            	<td width="35%">
                            	<input type="text" style="width:85%;" class="formStyle" value="" id="comments" name="comments" />
                            	</td>
                            	<td width="50%" colspan="2" align="right"></td>
                            </tr>
						   <tr>
						   		<td width="15%" class="fontBlack alignRight">Assign to</td>
						        <td width="35%">
						        	<select id="assigned_to" class="formStyle" style="width: 85%;" name="assigned_to" <?php if($this->session->userdata(SESSION_CONST_PRE.'userId') != '11252' ) echo 'disabled="disabled"' ?>>
			                            <option value="0" selected="selected">--</option>
			                            <?php 
											foreach ($technician_list as $value) {
												$s = '';
												if($form->assigned_to == $value->user_id)
												$s = 'selected';
												echo "<option value=$value->user_id $s> $value->name </option> ";
											}
										?>
		                        	</select></td>
                            	<td colspan="2" align="left"></td>
						   </tr>
						   <tr id="note_block">
                            	<td colspan="4">
                            	<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  <tbody>
									   <tr>
								            <td align="left" colspan="4" class="reqFormsubHead" onclick=""  style="cursor: pointer;">
								            <span class="fontBlackBold FontColorStyle1" style="float:left"> Discussion Notes </span>
								            <span class="fontBlackBold FontColorStyle1" style="float:right" > Add Note </span>
								            </td>
								       </tr>
								       <tr>
								       	<td width="25%" valign="top" class="fontBlack" style="font-weight: bold">User</td>
								       	<td width="" valign="top" class="fontBlack" style="font-weight: bold">Note</td>
								       	<td width="15%" valign="top" class="fontBlack" style="font-weight: bold">Access</td>
								       	<td width="15%" valign="top" class="fontBlack" style="font-weight: bold">Date</td>
								       </tr>
								       <?php 
								       if(isset($request_notes) && sizeof($request_notes) > 0){
								          foreach ($request_notes as $value){
								          	$date = ($value->date);
								          	?>
								          	<tr>
										       	<td width="15%" valign="top" class="fontBlack" nowrap="nowrap"><?php echo $value->name;?></td>
										       	<td width="" valign="top" class="fontBlack"><?php echo $value->subject;?></td>
										       	<td width="15%" valign="top" class="fontBlack"><?php echo $value->access;?></td>
										       	<td width="15%" valign="top" class="fontBlack"><?php echo $date;?></td>
										    </tr>
								          	<?php 
								          }
								       }
								       ?>
								      </tbody>
								</table>
								</td>
						   </tr>
						   <tr id="workflow_block">
                            	<td colspan="4">
                            	<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  <tbody>
									   <tr>
								            <td align="left" colspan="4" class="reqFormsubHead" onclick=""  style="cursor: pointer;"><span class="fontBlackBold FontColorStyle1"> Workflow Logs </span></td>
								       </tr>
								       <tr>
								       	<td width="22%" valign="top" class="fontBlack" style="font-weight: bold">User Name</td>
								       	<td width="15%" valign="top" class="fontBlack" style="font-weight: bold">Created Date</td>
								       	<td width="15%" valign="top" class="fontBlack" style="font-weight: bold">Action Date</td>
								       	<td width="*" valign="top" class="fontBlack" style="font-weight: bold">Note</td>
								       </tr>
								       <?php 
								       if(isset($workflow_logs) && sizeof($workflow_logs) > 0){
								          foreach ($workflow_logs as $value){
								          	?>
								          	<tr>
										       	<td width="22%" valign="top" class="fontBlack" nowrap="nowrap"><?php echo $value->name;?></td>
										        <td width="15%" valign="top" class="fontBlack"><?php echo $value->cdate;?></td>
										        <td width="15%" valign="top" class="fontBlack"><?php echo $value->date;?></td>
										       	<td width="*" valign="top" class="fontBlack"><?php echo $value->comments;?></td>
										    </tr>
								          	<?php 
								          }
								       }
								       ?>
								      </tbody>
								</table>
								</td>
						   </tr>
                    </table>
				</td>
			</tr>
			<tr>
				<td style="padding-top: 10px">
					<?php include 'assets/php/footer.php';?>
				</td>
			</tr>
		</table>
		<?php echo form_close();?>
		<script type="text/javascript"> 
			function disabledFields(){

				var obj = document.getElementById('mainForm');
				for (i=0; i<obj.elements.length; i++) 
				{
					obj.elements[i].disabled = 'disabled';
				}
				document.getElementById('btnBack').disabled = false;
			}
			disabledFields();
		</script>
	</body>
</html>
