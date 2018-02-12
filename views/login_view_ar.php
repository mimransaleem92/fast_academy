<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HET</title>
<link href="view/css/sheet_en.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="view/js/util.js"></script>
<script language="JavaScript" src="view/js/AddRemoveMutipleSelectionUtils.js"></script>
</head>
<?php 
$dir_str = '';
	for($i = 0; $i<10; $i++){
		if(file_exists($dir_str.'util/localization.php'))
		{
			require_once($dir_str.'util/localization.php');
			$file_xml = $dir_str."util/localize.xml";
			break;
		}
		$dir_str .= '../';
	}
function ToggleLanage($label){
		
		$tmx  = new Localization('util/localize.xml', 'ar'); // english
		$traslate = $tmx->getResource();
		
		$label = trim($label);
		$label_ar = strtolower(str_replace(' ', '_', $label));
		if(isset($traslate[$label_ar]))
		{
			$label = $traslate[$label_ar];
		}
		return $label;
	}
?>
<body>
<form id="mainForm" method="post" action="<?php echo $_SERVER['PHP_SELF']."?do=login"; ?>" >
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="38">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="908" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td width="908" align="left" valign="top" class="login_body">
        <table width="779" border="0" cellspacing="0" cellpadding="1" style="margin-top:5px;">
          <tr>
            <td height="176" colspan="2" align="<?php echo $class_left;?>" valign="bottom"><table width="641" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="641" class="login_top"  ><table width="645" height="43" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                  <td width="60" align="center"><a href="index.php?do=login&lang=en" style="color: #fff; text-decoration: none; font-size: 13px;">English</a> </td>
                    <td width="565" align="<?php echo $class_left;?>"><?php echo ToggleLanage('LOGIN');?></td>
                    <td width="80">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
            </tr>
          <tr>
            <td height="27">&nbsp;</td>
            <td align="<?php echo $class_left;?>"><h3>:&nbsp;<?php echo ToggleLanage('Username');?>&nbsp;&nbsp;</h3></td>
          </tr>
          <tr>
            <td width="361">&nbsp;</td>
            <td width="414" align="<?php echo $class_left;?>" style="direction:rtl;">     &nbsp;&nbsp;       <input name="username" type="text" class="login_field" id="username" /></td>
          </tr>
          <tr>
            <td height="27">&nbsp;</td>
            <td align="<?php echo $class_left;?>"><h3>:&nbsp;<?php echo ToggleLanage('Password');?>&nbsp;&nbsp;</h3></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="<?php echo $class_left;?>" style="direction:rtl;" >     &nbsp;&nbsp;       <input name="password" type="password" class="login_field" id="password" />&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td align="<?php echo $class_left;?>"><label>
              
              <?php echo ToggleLanage('Remember me');?></label>
              <input type="checkbox" name=" " id="dfd" />&nbsp;&nbsp;
              </td>
          </tr>
          <tr>
            <td height="28">&nbsp;</td>
            <td align="<?php echo $class_left;?>"><a href="#" class="login">&nbsp;<?php echo ToggleLanage('Forgot your password?');?>&nbsp;&nbsp;</a></td>
          </tr>
          <tr>
           <td height="51" align="<?php echo $class_left;?>">
            <?php
                if($translator->errorMessage)
                {	$error = $translator->errorMessage;
                echo "<table width='342' height='31' border='0' cellpadding='0' cellspacing='0' class='login_error' style='margin-left:10px;'>
		              <tr>
		                <td class='login_error' height='51' align='left'>$error</td>
		              </tr>
		             </table>";
                }
            ?>
            </td>
            <td align="<?php echo $class_left;?>"><table width="100" border="0" cellspacing="0" cellpadding="5">
              <tr>
                
                <td><div ><a href="#"  id="blank_btn">
                  <table width="100%" height="38" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center"><?php echo ToggleLanage('RESET');?></td>
                    </tr>
                  </table>
                  </a>
                  </div></td>
                  <td><div ><a href="#" onclick="submitForm();" id="blank_btn">
                  <table width="100%" height="38" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center"><?php echo ToggleLanage('LOGIN');?></td>
                    </tr>
                  </table>
                  </a>
                  </div></td>
              </tr>
            </table></td>
            </tr>
          <tr>
            <td height="69" colspan="2" align="<?php echo $class_left;?>" class="footer"><table width="639" height="41" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="41" align="center">Copyright © HET 2010. All Rights Reserved</td>
              </tr>
            </table></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
