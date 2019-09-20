<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 x">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Message Type</h4>
					</div>
					<div class="card-body">
						<form name="frmMessageType" id="frmMessageType" method="post" action="<?=base_url('MessageType/insert')?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="bmd-label-floating">Type Of Message</label>
										<input type="text" class="form-control" name="txtMessageType" id="txtMessageType" required>
									</div>
								</div>

							</div>
							<button type="reset" class="btn btn-danger pull-left">Reset</button>
							<button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmMessageType',event)">Create</button>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
