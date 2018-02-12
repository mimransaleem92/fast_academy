<?php
	function ToggleLanage($label){		
		return $label;
	}
	function curPageURL() {
	 $pageURL = 'http';
	 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}	
?>
<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="header-inner">
			<!-- BEGIN LOGO -->  
			<a class="navbar-brand" href="<?php echo base_url();?>dashboard">
			<img src="<?php echo base_url();?>assets/img/logo.png" alt="logo" class="img-responsive" />
			</a>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER --> 
			<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="<?php echo base_url();?>assets/img/menu-toggler.png" alt="" />
			</a> 
			<!-- END RESPONSIVE MENU TOGGLER -->
			
			<!-- BEGIN TOP NAVIGATION MENU -->
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown user">
				<?php if (!$this->session->userdata(SESSION_CONST_PRE.'userId')){
						?>
						<a href="#" class="dropdown-toggle" >Login | Signup</a> 
						<?php
					  }else{ 
				?>
				
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" src="<?php echo base_url();?>assets/img/avatar1_small.jpg"/>
					<span class="username" style="font-weight: bold; font-size: 1.2em">
					<?php
						$name_ar = $this->session->userdata(SESSION_CONST_PRE.'user_name_arabic'); if($name_ar == '') { echo $this->session->userdata(SESSION_CONST_PRE.'user_name'); } else { echo $name_ar;}
					?></span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="fa fa-user"></i> <?php echo Base_Controller::ToggleLang('My Profile');?></a></li>
						<li><a href="<?php echo base_url();?>user_profile/chng_pwd" ><i class="fa fa-user"></i> <?php echo Base_Controller::ToggleLang('Change Password');?> </a></li>
						<!-- <li><a href="#"><i class="fa fa-envelope"></i> My Inbox <span class="badge badge-danger">3</span></a></li>
						<li><a href="#"><i class="fa fa-tasks"></i> My Tasks <span class="badge badge-success">7</span></a></li> -->
						<li class="divider"></li>
						<li><a href="javascript:;" id="trigger_fullscreen"><i class="fa fa-move"></i> <?php echo Base_Controller::ToggleLang('Full Screen');?></a></li>
						<li><a href="<?php echo base_url();?>lock_screen"><i class="fa fa-lock"></i> <?php echo Base_Controller::ToggleLang('Lock Screen');?></a></li>
						<li><a href="<?php echo base_url();?>logout"><i class="fa fa-key"></i> <?php echo Base_Controller::ToggleLang('Log Out');?></a></li>
					</ul>
				<?php } ?>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
<!-- END HEADER -->
<!-- BEGIN CORE PLUGINS -->   
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/excanvas.min.js"></script> 
<![endif]-->   
<script src="<?php echo base_url();?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>   
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url();?>assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/scripts/ajax.js"></script>
<!-- END CORE PLUGINS -->
<script type="text/javascript">
var cal_params = ['wo_date','invoice_date', 'date', 'from_date', 'to_date', 'delivery_date','iqama_expiry', 'passport_expiry', 'joining_date', 'date_of_birth',
               'applied_date','create_date', 'start_month', 'last_working_day','leave_date','admission_date', 'passport_expiry_mother', 'passport_expiry_father' , 'iqama_expiry_mother' ,'iqama_expiry_father',
               'iqama_expiry_0', 'passport_expiry_0','iqama_expiry_1', 'passport_expiry_1','iqama_expiry_2', 'passport_expiry_2', 'iqama_expiry_3', 'passport_expiry_3','iqama_expiry_4', 'passport_expiry_4','iqama_expiry_5', 'passport_expiry_5', 
               'insurance_expiry', 'baladiya_card_issue', 'baladiya_card_expiry', 'due_date', 'purchase_order_date', 'delivery_date',
               'start_publishing', 'stop_publishing'];    
function change_division(val){

	if(val != ''){
	
		$.ajax({
		      type: "GET",
		      url: '<?php echo $model;?>'+'/set_division/'+val,
		      dataType: "text",
		      success: function(resultData){
		    	  window.location.href = "<?php echo base_url().$model;?>";
		      }
		});
	}
}

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