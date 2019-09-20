<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Severity Type</h4>
					</div>
					<div class="card-body">
						<form name="frmSeverityType" id="frmSeverityType" method="post"
							  action="<?=base_url('Severity/insert')?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Type Of Severity</label>
										<input type="text" class="form-control" name="txtSeverityType" id="txtSeverityType" required>
									</div>
								</div>

							</div>
							<button type="reset" class="btn btn-danger pull-left">Reset</button>
							<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmSeverityType',event)">Create</button>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
