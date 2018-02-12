<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<div class="col-md-12">
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	
	<?php 
		$form = $student[0]; $form2 = $payment[0];
		if($form->division_id == '1'){
			$background_image = base_url()."assets/images/dns_header.png";
			$school_title = "DELTA NATIONAL SCHOOL";
			$address_line1 = "P.O. Box 57026 Riyadh 11574 Kingdom of Saudi Arabia, Tel:+966-1-4615593";
			$address_line2 = "Web: www.deltanationalschool.edu.sa  Email: info@deltanationalschool.edu.sa";
		}else {
			$background_image = base_url()."assets/images/dis_header.png";
			$school_title = "DELTA INTERNATIONAL SCHOOL";
			$address_line1 = "PO Box 57026, Riyadh 11574, Kingdom of Saudi Arabia Tel:+9661463008/4631711 Fax:+96614615593";
			$address_line2 = "Web: www.deltainternationalschool.edu.sa  Email: info@deltainternationalschool.edu.sa";
		}
		$school_title = APP_TITLE;
		
		/* --------------------------------------------------------------------------------------------- */ 
			$term_paid = (!empty($form2->fee_term)) ? substr($form2->fee_term, -1) : '-1';
			$fee_term = array('Arrears / Outstanding', '1st Term', '2nd Term', '3rd Term', '4th Term', '9'=>'Next Session');
			//echo $term_paid;
			$current_row = $form2->payment_id;
			
			$balance = $fee_percent = 0;
			$pending_due = 0; $pending_payment = 0; $total_discount=0;
			if(isset($paid_trans) && sizeof($paid_trans) > 0){ $i=0;
				
				foreach($paid_trans as $values){ $i++;
				$pending_due += $values->due_total;
				$pending_payment += $values->total_payment;
				$total_discount += $values->total_discount;
				
				if($values->id == $current_row) break;
				}
				$balance = $pending_due - $pending_payment - $total_discount;
				$fee_percent = (($pending_payment + $total_discount)/$pending_due)*100;
				$fee_percent = number_format($fee_percent, 2);
				$pending_due = $pending_due - $total_discount;
				 
			}
			$payment_detail = "";
			$payment_mode = $form2->payment_mode;
			if($form2->cheque_amount_second > 0) {
				$payment_mode .= ", ". $form2->payment_mode_second;
				$payment_detail  = $form2->payment_mode.":".$form2->cheque_amount;
				$payment_detail .= " and ".$form2->payment_mode_second.":".$form2->cheque_amount_second;
			}
			?>
	<div style="width:820px">
		<?php if($pending_due == 0){?>
		<div style="height: 100px; padding-top: 10px;" >
			<img src="<?php echo $background_image;?>" alt="Web Serve"/>
			<table border="0" width="100%" style="margin-top: -70px; font-family: 'Times New Roman', Times, serif;" >
				<thead>
					<tr>
						<th width="8%"></th>
						<th width="80%" style="text-align: center;"> <?php echo $school_title;?> </th>
						<th width="12%"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td style="text-align: center; font-size: 14px;"> <?php echo $address_line1;?> </td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td style="text-align: center; font-size: 14px;"> <?php echo $address_line2;?> </td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="height: 480px;" >
		<?php } else { ?>
			<div style="height: 480px; margin-top: 100px;" >
		<?php } ?>
				<table class="table table-condensed" border="0">
					<tbody>
					   <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Receipt #').": <u>". $form2->receipt_number . "</u>";?></td>
					       	<td><?php 
					       		if($term_paid > 0 ){
					       			
					       			echo Base_Controller::ToggleLang('Fee Type').": <u>".  $form2->fee_desc  . "</u>";
					       		}elseif($term_paid == 0){
					       			
				       				echo   "<u>".$fee_term[$term_paid]."</u>";
				       			}
				       			?>
					       		
					       	</td>
					       	<td><?php echo Base_Controller::ToggleLang('Received on').": <u>". Util::displayFormat($form2->payment_date) . "</u>";?></td>
				       </tr>
				       <tr> 
				       		<td colspan="2"><?php echo Base_Controller::ToggleLang('Student Name').": <u>".  $form->student_name  . "</u>";?></td>
				       		<td><?php 
								if($term_paid>0) {
					       			if($form->division_id == 1){
					       				echo Base_Controller::ToggleLang('Fee Term').": <u>".  $fee_term[$term_paid]  . "</u>";
					       			}
					       			else {
					       				if($form2->fee_desc == 'Tuition Fee')
					       					echo Base_Controller::ToggleLang('Fee Received')."(%): <u>". $fee_percent  . "%</u>";
					       				else
					       					echo Base_Controller::ToggleLang('Fee Term').": <u>".  $fee_term[$term_paid]  . "</u>";
					       			}
					       		}
				       		?>
				       		</td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Admission #').": <u>".  $form->admission_number  . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Course').": <u>".  $form->course_name . " " . $form->section  . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Session').": <u>".  $form->batch_name  . "</u>";?></td>
				       </tr>
				       <tr style="height: 30px;" > 
				       		<td><?php echo Base_Controller::ToggleLang('Amount')." (". CURRENCY_DEAFULT."): <u>".  $form2->payment_amount ."</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Payment Mode').": <u>".  $payment_mode. "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Chq. / App. No').": <u>".  $form2->card_number  . "</u>";?></td>
				       </tr>
				       <?php if($term_paid > 0 && $pending_due > 0) { ?>
				       <tr style="height: 76px;"> 
				       		<td colspan="3"><?php echo Base_Controller::ToggleLang('Amount (in words)').": ";?> <span  id="td_words_val" style="text-decoration: underline;"></span>
				       		<br/><br/><span style="font-style: oblique; font:xx-small; color: gray;"> <?php if($payment_detail != "") echo $payment_detail;?></span>
				       		</td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Due Amount')." (". CURRENCY_DEAFULT."): <u>".  number_format($pending_due, 2, '.', '') . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Total Paid')." (". CURRENCY_DEAFULT."): <u>".  number_format($pending_payment, 2, '.', ''). "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Balance')." (". CURRENCY_DEAFULT."): <u>".  number_format($balance, 2, '.', '') ."</u>";?></td>
				       </tr>
				       <?php }else { ?>
				       <tr style="height: 110px;"> 
				       		<td colspan="3"><?php echo Base_Controller::ToggleLang('Amount (in words)').": ";?> <span  id="td_words_val" style="text-decoration: underline;"></span> 
				       			<br/><br/><span style="font-style: oblique; font:xx-small; color: gray;"> <?php if($payment_detail != "") echo $payment_detail;?></span>
				       		</td>
				       </tr>
				       <?php }?>
				       <tr> 
				       		<td ><?php echo Base_Controller::ToggleLang('School Stamp');?></td>
				       		<td ></td>
				       		<td ><?php echo Base_Controller::ToggleLang('Received By');?></td>
				       </tr>
					</tbody>
				</table>
			</div>	
			<?php if($pending_due == 0){?>
			<!--<div style="height: 100px; padding-top:10px; background-image: url(''); background-repeat: no-repeat; background-position: center;" >-->
			<div style="height: 100px; padding-top:10px;" >
				<img src="<?php echo $background_image;?>" alt="Delta Schools"/>
				<table border="0" width="100%" style="margin-top: -70px; font-family: 'Times New Roman', Times, serif;" >
					<thead>
						<tr>
							<th width="8%"></th>
							<th width="80%" style="text-align: center;"> <?php echo $school_title;?> </th>
							<th width="12%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td style="text-align: center; font-size: 14px;"> <?php echo $address_line1;?> </td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align: center; font-size: 14px;"> <?php echo $address_line2;?> </td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="margin-top: 40px;" >
			<?php } else { ?>
			<div style="margin-top: 140px; " >
			<?php }?>
				<table class="table table-condensed">
					<tbody>
					   <!-- <tr> 
				       		<td colspan="2"></td>
				       		<td align="right" style="padding-right: 100"><?php //echo 'Print Date: '. date('d, M Y H:i');?></td>
				       </tr> -->
					   <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Receipt #').": <u>". $form2->receipt_number . "</u>";?></td>
					       	<td><?php
						       	if($term_paid > 0 ){
						       		 
						       		echo Base_Controller::ToggleLang('Fee Type').": <u>".  $form2->fee_desc  . "</u>";
						       	}elseif($term_paid == 0){
						       		 
						       		echo   "<u>".$fee_term[$term_paid]."</u>";
						       	}
						       	?>
						    </td>
					       	<td><?php echo Base_Controller::ToggleLang('Received on').": <u>". Util::displayFormat($form2->payment_date) . "</u>";?></td>
				       </tr>
				       <tr> 
				       		<td colspan="2"><?php echo Base_Controller::ToggleLang('Student Name').": <u>".  $form->student_name  . "</u>";?></td>
				       		<td><?php 
				       		if($term_paid>0) {
				       			if($form->division_id == 1){
				       				echo Base_Controller::ToggleLang('Fee Term').": <u>".  $fee_term[$term_paid]  . "</u>";
				       			}
				       			else {
				       				if($form2->fee_desc == 'Tuition Fee')
				       					echo Base_Controller::ToggleLang('Fee Received')."(%): <u>". $fee_percent  . "%</u>";
				       				else
				       					echo Base_Controller::ToggleLang('Fee Term').": <u>".  $fee_term[$term_paid]  . "</u>";
				       			}
				       		}	
				       		?>
				       		</td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Admission #').": <u>".  $form->admission_number  . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Course').": <u>".  $form->course_name . " " . $form->section  . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Session').": <u>".  $form->batch_name  . "</u>";?></td>
				       </tr>
				       <tr style="height: 30px;" > 
				       		<td><?php echo Base_Controller::ToggleLang('Amount')." (". CURRENCY_DEAFULT."): <u>".  $form2->payment_amount ."</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Payment Mode').": <u>".  $payment_mode. "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Chq. / App. No').": <u>".  $form2->card_number  . "</u>";?></td>
				       </tr>
				       <?php if($term_paid > 0 && $pending_due > 0) { ?>
				       <tr style="height: 76px;"> 
				       		<td colspan="3"><?php echo Base_Controller::ToggleLang('Amount (in words)').": ";?> <span  id="td_words_val2" style="text-decoration: underline;"></span> 
				       		<br/><br/><span style="font-style: oblique; font:xx-small; color: gray;"> <?php if($payment_detail != "") echo $payment_detail;?></span>
				       		</td>
				       </tr>
				       <tr>
				       		<td><?php echo Base_Controller::ToggleLang('Due Amount')." (". CURRENCY_DEAFULT."): <u>".  number_format($pending_due, 2, '.', '') . "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Total Paid')." (". CURRENCY_DEAFULT."): <u>".  number_format($pending_payment, 2, '.', ''). "</u>";?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Balance')." (". CURRENCY_DEAFULT."): <u>".  number_format($balance, 2, '.', '') ."</u>";?></td>
				       </tr>
				       <?php }else { ?>
				       <tr style="height: 110px;"> 
				       		<td colspan="3"><?php echo Base_Controller::ToggleLang('Amount (in words)').": ";?> <span  id="td_words_val2" style="text-decoration: underline;"></span> 
				       		<br/><br/><span style="font-style: oblique; font:xx-small; color: gray;"> <?php if($payment_detail != "") echo $payment_detail;?></span>
				       		</td>
				       </tr>
				       <?php }?>
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

document.getElementById('td_words_val'). innerHTML = document.getElementById('td_words_val2'). innerHTML = "Saudi Riyals " + toWords('<?php echo number_format($form2->payment_amount)?>') + " only";
window.print();
</script>