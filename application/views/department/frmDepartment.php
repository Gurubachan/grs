<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Department</h4>
					</div>
					<div class="card-body">
						<form method="post" name="frmDepartment" id="frmDepartment" action="<?= base_url('Department/insert') ?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">PSU / Organisation</label>
										<select name="cboPsu" id="cboPsuforDepartment" class="form-control" data-live-search="true" required>
											<option value="">Select PSU / Organisation</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Name</label>
										<input type="text" class="form-control" name="txtName" required id="txtName">
									</div>
								</div>
							</div>
								<button type="reset" class="btn btn-danger pull-left">Reset</button>
								<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmDepartment',event)">Create</button>
								<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
