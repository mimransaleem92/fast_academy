<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/yui/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/yui/button.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/yui/container.css" />

<script type="text/javascript" src="<?php echo base_url();?>assets/yui/yahoo-dom-event.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/yui/connection-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/yui/element-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/yui/button-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/yui/dragdrop-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/yui/container-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/util.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/yui_ajax.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/AjaxRequestManager.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/yui/calendar-min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/yui/calendar_files/reset-fonts-grids.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/yui/calendar_files/skin.css">     

<script type="text/javascript" src="<?php echo base_url();?>assets/yui/calendar_files/utilities.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/yui/calendar_files/calendar-min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/yui/calendar_files/toolseffects-min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/pagination.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/ajax.js"></script>	


<!--begin custom header content for this example-->
<script type="text/javascript">
document.documentElement.className = "yui-pe";
cal_params = ['wo_date','invoice_date', 'date', 'from_date', 'to_date', 'delivery_date','iqama_expiry', 'passport_expiry', 'joining_date', 'date_of_birth','applied_date',
              'iqama_expiry_0', 'passport_expiry_0','iqama_expiry_1', 'passport_expiry_1','iqama_expiry_2', 'passport_expiry_2', 'iqama_expiry_3', 'passport_expiry_3','iqama_expiry_4', 'passport_expiry_4','iqama_expiry_5', 'passport_expiry_5', 'insurance_expiry'];   //'manufacture_date', 'expiry_date','to_date','from_date', 'leave_year_to', 'date_last_annual_leave_from', 'date_last_annual_leave_to','travel_date1','travel_date2','travel_date3','travel_date','payroll_cal'];

function change_date_format(ids){
	for(i=0;i<ids.length;i++){
		 str = "" + ids[i];
		 if (document.getElementById(str) != null){				 
			 old = document.getElementById(str).value;
			 if(old !=null && old.length > 0){
				 arr1 = old.split('-');
				 newValue = arr1[2] + '-' + arr1[1] + '-' + arr1[0];
				 document.getElementById(str).value = newValue;
			 }
		 }
	 }	
}
function onclick_btn_search(url){
	
	flag = true;
	if(document.getElementById('search_text').length < 5 ){
		flag = false;
	}
	if(flag){
		val = document.getElementById('search_text').value;
		url = url+"/search/"+val;
		//callAJAX(url , 1);	
		//get(url , 'ajax=true', 'td_search_results','false','mainForm');
	}
	else{
		document.getElementById('search_text').focus();
		document.getElementById('search_text').style.borderColor = "#FF0000";
	}
}
</script>

<style type="text/css">

.yui-pe .yui-pe-content {
    display:none;
}

</style>
<?php
	include_once 'functions.php';
	function curPageURL() {
	 $pageURL = 'http';
	 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}	
?>
<tr>
    <td height="120" align="<?php echo $class_right;?>" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="top_banner">
      <tr>
        <td align="center" valign="top">
			<!--<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="150" width="1024">
				<param name="quality" value="high" />
				<param name="movie" value="<?php echo base_url();?>assets/images/flash/banner.swf" />
				<param name="wmode" value="transparent"> 
				<embed wmode="transparent" height="150" width="1024" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="<?php echo base_url();?>assets/images/flash/banner.swf" type="application/x-shockwave-flash"></embed>
			</object>-->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" rowspan="2" align="<?php echo $class_left;?>" valign="top">
	            <table width="100%" border="0" cellspacing="0" cellpadding="0">
	              <tr>
	                <td width="43%" rowspan="2" style="padding-left:10px"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/logo.png" alt="" width="195" height="100" onclick="window.open('<?php echo base_url().$this->session->userdata('stc_home_screen');?>', '_self');" />
						
					</td>
	                <td width="57%" height="72" valign="middle" class="company_name" nowrap="nowrap"><?php if($lang == "en") { echo $this->session->userdata('stc_company_name'); } else{ echo $this->session->userdata('stc_company_name_arabic');}?></td>
	              </tr>
	            </table>
            </td>
            <td width="50%" height="59" align="<?php echo $class_right;?>" valign="middle" style="padding-right:10px">
	            <table border="0" cellspacing="0" cellpadding="0">
	              	<tr>
	                	<td width="6">&nbsp;</td>
	                	<td width="6"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/w_leftbar.jpg" alt="" width="6" height="42" /></td>
	                	<td width="150" align="center" nowrap="nowrap" class="welcome_blue_mid">
		                	<table width="140" border="0" cellspacing="0" cellpadding="0">
		                    <tr>
		                      <td width="139" align="center" style="text-transform:capitalize;"><?php if($lang == "en") { echo (strtolower($this->session->userdata('stc_user_name'))); } else{ echo $this->session->userdata('stc_user_name_arabic');}?></td>
		                      <td width="10"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/w_icon.jpg" alt="" width="12" height="16" /></td>
		                    </tr>
		                	</table>
	                	</td>
	                	<td width="6"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/w_midbar.jpg" alt="" width="6" height="42" /></td>
	                	<td width="100" align="center" class="welcome_grey_mid"><a href="<?php echo base_url()."logout"?>" class="topnav"><?php echo Base_Controller::ToggleLang('Logout'); ?></a> | <a href="#" class="topnav"><?php echo Base_Controller::ToggleLang('Help'); ?></a></td>
	                	<td width="6" align="<?php echo $class_left;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/w_right.jpg" alt="" width="6" height="42" /></td>
	              	</tr>
	            </table>
            </td>
          </tr>
          <tr>
            <td height="53" align="<?php echo $class_right;?>" style="padding-right:10px"><table width="300" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="265" align="<?php echo $class_right;?>"><input name="search_text" type="text" class="search_field" style="height:22px; width:225px;" id="search_text" AUTOCOMPLETE=OFF value="" /></td>
                <td width="35" align="<?php echo $class_left;?>"><a href="#"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/btn_search.jpg" alt="" width="33" height="29" border="0" onclick="onclick_btn_search('<?php echo base_url();?>global_search');" /></a></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<tr>
    <td align="center"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/b_grey_top.jpg" alt="" width="100%" height="7" /></td>
</tr>
<?php 
//$menuList = $translator->getLeftMenuList();
$count = sizeof($menuList);
$menu_type = "";
$menu_name = "Dashboard";
$selected_menu = null;
$action = '';
for($i=0;$i<sizeof($menuList);$i++){		          			
   $menu = $menuList[$i];
   $menu_url = $menu->url;
   if($action == $menu_url){
   		$menu_name = $menu->name;
   		$menu_type = "Settings";
   		$selected_menu = $menu;
	}
}	
?>