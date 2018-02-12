<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
      	<title><?php echo ucfirst($title); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="<?php echo base_url();?>favicon.ico" rel="shortcut icon" type="image/ico" /> 
		<link href="<?php echo base_url();?>assets/css/sheet_en.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		
		function assign_value(obj, val, val2){
			var frm = window.opener.document.getElementById('mainForm');
			if(obj.checked){
				try{
					if(frm.vendor_employee_id){
						frm.vendor_employee_id.value = val;
						frm.vendor_employee_name.value = val2;
					}
					else if(frm.supplier_id)
					{
						frm.supplier_id.value = val;
						frm.supplier_name.value = val2;
					}
				}catch(ee){}
				self.close();
			}
		}	
	
		</script>  
    </head>	
	
	<body>
	<!--<input type="button" name="btnPopup" id="btnPopup" value="Popup" onclick="callAJAX('/trade/index.php/rfq/printhtml/2',1);"/>-->
	<center>
	<table width="90%" border="0" cellspacing="0" cellpadding="0" style="cursor:pointer">
    	<tr>
        	<td width="4%" class="frame_blue"><label></label></td>
           	<td width="15%" class="frame_blue"><?php echo Base_Controller::ToggleLang('ID');?></td>
            <td width="" class="frame_blue"><?php echo Base_Controller::ToggleLang('Supplier Name');?></td>
        </tr>
        <tr>
        	<form id="frm" action="<?php echo base_url();?>popup/supplier" method="post">
        	<td width="4%" class="frame_blue_dark"><label></label></td>
           	<td width="15%" class="frame_blue_dark"></td>
            <td width="" class="frame_blue_dark"><input type="text" name="search_text" id="search_text" value="<?php if(isset($_REQUEST['search_text'])){ echo $_REQUEST['search_text'];}?>" /> </td>
            </form>
        </tr>
            <?php
            $i=0;
            if(isset($list) && sizeof($list) > 0){
                          	
            	foreach($list as $values){
	            	$i++;
	                $class = "frame_blue_light";
	                if($i%2==0){
	                	$class = "frame_blue_dark";
                }
            ?>
		<tr>
			<td class="<?php echo $class; ?>"><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->supplier_id;?>" onclick="assign_value(this,this.value, '<?php echo $values->name;?>');"/></td>
            <td class="<?php echo $class; ?>" style="color:#888888;"><strong><?php echo $values->supplier_id; ?></strong></td>
            <td class="<?php echo $class; ?>"><?php echo $values->name; ?></td>                          
        </tr>
            <?php
				}
            }
            ?>
	</table>
    <input type="hidden" id="count" value="<?php  echo $i;?>"/>
    <p><?php if (isset($links)) echo $links;?></p>
	</center>
	</body>
</html>