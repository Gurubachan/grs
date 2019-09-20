<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan-Asus
 * Date: 9/20/2019
 * Time: 10:25 AM
 */
?>

<div class="row" id="divGrivance">
	<div class="col-md-6">
		<div class="form-group">
			<label class="bmd-label-floating">Send To</label>
			<select name="cboSendto" id="cboSendto" class="form-control" onchange="callSendto(this)">
				<option value="">Select</option>
				<option value="na">Other</option>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="bmd-label-floating">Ministry</label>
			<select name="cboMinistry" id="cboMinistry" class="form-control" onchange="callMinistryForm(this)">
				<option value="">Select</option>
				<option value="na">Other</option>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="bmd-label-floating">PSU</label>
			<select name="cbopsu" id="cbopsu" class="form-control" onchange="callPSUForm(this)">
				<option value="">Select</option>
				<option value="na">Other</option>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="bmd-label-floating">Department</label>
			<select name="cboDepartment" id="cboDepartment" class="form-control" onchange="callDepartment(this)">
				<option value="">Select</option>
				<option value="na">Other</option>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="bmd-label-floating">Division</label>
			<select name="cboDivision" id="cboDivision" class="form-control" onchange="callDivision(this)">
				<option value="">Select</option>
				<option value="na">Other</option>
			</select>
		</div>
	</div>
</div>
