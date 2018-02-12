<div class="col-md-12">

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption" ><?php echo Base_Controller::ToggleLang('Academic Detail');?></div>
			<div class="tools" onclick="showAcademicRow()" style="cursor: pointer;"> <?php echo Base_Controller::ToggleLang('Academic Detail', 'ar');?>
				<i class="fa fa-plus"></i> <?php echo Base_Controller::ToggleLang('Add Row');?>
			</div>
		</div>
		<div class="portlet-body" >
			<table id="tblProduct" class="table table-striped table-bordered table-hover table-full-width" >
            	<tbody>
            	<tr>
	            	<th style="text-align: center;">#</th>
	            	<th><?php echo Base_Controller::ToggleLang('Degree / Qualification');?></th>
	            	<th><?php echo Base_Controller::ToggleLang('Passing year');?></th>
	            	<th><?php echo Base_Controller::ToggleLang('Grade/ Division');?></th>
	            	<th><?php echo Base_Controller::ToggleLang('institute Name');?></th>
	            	<th><?php echo Base_Controller::ToggleLang('Country');?></th>
            	</tr>
            	<?php $i = 1; 
            		foreach ($academic_list as $row){?>
            	<tr id="academic_row_<?php echo $i;?>" >
	                <td width='5%' align="center" valign="middle"><?php echo $i;?></td>
					<td width='30%'>
						<?php echo $row->degree;?>
					</td>
					<td width='15%'><?php echo $row->passing_year;?></td>
					<td width='14%'><?php echo $row->grade_division;?></td>
					<td width='25%'><?php echo $row->institute_name;?></td>
					<td width='26%'><?php echo $row->country;?></td>
                </tr><?php  $i++; }
                
                	for($i; $i<=10; $i++){ ?>
            	<tr id="academic_row_<?php echo $i;?>" >
	                <td width='5%' align="center" valign="middle"><?php echo $i;?></td>
					<td width='30%'>
						<input type="text" id="degree_<?php echo $i;?>" name="degree[]" placeholder="Degree" value="" style="width: 100%;" class="form-control form-control-inline" />
					</td>
					<td width='15%'><input type="text" id="passing_year_<?php echo $i;?>" name="passing_year[]" placeholder="Year" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
					<td width='14%'><input type="text" id="grade_division_<?php echo $i;?>" name="grade_division[]" placeholder="Grade/ Division" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
					<td width='25%'><input type="text" id="institute_name_<?php echo $i;?>" name="institute_name[]" placeholder="institute Name" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
					<td width='26%'><input type="text" id="country_<?php echo $i;?>" name="country[]" placeholder="Country" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
                </tr><?php }?>
                </tbody>
			</table>
			
			<div class="row">
				<div class="col-md-5">
					<button type="button" class="btn blue" onclick="submitForm()" ><i class="fa fa-check"></i> Submit</button>
					<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" >Cancel</button>
				</div>
				<div class="col-md-offset-2 col-md-5"> </div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>