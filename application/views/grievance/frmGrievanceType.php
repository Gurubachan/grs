<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Grievance Type</h4>
					</div>
					<div class="card-body">
						<form name="frmGrievanceType" id="frmGrievanceType" method="post" action="<?=base_url('Grievance/insertGrievenceType')?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Type Of Grievance</label>
										<input type="text" class="form-control" name="txtGrievanceType" id="txtGrievanceType" required>
									</div>
								</div>

							</div>
							<button type="reset" class="btn btn-danger pull-left">Reset</button>
							<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmGrievanceType',event)">Create</button>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
