<link type="text/css" href="<?php echo base_url();?>assets/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/ajax.js"></script>	

<script type="text/javascript" src="<?php echo base_url();?>assets/js/util.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/pagination.js"></script>
<script type="text/javascript">
document.documentElement.className = "yui-pe";
cal_params = ['wo_date','invoice_date', 'date', 'from_date', 'to_date', 'delivery_date','iqama_expiry', 'passport_expiry', 'joining_date', 'date_of_birth','applied_date','create_date', 'start_month', 'last_working_day',
              'iqama_expiry_0', 'passport_expiry_0','iqama_expiry_1', 'passport_expiry_1','iqama_expiry_2', 'passport_expiry_2', 'iqama_expiry_3', 'passport_expiry_3','iqama_expiry_4', 'passport_expiry_4','iqama_expiry_5', 'passport_expiry_5', 'insurance_expiry', 'baladiya_card_issue', 'baladiya_card_expiry'];   

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
    <table width="1024" border="0" cellspacing="0" cellpadding="0" class="top_banner">
      <tr>
        <td align="center" valign="top">
		 <table width="98%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="375" rowspan="2" align="<?php echo $class_left;?>" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="43%" rowspan="2"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/logo.png" alt="" width="195" height="100" onclick="window.open('<?php echo base_url().$this->session->userdata('home_screen');?>', '_self');" />
					
				</td>
                <td width="57%" height="72" valign="bottom" class="company_name"><?php if($lang == "en") { echo $this->session->userdata('stc_company_name'); } else{ echo $this->session->userdata('stc_company_name_arabic');}?></td>
              </tr>
              <tr>
                <td class="company_name">&nbsp;</td>
              </tr>
            </table></td>
            <td width="375" height="59" align="<?php echo $class_right;?>" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6">&nbsp;</td>
                <td width="6"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/w_leftbar.jpg" alt="" width="6" height="42" /></td>
                <td width="150" align="center" nowrap="nowrap" class="welcome_blue_mid"><table width="140" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="139" align="center" style="text-transform:capitalize;"><?php if($lang == "en") { echo (strtolower($this->session->userdata('stc_user_name'))); } else{ echo $this->session->userdata('stc_user_name_arabic');}?></td>
                      <td width="10"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/w_icon.jpg" alt="" width="12" height="16" /></td>
                    </tr>
                </table></td>
                <td width="6"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/w_midbar.jpg" alt="" width="6" height="42" /></td>
                <?php if($lang == "en"){?>
                	<td width="130" align="center" class="welcome_grey_mid"><a href="#" onclick="javascript:setCookie('hrm_lang','ar','31');" class="topnav">عربي</a> | <a href="<?php echo base_url()."index.php/logout"?>" class="topnav"><?php echo Base_Controller::ToggleLang('Logout'); ?></a> | <a href="#" class="topnav"><?php echo Base_Controller::ToggleLang('Help'); ?></a></td>
                <?php }else{?>
                <td width="130" align="center" class="welcome_grey_mid"><a href="#" onclick="javascript:setCookie('hrm_lang','en','31');" class="topnav">English</a> | <a href="<?php echo base_url()."logout"?>" class="topnav"><?php echo Base_Controller::ToggleLang('Logout'); ?></a> | <a href="#" class="topnav"><?php echo Base_Controller::ToggleLang('Help'); ?></a></td>
                <?php }?>
                <td width="6" align="<?php echo $class_left;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/w_right.jpg" alt="" width="6" height="42" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="53" align="<?php echo $class_right;?>"><table width="300" border="0" cellspacing="0" cellpadding="0">
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
    <td align="center"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/b_grey_top.jpg" alt="" width="1024" height="7" /></td>
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