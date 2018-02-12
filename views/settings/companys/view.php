			<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
				
			<?php  
		    $form = $form[0];
		    echo form_open('company/update',array('id'=>'mainForm'));
			
			$name      = array( 'name' => 'name', 'id'   => 'name', 'class' => 'field_big', 'value' => $form->name);
			$arabic_name = array( 'name' => 'arabic_name', 'id'   => 'arabic_name', 'class' => 'field_big arabic_input', 'value' => $form->arabic_name);
			$address     = array( 'name' => 'address', 'id'   => 'address', 'class' => 'field_big', 'value' => $form->address);
			$city      = array( 'name' => 'city', 'id'   => 'city', 'class' => 'field_big', 'value' => $form->city);
			$email     = array( 'name' => 'email', 'id'   => 'email', 'class' => 'field_big', 'value' => $form->email);
			$phone     = array( 'name' => 'phone', 'id'   => 'phone', 'class' => 'field_big', 'value' => $form->phone);
			echo form_hidden("company_id",$form->company_id);
						
			?>
			
			
					<table id="user" class="table table-bordered table-striped">
						<tbody>
							<tr>
								<td style="width:15%">App Title</td>
								<td style="width:50%"><a href="#" id="app_title" data-type="text" data-pk="1" data-original-title="Enter App Title"><?php echo $form->app_title;?></a></td>
							</tr> 
							<tr>
								<td style="width:15%">Org Name</td>
								<td style="width:50%"><a href="#" id="name" data-type="text" data-pk="1" data-original-title="Enter Org Name"><?php echo $form->name;?></a></td>
							</tr>
							<tr>
								<td>Org Name (arabic)</td>
								<td><a href="#" id="arabic_name" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter Org name(arabic)"><?php echo $form->arabic_name;?></a></td>
								<!-- <td><span class="text-muted">Required text field, originally empty</span></td> -->
							</tr>
							
							<tr>
								<td>Country</td>
								<td><a href="#" id="country" data-type="select2" data-pk="1" data-value="<?php echo $form->country;?>" data-original-title="Select country"></a></td>
								<!-- <td><span class="text-muted">Select2 (dropdown mode)</span></td> -->
							</tr>
							<tr>
								<td>Address</td>
								<td><a href="#" id="address" data-type="address" data-value="{<?php echo 'city:\''. $form->city.'\', street:\''.$form->street.'\', building:\''.$form->building;?>'}" data-pk="1" data-original-title="Please, fill address"></a></td>
								<!-- <td><span class="text-muted">Your custom input, several fields</span></td> -->
							</tr>
							<tr>
								<td style="width:15%">Phone</td>
								<td style="width:50%"><a href="#" id="phone" data-type="text" data-pk="1" data-original-title="Enter Phone"><?php echo $form->phone;?></a></td>
							</tr>
							<tr>
								<td style="width:15%">Email</td>
								<td style="width:50%"><a href="#" id="email" data-type="text" data-pk="1" data-original-title="Enter Email"><?php echo $form->email;?></a></td>
							</tr>
						</tbody>
					</table>
				<?php echo form_close();?>
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.mockjax.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
<!-- END X-EDITABLE PLUGIN -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-editable.js"></script>
<script>
jQuery(document).ready(function() {
		// initiate layout and plugins
	App.init();
	$('#name').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: <?php echo (!empty($form->company_id)) ? $form->company_id : '1'; ?>, name: 'name', title: 'Enter title' });
			$('#arabic_name').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: <?php echo (!empty($form->company_id)) ? $form->company_id : '1'; ?>, name: 'arabic_name', title: 'Enter title' });
			$('#app_title').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: <?php echo (!empty($form->company_id)) ? $form->company_id : '1'; ?>, name: 'app_title', title: 'Enter title' });
			$('#phone').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: <?php echo (!empty($form->company_id)) ? $form->company_id : '1'; ?>, name: 'phone', title: 'Enter title' });
			$('#email').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: <?php echo (!empty($form->company_id)) ? $form->company_id : '1'; ?>, name: 'email', title: 'Enter title' });

		
					FormEditable.init();
						
});
</script>
<!-- END PAGE LEVEL SCRIPTS -->					
			
            
               
	                