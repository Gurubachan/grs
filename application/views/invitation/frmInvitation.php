<div class="containt">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Invitation </h4>
					</div>
					<div class="card-body">
						<form method="post" name="frmInvitaion" id="frmInvitaion"
							  action="<?= base_url('Grievance/insertGrievence')?>"
							  enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="bmd-label-floating">Sender</label>
										<select name="cboFrom" id="cboFrom" class="form-control" onchange="callSenderReceiverForm(this,1)">
											<option value="">Select Sender</option>
											<option value="na">Other</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="bmd-label-floating">Receiver</label>
										<select name="cboTo" id="cboTo" class="form-control" onchange="callSenderReceiverForm(this,2)">
											<option value="">Select Receiver</option>
											<option value="na">Other</option>
										</select>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6" id="loadReport"></div>
		</div>
	</div>
</div>
