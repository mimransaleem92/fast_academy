<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css" />
<div class="col-md-12">
	<div id="form_modal" class="modal fade bs-modal-lg" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content"></div>
		</div>
	</div>
	<!-- BEGIN CONDENSED TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Reports');?></div>
			<div class="tools"></div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
			<?php
			$to_date = date('d-m-Y');
			$from_date = (in_array($model, array('daily_report', 'student_report'))) ?  '01-'.date('m-Y') : $to_date ;
			
			$hide_date_search = $only_date_search = $hide_section = FALSE; 
			$course = array();
			$user_division = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			?>
				<table class="table table-condensed">
					<!-- <tr style="<?php if($hide_section){echo "display:none";} ?>">
		            	<td  valign="top" align=center  height="20px">
		            	<label class="control-label">Search Criteria</label>
		            	</td>
		            </tr>-->	
		            <tr>
		            	<td valign="top"  height="25px" align="center">	
	                  		<form id="mainForm" method="post">
	                  		<table width="90%" border="0" cellspacing="3" cellpadding="0">
					           <tr>
					           		<td colspan="4" id="dyn_msg">
					           		
					           		</td>
					           </tr>
					           
					           <tr style="<?php //if($hide_section){echo "display:none";} ?>">
		                            <td width="100%" style="text-align: right;padding-right: 5px">
		                            	<div class="form-group col-md-8" style="<?php if($hide_section || $hide_date_search){echo "display:none";} ?>">
											<!-- <label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Date Range');?></label> -->
											<div class="col-md-6">
												<div class="input-group input-large date-picker input-daterange" data-date="<?php echo $from_date;?>" data-date-format="dd-mm-yyyy">
													<input type="text" class="form-control" name="from_date" id="from_date" value="<?php echo $from_date; ?>">
													<span class="input-group-addon">
													<?php echo Base_Controller::ToggleLang('to');?> </span>
													<input type="text" class="form-control" name="to_date" id="to_date" value="<?php echo $to_date; ?>">
												</div>
												<!-- /input-group 
												<span class="help-block">
												Select date range </span>-->
											</div>
										</div>
									    <?php  if($hide_date_search) { echo '<div class="col-md-8"></div>'; }  
									    if($hide_section) { echo '<div class="col-md-3">'; ?>
									    	<select name="financial_year" class="form-control" id="financial_year" >
									    	<?php
										    	$fy = isset($_POST['financial_year']) ? $_POST['financial_year'] : $this->session->userdata(SESSION_CONST_PRE.'financial_year');
										    	foreach($batch_list as $batch){
										    		$financial_year = $batch->batch_name;
										    		$sel = ($financial_year ==  $fy) ?  'selected' : '' ;
										    		echo '<option value="'.$financial_year.'" '.$sel.'>'.$financial_year.'</option>';
										    	}
									    	?>
									    	</select>
									    	<?php echo '</div><div class="col-md-5"></div>';}?>
									    <div class="col-md-4" style="padding-bottom: 10px">
				                            <button type="button" id="search_btn" class="btn blue-madison " onclick="onclick_search('<?php echo base_url().$model;?>/search');" style="<?php //if($hide_section){echo "display:none;";} ?>text-align: center" >Search</button>
											<button type="button" id="print_btn" class="btn red-thunderbird " onclick="onclick_print(this)" style="text-align: center" >Print</button>
											<button type="button" id="excel_btn" class="btn blue-madison " onclick="onclick_excel(this);" style="text-align: center" >Excel</button>
											<!-- <button type="button" id="btnPdf12" class="btn blue-madison" onclick="generatefromjson();" style="text-align: center" >PDF</button>  
											<button type="button" id="btnPdf1" class="btn blue-madison" onclick="generatefromtable()" style="text-align: center" title="form table" >PDF</button> -->
										</div>
		                            </td>
	                          	</tr>
	                          	<tr style="<?php echo ($only_date_search || $hide_section) ? '' : "display:none"; ?>">
		                            <td width="100%" colspan="2">
		                            	<div class="form-group col-md-8" style="<?php echo (!$only_date_search) ? "display:none" : ''; ?>" >
			                            	<div class="col-md-8">
			                            		<input type="hidden" id="account_id" name="account_id" class="form-control select2 select2_account">
			                            	</div>
			                        	</div>
			                        	<div class="form-group col-md-4" style="<?php if($model == 'chart_account_report') echo 'display:none'?>">
			                        		<select  class="form-control input-sm" name="division_id" id="division_id" >
												<?php 
													$curr_div = $this->session->userdata(SESSION_CONST_PRE.'division_id');
													foreach($division_list as $div){ 
													$div_id = $div->division_id;
													?> 
													<option value="<?php echo $div_id;?>" <?php if($div_id ==  $curr_div) echo 'selected'; ?> ><?php echo $div->name;?></option>
												<?php } ?>
											</select>
			                        	</div>
			                    	</td>
			                    </tr>	        	
	                          	<tr style="<?php if($hide_section || $only_date_search){echo "display:none";} ?>">
		                            <td width="100%" colspan="2">
		                            	<div class="form-group col-md-9" >
			                            	<div class="form-group">
												<div class="col-md-4" style="<?php if($model == 'summary_report'){echo "display:none";} ?>">
													<select name="course_id" class="form-control" id="course_id" tabindex="1" onchange="onchange_courses(this.value)" >
									                    <option value="" selected>- - <?php echo Base_Controller::ToggleLang('SELECT').' '.Base_Controller::ToggleLang('Class'); ?> - -</option>
									                    <?php foreach($courses_list as $row){ 
									                    	$course_id = $row->course_id;
									                    	$course[$course_id] = $row->course_name;
									                    	?> 
									                    	<option value="<?php echo $course_id;?>" ><?php echo $row->course_name;?></option>
									                    <?php } ?>
													</select>
													
													<select name="course_id_to" class="form-control" id="course_id_to" tabindex="1" > <!-- onchange="onchange_courses(this.value)"> -->
									                    <option value="" selected>- - <?php echo Base_Controller::ToggleLang('SELECT').' '.Base_Controller::ToggleLang('Class'); ?> - -</option>
									                    <?php foreach($courses_list as $row){ 
									                    	$course_id = $row->course_id;
									                    	$course[$course_id] = $row->course_name;
									                    	?> 
									                    	<option value="<?php echo $course_id;?>" ><?php echo $row->course_name;?></option>
									                    <?php } ?>
													</select>
													<!-- <span class="help-block">This is inline help</span> -->
												</div>
												<div class="col-md-3" style="<?php if($model == 'summary_report'){echo "display:none";} ?>">
													<select name="section" class="form-control" id="section" tabindex="1" >
									                    <option value="" selected><?php echo Base_Controller::ToggleLang('Section'); ?></option>
									                    <option value="A" > A </option>
									                    <option value="B" > B </option>
									                    <option value="C" > C </option>
									                    <option value="D" > D </option>
									                    <option value="E" > E </option>
									                    <option value="F" > F </option>
									                    <option value="G" > G </option>
									                    <option value="H" > H </option>
									                    <option value="I" > I </option>
													</select>
													<?php if($model == 'fee_history'){?>
													<select name="batch_id" class="form-control" id="batch_id" >
								                    	<?php 
								                    	$b = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
								                    	foreach($batch_list as $batch){
								                    		$batch_id = $batch->batch_id;
								                    		$sel = ($batch_id ==  $b) ?  'selected' : '' ;
								                    		echo '<option value="'.$batch_id.'" '.$sel.'>'.$batch->batch_name.'</option>';
								                    	}
								                    	?>
													</select>
													<?php } ?>
													<!-- <span class="help-block">This is inline help</span> -->
												</div>
												<div class="col-md-5">
				                            		
												</div>
											</div>
		                            	</div>
		                            	<div class="col-md-3" style="<?php if($model=='paid_students') {echo "display:none";} ?>">
		                            		<select name="subject_id" class="form-control" id="subject_id" data-placeholder="Choose Subject" tabindex="1" >
											 	<option value="" selected><?php echo Base_Controller::ToggleLang('SELECT').' '.Base_Controller::ToggleLang('Subject'); ?></option>
							                    <?php foreach($subject_list as $sub){ 
				                    				$sid = $sub->subject_id;
												?> 
						                    	<option value=<?php echo '"'.$sid.'"';?> ><?php echo $sub->subject_name;?></option>
						                    <?php } ?>
							                    
							                    
											</select>
		                            	</div>
		                            </td>
	                          	</tr>   
				            </table>
				            </form>
				    	</td>
	            	</tr>
	            	<tr>
		            	<td align="center" valign="top" height="300px" style="padding-top: 5px" id="td_search_results">
		            		<?php include_once $model.'.php';?>
		            	</td>
		            </tr>
		           
	            </table>
			</div>
		</div>
	</div>
	<!-- END CONDENSED TABLE PORTLET-->
</div>
<input type="hidden" id="count" value="<?php echo $i;?>"/>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/table-advanced.js"></script>
    
<script>

	jQuery(document).ready(function() {       
	   App.init();
	   TableAdvanced.init();
	   if (jQuery().datepicker) {
           $('.date-picker').datepicker({
           	dateFormat: "dd-mm-yy",
               rtl: App.isRTL(),
               autoclose: true
           });
           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
       }

	   $(".select2_account").select2({
           placeholder: "Search for a Account",
           minimumInputLength: 4,
           ajax: {
               url: "<?php echo base_url()."vouchers/account"?>",
               dataType: 'json',
               delay: 250,
               data: function (params) {
                 console.log(params);
                 return {
                   q: params.term, // search term
                   account_id: params,
                   page: params.page
                 };
               },
               results: function (data) {
                   var results = [];
                   $.each(data, function(index, item){
                     results.push({
                       id: item.sub_account_id+item.account_id,
                       text: item.sub_account_id+item.account_id+' '+item.account_name
                     });
                   });
                   return {
                       results: results
                   };
               },
               cache: true
             }          
       });       
	});

	function showEditField(id, val){
		
		document.getElementById(id).innerHTML = '';
		var obj = document.getElementById(id);
		var newInputTxt1 = document.createElement('input');
		var arr = id.split('-');
	  	newInputTxt1.setAttribute('id', ''+arr[0]);
	  	newInputTxt1.setAttribute('name', ''+arr[0]);
	  	newInputTxt1.setAttribute('value', val);
    	newInputTxt1.setAttribute('type', 'text');
    	newInputTxt1.setAttribute('onblur', "get('<?php echo base_url().$model;?>/update_fields', 'id="+arr[1]+"&field="+arr[0]+"&value='+this.value, '"+id+"', false, '')");
    	newInputTxt1.setAttribute('class', 'form-control');

    	obj.appendChild(newInputTxt1);
	}

	function onchange_courses(val){
		var obj = document.getElementById('course_id');
		var obj1 = document.getElementById('course_id_to');
		
		for(i=0; i<obj.options.length; i++){
			if(i < obj.selectedIndex)
			{
				obj1.options[i].disabled = true;
			}else{
				obj1.options[i].disabled = false;
			}
		}
		obj1.options[obj.selectedIndex].selected = true;
	}
	
	<!--
function onclick_mail(){

	mainForm.submit();
}



function afterAjax(){
	if(document.getElementById('search_btn').disabled){
		ids=['from_date', 'to_date'];
		change_date_format(ids);	
		document.getElementById('search_btn').disabled = false;
	}
	
	$('#total_cap').html('Total Students: '+$('#total_record').val());
}

function onclick_search(_url){
	document.getElementById('dyn_msg').innerHTML = "";
	if(_url != null){
		flag = true;
		if(document.getElementById('from_date').value == ''){
			flag = false;
		}
		else if(document.getElementById('to_date').value == ''){
			flag = false;
		}
		
		flag = true;
		if(flag){
			document.getElementById('search_btn').disabled = true;
			ids=['from_date', 'to_date'];
			change_date_format(ids);	
			//get(url , 'ajax=true', 'td_search_results','false','mainForm');
			chatContent = $('#td_search_results');
			var postData = $('#mainForm').serializeArray();
			$.ajax({
				url: _url,
				type: 'POST',
				data: postData,				 
				success: function(result) {
					chatContent.html(result);
					afterAjax();
				}
			});
		}
		else{
			document.getElementById('dyn_msg').innerHTML = " Fill Required (*) Fields.";
		}
	}
}
function open_view(p){
	var winWidth  = (screen.availWidth/3);
	var winHeight = (screen.availHeight/2);

	var x = (screen.availWidth-winWidth)/2;
	var y = (screen.availHeight-winHeight)/2;
	arr = p.split("/");
	//alert(arr[3]);
	if(arr[3] == 'department'){
		p = p + '/' + document.getElementsByName('division_id')[0].value;
	}
	window.open(p ,'wms','left='+x+',top='+y+',width='+winWidth+',height='+winHeight+'menubar=0,scrollbars=1,maximize=1');

}
function onclick_print(obj){
	//obj.disabled = true;
	var from_date = db_date(document.getElementById('mainForm').from_date.value);
	var to_date   = db_date(document.getElementById('mainForm').to_date.value);
	var course_id   = (document.getElementById('mainForm').course_id.value);
	var course_id_to   = (document.getElementById('mainForm').course_id_to.value);
	var section   = (document.getElementById('mainForm').section.value);
	var payment_mode   = '';
	var fee_desc   = '';
	var subject_id   = document.getElementById('subject_id').value;
	var account_id   = document.getElementById('account_id').value;
	var division_id = document.getElementById('division_id').value;
	var fy = '';
	if(document.getElementById('financial_year')){
		fy = document.getElementById('financial_year').value;
	}
	var param = '';
	param += '?from_date='+from_date+'&to_date='+to_date+'&course_id='+course_id+'&course_id_to='+course_id_to+'&section='+section+'&payment_mode='+payment_mode+'&subject_id='+subject_id+'&fee_desc='+fee_desc+'&account_id='+account_id ;
	param += '&division_id='+division_id+'&financial_year='+fy;
	if(document.getElementById('batch_id')){
		param += '&batch_id='+document.getElementById('batch_id').value;
	}
	var str_loc = window.location;
	var arr = str_loc.toString();
	var start1 = arr.indexOf('#');
	if(start1 > 0){
		arr = arr.substring(0,start1);
	}
	
	window.open( arr +'/prints/'+param,'_blank');
}

function onclick_excel(obj){
	//obj.disabled = true;
	var from_date = db_date(document.getElementById('mainForm').from_date.value);
	var to_date   = db_date(document.getElementById('mainForm').to_date.value);
	var course_id   = (document.getElementById('mainForm').course_id.value);
	var course_id_to   = (document.getElementById('mainForm').course_id_to.value);
	var section   = (document.getElementById('mainForm').section.value);
	var payment_mode   = '';
	var fee_desc   = '';
	var subject_id   = document.getElementById('subject_id').value;
	var account_id   = document.getElementById('account_id').value;
	var division_id = document.getElementById('division_id').value;
	var fy = '';
	if(document.getElementById('financial_year')){
		fy = document.getElementById('financial_year').value;
	}
	var param = '';
	param += '?from_date='+from_date+'&to_date='+to_date+'&course_id='+course_id+'&course_id_to='+course_id_to+'&section='+section+'&payment_mode='+payment_mode+'&subject_id='+subject_id+'&fee_desc='+fee_desc+'&account_id='+account_id+'&file_type=excel';
	param += '&division_id='+division_id+'&financial_year='+fy;
	if(document.getElementById('batch_id')){
		param += '&batch_id='+document.getElementById('batch_id').value;
	}
	var str_loc = window.location;
	var arr = str_loc.toString();
	var start1 = arr.indexOf('#');
	if(start1 > 0){
		arr = arr.substring(0,start1);
	}
	
	window.open( arr +'/excel/'+param,'_blank');
}
function db_date(obj){
	arr1 = obj.split('-');
	newValue = arr1[2] + '-' + arr1[1] + '-' + arr1[0];
	return newValue;
}

function replaceAll(txt, replace, with_this) {
  	return txt.replace(new RegExp(replace, 'g'),with_this);
}

$('#total_cap').html('Total Records: '+$('#total_record').val());
//-->
</script>          