<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 8/17/2019
 * Time: 12:52 PM
 */

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Department</h4>
					</div>
					<div class="card-body">
						<form
							method="post"
							  name="frmDivision"
							  id="frmDivision"
							  action="<?= base_url('Division/insert') ?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Department</label>
										<select name="cboDepartment" id="cboDivisionforDepartment" class="form-control" data-live-search="true" required>
											<option value="">Select Department</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Division</label>
										<input type="text" class="form-control" name="txtName" required id="txtName">
									</div>
								</div>
							</div>
							<button type="reset" class="btn btn-danger pull-left">Reset</button>
							<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmDivision',event)">Create</button>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
