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
		<td align="center" colspan="2"> <a href="#" onclick=' javascript: window.open("<?php echo printUrl(); ?>","PrintView"); ' > Print Form </a> </td>
	</tr>
<?php }?>
<?php if(isset($this->print_info)){$r = $this->print_info; ?>
	<tr>
		<td align="left" style="font-weight: bold;font-style: bold; "> Reference Number : <?php echo $r->ref_number; ?></td>
		<td align="right" style="font-weight: bold;font-style: bold; "> Submitted Date: <?php echo Util::dateDisplayFormate($r->created_date); ?></td>
	</tr>
<?php }?>
</table>
<br/>

<table border="0" width="100%" cellpadding="5" cellspacing="0" style="border:1px solid">
	<thead>
	<?php if (!is_null($this->emp_info) && isset($this->emp_info[0])){
		
		$emp = $this->emp_info[0];
		
		if(isset($emp)){
		
		?>
	
		<tr>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid; border-color:black;" nowrap="nowrap"> Company: <?php echo $emp->COMP_NAME?><input type="hidden" name="company_code" id="company_code" value="<?php echo $emp->COMP_CODE;?>" /></td>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid; border-color:black;" nowrap="nowrap"> Branch: <?php echo $emp->BRANCH_NAME?></td>
			<td colspan="2" align="left" style="font-weight: bold;font-style: bold; border:1px solid; border-color:black;" nowrap="nowrap"> Department: <?php echo $emp->DEP_NAME?> </td>
			
		</tr>
		<tr>					
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> P/No: <?php echo $emp->EMP_NUM?></td>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Name: <?php echo $emp->EMP_NAME?></td>
			<td colspan="2" align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Designation:  <?php echo $emp->DESIG_DESC?></td>			
		</tr>
		<tr>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Grade/Level: <?php echo $emp->GRADE_CODE."-".$emp->GRADE_LEVEL; ?></td>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Leave Balance:  <?php echo $emp->leave_balance?></td>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Cost Center:  <?php echo $emp->cost_center?></td>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Ticket Entitlement:  <?php echo $emp->ticket_entitlement?></td>
			
		</tr>
		<tr>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Ticket Balance: <?php echo $emp->ticket_balance?></td>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Ticket Route:  <?php echo $emp->ticket_route?></td>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Term of Annual Leave:  <?php echo $emp->term_of_annual_leave?></td>
			<td align="left" style="font-weight: bold;font-style: bold; border:1px solid" nowrap="nowrap"> Term of Annual Ticket:  <?php echo $emp->term_of_annual_ticket?></td>			
		</tr>
		
		<?php }
		}
		?>
	</thead>
</table>
