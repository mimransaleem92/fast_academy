<?php 

require_once 'includes/metito/php/util.php';


function curPageURL() {
 $pageURL = 'http';
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
return str_replace("view=wf","view=readonly",$pageURL);
}
function printUrl(){
	$url = curPageURL();
	return $url."&pt=1";
}

$pt = false;

if(isset($_GET['pt']) && $_GET['pt'] == "1" ){
$pt=true;
}
?>

<style>

table {
	border-color:black;
}
<?php if($pt){?>
input {
 border: 1px solid black;
}
<?php }?>
</style>

<table border="0" width="100%" cellpadding="5" cellspacing="0">
<?php if(!$pt){?>
	<tr>
		<td align="right"  colspan="2"> <a href="#" onclick=' javascript: window.open("<?php echo printUrl(); ?>","PrintView"); ' > Print Form </a> </td>
	</tr>
<?php }?>
<?php if(isset($this->print_info)){$r = $this->print_info; ?>
	<tr>
		<td align="left" style="font-weight: bold;font-style: bold; "> Reference Number : <?php echo $r->ref_number; ?></td>
		<td align="right" style="font-weight: bold;font-style: bold; "> Submitted Date: <?php echo Util::dateDisplayFormate($r->created_date); ?></td>
	</tr>
<?php }?>
</table>
<table border="0" width="100%" cellpadding="5" cellspacing="0">
	<thead>
	<?php if (!is_null($this->emp_info) && isset($this->emp_info[0])){
		
		$emp = $this->emp_info[0];
		
		if(isset($emp)){
		
		?>
	
		<tr>					
			<td align="left" style="font-weight: bold;font-style: bold;" nowrap="nowrap"> 
				Requested By: <?php echo $emp->EMP_NAME?> 
				<input type="hidden" name="company_code" id="company_code" value="<?php echo $emp->COMP_CODE;?>" />
			</td>
		</tr>		
		<?php }
		}
		?>
	</thead>
</table>
