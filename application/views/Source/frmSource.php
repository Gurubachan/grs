<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Source</h4>
					</div>
					<div class="card-body">
						<form method="post" name="frmSource" id="frmSource" action="<?= base_url('Source/insert') ?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Name</label>
										<input type="text" class="form-control" name="txtName" required id="txtName">
									</div>
								</div>
							</div>
								<button type="reset" class="btn btn-danger pull-left">Reset</button>
								<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmSource',event)">Create</button>
								<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
