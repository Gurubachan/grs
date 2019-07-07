<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create PSU</h4>
					</div>
					<div class="card-body">
						<form method="post" name="frmPSU" id="frmPSU" action="<?= base_url('PSU/insert') ?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Ministry</label>
										<select name="cboMinistry" id="cboMinistryforPSU" class="form-control" required>
											<option value="">Select Ministry</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Name Of PSU</label>
										<input type="text" class="form-control" name="txtName" required id="txtName">
									</div>
								</div>
							</div>
								<button type="reset" class="btn btn-danger pull-left">Reset</button>
								<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmPSU',event)">Create</button>
								<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
