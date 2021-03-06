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
	function onchangeServices(val){
		if(val == 'IT'){
			document.getElementById('tblTop').setAttribute('class', 'whitebgBorder');
			document.getElementById('tblInner1').setAttribute('class', 'whitebgBorder');
			document.getElementById('tblInner2').setAttribute('class', 'whitebgBorder');
			document.getElementById('tblInner3').setAttribute('class', 'whitebgBorder');
			document.getElementById('tblInner4').setAttribute('class', 'whitebgBorder');
			document.getElementById('headerTop').setAttribute('class', 'listViewTableHeader tableHead');
			document.getElementById('header1').setAttribute('class', 'reqFormsubHead');
			document.getElementById('header2').setAttribute('class', 'reqFormsubHead');
			document.getElementById('header3').setAttribute('class', 'reqFormsubHead');
			document.getElementById('header4').setAttribute('class', 'reqFormsubHead');
			document.getElementById('headerSpan1').setAttribute('class', 'fontBlackBold FontColorStyle1');
			document.getElementById('headerSpan2').setAttribute('class', 'fontBlackBold FontColorStyle1');
			document.getElementById('headerSpan3').setAttribute('class', 'fontBlackBold FontColorStyle1');
			document.getElementById('headerSpan4').setAttribute('class', 'fontBlackBold FontColorStyle1');
		}
		else if(val == 'Facilities'){
			document.getElementById('tblTop').setAttribute('class', 'greenbgBorder');
			document.getElementById('tblInner1').setAttribute('class', 'greenbgBorder');
			document.getElementById('tblInner2').setAttribute('class', 'greenbgBorder');
			document.getElementById('tblInner3').setAttribute('class', 'greenbgBorder');
			document.getElementById('tblInner4').setAttribute('class', 'greenbgBorder');			
			document.getElementById('headerTop').setAttribute('class', 'listViewTableHeaderGreen tableHead');
			document.getElementById('header1').setAttribute('class', 'reqFormsubHeadGreen');
			document.getElementById('header2').setAttribute('class', 'reqFormsubHeadGreen');
			document.getElementById('header3').setAttribute('class', 'reqFormsubHeadGreen');
			document.getElementById('header4').setAttribute('class', 'reqFormsubHeadGreen');
		}
		else if(val == 'Admin'){
			document.getElementById('tblTop').setAttribute('class', 'brownbgBorder');
			document.getElementById('tblInner1').setAttribute('class', 'brownbgBorder');
			document.getElementById('tblInner2').setAttribute('class', 'brownbgBorder');
			document.getElementById('tblInner3').setAttribute('class', 'brownbgBorder');
			document.getElementById('tblInner4').setAttribute('class', 'brownbgBorder');			
			document.getElementById('headerTop').setAttribute('class', 'listViewTableHeaderBrown tableHead');
			document.getElementById('header1').setAttribute('class', 'reqFormsubHeadBrown');
			document.getElementById('header2').setAttribute('class', 'reqFormsubHeadBrown');
			document.getElementById('header3').setAttribute('class', 'reqFormsubHeadBrown');
			document.getElementById('header4').setAttribute('class', 'reqFormsubHeadBrown');
		}
		else if(val == 'TSD'){
			document.getElementById('tblTop').setAttribute('class', 'pinkbgBorder');
			document.getElementById('tblInner1').setAttribute('class', 'pinkbgBorder');
			document.getElementById('tblInner2').setAttribute('class', 'pinkbgBorder');
			document.getElementById('tblInner3').setAttribute('class', 'pinkbgBorder');
			document.getElementById('tblInner4').setAttribute('class', 'pinkbgBorder');			
			document.getElementById('headerTop').setAttribute('class', 'listViewTableHeaderPink tableHead');
			document.getElementById('header1').setAttribute('class', 'reqFormsubHeadPink');
			document.getElementById('header2').setAttribute('class', 'reqFormsubHeadPink');
			document.getElementById('header3').setAttribute('class', 'reqFormsubHeadPink');
			document.getElementById('header4').setAttribute('class', 'reqFormsubHeadPink');
			
			document.getElementById('headerSpan1').setAttribute('class', 'fontBlackBold FontColorWhite');
			document.getElementById('headerSpan2').setAttribute('class', 'fontBlackBold FontColorWhite');
			document.getElementById('headerSpan3').setAttribute('class', 'fontBlackBold FontColorWhite');
			document.getElementById('headerSpan4').setAttribute('class', 'fontBlackBold FontColorWhite');
		}
			
	}
	
	function onchangeServiceTemplate(val){
		var url = '<?php echo base_url();?>';
		if(val == 'IT'){
			window.open(url+'itrequest/add', '_self');
		}
		else if(val == 'TSD'){
			window.open(url+'tsdrequest/add', '_self');
		}	
	}

	function onchangeCategory(val, i){
		if(val != '0'){
			var url = '<?php echo base_url().'itrequest/getSubcategory/';?>'+val;
			get(url, 'count='+i, 'sc_'+i, false, false);
		}
	}
</script>
<!-- /TinyMCE -->
<link rel="stylesheet" type="text/css" href="../assets/yui/container.css" />
<script type="text/javascript" src="../assets/yui/yahoo-dom-event.js"></script>
<script type="text/javascript" src="../assets/yui/connection-min.js"></script>
<script type="text/javascript" src="../assets/yui/dragdrop-min.js"></script>
<script type="text/javascript" src="../assets/yui/container-min.js"></script>
<script type="text/javascript" src="../assets/js/util.js"></script>
<script type="text/javascript" src="../assets/js/yui_ajax.js"></script>
<script type="text/javascript" src="../assets/js/AjaxRequestManager.js"></script>
<script type="text/javascript" src="../assets/js/ajax.js"></script>
<style type="text/css">

.yui-pe .yui-pe-content {
    display:none;
}
</style>
</head>
<body class="yui-skin-sam">
	<?php echo form_open('itrequest/add',array('id'=>'mainForm', 'enctype'=>'multipart/form-data'));?>
		<input type="hidden" name="request_status" value="Open" />
		<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<?php include 'assets/php/header.php';?>
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="fontBlack">
					Service Template &nbsp;
					<select class="formStyle" id="service_template" name="service_template" onchange="onchangeServiceTemplate(this.value);">
						<option value='IT' selected="selected" > IT Services </option>
						<option value='Facilities' >  Facilities Services</option>
						<option value='Admin' >  Admin Services</option>
						<option value='TSD' >  TSD Services</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<table id="tblTop" width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder">
                            <tr>
                              <td id="headerTop" colspan="4" align="left" valign="middle" class="listViewTableHeader tableHead">
                                    <span style="float: left; padding-left:4px"> New Incident </span>
                                    <span style="float: right; padding-right:4px"> 
                                    	<input type="button" style="WIDTH: auto" class=formStylebutton title=Back onclick="javascript:window.open('<?php echo base_url()."status_screen";?>','_self');" value=Back />
                                    </span>
                              </td>
                            </tr>
                            <tr>
                              <td style="background-color:#3FF232; height:14px" colspan="4" align="left" valign="middle" >
                                    
                              </td>
                            </tr>
                            <tr>
                                <td width="15%" class="fontBlack alignRight">
                                	Priority </td>
                                <td width="35%" class="fontBlack">
                                	<select id="priority" class="formStyle" style="width: 85%;" name="priority">
                                	<option value="0">-- Select Priority --</option> 
		                            <option value="4">High</option> 
		                            <option value="1">Low</option> 
		                            <option value="3">Medium</option> 
		                            <option value="2">Normal</option></select>
                                </td>
                                <td width="15%" class="fontBlack alignRight"> IT Services</td>
						        <td width="35%">
						        	<select class="formStyle" id="requseted_template" name="requseted_template" style="width: 85%;" onchange="changeTamplate(this.value);">
										<option value='Default Template' selected="selected" > Default Template </option>
										<option value='Mail fetching' > Mail fetching</option>
										<option value='New Joinee' > New Joinee</option>
										<option value='Printer problem' > Printer problem</option>
										<option value='Unable to browse' > Unable to browse</option>
									</select>
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
					                      <input type="hidden" id="requseter_id" class="formStyle" style="width:86%;" readonly="readonly" value="<?php echo $emp_info[0]->EMP_NUM;?>" name="requseter_id" />
						                      <input type="text" id="requseter_name" class="formStyle" style="width:86%;" readonly="readonly" value="<?php echo $emp_info[0]->EMP_NAME;?>" name="requseter_name" autocomplete="off" />
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
					                      	<input type="text" id="contact_number" class="formStyle mleft-4" style="width:86%;" value="" name="contact_number" />
					                      </td>
					                      <td width="15%" height="21" class="fontBlack alignRight"> Department </td>
					                      <td>
					                       <input type="text" id="department_name" class="formStyle" style="width:85%" readonly="readonly" value="<?php echo $emp_info[0]->DEP_NAME;?>" name="department_name" />
					                      </td>
					                  </tr>
					                  <tr>
					                    <td height="21" class="fontBlack alignRight">Job Title</td>
					                    <td>
					                      <input type="text" id="job_title" class="formStyle mleft-4" style="width:86%;" readonly="readonly" value="<?php echo $emp_info[0]->DESIG_DESC;?>" name="job_title" />
					                    </td>
					                    <td width="15%" height="21" class="fontBlack alignRight"> Mode </td>
					                      <td>
					                       <select id="mode_of_request" class="formStyle" style="width:85%" name="mode_of_request">
					                          	<option value="1">Phone</option>
					                          	<option value="3" selected="selected">Web Form</option>
					                          	<option value="2">Email</option>
					                          </select>
					                      </td>
					                  </tr>
					                </tbody></table>
                            	</td>
                            </tr>
                            <tr>
                            	<td colspan=4>
                            	<table id="tblInner2" width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  <tbody><tr>
					                    	<td id="header2" align="left" colspan="4" class="reqFormsubHead"><span id=headerSpan2 class="fontBlackBold FontColorStyle1"> Incident Details </span></td>
					                  </tr>
					                  <tr>
								            <td width="15%" class="fontBlack alignRight"></td> 
								            <td colspan=3 width="85%">
								            	<table id="tblCategory" width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  				<tbody><tr>
									                    	<td align="left" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1">Category</span>
									                    	<span style="display: none;">
										                    	<input type="hidden" id="row_added" value="0" />
																<input type="hidden" id="chk_del" value="0" />
									                    	</span>
									                    	</td>
									                    	<td align="left" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1">Subcategory</span></td>
									                    	<td align="left" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1">Item</span></td>
									                    	<td align="left" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1" style="cursor: pointer;" title="add new" onclick="addCategoryRow();">+</span> <span class="fontBlackBold FontColorStyle1" style="cursor: pointer;" onclick="deleteRow()" title="delete selected">x</span></td>
									                  </tr>
					                  				  <tr>
					                  						<td width="32%">
											            	<select style="WIDTH: 95%" id="category_0" class=formStyle name="category[]" onchange="onchangeCategory(this.value, 0);">
																<option value=0>-- Select Category --</option> 
																<?php 
																foreach ($category_list as $value) {
																	echo "<option value=$value->category_id > $value->name </option> ";
																}
																?>
															</select>
															</td>
															<td width="32%" id="sc_0">
												            	<select style="width: 95%" id="subcategory_0" name="subcategory[]" class="formStyle" >
																	<option value="0">-- Select Subcategory --</option>
																	<?php 
																	foreach ($subcategory_list as $value) {
																		echo "<option value=$value->subcategory_id > $value->name </option> ";
																	}
																	?>
																</select>
											            	</td>
											            	<td width="32%">
												            	<input type="text" style="width:95%;" class="formStyle" value="Item Description" onfocus="if(this.value=='Item Description') this.value='';" onblur=" if(this.value=='') this.value='Item Description'; " id="item_name_0" name="item_name[]" />
											            	</td>
											            	<td width="10%"></td>
														</tr>
													</tbody>
												</table>
							            	</td>
									  </tr>
					                  <tr>
								            <td width="15%" class="fontBlack alignRight"> 
								            	Subject
								            </td> 
								            <td width="85%" colspan="3">
												<input type="text" value="Printer problem" class="formStyle FullWidth" id="request_title" name="request_title" />
							            	</td>
									   </tr>
									    <tr>
								            <td width="15%" valign="top" class="fontBlack alignRight"> 
								            	Description
								            </td> 
								            <td width="85%" colspan="3">
								            	<textarea name="request_description" id="request_description" class="formStyleTextarea FullWidth" rows="25" >I am unable to take print out from the printer</textarea>
								            	
											</td>
									   </tr>
									   <tr  style="display: none" >
								            <td width="15%" class="fontBlack alignRight"> 
								            	E-mail Id(s) To Notify
								            </td> 
								            <td width="35%">
								                <input type="text" style="width:85%;" readonly="readonly" class="formStyle" value="" id="email_notification" name="email_notification" />
							            	</td> 
									        <td width="15%" class="fontBlack alignRight">Urgency</td>
									        <td width="35%">
									        	<select id="urgency" class="formStyle" style="width: 85%;" name="urgency">
			                                	<option value="0">-- Select Urgency --</option> 
					                            <option value="2">High</option> 
					                            <option value="4">Low</option> 
					                            <option value="3">Normal</option> 
					                            <option value="1">Urgent</option></select>
									        </td>
									   </tr>
									</tbody></table>
                            	</td>
                            </tr>
						   <tr>
                            	<td colspan="4">
                            	<table id="tblInner3" width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  <tbody>
									   <tr>
								            <td id="header3" align="left" colspan="4" class="reqFormsubHead"><span id=headerSpan3 class="fontBlackBold FontColorStyle1"> Attachments: </span> </td>
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
                            	<table id="tblInner4" width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
					                  <tbody>
									   <tr>
								            <td id="header4" align="left" colspan="4" class="reqFormsubHead" onclick="toggleResolution();"  style="cursor: pointer;"><span id=headerSpan4 class="fontBlackBold FontColorStyle1"> Resolution </span></td>
								       </tr>
								       <tr id="res_tr1">
								       	<td width="15%" valign="top" class="fontBlack alignRight">Resolution :</td>
								        <td width="85%" colspan="3">
								        	<textarea name="resolution" id="resolution" class="formStyleTextarea FullWidth" rows="25" >Enter Resolution Text Here...</textarea>
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
                            	<td colspan="4" align="center">
                            		<input type="submit" style="WIDTH: auto" id="addWOButton" class="formStylebuttonAct" title="Add request"  name=addWO value="Add request" />
                            		&nbsp;
                            		<input type="reset" style="WIDTH: auto" class=formStylebutton title=Reset onclick=resetDescription(this.form); name=reset value=Reset /> 
                            		&nbsp;
                            		<input type="button" style="WIDTH: auto" class=formStylebutton title=Back onclick="javascript:window.open('<?php echo base_url().'status_screen';?>', '_parent')" name=cancel value=Cancel />
                            		
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
	

<div id="dialog1" class="yui-pe-content" style="display:none;">
<div class="hd"><?php echo Base_Controller::ToggleLang('Knowledge Management');?></div>

<div class="bd" id="formInnerDiv" style="background-color:white;">
	<div id="outer" style="overflow-y:scroll;overflow-x:hidden">
		<div id="inner">
	
		</div>
	</div>
</div>
</div>
<script type="text/javascript">

function addCategoryRow() {
	var i = document.getElementById("row_added").value ;
	i++;
	document.getElementById("row_added").value = i;
	document.getElementById("chk_del").value = parseInt(document.getElementById("chk_del").value) + 1;
	
	var tbl = document.getElementById("tblCategory");

	var lastRow = tbl.rows.length;
	// if there"s no header row in the table, then iteration = lastRow + 1
	var iteration = i;
	var row = tbl.insertRow(lastRow);
	row.id="tr_"+i;
	row.setAttribute("class", "row");
	
	// right cell
	var cellRight1 = row.insertCell(0);
	var cellRight2 = row.insertCell(1);
	var cellRight3 = row.insertCell(2);
	var cellRight4 = row.insertCell(3);

	cellRight2.setAttribute("id", "sc_"+i);

	  
	  var ajax_fun = "onchangeCategory(this.value,"+i+" );";
	  var only_number = "keyPressAllowIntOnly(event)";
	  var only_alfa   = ""
	  var newInputTxt1 = createSelect(i,"category_0");
      var newInputTxt2 = createSelect(i,"subcategory_0");
	  var newInputTxt3 = document.createElement("input");
	  var newInputTxt4 = document.createElement("input");

	  newInputTxt1.setAttribute("id", "category_"+i);
	  newInputTxt1.setAttribute("onchange", ajax_fun);
	  //newInputTxt1.setAttribute("class", "formStyle");
	  //newInputTxt1.setAttribute("style", "width:95%");
	  newInputTxt1.className = "formStyle";
	  newInputTxt1.style.width = "95%";

	  newInputTxt2.setAttribute("id", "subcategory_"+i);
	  //newInputTxt2.setAttribute("class", "formStyle");
	  //newInputTxt2.setAttribute("style", "width:95%");
	  newInputTxt2.className = "formStyle";
	  newInputTxt2.style.width = "95%";

	  newInputTxt3.setAttribute("id", "item_name_"+i);
	  newInputTxt3.setAttribute("type", "text");
	  newInputTxt3.setAttribute("autocomplete", "off");
	  newInputTxt3.setAttribute("onkeypress", "");
	  //newInputTxt3.setAttribute("class", "formStyle");
	  //newInputTxt3.setAttribute("style", "width:95%");
	  newInputTxt3.className = "formStyle";
	  newInputTxt3.style.width = "95%";
	  
	  newInputTxt4.setAttribute("id", "checkBox_"+i);
	  newInputTxt4.setAttribute("onclick", "");
	  newInputTxt4.setAttribute("type", "checkbox");
	  
	  newInputTxt1.setAttribute("name", "category[]");
	  newInputTxt2.setAttribute("name", "subcategory[]");
	  newInputTxt3.setAttribute("name", "item_name[]");
	  
	  cellRight1.appendChild(newInputTxt1);
	  cellRight2.appendChild(newInputTxt2);
	  cellRight3.appendChild(newInputTxt3);
	  cellRight4.appendChild(newInputTxt4);
}

function createSelect(count, id){

	var select = document.createElement("select");
	var idName = id + '_' + count;
	//select.setAttribute("id",idName);
	//select.setAttribute("name",idName);
	select.className = "formStyle";
		
	options = document.getElementById(id).options;
	
	for(i=0;i<options.length;i++){

		option = createOption(options[i].value, options[i].text)		
		select.appendChild(option);	
	}
	return select;
}
// create options of a select
function createOption(value, text){
	
	var option = document.createElement("option");
	option.setAttribute("value",value);	
	//option.setAttribute("text",text);
	option.innerHTML = text;	
	
	return option;
}

function getSelectedOptions(oList,optionText) {


	for(var i = 1; i < oList.options.length; i++) {
		if(oList.options[i].value == optionText) {
		oList.options[i].selected = true;
		}
	}
}
function deleteRow(){
	count = document.getElementById("row_added").value;
	
	var v = "";
	for(i=1;i<=count;i++){
		c = document.getElementById("checkBox_"+i);
		if(c != null && c.checked){
			removeRow(i);
			//break;
		}
	}	
}
function delElement(i){

	var chk_del = document.getElementById("chk_del").value;
	document.getElementById("chk_del").value = --chk_del;
	
	removeRow(i);
}

//this function is used to removing row in run time;
function removeRow(i) {

  var tbl = document.getElementById("tblCategory");
  var lastRow = tbl.rows.length;
  if (lastRow > 1){
		var tr_id = "tr_"+i;
		var Node1 = document.getElementById(tr_id); 
		var len = Node1.childNodes.length;
		
		while (Node1.hasChildNodes())
			Node1.removeChild(Node1.childNodes.item(0));
		 
		//document.getElementById("tr_1").removeNode(true); for IE
   }
}
</script>
</body>
</html>
