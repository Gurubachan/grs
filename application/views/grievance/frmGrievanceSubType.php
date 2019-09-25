<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Grievance Sub Category</h4>
					</div>
					<div class="card-body">
						<form name="frmGrievanceType" id="frmGrievanceSubType" method="post" action="<?=base_url('Grievance/insertGrievenceSubType')?>">
							<div class="row">

									<div class="col-md-12">
										<div class="form-group">
											<label class="bmd-label-floating">Category</label>
											<select name="cboSubType" id="cboCategoryforsubcategory" class="form-control" required>
												<option value="">Select Category</option>
											</select>
										</div>
									</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Sub Category of Grievance</label>
										<input type="text" class="form-control" name="txtGrievanceSubType" id="txtGrievanceSubType" required>
									</div>
								</div>

							</div>
							<button type="reset" class="btn btn-danger pull-left">Reset</button>
							<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmGrievanceSubType',event)">Create</button>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
