<form method="post" action="<?= base_url('Grievance/insertActioTaken')?>"
	  id="frmGrievanceProcess" name="frmGrievanceProcess" >
	<div class="card">
		<div class="card-header card-header-primary">
			<h4 class="card-title" id="heading">Process Tickets </h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="bmd-label-floating">Letter Forward To : </label>
						<input type="text" class="form-control" name="txtForwardTo" id="txtForwardTo" required>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label class="bmd-label-floating">Action Taken : </label>
						<textarea class="form-control" id="txtRemark" name="txtRemark" cols="4" required></textarea>
					</div>
				</div>
				<fieldset style="width: 100%">
					<legend>File Attachment</legend>
					<div class="row">
						<div class="col-md-6">
							<input type="file" name="attachment" id="attachment" class="form-control" accept=".pdf,.docx,.doc,.jpg">
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="bmd-label-floating">Letter Receive Date</label>
								<input type="text" class="form-control" name="txtReceiveDate" id="txtReceiveDate" readonly>
							</div>
						</div>
					</div>
				</fieldset>
				<div class="row" style="width: 100%">
					<div class="col-md-12">
							<div class="form-check float-right">
								<label class="form-check-label text-danger">
									<input class="form-check-input" type="checkbox"
										   name="chkResolved"
										   id="chkResolved"
										   value="4">
									<span class="form-check-sign">
									<span class="check"></span>
									</span>
									Click Check box if resolved.
								</label>
							</div>
					</div>
				</div>
		</div>
	</div>
</form>
<div class="col-md-12" id="grievance_forward_report">

</div>
<script>
	$("#txtReceiveDate").datepicker({
		dateFormat:"dd-mm-yy",
		maxDate:"+0D"
	});
</script>
