<?php
/**
 * Page Level Script
 */
?>
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
	$('#name').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: 1, name: 'name', title: 'Enter title' });
			$('#arabic_name').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: 1, name: 'arabic_name', title: 'Enter title' });
			$('#app_title').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: 1, name: 'app_title', title: 'Enter title' });
			$('#phone').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: 1, name: 'phone', title: 'Enter title' });
			$('#email').editable({ url: '<?php echo base_url();?>orgnization/update', type: 'text', pk: 1, name: 'email', title: 'Enter title' });

		
					FormEditable.init();
						
});
</script>
<!-- END PAGE LEVEL SCRIPTS -->