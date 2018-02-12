<div id="hold_div">
<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<div class="col-md-12">
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div style="width:820px">
		<?php 
		 $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		if($div_id == '1'){
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
		?>
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
		<div style="height: 480px; margin-top: 10px" >
				<table class="table table-condensed" border="0">
					<tbody>
					   <tr> 
				       		<td colspan="7" ><b><?php echo Base_Controller::ToggleLang('Student Payment Hold Entries');?></b></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Admission #');?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Student Name');?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Course')?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Session');?></td>
				       		<td><?php echo Base_Controller::ToggleLang('Fee Desc');?></td>
				       		<td><?php echo Base_Controller::ToggleLang('payment_mode');?></td>
				       		<td align="right"><?php echo Base_Controller::ToggleLang('Amount'). ' (' . CURRENCY_DEAFULT . ")";?></td>
				       </tr>
				       <?php $i=0; $payment_amount = 0; $batch = array(6=>'2014-2015', 7=>'2015-2016', 8=>'2016-2017');
				       	$payment_ids = '';
			            if(isset($payment_list) && sizeof($payment_list) > 0){
			            	foreach($payment_list as $row){ 
			            		$i++;
			            		$payment_amount += $row->payment_amount;
			            		$payment_ids .= ','.$row->payment_id;
			            	?>
				       <tr> 
				       		<td><?php echo $row->admission_number;?></td>
				       		<td><?php echo $row->student_name;?></td>
				       		<td><?php echo $row->course_id;?></td>
				       		<td><?php echo $batch[$row->batch_id];?></td>
				       		<td><?php echo $row->fee_desc;?></td>
				       		<td><?php echo $row->payment_mode;?></td>
				       		<td align="right"><?php echo number_format($row->payment_amount, 2);?></td>
				       </tr>
				       <?php } 
			            }	?>
				       <tr> 
				       		<td colspan="2" align="left"><?php echo 'Records: '.$i;?></td>
				       		<td colspan="4" align="right" ><?php echo Base_Controller::ToggleLang('Total');?>:</td>
				       		<td align="right"><?php echo number_format($payment_amount, 2);?></td>
				       </tr>
					</tbody>
				</table>
				<?php $super_admin = $this->session->userdata(SESSION_CONST_PRE.'super_admin'); 
				if($super_admin == 'Y'){?>
				<input type="hidden" name='id_list' id="id_list" value="<?php echo substr($payment_ids, 1);?>" />
				<button type="button" class="btn btn-sm red" onclick="submitPosting()" > Delete </button>
				<?php }?>
			</div>
	</div>
</div>
</div>
<script src="<?php echo base_url();?>assets/scripts/ajax.js"></script>
<script src="<?php echo base_url();?>assets/scripts/jquery-1.7.2.js"></script>
<script>
	function submitPosting(){
            if(confirm('Are you sure to remove this transaction?')){
            	options = {error: function() { alert('Could not load form')} };
            	var tag = $("#hold_div"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: "<?php echo base_url().$model.'/close_holdentries';?>",
            	    type: (options.type || 'POST'),
            	    data: { id_list: $('#id_list').val() },
            	    beforeSend: options.beforeSend,
            	    complete: options.complete,
            	    success: function(data, textStatus, jqXHR) {
            	      if(typeof data == "object" && data.html) { //response is assumed to be JSON
            	        tag.html(data.html);
            	      } else { //response is assumed to be HTML
            	        tag.html(data);
            	      }                	      
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	    }
            	});	
            }
	}
</script>