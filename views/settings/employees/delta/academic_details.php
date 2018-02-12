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
            	<?php for($i=1; $i<=10; $i++){ ?>
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
		</div>
	</div>
</div>