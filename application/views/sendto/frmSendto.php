<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 8/17/2019
 * Time: 11:05 AM
 */
?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Send To</h4>
					</div>
					<div class="card-body">
						<form method="post" name="frmSendto" id="frmSendto" action="<?= base_url('SendTo/insert') ?>">

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Where you send?</label>
										<input type="text" class="form-control" name="txtName" required id="txtName">
									</div>
								</div>
							</div>
								<button type="reset" class="btn btn-danger pull-left">Reset</button>
								<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmSendto',event)">Create</button>
								<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
