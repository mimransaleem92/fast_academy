<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<div class="col-md-12">
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div style="width:820px">
		
			<div style="height: 480px; margin-top: 100px" >
			<?php $form = $student[0]; $form2 = $payment[0];?>
			    
				<table class="table table-condensed" border="0">
					<tbody>
					   <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Receipt #').": <u>". $form2->receipt_number . "</u>";?></td>
					       	<td><?php echo Base_Controller::ToggleLang('Fee Type').": <u>".  $form2->fee_desc  . "</u>";?></td>
					       	<td><?php echo Base_Controller::ToggleLang('Issue Date').": <u>". Util::displayFormat($form2->payment_date) . "</u>";?></td>
				       </tr>
				       <tr> 
				       		<td colspan="2"><?php echo Base_Controller::ToggleLang('Student Name').": <u>".  $form->student_name  . "</u>";?></td>
				       		<td></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Admission #').": <u>".  $form->admission_number  . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Course').": <u>".  $form->course_name . " " . $form->section  . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Session').": <u>".  $form->batch_name  . "</u>";?></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Amount').": <u>".  $form2->payment_amount . ' ' . CURRENCY_DEAFULT . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Payment Mode').": <u>".  $form2->payment_mode. "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Chq. / App. No').": <u>".  $form2->card_number  . "</u>";?></td>
				       </tr>
				       <tr> 
				       		<td colspan="2"><?php echo Base_Controller::ToggleLang('Amount (in words)').": ";?> <span  id="td_words_val"></span> </td>
				       		<td ></td>
				       </tr>
				       
				       <tr> 
				       		<td ><?php echo Base_Controller::ToggleLang('School Stamp');?></td>
				       		<td ></td>
				       		<td ><?php echo Base_Controller::ToggleLang('Received By');?></td>
				       </tr>
					</tbody>
				</table>
			</div>	
			<div style="margin-top: 150px" >
				<table class="table table-condensed">
					<tbody>
					   <!-- <tr> 
				       		<td colspan="2"></td>
				       		<td align="right" style="padding-right: 100"><?php //echo 'Print Date: '. date('d, M Y H:i');?></td>
				       </tr> -->
					   <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Receipt #').": <u>". $form2->receipt_number . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Fee Type').": <u>".  $form2->fee_desc  . "</u>";?></td>
					       	<td><?php echo Base_Controller::ToggleLang('Issue Date').": <u>". Util::displayFormat($form2->payment_date) . "</u>";?></td>
				       </tr>
				       <tr> 
				       		<td colspan="2"><?php echo Base_Controller::ToggleLang('Student Name').": <u>".  $form->student_name  . "</u>";?></td>
				       		<td></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Admission #').": <u>".  $form->admission_number  . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Course').": <u>".  $form->course_name . " " . $form->section  . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Session').": <u>".  $form->batch_name  . "</u>";?></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Amount').": <u>".  $form2->payment_amount . ' ' . CURRENCY_DEAFULT . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Payment Mode').": <u>".  $form2->payment_mode. "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Chq. / App. No').": <u>".  $form2->card_number  . "</u>";?></td>
				       </tr>
				       <tr> 
				       		<td colspan="2"><?php echo Base_Controller::ToggleLang('Amount (in words)').": ";?> <span  id="td_words_val2"></span> </td>
				       		<td ></td>
				       </tr>
				       
				       <tr style="height: 100px;"> 
				       		<td  valign="bottom"><?php echo Base_Controller::ToggleLang('School Stamp');?></td>
				       		<td ></td>
				       		<td valign="bottom"><?php echo Base_Controller::ToggleLang('Received By');?></td>
				       </tr>
					</tbody>
				</table>
			</div>	
	</div>
</div>
<script>/*  window.print(); */
var th = ['','thousand','million', 'billion','trillion'];
var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine'];
 var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen'];
 var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

function toWords(s) {
    s = s.toString();
    s = s.replace(/[\, ]/g,'');
    if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');
    if (x == -1)
        x = s.length;
    if (x > 15)
        return 'too big';
    var n = s.split(''); 
    var str = '';
    var sk = 0;
    for (var i=0;   i < x;  i++) {
        if ((x-i)%3==2) { 
            if (n[i] == '1') {
                str += tn[Number(n[i+1])] + ' ';
                i++;
                sk=1;
            } else if (n[i]!=0) {
                str += tw[n[i]-2] + ' ';
                sk=1;
            }
        } else if (n[i]!=0) { // 0235
            str += dg[n[i]] +' ';
            if ((x-i)%3==0) str += 'hundred ';
            sk=1;
        }
        if ((x-i)%3==1) {
            if (sk)
                str += th[(x-i-1)/3] + ' ';
            sk=0;
        }
    }

    if (x != s.length) {
        var y = s.length;
        str += 'point ';
        for (var i=x+1; i<y; i++)
            str += dg[n[i]] +' ';
    }
    return str.replace(/\s+/g,' ');
}

document.getElementById('td_words_val'). innerHTML = document.getElementById('td_words_val2'). innerHTML = "Saudi Riyals " + toWords('<?php echo number_format($form2->payment_amount)?>') + " Only";

</script>