<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan-Asus
 * Date: 9/20/2019
 * Time: 10:25 AM
 */
?>
<form method="post" action="<?= base_url('Grievance/insertGrievence')?>"
id="frmGrievanceProcess" name="frmGrievanceProcess" >
<div class="card">
	<div class="card-header card-header-primary">
		<h4 class="card-title" id="heading">Process Tickets </h4>
	</div>
	<div class="card-body">
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
	<div class="col-md-12">
		<label class="bmd-label-floating">Remarks</label>
		<textarea class="form-control" id="txtRemark" name="txtRemark" cols="4" required></textarea>
	</div>
	<fieldset>
		<legend>File Attachment</legend>
		<div class="row">
			<div class="col-md-6">
				<input type="file" name="attachment" id="attachment" class="form-control" accept=".pdf,.docx,.doc,.jpg">
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="bmd-label-floating">Letter Receive Date</label>
					<input type="text" class="form-control" name="txtReceiveDate" id="txtReceiveDate" readonly>
				</div>
			</div>
		</div>


	</fieldset>
		</div>
	</div>
</div>
</form>
<script>
	$("#txtReceiveDate").datepicker({
		dateFormat:"dd-mm-yy",
		maxDate:"+0D"
	});
</script>
