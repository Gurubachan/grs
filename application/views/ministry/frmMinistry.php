<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Ministry</h4>
					</div>
					<div class="card-body">
						<form method="post" name="frmMinistry" id="frmMinistry" action="<?= base_url('Ministry/insert') ?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Send To</label>
										<select name="cboSendto" id="cboSendtoforministry" class="form-control">
											<option value="">Select Send To</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Name</label>
										<input type="text" class="form-control" name="txtName" required id="txtName">
									</div>
								</div>
							</div>
								<button type="reset" class="btn btn-danger pull-left">Reset</button>
								<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmMinistry',event)">Create</button>
								<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
