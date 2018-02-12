<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>-->

<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo base_url();?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/index3.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo(theme settings page)
   Index.init(); // init index page
   Tasks.initDashboardWidget(); // init tash dashboard widget
});
</script>
    <!-- END JAVASCRIPTS -->
    <script type="text/javascript">
	var cal_params = ['wo_date','invoice_date', 'date', 'from_date', 'to_date', 'delivery_date','iqama_expiry', 'passport_expiry', 'joining_date', 'date_of_birth',
	               'applied_date','create_date', 'start_month', 'last_working_day','leave_date','admission_date', 'passport_expiry_mother', 'passport_expiry_father' , 'iqama_expiry_mother' ,'iqama_expiry_father',
	               'iqama_expiry_0', 'passport_expiry_0','iqama_expiry_1', 'passport_expiry_1','iqama_expiry_2', 'passport_expiry_2', 'iqama_expiry_3', 'passport_expiry_3','iqama_expiry_4', 'passport_expiry_4','iqama_expiry_5', 'passport_expiry_5', 
	               'insurance_expiry', 'baladiya_card_issue', 'baladiya_card_expiry', 'due_date', 'purchase_order_date', 'delivery_date',
	               'start_publishing', 'stop_publishing'];    
	
	function change_date_format(ids){
		for(i=0; i<ids.length; i++){
			 str = "" + ids[i];
			 if (document.getElementById(str) != null){				 
				 old = document.getElementById(str).value;
				 if(old !=null && old.length > 0){
					 arr1 = old.split('-');
					 newValue = arr1[2] + '-' + arr1[1] + '-' + arr1[0];
					 document.getElementById(str).value = newValue;
				 }
			 }
		 }	
	}
	
	function onclick_btn_search(url){
		
		flag = true;
		if(document.getElementById('search_text').length < 5 ){
			flag = false;
		}
		if(flag){
			val = document.getElementById('search_text').value;
			url = url+"/search/"+val;
			//callAJAX(url , 1);	
			//get(url , 'ajax=true', 'td_search_results','false','mainForm');
		}
		else{
			document.getElementById('search_text').focus();
			document.getElementById('search_text').style.borderColor = "#FF0000";
		}
	}
	
	</script>