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


<!--begin custom header content for this example-->
<script type="text/javascript">
document.documentElement.className = "yui-pe";
cal_params = [''];
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
    
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/ajax.js"></script>	
	<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown/js/ajax.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown/js/ajax-dynamic-list.js"></script>

<tr>
    <td height="120" align="<?php echo $class_right;?>" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #FFF;" >
      <tr>
        <td align="center" valign="top" >
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" rowspan="2" style="padding-left:10px" align="<?php echo $class_left;?>" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="43%" rowspan="2"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/logo.png" alt="" width="195" height="100" /></td>
                <td width="57%" height="72" valign="bottom" class="company_name" style="color: #000;"><?php  echo $this->session->userdata('stc_company_name'); ?></td>
              </tr>
              <tr>
                <td class="company_name">&nbsp;</td>
              </tr>
            </table></td>
            <td width="50%" height="59" style="padding-right:10px" align="<?php echo $class_right;?>" valign="middle"></td>
          </tr>
          <tr>
            <td height="53" align="<?php echo $class_right;?>" style="padding-right:10px"><span style="color: #F00;cursor: pointer" onclick="window.print();" > Print </span></td>
          </tr>
         <!-- printCustom('petty_cash'); -->
        </table></td>
      </tr>
    </table></td>
  </tr>
<tr>
    <td align="center" style="background-color: #3466A9; height: 25px"> &nbsp; </td>
</tr>
<tr>
    <td align="center" style="background-color: #3FF232; height: 10px"> &nbsp; </td>
</tr>
<tr>
    <td align="center"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/b_grey_top.jpg" alt="" width="100%" height="7" /></td>
</tr>