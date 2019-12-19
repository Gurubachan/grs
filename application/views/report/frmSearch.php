<form id="frmSearch" method="post" name="frmSearch"
	  action="<?= base_url('Reports/fetch_data')?>">
<div class="content">
	<div class="container-fluid">
		<div class="row">
<div class="card">
	<h4 class="card-header card-header-primary">
		Reports
	</h4>
	<div class="card-body">

			<div class="col-sm-12"  style="text-align: center">
				<div class="form-group text-left">
					<div class="col-sm-3 ml-auto mr-auto d-block">
						<div class="form-group">
							<label for="">Report Type</label>
							<select id="cboRptType" name="cboRptType" class="form-control">
								<option value="">Select Report</option>
								<option value="1">Summary Report</option>
								<option value="2">Details Report</option>
								<option value="3">Periodic Report</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row" id="parameter_selector" style="display: none">
						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-4 ml-auto mr-auto d-block">
									<input type="checkbox" id="chkCategory" name="chkCategory" onclick="show_dependency_control(this,'cboCategory')">&nbsp;&nbsp;Category<br><br>
									<div class="col-sm-12 ml-auto mr-auto d-block" >
										<select id="cboCategory" name="cboCategory" class="form-control"  style="display: none;">
											<option value="">Select</option>
											<option value="1">Grivance</option>
											<option value="2">Request</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4 ml-auto mr-auto d-block">
									<input type="checkbox" id="chkType" name="chkType" onclick="show_dependency_control(this,'cboType')">&nbsp;&nbsp;Type<br><br>
									<div class="col-sm-12 ml-auto mr-auto d-block">
										<select id="cboType" name="cboType" class="form-control" style="display: none;">
											<option value="">Select</option>

										</select>
									</div>
								</div>
								<div class="col-sm-4 ml-auto mr-auto d-block">
									<input type="checkbox" id="chkPriority" name="chkPriority" onclick="show_dependency_control(this,'cboSeviourity')">&nbsp;&nbsp;Priority<br><br>
									<div class="col-sm-12 ml-auto mr-auto d-block">
										<select id="cboSeviourity" name="cboSeviourity" class="form-control" style="display: none;">
											<option value="">Select</option>
											<option value="1">A</option>
											<option value="2">B</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-12 ml-auto mr-auto d-block">
									<input type="checkbox" id="chkLocation" name="chkLocation" onclick="show_dependency_control(this,'cboLocation')">&nbsp;&nbsp;Location<br>

									<div class="row" id="cboLocation" style="display: none;">
										<div class="col-sm-4 ml-auto mr-auto d-block">
											<span>AC</span>
											<select id="cboAc" name="cboAc" class="form-control" >
												<option value="">Select</option>
											</select>
										</div>
										<div class="col-sm-4 ml-auto mr-auto d-block">
											<span> District</span>
											<select id="cboDist" name="cboDist" class="form-control" >
												<option value="">Select</option>
											</select>
										</div>
										<div class="col-sm-4 ml-auto mr-auto d-block">
											<span>Block</span>
											<select id="cboBlock" name="cboBlock" class="form-control" >
												<option value="">Select</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12" id="txtCalender" style="display: none;">
							<span>From:</span> &nbsp;
							<input type="text" id="txtFrom" name="txtFromDate" readonly>
							<span>To:</span> &nbsp;
							<input type="text" id="txtTo" name="txtToDate" readonly>
						</div>
					</div>


				</div>
			</div>
					</div>
	<div class="card-footer">
			<button type="reset" class="btn btn-danger">Reset</button>
			<button type="button" class="btn btn-success" onclick="submitToServer('frmSearch',event)">Search</button>
	</div>
			</div>
		</div>
	</div>
</div>
</form>
<div id="searchReportArea"></div>
