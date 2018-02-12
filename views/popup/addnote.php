<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
      	<title> ADD NOTE </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="<?php echo base_url();?>favicon.ico" rel="shortcut icon" type="image/ico" /> 
		<link href="<?php echo base_url();?>assets/css/sheet_en.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/ajax.js"></script>
		<script type="text/javascript">
		
		function afterAjax(){
			var after_ajax = document.getElementById('add_node_div').innerHTML;
			if(after_ajax != '0'){
				self.close();
				window.opener.document.getElementById("note_td").innerHTML = after_ajax;
				//parent.window.opener.note_td.innerHTML = after_ajax;
			}
		}
		//alert(parent.window.opener.location);
		function onclick_addnote(url){
			var note = document.getElementById('subject').value;
			var opener = null;

	        if (window.dialogArguments) // Internet Explorer supports window.dialogArguments
	        { 
	            opener = window.dialogArguments;
	        } 
	        else // Firefox, Safari, Google Chrome and Opera supports window.opener
	        {        
	            if (window.opener) 
	            {
	                opener = window.opener;
	            }
	        }


			if(note.length == 0){
				document.getElementById('error_msg').innerHTML = 'Please enter note.' ;
				document.getElementById('subject').focus();
			}
			else
			{
				document.getElementById('error_msg').innerHTML = '' ;
				get(url,'','add_node_div',false, 'frmAddNote')
			}
		}
		</script>
		<style>
			.whitebgBorder {
			    border: 1px solid #8CBAE8;
			}
            .reqFormsubHead {
			    background: none repeat scroll 0 0 #BBD9F6;
			    border-bottom: 1px solid #8CBAE8;
			    padding: 4px;
			    font-weight: bold;
			}
			.tableHead {
			    color: #FFFFFF;
			    font: bold 13px Arial,Verdana,Helvetica,sans-serif !important;
			    padding: 4px;
			}
			.listViewTableHeader {
			    background-color: #3466A9;
			    background-image: url("../customimages/tableheaderr.gif");
			    background-position: right top;
			    background-repeat: no-repeat;
			}
			.formStylebuttonAct {
			    background: url("../images/buttonbg.gif") repeat-x scroll 0 0 #C6C5D7;
			    cursor: pointer;
			    font: bold 11px Verdana,Arial,Helvetica,sans-serif !important;
			    height: auto;
			    padding: 0 2px;
			    width: auto;
			}
		</style> 
    </head>	
	<body style="background-color:#FFF; padding:8px;">
	<center>
	<form id="frmAddNote" >
	<input type="hidden" name="form_id"  value="<?php echo  $_GET['form_id'];?>" />
	<input type="hidden" name="form_type" value="<?php echo  $_GET['form_type'];?>" />
	<input type="hidden" name="emp_num" value="<?php echo  $_GET['emp_num'];?>" />
	<input type="hidden" name="user_id" value="<?php echo $this->session->userdata(SESSION_CONST_PRE.'userId');?>" />
	<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
	   <tr>
            <td align="left" colspan="3" class="reqFormsubHead" onclick=""  style="cursor: pointer;">
            <span class="fontBlackBold FontColorStyle1" style="float:left">  <?php if($_GET['form_type'] == 'Announce') { echo " Announcement";} else {echo  "Request Reference # ".$_GET['form_id'];}?></span>
            </td>
       </tr>
    	<tr>
			<td width="4%" style="background-color:#FFF"></td>
            <td width="*" style="background-color:#FFF">
				<textarea name="subject" id="subject" class="formStyleTextarea FullWidth" rows="6" cols="48" ><?php //echo $form->resolution;?></textarea>
			</td> 
			<td width="60px" style="background-color:#FFF"></td>                       
        </tr>
        <tr>
        	<td width="4%" style="background-color:#FFF"></td>
			<td style="font-weight:bold;size:18;text-align: left; background-color:#FFF">
				<input type="checkbox" name="access" id="access" value="Public" />
				<label for="access">Show this note to Requester also</label> </td>
			<td width="60px" style="background-color:#FFF"></td>
        </tr>   
        <tr>
        	<td width="4%" style="background-color:#FFF"></td>
			<td style="font-weight:bold;size:18;text-align: left; background-color:#FFF">
				<input type="button" id="btnNote" value="Save" class="formStylebuttonAct" onclick="onclick_addnote('<?php echo base_url().$model."/savenote";?>');"/>
				&nbsp; <input type="button" id="btnClose" value="Close" class="formStylebuttonAct" onclick="window.close();"/>
				&nbsp; <span  id="error_msg" class="required" ></span>
				</td>	
			<td width="60px" style="background-color:#FFF"></td>
        </tr> 
	</table>
	</form>
	<div style="display:none" id="add_node_div">0</div>
	</center>
	</body>
</html>