 <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Create Grievance</h4>

                </div>
                <div class="card-body">
                  <form name="frmGrievence" id="frmGrievence" method="post" action="<?= base_url('Grievance/insertGrievence')?>" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6 offset-3">
                        <div class="form-group">
							<select name="cboType" id="cboType" class="form-control" onchange="callGrievanceGeneraetForm(this)">
								<option value="">Select Grievance</option>
								<option value="na">Not In List</option>
							</select>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sender</label>
							<select name="cboFrom" id="cboFrom" class="form-control" onchange="callSenderReceiverForm(this,1)">
								<option value="">Select Sender</option>
								<option value="na">Not in list</option>
							</select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Receiver</label>
							<select name="cboTo" id="cboTo" class="form-control" onchange="callSenderReceiverForm(this,2)">
								<option value="">Select Receiver</option>
								<option value="na">Not in list</option>
							</select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Subject</label>
                          <input type="text" class="form-control" name="txtSubject">
                        </div>
                      </div>
					</div>
					  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
							<br>
                          <label class="bmd-label-floating">Referance No</label>
                          <input type="text" class="form-control" name="txtReferance">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Source</label>
                          <select name="cboSource" id="cboSource" class="form-control" onchange="callSourceForm(this)">
							  <option value="">Select</option>
							  <option value="na">Not in list</option>
						  </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Body</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Content of the message for detail remarcation.</label>
                            <textarea class="form-control" rows="5" name="txtMessage"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="reset" class="btn btn-danger pull-left">Reset</button>
                    <button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmGrievence',event)">Generate Ticket</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
			  <div class="col-md-6" id="loadReport"></div>
		  </div>

		</div>
 </div>
