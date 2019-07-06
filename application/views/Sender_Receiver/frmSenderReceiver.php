<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Grievance</h4>
					</div>
					<div class="card-body">
					<form name="frmSenderReceiver" id="frmSenderReceiver" method="post" action="<?= base_url('SenderReceiver/insertSenderReceiver')?>">
						<div class="row">
							<div class="col-md-4">
							   <div class="form-group">
								 <label class="bmd-label-floating">Name</label>
								 <input type="text" class="form-control" name="txtName">
							   </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="bmd-label-floating">Contact</label>
									<input type="number" class="form-control" name="txtContact" maxlength="10" minlength="10">
								</div>
							</div>
							 <div class="col-md-4">
							   <div class="form-group">
								 <label class="bmd-label-floating">Email address</label>
								 <input type="email" class="form-control" name="txtEmailID">
							   </div>
							 </div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Address</label>
									<div class="form-group">
										<label class="bmd-label-floating">Address of Person / Department</label>
										<textarea class="form-control" rows="5" name="txtAddress"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group"><br>
									<label class="bmd-label-floating">Pin code</label>
									<input type="number" maxlength="6" minlength="6" class="form-control" name="txtPinCode">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="bmd-label-floating">Sender Or Receiver</label>
									<select name="cboSenderReceiver" class="form-control" id="cboSenderReceiver">
										<option value="">Select Sender Or Receiver</option>
										<option value="1">Sender</option>
										<option value="2">Receiver</option>
									</select>
								</div>
							</div>
						</div>
						<button type="reset" class="btn btn-danger pull-left">Reset</button>
						<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmSenderReceiver',event)">Create</button>
						<div class="clearfix"></div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
